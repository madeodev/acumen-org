<header class="flex flex-col">
  <div
    class="flex flex-col container-fluid gap-7.5 py-7.5 w-full <?php echo e($imagePosition === 'above' ? 'order-last' : 'order-first'); ?>"
  >
    <div class="flex gap-10 justify-between items-center">
      <div class="flex flex-col max-w-5xl gap-7.5 md:gap-10 md:py-7.5">

        <?php if(!empty($logo)): ?>
          <?php if (isset($component)) { $__componentOriginalcf1fde6bef2907c23498101ce01c0f3f2594e0bd = $component; } ?>
<?php $component = App\View\Components\Image::resolve(['id' => $logo,'class' => 'w-fit h-15'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
        <?php endif; ?>

        <?php if(!empty($title)): ?>
          <h1 animate-text>
            <?php echo $title; ?>

          </h1>
        <?php endif; ?>

        <?php if(!empty($image) && $imagePosition === 'side'): ?>
          <?php if (isset($component)) { $__componentOriginalc191e765977296a91bc2fe62b9f5625794b24fb7 = $component; } ?>
<?php $component = App\View\Components\ParallaxImage::resolve(['id' => $image,'imageClass' => 'object-cover w-full h-full'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('parallax-image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ParallaxImage::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'overflow-hidden rounded-image aspect-square md:hidden']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc191e765977296a91bc2fe62b9f5625794b24fb7)): ?>
<?php $component = $__componentOriginalc191e765977296a91bc2fe62b9f5625794b24fb7; ?>
<?php unset($__componentOriginalc191e765977296a91bc2fe62b9f5625794b24fb7); ?>
<?php endif; ?>
        <?php endif; ?>

        <?php if(!empty($excerpt)): ?>
          <p
            class="mb-0 h3"
            animate-text
          >
            <?php echo $excerpt; ?>

          </p>
        <?php endif; ?>

        <?php if(!empty($date) || !empty($author)): ?>
          <div
            class="flex flex-wrap mb-0 gap-x-7.5 h5 md:min-h-4"
            animate
          >
            <?php if(!empty($date)): ?>
              <time datetime="<?php echo e($datetime); ?>">
                <?php echo $date; ?>

              </time>
            <?php endif; ?>
            <?php if(!empty($author)): ?>
              <span>
                <?php echo __('By:', 'title') . ' ' . $author; ?>

              </span>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <?php if(!empty($button) && !empty($button['url'])): ?>
          <div animate>
            <?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['link' => $button,'icon' => $buttonIcon,'externalGetsIconNewTab' => true] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
          </div>
        <?php endif; ?>

      </div>

      
      <?php if(!empty($image) && $imagePosition === 'side'): ?>
        <?php if (isset($component)) { $__componentOriginalc191e765977296a91bc2fe62b9f5625794b24fb7 = $component; } ?>
<?php $component = App\View\Components\ParallaxImage::resolve(['id' => $image,'imageClass' => 'object-cover w-full h-full','sizes' => ['md' => '4/10 * 1.25', '2xl' => 'calc(37.5rem) * 1.25']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('parallax-image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ParallaxImage::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'flex-shrink-0 overflow-hidden rounded-image xl:rounded-image-xl aspect-square w-150 max-w-[40%] 2xl:max-w-none hidden md:block my-7.5 self-start']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc191e765977296a91bc2fe62b9f5625794b24fb7)): ?>
<?php $component = $__componentOriginalc191e765977296a91bc2fe62b9f5625794b24fb7; ?>
<?php unset($__componentOriginalc191e765977296a91bc2fe62b9f5625794b24fb7); ?>
<?php endif; ?>
      <?php endif; ?>

    </div>

    <?php if(!empty($taxonomies)): ?>
      <ul class="flex flex-wrap gap-5 items-center border-t border-black pt-7.5">
        <?php $__currentLoopData = $taxonomies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li
            class="flex items-center h-7"
            animate
          >
            <?php if (isset($component)) { $__componentOriginal67775c62b8aa18f998083b546d1498ce205e2130 = $component; } ?>
<?php $component = App\View\Components\TopicLabel::resolve(['term' => $term] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
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
          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </ul>
    <?php endif; ?>
  </div>

  <?php if(!empty($image) && (empty($imagePosition) || $imagePosition !== 'side')): ?>
    <div class="<?php echo e($imagePosition === 'above' ? 'order-first mb-8' : 'order-last mt-8'); ?>">
      <figure class="overflow-hidden relative max-h-171.25">
        <div class="aspect-video">
          <?php if (isset($component)) { $__componentOriginalc191e765977296a91bc2fe62b9f5625794b24fb7 = $component; } ?>
<?php $component = App\View\Components\ParallaxImage::resolve(['id' => $image,'imageClass' => 'object-cover w-full h-full'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('parallax-image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\ParallaxImage::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc191e765977296a91bc2fe62b9f5625794b24fb7)): ?>
<?php $component = $__componentOriginalc191e765977296a91bc2fe62b9f5625794b24fb7; ?>
<?php unset($__componentOriginalc191e765977296a91bc2fe62b9f5625794b24fb7); ?>
<?php endif; ?>

          <?php if(!empty($video)): ?>
            <?php if(!empty($video['webm']) || !empty($video['mp4'])): ?>
              <?php if (isset($component)) { $__componentOriginal64869fac42a4bc3c05f21f81703896b0b8d37ccc = $component; } ?>
<?php $component = App\View\Components\LocalVideoLoop::resolve(['preload' => true,'placeholder' => $image ?? null,'webm' => $video['webm'] ?? '','mp4' => $video['mp4'] ?? ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('local-video-loop'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\LocalVideoLoop::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal64869fac42a4bc3c05f21f81703896b0b8d37ccc)): ?>
<?php $component = $__componentOriginal64869fac42a4bc3c05f21f81703896b0b8d37ccc; ?>
<?php unset($__componentOriginal64869fac42a4bc3c05f21f81703896b0b8d37ccc); ?>
<?php endif; ?>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      </figure>

      <?php if(!empty($imageCaption)): ?>
        <figcaption class="mt-6 mb-0 font-serif text-sm container-fluid">
          <div class="lg:w-1/2">
            <?php echo $imageCaption; ?>

          </div>
        </figcaption>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</header>
<?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/components/title.blade.php ENDPATH**/ ?>