<?php
/*
 * index.php
 *
 * Copyright 2012 geniv <geniv.radek@gmail.com>
 *
 */

  require '../loader.php'; // load autoload

  use classes\Core,
      classes\Html,
      classes\Debugger;

  try {

    if (Core::checkPHP()) {
      Debugger::startTime();

      $html = 'classes\Html';
      $form = 'classes\Form';

      // data prochazejici celym kodem
      $maindata = array(
                        'html' => $html,
                        'form' => $form,
                        'core' => 'classes\Core',
                        );

      $mainClass = new MainClass($maindata);

      $configure = classes\Configurator::decode('../global_config.php');
      $db_conf = classes\Configurator::decode('../database_config.php');
      //~ var_dump($configure);
      $mainClass['configure'] = $configure;

      classes\DateAndTime::setDateTimezone($configure['date_timezone']);  //nastaveni time zony

      //obsluha databaze
      $handle = new classes\PDOOpenHelper($db_conf['name']);
      $handle->MySQL($db_conf['mysql']);
      //pripojeni k databazi
      $db = $handle->getDatabase();
      $mainClass['db'] = $db;

      $weburl = Core::getUrl();
      $mainClass['weburl'] = $weburl;

      $sess = new classes\Session();
      $sess->setExpiration($configure['session']['expire']);
      $storage = new classes\UserStorage($sess);
      $user = new classes\User($storage);

      $mainClass['user'] = $user;  //predani uzivatele
      $mainClass['user_identity'] = $user->getIdentity();  //predani identity uzivatele

      if (!$user->isLoggedIn(true)) { //zajisteni vraceni na index
        Core::setLocation('../');
        exit;
      }

      $tpl = new classes\Tpl(array('debug' => $configure['system']['debug']));
      $mainClass['tpl'] = $tpl;

      if ($configure['system']['install']) {
        $tpl::setConfigure('auto_gen_dir', true);
        $tpl->installDirs()->clearAll();
      }

      // definice modelu menu
      $menuskel = array(
        'menu' => function($row) {
          $result = Html::li()->add(
                                    Html::a()->hrefrewrite('', array('action' => $row['url']))
                                                  ->setText($row['name'])
                                                  ->id($row['active'] ? 'aktivni' : null)
                                    );
          return $result;
        }
      );

//TODO zajistit prologovani casu odhlaseni pri refreshu!!!
//TODO tridu pro autozalohovani databaze?!!
//FIXME doresit bugy(nedostatky) se session/userstorage, doresit umisteni vytvareni databaze jinam?

      // vytvoreni instance static webu
      $sweb = new classes\StaticWeb(array('sekce/blok/id'));
      $sweb->setLoadMenu($configure['main_admin']['pages']);

      //~ $uri = $sweb->getUri();
      $mainClass['staticweb'] = $sweb;
      $mainClass['staticweb_uri'] = $sweb->getUri();

      $html::setBreakDepth(true); //zapnuti zalamovani kodu

      $authTime = $storage->getAuthTime();
      //assigned body na tpl
      $assign = array(
                      'index_menu' => $sweb->getMenu($menuskel),
                      'index_content' => $sweb->getContent($mainClass),
                      'authTime' => $authTime,
                      'expireTime' => strtotime($configure['session']['expire'], $authTime),
                      );
      $tpl->assign($mainClass->toArray())->assign($assign);  //assign dat

      $page = new classes\HtmlPage;
      $page->setTitle('GMR - ...')
          ->setUrl($weburl)
          ->addMetaTag('author', 'GMR Team')
          ->addMetaTag('copyright', 'Created by GMR Team')
          ->addMetaTag('keywords', 'GMR, GMR ceska minecraft wiki')
          ->addMetaTag('description', 'GMR Ceska minecraft wiki')
          ->addMetaTag('robots', 'index, follow')
          ->addExternalCSS('../css/style_global.css')
          //~ ->addBody($body)
          ->setBodyHtml($tpl->template('main_admin')->render());

      echo $page;

      $handle->close(); //zavreni databaze

      echo Debugger::viewTimes();

    } else {
      throw new Exception('php neni v poradku');
    }

  } catch (Exception $e) {
    die($e);
  }