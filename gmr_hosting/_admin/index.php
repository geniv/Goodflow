<?php
/*
 * index.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  require '../loader.php'; // load autoload
  //~ Loader::setDebug(true);

  try {

    if (classes\Core::checkPHP()) {
      classes\Debugger::startTime('admin');

      $html = 'classes\Html';
      $form = 'classes\Form';

      // data prochazejici celym kodem
      $maindata = array(
                        'html' => $html,
                        'form' => $form,
                        'core' => 'classes\Core',
                        );

      $mainClass = new MainClass($maindata);
      $mainClass->initialization('../');

      if (!$mainClass->spravce->isLoggedIn(true)) { //zajisteni vraceni na index
        classes\Core::setLocation('../');
        exit;
      }

      if ($mainClass->configure['system']['install']) {
        classes\Tpl::setConfigure('auto_gen_dir', true);
        $mainClass->tpl->installDirs()->clearAll();
      }

//TODO tridu pro autozalohovani databaze?!!
//FIXME doresit bugy(nedostatky) se session/userstorage, doresit umisteni vytvareni databaze jinam?

      $route_model = array(
                          'skupina/sekce/blok/id',
                          //~ 'skupina/sekce/sub/blok/id'
                          );
      $web = new classes\Web($mainClass->configure['admin_menu']);
      $web->setRoute($route_model, '?webadmin');

      $menu_sekce = $web->exist($mainClass->configure['admin_menu'], 'skupina');

      $web_sub = new classes\Web($mainClass->configure['admin_menu'][$menu_sekce]);
      $web_sub->setRoute($route_model, '', 1);
      //~ $web_sub->setSelfSubmenu($mainClass);

      $mainClass['web'] = $web;
      $mainClass['web_submenu'] = $web_sub;
      $mainClass['web_uri'] = $web->getRoute()->getUri();

//~ var_dump($mainClass['web_uri']);

      $html::setBreakDepth(true); //zapnuti zalamovani kodu

      //~ $authTime = $mainClass->storage->getAuthTime();
      $authTime = 0;  //FIXME toto nejak doresit!!!

      // vkladani spravneho content value
      $w_cont = $web->getContent($mainClass);
      $content = ($w_cont ? $w_cont : $web_sub->getContent($mainClass));

      //assigned body na tpl
      $assign = array(
                      'menu_sekce' => $menu_sekce,
                      'index_content' => $content,
                      'authTime' => $authTime,
                      'expireTime' => strtotime($mainClass->configure['session']['expire'], $authTime),
                      );
      $mainClass->tpl->assign($mainClass->toArray())->assign($assign);  //assign dat

      $title = implode(' - ', array($mainClass->configure['htmlpage']['title'], $web_sub->getTitle()));

      $page = new classes\HtmlPage;
      $page->setTitle($title)
          ->setUrl($mainClass->weburl)
          ->addMetaTag('author', 'GMR hosting, www.gmrhosting.cz')
          ->addMetaTag('keywords', $mainClass->configure['htmlpage']['keywords'])
          ->addMetaTag('description', $mainClass->configure['htmlpage']['description'])
          ->addMetaTag('robots', $mainClass->configure['htmlpage']['robots'])

          ->addExternalCSS('css/style.css')
          ->addExternalJS('scripts/script.js')
          ->addExternalCSS('css?family=Droid+Sans', array('url' => 'http://fonts.googleapis.com/'))

          ->setJS($web_sub->getJS($mainClass))
          //~ ->addBody($body)
          ->setBodyHtml($mainClass->tpl->assign('vygenerovano', classes\Debugger::viewTime('admin'))->template('main_admin')->render());

      echo $page;

      $mainClass['handle']->close(); //zavreni databaze

      //~ echo Debugger::viewTimes();

    } else {
      throw new Exception('php neni v poradku');
    }

  } catch (Exception $e) {
    die($e);
  }