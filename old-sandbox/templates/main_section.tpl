{*<?*}
<hr />
<a href="{$weburl}">domu</a><br />
<hr />
{*compile="$section_builder"*}
<hr />

{code}

$k0 = 'hoj';

$codf = '{*
  {text:dfsfq1}<br />
  {text:nazev2;vialue}<br />
  {text:nazev3;vialue|class:a;id:asdf}<br />
  {text:nazev3|||filled:vole vypln to;range:dfd:[4,6]}<br />
  {text:nazev4;vialue|||filled:vole vypln to;range:dfd:[4,6]}<br />
  {text:nazev5|placeholder:bleee;class:ggg||filled:vole vypln to}<br />
  {text:nazev6;vialue|placeholder:bleee;class:ggg||filled:vole vypln to}<br />
  <hr/>
  ';
  foreach (array('cs', 'en', 'de') as $value) {
      $codf .= '{text:nazev11['.$value.']|maxlength:100;placeholder:preklad pro '.$value.'||filled:musí být '.$value.' vyplneno}
  ';
  }



  $codf .= '
  <hr/>
  {select:sel1;;{vejběr, cs: česky, en: anglicky, de: německy}}<br />

  {select:sel2;;{výběr položky, europe: {cs: česky, de: dojčasky}, word: {en: englišsky, uk: ukrajinsky}}}<br />

  {checkbox:chck1;potrebne value2|class:sdsd}<br />;:checked
  {checkbox:chck2;potrebne value1|class:sdsd}<br />

  {radio:rad;va1|:checked}<br />
  {radio:rad;va2}<br />
  {radio:rad;va3}<br />

  {file:fileese}<br />

  {image:blee|src:icon_services_4.png}

  {file:fileese}<br />

  {reset:hviiii}

  {email:sdsdsad}
  {url:dfsdfdf}
  {tel:dfsdf}
  {number:dsfdfds}
  {range:dsfdsfsd}
  {search:dsfsdf}
  {color:wqe}

  {date:sdsadsdff}
  {week:fsdff}
  {month:afswe}
  {time:fdsfds}
  {datetime:fdsfsd}
  {datetime-local:fdsdsad}

  textik: {text:nazev2;vialsdhjgtue|||more:test podminka pri hodnote "%value" a (%s-):10}<br />
64 * 1024

{file:fileesdsfs|||filled:vyplnit1!;maxfilesize:je cet takovy makovy1?:1024000;mimetype:sdsdsd1:application/pdf}kb
  {file:fileese[]|:multiple||filled:vyplnit2!;maxfilesize:je cet takovy makovy2?:1024000;mimetype:sdsdsd2:application/pdf}kb


  {select:sel11;
- vejběr
cs: česky
en: anglicky
de: německy}<br />

  {select:sel12;
- vejběr
cs: česky
en: anglicky
de: německy|class:dsff}<br />

  {select:sel13;
- vejběr
cs: česky
en: anglicky
de: německy|class:dsff||filled:omgmm}<br />

  {select:sel22;
- výběr položky
europe:
  cs: česky
  de: dojčasky
word:
  en: englišsky
  uk: ukrajinsky|class:hovno}<br />


  {select:sel23;
- výběr položky
europe:
  cs: česky
  de: dojčasky
word:
  en: englišsky
  uk: ukrajinsky|class:hovno||~equal:sdffdf:0}<br />

  {select:sel21[];
- výběr položky
europe:
  cs: česky
  de: dojčasky
word:
  en: englišsky
  uk: ukrajinsky|:multiple;size:10}<br />

{hidden:nazev1;value2}
{button:bleee;valueoooo}

{text:old1|list:omg2}

{datalist:omg2;
- internet cosik
- operat
- chrome
- firefox buldozer
- safari jungle}


{text:nazev4;vialue|$|placeholder:ssdfdsfupa je|,|class:hovinkko|,|id:kakinko|@|filled|:|vole&scaron; vydsd &nbsp;pln to|,|range|:|dfd|:|[6,50]|,|minlength|:|minimalni delka musi bejt|:|65}<br />

