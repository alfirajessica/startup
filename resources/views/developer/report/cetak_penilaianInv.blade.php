{{-- cetak review pada proyek berdasarkan periode dan nama proyek --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Review Startup/Produk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/shared.css">
</head>
<body>
    <img src="{{ public_path("images/Logo-Startupinow-used2.png") }}" width="180" height="50" margin-top="10px" alt="">
    <br>
    <a href="https://startupinow.com/">https://startupinow.com</a> <br>
    <small>Dicetak pada : {{ now()->translatedFormat('d-F-Y h:i') }}</small> <br>
    <h2>Laporan Penilaian Investasi</h2>

    Laporan ini mencetak perolehan penilaian investasi oleh Investor pada data
    <div class="row">
        <div class="col-md-4">
            
                <table class="table table-sm table-borderless" >
                    
                    <tbody>
                        @foreach ($detailproyek as $item)
                            <tr>
                               <td>Nama Startup/Produk</td>
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
                    <th>#IdInvestasi</th>
                    <th>Tanggal Penilaian</th>
                    <th>Investor</th>
                    <th>Startup</th>
                    <th>Rating & Review</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($listreviews as $item)
                    <tr>
                        <td>#{{$item->id_Hinvest}}</td>
                        <td>{{ Carbon\Carbon::parse($item->created_at)->translatedFormat('d-m-Y') }}</td>
                        <td><label>{{$item->name_company}} <br> {{$item->name}} </label></td>
                        <td>{{$item->name_product}}</td>
                        <td>
                            Rating : {{$item->rating}}/5
                        <br>
                            Review : {{$item->review}}
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5">Tidak ada Penilaian</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>