{{-- cetak investor berdasarkan periode dan nama proyek yang dipilih --}}

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
                    <th>Investor</th>
                    <th>Masa berakhir</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listInvestor as $item)
                    <tr>
                        <td>{{$item->invest_id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{ Carbon\Carbon::parse($item->invest_expire)->format('d-m-Y') }}</td>
                        <td>{{ number_format($item->jumlah_final, 2, ',', '.') }} </td>
                        <td>
                            @if ($item->status_invest == 5)
                                Berakhir
                            @elseif ($item->status_invest == 1)
                                Aktif
                            @elseif ($item->status_invest == 4)
                                Dicancel/dibatalkan
                            @else
                                Menunggu Konfirmasi
                            @endif
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>