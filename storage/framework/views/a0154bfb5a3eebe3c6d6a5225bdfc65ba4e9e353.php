<?php if(!empty($image)): ?>
  <div
    class="after:absolute after:uppercase after:text-white after:inset-0
    after:bg-black after:bg-opacity-25 relative">
    <div class="text-white absolute inset-0 px-3 py-10 font-bold font-sans z-10 text-center w-full">
      <p class="text-4xl my-0">
        <?php echo __('Preview Only', 'sage'); ?>

      </p>

      <p class="text-3xl my-0">
        <?php echo $name; ?>

      </p>
    </div>

    <img src="<?php echo e($image); ?>" class="w-full h-auto" />
  </div>
<?php else: ?>
  <?php if(current_user_can('manage_options')): ?>
    <div class="container-fluid text-sans-serif py-5">
      <p class="text-3xl my-0">
        <?php echo $name; ?>

      </p>

      <p class=""><strong><?php echo __('Admin Notice:', 'preview'); ?></strong> <?php echo __('Preview image is not available. Please add a screenshot of the module.', 'preview'); ?></p>
  <?php endif; ?>
  </div>
<?php endif; ?>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/components/preview.blade.php ENDPATH**/ ?>