 /*--------------------------------------PRELOADER------------------------------------------*/
 (function($) {
    "use strict";
    $(window).on("load", function() { // Launched onload
        //preloader
        $("#status").fadeOut(); // Fade out animation
        $("#preloader").delay(450).fadeOut("slow");

        //masonry
        $('.grid').masonry({
            itemSelector: '.grid-item'

        });
    });

})(jQuery);
/*--------------------------------------./PRELOADER------------------------------------------*/


var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
        panel.style.maxHeight = null;
    } else {
        panel.style.maxHeight = panel.scrollHeight + "px";
    } 
    });
}



