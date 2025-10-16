<?php
/*
Plugin Name: Article Products
Description: نمایش محصولات با شورت‌کد در مقالات
Version: 1.0
Author: Zahra Norouzi
*/

// ثبت شورت‌کد [article_product id="123"]

function ap_display_product_shortcode($atts) {
    require_once plugin_dir_path(__FILE__) . 'product-template.php';
    $atts = shortcode_atts([
        'id' => '', // آیدی محصولات با کاما جدا شوند
    ], $atts);
    $ids = array_filter(array_map('intval', explode(',', $atts['id'])));
    if (empty($ids)) return '';

    // فقط دو محصول اول را نمایش بده
    $ids = array_slice($ids, 0, 2);
    $output = '<div class="ap-products-wrapper">';
    foreach ($ids as $product_id) {
        $product = get_post($product_id);
        if (!$product || $product->post_type !== 'product') continue;
        $permalink = get_permalink($product_id);
        $price = get_post_meta($product_id, '_price', true);
        $output .= ap_get_product_html($product, $price, $permalink);
    }
    // دکمه مشاهده همه محصولات
    $output .= '<div class="ap-product-all-btn"><a href="' . esc_url(site_url('/products')) . '" class="ap-btn">مشاهده همه محصولات</a></div>';
    $output .= '</div>';
    return $output;
}
add_shortcode('article_product', 'ap_display_product_shortcode');

// استایل ساده برای نمایش محصول
function ap_product_enqueue_styles() {
    wp_enqueue_style('ap-article-products', plugins_url('assets/css/article-products.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'ap_product_enqueue_styles');
