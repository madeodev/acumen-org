<?php if(!empty($label)): ?>
  <span
    <?php echo e($attributes->merge([
        'class' => 'inline-flex gap-1.5 items-center justify-center w-fit text-md',
    ])); ?>>

    <?php if(!empty($icon)): ?>
      <?php echo e(get_svg($icon)); ?>
    <?php endif; ?>

    <?php if(!empty($label)): ?>
      <span>
        <?php echo $label; ?>

      </span>
    <?php endif; ?>

  </span>
<?php endif; ?>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/components/topic-label.blade.php ENDPATH**/ ?>