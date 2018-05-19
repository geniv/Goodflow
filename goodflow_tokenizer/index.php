<?php
/*
 *      tokenizer.php
 *
 *      Copyright 2011 geniv <geniv.radek@gmail.com>
 *
 */

  //load autoload
  require 'loader.php';

  use classes\Form,
      classes\Html,
      classes\HtmlPage,
      classes\Core,
      classes\Connector,
      classes\Language,
      classes\JsonStorage,
      classes\Tokenizer;

  //vytvareni slozky pro vystup
  if (!file_exists(Config::OUTPUT_DIR)) {
    if (@!mkdir(Config::OUTPUT_DIR)) {
      echo sprintf(_('Nepodarilo se vytvorit slozku: %s'), Config::OUTPUT_DIR);
    }
  }

  $webpath = Core::getWebPath();
  $weburl = Core::getUrl();
  Tokenizer::setConnetion($webpath);
  Tokenizer::setWorkUrl($weburl);

  Language::getInstance()->setLanguage(Config::LANG);
  Language::getInstance()->setDefaultLanguage('cs');
  Language::getInstance()->loadGettext()->setAutoCreate();
  //var_dump(Language::getInstance()->getState());

  //echo Html::a()->hrefpath('kontakty', array('a' => 'neco', 'b' => 'skyredyho'), true)->title('Objednat servis u ZÁKAZNÍKA')->setText('Objednat servis u ZÁKAZNÍKA')->id('objednat_odkaz_1');

/*
$a = new Form;
$a->addSelect('elmem', array('value' => array('hodnoty', 'as' => 'a', 'bs' => 'b', 'cs' => 'c')))
    ->addRule(Form::RULE_NOTEQUAL, 'nemuze byt vybrana defaultni polozka', '0')
  ->addSubmit('butt');
  ;
echo $a;

if ($a->isSubmitted()) {
  var_dump($a->getValues());
}

if ($a->isErrors()) {
  echo $a->getErrors();
}
*/

  $wrap_layout = Html::div()->setText(Tokenizer::getContent());

  $encpath = Core::encodeData($webpath);
  $url = http_build_query(array('menu' => 'classes\Tokenizer', 'p' => $encpath, 'co' => ''));

  $page = new HtmlPage(HtmlPage::DOCTYPE_STRICT);  //DOCTYPE_STRICT DOCTYPE_HTML5
  $page->setLanguage(Config::LANG)
        ->setUrlPage($weburl)
        ->addMeta('author', 'GoodFlow design - Tvorba webových stránek a systémů (www.gfdesign.cz)')
        ->addMeta('copyright', 'Created by GoodFlow design')
        ->addMeta('description', 'blba poznamka')
        ->addMeta('robots', 'noindex, nofollow')
        //->loadCSS('styles/admin_global_styles.css')
        //->loadCSS(Core::isChrome() ? 'styles/admin_styles_webkit.css' : NULL)
        //->loadConditionalCSS($web_path.'styles/admin_styles_ie.css', 'IE')
        //->loadConditionalCSS('styles/admin_styles_ie7.css', 'IE>=7')
        //->loadConditionalCSS('styles/admin_styles_ie7.css', 'IE<=7')
        ->loadJavaScript('script/jquery/jquery-1.6.2.min.js')
        //->loadJavaScript('script/jquery/jquery-ui-1.8.14.custom.min.js')
        //->loadModules(Administration::getLoadModules())
        ->setTitle(Config::PROJECT_NAME)
        //->setFavicon('obr/favicon.ico', array('enabled' => false))
        ->addJavaScript(sprintf('
    //<![CDATA[
      function funcdel(id, co) {
        $.post("ajax.php", "%s"+co+"&id="+id, function(response) {
         alert(response);
         location.reload(true);
       });
       return false;
      }
    //]]>
    ', $url))
        //->addBodyClass('class_ahon')->addBodyClass('class_ahon')->setBodyId('mone_id')
        ->addBody($wrap_layout);
  echo $page;

?>
