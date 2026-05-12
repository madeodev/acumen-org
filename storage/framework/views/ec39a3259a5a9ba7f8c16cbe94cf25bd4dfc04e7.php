<article <?php echo e($attributes->merge([
    'class' => $colors->classes('wrapper'),
])); ?>>

  <?php if(!empty($card['featured_image'])): ?>
    <<?php echo e($element); ?>

      <?php echo e($link_attrs); ?>

      class="block link-no-underline overflow-hidden <?php echo e($colors->classes('image-wrapper')); ?>"
      aria-hidden="true"
      tabindex="-1"
    >
      <?php if (isset($component)) { $__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd = $component; } ?>
<?php $component = App\View\Components\Image::resolve(['id' => $card['featured_image'],'sizes' => $colors->classes('sizes'),'class' => $colors->classes('image')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
    </<?php echo e($element); ?>>
  <?php endif; ?>

  <div class="<?php echo e($colors->classes('text-area')); ?>" >

    <div class="inline-flex gap-5" animate >
      <?php if(!empty($card['topic']) || !empty($card['term'])): ?>
        <?php if (isset($component)) { $__componentOriginal67775c62b8aa18f998083b546d1498ce205e2130 = $component; } ?>
<?php $component = App\View\Components\TopicLabel::resolve(['term' => $card['term'] ?? [],'label' => $card['topic'] ?? '','icon' => $card['topic_icon'] ?? ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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

      <?php if(!empty($secondaryTopic)): ?>
        <?php if (isset($component)) { $__componentOriginal67775c62b8aa18f998083b546d1498ce205e2130 = $component; } ?>
<?php $component = App\View\Components\TopicLabel::resolve(['term' => $secondaryTopic ?? []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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

    <?php if(!empty($card['title'])): ?>
      <<?php echo e($headingTag); ?> class="<?php echo e($colors->classes('title')); ?>" animate-text >
        <a <?php echo e($link_attrs); ?>><?php echo $card['title']; ?></a>
      </<?php echo e($headingTag); ?>>
    <?php endif; ?>

    <?php if(!empty($card['excerpt']) && $showExcerpt): ?>
      <p class="<?php echo e($colors->classes('excerpt')); ?>" animate-text >
        <?php echo $card['excerpt']; ?>

      </p>
    <?php endif; ?>

    <?php if(!empty($card['button'])): ?>
      <div animate >
        <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['link' => $card['button'],'color' => $colors->classes('button'),'icon' => $colors->classes('button_icon')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['aria-hidden' => 'true','tabindex' => '-1']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
      </div>
    <?php endif; ?>
  </div>
</article>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/components/card.blade.php ENDPATH**/ ?>