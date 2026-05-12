<?php if(!empty($mp4) || !empty($webm)): ?>


    <figure
        x-data="localVideo(<?php echo e($preload); ?>)"
        x-id="['video']"
        x-intersect.margin.400px.once="load"
        x-intersect:enter="videoIsVisible"
        x-intersect:leave="videoIsNotVisible"
        class="absolute inset-0 w-full h-full"
    >
        <video 
            autoplay muted loop playsinline 
            x-ref="video"
            :id="$id('video')"
            class="absolute inset-0 overflow-hidden h-full w-full object-cover"
            <?php if(!empty($thumbnail_url)): ?>
                poster="<?php echo e($thumbnail_url); ?>"
            <?php endif; ?>
        >
            
            <?php if(!empty($webm['url'])): ?>
                <source 
                    <?php if($preload): ?>
                        src="<?php echo e($webm['url']); ?>" 
                    <?php else: ?>
                        :src="src('<?php echo e($webm['url']); ?>')"
                    <?php endif; ?>
                    type="video/webm"
                >
            <?php endif; ?>

            
            <?php if(!empty($mp4['url'])): ?>
                <source 
                    <?php if($preload): ?>
                        src="<?php echo e($mp4['url']); ?>" 
                    <?php else: ?>
                        :src="src('<?php echo e($mp4['url']); ?>')"
                    <?php endif; ?>
                    type="video/mp4"
                >
            <?php endif; ?>

            
            <?php if (isset($component)) { $__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd = $component; } ?>
<?php $component = App\View\Components\Image::resolve(['id' => $placeholder] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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

        </video>

        <?php if(!empty($caption)): ?>
            <figcaption class="sr-only">
                <?php echo $caption; ?>

            </figcaption>
        <?php endif; ?>

        <button
            class="absolute inset-0 focus-visible:-outline-offset-4 focus-visible:outline-white w-full"
            @click="playPause()"
            :aria-pressed="isPlaying"
            :aria-controls="$id('video')"
            :title="isPlaying ?
                '<?php echo __('Click to pause video', 'video'); ?>' :
                '<?php echo __('Click to play video', 'video'); ?>'"
        >
        </button>
    </figure>


<?php endif; ?><?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/components/local-video-loop.blade.php ENDPATH**/ ?>