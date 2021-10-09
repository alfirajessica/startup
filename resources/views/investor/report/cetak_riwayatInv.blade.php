<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Riwayat Investasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
    <img src="{{ public_path("images/Logo-Startupinow-used2.png") }}" width="180" height="50" margin-top="10px" alt="">
    <br>
    <a href="https://startupinow.com/">https://startupinow.com</a> <br>
    <small>Dicetak pada : {{ now()->translatedFormat('d-F-Y h:i') }}</small> <br>
    <h2>Laporan Riwayat Investasi</h2>
    
    @if ($jenislap == 0)
        Laporan ini mencetak semua investasi Anda
    @elseif ($jenislap == 1)
        Laporan ini mencetak semua investasi Anda yang berstatus <strong>Sedang Aktif</strong>
    @elseif ($jenislap == 2)
        Laporan ini mencetak semua investasi berstatus <strong>Gagal/Cancel/Tidak Aktif</strong> <br>
        Dengan ketentuan keterlambatan membayar/dicancel/digagalkan oleh Investor
    @elseif ($jenislap == 3)
        Laporan ini mencetak semua investasi Anda berstatus <strong>Expire</strong> <br>
        Dengan ketentuan investasi telah dinyatakan selesai/berakhir sesuai dengan masa/durasi investasi
    @endif
    <br>
    <div class="alert alert-primary" role="alert">
        *Data pada laporan ini ditampilkan dari <strong>{{ Carbon\Carbon::parse($dateawal)->format('d-M-Y') }}</strong> hingga  
        <strong>{{ Carbon\Carbon::parse($dateakhir)->format('d-M-Y') }}</strong>
    </div>
    @foreach ($countdata as $item)
        Total Data : {{$item->total}}
    @endforeach
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-sm" width="100%">
            <thead class="thead-dark" style="text-align: center;" >
                <tr>
                    <th>#</th>
                    <th>Tanggal Investasi</th>
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
                        <td>{{ Carbon\Carbon::parse($item->created_at)->format('d-M-Y') }} s/d {{ Carbon\Carbon::parse($item->invest_expire)->format('d-M-Y') }}</td>
                        <td>(#{{$item->id}}) {{$item->name_product}}</td>
                        <td style="text-align: right">{{ number_format($item->jumlah_invest, 2, ',', '.') }}</td>
                        <td style="text-align: right">{{ number_format($item->jumlah_final, 2, ',', '.') }}</td>
                        <td style="text-align: center">
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