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
    <h2>Daftar Participant</h2>

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
                                {{$item->link}}
                            @else
                                {{$item->held}} <br>
                                {{$item->province_name}}, {{$item->city_name}}<br>
                                {{$item->address}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Pada</td>
                        <td>:</td>
                        <td>{{ Carbon\Carbon::parse($item->event_schedule)->format('d-m-Y') }}/{{ Carbon\Carbon::parse($item->event_time)->format('h:i:s') }}</td>
                    </tr>
                    
                @endforeach
              
            </tbody>
        </table>
    </div>

    @foreach ($count_join as $item)
        Jumlah participant join : {{$item->total_join}}
    @endforeach
    <br>
    @foreach ($count_bataljoin as $item)
        Jumlah participant batal join : {{$item->total_bataljoin}}
    @endforeach
   
    <br>
   
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm" width="100%">
            <thead class="thead-dark" style="text-align: center;" >
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Asal</th>
                    <th>Status Participant</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($list_participant as $item)
                    
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->province_name}}, {{$item->city_name}}</td>
                        <td>
                            @if ($item->status == 0)
                                Batal Join
                            @else
                                Join
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