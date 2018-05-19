<?php defined( "_VALID_MOS" ) or die( "Direct Access to this location is not allowed." );$iso = split( '=', _ISO );echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php if ( $my->id ) { initEditor(); } ?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php mosShowHead(); ?>

<link rel="stylesheet" href="templates/slidertab_plazza/css/<?php $nav = ( isset( $_SERVER['HTTP_USER_AGENT'] ) ) ? strtolower( $_SERVER['HTTP_USER_AGENT'] ) : ''; if (stristr($nav, "msie")) { echo "template-css.css"; } else { echo "template_css.css"; } ?>" type="text/css" />
<script type="text/javascript" src="templates/slidertab_plazza/slide.js"></script>
<script type="text/javascript" src="templates/slidertab_plazza/script.js"></script>
<script type="text/javascript" src="templates/slidertab_plazza/tab.js"></script>
<script type="text/javascript">
document.write('<style type="text/css">.tabber{display:none;}<\/style>');
</script>

</head>

<body class="bodies">
<!-- Code for the left panel -->
<div id="dhtmlgoodies_leftPanel">
	<div id="leftPanelContent">
	<!--tab start here -->
		<div class="tabber">
			<!-- tab1 start here -->
			<div class="tabbertab"><br /> 
			<img src="templates/slidertab_plazza/images/user6.gif" alt=" " /><br />
			<h2>cpanel</h2>
	  		<?php if (mosCountModules( 'cpanel' )) { 	?>
	  		<?php mosLoadModules ( 'cpanel',-2); ?>
	  		<?php } else { ?><br />
	  		<img src="templates/slidertab_plazza/images/no-module.gif" alt=" " />
	  		<?php } ?>
     		</div>
			<!-- tab2 start here -->
			<div class="tabbertab">
	 		<h2>User1</h2>
	  		<?php if (mosCountModules( 'user2' )) { 	?>
	 		 <?php mosLoadModules ( 'user2',-2); ?>
	 		<?php } else { ?><br />
	 		<img src="templates/slidertab_plazza/images/no-module.gif" alt=" " />
	  		<?php } ?>
     		</div>
			<!-- tab3 start here -->
			<div class="tabbertab">
	  		<h2>user2</h2>
	  		<?php if (mosCountModules( 'user1' )) { 	?>
	  		<?php mosLoadModules ( 'user1',-2); ?>
	  		<?php } else { ?><br />
	  		<img src="templates/slidertab_plazza/images/no-module.gif" alt=" " />
	  		<?php } ?>
     		</div>
		</div>
		<!-- tab end here -->
	</div>
</div>
<!-- End code for the left panel -->

<div id="core" align="center">
	<!-- header -->
	<div id="top" align="center">
		<div id="logos" >
			
			<div id="navi"><?php mosLoadModules ( 'user3' ); ?></div>
		</div>
	</div>
		
	
	<!-- pathway -->
	<div id="line2">
		
		<div id="path-way">&raquo;&nbsp;<?php mosPathWay(); ?></div>
		
	</div>
	<div style="clear:both"></div>
	<!-- body -->
	<div id="mid">
		<div id="ads">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                
            </table>
		</div>
		<table cellpadding="0" cellspacing="0" width="100%">
			<tr>  
        		<td width="150" align="left" valign="top" id="menu">
			
				</a>
				<?php mosLoadModules ( 'left' ); ?><br><div><img src="http://www.netagent.cz/agent.php?id=9998&amp;box=1&amp;color=light" border="0" alt="NetAgent" /></div>
				</td>
        		<?php if (mosCountModules( 'right' )) { 	?>
				<td align="left" valign="top" id="mainbody" >
				<img src="images/spacer.gif" alt=" " width="314" height="1" />
				<?php mosMainBody(); ?>
          		</td>
				<td width="160" align="left" valign="top" id="right">
				<img src="images/spacer.gif" alt=" " width="165" height="1" />
				<?php mosLoadModules ( 'right' ); ?>
				</td>
				
      			<?php } else { ?>
				<td align="left" valign="top" id="mainbody" >
				
				<?php mosMainBody(); ?>
          		</td>
				<?php } ?>	
			</tr>
		</table>
		</div>
		<div id="foot">
		<img src="templates/slidertab_plazza/images/spacer.gif" alt=" " width="695" height="1" />
		<?php include_once('includes/footer.php'); ?>Design by: Thomas Toul, DiS. & Bc.Pavel Mužík &copy; 2008</div>
	</div>
<script type="text/javascript">doload();</script>
</body>
</html>
