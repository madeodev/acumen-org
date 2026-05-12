<?php if(!empty($id)): ?>
    <?php echo wp_get_attachment_image($id, $size, null, [
        'class' => $class,
        'sizes' => $sizes,
        ...$attributes->merge(['style' => $focal_point,])
    ]); ?>

<?php endif; ?><?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/components/image.blade.php ENDPATH**/ ?>