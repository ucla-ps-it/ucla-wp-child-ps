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
          <h1 class="entry-title"><?php the_title(); ?></h1> <?php edit_post_link(); ?>
        </div>
      </div>
    </header>

    <div class="ucla campus">

      <div class="col span_9_of_12">
        <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished"><?php echo get_the_date(); ?></time>
        <p><?php $author_id = intval( get_query_var( 'author' ) ); echo get_the_author_meta( 'user_login', $author_id ); ?></p>
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
      <?php get_sidebar(); ?>
    </div>

  </div>

</main>

<?php get_footer(); ?>
