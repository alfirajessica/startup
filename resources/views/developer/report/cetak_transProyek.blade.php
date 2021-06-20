{{-- cetak transaksi proyek pemasukan dan pengeluaran berdasarkan periode, dan nama proyek --}}
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
    <h2>Laporan Transaksi Proyek</h2>

    Laporan ini mencetak data pada
    <div class="row">
        <div class="col-md-4">
            
                <table class="table table-sm table-borderless" >
                    
                    <tbody>
                        @foreach ($detailproyek as $item)
                            <tr>
                               <td>Nama Proyek</td>
                               <td>:</td>
                                <td>{{$item->name_product}}</td>
                            </tr>
                            <tr>
                                <td>Kategori/tipe</td>
                                <td>:</td>
                                <td>{{$item->name_category}}/{{$item->name}}</td>
                            </tr>
                           
                            <tr>
                                <td>Rilis pada</td>
                                <td>:</td>
                                <td>{{ Carbon\Carbon::parse($item->rilis)->format('d-m-Y') }}</td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                    <tfoot>
                        
                    </tfoot>
                </table>
            
        </div>
        <div class="col-md-8"></div>
        
    </div>
    <div class="alert alert-primary" role="alert">
        
        *Data pada laporan ini ditampilkan dari <strong>{{ Carbon\Carbon::parse($dateawal)->format('d-m-Y') }}</strong> hingga  
        <strong>{{ Carbon\Carbon::parse($dateakhir)->format('d-m-Y') }}</strong>
       
    </div>
    
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm" width="100%">
            <thead class="thead-dark" style="text-align: center">
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Tipe</th>
                    <th>Masuk (Rp)</th>
                    <th>Keluar (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($list_kas as $item)
                    <tr>
                        <td style="text-align: center">
                            @if ($item->tipe == "1")
                                +
                            @else
                                -
                            @endif

                        </td>
                        <td>{{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                        <td>{{$item->keterangan}}</td>
                        <td style="text-align: right">
                            @if ($item->tipe == "1")
                                {{ number_format($item->jumlah, 2, ',', '.') }} 
                            
                            @else
                                -
                            @endif
                        </td>
                        <td style="text-align: right">
                            @if ($item->tipe == "2")
                                {{ number_format($item->jumlah, 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5">Tidak ada transaksi</td></tr>
                @endforelse
                
            </tbody>
            <tfoot>
               
                    <tr>
                        <th colspan="3" style="text-align: right">Total</th>
                    
                    @foreach ($table_pemasukkan_inv as $item)
                    
                        <th style="text-align: right">
                            {{ number_format($item->total_masuk, 2, ',', '.') }}
                        </th>
                        
                    @endforeach
                    @foreach ($table_pengeluaran_inv as $item)
                            <th style="text-align: right">{{ number_format($item->total_keluar, 2, ',', '.') }}</th>
                    @endforeach
                    </tr>
                    <tr>
                    <th colspan="4"></th>
                    @foreach ($table_pemasukkan_inv as $item1)
                        @foreach ($table_pengeluaran_inv as $item2)
                                
                            <th style="text-align: right">{{ number_format($item1->total_masuk - $item2->total_keluar , 2, ',', '.') }}</th> 
                        @endforeach
                        
                    @endforeach
                    </tr>
               
            </tfoot>
        </table>
    </div>
</body>
</html>