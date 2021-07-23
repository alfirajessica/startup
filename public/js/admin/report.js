function sesuaikan_cetak() { 
    var idcetak = $("#pilih_cetaklap").val();
    var dateawal = $("#date_awal").val();
    var dateakhir = $("#date_akhir").val();

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

        window.open("/admin/report/laporan/"+dateawal+"/"+dateakhir+"/"+idcetak);
    }
 }