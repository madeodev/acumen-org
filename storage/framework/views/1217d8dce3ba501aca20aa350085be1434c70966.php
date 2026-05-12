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
  <?php if(!empty($tiles)): ?>
    <section class="<?php echo e($block->classes); ?> bg-stone pt-7.5 pb-20">
      <div class="container-fluid">
        <div class="flex flex-col md:flex-row md:flex-wrap -m-7.5">
          <?php $__currentLoopData = $tiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tile): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="md:w-1/2 lg:w-1/3 flex-grow">
              <div class="block p-7.5 h-full link-no-underline">
                <<?php echo e($tile['tag']); ?>

                  <?php echo e(!empty($tile['button']) ? 'href=' . $tile['button']['url'] . ' target=' . $tile['button']['target'] : ''); ?>

                  class="h-full relative group"
                >
                  <div
                    class="mask overflow-hidden min-h-56 lg:min-h-0 p-7.5 <?php echo e($tile['color']->classes('wrapper')); ?> h-full flex flex-col justify-between"
                  >
                    <div class="md:mb-24">
                      <?php if(!empty($tile['title'])): ?>
                        <h3 animate-text class="h2 relative z-10 mb-4"><?php echo $tile['title']; ?></h3>
                      <?php endif; ?>

                      <?php if(!empty($tile['description'])): ?>
                        <p animate-text class="group-hover:opacity-0 transition duration-500"><?php echo $tile['description']; ?></p>
                      <?php endif; ?>
                    </div>

                    <?php if(!empty($tile['button'])): ?>
                      <div class="relative z-10" animate>
                        <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['element' => 'span','color' => 'icon-white','icon' => 'arrow-right'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['aria-hidden' => 'true','class' => 'relative z-10 mt-10 md:mt-0']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                      </div>
                    <?php endif; ?>

                    <?php if(!empty($tile['image'])): ?>
                      <div
                        class="rounded-card absolute w-full h-full inset-0 group-hover:opacity-100 opacity-0 transition duration-500 z-0 overflow-hidden
                        before:bg-overlay before:absolute before:w-full before:h-full before:inset-0 before:z-[2]"
                      >
                        <?php if (isset($component)) { $__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd = $component; } ?>
<?php $component = App\View\Components\Image::resolve(['id' => $tile['image'],'sizes' => [
                              'DEFAULT' => 'container',
                              'lg' => '1/2',
                              'xl' => '1/3',
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
                      </div>
                    <?php endif; ?>
                  </div>
                  </<?php echo e($tile['tag']); ?>>
              </div>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
<?php endif; ?>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/blocks/tiles.blade.php ENDPATH**/ ?>