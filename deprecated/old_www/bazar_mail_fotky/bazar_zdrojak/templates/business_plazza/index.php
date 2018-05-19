<?php defined( "_VALID_MOS" ) or die( "Direct Access to this location is not allowed." );?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php if ( $my->id ) { initEditor(); } 

if (mosCountModules('left')==0) $ttoptype = "-full"; 
if ((mosCountModules( 'user1' )) && (mosCountModules( 'user2' ))) {
	$leftuser = 'leftmod';
	$rightuser = 'rightmod';
} else if ((mosCountModules( 'user1' )) || (mosCountModules( 'user2' ))) {
	$leftuser = 'allmod';
	$rightuser = 'allmod';
}
?>
<meta http-equiv="Content-Type" content="text/html;><?php echo _ISO; ?>" />
<?php mosShowHead(); ?>
<link rel="stylesheet" href="templates/business_plazza/css/template_css.css" type="text/css" />
</head>
<body>
<div id="main">
	<div id="head">
		<div id="logo"></div> 
		<div id="btopmenu">
			<div id="menutop">
				<div><?php mosLoadModules ( 'user3' ); ?></div>
			</div> 
		</div>
	</div>
<div id="bodi">
	<div id="header">
		<div id="searchboxs">
		<?php mosLoadModules ( 'user4' ); ?>
		</div>
	</div>
	<div id="newsflash"><?php mosLoadModules ( 'top',-1 ); ?></div>
</div>
<div id="contentf">
	<div id="leftcol">
	<?php if ((mosCountModules( 'user1' )) | (mosCountModules( 'user2' ))) { ?>
		<div id="extra<?php echo $ttoptype; ?>">
			<?php if (mosCountModules( "user1" )) { ?>
				<div id="<?php echo $leftuser; echo $ttoptype; ?>">
					<?php mosLoadModules ( 'user1'); ?>
				</div>
			<?php } ?>
			<?php if (mosCountModules( "user2" )) { ?>
				<div id="<?php echo $rightuser; echo $ttoptype; ?>">
				<?php mosLoadModules ( 'user2'); ?>
				</div>
			<?php } ?>
	</div>
	<?php } ?><div id="bodycontainer<?php echo $ttoptype; ?>"> <?php mosMainBody(); ?>
	<br />
	<?php mosLoadModules( "banner", -1 ); ?> </div>
	</div>
	<?php if (mosCountModules( "left" )) {	?>
	<div id="menucol"> <?php mosLoadModules ( 'left' ); ?></div>
	<?php } ?>
</div>
<div id="bottom" align="center"><a href="http://validator.w3.org/check?uri=referer"><img src="templates/business_plazza/images/xhtml.png" alt=" " width="80" height="15" border="0" /></a>&nbsp; <a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="templates/business_plazza/images/css.png" alt=" " width="80" height="15" border="0" /></a><br />

<?php include_once('includes/footer.php'); ?> 
</div>
</div>
</body>
</html>