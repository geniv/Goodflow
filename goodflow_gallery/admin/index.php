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
      classes\Html,
      classes\HtmlPage,
      classes\Notification,
      classes\SelectionTheme,
      modules\ModuleHome,
      modules\ModuleDirs,
      modules\ModulePictures,
      modules\ModuleSettings;

  if (Core::checkPHP()) {
    Core::startTime();
    Core::initSession();

    Administration::setSessionIndex(__DIR__);

    $weburl = Core::getUrl(array('path' => '../'));
    $adminurl = Core::getUrl();
    $admin_path = Core::getAbsoluteWebPath(dirname(__DIR__)).'/';


//TODO moduly sami si musi tahat tady ty pathe z administrace! pac nastavovat kazdy modul zvlast by bylo na zcvoknuti
    Administration::setPath($admin_path, $adminurl, $weburl);
//je zbytecne aby se to nastavovalo zvlast, kdyz ty moduly jsou stejne zavisle na administraci!



//FIXME vyhodit!!!
    ModuleDirs::setPath($admin_path, $adminurl, $weburl);
    ModulePictures::setPath($admin_path, $adminurl, $weburl);  //TODO takto by se to melo nastavovat
//FIXME vyhodit!!!



    Language::getInstance()->setLanguage(Config::LANG);
    Language::getInstance()->loadGettext($admin_path);
    SelectionTheme::getInstance()->setWebPath('../themes/');

    $result = NULL;
    //var_dump(Administration::getStateAdmin());
    switch (Administration::getStateAdmin()) {
    //switch (Administration::STATE_ACCESS) { //testovaci ucely

      case Administration::STATE_LOGIN:
        $result = Administration::getLoginForm();//$weburl, $adminurl
      break;

      case Administration::STATE_LOGOUT:
        $result = Administration::execLogout();//$weburl
      break;

      case Administration::STATE_ACCESS:
        $data_settings = ModuleSettings::getXmlData();
        $title_galery = Core::isFill($data_settings, 'title');
        $description = Core::isFill($data_settings, 'description');

        $mini_size_w = Core::isNull($data_settings, 'minsizew');
        $mini_size_h = Core::isNull($data_settings, 'minsizeh');

        $jquery = '
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
    ';

        $admintitle = Administration::getAdminTitle();

        $gotoweb = _('Go to web');
        $header_content = array(Html::elem('a')
                                    ->href($adminurl.Administration::ADMIN_URL)
                                    ->title($title_galery)
                                    ->id('logo')
                                    ->setText($title_galery),
                                Html::elem('div')
                                    ->id('stripe_top')
                                    ->insert(Administration::getLogoutLink())
                                    ->insert(Html::elem('a')
                                                ->href($weburl)
                                                ->title($gotoweb)
                                                ->id('margin_stripe_top')
                                                ->setText($gotoweb)
                                            ),
                                Html::elem('div')
                                    ->id('navigation')
                                    ->setText(Administration::getAdminMenu()),
                                Html::elem('div')->id('wrap_title')
                                    ->insert(Html::elem('h1')
                                                  ->insert(Html::elem('span')
                                                                ->id('h1_left')
                                                                ->setText($admintitle)
                                                          )
                                                  ->insert(Html::elem('span')
                                                                ->id('h1_right')
                                                                ->insert(Html::elem('span')->setText(Administration::getAdminSection(ModuleDirs::getAdminTitle()))
                                                                        )
                                                          )
                                            ),

                                );

        $header = Html::elem('div')
                      ->id('header')
                      ->insert($header_content);

        $wrap_header = Html::elem('div')
                            ->id('wrap_header')
                            ->insert($header);

        //$vypis = Html::elem('div')->id('vypis')->setText(Administration::getAdminContent());
        //$obal = Html:elem('div')->id('obal')->insert($vypis)->setText(Core::stopTime());

        $obal_sekce = Html::elem('div')
                          ->id('wrap_content')
                          ->insertContent(Administration::getAdminContent())
                          ->insertContent(Administration::getErrors())
                          //->insertContent(Notification::successful(_('%s sadsa dsadas das das dsadsadasdsad asdsad sadsadsa  sad asdsa sad sada dasdsadsa dsa dsadas dasdasdsa sad asdsa sdad sa dasad as  adsa dsa'))->wait(Notification::NORMAL)->arg('hodnota aassad saddf dfsd sdfsd sdg sd sd sd ggsg sd sdgdssadsadsa fs aghdfg sdfsd fsdf'))
                          ;

        $wrap_layout = Html::elem('div')
                            ->id('wrap_layout')
                            ->insert($wrap_header)
                            ->insert($obal_sekce)
                            ->appendAfter(Html::elem('div')->id('status_drag')->setDepth(2))
                            ->appendAfter(Html::elem('p')->setText(Core::stopTime())->setDepth(2))
                            ->appendAfter(Html::elem('div')->id('fullscreen_bcg')->insert(Html::elem('img')
                                                                                              ->srcpath('../images/body_small.png')
                                                                                              ->alt('')
                                                                                          )->setDepth(2));

        $page = new HtmlPage(HtmlPage::DOCTYPE_STRICT);  //DOCTYPE_STRICT DOCTYPE_HTML5
        $page->setLanguage(Config::LANG)
              ->setUrlPage($weburl)
              ->addMeta('author', 'GoodFlow design - Tvorba webových stránek a systémů (www.gfdesign.cz)')
              ->addMeta('copyright', 'Created by GoodFlow design')
              ->addMeta('description', $description)
              ->addMeta('robots', 'noindex, nofollow')
              ->loadCSS('styles/admin_global_styles.css')
              //->loadCSS(Core::isChrome() ? 'styles/admin_styles_webkit.css' : NULL)
              //->loadConditionalCSS($web_path.'styles/admin_styles_ie.css', 'IE')
              //->loadConditionalCSS($web_path.'styles/admin_styles_ie7.css', 'IE=7')
              ->loadJavaScript('script/jquery/jquery-1.6.2.min.js')
              ->loadJavaScript('script/jquery/jquery-ui-1.8.14.custom.min.js')
              ->loadModules(Administration::getLoadModules())
              ->setInsertStyle(sprintf('
      #wrap_content #listing_photo ul#wrap_sort li {
        width: %spx;
        height: %spx;
      }
    ', $mini_size_w, $mini_size_h))
              ->setTitle(array($title_galery, $admintitle))
              ->setFavicon('obr/favicon.ico', array('enabled' => false))
              ->addJavaScript($jquery)
              ->addBody($wrap_layout)
              ;
//echo Core::stopTime();
        $result = $page;
      break;

      //default:
      case Administration::STATE_DENIED:
        $result = _('You do not have access or expired session!');
        Core::setRefresh(2, $weburl);
      break;
    }

    echo $result;
    Core::enableDebug();
  }

?>
