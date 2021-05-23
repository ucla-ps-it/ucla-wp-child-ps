        <?php

$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) );

?>

<?php get_header(); ?>

<main id="main">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<header class="header" <?php if ( has_post_thumbnail() ) { ?> style="background-image: url(<?php echo $thumbnail[0]; ?>);" <?php } ?>>
      <div class="ucla campus">
        <div class="col span_12_of_12">
          <div class="breadcrumb"><?php get_breadcrumb(); ?></div>
          <h1 class="entry-title"><?php the_title(); ?></h1>         </div>
      </div>
    </header>

    <div class="ucla campus">

      <div class="col span_9_of_12"><?php edit_post_link(); ?>
         <?php the_content(); ?>

        <?php
            /** @var string|false|WP_Error $tag_list */
            $tag_list = get_the_tag_list( ' ', ' ' );

            if ( $tag_list && ! is_wp_error( $tag_list ) ) {
                echo $tag_list;
            }
        ?>
      </div>

    <?php endwhile; endif; ?>

<div class="col span_3_of_12">
<ul>
<?php if(get_post_meta($post->ID, 'Author', true)):?>
<li>
 Author: <?php echo get_post_meta($post->ID, 'Author', true);?>
</li>
<?php endif;?>
<?php if(get_post_meta($post->ID, 'Journal', true)):?>
<li>
 Journal: <?php echo get_post_meta($post->ID, 'Journal', true);?>
</li>
<?php endif;?>
<?php if(get_post_meta($post->ID, 'Volume', true)):?>
<li>
 Volume: <?php echo get_post_meta($post->ID, 'Volume', true);?>
</li>
<?php endif;?>
<?php if(get_post_meta($post->ID, 'Pages', true)):?>
<li> 
 Pages: <?php echo get_post_meta($post->ID, 'Pages', true);?>
</li>
<?php endif;?>
<?php if(get_post_meta($post->ID, 'ISSN', true)):?>
<li>
 ISSN: <?php echo get_post_meta($post->ID, 'ISSN', true);?>
</li>
<?php endif;?>
<?php if( get_post_meta($post->ID, 'DOI', true)):?>

<li>
 DOI: <?php echo get_post_meta($post->ID, 'DOI', true);?>
</li>
<?php endif;?>
<?php if(get_post_meta($post->ID, 'URL', true)):?>
<?php
	    echo '<li> URL: <a href="' . get_post_meta($post->ID, 'URL', true). '"> link to publication</a></li>';?>
<?php endif;?>
</ul>      
    </div>
   
  </div>

</main>

<?php get_footer(); ?>
