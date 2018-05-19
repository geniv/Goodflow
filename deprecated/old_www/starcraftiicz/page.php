<div id="content">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<div class="post" id="post-<?php the_ID(); ?>">
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
<small><?php //the_time('F jS, Y') ?> <!-- by <?php the_author() ?> --></small>				
				<br />
				<div class="entry">
					<?php the_content('read more &raquo;'); ?>
</div>
<p>Zpracoval: <?php the_author_posts_link(); ?></p>
<?php if (class_exists('SimpleTagging')) : ?>
	<h2>Související články:</h2>
	<ul>
		<?php STP_RelatedPosts() ?>
	</ul>
<?php endif; ?>
<p class="postmetadata">Z kategorie <?php the_category(', ') ?> <strong>|</strong> <?php edit_post_link('Editovat','','<strong>|</strong>'); ?>  <?php comments_popup_link('Napište komentář &#187;', '1 Komentář &#187;', '% Komentářů &#187;'); ?></p>
</div>
<?php endwhile; ?>
<div class="navigation">
<div class="alignleft"><?php next_posts_link('&laquo; Starší články') ?></div>
<div class="alignright"><?php previous_posts_link('Novější články &raquo;') ?></div>
</div>
<?php else : ?>
<h2 class="center">Nic nenalezeno</h2>
<p class="center">Promiňte, ale není zde co hledáte.</p>
<?php include (TEMPLATEPATH . "/searchform.php"); ?>
<?php endif; ?>
</div>
