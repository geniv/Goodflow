$.fn.rb_menu = function(options) {
  var $self = this;

  $self.options = {
    // transitions: http://gsgd.co.uk/sandbox/jquery/easing/
    // jakym stylem prijede (In), jakym stylem odjede (Out)
      // jswing, def
      // easeInQuad, easeOutQuad, easeInOutQuad
      // easeInCubic, easeOutCubic, easeInOutCubic
      // easeInQuart, easeOutQuart, easeInOutQuart
      // easeInQuint, easeOutQuint, easeInOutQuint
      // easeInSine, easeOutSine, easeInOutSine
      // easeInExpo, easeOutExpo, easeInOutExpo
      // easeInCirc, easeOutCirc, easeInOutCirc
      // easeInElastic, easeOutElastic, easeInOutElastic
      // easeInBack, easeOutBack, easeInOutBack
      // easeInBounce, easeOutBounce, easeInOutBounce
    // vychozi hodnoty
    transitionIn: 'easeOutBounce',
    transitionOut: 'easeOutBounce',
    // z kama prijede (In), kam odjede (Out)
      // vychozi hodnoty
    directionIn: 'right',
    directionOut: 'right',
    // trigger events: mouseover, mousedown, mouseup, click, dblclick
      // vychozi hodnota
    triggerEvent: 'click',
    // number of ms to delay before hiding menu (on page load)
      // neni potreba menit
    loadHideDelay: 0,
    // number of ms to delay before hiding menu (on mouseout)
      // neni potreba menit
    blurHideDelay:  500,
    // number of ms for transition effect
    // jak rychle prijede (In), jak rychle odjede (Out)
      // vychozi hodnoty
    effectDurationIn: 1000,
    effectDurationOut: 1000,
    // hide the menu when the page loads
      // osetreno stylama, aby neslo videt pri vyplem js - tzn. nefunguje, ale kdyz se vypne tak vyjizdeni prestane fungovat
    hideOnLoad: true,
    // automatically hide menu when mouse leaves area
      // vychozi hodnota
    autoHide: true
  }

  // make sure to check if options are given!
  if(options) {
    $.extend($self.options, options);
  }

  return this.each(function() {
    var $menu = $(this);
    var $menuItems = $menu.find('#moo_ad');
    var $toggle = $menu.find('#odkaz_ad, #close');

  	if($self.options.hideOnLoad) {
  		if($self.options.loadHideDelay <= 0) {
  			$menuItems.hide();
  			$menu.closed = true;
  			$menu.unbind();
  		} else {
  			// let's hide the menu when the page is loading
  			// after {loadHideDelay} milliseconds
  			setTimeout( function() {
  				$menu.hideMenu();
  			}, $self.options.loadHideDelay);
  		}
  	}

    // bind event defined by {triggerEvent} to the trigger
    // to open and close the menu
    $toggle.bind($self.options.triggerEvent, function() {
      // if the trigger event is click or dblclick, we want
      // to close the menu if its open
      if(($self.options.triggerEvent == 'click' || $self.options.triggerEvent == 'dblclick') && !$menu.closed) {
        $menu.hideMenu();
      } else {
        $menu.showMenu();
      }
    });

    $menu.hideMenu = function() {
      if($menuItems.css('display') == 'block' && !$menu.closed) {
        $menuItems.hide(
          'slide',
          {
            direction: $self.options.directionOut,
            easing: $self.options.transitionOut
          },
          $self.options.effectDurationOut,
          function() {
            $menu.closed = true;
            $menu.unbind();
          }
        );
      }
    }

    $menu.showMenu = function() {
      if($menuItems.css('display') == 'none' && $menu.closed) {
        $menuItems.show(
          'slide',
          {
            direction: $self.options.directionIn,
            easing: $self.options.transitionIn
          },
          $self.options.effectDurationIn,
          function() {
            $menu.closed = false;
            if($self.options.autoHide) {
              $menu.hover(
                function(e) {
                  clearTimeout($menu.timeout);
                }, 
                function(e) {
                  $menu.timeout = setTimeout(function() {
                      $menu.hideMenu();
                  }, $self.options.blurHideDelay);
                }
              );
            }
          }
        );
      }
    }
  });
};