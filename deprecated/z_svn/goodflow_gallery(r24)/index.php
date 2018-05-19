<?php
/*
 *      index.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  //load autoload
  require 'loader.php';

  use configs\Config,
      classes\Core,
      classes\Language,
      classes\Html,
      classes\HtmlPage,
      classes\Administration,
      modules\ModuleDirs,
      modules\ModuleSettings;

  if (Core::checkPHP()) {
    Core::startTime();
    Core::initSession();

    Language::getInstance()->loadListLanguage(Config::getAvailableLanguages());
    Language::getInstance()->setLanguage(Config::LANG);
    Language::getInstance()->loadGettext();

//var_dump(Core::getAbsoluteWebPath());
    //ModuleDirs::setWebPath();
    Administration::setWebPath();

    $data_settings = ModuleSettings::getXmlData();
    $title_galery = Core::isFill($data_settings, 'title');
    $description = Core::isFill($data_settings, 'description');
    $robots = Core::isFill($data_settings, 'robots');

    $absolutni_url = Core::getAbsoluteUrl();

//var_dump(error_get_last());//'jazyk' => $languageform,

    //TODO dodelat a doimplementovat!!
    //SelectionTheme::

    $title = ModuleDirs::getPageTitle(array('before' => $title_galery));

    $menu = Html::elem('div')->id('menu')->setText(ModuleDirs::getPageMenu());
    $vypis = Html::elem('div')->id('vypis')->setText(ModuleDirs::getPageContent());
    $login_link = Administration::getLoginLink('admin/');

    $h1 = Html::elem('h1')->insert(Html::elem('a')->href($absolutni_url)->setText($title));
    $obal = Html::elem('div')->id('obal')
                ->insert(array($menu, $vypis, $login_link));

    $end_time = Html::elem('span')->setText(Core::stopTime());
    $obal_sekce = Html::elem('div')->id('obal_sekce')
                      ->insert(array($h1, $obal, $end_time));

    $obal_layout = Html::elem('div')->id('obal_layout')
                        ->insert($obal_sekce);

    $page = new HtmlPage(HtmlPage::DOCTYPE_STRICT);
    $page->setLanguage(Config::LANG)
          ->addMeta('author', 'GoodFlow design - Tvorba webových stránek a systémů (www.gfdesign.cz)')
          ->addMeta('copyright', 'Created by GoodFlow design')
          ->addMeta('description', $description)
          ->addMeta('robots', ($robots ? 'index, follow' : 'noindex, nofollow'))
          ->loadCSS('styles/global_styles.css')
          ->loadConditionalCSS('styles/styles_ie.css', 'IE')
          ->loadConditionalCSS('styles/styles_ie7.css', 'IE=7')
          ->loadJavaScript('script/jquery/jquery-1.6.min.js')
          ->setTitle($title)
          ->setFavicon('obr/favicon.ico', array('enabled' => false))
          ->addBody($obal_layout)
          ;

    echo $page;
  }

?>
