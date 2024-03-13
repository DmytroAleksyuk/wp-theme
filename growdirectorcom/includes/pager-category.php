<?php
global $wp_query;
$total_pages = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
if ( $total_pages > 1 ) :
	$current_page = max( 1, get_query_var( 'paged' ) );
	echo '<nav class="navigation pagination" role="navigation"><div class="nav-links">';
	echo paginate_links( array(
		'base'      => get_pagenum_link( 1 ) . '%_%',
		'format'    => '/page/%#%',
		'current'   => $current_page,
		'total'     => $total_pages,
		'prev_text' => '<i class="icon-arrow-left-lite"></i>',
		'next_text' => '<i class="icon-arrow-right-lite"></i>',
	) );
	if ( $total_pages > 1 ) {
		echo '</div></nav>';
	}
endif;

