<section class="<?php echo e($block->classes); ?> <?php echo e($colors->classes('wrapper')); ?>">
  <div class="container-fluid py-10 lg:pt-24 lg:pb-16 lg:px-48">
    
    <?php if(!empty($heading)): ?>
      <div class="pb-11 lg:pb-16 text-center lg:text-left">
        <<?php echo e($heading_primary); ?> animate-text class="font-normal text-4xl lg:text-5xl"><?php echo $heading; ?></<?php echo e($heading_primary); ?>>
      </div>
    <?php endif; ?>

    
    <?php if(!empty($stats)): ?>
      <div class="flex flex-wrap">
        <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          
          <div class="pt-10 first:pt-0 lg:pt-0 lg:pb-10 w-full lg:w-1/2">
            
            <?php if(!empty($stat['stat_heading'])): ?>
              <<?php echo e($heading_secondary); ?> class="font-bold text-4xl text-center lg:text-left" animate-text>
                <?php echo $stat['stat_heading']; ?>

              </<?php echo e($heading_secondary); ?>>
            <?php endif; ?>

            
            <?php if(!empty($stat['stat_description'])): ?>
              <p class="leading-8 text-2xl font-light text-center mx-auto lg:mx-0 lg:text-left lg:pt-7 max-w-[550px] lg:max-w-[85%] opacity-60" animate-text> 
                <?php echo $stat['stat_description']; ?>

              </p>
            <?php endif; ?>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    <?php endif; ?>
  </div>
</section>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/blocks/numbers.blade.php ENDPATH**/ ?>