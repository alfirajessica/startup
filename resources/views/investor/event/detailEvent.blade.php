<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="detailEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detail Event</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="">
            @csrf
            <div class="row">
                <div class="col md-8">
                    <div class="card border-0">
                        <div class="card-body">
                            <input type="text" id="coba_id2" name="coba_id2" />
                            <h5 class="card-title" id="title_detailevent" ></h5>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="d-block user-select-none" width="100%" height="200" aria-label="Placeholder: Image cap" focusable="false" role="img" preserveAspectRatio="xMidYMid slice" viewBox="0 0 318 180" style="font-size:1.125rem;text-anchor:middle">
                        <rect width="100%" height="100%" fill="#868e96"></rect>
                        <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text>
                        </svg>
                        <div class="card-body">
                            <p id="desc_detailevent" class="card-text"></p>
                        </div>
                    </div>
                </div>

                <div class="col md-4">
                    <div class="card border-0">
                        <div class="card-body shadow">
                            <h5>Event Info</h5>

                            <div class="row">
                                <div class="col-12">
                                    <h5 id="held_detailEvent"></h5>
                                </div>
                            </div>

                            <div class="row d-none" id="row_link">
                                <div class="col-12">
                                    <i class="fas fa-external-link-alt"></i> 
                                    <a href="" id="link_detailEvent"></a>
                                </div>
                            </div>

                            <div class="row d-none" id="row_loc">
                                <div class="col-12">
                                    <i class="fas fa-map-marker-alt"></i> 
                                    <label id="loc_detailEvent"></label> <br>
                                    <label id="add_detailEvent"></label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <i class="fas fa-calendar-alt "></i> 
                                    <label id="date_detailEvent">  </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <i class="fas fa-clock"></i>
                                    <label id="time_detailEvent"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
      </div>
    </div>
</div>

<script>

function held_detailEvent() {
    var event_held = $("#held_detailEvent").text(); 
   
    if (event_held == "Online") {
        document.querySelector('#row_link').classList.remove('d-none');
        document.querySelector('#row_loc').classList.add('d-none');
        
    }
    else if (event_held == "Offline") {
        document.querySelector('#row_link').classList.add('d-none');
        document.querySelector('#row_loc').classList.remove('d-none');
    }
}
</script>