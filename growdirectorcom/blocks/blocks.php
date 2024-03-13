<?php
if ( have_rows( 'blocks' ) ):
	$blocks_counter = 0; //
    while ( have_rows( 'blocks' ) ) : the_row();
		$layout = get_row_layout();
		get_template_part( 'blocks/' . $layout );
		$blocks_counter++; //
		set_query_var('blocks_counter', $blocks_counter);
	endwhile;
endif;