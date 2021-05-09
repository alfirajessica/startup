<div class="col-md-12">
    <div class="card px-2 py-2 pb-0 mb-3 border-0">
        <h4><strong>Daftarkan Proyek Baru Saya</strong></h4>
        <p>Isi semua form untuk ke halaman selanjutnya</p>
        <div class="row">
            <div class="col-md-12 mx-0">
                <form id="msform" action="{{ route('dev.product.addNewProduct')}}" method="POST" class="contact-form" novalidate>
                    @csrf
                    <!-- progressbar -->
                    
                    <ul id="progressbar" class="d-flex justify-content-center">
                        <li class="active" id="account"><strong>Singkat Produk</strong></li>
                        <li id="personal"><strong>Detail</strong></li>
                        
                    </ul> <!-- fieldsets -->
                        
                        <div class="form-section">
                            <h2 class="fs-title">Informasi Proyek</h2> 
                            <div class="form-group">
                                <label class="float-left">Nama Proyek</label>
                                
                                <input type="text" name="nama_produk" id="nama_produk" class="form-control form-control-alternative" aria-describedby="nama_produk_error" placeholder="Nama proyek" required>
                                <span class="text-danger error-text nama_produk_error" id="nama_produk_error"></span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="float-left">Jenis Produk</label>
                                        <select class="form-control form-control-alternative" name="jenis_produk" id="jenis_produk" onchange="show_detail(this)" required>
                                            @foreach($list_category as $category)
                                            <option value="{{$category->id}}"> {{$category->name_category}}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error-text jenis_produk_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="float-left">Dalam Kategori</label>
                                        <select class="form-control form-control-alternative" name="detail_kategori" id="detail_kategori" required>    
                                        </select>
                                        <span class="text-danger error-text detail_kategori_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="float-left">Domain Produk</label>
                                        <input type="url" name="url" id="url" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId" required>
                                        <span class="text-danger error-text url_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="float-left">Tanggal Perilisan produk</label>
                                        <input type="date" name="rilis" id="rilis" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId" required>
                                        <span class="text-danger error-text rilis_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="exampleInputFile">File input</label>
                                    <input type="file" class="form-control-file"  name="image" id="exampleInputFile" aria-describedby="fileHelp" onchange="previewFile(this)">
                                    <span class="text-danger error-text image_error"></span>
                                </div>
                            </div>
                    
                            <div class="form-group">
                                <a href="#" id="pop">
                                <img id="previewImg" style="max-width: 250px; margin-top:20px" src="{{asset('images')}}">
                                </a>  
                            </div>
                        </div>
                    
                        <div class="form-section">
                            <div class="form-group">
                                <h2 class="fs-title">Detail Informasi Produk</h2> 
                                <div class="form-group">
                                    <label class="float-left">Deskripsikan produk anda</label>
                                    <textarea class="form-control form-control-alternative" name="desc" id="" rows="3"></textarea>
                                </div>
                            
                                <div class="form-group">
                                    <label class="float-left">Siapa saja yang ada didalam Tim anda</label>
                                    <textarea class="form-control form-control-alternative" name="team" id="" rows="3"></textarea>
                                </div>
                            
                                <div class="form-group">
                                    <label class="float-left">Alasan kenapa Anda membutuhkan investor</label>
                                    <textarea class="form-control form-control-alternative" name="reason" id="" rows="3"></textarea>
                                </div>
                            
                                <div class="form-group">
                                    <label class="float-left">Keuntunggan yang akan diperoleh investor</label>
                                    <textarea class="form-control form-control-alternative" name="benefit" id="" rows="3"></textarea>
                                </div>
                            
                                <div class="form-group">
                                    <label class="float-left">Solusi yang anda tawarkan</label>
                                    <textarea class="form-control form-control-alternative" name="solution" id="" rows="3"></textarea>
                                </div>
                            
                            </div> 
                        </div>
                    
                        <div class="form-navigation">
                            <button type="button" class="previous btn btn-info float-left">Sebelumnya</button>
                    
                            <button type="button" class="next btn btn-info float-right">Selanjutnya</button>
                    
                            <button type="submit" class="btn btn-success float-right">Submit</button>
                        </div>
                    {{-- </div> --}}
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      

<script>
    // if ($('#nama_produk').val() == "") {
    //     $('#nama_produk_error').html('Nama produk belum diisi');
    // }
    // else if ($('#detail_kategori').selected() == -1) {
    //     $('#detail_kategori_error').html('Nama produk belum diisi');
    // }

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
            console.log(e);
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
                    });
                }
                else{
                //update yang di page akun depan
                    $('#msform')[0].reset();
                    $("#previewImg").attr("src", '{{asset('images')}}');
                    table_listProduct();
                    show_listProject_select();
                    navigateTo(0);
                    swal({
                        title: data.msg,
                        text: "Silakan masukkan detail informasi terkai pemasukkan dan pengeluaran proyek pada tab Pemasukkan dan Pengeluaran!",
                        icon: "success",
                        button: "OK!",
                    });
                
                }
            }
        });
        });

    });
</script>
<script src="/js/dev/listproduct.js"></script>