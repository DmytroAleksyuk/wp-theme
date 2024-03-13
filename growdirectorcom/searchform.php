<form role="search" class="search-form" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
    <input type="hidden" value="post" name="post_type" />
    <div class="search-inner">
        <input class="search-input search-autocomplete" type="search" name="s" id="q" value="<?php echo get_search_query() ?>" placeholder="<?php _e( 'Search', TEXT_DOMAIN );?>">
        <button class="search-button search-button_search for-img"></button>
        <button class="search-button search-button_clear for-img"></button>
    </div>
</form>