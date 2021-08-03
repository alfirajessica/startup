@extends('layouts.adm')

@section('content')
<div class="container">
    <div class="py-4"></div>
    <div class="row py-5"> <!-- row untuk header categoryProduct -->
        <div class="col-md-12">
            <div class="card-body text-dark">
                <form action="{{ route('admin.akun.akunUpdate')}}" method="POST" enctype="multipart/form-data" id="updateAkun">
                    @csrf
                    @foreach ($detail_admin as $item)
                        <div class="form-group">
                            <label for="email_admin">Email</label>
                            <input type="text" class="form-control form-control-alternative text-dark" id="email_admin" aria-describedby="email_adminHelp" disabled value="{{$item->email}}">
                        </div>
        
        
                        <div class="form-group">
                            <label for="nama_admin">Nama</label>
                            <input type="text" class="form-control form-control-alternative text-dark" id="nama_admin" name="nama_admin" aria-describedby="nama_adminHelp" placeholder="Nama Anda" value="{{$item->name}}">
                        
                        </div>
                    @endforeach
                    <button class="btn btn-default float-right" type="submit">Simpan Perubahan</button>
                </form>
            </div>
            
        </div>
    </div><!-- end of row untuk header categoryProduct -->


</div> 
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script>
    $("#pengaturan_akun").addClass('active');

    $("#updateAkun").on("submit",function (e) {
        e.preventDefault();
       
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
                    swal({
                        title: data.msg,
                        text: "You clicked the button!",
                        icon: "success",
                        button: "Aww yiss!",
                    });
                   
                }
            }
        });
    });
</script>
@endsection

