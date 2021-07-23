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
    <h2>Laporan Developer dan Startup Terbaik</h2>
    <br>
    Data yang dimuat pada laporan ini adalah data pada periode 
        <strong>{{ Carbon\Carbon::parse($dateawal)->translatedFormat('d-F-Y') }}</strong> hingga 
        <strong>{{ Carbon\Carbon::parse($dateakhir)->translatedFormat('d-F-Y') }}</strong>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm" width="100%">
            <thead class="thead-dark" style="text-align: center;" >
                <tr>
                    <th>Developer</th>
                    <th>Produk</th>
                    <th>Rating</th>
                    <th>Review</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detailbestDev as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->name_product}}</td>
                        <td style="text-align:center">
                            {{$item->rate}}/5        
                        </td>
                        <td>{{$item->ulasan}} Ulasan</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                
            </tfoot>
        </table>
    </div>
</body>
</html>
