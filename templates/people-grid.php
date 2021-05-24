<?php /* Template Name: People Grid */ ?>

<?php
	get_header();
	$post_list = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1));
?>

<?php if ( $post_list->have_posts() ): ?>


<div class="wrapper group">
	<h2 class="events__section-title">Current Members</h2>
	<div class="events-feed section">
		<div class="span_3_of_12 event-card">

			<article class="person-card">
				<img class="person-card__image" src="wp-content/uploads/2021/01/image-3.png" alt="Headshot of First_Name Last_Name">
				<div class="person-card__info-wrapper">
					<h1 class="person-card__name"><span>First_Name Last_Name</span></h1>
					<h2 class="person-card__department"><span>Title, Department</span></h2>
					<p class="person-card__description">Persons card description for example interest, work, research…</p>
				</div>
			</article>
		</div>
	</div>
</div>
