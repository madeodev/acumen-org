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
  <section class="<?php echo e($block->classes); ?> text-container border-black border-t mt-15 mb-7.5 py-7.5">
    <div class="py-2.5 flex gap-10 items-center" animate>
      <h2 class="h4 m-0">
        <?php echo __('Share', 'share_buttons'); ?>

      </h2>
      <ul class="flex gap-2 items-center" x-data="shareButtons('<?php echo e($copied); ?>', '<?php echo e($copy_failed); ?>')">

        <?php $__currentLoopData = $share_options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

          <li>
            <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['link' => [...$option, 'target' => '_blank'],'color' => 'icon-black-small','iconClass' => 'w-auto','type' => 'icon','icon' => $option['image']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['@click.prevent' => 'open($el)','title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($option['title'])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
          </li>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <li class="relative" x-id="['tooltip']">

          <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['element' => 'button','color' => 'icon-black-small','iconClass' => 'pr-0.5 w-auto','type' => 'icon','icon' => 'share'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['@click' => 'copyLink()','x-bind:aria-describedby' => 'tooltip && $id(\'tooltip\')','title' => ''.__('Copy link', 'share_buttons').'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
          <div 
            :id="$id('tooltip')" 
            x-show="tooltip"
            x-text="tooltip"
            class="absolute bg-black text-white rounded-md py-1 px-2 text-sm whitespace-nowrap left-1/2 -translate-x-1/2 -top-9"
          ></div>
        </li>
      </ul>
    </div>

  </section>
<?php endif; ?>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/blocks/share-buttons.blade.php ENDPATH**/ ?>