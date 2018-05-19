<?php

  namespace _admin\pages;

  use classes\IPage,
      classes\Core,
      classes\ContentValues,
      classes\Form;

  class Spravce_Home implements IPage {
    //nazev a ruzne promenne
    public static function getName() {
      return array('name' => 'Uprava dat správce',
                  'name_blok' => 'Správce',
                  );
    }

    //~ // extra JS pro danou stranku
    //~ public static function getJS($data = null) {
      //~ $class = str_replace('\\', '/', __CLASS__);
      //~ return array('external' => array('js/tinymce/jscripts/tiny_mce/tiny_mce.js'),
                    //~ 'embed' => <<<JS
//~ 
      //~ tinyMCE.init({
        //~ mode : "textareas",
        //~ theme : "advanced",
        //~ skin : "o2k7",
        //~ plugins : "safari,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,visualblocks,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,imagemanager,filemanager",
//~ 
        //~ // Theme options
        //~ theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        //~ theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        //~ theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        //~ theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,blockquote,pagebreak",
        //~ theme_advanced_toolbar_location : "top",
        //~ theme_advanced_toolbar_align : "left",
        //~ theme_advanced_statusbar_location : "bottom",
        //~ theme_advanced_resizing : true,
//~ 
        //~ schema: "html5",
//~ 
        //~ // HTML5 formats
        //~ style_formats : [
                //~ {title : 'h1', block : 'h1'},
                //~ {title : 'h2', block : 'h2'},
                //~ {title : 'h3', block : 'h3'},
                //~ {title : 'h4', block : 'h4'},
                //~ {title : 'h5', block : 'h5'},
                //~ {title : 'h6', block : 'h6'},
                //~ {title : 'p', block : 'p'},
                //~ {title : 'div', block : 'div'},
                //~ {title : 'pre', block : 'pre'},
                //~ {title : 'section', block : 'section', wrapper: true, merge_siblings: false},
                //~ {title : 'article', block : 'article', wrapper: true, merge_siblings: false},
                //~ {title : 'blockquote', block : 'blockquote', wrapper: true},
                //~ {title : 'hgroup', block : 'hgroup', wrapper: true},
                //~ {title : 'aside', block : 'aside', wrapper: true},
                //~ {title : 'figure', block : 'figure', wrapper: true}
        //~ ],
//~ 
        //~ language : "cs"
      //~ });
//~ 
      //~ function rewrite(text, target) {
        //~ $.post("{$data['weburl']}../ajax.php", "class={$class}&method=getRewriteName&text="+text, function(response) {
          //~ $(target).val(response);
        //~ });
      //~ }
//~ 
//~ JS
                  //~ );
    //~ }

    // extra CSS pro danou stranku
    //~ public static function getCSS() {}

    // rewrite prepis nazvu do url
    //~ public static function getRewriteName($data, $args) {
      //~ return strtolower(Core::getInteligentRewrite($args['text']));
    //~ }

    //obsah
    public static function getContent($data = null) {
      $tpl = $data['tpl'];
      $spravce = $data['spravce'];
      //~ $html = $data['html'];
      $f = $data['form_global'];
      //~ $url = $data['weburl'];
      $uri = $data['web_uri'];
      $db = $data['db'];
//~ var_dump($uri);
      $blok = (isset($uri['blok']) ? $uri['blok'] : '');
      $id = (isset($uri['id']) ? $uri['id'] : '');

      $result = null;
      $dbVypis = null;
      $frm_out = null;
$result = 'editace neceho u spravcu';
      //~ $f//->addSelect('aktuality_jazyk')
        //~ ->addText('novinky_nadpis', 'Nadpis novinky', null, array('class' => 'dlouhy', 'maxlength' => 100, 'onkeydown' => 'rewrite(this.value, \'.rewrite\');', 'onchange' => 'rewrite(this.value, \'.rewrite\');'))
          //~ ->setRequired('Je nutne vyplnit nadpis')
          //~ ->addRule(Form::MAX_LENGTH, 'maximální délka je %s', 100)
        //~ ->addText('novinky_url', 'url novinky', null, array('maxlength' => 100, 'readonly' => true, 'class' => 'rewrite dlouhy'))
          //~ ->setRequired('Je nutne vyplnit url novinky')
        //~ ->addTextArea('novinky_zprava', 'Zpráva novinky')
          //~ ->setRequired('Je nutne vyplnit zprávu');
//~ 
      //~ switch ($blok) {
        //~ default:
          //~ $result = ''; //tady je pridavny text u vypisu z databaze...?!
//~ 
          //~ $dbVypis = $db->query('novinky', array('idnovinky', 'idspravce', 'nadpis', 'zprava', 'pridano', 'upraveno'), 'smazano is null', null, null, null, 'pridano DESC');
        //~ break;
//~ 
        //~ case 'add': // pridani aktuality
          //~ $backUrl = Core::getRequestUrl(null, -1);
//~ 
          //~ $f->addBackLink('zpět', $backUrl)
            //~ ->addSubmit('add_novinky', null, 'Přidat zprávu');
//~ 
          //~ $result = $f->render();
//~ 
          //~ if ($f->isSubmitted()) {
//~ 
            //~ if ($f->isValid()) {
              //~ $val = $f->getValues();
//~ 
              //~ $c = new ContentValues;
              //~ $c->put('idspravce', $spravce->getIdentity()->getId())
                //->put('idjazyka', )
                //~ ->put('nadpis', $val['novinky_nadpis'])
                //~ ->put('url', $val['novinky_url'])
                //~ ->put('zprava', $val['novinky_zprava']) //htmlentities
                //~ ->putDate('pridano');
//~ 
              //~ $res = $db->insertOrThrow('novinky', $c);
//~ 
              //~ if ($res > 0) {
                //~ $result = 'přidáno: '.$val['novinky_nadpis'];
                //~ Core::setRefresh(1, $backUrl);
              //~ } else {
                //~ $result = 'nepodařilo se přidat';
              //~ }
//~ 
            //~ } else {
              //~ $frm_out = $f->getErrors();
            //~ }
          //~ }
        //~ break;
//~ 
        //~ case 'edit':  // editace aktuality
          //~ $backUrl = Core::getRequestUrl(null, -2);
//~ 
          //~ if (is_numeric($id)) {
            //~ $edit = $db->query('novinky', array('nadpis', 'url', 'zprava'), 'idnovinky=?', array($id));  //vyber radku z db
            //~ if ($edit->hasNext()) { //nacteni zaznamu
              //~ $d = $edit->nextRow();
//~ 
              //~ $f->addBackLink('zpět', $backUrl)
                //~ ->addSubmit('edit_novinky', null, 'Upravit zprávu');
//~ 
              //~ $f->setDefaults(array(
                                    //~ 'novinky_nadpis' => $d->nadpis,
                                    //~ 'novinky_url' => $d->url,
                                    //~ 'novinky_zprava' => $d->zprava,
                                    //~ )
                              //~ );
//~ 
              //~ $result = $f->render();
//~ 
              //~ if ($f->isSubmitted()) {
                //~ if ($f->isValid()) {
                  //~ $val = $f->getValues();
//~ 
                  //~ $c = new ContentValues;
                  //~ $c//->put('idspravce', $spravce->getIdentity()->getId())
                    //->put('idjazyka',)
                    //~ ->put('nadpis', $val['novinky_nadpis'])
                    //~ ->put('url', $val['novinky_url'])
                    //~ ->put('zprava', $val['novinky_zprava'])
                    //~ ->putDate('upraveno');
//~ 
                  //~ $res = $db->update('novinky', $c, 'idnovinky=?', array($id));
                  //~ if ($res > 0) {
                    //~ $result = 'upraveno: '.$val['novinky_nadpis'];
                    //~ Core::setRefresh(1, $backUrl);
                  //~ } else {
                    //~ $result = 'nepodařilo se upravit';
                  //~ }
                //~ } else {
                  //~ $frm_out = $f->getErrors();
                //~ }
              //~ }
            //~ } else {
              //~ $result = 'neexistuje v databazi!';
            //~ }
          //~ } else {
            //~ $result = 'neni vybrane ID!';
          //~ }
        //~ break;
//~ 
        //~ case 'del': // smazani aktuality
          //~ $backUrl = Core::getRequestUrl(null, -2);
//~ 
          //~ if (is_numeric($id)) {
            //~ $c = new ContentValues;
            //~ $c->putDate('smazano');
//~ 
            //~ $res = $db->update('novinky', $c, 'idnovinky=?', array($id));
            //~ if ($res > 0) {
              //~ $result = 'smazano';
              //~ Core::setRefresh(1, $backUrl);
            //~ }
//~ //TODO pro CRONa vystup hodnot ktere podlehaji zkaze, expirace uzivatelu respektive smazanych udaju!
          //~ } else {
            //~ $result = 'neni vybrane ID!';
          //~ }
        //~ break;
      //~ }

      $assign = array(
                      'addLink' => Core::getRequestUrl('add'),
                      'editLink' => Core::getRequestUrl('edit'),
                      'delLink' => Core::getRequestUrl('del'),

                      'url_blok' => $blok,
                      //~ 'url_id' => $id,

                      'dbVypis' => $dbVypis,

                      'formular' => $result,
                      'formular_out' => $frm_out,
                      );
      $tpl->assign($assign);

      return $tpl->template('webadmin/spravce_home')->render();
    }
  }
