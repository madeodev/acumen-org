<div
  class="ml-auto flex xl:hidden flex-col gap-5"
  x-data="nav(true)"
  @keydown.escape.window="handleEscape"
  @resize.window.debounce="handleWindowResize"
>

  <div class="container-fluid absolute top-4 right-0">
    <button
      @click="toggleMobileNav"
      aria-label="<?php echo __('Open navigation menu', 'header'); ?>"
      class=" h-9 w-9 border border-black rounded-full flex flex-col items-center justify-center group hover:bg-black"
    >
      <div
        aria-hidden="true"
        class="h-[1.5px] w-3.5 bg-black my-[1.5px] rounded-1 group-hover:bg-white transform-gpu transition origin-center"
        :class="mobileNavOpen && 'rotate-[135deg] translate-y-[4.5px]'"
      ></div>
      <div
        aria-hidden="true"
        class="h-[1.5px] w-3.5 bg-black my-[1.5px] rounded-1 group-hover:bg-white transform-gpu transition origin-center"
        :class="mobileNavOpen ? 'rotate-[135deg] opacity-0' : 'opacity-100'"
      ></div>
      <div
        aria-hidden="true"
        class="h-[1.5px] w-3.5 bg-black my-[1.5px] rounded-1 group-hover:bg-white transform-gpu rotat transition origin-center"
        :class="mobileNavOpen && 'rotate-[225deg] -translate-y-[4.5px]'"
      ></div>
    </button>
  </div>

  <div
    x-ref="mobileNav"
    class="absolute top-full w-full bg-stone overflow-auto transition-all duration-300 hidden"
    :class="mobileNavOpen ? 'h-[calc(100vh-100%)]' : 'h-0'"
  >
    
    <?php if(!empty($main_nav)): ?>
      <nav aria-label="<?php echo e(wp_get_nav_menu_name('main_navigation')); ?>">
        <ul>
          <?php $__currentLoopData = $main_nav; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <?php if($item['children']->isEmpty() && !$loop->last): ?>
              <li class="container-fluid my-2.5">
                <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['link' => $item,'color' => 'main-nav-mobile'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
              <li
                x-data="{ isButton: false }"
                class="w-full transition-colors my-2.5"
                :class="isOpen(<?php echo e($loop->iteration); ?>) && 'bg-amethyst'"
              >
                <div class="container-fluid">
                  <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['element' => 'button','link' => $item,'color' => 'main-nav-mobile-btn'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-ref' => 'button'.e($loop->iteration).'','@click' => 'toggleMenu('.e($loop->iteration).')','x-bind:aria-expanded' => 'isOpen('.e($loop->iteration).')','x-bind:class' => 'isOpen('.e($loop->iteration).') ?
                        \'h4 text-white pt-7.5 mb-0 focus-visible:!outline-none\' :
                        \'text-md\'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
                </div>
                <?php echo $__env->make('partials.subnav-mobile', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </li>

              
            <?php else: ?>
              
              <li class="mt-7.5 mb-5 container-pl inline-block">
                <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['element' => 'button','icon' => 'search','color' => 'icon-search-mobile'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-ref' => 'button-mobileSearch','@click' => 'toggleMenu(\'mobileSearch\'); $nextTick(()=>$refs.mobileSearch.focus())','aria-label' => ''.__('Search', 'header').'','x-bind:class' => '{
                      \'mt-4 border-white bg-transparent text-white hover:bg-white hover:text-black hover:border-white\': isOpen(
                          \'mobileSearch\'),
                      \'bg-black text-white hover:bg-transparent hover:text-black\': !isOpen(\'mobileSearch\')
                  }']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
              </li>

              
              <li class="mt-7.5 mb-5 inline-block">
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

              
              <div
                class="pb-7.5 bg-amethyst text-white transition-all -mt-24 pt-24"
                x-collapse
                x-show="isOpen('mobileSearch')"
                @focusout="handleFocusOut('button-mobileSearch')"
                @click.outside="clickOutside('mobileSearch')"
              >
                <div class="container-fluid flex items-center justify-center py-7.5">
                  <?php if (isset($component)) { $__componentOriginal273c2b890110ed93d4869fccd597db0137d3980d = $component; } ?>
<?php $component = App\View\Components\SearchForm::resolve(['ref' => 'mobileSearch'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </ul>
      </nav>
    <?php endif; ?>

    
    <?php if(!empty($util_nav)): ?>
      <nav
        class="container-fluid flex flex-col gap-5 border-t border-black py-5"
        aria-label="<?php echo e(wp_get_nav_menu_name('utility_navigation')); ?>"
      >
        <?php if(!empty($util_nav)): ?>
          <div class="text-sm font-semibold">
            <?php echo $util_intro; ?>

          </div>
        <?php endif; ?>
        <ul class="flex gap-4 flex-wrap">
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
  </div>

</div>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/partials/nav-mobile.blade.php ENDPATH**/ ?>