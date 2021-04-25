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
                <tr>
                    @foreach ($list_finance as $item1)
                    <td id="year"> {{ \Carbon\Carbon::parse($item1->monthDate)->format('M/Y')}}</td>
                    <td id="revenue"> {{number_format( $item1->total_masuk , 0 , '.' , ',' )}} </td>
                      @foreach ($list_finance_keluar as $item2)
                      <td> {{number_format($item2->total_keluar, 0 , '.' , ',' )}} </td>
                      @endforeach
                    <td> {{number_format($item1->total_masuk - $item2->total_keluar, 0 , '.' , ',' )}}</td>
                    @endforeach
                </tr>
            </tbody>
            </table>  
            <!-- AKHIR TABLE -->
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://code.highcharts.com/highcharts.js"></script>
{{-- semua function ini ada pada /js/inv/startup.js --}}
<script src="/js/inv/startup.js"></script>