<div class="card border-0 py-2">
    <div class="card-body shadow">
        <h5>Financial</h5>
        <div class="table-responsive">
            {{-- highchart --}}
            <div id="container" style="width:100%; height:400px;"></div>
            
            <table class="table table-bordered table-hover" width="100%" id="table_finance">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Masuk (Rp)</th>
                    <th>Keluar (Rp)</th>
                    <th>Profit (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($list_finance as $item1)
                <tr>
                    
                    <td id="year"> {{ \Carbon\Carbon::parse($item1->monthDate)->format('M/Y')}}</td>
                    <td id ="revenue"> {{number_format( $item1->total_masuk , 0 , '.' , ',' )}} </td>
                        
                        @forelse ($list_finance_keluar as $item2)
                            <td> {{number_format($item2->total_keluar, 0 , '.' , ',' )}} </td>
                            <td> {{number_format($item1->total_masuk - $item2->total_keluar, 0 , '.' , ',' )}}</td>
                            {{-- jika yang empty adalah pengeluaran --}}
                            @empty
                            <td> 0 </td>
                            <td> {{number_format( $item1->total_masuk , 0 , '.' , ',' )}}</td>
                        @endforelse
                
                @empty
                    {{-- jika yang empty adalah pemasukkan --}}
                    @forelse ($list_finance_keluar as $item2)
                        <td id="year"> {{ \Carbon\Carbon::parse($item2->monthDate)->format('M/Y')}} </td>
                        <td id ="revenue"> 0 </td>
                        <td> {{number_format($item2->total_keluar, 0 , '.' , ',' )}} </td>
                        <td> {{number_format( $item2->total_keluar , 0 , '.' , ',' )}}</td>
                        @empty
                    @endforelse
                </tr> 
                @endforelse 
            </tbody>
            </table>  
            <!-- AKHIR TABLE -->
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