{text:nazev;value|$|attr:value|,|....|@|~rules|:|text|:|argv|,|equal|:|skdsjdksjd|:|fakjahel|,|filled|:|sdksakjdskajd}

{text:nazev|$|attr:value}

{text:nazev}

{text:nazev;val}

{text:nazev;value|$|readonly|,|multiple|,|class|:|sdsdsd}

{text:nazev;value|@|~range|:|texticek|:|[15,25]|,|equal|:|skdsjdksjd|:|fakjahel|,|filled|:|sdksakjdskajd}

{text:nazev;value|@|~pattern:musi vyhovovat vyrazu|:|[a-zA-Z]+}

  {text:old1|$|list|:|omg2}
{datalist:omg2;
- internet cosik
- operat
- chrome
- firefox buldozer
- safari jungle}

  {text:nazev;value|@|minlength|:|musi vyhovovat vyrazu|:|5}

{select:sel21[];
- výběr položky
europe:
  cs: česky
  de: dojčasky
word:
  en: englišsky
  uk: ukrajinsky|$|multiple|,|size|:|10|@|count|:|mi byt vybrano pocet: %s|:|3}<br />

  {file:fileese[]|$|multiple|@|count|:|musi byt pocet|:|3|,|filled|:|vyplnit file!|,|maxfilesize|:|dodrzet max size|:|1024000|,|mimetype|:|musi byt typu|:|application/pdf}

  {text:nazev|@|is_in|:|..%name %value..|:|55}

  filled|:|vyplnit|,|
  {file:nazev|@|filled|:|prazdnota|,|maxfilesize|:|....|:|1024000}
  {file:nazev[]|$|multiple|@|maxfilesize|:|....|:|1024000}
    {checkbox:chck2}<br />


  {checkbox:chck3}<br />

  {file:nazev|@|maxfilesize|:|....|:|1024000}

  {radio:rad;va1}<br />
  {radio:rad;va2}<br />
  {radio:rad;va3}<br />
  <br />

  {text:nazev;value|@|filled|:|musi byt vyplneno|,|range|:||:|[10, 15]}

|,|equal|:||:|15|,|range|:||:|[15, 30]

  {select:nazev0}

  {select:nazev1;[a, b, c]}
  {file:nazev|@|maxfilesize:...:5}
  {file:nazev|@|filled|:|}
    {select:sel21[];
- výběr položky
europe:
  cs: česky
  de: dojčasky
word:
  en: englišsky
  uk: ukrajinsky|$|multiple|,|size|:|10|@|is_in|:||:|[cs, de]}<br />

  {text:nazev|@|moreorequal|:|..<=..|:|10}

  {text:n1[cs]}
  {text:n1[en]}
  {text:n1[de]}

  {text:n2}

  {select:nazev[];
- výběr položky
europe:
  cs: česky
  de: dojčasky
word:
  en: englišsky
  uk: ukrajinsky|$|multiple|,|size|:|10|@|count|:|mi byt vybrano pocet: %s|:|3}

gg: {text:n2}<br />

n: {radio:_acltype['.$k0.'];none} - a: {radio:_acltype['.$k0.'];allow} - d: {radio:_acltype['.$k0.'];deny}

text2: {text:n2|@|filledor|:|musi byt vyplnen pokud neni %s vyplnen|:|n1}

text2: {text:n2}
nebo
text3: {text:n3|@|filledor|:|musi byt vyplnen pokud neni minimalne jeden vyplnen|:|[n1, n2]}
uplne nebo:
text4: {text:n4|@|filledor|:|musi byt vyplnen pokud neni %s, %s nebo %s vyplnen|:|[n1, n2, n3]}

text1: {text:n1}
nebo

