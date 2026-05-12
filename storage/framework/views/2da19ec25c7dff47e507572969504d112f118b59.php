<article <?php (post_class('h-entry')); ?>>

  <?php if (isset($component)) { $__componentOriginala29f3cd3824cd6d65c69e82155e7161d99dccbbb = $component; } ?>
<?php $component = App\View\Components\Title::resolve(['title' => $title ?? '','logo' => $secondary_logo ?? '','image' => $featured_image ?? '','imagePosition' => $featured_image_position ?? 'side','imageCaption' => $featured_caption ?? '','video' => $featured_video ?? [],'excerpt' => $excerpt ?? '','button' => $title_button ?? [],'datetime' => $datetime ?? '','date' => $date ?? '','author' => $authors['list'] ?? '','taxonomies' => $topics ?? [],'postType' => $post_type ?? ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Title::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala29f3cd3824cd6d65c69e82155e7161d99dccbbb)): ?>
<?php $component = $__componentOriginala29f3cd3824cd6d65c69e82155e7161d99dccbbb; ?>
<?php unset($__componentOriginala29f3cd3824cd6d65c69e82155e7161d99dccbbb); ?>
<?php endif; ?>

  <?php if(!empty($stats['stats'])): ?>
    <?php if (isset($component)) { $__componentOriginal8365f75f4f90ed1df159db6f78dcfa5518b6b568 = $component; } ?>
<?php $component = App\View\Components\Stats::resolve(['innerClasses' => 'container-fluid py-15 md:py-20','title' => $stats['title'],'stats' => $stats['stats'],'color' => $stats['color'] ?? ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('stats'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Stats::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8365f75f4f90ed1df159db6f78dcfa5518b6b568)): ?>
<?php $component = $__componentOriginal8365f75f4f90ed1df159db6f78dcfa5518b6b568; ?>
<?php unset($__componentOriginal8365f75f4f90ed1df159db6f78dcfa5518b6b568); ?>
<?php endif; ?>
  <?php endif; ?>

  <div class="pt-10 mb-10 gutenberg lg:pt-20 xl:pt-30 lg:mb-20 xl:mb-30">
    <?php (the_content()); ?>

    <?php if(!empty($authors['array'])): ?>
      <aside class="flex flex-col gap-10 mt-10 text-container mb-7.5 pb-7.5">
        <?php if(!empty($authors['title'])): ?>
          <h2 class="h4"><?php echo $authors['title']; ?></h2>
        <?php endif; ?>

        <?php $__currentLoopData = $authors['array']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if (isset($component)) { $__componentOriginalbd02931f893ce71609580af7242b280de69dca29 = $component; } ?>
<?php $component = App\View\Components\AuthorCard::resolve(['data' => $item] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('author-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AuthorCard::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbd02931f893ce71609580af7242b280de69dca29)): ?>
<?php $component = $__componentOriginalbd02931f893ce71609580af7242b280de69dca29; ?>
<?php unset($__componentOriginalbd02931f893ce71609580af7242b280de69dca29); ?>
<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </aside>
    <?php endif; ?>
  </div>
</article>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/partials/content-single.blade.php ENDPATH**/ ?>