<?php

  require 'loader.php';

  use classes\Core,
      classes\Html,
      classes\HtmlPage,
      classes\StaticWeb;

  if (Core::checkPHP()) {
    Core::startTime();
    //~ Core::initBrowscap(__DIR__);
    StaticWeb::setDefaultPage(pages\Reference::URL);

    $title = Core::implodeTitle(array(Config::PROJECT_NAME, StaticWeb::getTitle(array(''))));
    $sabona_menu = Html::li()->insert(Html::a()->href('{href_link}')->title('{name}')->class('{condition}')->clearBreakDepth()
                                      ->insert(Html::strong()->setText('{name}')->clearBreakDepth())
                                      ->insert(Html::span()->setText(' - ')->clearBreakDepth())
                                      ->insert(Html::em()->setText('{addition}')->clearBreakDepth())
                                      )->class('eval::({poc}=={count} ? "posledni" : NULL)')->clearBreakDepth();

    //$path = sprintf('%s/obr/kod/', Core::getUrl());$path.
    $obr = array();
    $obrazky = Core::getListFile(array('path' => sprintf('%s/%s', Core::getWebPath(), Config::DIR_CODES)));
    if (!empty($obrazky) && count($obrazky) > 7) {  //min 8 polozek
      $rand = array_rand($obrazky, 7);  //efektivni hodnota je dvojvasobna
      foreach ($rand as $nahodny) {
        $obr[] = $obrazky[$nahodny];
      }
    }

    $idsekce = StaticWeb::getUserVariable('idsekce');


    $obal_layout = Html::div()->id('obal_layout')
/*
      ->insert(Html::div()->id('panel_top')
        ->insert(Html::p()->setText('Doména na prodej. Cenové nabídky můžete zasílat formulářem v sekci kontakt.'))
      )
*/
      ->insert(Html::div()->id('obal_obsah')
              ->insert(Html::div()->id('zahlavi')
                      ->insert(Html::h1()
                              ->insert(Html::a()->href(Core::getUrl())->title($title)->setText($title))
                      )

                      ->insert(Html::ul()->insertContent(StaticWeb::getMenu($sabona_menu, '')))
              )->insert(Html::div()->id('obal_%s', $idsekce)
                        ->insert(Html::div()->id('obal_pozadi'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_1'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_2'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_3'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_4'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_5'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_6'))
                        ->insert(Html::span()->class('kod_pozadi')->class('kod_7'))
                        ->insertContent(StaticWeb::getContent())
                        //->insert(Html::div()->id(sprintf('obsah_%s', $idsekce))
                        //          ->setText(StaticWeb::getContent())
                        //        )
                        )
              );

    $page = new HtmlPage(HtmlPage::DOCTYPE_STRICT);
    $page->setLanguage(Config::LANG)
          ->setUrlPage(Core::getUrl())
          ->addMeta('author', Config::PROJECT_NAME.' (www.gfdesign.cz)')
          ->addMeta('copyright', 'Created by GoodFlow design')
          ->addMeta('keywords', 'GoodFlow design, GFdesign, GF design, tvorba stránek, tvorba www, webdesign')
          ->addMeta('description', $title)
          ->addMeta('robots', 'index, follow')
          ->addMeta('google-site-verification', 'JR_I4kX0Gn7LJexLY4k0YxlLGRE0MkZcpuu85VnFLes')
          ->loadCSS('styles/global_styles.css')
          ->loadCSS('highslide/highslide.css')
          ->loadCSS('highslide/highslide.config.css')
          ->loadCSS(Core::isWebKit() ? 'styles/webkit_styles.css' : NULL)
          ->loadCSS(Core::isOpera() ? 'styles/opera_styles.css' : NULL)
          ->loadConditionalCSS('styles/styles_ie.css', 'IE')
          //->loadConditionalCSS('styles/styles_ie8.css', 'IE=8')
          ->loadConditionalCSS('styles/styles_ie7.css', 'IE=7')
          ->loadConditionalCSS('styles/styles_ie6.css', 'IE=6')
          ->loadJavaScript('script/jquery/jquery-1.6.2.min.js')
          ->loadJavaScript('script/jquery/jquery-ui-1.8.16.custom.min.js')
          ->loadJavaScript('script/jquery/jquery.cycle.all.min.js')
          ->loadJavaScript('highslide/highslide-with-gallery.js')
          ->loadJavaScript('highslide/highslide.config.js')
          //->loadJavaScript('script/jquery/jquery.scrollTo-1.4.2-min.js')
          ->loadJavaScript('script/cufon/cufon.1.09i.js')
          ->loadJavaScript('script/cufon/museo.js')
          ->loadJavaScript('script/cufon/mwp.js')
          //->loadJavaScript('script/cufon/omm.js')
          //->loadJavaScript('script/cufon/museo100300.js')
          //->loadJavaScript('script/cufon/museo500700.js')
          //->loadJavaScript('script/cufon/museo900.js')
          //->loadJavaScript('highslide/highslide-full.js')
          //->loadJavaScript('highslide/highslide.config.js', array('charset' => 'utf-8'))
          ->addJavaScript('$(document).ready(function() {
        Cufon.replace(\'#obal_obsah #zahlavi ul li a strong, #obal_obsah #zahlavi ul li a em\', { fontFamily: \'Museo\' });
        Cufon.replace(\'#obal_obsah #zahlavi ul li a\', { fontFamily: \'Museo\', textShadow: \'1px 1px #000\', hover: true });
        var rand = %s;
          for (var key in rand) {
          $(".kod_"+ (parseInt(key) + 1)).css("background-image","url(*url*%s"+rand[key]+")");
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
      });', array(json_encode($obr), Config::DIR_CODES))

          //->addJavaScript('});')
          ->loadModules(StaticWeb::getLoadModules())

        //->addJavaScript('')

          ->setGoogleAnalytics('UA-17828373-1')
          ->addEndJavaScript('Cufon.now();')
          ->setTitle($title)
          //->setFavicon('obr/favicon.ico', array('enabled' => true))
          ->addBody($obal_layout);

    echo $page;
    //error_log(Core::stopTime());
    //echo Core::stopTime();
    //Core::enableDebug();
  }
?>
