<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\DetailUser;
use App\Models\DetailProductKas;
use App\Models\HeaderProduct;
use App\Models\HeaderInvest;
use App\Models\DetailInvest;
use App\Models\Valuation;
use App\Models\DValuation;
use Validator;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Support\Str;
use PDF;

class ValuationToolsController extends Controller
{
    public function valuation()
    {
        return view('guest.valTools');
    }

    public function addnew(Request $req)
    {
        $user = auth()->user();
        
        //validate request
        $validator = Validator::make($req->all(),[
            'net_profit'=>'required',
            'cost_equity'=>'required',
            'growth_rate'=>'required',
            'current_assets'=>'required',
            'current_liabilities'=>'required',
            
        ]);
        
        $now = Carbon::now();
        $thnskrg = $now->year;
        $netprofit = (int)Str::replaceArray(',', ['', ''], $req->net_profit); //money
        $growthrate = ((double)$req->growth_rate)/100; //percentage

        $values = new Valuation;
        if(Auth::guest())
        {
            $values->user_id = 0;
            $values->email_user = $req->email_user;
        }
        if(Auth::user())
        {
            $values->user_id = $user->id;
            $values->email_user = $req->email_user;
        }
        
        $values->sales_revenue = (int)Str::replaceArray(',', ['', ''], $req->sales_revenue);
        $values->net_profit = (int)Str::replaceArray(',', ['', ''], $req->net_profit);
        $values->cost_equity = ((double)$req->cost_equity);
        $values->growth_rate = ((double)$req->growth_rate);
        $values->current_assets = (int)Str::replaceArray(',', ['', ''], $req->current_assets);
        $values->current_liabilities = (int)Str::replaceArray(',', ['', ''], $req->current_liabilities);
        $values->working_capital = ((int)Str::replaceArray(',', ['', ''], $req->current_assets))-((int)Str::replaceArray(',', ['', ''], $req->current_liabilities));
        $values->depreciation_exist_assets = (int)Str::replaceArray(',', ['', ''], $req->depreciation_exist_assets);
        $values->depreciation_rate = ((double)$req->depreciation_rate);
        $values->total_pv_fcfe = 0;
        $values->terminal_value = 0;
        $values->pv_terminal_value = 0;
        $values->business_value = 0;
        $values->save();

        //get last id input
        $getLastId = Valuation::orderBy('id', 'desc')->first();

        //find header from last
        $value = DB::table('valuations')->find($getLastId->id);

        $total_pv_fcfe=0;
        //$terminal_value=0;
        for ($i=0; $i <6 ; $i++) { 
            $val_details = new DValuation;
            $val_details->valuation_id = $getLastId->id;
            //$val_details->user_id = 0;
            $val_details->name_year = ($now->year - 1) + $i;
            $val_details->n_year = $i;
            
            if ($i == 0) {
                
                $val_details->n_sales_forecast = $value->sales_revenue;
                $val_details->n_profit_forecast = $value->net_profit;
                $val_details->n_current_assets = $value->current_assets;
                $val_details->n_current_liabilities = $value->current_liabilities;
                $val_details->n_working_capital = $value->working_capital;
               
                $val_details->n_purchase_new_assets = 0;
                $val_details->n_depreciation_new_assets = 0; 
                $val_details->n_loans_returned = 0;
                $val_details->n_new_loan = 0;
                $val_details->n_seller_discretionary_expend = 0;
            
                $val_details->n_change_working_capital = 0;
                $val_details->n_seller_discretionary_expend = 0;
                $val_details->n_cash_flow_fcfe = 0;
                $val_details->n_pv_fcfe = 0;
                

            }else{
              
                $val_details->n_sales_forecast = $value->sales_revenue + ($value->sales_revenue * $value->growth_rate/100);;
                $val_details->n_profit_forecast = $value->net_profit + ($value->net_profit * $value->growth_rate/100);
                $val_details->n_current_assets = $value->current_assets + ($value->current_assets * $value->growth_rate/100);
                $val_details->n_current_liabilities = $value->current_liabilities + ($value->current_liabilities * $value->growth_rate/100);
                $val_details->n_working_capital = $value->working_capital + ($value->working_capital * $value->growth_rate/100);
                
                $val_details->n_change_working_capital = ($value->working_capital + ($value->working_capital * $value->growth_rate/100))-$value->working_capital;

                $profit = $value->net_profit + ($value->net_profit * $value->growth_rate/100); 
                $changein = ($value->working_capital + ($value->working_capital * $value->growth_rate/100))-$value->working_capital;
                $depExtAsset = $value->depreciation_exist_assets;
                
                $purNewAsset = (int)Str::replaceArray(',', ['', ''], $req->n_purchase_new_assets_[$i]);
                
                if($i==1){
                    $depNewAsset = ($purNewAsset * $value->depreciation_rate/100) ;
                }
                if ($i==2) {
                    $depNewAsset = ((int)Str::replaceArray(',', ['', ''], $req->n_purchase_new_assets_[1])*$value->depreciation_rate/100) + ((int)Str::replaceArray(',', ['', ''], $req->n_purchase_new_assets_[2]) * $value->depreciation_rate/100) ; //WAIT
                }
                if ($i==3) {
                    $depNewAsset = ((int)Str::replaceArray(',', ['', ''], $req->n_purchase_new_assets_[2])*$value->depreciation_rate/100) + ((int)Str::replaceArray(',', ['', ''], $req->n_purchase_new_assets_[1])*$value->depreciation_rate/100) + ((int)Str::replaceArray(',', ['', ''], $req->n_purchase_new_assets_[3]) * $value->depreciation_rate/100) ; //WAIT
                }
                if ($i==4) {
                    $depNewAsset = ((int)Str::replaceArray(',', ['', ''], $req->n_purchase_new_assets_[3])*$value->depreciation_rate/100) + ((int)Str::replaceArray(',', ['', ''], $req->n_purchase_new_assets_[2])*$value->depreciation_rate/100) + ((int)Str::replaceArray(',', ['', ''], $req->n_purchase_new_assets_[1])*$value->depreciation_rate/100) + ((int)Str::replaceArray(',', ['', ''], $req->n_purchase_new_assets_[4]) * $value->depreciation_rate/100) ; //WAIT
                }
                if ($i==5) {
                    $depNewAsset = ((int)Str::replaceArray(',', ['', ''], $req->n_purchase_new_assets_[4])*$value->depreciation_rate/100) + ((int)Str::replaceArray(',', ['', ''], $req->n_purchase_new_assets_[3])*$value->depreciation_rate/100) + ((int)Str::replaceArray(',', ['', ''], $req->n_purchase_new_assets_[2])*$value->depreciation_rate/100) + ((int)Str::replaceArray(',', ['', ''], $req->n_purchase_new_assets_[1])*$value->depreciation_rate/100) + ((int)Str::replaceArray(',', ['', ''], $req->n_purchase_new_assets_[5]) * $value->depreciation_rate/100) ; //WAIT
                }
               
                
                
                $loanre = (int)Str::replaceArray(',', ['', ''], $req->n_loans_returned_[$i]);
                $newLoan = (int)Str::replaceArray(',', ['', ''], $req->n_new_loan_[$i]);
                $sde = (int)Str::replaceArray(',', ['', ''], $req->n_seller_discretionary_expend_[$i]);
              

                $val_details->n_purchase_new_assets = $purNewAsset;
                $val_details->n_depreciation_new_assets = $depNewAsset;
                $val_details->n_loans_returned = $loanre;
                $val_details->n_new_loan = $newLoan;
                $val_details->n_seller_discretionary_expend = $sde;
            
                $val_details->n_cash_flow_fcfe = $profit - $changein + $depExtAsset - $purNewAsset + $depNewAsset - $loanre + $newLoan + $sde;
                $val_details->n_pv_fcfe = ($profit - $changein + $depExtAsset - $purNewAsset + $depNewAsset - $loanre + $newLoan + $sde)/pow(1+$value->cost_equity/100, $i);

                $total_pv_fcfe = $value->total_pv_fcfe + ($profit - $changein + $depExtAsset - $purNewAsset + $depNewAsset - $loanre + $newLoan + $sde)/pow(1+$value->cost_equity/100, $i);

                $terminal_value = (int)$val_details->n_cash_flow_fcfe*((1-(1/pow(1+ $value->cost_equity/100, $i)))/($value->cost_equity/100));
                $pv_terminal_value = $terminal_value/pow(1+ $value->cost_equity/100, $i);
                $business_value = $total_pv_fcfe +$pv_terminal_value;

                //temp
                $value->sales_revenue = $value->sales_revenue + ($value->sales_revenue * $value->growth_rate/100);
                $value->net_profit = $value->net_profit + ($value->net_profit * $value->growth_rate/100);
                $value->current_assets = $value->current_assets + ($value->current_assets * $value->growth_rate/100);
                $value->current_liabilities = $value->current_liabilities + ($value->current_liabilities * $value->growth_rate/100);
                $value->working_capital = $value->working_capital + ($value->working_capital * $value->growth_rate/100);
                $value->total_pv_fcfe = $total_pv_fcfe;
                $value->terminal_value = $terminal_value;

                //dd($ok2);
                DB::table('valuations')->
                where('id',$getLastId->id)->
                update([
                    'total_pv_fcfe' => $total_pv_fcfe,
                    'terminal_value' => $terminal_value,
                    'pv_terminal_value' =>$pv_terminal_value,
                    'business_value' =>$business_value,
                ]);

                
            }
            
           
            $val_details->save();
            
        }

        return $business_value;
    }

