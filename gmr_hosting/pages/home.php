<?php

  namespace pages;

  use classes\IPage;

  class Home implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Home',
                  //'addition' => 'co děláme',
                  //'idsekce' => 'hlavni'
                  );
    }

    //extra JS pro danou stranku
    public static function getJS($data = null) {
      return array('external' => array('js/jquery.cycle.all.js',
                                      'js/prettyphoto/jquery.prettyPhoto.js'),
                    'embed' => <<<JS

      $('.slides_container').cycle({
        fx: 'fade',
        timeout: 6000,
        next: '.promo_slider .next',
        prev: '.promo_slider .prev',
        pager: '.promo_slider .strankovani',
        pause: 1,
        pauseOnPagerHover: 1,
        slideResize: 0,
      });

      $("a[data-rel^='prettyPhoto']").prettyPhoto({
        deeplinking : false,
        keyboard_shortcuts : false,
        social_tools : false
      });
    
JS
                    );
    }

    //extra CSS pro danou stranku
    public static function getCSS($data = null) {
      return array('external' => array('js/prettyphoto/css/prettyPhoto.css'),
                    'embed' => <<<CSS
CSS
                  );
    }

    //obsah
    public static function getContent($data = null) {
      $tpl = $data['tpl'];
      //~ $user = $data['user'];
      //~ $html = $data['html'];

      //TODO nejaky assigny pro nejaka data z databaze!!!

      return $tpl->template('page_home')->render();
    }
  }