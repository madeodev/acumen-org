<!doctype html>
<html
  <?php language_attributes(); ?>
  class="bg-stone overflow-x-hidden min-w-[375px]"
>

<head>
  <meta charset="utf-8">
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1"
  >
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <?php do_action('get_header'); ?>

  <div id="app">
    <a
      class="sr-only focus-visible:not-sr-only"
      href="#main"
    >
      <?php echo e(__('Skip to content')); ?>

    </a>

    <?php echo $__env->make('sections.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div
      id="overlay"
      aria-hidden="true"
      class="hidden bg-black/5 absolute inset-0 z-40"
    ></div>

    <main
      id="main"
      class="main"
    >
      <?php if (isset($component)) { $__componentOriginal3461a3c93fcf9d4edfa9976614366f3e37ccb95b = $component; } ?>
<?php $component = App\View\Components\TranslationBar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('translation-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\TranslationBar::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3461a3c93fcf9d4edfa9976614366f3e37ccb95b)): ?>
<?php $component = $__componentOriginal3461a3c93fcf9d4edfa9976614366f3e37ccb95b; ?>
<?php unset($__componentOriginal3461a3c93fcf9d4edfa9976614366f3e37ccb95b); ?>
<?php endif; ?>
      <?php echo $__env->yieldContent('content'); ?>
    </main>

    <?php if (isset($component)) { $__componentOriginal88b1957f21f7f49b400717e8d0a27189798132bf = $component; } ?>
<?php $component = App\View\Components\Footer::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Footer::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal88b1957f21f7f49b400717e8d0a27189798132bf)): ?>
<?php $component = $__componentOriginal88b1957f21f7f49b400717e8d0a27189798132bf; ?>
<?php unset($__componentOriginal88b1957f21f7f49b400717e8d0a27189798132bf); ?>
<?php endif; ?>

  </div>

  <?php do_action('get_footer'); ?>
  <?php wp_footer(); ?>
</body>

</html>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/layouts/app.blade.php ENDPATH**/ ?>