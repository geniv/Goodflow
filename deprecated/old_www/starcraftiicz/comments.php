<?php // Do not delete these lines

	if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME']))

		die ('Prosím, nenačítejte tuto stránku přímo. Díky!');



        if (!empty($post->post_password)) { // if there's a password

            if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // and it doesn't match the cookie

				?>

<link href="main.css" rel="stylesheet" type="text/css" />



				

				<p class="nocomments">Tato pošta je chráněna heslem, zadejte heslo pro prohlížení komentářů.<p>

				

				<?php

				return;

            }

        }



		/* This variable is for alternating comment background */

		$oddcomment = 'alt';

?>



<!-- You can start editing here. -->



<?php if ($comments) : ?>

	<h3 id="comments"><?php comments_number('Žádné komentáře', 'Jeden komentář', '% Komentářů' );?> od &#8220;<?php the_title(); ?>&#8221;</h3> 



	<ol class="commentlist">



	<?php foreach ($comments as $comment) : ?>



		<li class="<?php echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>">

			



<cite><?php comment_author_link() ?></cite> Říká:

			<?php if ($comment->comment_approved == '0') : ?>

			<em>Váš komentář čeká na schválení.</em>

	    	<?php endif; ?>





			<br />



<?php if (class_exists("identicon")) $identicon=new identicon;?>





<?php if (isset($identicon)) echo $identicon->identicon_build($comment->comment_author_IP, $comment->comment_author); ?>









			<small class="commentmetadata"><a href="#comment-<?php comment_ID() ?>" title=""><?php comment_date('F jS, Y') ?> at <?php comment_time() ?></a> <?php edit_comment_link('e','',''); ?></small>



			<?php comment_text() ?>



		</li>



	<?php /* Changes every other comment to a different class */	

		if ('alt' == $oddcomment) $oddcomment = '';

		else $oddcomment = 'alt';

	?>



	<?php endforeach; /* end for each comment */ ?>



	</ol>



 <?php else : // this is displayed if there are no comments so far ?>



  <?php if ('open' == $post->comment_status) : ?> 

		<!-- If comments are open, but there are no comments. -->

		

	 <?php else : // comments are closed ?>

		<!-- If comments are closed. -->

		<p class="nocomments">Komentáře jsou uzamčeny.</p>

		

	<?php endif; ?>

<?php endif; ?>





<?php if ('open' == $post->comment_status) : ?>



<h3 id="respond">Zanechte komentář</h3>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>

<p>Musíte být <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">přihlášený v</a> poslat komentář.</p>

<?php else : ?>



<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">



<?php if ( $user_ID ) : ?>



<p>Přihlášený jako <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Odhlásit se z tohoto účtu ">Odhlásit se &raquo;</a></p>



<?php else : ?>



<p><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />

<label for="author"><small>Jméno <?php if ($req) echo "(required)"; ?></small></label></p>



<p><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />

<label for="email"><small>Mail (will not be published) <?php if ($req) echo "(required)"; ?></small></label></p>



<p><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />

<label for="url"><small>Websajt</small></label></p>



<?php endif; ?>



<!--<p><small><strong>XHTML:</strong> Můžete použít tyto tagy: <?php echo allowed_tags(); ?></small></p>-->



<p><textarea name="comment" id="comment" cols="45" rows="10" tabindex="4"></textarea></p>



<p><input name="submit" type="submit" id="submit" tabindex="5" value="Komentovat " />

<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />

</p>

<?php do_action('comment_form', $post->ID); ?>









</form>



<?php endif; // If registration required and not logged in ?>



<?php endif; // if you delete this the sky will fall on your head ?>

