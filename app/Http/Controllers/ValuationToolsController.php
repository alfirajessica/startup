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

class ValuationToolsController extends Controller
{
    public function valuation()
    {
        return view('guest.valTools');
    }

    public function addnew(Request $req)
    {
        $user = auth()->user();
        
        
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
                
                $val_details->n_sales_forecast = 0; //TIDAK PAKAI SALES
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
              
                $val_details->n_sales_forecast = 0;
                $val_details->n_profit_forecast = $value->net_profit + ($value->net_profit * $value->growth_rate/100);
                $val_details->n_current_assets = $value->current_assets + ($value->current_assets * $value->growth_rate/100);
                $val_details->n_current_liabilities = $value->current_liabilities + ($value->current_liabilities * $value->growth_rate/100);
                $val_details->n_working_capital = $value->working_capital + ($value->working_capital * $value->growth_rate/100);
                
                $val_details->n_change_working_capital = ($value->working_capital + ($value->working_capital * $value->growth_rate/100))-$value->working_capital;

                $profit = $value->net_profit + ($value->net_profit * $value->growth_rate/100); 
                $changein = ($value->working_capital + ($value->working_capital * $value->growth_rate/100))-$value->working_capital;
                $depExtAsset = $value->depreciation_exist_assets;
                $purNewAsset = (int)Str::replaceArray(',', ['', ''], $req->n_purchase_new_assets_[$i]);
                $depNewAsset0 = ($purNewAsset * $value->depreciation_rate);
                $depNewAsset = $depNewAsset0 + ($purNewAsset * $value->depreciation_rate) ; //WAIT
                $loanre = (int)Str::replaceArray(',', ['', ''], $req->n_loans_returned_[$i]);
                $newLoan = (int)Str::replaceArray(',', ['', ''], $req->n_new_loan_[$i]);
                $sde = 0;

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
        
    }
}
