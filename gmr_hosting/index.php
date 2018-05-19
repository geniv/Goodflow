<?php
/*
 * index.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  require 'loader.php'; // load autoload
  //~ Loader::setDebug(true);

  try {

    if (classes\Core::checkPHP()) {
      //~ classes\Debugger::startTime();

      $html = 'classes\Html';
      $form = 'classes\Form';

      // data prochazejici celym kodem
      $maindata = array(
                        'html' => $html,
                        'form' => $form,
                        'core' => 'classes\Core',
                        );

      $mainClass = new MainClass($maindata);
      // inicializace webu
      $mainClass->initialization();

      // inicializace cache
      $cache = new classes\Cache;
      $cache->setCache($mainClass->configure['cache']['enabled'])
            ->setCacheExpire($mainClass->configure['cache']['expire'])
            ->setExceptionUri(array('admin'));

      // pri instlaci systemu
      if ($mainClass->configure['system']['install']) {
        $cache->clearAllCache();
      }

      if ($cache->isCached()) {
        echo $cache->getOutBuff();  //vypsani z cache
      } else {
        $cache->initOutBuff();

        // pri instlaci systemu po vyprazdneni cache
        if ($mainClass->configure['system']['install']) {
          classes\Tpl::setConfigure('auto_gen_dir', true);
          $mainClass->tpl->installDirs()->clearAll();
        }

        $route_model = array(
                            'action/sekce',
                            'action==novinky/id',
                            'action==user/login/akce',
                            'action==registrace/typ',
                            );

        $web = new classes\Web($mainClass->configure['index_menu']);
        $web->setRoute($route_model);
//~ var_dump($web->getLastActiveClass());
        $mainClass['web'] = $web;
        $mainClass['web_uri'] = $web->getRoute()->getUri();
//~ var_dump($mainClass['web_uri']);
        // zapnuti zalamovani kodu
        $html::setBreakDepth(true);

        // doplnovani TPL identity pro index
        if ($mainClass->user->getIdentity()) {
          $user_login = $mainClass->user->getIdentity()->getData('login');
          $user_assign = array(
                                'index_user_isloggedin' => $mainClass->user->isLoggedIn(true),
                                'index_user_login' => $user_login,
                                'index_user_link' => 'user/'.$user_login,
                                'index_user_logout' => 'user/'.$user_login.'/logout',
                              );
        } else {
          $user_assign = array(
                                'index_user_isloggedin' => '',
                                'index_user_login' => '',
                                'index_user_link' => '',
                                'index_user_logout' => '',
                              );
        }
//FIXME objednavku zamenit logicky za servis, objednavka bude skryta sekce!!!! viz postupem casu se poladi!!!!

        // predani promennych do template
        $mainClass->tpl->assign($mainClass->toArray()); // predani z mainClass
        $assign = array(
                        'index_content' => $web->getContent($mainClass),

                        'index_novinky_link' => 'novinky',
                        'index_novinky_vypis' => $mainClass->getNovinky(),
                        );
        $mainClass->tpl->assign($user_assign)->assign($assign);  // predani menu a contextu

        //~ $title = $sweb->getTitle(array('exception' => array(''), 'title' => $mainClass->configure['htmlpage']['title']));
        $title = implode(' - ', array($mainClass->configure['htmlpage']['title'], $web->getTitle()));

        // vytvoreni zakladni html stranky
        $page = new classes\HtmlPage;
        $page->setTitle($title)
            ->setUrl($mainClass->weburl)
            ->addMetaTag('author', 'GMR hosting, www.gmrhosting.cz')
            ->addMetaTag('keywords', $mainClass->configure['htmlpage']['keywords'])
            ->addMetaTag('description', $mainClass->configure['htmlpage']['description'])
            ->addMetaTag('robots', $mainClass->configure['htmlpage']['robots'])
            ->addExternalCSS('css/bootstrap.css')
            ->addExternalCSS('css/bootstrap-responsive.css')
            ->addExternalCSS('js/flexslider.css')
            ->addExternalCSS('css/style.css')
            ->addExternalCSS('css/print-style.css', array('media' => classes\HtmlPage::MEDIA_PRINT))
            ->addExternalCSS('css?family=Oswald:400,300,700&amp;subset=latin,latin-ext', array('url' => 'http://fonts.googleapis.com/'))
            ->addRSS('rss', 'RSS feed')
            ->addExternalJS('js/vendor/modernizr-2.5.3.min.js')
            ->addExternalJS('js/css_browser_selector.js')
            //~ ->addBody($body)
            ->setBodyHtml($mainClass->tpl->template('main_index')->render())

            ->addExternalJS('js/vendor/jquery-1.7.2.min.js')  //FIXME otestovat a nasadit novou verzi!
            //~ ->addExternalJS('js/jquery-ui-1.9.2.custom.min.js')

            ->addExternalJS('js/jquery.tools.min.js')
            ->addExternalJS('js/jquery.flexslider-min.js')

            //~ ->addExternalCSS('js/prettyphoto/css/prettyPhoto.css')  //je zatim jen v Home
            //~ ->addExternalJS('js/prettyphoto/jquery.prettyPhoto.js')

            ->addExternalJS('js/jquery.scrollTo-1.4.3.1-min.js')
            ->addExternalJS('js/jquery.easing.1.3.js')

            //~ ->addExternalJS('js/plugins.js')
            ->addExternalJS('js/main.js')

            ->addEmbedJS(<<<JS

      $(document).ready(function() {
        /* testimonials initialization */
        $('#testimonials').flexslider({
          slideshow : false,
          controlNav : false,
          controlsContainer : '.testimonials_nav'
        });

        var _interval = window.setInterval(function () {
            var autofills = $('input:-webkit-autofill');
            if (autofills.length > 0) {
              window.clearInterval(_interval); // stop polling
              autofills.each(function() {
                  var clone = $(this).clone(true, true);
                  $(this).after(clone).remove();
              });
            }
        }, 20);
      });

JS
)

            ->setJS($web->getJS($mainClass))
            ->setCSS($web->getCSS($mainClass))
            //->setGoogleAnalytics('UA-17828373-1')
            ;

        echo $page;

        $cache->setOutBuff();
      }

      //~ if ($mainClass->configure['system']['debug']) {
        //~ echo $cache->getCacheInfo();
        //~ echo classes\Debugger::viewTimes();
      //~ }

    } else {
      throw new Exception('php neni v poradku');
    }

  } catch (Exception $e) {
    die($e);
    //$e->getMessage(), $e->getFile(), $e->getTrace()
  }