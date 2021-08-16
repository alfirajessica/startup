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
    else if (idcetak == 2 || idcetak == 3 || idcetak == 4 || idcetak == 6) {
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

    console.log(dateawal);
    if (idcetak == 0) {
        //cetak semua proyek terdaftar
        if (dateawal == "") {
            $('#help_date_awal').text("Tentukan Periode Awal");
        }
        if (dateawal != "") {
            $('#help_date_awal').text("");
        }
        if (dateakhir == "") {
            $('#help_date_akhir').text("Tentukan Periode Akhir");
        }
        if (dateakhir != "") {
            $('#help_date_akhir').text("");
        }
        if (dateawal != "" && dateakhir != "") {
            window.open("/dev/report/cetak_semuaProyek/"+dateawal+"/"+dateakhir+"/"+statusproyek);
        }
        
    }
    else if (idcetak == 1)  {
        //cetak detail      
        window.open("/dev/report/cetak_detailProyek/"+idproyek);
    }
    else if (idcetak == 2)  {
        //cetak transaksi
        if (dateawal == "") {
            $('#help_date_awal').text("Tentukan Periode Awal");
        }
        if (dateawal != "") {
            $('#help_date_awal').text("");
        }
        if (dateakhir == "") {
            $('#help_date_akhir').text("Tentukan Periode Akhir");
        }
        if (dateakhir != "") {
            $('#help_date_akhir').text("");
        }
        if (dateawal != "" && dateakhir != "") {
            window.open("/dev/report/cetak_transProyek/"+dateawal+"/"+dateakhir+"/"+idproyek);
        }
        
    }
    else if (idcetak == 3)  {
        //cetak investor
        if (dateawal == "") {
            $('#help_date_awal').text("Tentukan Periode Awal");
        }
        if (dateawal != "") {
            $('#help_date_awal').text("");
        }
        if (dateakhir == "") {
            $('#help_date_akhir').text("Tentukan Periode Akhir");
        }
        if (dateakhir != "") {
            $('#help_date_akhir').text("");
        }
        if (dateawal != "" && dateakhir != "") {
            window.open("/dev/report/cetak_invProyek/"+dateawal+"/"+dateakhir+"/"+idproyek);
        }
        
    }
    else if (idcetak == 4) {
        //cetak review
        if (dateawal == "") {
            $('#help_date_awal').text("Tentukan Periode Awal");
        }
        if (dateawal != "") {
            $('#help_date_awal').text("");
        }
        if (dateakhir == "") {
            $('#help_date_akhir').text("Tentukan Periode Akhir");
        }
        if (dateakhir != "") {
            $('#help_date_akhir').text("");
        }
        if (dateawal != "" && dateakhir != "") {
            window.open("/dev/report/cetak_reviewProyek/"+dateawal+"/"+dateakhir+"/"+idproyek);
        }
        
    }
    //belum selesai
    else if (idcetak == 5)  {
        //cetak semua detail, transaksi, investor dan review     
        window.open("/dev/report/cetak_allDetailProyek/"+idproyek);
    }
    else if (idcetak == 6) {
        //cetak Penilaian Investasi
        if (dateawal == "") {
            $('#help_date_awal').text("Tentukan Periode Awal");
        }
        if (dateawal != "") {
            $('#help_date_awal').text("");
        }
        if (dateakhir == "") {
            $('#help_date_akhir').text("Tentukan Periode Akhir");
        }
        if (dateakhir != "") {
            $('#help_date_akhir').text("");
        }
        if (dateawal != "" && dateakhir != "") {
            window.open("/dev/report/cetak_penilaianInv/"+dateawal+"/"+dateakhir+"/"+idproyek);
        }
        
    }
    
}

