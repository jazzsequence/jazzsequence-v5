	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<time datetime=<?php the_time('Y-m-d'); ?>></time>
		<section class="entry">
			<?php the_content('Read more &raquo;'); ?>
			<?php wp_link_pages(); ?>
			<em class="human-time-diff"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?></em>
		</section>
	</article>
    <div class="clear"></div>