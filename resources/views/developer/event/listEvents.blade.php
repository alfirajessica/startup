{{-- menampilkan event baru, dan event yang sebentar lagi tutup --}}
<section class="pt-2 pb-5">
    <div class="container">
        {{-- row event baru --}}
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col py-2">
              <div class="card shadow border-0 h-100">
                <img
                  src="https://mdbootstrap.com/img/new/standard/city/041.jpg"
                  class="card-img-top"
                  alt="..."
                />
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">
                    This is a longer card with supporting text below as a natural lead-in to
                    additional content. This content is a little bit longer.
                  </p>
                  <a href="{{ route('dev.event.detailsEvent')}}" class="btn btn-primary">Detail Event</a>
                </div>
              </div>
            </div>
            <div class="col py-2">
              <div class="card shadow border-0 h-100">
                <img
                  src="https://mdbootstrap.com/img/new/standard/city/042.jpg"
                  class="card-img-top"
                  alt="..."
                />
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">This is a short card.</p>
                </div>
              </div>
            </div>
            <div class="col py-2">
              <div class="card shadow border-0 h-100">
                <img
                  src="https://mdbootstrap.com/img/new/standard/city/043.jpg"
                  class="card-img-top"
                  alt="..."
                />
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">
                    This is a longer card with supporting text below as a natural lead-in to
                    additional content.
                  </p>
                </div>
              </div>
            </div>
            <div class="col py-2">
              <div class="card shadow border-0 h-100">
                <img
                  src="https://mdbootstrap.com/img/new/standard/city/044.jpg"
                  class="card-img-top"
                  alt="..."
                />
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">
                    This is a longer card with supporting text below as a natural lead-in to
                    additional content. This content is a little bit longer.
                  </p>
                </div>
              </div>
            </div>
          </div>
        {{-- end of row event baru --}}

    </div>
</section>