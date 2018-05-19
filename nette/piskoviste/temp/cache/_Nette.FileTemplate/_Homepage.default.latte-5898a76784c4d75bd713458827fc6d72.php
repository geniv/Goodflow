<?php //netteCache[01]000393a:2:{s:4:"time";s:21:"0.26349000 1390313415";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:79:"/var/www/www/git/goodflow/nette/piskoviste/app/templates/Homepage/default.latte";i:2;i:1390313383;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2013-12-31";}}}?><?php

// source file: /var/www/www/git/goodflow/nette/piskoviste/app/templates/Homepage/default.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'kofcgcsu67')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lbb4453c2a1f_content')) { function _lbb4453c2a1f_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>hlavni stranka...

<?php call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

<?php if ($user->loggedIn) { ?><a href="<?php echo htmlSpecialChars($_control->link("Post:create")) ?>
">vytvor vole</a>
<?php } if ($user->loggedIn) { ?><a href="<?php echo htmlSpecialChars($_control->link("Post:create")) ?>
">vytvor vole (link2)</a><?php } ?>


<?php $iterations = 0; foreach ($posts as $post) { ?>
<div class="post">
    <div class="date"><?php echo Nette\Templating\Helpers::escapeHtml($template->date($post->created_at, 'F j, Y'), ENT_NOQUOTES) ?></div>

    <h2><a href="<?php echo htmlSpecialChars($template->safeurl($_control->link("Post:show", array($post->id)))) ?>
"><?php echo Nette\Templating\Helpers::escapeHtml($post->title, ENT_NOQUOTES) ?> (post prezenter; show render)</a></h2>

    <div><?php echo Nette\Templating\Helpers::escapeHtml($post->content, ENT_NOQUOTES) ?></div>
</div>
<?php $iterations++; } 
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lb3b82c3b468_title')) { function _lb3b82c3b468_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1>wtf nadpis a titulek v jednom</h1>
<?php
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof Nette\Application\UI\Presenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return Nette\Latte\Macros\UIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
?>

<?php if ($_l->extends) { ob_end_clean(); return Nette\Latte\Macros\CoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 