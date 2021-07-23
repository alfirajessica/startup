{{-- cetak detail proyek saja berdasarkan nama proyek --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <img src="{{ public_path("images/Logo-Startupinow-used2.png") }}" width="180" height="50" margin-top="10px" alt="">
    <br>
    <a href="https://startupinow.com/">https://startupinow.com</a> <br>
    <small>Dicetak pada : {{ now()->translatedFormat('d-F-Y h:i') }}</small> <br>
    <h2>Laporan Transaksi Investasi</h2>
    <br>
    Data yang dimuat pada laporan ini adalah data pada periode 
        <strong>{{ Carbon\Carbon::parse($dateawal)->translatedFormat('d-F-Y') }}</strong> hingga 
        <strong>{{ Carbon\Carbon::parse($dateakhir)->translatedFormat('d-F-Y') }}</strong>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm" width="100%">
            <thead class="thead-dark" style="text-align: center;" >
                <tr>
                    <th>#Id</th>
                    <th>Durasi Invest</th>
                    <th>Investor</th>
                    <th>Produk</th>
                    <th>Jumlah Tf</th>
                    <th>Jumlah Invest</th>
                    <th>Status Transaction</th>
                    <th>status_invest</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detailTransInv as $item)
                    <tr>
                        <td>#{{$item->invest_id}}</td>
                        <td>{{ Carbon\Carbon::parse($item->created_at)->translatedFormat('d-F-Y')}} s/d {{ Carbon\Carbon::parse($item->invest_expire)->translatedFormat('d-F-Y') }}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->name_product}}</td>
                        <td style="text-align: right">{{ number_format($item->jumlah_invest, 2, ',', '.') }}</td>
                        <td style="text-align: right">{{ number_format($item->jumlah_final, 2, ',', '.') }}</td>
                        <td>{{$item->status_transaction}}</td>
                        <td>{{-- status_invest -- 0(Menunggu konfirmasi admin), (1-aktif invst/dikonfirmasi), (2-tdk aktif oleh inv), 4(tdk aktif krna gagal byr/cancle/expire), 5 (investasi sudah expire) --}}
                            @if ($item->status_invest == 0)
                                Belum dikonfirmasi
                            @elseif ($item->status_invest == 1)
                                Aktif
                            @elseif ($item->status_invest == 2 || $item->status_invest == 4)
                                Tidak Aktif
                            @elseif ($item->status_invest == 5)
                                Expire
                            @endif</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                
            </tfoot>
        </table>
    </div>
</body>
</html>
