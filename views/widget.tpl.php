<h3 class="widget-title">
	<?php if ( $title ) : ?>
		<?php echo $title; ?>
	<?php endif; ?>
</h3>
<?php
//custom image view
if ( 2 === (int) $display_type ) {
	echo recommend_a_friend_link( '', $image_url );
}

//text view
elseif ( 3 === $display_type ) {
	echo '<p>' . recommend_a_friend_link( '', '', $link_text ) . '</p>';
}

//default view
else {
	echo recommend_a_friend_link( '', RAF_URL . 'images/share-widget-bg.png' );
}
