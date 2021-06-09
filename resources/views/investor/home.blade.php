
@extends('layouts.inv')
<link href="/css/parallax.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>      

<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.10.1/lodash.min.js"></script>

<script>
var ticking = false;
var isFirefox = (/Firefox/i.test(navigator.userAgent));

var scrollSensitivitySetting = 30; // Increase/decrease to change sensitivity to trackpad gestures (up = less sensitive; down = more sensitive) 

var slideDurationSetting = 600; 
// Amount of time for which slide is "locked"

var currentSlideNumber = 0;

var totalSlideNumber = $(".background").length;


function parallaxScroll(evt) {
  if (isFirefox) {
    // Set delta for Firefox
    delta = evt.detail * (-120);
  } else {
    // Set delta for all other browsers
    delta = evt.wheelDelta;
  }

  if (ticking != true) {
    if (delta <= -scrollSensitivitySetting) {
      //Down scroll
      ticking = true;
      if (currentSlideNumber !== totalSlideNumber - 1) {
        currentSlideNumber++;
        nextItem();
      }
      slideDurationTimeout(slideDurationSetting);
    }
    if (delta >= scrollSensitivitySetting) {
      //Up scroll
      ticking = true;
      if (currentSlideNumber !== 0) {
        currentSlideNumber--;
      }
      previousItem();
      slideDurationTimeout(slideDurationSetting);
    }
  }
}


function slideDurationTimeout(slideDuration) {
  setTimeout(function() {
    ticking = false;
  }, slideDuration);
}

// Event listeners
var mousewheelEvent = isFirefox ? "DOMMouseScroll" : "wheel";
window.addEventListener(mousewheelEvent, _.throttle(parallaxScroll, 60), false);

// Slide motion
function nextItem() {
  var $previousSlide = $(".background").eq(currentSlideNumber - 1);
  $previousSlide.removeClass("up-scroll").addClass("down-scroll");
}

function previousItem() {
  var $currentSlide = $(".background").eq(currentSlideNumber);
  $currentSlide.removeClass("down-scroll").addClass("up-scroll");
}
 const url_eventPassed = @json(route('eventPassed'));
 const url_updStatusTrans = @json(route('updStatus'));
</script>
<script src="js/custom.js"></script>
