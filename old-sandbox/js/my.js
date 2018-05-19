      $(document).ready(function() {
        Cufon.replace('#obal_obsah #zahlavi ul li a strong, #obal_obsah #zahlavi ul li a em', { fontFamily: 'Museo' });
        Cufon.replace('#obal_obsah #zahlavi ul li a', { fontFamily: 'Museo', textShadow: '1px 1px #000', hover: true });
        var rand = ["41.png","55.png","17.png","56.png","24.png","2.png","95.png"];
          for (var key in rand) {
          $(".kod_"+ (parseInt(key) + 1)).css("background-image","url({$weburl}"+rand[key]+")");
        }
      //<![CDATA[
        var div_height = $("#obal_obsah").height();
        var ucinnost = "#obal_reference, #obal_o_nas, #obal_kontakt, #obal_blog, #obal_vyvoj";
        //alert(div_height);
        if (div_height <= 699) {
          $(ucinnost).addClass("h0-699");
          //console.log("1.");
        }
        if (div_height >= 700 && div_height <= 829) {
          $(ucinnost).addClass("h700-829");
          //console.log("2.");
        }
        if (div_height >= 830 && div_height <= 1209) {
          $(ucinnost).addClass("h830-1209");
          //console.log("3.");
        }
        if (div_height >= 1210 && div_height <= 1649) {
          $(ucinnost).addClass("h1210-1649");
          //console.log("4.");
        }
        if (div_height >= 1650) {
          $(ucinnost).addClass("h1650-n");
          //console.log("5.");
        }
      //]]>
        //console.log(div_height);
      });
      $(document).ready(function() {
        Cufon.replace('#obsah_reference .polozka .nazev_reference h2', { fontFamily: 'mwp', hover: true });
        Cufon.replace('#obsah_reference #strankovani #urceni_strany a.cisla_stranek, #obsah_reference #strankovani #urceni_strany span', { fontFamily: 'Museo', hover: true });
        //<![CDATA[
          $('#obsah_reference .polozka .obal_slide').each(function(i) {
            var poc = $(this).find('.highslide').length;
            var $this = $(this).after('<span class="ikony_slide nav_slide_'+i+'"></span>').find('.slide').after(poc > 1 ? '<a href="#" class="prev_slide prevslide'+i+'" title="Předchozí">Předchozí náhled</a>' : '').after(poc > 1 ? '<a href="#" class="next_slide nextslide'+i+'" title="Následující">Následující náhled</a>' : '');
            $this.cycle({
              fx: 'turnLeft',
              speed: 900,
              timeout: 0,
              pager: '.nav_slide_'+i,
              prev: '.prevslide'+i,
              next: '.nextslide'+i,
              easing: 'easeOutBounce'
            });
          });
        //]]>
      });
      hs.graphicsDir = '{$weburl1}';
      var config = new Array();
      //<![CDATA[
        for (var i = 0; i < 5; i++) {
          hs.addSlideshow({
            slideshowGroup: 'group'+i,
            interval: 5000,
            repeat: false,
            useControls: true,
            fixedControls: 'fit',
            overlayOptions: {
              className: 'large-dark',
              opacity: 0.6,
              position: 'bottom center',
              offsetX: 0,
              offsetY: -15,
              hideOnMouseOut: true
            }
          });
          config[i] = {
            slideshowGroup: 'group'+i,
            numberPosition: 'caption',
            transitions: ['expand', 'crossfade']
          }
        }
      //]]>