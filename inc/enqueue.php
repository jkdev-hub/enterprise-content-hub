<?php
/**
 * Enqueue theme assets.
 *
 * @package Enterprise_Content_Hub
 */

/**
 * Enqueue theme styles and scripts.
 *
 * @return void
 */
function ech_enqueue_assets() {

    wp_enqueue_style(
        'ech-main-style',
        get_template_directory_uri() . '/assets/css/main.css',
        array(),
        filemtime( get_template_directory() . '/assets/css/main.css' )
    );

    wp_enqueue_style(
        'ech-responsive-style',
        get_template_directory_uri() . '/assets/css/responsive.css',
        array( 'ech-main-style' ),
        filemtime( get_template_directory() . '/assets/css/responsive.css' )
    );
     
    if ( is_post_type_archive( 'resource' ) ) {

        wp_enqueue_script(
            'ech-resource-filter-script',
            get_template_directory_uri() . '/assets/js/resource-filter.js',
            array(),
            filemtime( get_template_directory() . '/assets/js/resource-filter.js' ),
            true
        );

        wp_localize_script(
            'ech-resource-filter-script',
            'echResourceFilter',
            array(
                'ajaxUrl' => admin_url( 'admin-ajax.php' ),
                'action'  => 'ech_filter_resources',
                'nonce'   => wp_create_nonce( 'ech_filter_nonce' ),
            )
        );
    }

    if ( is_page_template( 'templates/template-blog.php' ) ) {
        wp_enqueue_script(
            'ech-main-script',
            get_template_directory_uri() . '/assets/js/main.js',
            array(),
            filemtime( get_template_directory() . '/assets/js/main.js' ),
            true
        );

        wp_localize_script(
            'ech-main-script',
            'echAjax',
            array(
                'ajaxUrl' => admin_url( 'admin-ajax.php' ),
                'nonce'   => wp_create_nonce( 'ech_filter_nonce' ),
            )
        );
    }

    wp_enqueue_script(
        'ech-theme-script',
        get_template_directory_uri() . '/assets/js/theme.js',
        array(),
        filemtime( get_template_directory() . '/assets/js/theme.js' ),
        true
    );

}

add_action( 'wp_enqueue_scripts', 'ech_enqueue_assets' );
