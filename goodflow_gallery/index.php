<?php
/*
 *      index.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  //load autoload
  require 'loader.php';

  use classes\Core,
      classes\Language,
      classes\Html,
      classes\HtmlPage,
      classes\Administration,
      classes\SelectionTheme,
      modules\ModuleDirs,
      modules\ModuleSettings;

  if (Core::checkPHP()) {
    Core::startTime();
    Core::initSession();

    Language::getInstance()->setLanguage(Config::LANG);
    Language::getInstance()->loadGettext();

    $weburl = Core::getUrl();
    $adminurl = Core::getUrl(array('path' => 'admin'));
    $admin_path = Core::getAbsoluteWebPath(__DIR__).'/';

    //ModuleDirs::setWebPath();
    Administration::setPath($admin_path, $adminurl, $weburl);

    $data_settings = ModuleSettings::getXmlData();
    $title_galery = Core::isFill($data_settings, 'title');
    $description = Core::isFill($data_settings, 'description');
    $robots = Core::isFill($data_settings, 'robots');

//obsluha zmeny tematu
    SelectionTheme::getInstance()->setWebPath('themes/');
    SelectionTheme::getInstance()->setCurrentTheme(Core::isFill($data_settings, 'theme'));
    $sablona_menu = SelectionTheme::getInstance()->section('sablona_menu');
    $sablona_obsahu = SelectionTheme::getInstance()->section('sablona_obsahu');
//konec obsluhy sablony

    $title = ModuleDirs::getPageTitle();

    $menu = Html::elem('div')->id('menu')->setText('')->setText(ModuleDirs::getPageMenu($weburl, $sablona_menu));  //$sablona_menu
    $vypis = Html::elem('div')->id('vypis')->setText(ModuleDirs::getPageContent($weburl, $sablona_obsahu));  //$sablona_obsahu
    $login_link = Administration::getLoginLink();

    $h1 = Html::elem('h1')->insert(Html::elem('a')->href($weburl)->title($title_galery)->setText($title_galery))->setText($title);
    $obal = Html::elem('div')->id('obal')
                ->insert(array($menu, $vypis, $login_link));

    $end_time = Html::elem('span')->setText(Core::stopTime());
    $obal_sekce = Html::elem('div')->id('obal_sekce')
                      ->insert(array($h1, $obal, $end_time));

    $obal_layout = Html::elem('div')->id('obal_layout')//->setTypeList(Html::LIST_NOODLE)
                        ->insert($obal_sekce)
                        ->insertContent(Administration::getErrors())
                        ;

    $page = new HtmlPage(HtmlPage::DOCTYPE_STRICT);
    $page->setLanguage(Config::LANG)
          ->setUrlPage($weburl)
          ->addMeta('author', 'GoodFlow design - Tvorba webových stránek a systémů (www.gfdesign.cz)')
          ->addMeta('copyright', 'Created by GoodFlow design')
          ->addMeta('description', $description)
          ->addMeta('robots', ($robots ? 'index, follow' : 'noindex, nofollow'))
          ->loadCSS('styles/global_styles.css')
          //->loadConditionalCSS('styles/styles_ie.css', 'IE')
          //->loadConditionalCSS('styles/styles_ie7.css', 'IE=7')
          //->loadConditionalJavaScript('script/html5.js', 'IE<9')
          ->loadJavaScript('script/jquery/jquery-1.6.2.min.js')
          ->setTitle(array($title_galery, $title))
          ->setFavicon('obr/favicon.ico', array('enabled' => false))
          ->addBody($obal_layout);

    echo $page;
    Core::enableDebug();
  }

  //sudo chmod -R 0777 goodflow_gallery/

?>
