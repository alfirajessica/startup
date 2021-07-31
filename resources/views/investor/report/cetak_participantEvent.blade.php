<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daftar Peserta Event</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <img src="{{ public_path("images/Logo-Startupinow-used2.png") }}" width="180" height="50" margin-top="10px" alt="">
    <br>
    <a href="https://startupinow.com/">https://startupinow.com</a> <br>
    <small>Dicetak pada : {{ now()->translatedFormat('d-F-Y h:i') }}</small> <br>
    <h2>Daftar Peserta Event</h2>
    <div class="col-md-4">
        <table class="table table-sm padding-0 table table-borderless" width="100%" id="table_detailOrder">
            <tbody>
                @foreach ($detail as $item)
                    <tr>
                        <td>Nama Event</td>
                        <td>:</td>
                        <td>{{$item->name}}</td>
                    </tr>
                    <tr>
                        <td>Diadakan secara</td>
                        <td>:</td>
                        <td>
                            @if ($item->held == "Online")
                                {{$item->held}} <br>
                                <small style="white-space: initial;word-wrap: break-word;"><a href="{{$item->link}}">{{$item->link}}</a></small>
                            @else
                                {{$item->held}} <br>
                                {{$item->province_name}}, {{$item->city_name}}, 
                                {{$item->address}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Pada</td>
                        <td>:</td>
                        <td>{{ Carbon\Carbon::parse($item->event_schedule)->translatedFormat('d-F-Y') }}/{{ Carbon\Carbon::parse($item->event_time)->translatedFormat('h:i') }}</td>
                    </tr>
                    
                @endforeach
              
            </tbody>
        </table>
    </div>

    @foreach ($count_join as $item)
        Jumlah Peserta Bergabung : {{$item->total_join}} Peserta
    @endforeach
    
    <br>
   
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm" width="100%">
            <thead class="thead-dark" style="text-align: center;" >
                 <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Nama</th>
                    <th>Asal Provinsi</th>
                    <th>Asal Kota</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list_participant as $item)
                    
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->province_name}}</td>
                        <td>
                            {{$item->city_name}}
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