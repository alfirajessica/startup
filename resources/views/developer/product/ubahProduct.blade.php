
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="detailProduct2">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
            <div class="col-md-11">
                <div class="nav-wrapper">
                    <!-- tabs -->
                    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Deskripsi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Transaksi</a>
                        </li>
                    </ul>
                </div>
            </div>
        
            <div class="col-md-1">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <!-- tab content -->
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                            
                            
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                            <div class="row">
                                <div class="col-md-12 mx-0">
                                    <form id="msform" class="contact-form">
                                        @csrf
                                        <!-- progressbar -->
                                        
                                        <ul id="progressbar">
                                            <li class="active" id="account"><strong>Singkat Produk</strong></li>
                                            <li id="personal"><strong>Detail</strong></li>
                                            
                                        </ul> <!-- fieldsets -->
                                            
                                            <div class="form-section">
                                                <h2 class="fs-title">Informasi Produk</h2> 
                                                <div class="form-group">
                                                    <label class="float-left">Nama produk</label>
                                                    <input type="text" name="nama_produk" id="nama_produk" class="form-control form-control-alternative" aria-describedby="nama_produk_error" required>
                                                    <span class="text-danger error-text nama_produk_error"></span>
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
                </div>
            </div>
        </div>
      </div>
    </div>
</div>


