{{-- cetak detail proyek saja berdasarkan nama proyek --}}

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
    <img src="{{ public_path("images/Logo-Startupinow-used2.png") }}" width="180" height="50" margin-top="10px" alt="">
    <br>
    <a href="https://startupinow.com/">https://startupinow.com</a> <br>
    <small>Dicetak pada : {{ now()->translatedFormat('d-F-Y h:i') }}</small> <br>
    <h2>Laporan Pemasukkan</h2>
   
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm" width="100%">
            <thead class="thead-dark" style="text-align: center;" >
                <tr>
                    <th>#Id</th>
                    <th>Investor</th>
                    <th>Produk</th>
                    <th>Jumlah Masuk (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detailTransInv as $item)
                    <tr>
                        <td>#{{$item->invest_id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->name_product}}</td>
                        <td style="text-align: right">{{ number_format($item->jumlah_invest-$item->jumlah_final, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" style="text-align: right">Total Pemasukkan</th>
                @foreach ($getPendapatan as $item)
                    
                        <th style="text-align: right">
                            {{ number_format($item->total_masuk, 2, ',', '.') }}
                        
                        </th>
                        
                @endforeach
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>
