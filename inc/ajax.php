<?php
/**
 * Filter resources by topic.
 *
 * @return void
 */
function ech_ajax_filter_resources()
{

    check_ajax_referer('ech_filter_nonce', 'nonce');

    $topic = isset($_POST['topic']) ? sanitize_title(wp_unslash($_POST['topic'])) : 'all';

    $page = isset($_POST['page']) ? max(1, absint($_POST['page'])) : 1;

    $args = array(
        'post_type' => 'resource',
        'posts_per_page' => 6,
        'paged' => $page,
        'ignore_sticky_posts' => true,
    );

    if ('all' !== $topic)
    {

        $args['tax_query'] = array(
            array(
                'taxonomy' => 'resource_topic',
                'field' => 'slug',
                'terms' => $topic,
            ) ,
        );
    }

    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts())
    {

        while ($query->have_posts())
        {

            $query->the_post();

            get_template_part('template-parts/content', 'resource');
        }
    }
    else
    {

        get_template_part('template-parts/content', 'none');
    }

    $html = ob_get_clean();

    ob_start();

    get_template_part('template-parts/ajax-pagination', null, array(
        'total' => $query->max_num_pages,
        'current' => $page,
    ));

    $pagination = ob_get_clean();

    wp_reset_postdata();

    wp_send_json_success(array(
        'html' => $html,
        'pagination' => $pagination,
    ));
}

add_action('wp_ajax_ech_filter_resources', 'ech_ajax_filter_resources');

add_action('wp_ajax_nopriv_ech_filter_resources', 'ech_ajax_filter_resources');

/**
 * Filter blog posts by category.
 *
 * @return void
 */
function ech_ajax_filter_posts()
{

    check_ajax_referer('ech_filter_nonce', 'nonce');

    $category = isset($_POST['category']) ? sanitize_title(wp_unslash($_POST['category'])) : 'all';

    $page = isset($_POST['page']) ? max(1, absint($_POST['page'])) : 1;

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => get_option('posts_per_page') ,
        'paged' => $page,
        'ignore_sticky_posts' => true,
    );

    if ('all' !== $category)
    {
        $args['category_name'] = $category;
    }

    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts())
    {

        while ($query->have_posts())
        {

            $query->the_post();

            get_template_part('template-parts/content');
        }
    }
    else
    {

        get_template_part('template-parts/content', 'none');
    }

    $html = ob_get_clean();

    ob_start();

    get_template_part('template-parts/ajax-pagination', null, array(
        'total' => $query->max_num_pages,
        'current' => $page,
    ));

    $pagination = ob_get_clean();

    wp_reset_postdata();

    wp_send_json_success(array(
        'html' => $html,
        'pagination' => $pagination,
    ));
}

add_action('wp_ajax_ech_filter_posts', 'ech_ajax_filter_posts');
add_action('wp_ajax_nopriv_ech_filter_posts', 'ech_ajax_filter_posts');