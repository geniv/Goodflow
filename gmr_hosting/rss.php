<?php

  require 'loader.php'; // load autoload

  try {

    if (classes\Core::checkPHP()) {

      // data prochazejici celym kodem
      $mainClass = new MainClass;
      // inicializace webu
      $mainClass->initialization();
//TODO jestli se bude dal pouzivat vystup se musi cachovat!!!
      $it = $mainClass->getRssNovinky();

      $rss = new \SimpleXMLElement('<rss version="2.0" encoding="utf-8"></rss>');
      $channel = $rss->addChild('channel');
      $channel->addChild('title', $mainClass->configure['htmlpage']['title']);
      $channel->addChild('link', $mainClass['weburl'].'rss');
      $channel->addChild('description', $mainClass->configure['htmlpage']['description']);
      $channel->addChild('language', 'cs');
      $channel->addChild('docs', $mainClass['weburl'].'rss.php');
      $channel->addChild('generator', 'PHP SimpleXML');
      $channel->addChild('pubDate', date('r'));
      foreach ($it as $v) {
        $item = $channel->addChild('item');
        $item->title = $v->nadpis;
        $item->link = $mainClass['weburl'].'novinky/'.$v->idnovinky;
        $item->description = $v->zprava;
        $item->pubDate = classes\DateAndTime::from($v->pridano)->format('r');
      }
      echo $rss->asXML();
    }

  } catch (Exception $e) {
    die($e);
  }