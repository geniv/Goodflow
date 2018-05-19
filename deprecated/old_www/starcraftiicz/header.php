<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<link rel="shortcut icon" href="favicon.ico">
<link href="favicon.ico" rel="icon" type="ico" />


<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>
<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('stylesheet_url'); ?>" />
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />



<DIV id="background">	
<DIV id="container">
	
	
<DIV id="prim_header">
				<H1><A href="http://starcraftii.cz/"><?php get_bloginfo('description'); ?></A></H1>
				<DIV id="header_vehicle"></DIV>
				<UL>
					<LI class="media"><A href="http://www.starcraftii.cz/category/starcraft-2/video-starcraft/">Video Starcraft II</A></LI>

					<LI class="gameinfo"><A href="http://www.starcraftii.cz/redakce">Redakce</A> </LI>
					<LI class="community"><A href="http://www.starcraftii.cz/forum/">Community</A></LI>
				</UL>
				
<DIV id="login">
<FORM action="/starcraft2/" method="post">




<DIV id="login_content">
<SPAN style="FONT-WEIGHT: bold; COLOR: #00c4ff">Přihlášení do systému:</SPAN><BR />
<INPUT class="login_box" style="MARGIN-TOP: 2px" name="username"><BR />
<INPUT	type="password" class="login_box" style="MARGIN-TOP: 2px" name="password"><br/>
<INPUT type=image src=(TEMPLATEPATH . "/login_button.gif");/>


</DIV>

</FORM>

</DIV>        


</DIV>





<DIV id="sub_header">
<DIV id="number_one_source"></DIV>
<DIV id="vehicle_bottom"></DIV>
<DIV id="sub_nav">
					
						
<SPAN ><?php include (TEMPLATEPATH . '/searchform.php'); ?></SPAN>

					
</DIV>
</DIV>




<?php wp_get_archives('type=monthly&format=link'); ?>


</head>

<body>

<hr />
