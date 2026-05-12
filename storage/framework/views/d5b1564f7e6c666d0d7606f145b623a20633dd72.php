<header class="<?php echo e($block->classes); ?> <?php echo e($colors->classes('wrapper')); ?> py-4 lg:py-6">

  <div class="container-fluid py-24 flex flex-col gap-12">

    <div class="self-center max-w-2xl text-center">

      <?php if(!empty($headline)): ?>
        <<?php echo e($heading_primary); ?> class="mb-6" animate-text>
          <?php echo $headline; ?>

        </<?php echo e($heading_primary); ?>>
      <?php endif; ?>

      <?php if(!empty($paragraph)): ?>
        <p animate-text>
          <?php echo $paragraph; ?>

        </p>
      <?php endif; ?>

    </div>

    <?php if(!empty($cards)): ?>
      <ul class="grid grid-cols-1 gap-10 list-none <?php echo e($card_classes); ?>">
        <?php $__currentLoopData = $cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li class="">
            <?php if (isset($component)) { $__componentOriginal5f1c24da064cdf37917762bf37a30d0804319ee8 = $component; } ?>
<?php $component = App\View\Components\Card::resolve(['card' => $card,'headingTag' => $heading_secondary,'isLink' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Card::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5f1c24da064cdf37917762bf37a30d0804319ee8)): ?>
<?php $component = $__componentOriginal5f1c24da064cdf37917762bf37a30d0804319ee8; ?>
<?php unset($__componentOriginal5f1c24da064cdf37917762bf37a30d0804319ee8); ?>
<?php endif; ?>
          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    <?php endif; ?>

    <?php if(!empty($link)): ?>
      <div animate>
        <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['link' => $link,'color' => $colors->classes('button')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mx-auto']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
      </div>
    <?php endif; ?>

  </div>

</header>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/blocks/row-of-cards.blade.php ENDPATH**/ ?>