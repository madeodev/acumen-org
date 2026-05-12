<?php if($block->preview): ?>
  <?php if (isset($component)) { $__componentOriginal4fa6ecb6bb50de200ef9e13c7db8788b14417b5b = $component; } ?>
<?php $component = App\View\Components\Preview::resolve(['block' => $block,'variant' => $module_bg] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
  <header
    class="<?php echo e($block->classes); ?> <?php echo e($colors->classes('wrapper')); ?> relative overflow-hidden"
    <?php if(!empty($modal['video'])): ?> x-data="videoModal" <?php endif; ?>
  >
    <div class="container-fluid pt-15 md:pt-18.75 pb-20 md:pb-45 relative z-10">
      <div class="md:max-w-[75%]">
        <?php if(!empty($title)): ?>
          <h1
            class="hero-headline"
            id="<?php echo e(!empty($modal) ? $modal['id'] . '_label' : ''); ?>"
            animate-text
          >
            <?php echo $title; ?>

          </h1>
        <?php endif; ?>

        <?php if(!empty($intro)): ?>
          <p
            class="h3 mt-8 md:mt-15"
            animate-text
            id="<?php echo e(!empty($modal) ? $modal['id'] . '_desc' : ''); ?>"
          >
            <?php echo $intro; ?>

          </p>
        <?php endif; ?>

        <?php if(!empty($button)): ?>
          <div
            class="mt-8 md:mt-15"
            animate
          >
            <?php if($button_type === 'modal' && !empty($modal['video'])): ?>
              <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['icon' => 'play-arrow','element' => 'button','color' => 'fill'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['@click' => 'triggerOpenModal']); ?>
                <?php echo $button['title']; ?>

               <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
            <?php else: ?>
              <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['link' => $button,'externalGetsIconNewTab' => true,'color' => 'fill'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>

    <?php if($module_bg === 'media'): ?>
      <div
        class="top-0 left-0 absolute w-full h-full
          before:bg-overlay before:absolute before:top-0 before:left-0 before:w-full before:h-full before:z-5"
      >
        <?php if(!empty($image)): ?>
          <?php if (isset($component)) { $__componentOriginalc191e765977296a91bc2fe62b9f5625794b24fb7 = $component; } ?>
<?php $component = App\View\Components\ParallaxImage::resolve(['id' => $image] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('parallax-image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ParallaxImage::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'relative h-full w-full']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc191e765977296a91bc2fe62b9f5625794b24fb7)): ?>
<?php $component = $__componentOriginalc191e765977296a91bc2fe62b9f5625794b24fb7; ?>
<?php unset($__componentOriginalc191e765977296a91bc2fe62b9f5625794b24fb7); ?>
<?php endif; ?>
        <?php endif; ?>

        <?php if(!empty($webm) || !empty($mp4)): ?>
          <?php if (isset($component)) { $__componentOriginal64869fac42a4bc3c05f21f81703896b0b8d37ccc = $component; } ?>
<?php $component = App\View\Components\LocalVideoLoop::resolve(['preload' => true,'placeholder' => $placeholder ?? '','webm' => $webm ?? '','mp4' => $mp4 ?? ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
    <?php endif; ?>

    <?php if(!empty($modal)): ?>
      <?php if (isset($component)) { $__componentOriginal13cd62ee95dd1d285ed21430aee96d224c892306 = $component; } ?>
<?php $component = App\View\Components\ModalVideo::resolve(['modal' => $modal] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('modal-video'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ModalVideo::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal13cd62ee95dd1d285ed21430aee96d224c892306)): ?>
<?php $component = $__componentOriginal13cd62ee95dd1d285ed21430aee96d224c892306; ?>
<?php unset($__componentOriginal13cd62ee95dd1d285ed21430aee96d224c892306); ?>
<?php endif; ?>
    <?php endif; ?>
  </header>
<?php endif; ?>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/blocks/hero.blade.php ENDPATH**/ ?>