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
    <h2>Laporan Keuangan Startup</h2>
    <table class="table table-sm padding-0 table table-borderless" width="100%" id="table_detailOrder">
        <tbody>
            @foreach ($detail as $item)
                <tr>
                    <td>Proyek</td>
                    <td>: {{$item->name_product}}</td>
                    <td style="text-align: right">Masa Investasi</td>
                    <td>: {{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }} s/d {{ Carbon\Carbon::parse($item->invest_expire)->format('d-m-Y') }}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Tipe</td>
                    <td>: {{$item->name}}</td>
                    <td style="text-align: right">Jumlah Investasi sebelum fee</td>
                    <td>: Rp{{ number_format($item->jumlah_invest, 2, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Developer</td>
                    <td>: {{$item->nama_dev}}</td>
                    <td style="text-align: right">Investasi Final</td>
                    <td>: Rp{{ number_format($item->jumlah_final, 2, ',', '.') }} <br> ( - Fee 1% : {{ number_format($item->jumlah_invest - $item->jumlah_final, 2, ',', '.') }})</td>
                </tr>
                <tr>
                    
                </tr>
            @endforeach
          
        </tbody>
    </table>
    <br>
    <div class="alert alert-primary" role="alert">
        @foreach ($detail as $item)
        *Data pada laporan ini ditampilkan dari <strong>{{ Carbon\Carbon::parse($item->created_at)->format('m-Y') }}</strong> hingga  
        <strong>{{ Carbon\Carbon::parse($item->invest_expire)->format('m-Y') }}</strong>
        @endforeach
    </div>
    <br>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm" width="100%">
            <thead class="thead-dark" style="text-align: center">
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Tipe</th>
                    <th>Masuk (Rp)</th>
                    <th>Keluar (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list_kas as $item)
                    <tr>
                        <td>
                            @if ($item->tipe == "1")
                                +
                            @else
                                -
                            @endif

                        </td>
                        <td>{{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                        <td>{{$item->keterangan}}</td>
                        <td style="text-align: right">
                            @if ($item->tipe == "1")
                                {{ number_format($item->jumlah, 2, ',', '.') }} 
                            
                            @else
                                -
                            @endif
                        </td>
                        <td style="text-align: right">
                            @if ($item->tipe == "2")
                                {{ number_format($item->jumlah, 2, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" style="text-align: right">Total</th>
                    {{-- <th></th>
                    <th></th> --}}
                @foreach ($table_pemasukkan_inv as $item)
                    
                        <th style="text-align: right">
                            {{ number_format($item->total_masuk, 2, ',', '.') }}
                        
                        </th>
                        
                @endforeach
                @foreach ($table_pengeluaran_inv as $item)
                    
                        <th style="text-align: right">{{ number_format($item->total_keluar, 2, ',', '.') }}</th>
                        
                @endforeach
                </tr>
                <tr>
                    <th colspan="4"></th>
                    
                    @foreach ($table_pemasukkan_inv as $item1)
                        @foreach ($table_pengeluaran_inv as $item2)
                                
                            <th style="text-align: right">{{ number_format($item1->total_masuk - $item2->total_keluar , 2, ',', '.') }}</th>
                            
                    @endforeach
                        
                @endforeach
                
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>