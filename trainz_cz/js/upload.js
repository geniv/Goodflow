  (function($) {
    $(document).ready(function() {
      $(".div-validate form").validate({
        errorPlacement: function(error, element) {
        },
        invalidHandler: function(form, validator) {
          if($.fn.effect) {
            $(".form-group").effect("shake", {distance: 6, times: 2}, 35);
          }
        }
      });
      $('.form-control').popover({trigger: 'focus', html: true});
    });
  }) (jQuery);
