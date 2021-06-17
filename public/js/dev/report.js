function sesuaikan_cetak() {
    $("#card_laporan").removeClass('d-none');

    var idcetak = $("#pilih_cetaklap").val();
    if (idcetak == 0) {
        $("#pilih_project_cetak").attr('disabled','disabled');
        $("#date_awal , #date_akhir, #status_proyek").removeAttr('disabled');
    }
    else if (idcetak == 1 || idcetak == 5)  {
        $("#date_awal , #date_akhir, #status_proyek").attr('disabled','disabled');
        $("#pilih_project_cetak").removeAttr('disabled');
    }
    else if (idcetak == 2 || idcetak == 3 || idcetak == 4) {
        $("#date_awal , #date_akhir, #pilih_project_cetak").removeAttr('disabled'); 
        $("#status_proyek").attr('disabled','disabled');
        
    }
}

function cetak_laporanProyek() {
    var idcetak = $("#pilih_cetaklap").val();
    var dateawal = $("#date_awal").val();
    var dateakhir = $("#date_akhir").val();
    var statusproyek = $("#status_proyek").val();
    var idproyek = $("#pilih_project_cetak").val();

    if (idcetak == 0) {
        //cetak semua proyek terdaftar
        window.open("/dev/report/cetak_semuaProyek/"+dateawal+"/"+dateakhir+"/"+statusproyek);
    }
    else if (idcetak == 1)  {
        //cetak detail      
        window.open("/dev/report/cetak_detailProyek/"+idproyek);
    }
    else if (idcetak == 2)  {
        //cetak transaksi
        window.open("/dev/report/cetak_transProyek/"+dateawal+"/"+dateakhir+"/"+idproyek);
    }
    else if (idcetak == 3)  {
        //cetak investor
        window.open("/dev/report/cetak_invProyek/"+dateawal+"/"+dateakhir+"/"+idproyek);
    }
    else if (idcetak == 4) {
        //cetak review
        window.open("/dev/report/cetak_reviewProyek/"+dateawal+"/"+dateakhir+"/"+idproyek);
    }
    //belum selesai
    else if (idcetak == 5)  {
        //cetak semua detail, transaksi, investor dan review     
        window.open("/dev/report/cetak_allDetailProyek/"+idproyek);
    }
    
}

