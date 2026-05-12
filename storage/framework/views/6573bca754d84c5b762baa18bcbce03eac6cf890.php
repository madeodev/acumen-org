<header
  class="relative z-50 bg-stone"
  x-data="nav"
  @mouseover.away="handleEscape"
>
  <div
    x-data="logoAnimation"
    <?php if(is_front_page()): ?> @scroll.window.once="animate" @click.once="animate" @resize.window="onResize" <?php endif; ?>
  >
    <div>
      <div class="container-fluid flex py-2 xl:py-7.5 gap-15">

        <a
          class="link-no-underline"
          href="<?php echo e(home_url('/')); ?>"
          aria-label="<?php echo $siteName; ?>"
        >
          <?php if(is_front_page()): ?>
            <?php echo e(get_svg('images.logomark', 'h-auto w-12.5 xl:w-25', ['x-ref' => 'logomark'])); ?>
            <?php echo e(get_svg('images.logo', 'hidden h-auto w-12.5 xl:w-25', ['x-ref' => 'logo'])); ?>
            <span
              class="block h-2.5 xl:h-3.5 duration-1000 transition-height"
              x-ref="wordmarkSpacer"
              aria-hidden="true"
            ></span>
          <?php else: ?>
            <?php echo e(get_svg('images.logo', 'h-auto w-12.5 xl:w-25')); ?>
          <?php endif; ?>
        </a>

        <?php echo $__env->make('partials.nav-desktop', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      </div>
      <div id="nav-desktop-container"></div>
    </div>

    <?php if(is_front_page()): ?>
      <div
        class="text-center container-fluid"
        x-ref="logoDiv"
      >
        <?php echo e(get_svg('images.logo-text', 'h-auto max-w-full inline-block transition-all duration-1000 origin-top-left my-[10%]', ['x-ref' => 'logoText'])); ?>
      </div>
    <?php endif; ?>
  </div>
  <?php echo $__env->make('partials.nav-mobile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</header>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/sections/header.blade.php ENDPATH**/ ?>