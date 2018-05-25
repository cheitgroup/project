<?php get_header(); ?>

	<div class="skeleton">
		<section>
			<div class="page-404">
				<h1><?php _e( 'The page cannot be found' ) ?></h1>
				<p><?php _e( 'The page you are looking might have been removed, had its name changed, or is temporarily unavailable.' ) ?></p>
				<p><?php _e( 'Please try the following:' ) ?></p>
				<ul>
					<li><?php _e( 'If you typed the page address in the Address bar make sure it is spelled correctly.' ) ?></li>
					<li>
						<a href="<?php bloginfo( 'url' ) ?>"><?php _e( 'Click here' ) ?></a> <?php _e( 'to open the home page and then look for links to the information you want.' ) ?>
					</li>
					<li><?php _e( 'Click the Back button in your browser to try another link.' ) ?></li>
				</ul>
			</div>
		</section>
	</div>

<?php get_footer(); ?>