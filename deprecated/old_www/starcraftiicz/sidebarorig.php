<link href="style.css" rel="stylesheet" type="text/css" />
<div id="sidebar">
<ul>
<!-- <li>
<?php //include (TEMPLATEPATH . '/searchform.php'); ?>
</li> -->
<!--
<li>
<?php /* jestliže stránka je 404 */ if (is_404()) { ?>
<?php /* Jestliže je toto kategorie archivu */ } elseif (is_category()) { ?>
<p>Teď prohlížíte archivy pro <?php single_cat_title(''); ?> category.</p>			
<?php /* jetliže je toto roční archiv */ } elseif (is_day()) { ?>
<p>Teď prohlížíte <a href="<?php echo get_settings('siteurl'); ?>">
<?php echo bloginfo('name'); ?></a> weblog archives
			for the day <?php the_time('l, F jS, Y'); ?>.</p>
			
			<?php /* jestliže je toto měsíční archiv */ } elseif (is_month()) { ?>
			<p>Teď prohlížíte <a href="<?php echo get_settings('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> weblog archives
			for <?php the_time('F, Y'); ?>.</p>

      <?php /* Jestliže je toto roční archiv*/ } elseif (is_year()) { ?>
			<p>Teď procházíte <a href="<?php echo get_settings('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> weblog archiv
			pro rok <?php the_time('Y'); ?>.</p>
			
		 <?php /* jestliže je toto měsíční archiv */ } elseif (is_search()) { ?>
			<p>Hledali jste <a href="<?php echo get_settings('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> weblog archiv
			pro <strong>'<?php echo wp_specialchars($s); ?>'</strong>. Pokud něco nenajdete zde, mùžete zkusit následující odkazy.</p>

			<?php /* jestliže je toto měsíční archiv */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<p>Teď prohlížíte <a href="<?php echo get_settings('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> weblog archiv.</p>

			<?php } ?>
			</li>
			-->

 
 <!--<li>
</div>

<ul>
<?php //wp_get_archives('type=monthly'); ?>
</ul>
</li>
			-->		
<li class="title"><a href="http://starcraftii.cz/"><h2>Domů</h2></a>

<li class="title"><a href="http://starcraftii.cz/forum/"><h2>Fórum</h2></a>
<li class="title"><h2>Kategorie</h2>
<ul>
<?php //wp_list_cats('sort_column=name&optioncount=1&hierarchical=0'); ?>

<?php wp_list_cats(); ?> 
</ul>
</li>
<?php //wp_list_pages('title_li=<h2>Stránky</h2>' ); ?>
<li class="title"><a href="http://www.starcraftii.cz/downloads/"><h2>Stahujte</h2></a>
<li class="title"><h2>Novinky na fóru</h2>
<?php
	    if (function_exists('phpbb_topics')) {
			phpbb_topics(7);
		} 
	?>
<?php if(function_exists('ns_show_top_commentators')) { ?>
<li>
<h2>Nejlepší komentátoři</h2>
<ul><?php ns_show_top_commentators(); ?></ul>
</li>
<?php } ?>

<center>
<?php if (function_exists('vote_poll') && !in_pollarchive()): ?>
<li>
   <h2>Anketa</h2>
   <ul>
      <li><?php get_poll();?></li>
   </ul>
   <?php display_polls_archive_link(); ?>
</li>
<?php endif; ?>	



<script type="text/javascript"><!--
google_ad_client = "pub-2052526339214516";
google_ad_width = 120;
google_ad_height = 600;
google_ad_format = "120x600_as";
google_cpa_choice = "CAEaCB4GXKbX4htJUClQ1wE";
google_ad_channel = "4231773716";
google_color_border = "28261F";
google_color_bg = "28261F";
google_color_link = "9A8970";
google_color_text = "9A8970";
google_color_url = "9A8970";
//-->
</script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>



</center>
</ul>
<!-- <li>
<?php //include (TEMPLATEPATH . '/searchform.php'); ?>
</li> -->
<!--
<li>

			<?php /* jestliže stránka je 404 */ if (is_404()) { ?>
			<?php /* Jestliže je toto kategorie archivu */ } elseif (is_category()) { ?>
			<p>Teď prohlížíte archivy pro <?php single_cat_title(''); ?> category.</p>
			
			<?php /* jetliže je toto roční archiv */ } elseif (is_day()) { ?>
			<p>Teď prohlížíte <a href="<?php echo get_settings('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> weblog archives
			for the day <?php the_time('l, F jS, Y'); ?>.</p>
			
			<?php /* jestliže je toto měsíční archiv */ } elseif (is_month()) { ?>
			<p>Teď prohlížíte <a href="<?php echo get_settings('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> weblog archives
			for <?php the_time('F, Y'); ?>.</p>

      <?php /* Jestliže je toto roční archiv*/ } elseif (is_year()) { ?>
			<p>Teď procházíte <a href="<?php echo get_settings('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> weblog archiv
			pro rok <?php the_time('Y'); ?>.</p>
			
		 <?php /* jestliže je toto měsíční archiv */ } elseif (is_search()) { ?>
			<p>Hledali jste <a href="<?php echo get_settings('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> weblog archiv
			pro <strong>'<?php echo wp_specialchars($s); ?>'</strong>. Pokud něco nenajdete zde, mùžete zkusit následující odkazy.</p>

			<?php /* jestliže je toto měsíční archiv */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
			<p>Teď prohlížíte <a href="<?php echo get_settings('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> weblog archiv.</p>

			<?php } ?>
			</li>
			-->




