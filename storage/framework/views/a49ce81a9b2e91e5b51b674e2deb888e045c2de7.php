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
  <section class="<?php echo e($block->classes); ?> bg-stone">
    <div class="container-fluid py-15 lg:py-20">
      <div class="rounded-card lg:grid lg:grid-cols-2 overflow-hidden <?php echo e($colors->classes('wrapper')); ?>">

        <div
          class="aspect-[1.14] sm:aspect-video lg:max-h-none lg:aspect-auto w-full lg:h-full relative <?php echo e($image_alignment === 'right' ? 'lg:order-2' : 'lg:order-1'); ?>"
        >
          <?php if(!empty($image)): ?>
            <?php if (isset($component)) { $__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd = $component; } ?>
<?php $component = App\View\Components\Image::resolve(['id' => $image] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
          <?php elseif(!empty($webm) || !empty($mp4)): ?>
            <?php if (isset($component)) { $__componentOriginal64869fac42a4bc3c05f21f81703896b0b8d37ccc = $component; } ?>
<?php $component = App\View\Components\LocalVideoLoop::resolve(['placeholder' => $placeholder ?? '','webm' => $webm ?? '','mp4' => $mp4 ?? ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('local-video-loop'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\LocalVideoLoop::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal64869fac42a4bc3c05f21f81703896b0b8d37ccc)): ?>
<?php $component = $__componentOriginal64869fac42a4bc3c05f21f81703896b0b8d37ccc; ?>
<?php unset($__componentOriginal64869fac42a4bc3c05f21f81703896b0b8d37ccc); ?>
<?php endif; ?>
          <?php endif; ?>
        </div>

        <div
          class="p-7.5 sm:pb-12 flex flex-col gap-7.5 lg:px-15 lg:pt-20 lg:pb-30 lg:gap-15 <?php echo e($image_alignment === 'right' ? 'lg:order-1' : 'lg:order-2'); ?>"
        >

          <?php if(!empty($topic)): ?>
            <div animate>
              <?php if (isset($component)) { $__componentOriginal67775c62b8aa18f998083b546d1498ce205e2130 = $component; } ?>
<?php $component = App\View\Components\TopicLabel::resolve(['label' => $topic,'icon' => $topic_icon] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('topic-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\TopicLabel::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal67775c62b8aa18f998083b546d1498ce205e2130)): ?>
<?php $component = $__componentOriginal67775c62b8aa18f998083b546d1498ce205e2130; ?>
<?php unset($__componentOriginal67775c62b8aa18f998083b546d1498ce205e2130); ?>
<?php endif; ?>
            </div>
          <?php endif; ?>

          <div>
            <?php if(!empty($headline)): ?>
              <h3
                class="mb-5"
                animate-text
              >
                <?php echo $headline; ?>

              </h3>
            <?php endif; ?>

            <?php if(!empty($text)): ?>
              <div
                class="wysiwyg"
                animate-text
              >
                <?php echo $text; ?>

              </div>
            <?php endif; ?>
          </div>

          <?php if(!empty($buttons)): ?>
            <div
              class="flex flex-col gap-7.5 sm:flex-row"
              animate
            >
              <?php $__currentLoopData = $buttons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(empty($item['button']['url'])) continue; ?>

                <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['link' => $item['button'],'color' => $colors->classes('button')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-fit']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          <?php endif; ?>

        </div>

      </div>
    </div>
  </section>
<?php endif; ?>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/blocks/text-card.blade.php ENDPATH**/ ?>