    public function cetak_hasilValuation($email)
    {
        $user = auth()->user();
        if(Auth::guest())
        {
            $user_id = 0;
            
        }
        if(Auth::user())
        {
            $user_id = $user->user_id; 
        }

        //CEK LAST ID yang ada pada tabel valuation
        $getLast =  DB::table('valuations')->where('email_user','=',$email)->orderBy('id','desc')->first();

        $getDetailLast =  DB::table('d_valuations')
                        ->select('d_valuations.id','d_valuations.name_year','d_valuations.n_profit_forecast', 'd_valuations.n_sales_forecast','d_valuations.n_current_assets','d_valuations.n_current_liabilities','d_valuations.n_working_capital','d_valuations.n_change_working_capital','d_valuations.n_purchase_new_assets','d_valuations.n_depreciation_new_assets','d_valuations.n_loans_returned','d_valuations.n_new_loan','d_valuations.n_seller_discretionary_expend','d_valuations.n_cash_flow_fcfe','d_valuations.n_pv_fcfe','d_valuations.n_seller_discretionary_expend','valuations.depreciation_exist_assets','valuations.depreciation_rate','valuations.total_pv_fcfe')
                        ->join('valuations','valuations.id','=','d_valuations.valuation_id')
                        ->where('d_valuations.valuation_id','=',$getLast->id)
                        ->get();

        
           

        $pdf = PDF::loadview('guest.report.cetak_hasilValuation',['email'=>$email, 'getDetailLast'=>$getDetailLast, 'getLast'=>$getLast]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
    }
}
