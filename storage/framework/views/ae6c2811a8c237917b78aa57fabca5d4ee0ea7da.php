<article <?php (post_class()); ?>>
  <header>
    <h2 class="entry-title">
      <a href="<?php echo e(get_permalink()); ?>">
        <?php echo $title; ?>

      </a>
    </h2>
  </header>

  <div class="entry-summary">
    <?php (the_excerpt()); ?>
  </div>
</article>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/partials/content.blade.php ENDPATH**/ ?>