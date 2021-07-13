{{-- cetak detail proyek saja berdasarkan nama proyek --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Detail Startup/Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <img src="{{ public_path("images/Logo-Startupinow-used2.png") }}" width="180" height="50" margin-top="10px" alt="">
    <br>
    <a href="https://startupinow.com/">https://startupinow.com</a> <br>
    <small>Dicetak pada : {{ now()->translatedFormat('d-F-Y h:i') }}</small> <br>
    <h2>Laporan Detail Startup/Produk</h2>
   
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm" width="100%">
            <thead class="thead-dark" style="text-align: center;" >
                
            </thead>
            <tbody>
                @foreach ($detailproyek as $item)
                    <tr>
                        <td>Nama Produk</td>
                        <td>:</td>
                        <td>{{$item->name_product}}</td>
                    </tr>
                    <tr>
                        <td>Kategori</td>
                        <td>:</td>
                        <td>{{$item->name_category}}</td>
                    </tr>
                    <tr>
                        <td>Tipe</td>
                        <td>:</td>
                        <td>{{$item->name}}</td>
                    </tr>
                    <tr>
                        <td>Link</td>
                        <td>:</td>
                        <td>{{$item->url}}</td>
                    </tr>
                    <tr>
                        <td>Rilis</td>
                        <td>:</td>
                        <td>{{ Carbon\Carbon::parse($item->rilis)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td>Gambar</td>
                        <td>:</td>
                        <td> 
                            <img src="{{ public_path("uploads/event/".$item->image) }}" width="250" height="150" margin-top="10px" alt="">
                        </td>
                    </tr>
                    <tr>
                        <td>Deskripsi</td>
                        <td>:</td>
                        <td>{{$item->desc}}</td>
                    </tr>
                    <tr>
                        <td>Tim</td>
                        <td>:</td>
                        <td>{{$item->team}}</td>
                    </tr>
                    <tr>
                        <td>Alasan</td>
                        <td>:</td>
                        <td>{{$item->reason}}</td>
                    </tr>
                    <tr>
                        <td>Manfaat</td>
                        <td>:</td>
                        <td>{{$item->benefit}}</td>
                    </tr>
                    <tr>
                        <td>Solusi</td>
                        <td>:</td>
                        <td>{{$item->solution}}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                
            </tfoot>
        </table>
    </div>
</body>
</html>
