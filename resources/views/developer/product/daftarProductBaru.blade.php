<style>
    .scroll {
    max-height: 400px;
    overflow-y: auto;
  }
  </style>
<div class="col-md-12">
    <h4><strong>Daftarkan Startup/Produk Baru Saya</strong></h4>
        <small class="text-dark">Isi semua form untuk ke halaman selanjutnya</small>

    <form id="msform" action="{{ route('dev.product.addNewProduct')}}" method="POST" class="contact-form" novalidate>
            @csrf
            <ul id="progressbar" class="d-flex justify-content-center" style="margin-bottom: revert;">
                <li class="active" id="account"><strong>Singkat Produk</strong></li>
                <li class="" id="personal"><strong>Deskripsikan</strong></li>
                <li class="" id="proposal"><strong>Unggah File</strong></li>
            </ul>

        <div class="card shadow px-2 py-2 pb-0 mb-3 border-0 text-dark">
            
            <div class="row text-dark">
                <div class="col-md-12 mx-0">
                    <!-- fieldsets -->
                            
                            <div class="form-section text-dark">
                                <div class="form-group">
                                    <label class="float-left">Masukkan Nama Startup/Produk</label>
                                    <input type="text" name="nama_produk" id="nama_produk" class="form-control form-control-alternative" aria-describedby="nama_produk_error" required data-parsley-error-message="Nama proyek belum terisi">
                                    <span class="text-danger error-text nama_produk_error" id="nama_produk_error"></span>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="float-left">Kategori</label>
                                            <select class="form-control form-control-alternative text-dark" name="jenis_produk" id="jenis_produk" onchange="show_detail(this)" required data-parsley-error-message="pilih jenis proyek">
                                                @foreach($list_category as $category)
                                                <option value="{{$category->id}}"> {{$category->name_category}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger error-text jenis_produk_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="float-left">Subkategori</label>
                                            <select class="form-control form-control-alternative text-dark" name="detail_kategori" id="detail_kategori" required data-parsley-error-message="Pilih kategori proyek">    
                                            </select>
                                            <span class="text-danger error-text detail_kategori_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="float-left">Startup Tag (Label)</label>
                                            <select class="form-control form-control-alternative text-dark" name="hstartupTag_produk" id="hstartupTag_produk" onchange="show_subStartupTag(this)" required data-parsley-error-message="Pilih Startup Tag">
                                                @foreach($list_hStartupTag as $hStartupTag)
                                                <option value="{{$hStartupTag->id}}"> {{$hStartupTag->name_startup_tag}}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger error-text hstartupTag_produk_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="float-left">Sub tag (Sublabel)</label>
                                            <select class="form-control form-control-alternative text-dark" name="subTag_produk" id="subTag_produk" required data-parsley-error-message="Pilih Sub Tag">    
                                            </select>
                                            <span class="text-danger error-text subTag_produk_error"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="float-left">Domain/Url Produk</label>
                                            <input type="url" name="url" id="url" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId" required data-parsley-error-message="Domain proyek belum terisi">
                                            <span class="text-danger error-text url_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="float-left">Tanggal Perilisan produk</label>
                                            <input type="date" name="rilis" id="rilis" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId" required data-parsley-error-message="Tanggal rilis proyek belum terisi">
                                            <span class="text-danger error-text rilis_error"></span>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        
                            <div class="form-section">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label class="float-left">Deskripsikan Startup/Produk Anda</label>
                                        <textarea class="form-control form-control-alternative" name="desc" id="" rows="3" required data-parsley-error-message="Deskripsikan Startup/produk anda"></textarea>
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="float-left">Siapa saja yang ada didalam Tim Anda</label>
                                        <textarea class="form-control form-control-alternative" name="team" id="" rows="3" required data-parsley-error-message="Siapa saja yang ada pada tim Anda"></textarea>
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="float-left">Alasan Anda membuat Startup/produk ini</label>
                                        <textarea class="form-control form-control-alternative" name="reason" id="" rows="3" required data-parsley-error-message="Sebutkan Alasan Anda membuat Startup/produk ini"></textarea>
                                    </div>
                                
                                    <div class="form-group">
                                        <label class="float-left">Manfaat yang akan diperoleh pengguna maupun investor</label>
                                        <textarea class="form-control form-control-alternative" name="benefit" id="" rows="3" required data-parsley-error-message="Manfaat yang akan diperoleh pengguna maupun investor"></textarea>
                                    </div>
                                
                                    <div class="form-group d-none" >
                                        <label class="float-left">Solusi yang anda tawarkan</label>
                                        <textarea class="form-control form-control-alternative" name="solution" id="" rows="3">-</textarea>
                                    </div>
                                
                                </div> 
                            </div>

                            <div class="form-section">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <label for="exampleInputFile">Banner/Gambar Pendukung Startup</label>
                                                <input type="file" class="form-control-file form-control-alternative"  name="image" id="exampleInputFile" aria-describedby="fileHelp" onchange="previewFile(this)">
                                                <span class="text-danger error-text image_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <a href="#" id="pop">
                                            <img id="previewImg" style="max-width: 200px; margin-top:0px" src="">
                                            </a>  
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" >
                                            <div class="input-group">
                                                <label>Unggah Proposal Startup</label>
                                                <input type="file" class="form-control-file form-control-alternative"  name="proposal_startup" id="proposal_startup" aria-describedby="fileHelp">
                                                <span class="text-danger error-text proposal_startup_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" >
                                            <div class="input-group">
                                                <label>Unggah Kontak Kerjasama</label>
                                                <input type="file" class="form-control-file form-control-alternative"  name="kontrak_startup" id="kontrak_startup"  aria-describedby="fileHelp">
                                                <span class="text-danger error-text kontrak_startup_error"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="form-navigation">
                                <button type="button" class="previous btn btn-warning float-left mx-2 my-0" >Sebelumnya</button>
                        
                                <button type="button" class="next btn btn-default float-right"> Lanjutkan isi detail </button>
                        
                                <button type="submit" class="btn btn-default float-right" >Simpan Startup ini</button>
                            </div>

                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      

<script>
   
    //call function show_listProject_select di /js/dev/listproduct.js
    //menampilkan id-nama proyek di Pemasukkan dan Pengeluaran
    const url_show_listProject_select = "listProject/select";
    

    $(function(){
        var $section = $('.form-section');

        function navigateTo(index){
            $section.removeClass('current').eq(index).addClass('current');
            $('.form-navigation .previous').toggle(index>0);

            var atTheEnd = index >= $section.length -1;
            $('.form-navigation .next').toggle(!atTheEnd);
            $('.form-navigation [type=submit]').toggle(atTheEnd);
        }

        function curIndex() {  
            return $section.index($section.filter('.current'));

        }

        $('.form-navigation .previous').click(function(){
            navigateTo(curIndex()-1);
            $("#progressbar li").eq($(".form-section").index(curIndex()-1)).removeClass("active"); 
        });

       
        $('.form-navigation .next').click(function(e){
            
            $('.contact-form').parsley().whenValidate({
                group:'block-' + curIndex()
                //$(".parsley-required").text('ok');
     
            }).done(function(){
                navigateTo(curIndex()+1);
                $("#progressbar li").eq($(".form-section").index(curIndex()+1)).addClass("active"); 
     
            })
            
        });

        $section.each(function(index, section){
            $(section).find(':input').attr('data-parsley-group','block-'+index);
        });

        navigateTo(0);

        $('#msform').submit(function (e) { 
            e.preventDefault();
            
            swal({
                text: "Yakin ingin Menyimpan Startup/Produk Ini?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url:$(this).attr('action'),
                        method:$(this).attr('method'),
                        data:new FormData(this),
                        processData:false,
                        dataType:'json',
                        contentType:false,
                        beforeSend:function() {
                            $(document).find('span.error-text').text('');
                        },
                        success:function(data) {
                            if (data.status == 0) {
                                $.each(data.error, function (prefix, val) {
                                    $('span.'+prefix+'_error').text(val[0]);
                                // $(".parsley-required").html('ok');
                                });
                            }
                            else{
                            //update yang di page akun depan
                                $('#msform')[0].reset();
                                $("#previewImg").attr("src", '{{asset('images')}}');
                                table_listProduct();
                                show_listProject_select();
                                navigateTo(0);
                                swal("Berhasil Menyimpan Startup/Produk Anda, Silakan Atur Kas Masuk dan Keluar Pada Tab yang Disediakan", {
                                    icon: "success",
                                });
                                $("a#v-pills-home-tab").removeClass('active');
                                $("div#v-pills-home").removeClass('show active');

                                $("a#v-pills-profile-tab").addClass('active');
                                $("div#v-pills-profile").addClass('show active');
                            }
                        }
                    });
                } else {
                }
            });
           
            
        });

    });
</script>
