<?php if(!empty($links)): ?>
    <nav class="flex justify-between gap-2.5 max-w-full my-5 md:my-15" aria-label="<?php echo __('Pagination', 'pagination'); ?>">
        <?php if(!empty($hasPrev)): ?>
            <a href="<?php echo e(get_previous_posts_page_link()); ?>" class="<?php echo e($style); ?> px-3.5 hover:bg-white/20">
                <?php echo __('Previous', 'pagination'); ?>

            </a>
        <?php endif; ?>
        <ul class="hidden sm:flex mx-auto gap-2.5 flex-wrap justify-center" aria-label="<?php echo __('Page links', 'pagination'); ?>">
            <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <?php if(!empty($link['url'])): ?>
                        <a class="<?php echo e($style); ?> hover:bg-white/20" href="<?php echo e($link['url']); ?>" aria-label="<?php echo __('Go to page: ', 'pagination'); ?> <?php echo e($link['num']); ?>">
                            <?php echo $link['num']; ?>

                        </a>                    
                    <?php elseif(!empty($link['current'])): ?>
                        <div class="<?php echo e($style); ?> bg-white text-black h-full w-full" aria-current="true" aria-label="<?php echo __('Page: ', 'pagination'); ?> <?php echo e($link['num']); ?>">
                            <?php echo $link['num']; ?>

                        </div>
                    <?php else: ?>
                        <div class="<?php echo e($style); ?>">
                            <?php echo $link['num']; ?>

                        </div>
                    <?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <?php if(!empty($hasNext)): ?>
            <a href="<?php echo e(get_next_posts_page_link()); ?>" class="<?php echo e($style); ?> px-3.5 hover:bg-white/20">
                <?php echo __('Next', 'pagination'); ?>

            </a>
        <?php endif; ?>
    </nav>
<?php endif; ?><?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/components/pagination.blade.php ENDPATH**/ ?>