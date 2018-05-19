<?php
/*
 *      index.php
 *
 *      Copyright 2011 server <geniv.radek@gmail.com>
 *
 */

  //load autoload
  require '../loader.php';

  use classes\Core,
      classes\Html,
      classes\HtmlPage,
      classes\Language;

  //overeni jestli existuje pripojeni pro jazyky
  if (file_exists('../classes/language.php')) {
    Language::getInstance()->setLanguage(Config::LANG);
    Language::getInstance()->setDefaultLanguage('cs');
    Language::getInstance()->loadGettext('../');
    //var_dump(Language::getInstance()->getState());
  }
  $status = Core::isFill($_SERVER, 'REDIRECT_STATUS');  //cislo error statusu
  if (!empty($status)) {
    $type = array(400 => array('short' => _('Špatná žádost'), 'long' => _('Žádost nemůže být zpracována.')),
                  401 => array('short' => _('Neoprávněný přístup'), 'long' => _('Pro vstup do této sekce nemáte dostatečná oprávnění.')),
                  403 => array('short' => _('Zakázáno'), 'long' => _('Vaše operace byla zakázána.')),
                  404 => array('short' => _('Nenalezeno'), 'long' => _('Požadovaná stránka není k dispozici.')),
                  500 => array('short' => _('Vnitřní chyba serveru'), 'long' => _('Omlouváme se, vyskytla se chyba.')),
                  503 => array('short' => _('Služba není k dispozici'), 'long' => _('Požadovaná služba není momentálně k dispozici.')),
                  );

    $url = Core::getUrl();

    $title = Core::implodeTitle(array($status, $type[$status]['short'], Config::PROJECT_NAME));
    $page = new HtmlPage(HtmlPage::DOCTYPE_STRICT);  //DOCTYPE_STRICT DOCTYPE_HTML5
    $page->setLanguage(Config::LANG)
          ->setUrlPage($url)
          ->addMeta('author', 'GoodFlow design - Tvorba webových stránek a systémů (www.gfdesign.cz)')
          ->addMeta('copyright', 'Created by GoodFlow design')
          ->addMeta('keywords', '')
          ->addMeta('description', $title)
          ->addMeta('robots', 'noindex, nofollow')
          ->loadCSS('error.css')
          ->setTitle($title)
          ->setBodyId(sprintf('error_%s', $status))
          ->addBody(Html::h1()->setText(implode(' - ', array($status, $type[$status]['short']))))
          ->addBody(Html::p()->setText($type[$status]['long']))
          ->addBody(Html::p()->setText(sprintf(_('Můžete se zkusit vrátit o %s.'), Html::a(array('href' => 'javascript:history.go(-1)', 'title' => _('Zpět o stránku')))->setText(_('stránku zpět klapnutím na tento odkaz')))))
          ->addBody(Html::p()->setText(sprintf(_('Nebo můžete následovat %s'), Html::a(array('href' => Core::getUrl(array('path' => '../')), 'title' => sprintf(_('Na hlavní stranu webu %s'), Config::PROJECT_NAME)))->setText(sprintf(_('tento odkaz, který Vás zavede na hlavní stránku webu %s'), Config::PROJECT_NAME)))));
    echo $page;
  } else {
    Core::setRefresh(1, Core::getUrl(array('path' => '../')));
  }
?>
