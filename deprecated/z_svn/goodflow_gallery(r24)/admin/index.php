<?php
/*
 *      admin.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  //load autoload
  require '../loader.php';

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
    Administration::setSessionIndex(__DIR__);
//FIXME poresit globalni odadresovani!! to: '../' !!!
//var_dump(Core::getAbsoluteWebPath());
    ModuleHome::setWebPath('../');
    ModuleDirs::setWebPath('../');
    ModulePictures::setWebPath('../');
    Administration::setWebPath('../');

    Language::getInstance()->loadListLanguage(Config::getAvailableLanguages());
    Language::getInstance()->setLanguage(Config::LANG);
    Language::getInstance()->loadGettext('../');

    $result = NULL;
    //var_dump(Administration::getStateAdmin());
    switch (Administration::getStateAdmin()) {
    //switch (Administration::STATE_ACCESS) { //testovaci ucely
/*
      case Administration::STATE_LOGIN:
        $result = Administration::getLoginForm();
      break;
*/
      case Administration::STATE_LOGOUT:
        $result = Administration::execLogout('../');
      break;


      case Administration::STATE_ACCESS:
        $data_settings = ModuleSettings::getXmlData();
        $title_galery = Core::isFill($data_settings, 'title');
        $description = Core::isFill($data_settings, 'description');

        $absolutni_url = Core::getAbsoluteUrl(NULL, array('path' => basename(__FILE__)));

        $jquery = new jQuery();
        $jquery->addModule(NULL, 'supersized')
                  ->slides(array('image' => '../images/body_small.png'))
                //->addModule('#tabs', 'tabs')
                ;

        $admintitle = Administration::getAdminTitle();
        $title = Core::implodeTitle(array($admintitle, ModuleDirs::getAdminTitle()));

        $header_content = array(Html::elem('a')->href($absolutni_url)->title($title_galery)->id('logo')->setText('<!-- -->'),
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

        $page = new HtmlPage(HtmlPage::DOCTYPE_HTML5);  //DOCTYPE_STRICT
        $page->setLanguage(Config::LANG)
              ->addMeta('author', 'GoodFlow design - Tvorba webových stránek a systémů (www.gfdesign.cz)')
              ->addMeta('copyright', 'Created by GoodFlow design')
              ->addMeta('description', $description)
              ->addMeta('robots', 'noindex, nofollow')
              ->loadCSS('../styles/admin_global_styles.css')
              ->loadConditionalCSS('../styles/admin_styles_ie.css', 'IE')
              ->loadConditionalCSS('../styles/admin_styles_ie7.css', 'IE=7')
              ->loadJavaScript('../script/jquery/jquery-1.6.min.js')
              ->loadJavaScript('../script/jquery/jquery-ui-1.8.12.custom.min.js')
              ->loadJavaScript('../script/jquery.supersized/supersized.3.1.3.core.min.js')
              ->setTitle(array($title_galery, $admintitle))
              ->setFavicon('obr/favicon.ico', array('enabled' => false))
              ->addJavaScript($jquery)
              ->addBody($wrap_layout)
              ;

        if (Administration::checkOriginalAuth()) {
          echo _('Login and password it default. Change it hurry, please.');
        }

        $result = $page;
      break;

      //default:
      case Administration::STATE_DENIED:
        //$result = _('You do not have access or expired session!');
        $result = Administration::getStateLogin();
        Core::setRefresh(2, Core::getAbsoluteUrl(NULL, array('path' => Administration::ADMIN_URL)));
      break;
    }

    echo $result;
  }

?>
