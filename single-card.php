<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package footballCards
 */

get_header();
?>

	<main id="primary" class="card-main">

		<?php

		while ( have_posts() ) :
			the_post();

			?>
			<div class='card-images'>

				<div><?php 
					$frontimage = get_field('front_image');
					if( !empty( $frontimage ) ): ?>
						<a href='<?php echo esc_url($frontimage['url']); ?>'><img class='card-img' src="<?php echo esc_url($frontimage['url']); ?>" alt="<?php echo esc_attr($frontimage['alt']); ?>" /></a>
					<?php endif; ?>
				</div>

				<div><?php 
					$backimage = get_field('back_image');
					if( !empty( $backimage ) ): ?>
						<a href='<?php echo esc_url($backimage['url']); ?>'><img class='card-img' src="<?php echo esc_url($backimage['url']); ?>" alt="<?php echo esc_attr($backimage['alt']); ?>" /></a>
					<?php endif; ?>
				</div>
			</div>

			<div class='card-content'>
				
				<?php the_title( '<h2 class="card-title">', '</h2>' ); ?>
				

				<div class="card-content">
					<?php
					the_content();
					?>
				</div><!-- .card-content -->

				<!-- card details -->
				<div class='card-detail'><span class='card-detail-heading'>Team: </span><?php the_field('team');?></div>
				<div class='card-detail'><span class='card-detail-heading'>Brand: </span><?php the_field('brand');?></div>
				<div class='card-detail'><span class='card-detail-heading'>Year: </span><?php the_field('year');?></div>
				<div class='card-detail'><span class='card-detail-heading'>Card #: </span><?php the_field('card_number');?></div>
				<div class='card-detail'><span class='card-detail-heading'>Player: </span><?php the_field('player_first_name');?> <?php the_field('player_last_name');?></div>
				<div class='card-detail'><span class='card-detail-heading'>Attributes: </span><?php the_field('rookie_card');?></div>
				<div><a href="http://vikingscards.tonyandrews.dev/display-cards/"><button class="main-button">Return to Search</button></a></div>

			</div>
			

			

	</main><!-- #main -->

	<?php

		endwhile; // End of the loop.
		?>

<?php

get_footer();
