<div class="raf_share_buttons">
	<a href="<?php echo add_query_arg( array( 'raf-form' => true, 'current-url' => rawurlencode( $permalink ) ),  home_url() ); ?>" title="<?php esc_html_e( 'Recommend to a friend', 'raf' ); ?>" class="iframe raf_link" rel="nofollow">
		<?php echo $link_content; ?>
	</a>
</div>
