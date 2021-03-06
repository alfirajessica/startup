<div class="col-md-12">
    <div class="card px-0 pt-4 pb-0 mt-3 mb-3 border-0">
        <h2><strong>Sign Up Your User Account</strong></h2>
        <p>Fill all form field to go to next step</p>
        <div class="row">
            <div class="col-md-12 mx-0">
                <form id="msform" action="" class="contact-form">
                    <!-- progressbar -->
                    
                    <ul id="progressbar">
                        <li class="active" id="account"><strong>Singkat Produk</strong></li>
                        <li id="personal"><strong>Detail</strong></li>
                        {{-- <li id="pemasukkan"><strong>Pemasukkan</strong></li>
                        <li id="pengeluaran"><strong>Pengeluaran</strong></li> --}}
                    </ul> <!-- fieldsets -->
                        
                    
                    <div class="card-body shadow">
                        
                        <div class="form-section">
                            <h2 class="fs-title">Informasi Produk</h2> 
                            <div class="form-group">
                                <label class="float-left">Nama produk</label>
                                <input type="text" name="nama_produk" id="nama_produk" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId" required>
                                <span class="text-danger error-text nama_produk_error"></span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="float-left">Jenis Produk</label>
                                        <select class="form-control form-control-alternative" name="jenis_produk" id="jenis_produk" onchange="show_detail(this)">
                                            @foreach($list_category as $category)
                                            <option value="{{$category->id}}"> {{$category->name_category}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="float-left">Dalam Kategori</label>
                                        <select class="form-control form-control-alternative" name="detail_kategori" id="detail_kategori">    
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="float-left">Domain Produk</label>
                                        <input type="url" name="url" id="url" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId">
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="float-left">Tanggal Perilisan produk</label>
                                        <input type="date" name="rilis" id="rilis" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId">
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
                            <button type="button" class="previous btn btn-info float-left">Previous</button>
                    
                            <button type="button" class="next btn btn-info float-right">Next</button>
                    
                            <button type="submit" class="btn btn-success float-right">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <form action="" class="contact-form">
    @csrf
    <div class="form-section">
        <h2 class="fs-title">Informasi Produk</h2> 
        <div class="form-group">
            <label class="float-left">Nama produk</label>
            <input type="text" name="nama_produk" id="nama_produk" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId" required>
            <span class="text-danger error-text nama_produk_error"></span>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="float-left">Jenis Produk</label>
                    <select class="form-control form-control-alternative" name="jenis_produk" id="jenis_produk" onchange="show_detail(this)">
                        @foreach($list_category as $category)
                        <option value="{{$category->id}}"> {{$category->name_category}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="float-left">Dalam Kategori</label>
                    <select class="form-control form-control-alternative" name="detail_kategori" id="detail_kategori">    
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="float-left">Domain Produk</label>
                    <input type="url" name="url" id="url" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId">
                    
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="float-left">Tanggal Perilisan produk</label>
                    <input type="date" name="rilis" id="rilis" class="form-control form-control-alternative" placeholder="" aria-describedby="helpId">
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
        <button type="button" class="previous btn btn-info float-left">Previous</button>

        <button type="button" class="next btn btn-info float-right">Next</button>

        <button type="submit" class="btn btn-success float-right">Submit</button>
    </div>
</form> --}}

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    
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

        $('.form-navigation .next').click(function(){
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
    });
</script>