<<?php echo $element; ?> <?php echo e($attributes->merge([
    'class' => $colors->classes('outer'),
    ...$link_attrs,
])); ?>>

  <?php if(!empty($icon)): ?>
    <?php echo e(get_svg('images.' . $icon, $icon_class)); ?>
  <?php endif; ?>

  <span class="relative z-5 <?php echo e($type === 'icon' ? 'sr-only' : ''); ?>">
    <?php echo $slot->isNotEmpty() ? $slot : $title; ?>

  </span>

  </<?php echo $element; ?>>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/components/button.blade.php ENDPATH**/ ?>