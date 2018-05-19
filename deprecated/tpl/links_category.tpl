{*<?*}odkazy/kategorie....<br/>

{code}
//@deprecated (momentalne!!!!)
{/code}

{if="isset($uri.subaction) && $uri.subaction==''"}
  <a href="{$weburl_admin}links/category/add">add</a><br />
  {loop="$db->rawQuery('SELECT idlink_category, languages_has_links_category.name FROM links_category JOIN languages_has_links_category USING(idlink_category) JOIN languages USING(idlanguage) WHERE languages.code=?', array('cs'))"}
    {$value->idlink_category}, {$value->name}
    <a href="{$weburl_admin}links/category/edit/{$value->idlink_category}">edit</a>
    <a href="{$weburl_admin}links/category/del/{$value->idlink_category}" onclick="return confirm(\'Opravdu chceš smazat: &quot;{$value[1]}&quot; ?\')">del</a><br />
  {/loop}
{/if}

{if="isset($uri.subaction) && $uri.subaction=='add'"}
  {code}
    $f = '';
    foreach ($db->query('languages', array('code', 'name')) as $val) {
      $f .= $val->name.': {text:name['.$val->code.']|maxlength:100;placeholder:preklad pro '.$val->name.'||filled:musí být '.$val->name.' vyplneno}<br />'.PHP_EOL;
    }
    $f .= '{submit:;Přidat}';
    $sectionForm = $form::compile($f)->setAutoHide();
  {/code}
  {$sectionForm}

  {if="$sectionForm->isSubmitted()"}
    {if="$sectionForm->isValid()"}
      {$val = $sectionForm->getValues()}
      {$val|var_dump}
    {else}
      {loop="$sectionForm->getErrors()"}
        chyba: {$value}<br />
      {/loop}
    {/if}
  {/if}

{/if}

{if="isset($uri.subaction) && $uri.subaction=='edit'"}
edit...
{/if}

{if="isset($uri.subaction) && $uri.subaction=='del'"}
del...
{/if}





{*

SELECT languages.code, languages_has_links_category.name FROM links_category
JOIN languages_has_links_category USING(idlink_category)
JOIN languages USING(idlanguage)

SELECT languages_has_links_category.name FROM languages_has_links_category
JOIN languages USING(idlanguage)
WHERE languages.code="en"

SELECT languages_has_links_category.name FROM languages_has_links_category
JOIN languages USING(idlanguage)
WHERE languages.code="de"

SELECT languages_has_links_category.name FROM languages_has_links_category
JOIN languages USING(idlanguage)
WHERE languages.code="cs"

*}

{*compile="$builder->render()"*}