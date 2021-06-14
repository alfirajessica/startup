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
    <h2>Laporan Investasi</h2>
    <small>Dicetak pada : {{ Carbon\Carbon::parse($date)->format('d-m-Y h:i:s') }}</small> <br>
    @if ($jenislap == 0)
        Laporan ini mencetak semua investasi Anda
    @elseif ($jenislap == 1)
        Laporan ini mencetak semua investasi Anda yang berstatus <strong>Sedang Aktif</strong>
    @elseif ($jenislap == 2)
        Laporan ini mencetak semua investasi berstatus <strong>Gagal/Cancel</strong> <br>
        Dengan ketentuan keterlambatan membayar/dicancel/digagalkan oleh Investor
    @elseif ($jenislap == 3)
        Laporan ini mencetak semua investasi Anda berstatus <strong>Expire</strong> <br>
        Dengan ketentuan investasi telah dinyatakan selesai/berakhir sesuai dengan masa/durasi investasi
    @endif
    <br>
    Data yang dimuat pada laporan ini adalah data pada periode 
        <strong>{{ Carbon\Carbon::parse($dateawal)->format('d-m-Y') }}</strong> hingga 
        <strong>{{ Carbon\Carbon::parse($dateakhir)->format('d-m-Y') }}</strong>

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
                    <th>Tanggal</th>
                    <th>Produk</th>
                    <th>Investasi Awal (Rp)</th>
                    <th>Investasi final (- Fee 1%) (Rp)</th>
                    <th>Status Investasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list_inv as $item)
                    <tr>
                        <td>#{{$item->invest_id}}</td>
                        <td>{{ Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }} s/d {{ Carbon\Carbon::parse($item->invest_expire)->format('d-m-Y') }}</td>
                        <td>(#{{$item->id}}) {{$item->name_product}}</td>
                        <td style="text-align: right">{{ number_format($item->jumlah_invest, 2, ',', '.') }}</td>
                        <td style="text-align: right">{{ number_format($item->jumlah_final, 2, ',', '.') }}</td>
                        <td>
                            {{-- status_invest -- 0(Menunggu konfirmasi admin), (1-aktif invst/dikonfirmasi), (2-tdk aktif oleh inv), 4(tdk aktif krna gagal byr/cancle/expire), 5 (investasi sudah expire) --}}
                            @if ($item->status_invest == 0)
                                Belum dikonfirmasi
                            @elseif ($item->status_invest == 1)
                                Aktif
                            @elseif ($item->status_invest == 2 || $item->status_invest == 4)
                                Tidak Aktif
                            @elseif ($item->status_invest == 5)
                                Expire
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