{select:n2;
- výběr položky
europe:
  cs: česky
  de: dojčasky
word:
  en: englišsky
  uk: ukrajinsky|@|filledor|:|musi byt vyplnen pokud neni %s vyplnen|:|n1}

  {text:ahoj|@|pattern|:|....|:|W1wtMC05XVx7MyxcfVw6WzAtOV1cezIsXH1cOlswLTldKw==}
  {text:ahoj00[]|@|filled|:|upsi}
  {text:ahoj1[a][]|@|filled|:|upsi}

[\-0-9]+\:[0-9]+(\:[0-9]{1,})?
pattern
musí vyhovovat KUID formátu: xxxx:yyyy nebo xxxx:yyyy:zz pro kuid2
W1wtMC05XStcOlswLTldKyhcOlswLTldezEsfSk/

  {text:ahoj000|@|filled|:|upsi}

  {text:ahoj0[a]|@|filled|:|upsi}


  {text:ahoj1ky[a][b]|@|filled|:|upsi}

  ds sd sd sd
  {text:ahoj2|@|pattern|:|....|:|[0-9]+|,|filled|:|upsi}
  s dsdsad

  kuid{text:kuidik|$|maxlength|:|30|,|class|:|kuid|@|filled|:|Musí být vyplněno}
  |:|musi byt vyplnen pokud neni %s vyplnen|:|n1

{select:n2[];
- výběr položky
europe:
  1: česky
  2: dojčasky
word:
  3: englišsky
  4: ukrajinsky|$|multiple|,|size|:|10}

{select:n1[0][];
- výběr položky
europe:
  cs: česky
  de: dojčasky
word:
  en: englišsky
  uk: ukrajinsky|$|multiple|,|size|:|10}


{select:n2[0][];
- výběr položky
europe:
  1: česky
  2: dojčasky
word:
  3: englišsky
  4: ukrajinsky|$|multiple|,|size|:|10}


{select:n2[1][];
- výběr položky
europe:
  1: česky
  2: dojčasky
word:
  3: englišsky
  4: ukrajinsky|$|multiple|,|size|:|10}

{select:n1[];
- výběr položky
europe:
  1: česky
  2: dojčasky
word:
  3: englišsky
  4: ukrajinsky|$|multiple|,|size|:|10}

{select:n1|$|multiple|,|size|:|10}

{text:ahoj1ky1|@|filled|:|upsi}
{text:ahoj1ky2|@|filled|:|upsi}

{select:n2[]|$|multiple|,|size|:|10}

{file:nazev[1]}
{file:nazev[2]}
{file:nazev[3]}

{img:obrazek}

{link:file_from_db;weburl/|$|class|:|odkazik}
super nazev
{/link}

  {text:name[2];en|$|class|:|ajax_downloads_name}
  {text:name[3];de|$|class|:|ajax_downloads_name}
*}

{text:ahoj1ky|$|class|:|opla|@|filled|:|.....}


  {text:name[1]|$|maxlength|:|100|,|placeholder|:|Název Čeština|,|class|:|large ajax_downloads_name|,|id|:|nadpis_cs_lb|@|filled|:|Název Čeština musí být vyplněn!}


{label:file_from_db}

  {submit:;asi odeslat}

  ';
  //'chck' => true, 'rad' => true,  'chck' => 'vali',
  $ff = $tplform::compile($codf)->setDefaults(array('obrazek' => 'icon_services_4.png', 'file_from_db' => 'fiiiiileeeeeeee', 'n1X' => array('cs' => 'aa', 'en' => 'bbb', 'de' => 'cccc'), 'n2X' => 'fff', 'ahoj' => 'hujj', 'ahoj1kyX' => array('a' => array('b' => 'kviiii'))))
            ->setReturnValues($_POST)
            ->setAutoHide(true)
            ->setSubmitBlocker(true)
            ->setSubmitSecurity(true)
            ;
  //~ $ff->setSubmitBlocker(true);
  //array('rad' => 'va2', 'chck2' => false, 'chck3' => false, 'sel21X' => array('en', 'de'))
  //, array('nazev11')
  //~ $ff->setItems('n1', array('cs' => 'ahoj', 'en' => 'vole', 'de' => 'co je?'));
  //~ $ff->setItems('n2[]', array('blik', 'cs' => 'ahoj', 'en' => 'vole', 'de' => 'co je?'));
  //~ $ff->setValue('ahoj1ky', 'hviiiiiii');
  //~ $ff->setDefaults(array('_acltypeX' => 'deny'));
  //'nazev' => 'blee', 'nazev11' => array('cs' => 'ahoj', 'en' => 'vole', 'de' => 'co je?'), 'dfsf' => 'kviuii', 'sel1' => 'cs', 'sel2' => 'cs'
  //{$ff->addSubmit(null, 'odeslati', 'class:hovinko')}
  //~ $prenos = 'ahojky';
