(function($) {
   // $('select').attr('id', 'select');
   $('select').prev('label').addClass('select');
   $('input[type="number"]').attr('id', 'inputnumber');
   $('input[type="number"]').prev('label').addClass('inputnumber111');
   $('.box-body input.form-control').addClass('floatLabel');
   $('textarea.form-control').addClass('floatLabel');



})(jQuery);

   /* the main sidebar related to expand on hover for sidebar mini  */

$(document).ready(function () {
    $(".main-sidebar").hover(function () {
        $(this).css('width', '230px');
        $('.content-wrapper').css('margin-left', '230px');
        $(".sidebar-form").fadeIn(500);
        $(".sidebar-menu>li.header").fadeIn(500);
        $(".sidebar-menu li>a>span").fadeIn(500);
        $(".fa-angle-left").fadeIn(500);
    }, function () {
        $(this).css('width', '50px');
        $('.content-wrapper').css('margin-left', '50px');
        $(".sidebar-form").fadeOut(300);
        $(".sidebar-menu>li.header").fadeOut(300);
        $(".sidebar-menu li>a>span").fadeOut(300);
        $(".fa-angle-left").fadeOut(300);
    });
    
    
});
  /* End of the main sidebar related to expand on hover for sidebar mini  */
  
  /* when (body) has class (fixed) */
  if($("body").hasClass("fixed")) {
        $(".main-sidebar").css("padding-top", "70px");
        $(".content-header").css("padding-top", "25px");
    }
  
(function($) {



   /* FloatLabel function
   *( to keep the label floating when inputText have value.) */
   function floatLabel(inputType) {

      $(".box-body " + inputType).each(function() {
         var $this = $(this);
         var text_value = $(this).val();

         // on focus add class "active" to label
         $this.focus(function() {
            $this.next().addClass("active");
         });

         // on blur check field and remove class if needed
         $this.blur(function() {
            if ($this.val() === '' || $this.val() === 'blank') {
               $this.next().removeClass();
            }
         });

         // Check input values on postback and add class "active" if value exists
         if (text_value != '') {
            $this.next().addClass("active");
         }
      });

      // Automatically remove floatLabel class from select input on load
      $("select").next().removeClass();
   }
   // Add a class of "floatLabel" to the input field
   floatLabel(".floatLabel");
//   $("side")
   /* End of FloatLabel function
   ======================================================*/

   /* hide the (.sidebar-form) & (.sidebar-menu>li.header) &(.fa-angle-left:before)  */

//   if($(".main-sidebar").css("width", "37px") && $(".content-wrapper").css("margin-left", "37px")) {
//      $(".sidebar-form").css("display", "none");
      // $(".sidebar-menu>li.header").css("display", "none");
      // $(".fa-angle-left:before").css("display", "none");
//   }
//   else if($(".main-sidebar").css("width", "230px") && $(".content-wrapper").css("margin-left", "230px")) {
//      $(".sidebar-form").css("display", "block");
      // $(".sidebar-menu>li.header").css("display", "block");
      // $(".fa-angle-left:before").css("display", "block");

//   }

})(jQuery);
