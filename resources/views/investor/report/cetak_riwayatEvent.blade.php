<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Riwayat Event</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <img src="{{ public_path("images/Logo-Startupinow-used2.png") }}" width="180" height="50" margin-top="10px" alt="">
    <br>
    <a href="https://startupinow.com/">https://startupinow.com</a> <br>
    <small>Dicetak pada : {{ now()->translatedFormat('d-F-Y h:i') }}</small> <br>
    <h2>Laporan Event</h2>
   
    Laporan ini mencetak data Event 
    @if ($jenisEvent == 0)
        <strong> {{$jenisEvent}}</strong> dengan status
    @else
        <strong> {{$jenisEvent}}</strong> dengan status
    @endif
    
    
    @if ($statusEvent == 0)
        <strong>Aktif, Tidak aktif, Selesai</strong>
    @elseif ($statusEvent == 1)
        <strong>Aktif</strong>
    @elseif ($statusEvent == 2)
        <strong>Selesai</strong>
    @elseif ($statusEvent == 4)
        <strong>Tidak aktif</strong>
    @endif
    <br>
    Data yang dimuat pada laporan ini adalah data pada periode 
        <strong>{{ Carbon\Carbon::parse($dateawal)->format('d-M-Y') }}</strong> hingga 
        <strong>{{ Carbon\Carbon::parse($dateakhir)->format('d-M-Y') }}</strong>

    <br>
    <br>
    @foreach ($countdata as $item)
    Total Data : {{$item->total}}
    @endforeach
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm" width="100%">
            <thead class="thead-dark" style="text-align: center;" >
                <tr>
                    <th>#</th>
                    <th>Event</th>
                    <th>Tgl/Jam</th>
                    <th>Diadakan Secara</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list_event as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{ Carbon\Carbon::parse($item->event_schedule)->format('d-M-Y') }}/{{ Carbon\Carbon::parse($item->event_time)->format('h:i') }}</td>
                        <td>
                                {{$item->held}}
                            @if ($item->held == "Online")
                                <br>
                                <label>{{$item->link}}</label>
                            @else
                                <br>
                                <label>{{$item->province_name}}, {{$item->city_name}}, {{$item->address}}</label>
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