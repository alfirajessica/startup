@extends('layouts.adm')

@section('content')
<div class="container-fluid">
    <div class="row">
      <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-2 px-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card shadow"> <!-- card shadow --> 
                  <div class="table-responsive">
                    <table class="table table-bordered table-hover" width="100%" id="">
                      <thead>
                          <tr>
                              <th>#ID</th>
                              <th>Nama</th>
                              <th>Email</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  <!-- AKHIR TABLE -->
                  </div>
                </div>
            </div>
        </div>
      </main>
    </div>
</div>        


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script>
  
</script>
<script src="/js/admin/inv/investor.js"></script>


@endsection