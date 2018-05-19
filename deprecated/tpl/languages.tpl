{*<?*}jazyky....

{code}
$sekce = classes\Section::build($weburl_admin.'languages/', '$admin_uri.subblock', '$admin_uri.subaction');
$sekce
    ->setTable('languages', 'idlanguage')
    ->setRefreshTime($global_configure['admin']['sectionRefreshTime'])
    ->setFormCode('
{text:code|$|maxlength|:|5|,|placeholder|:|tu ma byt code|,|class|:|form-control|@|filled|:|nazev musi byt vyplneno!}*<br/>
{text:name|$|maxlength|:|45|,|placeholder|:|tu ma byt nazev|,|class|:|form-control|@|filled|:|nazev musi byt vyplneno!}*<br/>
    ')
    ->setList()
    ->setAdd()
    ->setEdit()
    ->setDel();
{/code}

{compile="$sekce->render()"}