//~ var_dump($_SERVER);
  //~ $ff->removeRule('ahoj1ky', 'filled');

//~ $ff->setAttribute('ahoj1ky', 'value', 'hovinko')
  //~ ->setAttribute('ahoj1ky', 'checked', true);

  //~ $ff->addRule('nazev', 'filled', 'vyplnit poel');

  //~ $ff->addRule('kuidik', 'pattern', 'musí vyhovovat KUID formátu: xxxx:yyyy nebo xxxx:yyyy:zz pro kuid2', '[\-0-9]+\:[0-9]+(\:[0-9]+)?');


  //~ if ($db->beginTransaction()) {
    //~ do {
      //~ var_dump('hh1');
      //~ var_dump($db->inTransaction());
      //~ $db->rollBack();
      //~ break;
      //~ var_dump('defekt');
      //~ $db->endTransaction();
    //~ } while (0);
  //~ }

    //~ if ($db->beginTransaction()) {
      //~ do {
        //~ %%row_id%% = $db->insert(\''.$this->table.'\', $_cv);
        //~ '.$_code_post_insert.'
        //~ $db->endTransaction();  // legalni ukonceni transakce
      //~ } while(0); // pro vyskoceni: $db->rollBack(); break;
    //~ }

    //~ do {
      //~ if ($db->beginTransaction()) {
        //~ //code
        //~ //code
        //~ //code
        //~ // $db->rollBack(); break;
        //~ //jiny kod
        //~ $db->endTransaction();  // legalni ukonceni transakce
      //~ }
    //~ } while (0);  // pro vyskoceni: $db->rollBack(); break;
//~ var_dump('hhg33');

  //~ do {
    //~ break;
    //~ var_dump('HH NE!');
  //~ } while(0);
  //~ var_dump('HH JO');

//~ $c = 99;
  //~ $ff->addRule('ahoj1ky1', function ($a, $b) use ($c) { var_dump($a, $b, $c); return $a == $b; }, 'musí splňovat podmínku closure1 !!!!', array(22, 33));

  //~ function vyhodnoceni($a, $b) {
    //~ var_dump($a, $b);
    //~ return $a == $b;
  //~ }
  //~ $ff->addRule('ahoj1ky2', 'vyhodnoceni', 'musí vyhovovat funkci', 12);

  //~ $func = function ($a, $b) {
    //~ var_dump($a, $b);
    //~ return $a || $b;
  //~ };
  //~ $ff->addRule('ahoj1ky1', $func, 'musí splňovat podmínku closure2 !!!!', array(11, 123));
//var_dump(file_exists(''), file_exists('/tmp/tpl-py9OcG'));
//pokus: {$core::getReplaceText($core::trimParagraphs($value->description, 1), array('/<p>/' => '<em>', '/<\/p>/' => '</em>'))}
//~ var_dump(strtotime('-14 days UTC') * 1000);
//~ var_dump(strtotime('1 day', 0));
//~ $range = range(strtotime('-14 days'), time(), strtotime('1 day', 0));
//~ var_dump($range);
//~ foreach ($range as $v) {
  //~ var_dump(date('d.m.Y H:i:s'));
//~ }

{/code}

{compile="$ff->render()"}


