	<div id="sidebar">

		<ul>
<!-- <li>

				<?php //include (TEMPLATEPATH . '/searchform.php'); ?>

</li> -->



			<!--

						<li>

			<?php /* If this is a 404 page */ if (is_404()) { ?>

			<?php /* If this is a category archive */ } elseif (is_category()) { ?>

			<p>You are currently browsing the archives for the <?php single_cat_title(''); ?> category.</p>

			

			<?php /* If this is a yearly archive */ } elseif (is_day()) { ?>

			<p>You are currently browsing the <a href="<?php echo get_settings('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> weblog archives

			for the day <?php the_time('l, F jS, Y'); ?>.</p>

			

			<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>

			<p>You are currently browsing the <a href="<?php echo get_settings('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> weblog archives

			for <?php the_time('F, Y'); ?>.</p>



      <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>

			<p>You are currently browsing the <a href="<?php echo get_settings('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> weblog archives

			for the year <?php the_time('Y'); ?>.</p>

			

		 <?php /* If this is a monthly archive */ } elseif (is_search()) { ?>

			<p>You have searched the <a href="<?php echo get_settings('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> weblog archives

			for <strong>'<?php echo wp_specialchars($s); ?>'</strong>. If you are unable to find anything in these search results, you can try one of these links.</p>



			<?php /* If this is a monthly archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>

			<p>You are currently browsing the <a href="<?php echo get_settings('siteurl'); ?>"><?php echo bloginfo('name'); ?></a> weblog archives.</p>



			<?php } ?>

			</li>

			-->

			<?php //wp_list_pages('title_li=<h2>Pages</h2>' ); ?>



			<!--<li><h2>Archives</h2>

				<ul>

				<?php //wp_get_archives('type=monthly'); ?>

				</ul>

			</li>

			-->

<LI class="title">Menu</LI>
 <LI class="links"><a href="http://starcraftii.cz/">Domů</a></LI>
 <LI class="links"><a href="http://starcraftii.cz/forum/">Fórum</a></LI>
 
<LI class="title">Kategorie</LI>


<LI class="title">

<?php //wp_list_cats('sort_column=name&optioncount=1&hierarchical=0'); ?>
<?php wp_list_cats(); ?>
 
</LI>



			</li>
<LI class="title">Novinky na fóru</LI>


<?php

	    if (function_exists('phpbb_topics')) {

			phpbb_topics(7);

		} 

	?>
			

		</ul>

	</div>



