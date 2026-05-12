<?php $__env->startSection('content'); ?>

  <div class="bg-amethyst text-white py-7.5 sm:py-15 xl:py-30">
    <div class="container-fluid flex flex-col gap-7.5 w-full">
      
      <nav class="mx-auto max-w-full">
        <?php if (isset($component)) { $__componentOriginal273c2b890110ed93d4869fccd597db0137d3980d = $component; } ?>
<?php $component = App\View\Components\SearchForm::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
      </nav>

      <div class="py-7.5 max-w-4xl mx-auto w-full">

        <?php if(!empty($title)): ?>
          <h1 class="h4 leading-tight">
            <?php echo $title; ?>

          </h1>
        <?php endif; ?>

        <?php if(!empty($info)): ?>
          <p>
            <?php echo $info; ?>

          </p>
        <?php endif; ?>

        <?php if(!empty($results)): ?>
          <ul class="flex flex-col gap-5">
            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li role="article">
                <a href="<?php echo e($result['link']); ?>" class="border-b py-7.5 group flex justify-between">
                  <div>
                    
                    <header>

                      <?php if(!empty($result['title'])): ?>
                        <h2 class="h3 mb-2.5">
                          <?php echo $result['title']; ?>

                        </h2>
                      <?php endif; ?>

                    </header>

                    <?php if(!empty($result['excerpt'])): ?>
                      <p class="mb-2.5">
                        <?php echo $result['excerpt']; ?>

                      </p>
                    <?php endif; ?>
                    

                    <?php if(!empty($result['post_type_pretty'])): ?>
                      <p class="h5">
                        <?php echo $result['post_type_pretty']; ?>

                      </p>
                    <?php endif; ?>

                  </div>
                  <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['element' => 'span','type' => 'icon','icon' => 'arrow-right','color' => 'icon-white'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
                </a>
              </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        <?php endif; ?>

        <?php if (isset($component)) { $__componentOriginal41fa1a726c2cdc888fd1699c1c531da853ade966 = $component; } ?>
<?php $component = App\View\Components\Pagination::resolve(['queryModel' => $query] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('pagination'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Pagination::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal41fa1a726c2cdc888fd1699c1c531da853ade966)): ?>
<?php $component = $__componentOriginal41fa1a726c2cdc888fd1699c1c531da853ade966; ?>
<?php unset($__componentOriginal41fa1a726c2cdc888fd1699c1c531da853ade966); ?>
<?php endif; ?>
      </div>


    </div>
  </div>
  
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/search.blade.php ENDPATH**/ ?>