<?php
/*
 * crate.php
 *
 * Copyright 2013 geniv <geniv.radek@gmail.com>
 *
 * prepravka pro instance
 */

  /**
   * prepravka instanci
   *
   * @package unstable
   * @author geniv
   * @version 1.18
   */
  final class Crate extends classes\ObjectArray {

    /**
     * defaultni konstruktor
     *
     * @since 1.00
     * @param array pole vstupni pole
     */
    public function __construct($pole, $path) {
      parent::__construct($pole);



      // nacitani hlavni konfigurace
      $this->configure = classes\Configurator::decode($path . 'global_config.php');
      // nacteni konfigurace databaze
      $db_conf = classes\Configurator::decode($path . 'database_config.php');

      $this->weburl = classes\Core::getUrl();
      $this->weburl_admin = $this->weburl . $this->configure['admin']['url'];

      // nastaveni time zony
      classes\DateAndTime::setDateTimezone($this->configure['date_timezone']);
//~ var_dump($db_conf);

      //TODO aplikace: user, session, ACL !!!! + session

      // cache *****************************************************************
      $cache = classes\Cache::OB();
      $cache->setEnabled($this->configure['cache']['enabled'])
            ->setExpiration($this->configure['cache']['expire']);
      $this->cache = $cache;

      // html - zapnuti zalamovani tagu
      //~ $this['html']::setBreakDepth(true);


      // router model **********************************************************
      $model = array(
          'action',
          'action==' . $this->configure['admin']['url'] . '/section/id',  // pravidlo pro
           //TODO domyslet dalsi...
      );


      // menu ******************************************************************
      $menu = classes\Menu::simple($this->configure['menu'], $model, 'home');
      $this->menu = $menu;
      $this->uri = $menu->getUri();


      // tpl *******************************************************************
      $tpl = new classes\Tpl($this->configure['tpl']);
      $this->tpl = $tpl;


      // mazani automaticky vygenerovaneho obsahu
      if ($this->configure['system']['clearall']) {
        $cache->clearAll();
        $this->tpl->clearAll();
      }

      // testovaci promena ******************************************************
      $this->ahoj = 'ahoj vole, jak se mas?';
      
      
      
      
//~ var_dump($this->menu->getNames());

//TODO autorizaci pro pristup do souboru!!!
      // prepinani indexu a adminu
      $this->main_index_tpl = 'index';
      if (isset($this->uri['action']) && $this->uri['action'] === $this->configure['admin']['url']) {
        $this->main_index_tpl = 'admin/index';  // sahne do slozky adminu

        //TODO po zadani adresy adminu se bude snazit autorizovat pro admin, a nebo ubde primo dialog do adminu primo pod tim linkem s tim ze ten link se zobrazi jen nekomu nebo jen nekterym prohlizecum

        //~ var_dump($this->uri);//TODO predat routovaci na adminu...
      }
    }
  }
