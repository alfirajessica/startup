<div class="card border-0 py-2">
    <div class="card-body shadow">
        <h5>Financial</h5>
        <div class="table-responsive">
            
            <table class="table table-bordered table-hover" width="100%" id="table_pegawai">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Revenue</th>
                    <th>Cost</th>
                    <th>Profit</th>
                </tr>
            </thead>
            
            <tbody>
               
                <tr>
                    @foreach ($list_finance as $item1)
                    
                    <td> {{ \Carbon\Carbon::parse($item1->monthDate)->format('d/M/Y')}}
                        </td>
                    <td> Rp{{ number_format($item1->total) }}
                        </td>
                    
                        @foreach ($list_finance_keluar as $item2)
                        <td> Rp{{ number_format($item2->total_keluar) }}</td>
                        
                        @endforeach
                        <td> Rp{{number_format($item1->total - $item2->total_keluar)}}</td>
                    @endforeach
                </tr>

                {{-- <tr>
                    @foreach ($query as $item)
                    <td> {{$item->monthDate}}</td>
                    <td> {{$item->total_masuk}}</td>
                    <td> {{$item->total_keluar}}</td>
                    @endforeach
                </tr> --}}
                
            </tbody>
            
            </table>
            
        <!-- AKHIR TABLE -->
        </div>
    </div>
</div>