<?php
/*
 *      index.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 * generator configu openttd od veze 1.0.0
 *
 */

  //load autoload
  require 'loader.php';

  use classes\Html,
      classes\HtmlPage,
      classes\Language,
      classes\Core,
      classes\OpenTTDconfig;

  if (Core::checkPHP()) {
    $weburl = Core::getUrl();

    if (Core::isOpera() || Core::isChrome()) {
      Core::enableDebug();

      Language::getInstance()->setLanguage(Config::LANG);
      Language::getInstance()->loadGettext()->setAutoCreate();

//TODO prepinani dostupnych jazyku + upload a download konfigu...

      OpenTTDconfig::setPath(Config::CONFIG_DIR, $weburl);

      $content = Html::div()->id('obal_layout')
                            ->insert(Html::div()->id('zahlavi')
                                    ->insert(Html::h1()->setText('GoodFlow OpenTTD config generator'))
                                    ->insert(Html::div()->id('navigace')
                                            ->insert(Html::h2()
                                                    ->insert(Html::a()->hrefpath('')->title('GoodFlow OpenTTD config generator')->setText('OpenTTD config generator'))
                                            )
                                            ->insert(Html::p()
                                                    ->insertContent(OpenTTDconfig::getMenu())
                                            )
                                    )
                            )
                            ->insert(Html::div()->id('obal_obsah')->insertContent(OpenTTDconfig::getContent()))
                            ->insert(Html::div()->id('zapati'));

      $page = new HtmlPage(HtmlPage::DOCTYPE_STRICT);
      $page->setLanguage(Config::LANG)
          ->setUrlPage($weburl)
          ->addMeta('author', 'GoodFlow design - Tvorba webových stránek a systémů (www.gfdesign.cz)')
          ->addMeta('copyright', 'Created by GoodFlow design')
          ->addMeta('description', 'GoodFlow OpenTTD config generator')
          ->addMeta('robots', 'index, follow')
          ->setTitle('GoodFlow OpenTTD config generator')
          ->loadCSS('styles/global_styles.css')
          ->loadJavaScript('script/jquery/jquery-1.6.2.min.js')
          ->loadJavaScript('script/jquery/jquery-ui-1.8.16.custom.min.js')
          ->setTitle('GoodFlow OpenTTD config generator')
          ->addBody($content);

    } else {

      $page = new HtmlPage(HtmlPage::DOCTYPE_STRICT);
      $page->setLanguage(Config::LANG)
          ->setUrlPage($weburl)
          ->addMeta('author', 'GoodFlow design - Tvorba webových stránek a systémů (www.gfdesign.cz)')
          ->addMeta('copyright', 'Created by GoodFlow design')
          ->addMeta('description', 'GoodFlow OpenTTD config generator')
          ->addMeta('robots', 'index, follow')
          ->setTitle('GoodFlow OpenTTD config generator')
          ->loadCSS('styles/global_styles_2.css')
          ->loadJavaScript('script/jquery/jquery-1.6.2.min.js')
          ->loadJavaScript('script/jquery/jquery-ui-1.8.16.custom.min.js')
          ->setTitle('GoodFlow OpenTTD config generator')
          ->addJavaScript('
      function resize() {
        //<![CDATA[
          $("#fullscreen_bcg img").attr({
            "width": $(window).width()+"px",
            "height": $(window).height()+"px"
          });
        //]]>
      }
      $(document).ready(function(){
        $(window).resize(function() {
          resize();
        });
        resize();
      });
    ')
          ->addBody(Html::div()->id('fullscreen_bcg')->insert(Html::img()->srcpath('obr/no_browser.png')->alt('')));
    }
    echo $page;
  }

?>
