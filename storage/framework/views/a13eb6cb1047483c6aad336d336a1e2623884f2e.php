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
<section class="<?php echo e($block->classes); ?> py-10 sm:py-16 relative bg-maize">
    
    <!-- Hero Header -->
    <div class="container-fluid">
      <?php if(!empty($heading)): ?>
        <<?php echo e($heading_primary); ?> class="font-bold mb-8">
          <?php echo $heading; ?>

        </<?php echo e($heading_primary); ?>>
      <?php endif; ?>
      
      <?php if(!empty($subheading)): ?>
        <p class="text-xl lg:text-2xl">
          <?php echo $subheading; ?>

        </p>
      <?php endif; ?>
    </div>

    <div class="knowledge-hub-hero-posts-slider-vue py-6 sm:py-16">
          <!-- Posts Slider -->
      <knowledge-hub-hero-posts-slider
        :endpoints='<?php echo json_encode($endpoints, 15, 512) ?>'
        :labels='<?php echo json_encode($labels, 15, 512) ?>'
        :post-types='<?php echo json_encode($post_types, 15, 512) ?>'
        :posts-slider-title='<?php echo json_encode($posts_slider_title, 15, 512) ?>'
      />  
    </div>
  </section>
<?php endif; ?><?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/blocks/knowledge-hub-hero.blade.php ENDPATH**/ ?>