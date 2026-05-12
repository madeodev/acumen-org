<footer class="bg-amethyst py-8 lg:py-25 text-white">
  <div class="container-fluid">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-7.5">
      <div class="lg:max-w-[654px]">
        <?php if(!empty($newsletter['form'])): ?>
          <?php if(!empty($newsletter['heading'])): ?>
            <p class="text-lg md:text-xl h4"><?php echo $newsletter['heading']; ?></p>
          <?php endif; ?>
          <?php echo $newsletter['form']; ?>

        <?php endif; ?>
      </div>

      <?php if(!empty($nav)): ?>
        <nav>
          <ul class="list-none flex flex-col md:flex-row gap-7.5 justify-end">
            <?php $__currentLoopData = $nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li class="md:w-1/3 lg:max-w-[160px]">
                <?php if(empty($item['url']) || $item['url'] === '#'): ?>
                  <span class="font-bold"><?php echo $item['title']; ?></span>
                <?php else: ?>
                  <a
                    href="<?php echo e($item['url']); ?>"
                    target="<?php echo e($item['target']); ?>"
                  >
                    <?php echo $item['title']; ?>

                  </a>
                <?php endif; ?>

                <?php if(!empty($item['children'])): ?>
                  <ul class="list-none">
                    <?php $__currentLoopData = $item['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li class="my-3 text-md">
                        <a
                          href="<?php echo e($child['url']); ?>"
                          target="<?php echo e($child['target']); ?>"
                        >
                          <?php echo $child['title']; ?>

                        </a>
                      </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
                <?php endif; ?>
              </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </nav>
      <?php endif; ?>
    </div>

    <div
      class="mt-8 lg:mt-16.75 flex flex-col lg:flex-row lg:grid lg:grid-cols-3 justify-between items-center lg:items-end gap-8"
    >
      <a
        href="<?php echo e(home_url()); ?>"
        class="max-w-[176px] link-no-underline"
      >
        <?php echo e(get_svg('images.logo-white')); ?>
        <span class="sr-only"><?php echo $siteName; ?></span>
      </a>

      <?php if (isset($component)) { $__componentOriginal15618c39a8fe7dc2d9781022cbbebf3043f3856f = $component; } ?>
<?php $component = App\View\Components\SocialMedia::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('social-media'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\SocialMedia::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'lg:flex lg:justify-center']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal15618c39a8fe7dc2d9781022cbbebf3043f3856f)): ?>
<?php $component = $__componentOriginal15618c39a8fe7dc2d9781022cbbebf3043f3856f; ?>
<?php unset($__componentOriginal15618c39a8fe7dc2d9781022cbbebf3043f3856f); ?>
<?php endif; ?>

      <div class="lg:flex lg:justify-end">
        <?php if(!empty($utility)): ?>
          <nav>
            <ul class="list-none flex gap-4 lg:gap-6 xl:gap-8 text-base">
              <?php $__currentLoopData = $utility; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                  <a
                    href="<?php echo e($item['url']); ?>"
                    target="<?php echo e($item['target']); ?>"
                    class="lg:whitespace-nowrap"
                  >
                    <?php echo $item['title']; ?>

                  </a>
                </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              <li>
                <a
                  href="https://briteweb.com"
                  target="_blank"
                  class="lg:whitespace-nowrap"
                >
                  <?php echo __('Site by Briteweb', 'footer'); ?>

                </a>
              </li>
            </ul>
          </nav>
        <?php endif; ?>
      </div>
    </div>
  </div>
</footer>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/components/footer.blade.php ENDPATH**/ ?>