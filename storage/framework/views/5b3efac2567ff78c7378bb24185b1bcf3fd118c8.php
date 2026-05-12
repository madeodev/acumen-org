<div
  class="hidden xl:flex flex-col gap-5 ml-auto xl:min-w-[77%]"
  x-ref="nav"
>
  
  <?php if(!empty($util_nav)): ?>
    <nav
      class="flex border-b border-black pb-1.25"
      aria-label="<?php echo wp_get_nav_menu_name('utility_navigation'); ?>"
    >
      <?php if(!empty($util_nav)): ?>
        <div class="text-sm font-semibold py-1.25">
          <?php echo $util_intro; ?>

        </div>
      <?php endif; ?>
      <ul class="flex gap-5 ml-auto">
        <?php $__currentLoopData = $util_nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li>
            <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['link' => $item,'color' => 'utility-nav','icon' => 'arrow-outward'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    </nav>
  <?php endif; ?>

  
  <?php if(!empty($main_nav)): ?>
    <nav
      aria-label="<?php echo wp_get_nav_menu_name('main_navigation'); ?>"
      
    >
      <ul class="flex items-baseline gap-10">
        <?php $__currentLoopData = $main_nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          
          <?php if($item['children']->isEmpty() && !$loop->last): ?>
            <li>
              <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['link' => $item,'color' => 'main-nav'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
            </li>

            
          <?php elseif(!$loop->last): ?>
            <li>
              <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['link' => $item,'color' => 'main-nav'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-ref' => 'button'.e($loop->iteration).'','class' => 'menu-item-parent','@mouseover' => 'openMenu('.e($loop->iteration).')','x-bind:aria-expanded' => 'isOpen('.e($loop->iteration).')','x-bind:class' => 'isOpen('.e($loop->iteration).') ?
                    \'font-bold text-amethyst border-amethyst border-b-4\' :
                    \'border-transparent mb-0.5\'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>

              <template x-teleport="#nav-desktop-container">
                <?php echo $__env->make('partials.subnav-desktop', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </template>
            </li>

            
          <?php else: ?>
            
            <li class="ml-auto">
              <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['element' => 'button','icon' => 'search','color' => 'icon-black'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-ref' => 'button-search','@click' => 'toggleMenu(\'desktopSearch\'); $nextTick(()=>$refs.desktopSearch.focus())','aria-label' => ''.__('Search', 'header').'','x-bind:aria-expanded' => 'isOpen(\'desktopSearch\')']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
              
              <div
                class="absolute inset-x-0 text-white bg-amethyst top-full shadow-nav"
                x-collapse
                x-cloak
                x-show="isOpen('desktopSearch')"
                @focusout="handleFocusOut('button-search')"
                @click.outside="clickOutside('desktopSearch')"
              >
                <div class="flex items-center justify-center container-fluid py-30">
                  <?php if (isset($component)) { $__componentOriginal273c2b890110ed93d4869fccd597db0137d3980d = $component; } ?>
<?php $component = App\View\Components\SearchForm::resolve(['ref' => 'desktopSearch'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('search-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\SearchForm::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal273c2b890110ed93d4869fccd597db0137d3980d)): ?>
<?php $component = $__componentOriginal273c2b890110ed93d4869fccd597db0137d3980d; ?>
<?php unset($__componentOriginal273c2b890110ed93d4869fccd597db0137d3980d); ?>
<?php endif; ?>
                </div>
              </div>
            </li>

            
            <li>
              <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['link' => $item,'color' => 'nav-donate','icon' => 'none'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
            </li>
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </ul>
    </nav>
  <?php endif; ?>
</div>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/partials/nav-desktop.blade.php ENDPATH**/ ?>