<article class="flex flex-col gap-5 md:gap-10 md:flex-row max-w-160">
  <div class="w-45">
    <div class="overflow-hidden w-full rounded-10 aspect-square bg-black/10">
      <?php if(!empty($image)): ?>
        <?php if (isset($component)) { $__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd = $component; } ?>
<?php $component = App\View\Components\Image::resolve(['id' => $image,'class' => 'object-cover w-full h-full'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Image::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd)): ?>
<?php $component = $__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd; ?>
<?php unset($__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd); ?>
<?php endif; ?>
      <?php else: ?>
        <?php echo e(get_svg('images.logo', 'p-5 w-full h-full grayscale opacity-30 object-contain')); ?>
      <?php endif; ?>
    </div>
  </div>

  <div class="w-full">
    <?php if(!empty($name)): ?>
      <h3 class="mb-1.5 text-lg font-bold h5"><?php echo $name; ?></h3>
    <?php endif; ?>

    <?php if(!empty($title)): ?>
      <p class="mb-3 text-base font-bold"><?php echo $title; ?></p>
    <?php endif; ?>

    <?php if(!empty($bio)): ?>
      <p class="mt-3 mb-0 text-base"><?php echo $bio; ?></p>
    <?php endif; ?>
  </div>
</article>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/components/author-card.blade.php ENDPATH**/ ?>