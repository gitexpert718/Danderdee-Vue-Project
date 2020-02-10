$(document).ready(function () {
/*$("#logo").velocity("callout.bounce")}, 500);
$("#objective")
.velocity({ left: 150 }, 800, "easeOutQuad")
  .velocity({ left: 0 }, 950, "easeInSine")
    .velocity({scale:1.25}, 200)
    .velocity({scale:1.00}, 200);

$(".bigthings")
.velocity({scale:1.5}, 1500)
.velocity({scale:1.75}, 1750)
.velocity({scale:1.5}, 2500);

$("#logo").hover(function () {
$("#logo").velocity("callout.shake")}, 1000);
*/

$("#band1").delay(200).velocity({opacity: 1, fill: '#34AFE4'}, {loop: true, delay: 3000})
$("#band2").delay(450).velocity({opacity: 1, fill: '#34AFE4'}, {loop: true, delay: 3000})
$("#band3").delay(700).velocity({opacity: 1, fill: '#34AFE4'}, {loop: true, delay: 3000});

$("#band1b").delay(200).velocity({opacity: 1, fill: '#34AFE4'}, {loop: true, delay: 3000})
$("#band2b").delay(450).velocity({opacity: 1, fill: '#34AFE4'}, {loop: true, delay: 3000})
$("#band3b").delay(700).velocity({opacity: 1, fill: '#34AFE4'}, {loop: true, delay: 3000});

  $(".btn-dead").velocity({ opacity: 0.5 }, 2000);

  $(".btn-bounce").velocity("callout.pulse", 2000);
  $(".btn-bounce").velocity("callout.pulse", 2000);
  $(".btn-bounce").velocity("callout.pulse", 2000);


$( ".btn-bounce" ).click(function() {
  $(".btn-bounce").velocity("reverse", true)
  $(".btn-bounce").velocity("finish", true)
});


});



/*
$("#fillerdiv")
.velocity("callout.bounce", 500);
*/
/*
$(".intro-header")
.velocity({ left: 150 }, 3000, "easeOutQuad")
  .velocity({ left: 0 }, 4500, "easeInSine")
    .velocity({scale:1.05}, 1750)
    .velocity({delay: 100}, 4250)
    .velocity({scale:1.03}, 1750);
    */