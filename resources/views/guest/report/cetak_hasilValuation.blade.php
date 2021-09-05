<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <h6>Business Valuation Report</h6>
    <small>*Mata uang yang digunakan adalah Rupiah</small>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm" width="100%">
            <thead class="thead-dark" style="text-align: center;font-size: 10pt" >
                <tr>
                    <th>Ket</th>
                    @foreach ($getDetailLast as $item)
                        <th>{{$item->name_year}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody style="font-size: 10pt">
                <tr>
                    <td>Sales Forecast</td>
                     @foreach ($getDetailLast as $item)
                         <td style="text-align: right">{{ number_format($item->n_sales_forecast, 2, ',', '.') }}</td>
                     @endforeach
                 </tr>
                <tr>
                   <td>Profit Forecast</td>
                    @foreach ($getDetailLast as $item)
                        <td style="text-align: right">{{ number_format($item->n_profit_forecast, 2, ',', '.') }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Current Assets</td>
                    @foreach ($getDetailLast as $item)
                        <td style="text-align: right">{{ number_format($item->n_current_assets, 2, ',', '.') }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Current liablities</td>
                    @foreach ($getDetailLast as $item)
                        <td style="text-align: right">{{ number_format($item->n_current_liabilities, 2, ',', '.') }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Working capital</td>
                    @foreach ($getDetailLast as $item)
                        <td style="text-align: right">{{ number_format($item->n_working_capital, 2, ',', '.') }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Change in working capital</td>
                    @foreach ($getDetailLast as $item)
                        <td style="text-align: right">{{ number_format($item->n_change_working_capital, 2, ',', '.')}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Depreciation on existing assets</td>
                    @foreach ($getDetailLast as $item)
                        <td style="text-align: right">{{ number_format($item->depreciation_exist_assets, 2, ',', '.')}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Purchase of new fixed assets</td>
                    @foreach ($getDetailLast as $item)
                        <td style="text-align: right">{{ number_format($item->n_purchase_new_assets, 2, ',', '.')}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Depreciation rate</td>
                    @foreach ($getDetailLast as $item)
                        <td style="text-align: right">{{$item->depreciation_rate}}%</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Depreciation on [new] assets</td>
                    @foreach ($getDetailLast as $item)
                        <td style="text-align: right">{{ number_format($item->n_depreciation_new_assets, 2, ',', '.')}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Loans returned</td>
                    @foreach ($getDetailLast as $item)
                        <td style="text-align: right">{{ number_format($item->n_loans_returned, 2, ',', '.')}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>New loans taken</td>
                    @foreach ($getDetailLast as $item)
                        <td style="text-align: right">{{ number_format($item->n_new_loan, 2, ',', '.')}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Seller's discretionary expenditure</td>
                    @foreach ($getDetailLast as $item)
                        <td style="text-align: right">{{ number_format($item->n_seller_discretionary_expend, 2, ',', '.')}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Free cash flow to equity</td>
                    @foreach ($getDetailLast as $item)
                        <td style="text-align: right">{{ number_format($item->n_cash_flow_fcfe, 2, ',', '.')}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Present Value of FCFE</td>
                    @foreach ($getDetailLast as $item)
                        <td style="text-align: right">{{ number_format($item->n_pv_fcfe, 2, ',', '.')}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Total present value of FCFE</td>
                    <td></td>
                    <td colspan="5">{{ number_format($getLast->total_pv_fcfe, 2, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>Terminal Value</td>
                    <td></td>
                    
                    <td colspan="5" style="text-align: right">{{ number_format($getLast->terminal_value, 2, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>Present value of terminal value</td>
                    <td></td>
                    <td colspan="5">{{ number_format($getLast->pv_terminal_value, 2, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>Business value</td>
                    <td></td>
                    <td colspan="5">{{ number_format($getLast->business_value, 2, ',', '.')}}</td>
                </tr>
            </tbody>
            <tfoot>
                
            </tfoot>
        </table>
    </div>
</body>
</html>