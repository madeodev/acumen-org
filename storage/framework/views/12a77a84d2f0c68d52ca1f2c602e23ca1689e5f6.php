<div
  <?php echo e($attributes); ?>

  class="fixed top-0 left-0 w-full h-full bg-black/80 z-50"
  role="dialog"
  x-show="isModalOpen"
  x-trap="isModalOpen"
  x-transition
  x-cloak
  aria-modal="true"
  aria-labelledby="<?php echo e($id); ?>_label"
  aria-describedby="<?php echo e($id); ?>_desc"
  @keyup.escape="triggerCloseModal"
>
  <button
    @click="triggerCloseModal"
    class="<?php echo e($button_class); ?> border rounded-full w-12.5 h-12.5 flex items-center justify-center absolute right-5 top-5"
  >
    <?php echo e(get_svg('images.close')); ?>
    <span class="sr-only"><?php echo __('Close modal', 'modal-video'); ?></span>
  </button>

  <div class="lg:container-fluid w-screen lg:w-auto h-screen flex items-center justify-center">
    <iframe
      data-src="<?php echo e($src); ?>"
      class="object-cover mx-auto w-full lg:h-full aspect-video lg:px-0"
      frameborder="0"
      allow="autoplay"
      x-ref="video"
      @click.outside="triggerCloseModal"
    ></iframe>
  </div>
</div>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/components/modal-video.blade.php ENDPATH**/ ?>