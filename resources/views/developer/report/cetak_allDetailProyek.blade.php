{{-- cetak semua detail proyek berdasarkan nama proyek --}}

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
    <h2>Laporan Proyek</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm" width="100%">
            <thead class="thead-dark" style="text-align: center;" >
                
            </thead>
            <tbody>
                @foreach ($detailproyek as $item)
                    <tr>
                        <td>Nama Proyek</td>
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
                        <td style="text-align: center">
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
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm" width="100%">
            <thead class="thead-dark" style="text-align: center">
                <tr>
                    <th>#</th>
                    <th>Investor</th>
                    <th>Masa berakhir</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listInvestor as $item)
                    <tr>
                        <td>{{$item->invest_id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{ Carbon\Carbon::parse($item->invest_expire)->format('d-m-Y') }}</td>
                        <td>{{ number_format($item->jumlah_final, 2, ',', '.') }} </td>
                        <td>
                            @if ($item->status_invest == 5)
                                Berakhir
                            @elseif ($item->status_invest == 1)
                                Aktif
                            @elseif ($item->status_invest == 4)
                                Dicancel/dibatalkan
                            @else
                                Menunggu Konfirmasi
                            @endif
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm" width="100%">
            <thead class="thead-dark" style="text-align: center">
                <tr>
                    <th>#</th>
                    <th>Tanggal</th>
                    <th>Investor</th>
                    <th>Rating & Review</th>
                   
                </tr>
            </thead>
            <tbody>
                @foreach ($listreviews as $item)
                    <tr>
                        <td style="text-align: center">#{{$item->id}}</td>
                        <td>{{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                        <td>{{$item->name}}</td>
                        <td>
                            Rating : {{$item->rating}}/5
                           <br>
                            Review : {{$item->isi_review}}
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>