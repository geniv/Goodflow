<?php //netteCache[01]000386a:2:{s:4:"time";s:21:"0.74776500 1390313599";s:9:"callbacks";a:2:{i:0;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:9:"checkFile";}i:1;s:72:"/var/www/www/git/goodflow/nette/piskoviste/app/templates/Post/show.latte";i:2;i:1390313598;}i:1;a:3:{i:0;a:2:{i:0;s:19:"Nette\Caching\Cache";i:1;s:10:"checkConst";}i:1;s:25:"Nette\Framework::REVISION";i:2;s:22:"released on 2013-12-31";}}}?><?php

// source file: /var/www/www/git/goodflow/nette/piskoviste/app/templates/Post/show.latte

?><?php
// prolog Nette\Latte\Macros\CoreMacros
list($_l, $_g) = Nette\Latte\Macros\CoreMacros::initRuntime($template, 'jdhasnmfwl')
;
// prolog Nette\Latte\Macros\UIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lb298237ba83_content')) { function _lb298237ba83_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?>konkretni prispevek

<p><a href="<?php echo htmlSpecialChars($_control->link("Homepage:default")) ?>">← zpět5 na výpis příspěvků</a></p>



<div class="date"><?php echo Nette\Templating\Helpers::escapeHtml($template->date($post->created_at, 'F j, Y; d.m.Y H:i:s'), ENT_NOQUOTES) ?></div>

<?php call_user_func(reset($_l->blocks['title']), $_l, get_defined_vars())  ?>

<div class="post"><?php echo Nette\Templating\Helpers::escapeHtml($post->content, ENT_NOQUOTES) ?></div>


<?php if ($user->loggedIn) { ?><a href="<?php echo htmlSpecialChars($_control->link("edit", array($post->id))) ?>
">editovat</a>
<?php } ?>


<h2>a tu si muzes stezovat:</h2>

<?php $_ctrl = $_control->getComponent("formFactory"); if ($_ctrl instanceof Nette\Application\UI\IRenderable) $_ctrl->redrawControl(NULL, FALSE); $_ctrl->render() ?>

<h2>stiznosti</h2>

<div class="comments">
<?php $iterations = 0; foreach ($comments as $comment) { ?>
        <p><b><?php if ($_l->ifs[] = ($comment->email)) { ?><a href="mailto:<?php echo htmlSpecialChars($template->safeurl($comment->email)) ?>
"><?php } echo Nette\Templating\Helpers::escapeHtml($comment->name, ENT_NOQUOTES) ;if (array_pop($_l->ifs)) { ?>
</a><?php } ?>
</b> said:</p>
        <div><?php echo Nette\Templating\Helpers::escapeHtml($comment->content, ENT_NOQUOTES) ?></div>
<?php $iterations++; } ?>
</div><?php
}}

//
// block title
//
if (!function_exists($_l->blocks['title'][] = '_lba0ac8c049f_title')) { function _lba0ac8c049f_title($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
?><h1><?php echo Nette\Templating\Helpers::escapeHtml($post->title, ENT_NOQUOTES) ?>, (nadpis + title)</h1>
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