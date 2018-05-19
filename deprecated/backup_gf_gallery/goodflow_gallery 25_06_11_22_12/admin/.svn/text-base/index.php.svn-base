<?php
/*
 *      admin.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  //load autoload
  require '../loader.php';

  const ADMIN_PATH = '../'; //umisteni adminu v korenove strukture, relativne

  use classes\Core,
      classes\Language,
      classes\Administration,
      classes\jQuery,
      classes\JavaScript,
      classes\Html,
      classes\HtmlPage,
      configs\Config,
      modules\ModuleHome,
      modules\ModuleDirs,
      modules\ModulePictures,
      modules\ModuleSettings;

  if (Core::checkPHP()) {
    Core::startTime();
    Core::initSession();

    //Core::enableDebug();

    Administration::setSessionIndex(__DIR__);

    ModuleHome::setWebPath(ADMIN_PATH);
    ModuleDirs::setWebPath(ADMIN_PATH);
    ModulePictures::setWebPath(ADMIN_PATH);
    Administration::setWebPath(ADMIN_PATH);

    Language::getInstance()->loadListLanguage(Config::getAvailableLanguages());
    Language::getInstance()->setLanguage(Config::LANG);
    Language::getInstance()->loadGettext(ADMIN_PATH);

    $result = NULL;
    //var_dump(Administration::getStateAdmin());
    switch (Administration::getStateAdmin()) {
    //switch (Administration::STATE_ACCESS) { //testovaci ucely

      case Administration::STATE_LOGIN:
        $result = Administration::getLoginForm();
      break;

      case Administration::STATE_LOGOUT:
        $result = Administration::execLogout(ADMIN_PATH);
      break;

      case Administration::STATE_ACCESS:
        $data_settings = ModuleSettings::getXmlData();
        $title_galery = Core::isFill($data_settings, 'title');
        $description = Core::isFill($data_settings, 'description');

        $weburl = Core::getUrl(array('path' => basename(__FILE__)));

        $jquery = new jQuery();
        $jquery->addModule(NULL, 'supersized')
                  ->slides(array('image' => ADMIN_PATH.'images/body_small.png'))
                //->addModule('#tabs', 'tabs')
                ;

        $admintitle = Administration::getAdminTitle();
        $title = Core::implodeTitle(array($admintitle, ModuleDirs::getAdminTitle()));

        $header_content = array(Html::elem('a')->href($weburl)->title($title_galery)->id('logo')->setText('<!-- -->'),
                                Html::elem('div')->id('stripe_top')->setText(Administration::getLogoutLink()),
                                Html::elem('div')->id('navigation')->setText(Administration::getAdminMenu()),
                                Html::elem('div')->id('wrap_title')->insert(Html::elem('h1')->setText($title)),  //sprintf('%s<!-- -->', )
                                );
        $header = Html::elem('div')->id('header')->insert($header_content);
        $wrap_header = Html::elem('div')->id('wrap_header')->insert($header);

        $vypis = Html::elem('div')->id('vypis')->setText(Administration::getAdminContent());
        $obal = Html::elem('div')->id('obal')->insert($vypis)->setText(Core::stopTime());
        $obal_sekce = Html::elem('div')->id('obal_sekce')->insert($obal);

        $wrap_layout = Html::elem('div')->id('wrap_layout')
                            ->insert($wrap_header)
                            ->insert($obal_sekce);

        $page = new HtmlPage(HtmlPage::DOCTYPE_STRICT);  //DOCTYPE_STRICT DOCTYPE_HTML5
        $page->setLanguage(Config::LANG)
              ->addMeta('author', 'GoodFlow design - Tvorba webových stránek a systémů (www.gfdesign.cz)')
              ->addMeta('copyright', 'Created by GoodFlow design')
              ->addMeta('description', $description)
              ->addMeta('robots', 'noindex, nofollow')
              ->loadCSS(ADMIN_PATH.'styles/admin_global_styles.css')
              ->loadConditionalCSS(ADMIN_PATH.'styles/admin_styles_ie.css', 'IE')
              ->loadConditionalCSS(ADMIN_PATH.'styles/admin_styles_ie7.css', 'IE=7')
              ->loadJavaScript(ADMIN_PATH.'script/jquery/jquery-1.6.min.js')
              ->loadJavaScript(ADMIN_PATH.'script/jquery/jquery-ui-1.8.12.custom.min.js')
              ->loadJavaScript(ADMIN_PATH.'script/jquery.supersized/supersized.3.1.3.core.min.js')
              ->setTitle(array($title_galery, $admintitle))
              ->setFavicon('obr/favicon.ico', array('enabled' => false))
              ->addJavaScript($jquery)
              ->addBody($wrap_layout)
              ;

        $result = $page;
      break;

      //default:
      case Administration::STATE_DENIED:
        $result = _('You do not have access or expired session!');
        Core::setRefresh(2, Core::getAbsoluteUrl());
      break;
    }

    echo $result;
  }

?>
