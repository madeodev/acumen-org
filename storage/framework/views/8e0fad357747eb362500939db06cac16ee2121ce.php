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
  <section class="<?php echo e($block->classes); ?> py-20 bg-tulip">
    <div class="container-fluid">
      <div class="flex flex-col xl:flex-row bg-stone rounded-card overflow-hidden">
        <div class="xl:w-2/3">
          <div class="p-10">
            <?php if(!empty($title)): ?>
              <h2 class="mb-3"><?php echo $title; ?></h2>
            <?php endif; ?>

            <?php if(!empty($intro)): ?>
              <p class="mt-2"><?php echo $intro; ?></p>
            <?php endif; ?>

            <?php if(!empty($form)): ?>
              <?php echo $form; ?>

            <?php endif; ?>
          </div>
        </div>

        <div class="xl:w-1/3 relative">
          <?php if (isset($component)) { $__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd = $component; } ?>
<?php $component = App\View\Components\Image::resolve(['id' => $image,'class' => 'hidden xl:block xl:absolute xl:inset-0 w-full h-full object-cover'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/blocks/form.blade.php ENDPATH**/ ?>