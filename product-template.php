<?php
// قالب نمایش محصول برای پلاگین Article Products
if (!defined('ABSPATH')) exit;

function ap_get_product_html($product, $price, $permalink) {
    ob_start();
    ?>
    <div class="ap-product-box">
        <?php if (has_post_thumbnail($product->ID)) : ?>
            <div class="ap-product-img"><?php echo get_the_post_thumbnail($product->ID, 'medium'); ?></div>
        <?php endif; ?>
        <h3 class="ap-product-title"><a href="<?php echo esc_url($permalink); ?>" class="ap-product-link"><?php echo esc_html($product->post_title); ?></a></h3>
        <?php if ($price !== '') : ?>
            <div class="ap-product-price"> <?php echo esc_html(number_format((int) $price)); ?> تومان</div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean();
}
