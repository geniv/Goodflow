<?php get_header(); ?>
<div id="wrapper">
	<div id="content">

<script type="text/javascript"><!--
google_ad_client = "pub-2052526339214516";
google_ad_width = 234;
google_ad_height = 60;
google_ad_format = "234x60_as";
google_ad_type = "text_image";
//2007-08-11: http://starcraftii.cz/
google_ad_channel = "5445189246";
google_color_border = "424033";
google_color_bg = "424033";
google_color_link = "9A8970";
google_color_text = "9A8970";
google_color_url = "9A8970";
//-->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<!-- START: sitenav -->

<div id="sitenav">
<div class="sn_center">
	
	<div class="box3"><div class="title">Poslední příspěvky</div>
	<ul>
	<?php $posts = get_posts('numberposts=50'); foreach($posts as $post) : ?>
	<li><a href= "<?php the_permalink(); ?>"><?php the_title(); ?> </a><br />
	<small><?php the_time('l, F jS, Y') ?></small></li>
	<?php endforeach; ?>
	</ul>
	</div>
		
</div>
</div>

<!-- END: sitenav -->

<script type="text/javascript"><!--
google_ad_client = "pub-2052526339214516";
google_ad_width = 234;
google_ad_height = 60;
google_ad_format = "234x60_as";
google_ad_type = "text_image";
//2007-08-11: http://starcraftii.cz/
google_ad_channel = "5445189246";
google_color_border = "424033";
google_color_bg = "424033";
google_color_link = "9A8970";
google_color_text = "9A8970";
google_color_url = "9A8970";
//-->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<h2 class="center">Chyba 404 - Stránka nenalezena</h2>
	</div>


<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>