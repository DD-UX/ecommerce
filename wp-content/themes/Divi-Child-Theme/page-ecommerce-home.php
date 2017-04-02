<?php
/*
Template Name: Ecommerce Homepage
*/

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content">

<!-- Swiper home-->
<div class="swiper-container product-slider">
    <div class="swiper-wrapper">
        <?php
            $params = array(
                'posts_per_page' => 3,
                'post_type' => 'product'
            );
            $wc_query = new WP_Query($params);
        
            // If products are present
            if ($wc_query->have_posts()) : ?>
                <?php while ($wc_query->have_posts()) :?>
                    <?php
                        $wc_query->the_post();
                        global $product;
                    ?>
                    <div class="swiper-slide">
                        <div class="product-slider-row">
                            <div class="product-slider-column">
                                <h2><?= the_title(); ?></h2>
                                <p class="description"><?= $product->post->post_excerpt ? $product->post->post_excerpt : the_content(); ?></p>
                                
                                <?php
                                    echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                                        sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="custom_wc_add_to_cart et_pb_button et_pb_custom_button_icon et_pb_module et_pb_bg_layout_dark %s product_type_%s" data-icon=""><i class="fa fa-spinner fa-pulse fa-fw"></i> Añadir al carrito</a>',
                                            esc_url( $product->add_to_cart_url() ),
                                            esc_attr( $product->id ),
                                            esc_attr( $product->get_sku() ),
                                            $product->is_purchasable() ? 'add_to_cart_button' : '',
                                            esc_attr( $product->product_type ),
                                            esc_html( $product->add_to_cart_text() )
                                        ),
                                    $product );
                                ?>
                                
                                <a class="et_pb_button et_pb_module et_pb_bg_layout_dark" href="<?=get_permalink(); ?>">Ver producto</a>
                            </div>
                            <div class="product-slider-column">
                                <?php the_post_thumbnail( 'medium_large', array( 'alt' => $product->post->post_title, 'class' => 'product-img' ) ); ?>
                            </div>
                        </div>
                    </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php endif; ?>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination swiper-pagination-black"></div>
    <!-- Add Arrows -->
    <div class="swiper-button-next swiper-button-black"></div>
    <div class="swiper-button-prev swiper-button-black"></div>
</div>
    
<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

<?php endif; ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( ! $is_page_builder_used ) : ?>

					<h1 class="entry-title main_title"><?php the_title(); ?></h1>
				<?php
					$thumb = '';

					$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

					$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
					$classtext = 'et_featured_image';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
					$thumb = $thumbnail["thumb"];

					if ( 'on' === et_get_option( 'divi_page_thumbnails', 'false' ) && '' !== $thumb )
						print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
				?>

				<?php endif; ?>

					<div class="entry-content">
					<?php
						the_content();

						if ( ! $is_page_builder_used )
							wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->

				<?php
					if ( ! $is_page_builder_used && comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
				?>

				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>

<?php if ( ! $is_page_builder_used ) : ?>

			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->

<?php get_footer(); ?>