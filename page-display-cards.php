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
<div class='card-search-form'>
<form action="https://vikingscards.tonyandrews.dev/display-cards/" method="get">
        
		<div class="card-search-form">
			<div class="card-search-input">
				<label for='card-search-select'>Search By:</label>
				<select name="cardSearchOption" id='card-search-select'>
					<option value="year">Year</option>
					<option value="player_last_name">Player Last Name</option>
					<option value="card_number">Card Number</option>
				</select>	
			</div>
			<div class="card-search-input">
				<label for='card-search-data'>Search Terms:</label>
				<input type="text"  name="cardSearchData" id='card-search-data'>
			</div>
			<div class="card-search-submit">     
				<button class='card-search-submit-button' type="submit">Search</button>
			</div>
		</div> 
</form>
</div>

<?php
	//Protect against arbitrary paged values
	$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

	//Get submitted form data

	if ($_GET['cardSearchData'] && !empty($_GET['cardSearchData'])) :

		$args = array(
			'post_type' => 'card',
			'posts_per_page' => 10,
			'paged' => $paged,
			'meta_key' => $_GET['cardSearchOption'],
			'meta_value' => $_GET['cardSearchData'],
			'compare' => 'LIKE'
		   );	 

	else :
		$args = array (
			'post_type' => 'card',
			'posts_per_page' => 10,
			'paged' => $paged
		);
		
	endif;

 
	$card_loop = new WP_Query( $args );
 
	while ( $card_loop->have_posts() ) : $card_loop->the_post();
		
		 ?>
		 <div class='card-result-title'><a href="<?php the_permalink() ?>"><i class="fas fa-chevron-right"></i> <?php the_title() ?></a></div>
		 <div class='card-meta-container'>
			<?php 
			$image = get_field('front_image');
			if ( !empty($image) ) :
				$imageclass = 'card-meta-image';
			else :
				$imageclass = 'card-meta-noimage';
			endif ?>	
			<div class='<?php echo $imageclass; ?>'><i class="fas fa-camera"></i></div>
			<div class='card-meta-year'><?php the_field('year') ?></div>
			<div class='card-meta-brand'><?php the_field('brand') ?></div>
			<div class='card-meta-team'><?php the_field('team') ?></div>
			<div class='card-meta-number'><?php the_field('card_number') ?></div>
			<div class='card-meta-name'><?php the_field('player_first_name')?> <?php the_field('player_last_name')?></div>
			
		</div>
		 
	<?php
	endwhile;

wp_reset_postdata();  ?>

	<div class="card-pagination">
	<?php
		$big = 999999999; // need an unlikely integer

		echo paginate_links( array(
			'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'format' => '?paged=%#%',
			'current' => max( 1, get_query_var('paged') ),
			'total' => $card_loop->max_num_pages
		) );
 	?>
	 </div>


<?php

get_footer();
