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
  <section class="<?php echo e($block->classes); ?> <?php echo e($colors->classes('wrapper')); ?>">
    <div class="container-fluid">
      <div class="border-current <?php echo e($divider_classes); ?> grid grid-cols-1 lg:grid-cols-2 gap-y-7.5 py-7.5 lg:py-15">
        <?php if(!empty($headline)): ?>
          <<?php echo e($heading_tag); ?> class="h2 lg:mr-20 xl:mr-30" animate-text >
            <?php echo $headline; ?>

          </<?php echo e($heading_tag); ?>>
        <?php endif; ?>

        <?php if(!empty($text_area)): ?>
          <div class="wysiwyg" animate-text>
            <?php echo $text_area; ?>

          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
<?php endif; ?>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/blocks/fifty-fifty.blade.php ENDPATH**/ ?>