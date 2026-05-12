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
  <?php if(!empty($items)): ?>
    <section
      class="<?php echo e($block->classes); ?> py-15 lg:py-20"
      x-data="carouselCaseStudyCard"
    >
      <div class="container-fluid relative">
        <div
          class="swiper h-fit"
          x-ref="swiper"
          tabindex="0"
        >
          <div class="swiper-wrapper">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="swiper-slide h-auto">
                <div
                  class="rounded-card overflow-hidden grid grid-cols-1 lg:grid-cols-2 h-full <?php echo e($item['color']->classes('wrapper')); ?>"
                >
                  <div class="py-7.5 px-5 lg:py-20 lg:px-15 inline-flex w-full flex-col gap-5 md:gap-7.5">
                    <?php if(!empty($item['term'])): ?>
                      <div animate>
                        <?php if (isset($component)) { $__componentOriginal67775c62b8aa18f998083b546d1498ce205e2130 = $component; } ?>
<?php $component = App\View\Components\TopicLabel::resolve(['term' => $item['term']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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

                    <?php if(!empty($item['title'])): ?>
                      <h2
                        animate-text
                        class="mb-0"
                      ><?php echo $item['title']; ?></h2>
                    <?php endif; ?>

                    <?php if(!empty($item['primary_problem']) || !empty($item['primary_region']) || !empty($item['year'])): ?>
                      <div
                        class="border-t pt-5 inline-flex gap-x-5 gap-y-2 flex-wrap"
                        animate
                      >
                        <?php if(!empty($item['primary_problem'])): ?>
                          <?php if (isset($component)) { $__componentOriginal67775c62b8aa18f998083b546d1498ce205e2130 = $component; } ?>
<?php $component = App\View\Components\TopicLabel::resolve(['term' => $item['primary_problem']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                        <?php endif; ?>
                        <?php if(!empty($item['primary_region'])): ?>
                          <?php if (isset($component)) { $__componentOriginal67775c62b8aa18f998083b546d1498ce205e2130 = $component; } ?>
<?php $component = App\View\Components\TopicLabel::resolve(['term' => $item['primary_region']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                        <?php endif; ?>
                        <?php if(!empty($item['year'])): ?>
                          <?php if (isset($component)) { $__componentOriginal67775c62b8aa18f998083b546d1498ce205e2130 = $component; } ?>
<?php $component = App\View\Components\TopicLabel::resolve(['term' => $item['year']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                        <?php endif; ?>
                      </div>
                    <?php endif; ?>

                    <?php if(!empty($item['excerpt'])): ?>
                      <p
                        animate-text
                        class="h3 text-lg md:text-2xl mb-0"
                      ><?php echo $item['excerpt']; ?></p>
                    <?php endif; ?>

                    <?php if(!empty($item['stats']['stats'])): ?>
                      <div class="border-t w-full hidden md:inline-flex gap-5 lg:gap-15 pt-5">
                        <?php $__currentLoopData = $item['stats']['stats']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <figure>
                            <?php if(!empty($stat['stat'])): ?>
                              <p
                                animate
                                class="h3 mb-0"
                              ><?php echo $stat['stat']; ?></p>
                            <?php endif; ?>

                            <?php if(!empty($stat['description'])): ?>
                              <figcaption
                                animate-text
                                class="mb-0"
                              >
                                <?php echo $stat['description']; ?>

                              </figcaption>
                            <?php endif; ?>
                          </figure>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </div>
                    <?php endif; ?>

                    <div animate>
                      <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['link' => $item['button'],'color' => 'outline-white'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'self-start lg:mt-7.5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                    </div>
                  </div>

                  <div>
                    <?php if(!empty($item['featured_image'])): ?>
                      <?php if (isset($component)) { $__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd = $component; } ?>
<?php $component = App\View\Components\Image::resolve(['id' => $item['featured_image'],'class' => 'aspect-[335/167] lg:aspect-auto h-full w-full object-cover','sizes' => [
                            'DEFAULT' => 'container',
                            'lg' => '3/4',
                        ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>

        <?php if(count($items) > 1): ?>
          <div class="flex justify-between lg:block mt-5 lg:mt-0 items-center">
            <div class="inline-flex gap-5 lg:block">
              <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['element' => 'button','type' => 'icon','color' => 'icon-black','icon' => 'arrow-left'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-ref' => 'prev','class' => 'lg:absolute left-0 top-1/2 lg:-translate-y-1/2 lg:ml-4']); ?>
                <?php echo __('Previous slide', 'case-study-carousel'); ?>

               <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
              <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['element' => 'button','type' => 'icon','color' => 'icon-black','icon' => 'arrow-right'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-ref' => 'next','class' => 'lg:absolute right-0 top-1/2 lg:-translate-y-1/2 lg:mr-4']); ?>
                <?php echo __('Previous slide', 'case-study-carousel'); ?>

               <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
            </div>

            <div
              class="lg:mt-7.5 lg:pb-1 flex items-center justify-end lg:justify-center"
              x-ref="pagination"
            ></div>
          </div>
        <?php endif; ?>
      </div>
    </section>
  <?php endif; ?>
<?php endif; ?>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/blocks/carousel-case-study-card.blade.php ENDPATH**/ ?>