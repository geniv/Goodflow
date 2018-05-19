<?php
/*
 *      administration.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  final class Administration {

    protected $menu_template = NULL;
    protected static $get_adress = array('admin', 'co');

    public function __construct() {
      $this->menu_template = $this->getMenuTemplate();
    }

    public static function getGetAdress() {
      return self::$get_adress;
    }

    protected function getMenuTemplate() {
      $menu = array('MenuHome',
                    'MenuDirs',
                    'MenuPictures',
                    'MenuSettings',
                    );

      $result = array();
      foreach ($menu as $polozka) {
        $result[$polozka::URL] = array ('class' => $polozka,
                                        'name' => $polozka::getName(),
                                        );

      }

      return $result;
    }

    //aktualni get adresa
    public static function getCurrentAdress($uroven = 0) {
      return Core::isFill($_GET, self::$get_adress[$uroven]);
    }

    //title adminu
    public function getAdminTitle() {
      $result = NULL;
      $current = $this->getCurrentAdress();
      $item = Core::isFill($this->menu_template, $current); //$this->menu_template[$current]['name'];
      if (!empty($item)) {
        $result = $item['name'];
      }
      return $result;
    }

    //menu adminu
    public function getAdminMenu() {
      $item = array();
      $absoluteurl = Core::getAbsoluteUrl();
      $current = $this->getCurrentAdress();
      foreach ($this->menu_template as $url => $name) {
        $adress = (!empty($url) ? array(self::$get_adress[0] => $url) : NULL);
        $item[] = Html::elem('a')
                      ->href($absoluteurl, $adress)
                      ->setText($name['name'])
                      ->class($current == $url ? 'active' : NULL)
                      ->title($name['name'])
                      ->setNewLine('')
                      ;
      }
      $result = implode(Html::elem('span')->setText('/')->setNewLine(''), $item);

      return $result;
    }

    //obsah adminu
    public function getAdminContent() {

      $current0 = $this->getCurrentAdress();
      $current1 = $this->getCurrentAdress(1);

//ze by tam byla nejaka trida observer ktara by dle instance sefovala co se ma kam ulozit, vykonat...
//--musi se volat cela funkce tak aby bylo mozno i testovat ruzne stavy
//--slozeni: obaleno ve tride: metoda pro kazdou sekci; formular + obsluha vstupu (tak aby bylo mozne testovat po formularich)
//vytvori si instanci a bude z toho dle adresy tahat obsahy atp...
//formulare budou definovany primo v tride, volit se budou dle adresy
//->setText($content[$current0][$current1]) // osetrit neexistujici adresu!! s presmerovanim do hlavniho korene ['']['']
//->setText($this->getAdminSubMenu())

      $text = NULL;
      $item = Core::isFill($this->menu_template, $current0);  //$class = $this->menu_template[$current0]['class'];
      if (!empty($item)) {
        $class = $item['class'];
        $text = $class::getContent($current1);
      }

      $result = Html::elem('div')
                    //->setText("--toto je hlavicka kazde admin stranky?--<hr />\n")
                    ->setText($text)
                    ;

      return $result;
    }
  }

?>
