<div <?php echo e($attributes->merge(['class' => $wrapper_classes])); ?>>
    <div class="<?php echo e($innerClasses); ?>">

        <?php if(!empty($title)): ?>
            <h2 class="mb-10 md:mb-15" animate-text>
                <?php echo $title; ?>

            </h2>
        <?php endif; ?>

        <?php if(!empty($stats)): ?>
            <div
                x-data="stats"
                class="flex flex-wrap justify-between -mx-5 lg:-mx-10 gap-y-5 md:gap-y-10"
            >
                <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(empty($stat['stat'])) continue; ?>
                    <?php if($count == 4 && $loop->iteration == 3): ?>
                        <div class="flex justify-between flex-wrap xl:flex-nowrap flex-1 basis-1/2 gap-y-5 md:gap-y-10">
                    <?php endif; ?>
                        <figure class="px-5 md:px-10 flex-1 max-w-sm md:max-w-none <?php echo e($style); ?>">
                            <div 
                                aria-label="<?php echo e($stat['stat']); ?>"
                                x-html="getStatHTML('<?php echo e($stat['stat']); ?>')"
                                x-intersect.full="animateNumber($el)"
                                @resize.window.throttle="unsetWidth($el)"
                                class="h-20 md:h-30 overflow-hidden flex relative items-center font-display text-5.5xl font-medium leading-extra-tight tracking-tight md:text-8xl md:font-bold">
                            </div>

                            <?php if(!empty($stat['description'])): ?>
                                <figcaption class="md:text-lg">
                                    <?php echo $stat['description']; ?>

                                </figcaption>
                            <?php endif; ?>
                        </figure>
                    <?php if($loop->iteration == 4): ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</div><?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/components/stats.blade.php ENDPATH**/ ?>