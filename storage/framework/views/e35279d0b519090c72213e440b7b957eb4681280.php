<?php if($block->preview): ?>
  <?php if (isset($component)) { $__componentOriginal4fa6ecb6bb50de200ef9e13c7db8788b14417b5b = $component; } ?>
<?php $component = App\View\Components\Preview::resolve(['block' => $block] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('preview'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Preview::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4fa6ecb6bb50de200ef9e13c7db8788b14417b5b)): ?>
<?php $component = $__componentOriginal4fa6ecb6bb50de200ef9e13c7db8788b14417b5b; ?>
<?php unset($__componentOriginal4fa6ecb6bb50de200ef9e13c7db8788b14417b5b); ?>
<?php endif; ?>
<?php else: ?>
  <?php if(!empty($quote)): ?>
    <div class="<?php echo e($block->classes); ?>" <?php if(!empty($animate)): ?> x-data="parallaxBlockquote" <?php endif; ?>>
      <div class="text-container relative overflow-hidden font-serif" x-ref="blockquoteContent">
        <blockquote class="my-15 text-black lg:w-3/4 mx-auto">
          <p class="mb-0 text-1.5xl leading-1.4 font-book tracking-tight">"<?php echo $quote; ?>"</p>
          <?php if(!empty($citation)): ?>
            <cite class="h4 text-2md leading-1.4 font-book font-serif mt-12.5 mb-0 block">
              <?php echo $citation; ?>

            </cite>
          <?php endif; ?>
        </blockquote>
      </div>
    </div>
  <?php endif; ?>
<?php endif; ?>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/blocks/animated-blockquote.blade.php ENDPATH**/ ?>