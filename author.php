<?php get_header(); ?>

<main id="main">
 <header class="header">
      <div class="ucla campus">
        <div class="col span_12_of_12">
  <div class= "author-bio">

    <h2><?php $author_id = intval( get_query_var( 'author' ) ); echo get_the_author_meta( 'display_name', $author_id ); ?></h2>
  <br>
  <h4> <?php echo get_the_author_meta('description', $author_id);?>
 </div> </div>
      </div>
    </header>
<hr/>
    <div class="ucla campus">
<div class="col span_12_of_12">
<div id="author_picture">
<?php echo get_avatar( get_the_author_meta('ID'), 200); ?>
</div> </div>
/bin/bash: wq: command not found
<div class="author-info">
<p><b><?php echo get_the_author_meta('email',$author_id);?>
<br>
<?php echo get_the_author_meta('website', $author_id);?>
<br>
<?php echo get_the_author_meta('phone-number', $author_id);?>
<br>
<?php echo get_the_author_meta('office-location', $author_id);?>
<br></b></p>
</div></div>
      <div class="col span_9_of_12">
        </div>
</div>
</main>

<?php get_footer(); ?>
