@guest
    @include('index')
    @else 
        @if (Auth::user()->role ==1 )
            @include('layouts.dev')

        @elseif(Auth::user()->role ==2)
            @include('layouts.inv')
        @endif     
@endguest

<style>
    .content-wrapper {
 
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-pack: center;
  -webkit-justify-content: center;
      -ms-flex-pack: center;
          justify-content: center;
  text-align: center;
  -webkit-flex-flow: column nowrap;
      -ms-flex-flow: column nowrap;
          flex-flow: column nowrap;
  color: #fff;
  font-family: Montserrat;
  text-transform: uppercase;
  -webkit-transform: translateY(40vh);
      -ms-transform: translateY(40vh);
          transform: translateY(40vh);
  will-change: transform;
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  -webkit-transition: all 1.7s cubic-bezier(0.22, 0.44, 0, 1);
          transition: all 1.7s cubic-bezier(0.22, 0.44, 0, 1);
}
    .content-title {
  font-size: 14pt;
  line-height: 1.4;
}


</style>

<section class="bg-primary" style="min-height: 100vh; min-width: auto">
    <div class="content-wrapper">
        <h2>Oke</h2>
        {{-- <p class="content-title">Full Page Parallax Effect</p> --}}
        <p class="content-subtitle">
          <span class="scroll-btn">
            <div class="scroll-to-next-section">
                <button class="btn btn-info"><i class="fas fa-chevron-down fa-lg"></i></button>
            </div>
          </span>
          
          </p>
      </div>
    
</section>
<section style="height: 100vh">
    <div class="col-md-12 py-6">
        <div class="row">
           
        </div>
    </div>
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div class="card">
                   <h4>Business value</h4>
                   <a href="#" target="_blank">Lihat lampiran</a>
                </div>
                
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row ">
            <div class="col-md-6">
                <div class="card border-0" style="background-color: #f7f3e9">
                    <div class="card-body">
                        <div class="accordion indicator-plus-before round-indicator" id="accordionH" aria-multiselectable="true">
                            <div class="card m-b-0">
                                <div class="card-header collapsed" role="tab" id="headingOneH" href="#collapseOneH" data-toggle="collapse" data-parent="#accordionH" aria-expanded="false" aria-controls="collapseOneH">
                                    <a class="card-title">What is your favorite color?</a>
                                </div>
                                <div class="collapse show" id="collapseOneH" role="tabpanel" aria-labelledby="headingOneH">
                                    <div class="card-body">
                                        Blue! No, Red!
                                    </div>
                                </div>
                                <div class="card-header collapsed" role="tab" id="headingTwoH" href="#collapseTwoH" data-toggle="collapse" data-parent="#accordionH" aria-expanded="false" aria-controls="collapseTwoH">
                                    <a class="card-title">Who is your daddy, and what does he do?</a>
                                </div>
                                <div class="collapse" id="collapseTwoH" role="tabpanel" aria-labelledby="headingTwoH">
                                    <div class="card-body">
                                        <img src="https://image.ibb.co/iMh9FF/XtHQKml.gif" alt="Who your daddy is?">
                                    </div>
                                </div>
                                <div class="card-header collapsed" role="tab" id="headingThreeH" href="#collapseThreeH" data-toggle="collapse" data-parent="#accordionH" aria-expanded="false" aria-controls="collapseThreeH">
                                    <a class="card-title">What is the meaning of life the universe and everything?</a>
                                </div>
                                <div class="collapse" id="collapseThreeH" role="tabpanel" aria-labelledby="headingThreeH">
                                    <div class="card-body">
                                        The number <code>42</code>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0" style="background-color: #f7f3e9">
                    <div class="card-body">
                        <div class="accordion indicator-plus-before round-indicator" id="accordionH" aria-multiselectable="true">
                            <div class="card m-b-0">
                                <div class="card-header collapsed" role="tab" id="headingOneH" href="#collapseOneH" data-toggle="collapse" data-parent="#accordionH" aria-expanded="false" aria-controls="collapseOneH">
                                    <a class="card-title">What is your favorite color?</a>
                                </div>
                                <div class="collapse" id="collapseOneH" role="tabpanel" aria-labelledby="headingOneH">
                                    <div class="card-body">
                                        Blue! No, Red!
                                    </div>
                                </div>
                                <div class="card-header collapsed" role="tab" id="headingTwoH" href="#collapseTwoH" data-toggle="collapse" data-parent="#accordionH" aria-expanded="false" aria-controls="collapseTwoH">
                                    <a class="card-title">Who is your daddy, and what does he do?</a>
                                </div>
                                <div class="collapse" id="collapseTwoH" role="tabpanel" aria-labelledby="headingTwoH">
                                    <div class="card-body">
                                        <img src="https://image.ibb.co/iMh9FF/XtHQKml.gif" alt="Who your daddy is?">
                                    </div>
                                </div>
                                <div class="card-header collapsed" role="tab" id="headingThreeH" href="#collapseThreeH" data-toggle="collapse" data-parent="#accordionH" aria-expanded="false" aria-controls="collapseThreeH">
                                    <a class="card-title">What is the meaning of life the universe and everything?</a>
                                </div>
                                <div class="collapse" id="collapseThreeH" role="tabpanel" aria-labelledby="headingThreeH">
                                    <div class="card-body">
                                        The number <code>42</code>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="row mx-3">
            <div class="col-md-12 px-2">
                <button type="submit" class="btn btn-primary">Hitung</button>
            </div>
            
        </div>
    </div>
   
    
</section>

 <script>
     if($('.scroll-to-next-section').length>0) {
   $(".scroll-to-next-section button").click(function () {
      $('html, body').animate({
         scrollTop: $(this).closest("section").next().offset().top
      }, "slow");
   });
}
 </script>