{/*
{$core::trimParagraphs('<p>toto je pokusny text v odstavci</p>
  <p>dsadsdsd</p>', 1)}



{$core::getReplaceText($core::trimParagraphs('<p>Keď ustavične z&aacute;pas&iacute;te s polyg&oacute;nmi, toto sa v&aacute;m možno hod&iacute;. Dekorat&iacute;vny spline vag&oacute;n Eas s minim&aacute;lnym počtom polyg&oacute;nov. Vag&oacute;n je v dvoch verzi&aacute;ch, pr&aacute;zdny a s n&aacute;kladom dreva. Pri rozťahovan&iacute; si treba dať pozor na spr&aacute;vne rozmery vag&oacute;nov!.</p>
<p>(počet polyg&oacute;nov, sa pri rozťahovan&iacute; samozrejme zvy&scaron;uje)</p>
<p>Polyg&oacute;ny: 98 pr&aacute;zdny, uvedene u objektu s drevom.</p>
<p>Polyg&oacute;ny: 98 pr&aacute;zdny, uvedene u objektu s drevom.</p>
<p>Polyg&oacute;ny: 98 pr&aacute;zdny, uvedene u objektu s drevom.</p>
<p>Polyg&oacute;ny: 98 pr&aacute;zdny, uvedene u objektu s drevom.</p>', 1), array('/<\/?[a-zA-Z0-9"= ]+>/' => ''))}



{$list = $db->rawQuery('SELECT kuid, trainz_kuids.name, url, idtrainz_cdp, trainz_cdp.name cdp_name, trainz_cdp.path cdp_path FROM trainz_kuids
                        JOIN downloads_has_trainz_kuid USING(idtrainz_kuid)
                        LEFT JOIN trainz_cdp_has_trainz_kuids USING(idtrainz_kuid)
                        LEFT JOIN trainz_cdp USING(idtrainz_cdp)
                        WHERE iddownload=?
                        GROUP BY idtrainz_kuid
                        ORDER BY CAST(kuid AS DECIMAL) ASC, kuid ASC', array(2))}

 {loop="$db->rawQuery('SELECT kuid, trainz_kuids.name, url, idtrainz_cdp, trainz_cdp.name cdp_name, trainz_cdp.path cdp_path FROM trainz_kuids
                        JOIN downloads_has_trainz_kuid USING(idtrainz_kuid)
                        LEFT JOIN trainz_cdp_has_trainz_kuids USING(idtrainz_kuid)
                        LEFT JOIN trainz_cdp USING(idtrainz_cdp)
                        WHERE iddownload=?
                        GROUP BY idtrainz_kuid
                        ORDER BY CAST(kuid AS DECIMAL) ASC, kuid ASC', array(2))"}

                        {/loop}

  r: {*$ff->render()*}<br />
*/}

  isSubmitted: {$ff->isSubmitted()}<br />
  isValid: {$ff->isValid()}<br />
  {/*<strong>security: {$ff->isSecurityValid()}</strong>*/}

<hr />
  success: {$ff->isSuccess()}<br />
  success(security): {$ff->isSuccess(true)}<br />

<hr />
  rules: {$ff->getRules()|print_r:true}
<hr />
  errors:<br />
  {loop="$ff->getErrors()"}
    chyba: {$value}<br />
  {/loop}
<hr />
  {$ff->getValues()|print_r:true}
<hr />
{**}



{*
{if="$ff->isSubmitted()"}
  {if="$ff->isValid()"}
    {$val = $ff->getValues()}
    values: {$val|print_r:true}

    {if="$user->login($val['login'], $val['hash'])->isLoggedIn()"}
      {$core::setLocation($weburl_admin)}
    {else}
      omg sorys spatna heslo zadat ty...
    {/if}

  {else}
    {loop="$ff->getErrors()"}
      chyba: {$value}<br />
    {/loop}
  {/if}
{/if}
*}
<hr /><hr />

{compile="$gui->render()"*}

{*compile_file="main_extra.tpl"*}


{*
  a dalsi komentar
*}
--
{/*
  toto je komentar!!!!
*/}
--


<hr />

{$debugger::viewTime()}