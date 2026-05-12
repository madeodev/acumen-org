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
  <?php if(!empty($cards)): ?>
    <section
      x-data="carouselLarge"
      class="<?php echo e($block->classes); ?> <?php echo e($colors->classes('wrapper')); ?> py-5 relative"
    >

      <div
        class="swiper w-full h-fit"
        class="w-full h-fit"
        tabindex="0"
        x-ref="swiper"
      >
        <div class="swiper-wrapper">
          <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div
              class="swiper-slide h-fit p-1 md:px-7.5 md:-mr-10 xl:mr-0 lg:pl-20 3xl:pl-0 md:w-10/12 3xl:ml-[calc((100vw-1376px)/2)] 3xl:-mr-[calc(((100vw-1376px)/2)-80px)] max-w-200 last:md:mr-[16.666%] min-[962px]:last:mr-[calc(100vw-50rem)]"
            >
              <<?php echo $card['element_start']; ?>

                class="rounded-card block link-no-underline py-5 px-4 md:p-5 md:pb-8 <?php echo e($card['style']); ?>"
              >

                <?php if(!empty($card['image'])): ?>
                  <div class="aspect-[10/6] w-full mb-5 rounded-card relative overflow-hidden">
                    <div data-swiper-parallax-x="25%">
                      <?php if (isset($component)) { $__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd = $component; } ?>
<?php $component = App\View\Components\Image::resolve(['id' => $card['image'],'class' => 'scale-125 origin-left w-full h-full object-cover','sizes' => ['md' => '10/12', '2xl' => '64rem']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                <?php endif; ?>

                <div
                  class="transition-opacity duration-700"
                  :class="activeSlide == <?php echo e($loop->index); ?> ? 'opacity-100' : 'opacity-0'"
                >
                  <?php if(!empty($card['title'])): ?>
                    <h2
                      class="mb-10"
                      animate-text
                    >
                      <?php echo $card['title']; ?>

                    </h2>
                  <?php endif; ?>

                  <?php if(!empty($card['button'])): ?>
                    <div animate>
                      <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['link' => $card['button'],'element' => 'span','color' => $colors->classes('button')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'group-hover:text-black group-hover:bg-white group-hover:border-white']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                    </div>
                  <?php endif; ?>
                </div>

                </<?php echo $card['element_end']; ?>>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>

      
      <?php if(count($cards) > 1): ?>
        <div
          class="z-10 absolute bottom-6 -right-2.5 px-7.5 p-5 flex flex-col items-end max-w-200 pointer-events-none
         md:w-10/12 md:right-auto md:bottom-auto md:top-0 md:left-0 md:py-11 md:px-12.5 md:gap-9
         lg:pl-25
         3xl:pl-5 3xl:ml-[calc((100vw-1376px)/2)]"
          animate
        >
          <div
            class="w-full aspect-[10/6] hidden md:block relative z-0"
            aria-hidden="true"
          ></div>
          <div class="flex gap-5 md:-mr-38 lg:-mr-50 xl:-mr-60 pointer-events-auto">
            <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['type' => 'icon','icon' => 'arrow-left','element' => 'button','color' => 'icon-white'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-ref' => 'prev']); ?>
              <?php echo __('Previous Slide', 'carousel'); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>

            <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['type' => 'icon','icon' => 'arrow-right','element' => 'button','color' => 'icon-white'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-ref' => 'next']); ?>
              <?php echo __('Next Slide', 'carousel'); ?>

             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>

          </div>
        </div>
      <?php endif; ?>
    </section>
  <?php endif; ?>
<?php endif; ?>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/blocks/carousel-large.blade.php ENDPATH**/ ?>