<div
  class="absolute inset-x-0 text-white bg-amethyst top-full shadow-nav"
  x-collapse
  x-cloak
  x-show="isOpen('<?php echo e($loop->iteration); ?>')"
  @focusout="handleFocusOut('button<?php echo e($loop->iteration); ?>')"
  @click.outside="clickOutside(<?php echo e($loop->iteration); ?>)"
>
  <div
    class="container-fluid grid grid-cols-4 gap-7.5 py-15"
    x-data="{ open: null }"
    x-id="['child-description']"
  >
    
    <div class="flex flex-col gap-5">

      <?php if(!empty($item['title'])): ?>
        <div class="text-xl font-bold">
          <?php echo $item['title']; ?>

        </div>
      <?php endif; ?>

      <?php if(!empty($item['description'])): ?>
        <p class="mb-5">
          <?php echo $item['description']; ?>

        </p>
      <?php endif; ?>
      <?php if(!empty($item['url']) && $item['url'] !== '#'): ?>
        <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['link' => $item,'type' => 'icon','icon' => 'arrow-right','color' => 'icon-white'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
    
    <ul class="pl-5 border-l border-white">
      <?php $__currentLoopData = $item['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li>
          <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['link' => $child,'color' => 'subnav','icon' => 'arrow-right'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-bind:class' => 'open === '.e($loop->iteration).' && \'bg-white/30\'','@mouseenter' => 'open = '.e($loop->iteration).'','@focusin' => 'open = '.e($loop->iteration).'','x-bind:aria-describedby' => '$id(\'child-description\', '.e($loop->iteration).')']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
        </li>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    
    <div class="col-span-2 pl-5 border-l border-white">
      <?php $__currentLoopData = $item['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div
          x-show="open === <?php echo e($loop->iteration); ?>"
          class="grid grid-cols-2 gap-7.5"
          role="tooltip"
          :id="$id('child-description', <?php echo e($loop->iteration); ?>)"
        >
          <div>
            <div
              aria-hidden="true"
              class="my-5 text-base font-semibold"
            >
              <?php echo $child['title']; ?>

            </div>
            <p class="text-base leading-5">
              <?php echo $child['description']; ?>

            </p>
          </div>
          <?php if (isset($component)) { $__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd = $component; } ?>
<?php $component = App\View\Components\Image::resolve(['id' => $child['image'],'class' => 'object-cover w-full mask aspect-square'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

  </div>

</div>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/partials/subnav-desktop.blade.php ENDPATH**/ ?>