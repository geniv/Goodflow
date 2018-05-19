<link href="main.css" rel="stylesheet" type="text/css" />

<form method="get" id="searchform" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<div><input type="text" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" />

<input type="image" src="<?php bloginfo('template_directory');?>/images/search_butt.gif" id="searchsubmit" value="Hledej" />

</div>

</form>
