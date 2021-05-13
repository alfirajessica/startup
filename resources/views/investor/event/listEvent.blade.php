
@include('investor.event.editEvent')
@include('investor.event.detailEvent')
<div class="row py-4">
    <div class="col">
      <div class="table-responsive">
          <table class="table table-bordered table-hover" width="100%" id="table_listEvent">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Event</th>
                    <th>Diadakan Secara</th>
                    <th>Jadwal Acara</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
          </table>
        <!-- AKHIR TABLE -->
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.js"></script>      

<script>

    const url_listEvent = "{{ route('inv.listEvent') }}";

    const url_detailEvent = "{{ route('inv.listEvent') }}" +'/editEvent' + '/';

    const url_editProduct = "{{ route('inv.listEvent') }}" +'/editEvent' + '/';

    const url_deleteEvent = "{{ route('inv.listEvent') }}"+'/deleteEvent' + '/';
</script>
<script src="/js/inv/event.js"></script>