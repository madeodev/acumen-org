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
  <?php if(!empty($tabs)): ?>
    <section
      x-data="tabs(<?php echo e($tab_count); ?>)"
      x-id="['tab', 'tabpanel']"
      class="<?php echo e($block->classes); ?>"
    >
      <div class="container-fluid">
        <div class="border-current <?php echo e($divider_classes); ?> grid grid-cols-1 md:grid-cols-2 py-18.75">
          <div
            class="flex flex-col mb-7.5 md:mb-0 -mt-5 md:-mt-7.5 <?php echo e($image_alignment === 'right' ? 'md:order-1 md:pr-10 lg:pr-20' : 'md:order-2 md:pl-10 lg:pl-20'); ?>"
          >
            <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div
                class="border-b"
                animate
              >
                <?php if(!empty($tab['label'])): ?>
                  <h3 class="font-bold">
                    <button
                      :id="$id('tab', <?php echo e($loop->iteration); ?>)"
                      @click="selectTab(<?php echo e($loop->iteration); ?>); $dispatch('tab-click')"
                      :aria-expanded="isSelected(<?php echo e($loop->iteration); ?>)"
                      :aria-controls="$id('tabpanel', <?php echo e($loop->iteration); ?>)"
                      class="text-left py-5 md:py-7.5 w-full"
                      type="button"
                    >
                      <?php echo $tab['label']; ?>

                    </button>
                  </h3>
                <?php endif; ?>

                <?php if(!empty($tab['content']) || !empty($tab['button'])): ?>
                  <div
                    x-collapse
                    x-show="isSelected(<?php echo e($loop->iteration); ?>)"
                    role="region"
                    :id="$id('tabpanel', <?php echo e($loop->iteration); ?>)"
                    :aria-labelledby="$id('tab', <?php echo e($loop->iteration); ?>)"
                  >
                    <div class="pb-7.5">
                      <p><?php echo $tab['content']; ?></p>

                      <?php if(!empty($tab['button'])): ?>
                        <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['link' => $tab['button'],'color' => 'link','icon' => 'arrow-right'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                  </div>
                <?php endif; ?>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

          <div
            class="relative overflow-hidden rounded-image lg:rounded-image-xl aspect-[640/683] <?php echo e($image_alignment === 'right' ? 'md:order-2' : 'md:order-1'); ?>"
          >
            <?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div
                class="absolute inset-0 w-full h-full"
                x-transition:enter.duration.600ms
                x-transition:leave.duration.300ms
                x-show="isSelected(<?php echo e($loop->iteration); ?>)"
                :aria-labelledby="$id('tab', <?php echo e($loop->iteration); ?>)"
              >
                <?php if($tab['media_type'] === 'image'): ?>
                  <?php if(!empty($tab['image'])): ?>
                    <?php if (isset($component)) { $__componentOriginalc191e765977296a91bc2fe62b9f5625794b24fb7 = $component; } ?>
<?php $component = App\View\Components\ParallaxImage::resolve(['id' => $tab['image'],'sizes' => [
                          'md' => '3/4',
                      ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('parallax-image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ParallaxImage::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'relative h-full']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc191e765977296a91bc2fe62b9f5625794b24fb7)): ?>
<?php $component = $__componentOriginalc191e765977296a91bc2fe62b9f5625794b24fb7; ?>
<?php unset($__componentOriginalc191e765977296a91bc2fe62b9f5625794b24fb7); ?>
<?php endif; ?>
                  <?php endif; ?>
                <?php else: ?>
                  <?php if(!empty($tab['webm']) || !empty($tab['mp4'])): ?>
                    <?php if (isset($component)) { $__componentOriginal64869fac42a4bc3c05f21f81703896b0b8d37ccc = $component; } ?>
<?php $component = App\View\Components\LocalVideoLoop::resolve(['placeholder' => $tab['placeholder'] ?? '','webm' => $tab['webm'] ?? '','mp4' => $tab['mp4'] ?? ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                <?php endif; ?>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>
<?php endif; ?>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/blocks/tabs.blade.php ENDPATH**/ ?>