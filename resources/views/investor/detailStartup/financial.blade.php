<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="financial-tab" data-toggle="tab" href="#financial" role="tab" aria-controls="financial" aria-selected="true">Financial</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="financial" role="tabpanel" aria-labelledby="financial-tab">
        <div class="card shadow border-0 py-2">
            <div class="card-body">
                <div class="table-responsive">
                    {{-- highchart --}}
                    <div id="container" style="width:100%; height:400px;"></div>
                    
                    <table class="table table-bordered table-hover table-sm text-dark" width="100%" id="table_finance">
                    <thead>
                        <tr>
                            <th>Bulan/Tahun</th>
                            <th>Masuk (Rp)</th>
                            <th>Keluar (Rp)</th>
                            <th>Profit (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list_finance as $item1)
                            @foreach ($list_finance_keluar as $item2)
                            @if ($item1->monthDate == $item2->monthDate)
                            <tr>
                                <td id="year"  style="text-align: center;"> {{ \Carbon\Carbon::parse($item1->monthDate)->format('M/Y')}}</td>
                                <td id ="revenue" style="text-align: right;"> {{number_format( $item1->total_masuk , 0 , '.' , ',' )}} </td>
                                <td id ="keluar" style="text-align: right;"> {{number_format( $item2->total_keluar , 0 , '.' , ',' )}} </td>
                                <td id ="profit" style="text-align: right;"> {{number_format($item1->total_masuk - $item2->total_keluar, 0 , '.' , ',' )}}</td>                               
                            </tr> 
                            @endif
                            @endforeach
                        @endforeach 
                    </tbody>
                    </table>  
                    <!-- AKHIR TABLE -->
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://code.highcharts.com/highcharts.js"></script>
{{-- semua function ini ada pada /js/inv/startup.js --}}
<script>
     var id = {{ Request::route('id')}};
     console.log(id);
     const url_table_finance = id;
     console.log(url_table_finance);
</script> 
<script src="/js/inv/startup.js"></script>