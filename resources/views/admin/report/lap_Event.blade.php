{{-- cetak detail proyek saja berdasarkan nama proyek --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
        .table td, .table th
  {
    white-space: initial;
  }
    </style>
</head>
<body>
    <img src="{{ public_path("images/Logo-Startupinow-used2.png") }}" width="180" height="50" margin-top="10px" alt="">
    <br>
    <a href="https://startupinow.com/">https://startupinow.com</a> <br>
    <small>Dicetak pada : {{ now()->translatedFormat('d-F-Y h:i') }}</small> <br>
    <h2>Laporan Event Terdaftar</h2>
    <br>
    Data yang dimuat pada laporan ini adalah data pada periode 
        <strong>{{ Carbon\Carbon::parse($dateawal)->translatedFormat('d-F-Y') }}</strong> hingga 
        <strong>{{ Carbon\Carbon::parse($dateakhir)->translatedFormat('d-F-Y') }}</strong>

    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm" max-width="100%">
            <thead class="thead-dark" style="text-align: center;" >
                <tr>

                    <th>Dev Email</th>
                    <th>Event</th>
                    <th>Jadwal</th>
                    <th>Held</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detaiListEvent as $item)
                    <tr>
                        <td>{{$item->email}}</td>
                        <td>{{$item->name}}</td>
                        <td>Tanggal : <br>{{ Carbon\Carbon::parse($item->event_schedule)->translatedFormat('d-F-Y') }} <br> 
                        Waktu : <br>{{ Carbon\Carbon::parse($item->event_time)->translatedFormat('h:i') }} </td>
                        <td>
                                {{$item->held}}
                            @if ($item->held == "Online")
                                <br>
                                <small style="white-space: initial;word-wrap: break-word;"><a href="{{$item->link}}">{{$item->link}}</a></small>
                            @else
                                <br>
                                <label>{{$item->province_name}}, {{$item->city_name}}</label>
                            @endif
                            
                        </td>
                        <td>
                            @if ($item->status == 1)
                                Aktif
                            @elseif($item->status == 2)
                                Selesai
                            @elseif($item->status == 4)
                                Tidak Aktif
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
