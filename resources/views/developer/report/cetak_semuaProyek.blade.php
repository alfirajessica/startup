{{-- cetak semua proyek terdaftar berdasrkan periode, dansattus proyek--}}

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
    <h2>Laporan Semua Proyek Terdaftar</h2>
    @if ($statusproyek == 0)
        Laporan ini mencetak semua proyek Anda dengan status <strong> Aktif, Tidak aktif, memiliki investor </strong> <br>
    @elseif($statusproyek == 1)
        Laporan ini mencetak semua proyek Anda dengan status proyek <strong> Aktif </strong> <br>
    @elseif($statusproyek == 2)
        Laporan ini mencetak semua proyek Anda dengan status proyek <strong> Memiliki investor </strong> <br>
    @elseif($statusproyek == 3)
        Laporan ini mencetak semua proyek Anda dengan status proyek <strong> Tidak aktif </strong> <br>
    @endif
    
    Data yang dimuat pada laporan ini adalah data pada periode 
        <strong>{{ Carbon\Carbon::parse($dateawal)->format('d-m-Y') }}</strong> hingga 
        <strong>{{ Carbon\Carbon::parse($dateakhir)->format('d-m-Y') }}</strong>

    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm" width="100%">
            <thead class="thead-dark" style="text-align: center;" >
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Kategori/Tipe</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listproyek as $item)
                    <tr>
                        <td>#{{$item->id}}</td>
                        <td>{{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y h:i:s') }}</td>
                        <td>{{$item->name_product}}</td>
                        <td>{{$item->name_category}}/{{$item->name}}</td>
                        <td>
                            @if ($item->status == 1)
                                Aktif
                            @elseif($item->status == 2)
                                Memiliki Investor
                            @elseif($item->status == 3)
                                Tidak aktif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                
            </tfoot>
        </table>
    </div>
</body>
</html>