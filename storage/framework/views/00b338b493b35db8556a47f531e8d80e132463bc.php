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
  <section class="<?php echo e($block->classes); ?> my-20">
    <div class="container-fluid company-grid-vue">
      <company-grid
        :endpoints='<?php echo json_encode($endpoints, 15, 512) ?>'
        :labels='<?php echo json_encode($labels, 15, 512) ?>'
        :classes='<?php echo json_encode($classes, 15, 512) ?>'
        :prefilter='<?php echo json_encode($prefilter, 15, 512) ?>'
        :preselected='<?php echo json_encode($preselected, 15, 512) ?>'
      >
        <?php if(!empty($heading)): ?>
          <template v-slot:title>
            <?php echo $heading; ?>

          </template>
        <?php endif; ?>
      </company-grid>
    </div>
  </section>
<?php endif; ?>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/blocks/company-grid.blade.php ENDPATH**/ ?>