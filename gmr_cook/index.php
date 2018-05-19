<?php
/*
 * index.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 */

  require 'loader.php'; // load autoload

  try {
    if (classes\Core::checkPHP()) {

      classes\Debugger::startTime();

      // data prochazejici celym kodem
      $maindata = array(
                        'html' => 'classes\Html',
                        'form' => 'classes\Form',
                        'core' => 'classes\Core',
                        );

      $mainClass = new MainClass($maindata);
      $mainClass->initialization();

      //cache
      $cache = new classes\Cache;
      $cache->setCache($mainClass->configure['cache']['enabled'])
            ->setCacheExpire($mainClass->configure['cache']['expire'])
            //~ ->setExceptionUri(array('admin'))
            ;

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
                            );

        $web = new classes\Web($mainClass->configure['index_menu']);
        $web->setRoute($route_model);

        $mainClass['web'] = $web;
        $mainClass['web_uri'] = $web->getRoute()->getUri();

        // zapnuti zalamovani kodu
        $mainClass['html']::setBreakDepth(true);

        // TODO nejaky assigny
        //

        $mainClass->tpl->assign($mainClass->toArray());
        $assign = array(
                        'content' => $web->getContent($mainClass),
                        '' => '',
                        );
        $mainClass->tpl->assign($assign);

        $title = implode(' - ', array($mainClass->configure['htmlpage']['title'], $web->getTitle()));

        $page = new classes\HtmlPage;
        $page->setTitle($title)
            ->setUrl($mainClass->weburl)
            ->addMetaTag('author', 'GMR hosting, www.gmrhosting.cz')
            ->addMetaTag('keywords', $mainClass->configure['htmlpage']['keywords'])
            ->addMetaTag('description', $mainClass->configure['htmlpage']['description'])
            ->addMetaTag('robots', $mainClass->configure['htmlpage']['robots'])
            ->setBodyHtml($mainClass->tpl->template('index')->render());

        echo $page;

        $cache->setOutBuff();
      }

      echo classes\Debugger::viewTimes();

    } else {
      echo 'php neni v poradku';
    }

  } catch (Exception $e) {
    echo $e;
  }