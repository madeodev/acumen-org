<form 
    role="search" 
    action="<?php echo e(esc_url( home_url( '/' ) )); ?>"
    method="get"
    class="relative w-125 max-w-full" 
>
<label>
    <span class="sr-only">
        <?php echo __( 'Search for:', 'header' ); ?>

    </span>
    <input 
        x-ref="<?php echo e($ref); ?>" 
        class="bg-transparent text-white placeholder:text-white w-full border border-white py-4 pl-6 pr-16 rounded-full"
        type="search" 
        name="s" 
        value="<?php echo e($search_query); ?>"
        placeholder="<?php echo __('What can we help you find...', 'header'); ?>"
    >
</label>
<?php if (isset($component)) { $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940 = $component; } ?>
<?php $component = App\View\Components\Button::resolve(['element' => 'button','type' => 'submit','icon' => 'search','color' => 'icon-search'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\Button::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['@click' => 'toggleMenu(\'desktop-search\')','aria-label' => ''.__('Search', 'header').'','x-bind:aria-expanded' => 'isOpen(\'desktop-search\')']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940)): ?>
<?php $component = $__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940; ?>
<?php unset($__componentOriginal065ae5da12ba8e75c6b4e84d90798c2fb812b940); ?>
<?php endif; ?>
</form><?php /**PATH /nas/content/live/acumenbw/wp-content/themes/sage/resources/views/components/search-form.blade.php ENDPATH**/ ?>