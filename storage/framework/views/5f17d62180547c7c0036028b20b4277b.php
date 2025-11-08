<section class="bottom-navbar d-block d-md-none bg-white shadow-lg">
    
    <div class="bottom-navbar-menu row justify-content-center">
        <?php if (isset($component)) { $__componentOriginal25c194a14642fa0ec21de5843b8ea049 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal25c194a14642fa0ec21de5843b8ea049 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navbar-link','data' => ['href' => ''.e(route('dashboard')).'','active' => request()->routeIs('dashboard')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('navbar-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('dashboard')).'','active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('dashboard'))]); ?>
            <i class="ti ti-layout-dashboard fs-5"></i>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal25c194a14642fa0ec21de5843b8ea049)): ?>
<?php $attributes = $__attributesOriginal25c194a14642fa0ec21de5843b8ea049; ?>
<?php unset($__attributesOriginal25c194a14642fa0ec21de5843b8ea049); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal25c194a14642fa0ec21de5843b8ea049)): ?>
<?php $component = $__componentOriginal25c194a14642fa0ec21de5843b8ea049; ?>
<?php unset($__componentOriginal25c194a14642fa0ec21de5843b8ea049); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal25c194a14642fa0ec21de5843b8ea049 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal25c194a14642fa0ec21de5843b8ea049 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navbar-link','data' => ['href' => ''.e(route('members.index')).'','active' => request()->routeIs('members.*')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('navbar-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('members.index')).'','active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('members.*'))]); ?>
            <i class="ti ti-users fs-5"></i>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal25c194a14642fa0ec21de5843b8ea049)): ?>
<?php $attributes = $__attributesOriginal25c194a14642fa0ec21de5843b8ea049; ?>
<?php unset($__attributesOriginal25c194a14642fa0ec21de5843b8ea049); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal25c194a14642fa0ec21de5843b8ea049)): ?>
<?php $component = $__componentOriginal25c194a14642fa0ec21de5843b8ea049; ?>
<?php unset($__componentOriginal25c194a14642fa0ec21de5843b8ea049); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal25c194a14642fa0ec21de5843b8ea049 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal25c194a14642fa0ec21de5843b8ea049 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navbar-link','data' => ['href' => ''.e(route('categories.index')).'','active' => request()->routeIs('categories.*')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('navbar-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('categories.index')).'','active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('categories.*'))]); ?>
            <i class="ti ti-list-details fs-5"></i>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal25c194a14642fa0ec21de5843b8ea049)): ?>
<?php $attributes = $__attributesOriginal25c194a14642fa0ec21de5843b8ea049; ?>
<?php unset($__attributesOriginal25c194a14642fa0ec21de5843b8ea049); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal25c194a14642fa0ec21de5843b8ea049)): ?>
<?php $component = $__componentOriginal25c194a14642fa0ec21de5843b8ea049; ?>
<?php unset($__componentOriginal25c194a14642fa0ec21de5843b8ea049); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal25c194a14642fa0ec21de5843b8ea049 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal25c194a14642fa0ec21de5843b8ea049 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navbar-link','data' => ['href' => ''.e(route('report.index')).'','active' => request()->routeIs('report.*')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('navbar-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('report.index')).'','active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('report.*'))]); ?>
            <i class="ti ti-file-text fs-5"></i>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal25c194a14642fa0ec21de5843b8ea049)): ?>
<?php $attributes = $__attributesOriginal25c194a14642fa0ec21de5843b8ea049; ?>
<?php unset($__attributesOriginal25c194a14642fa0ec21de5843b8ea049); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal25c194a14642fa0ec21de5843b8ea049)): ?>
<?php $component = $__componentOriginal25c194a14642fa0ec21de5843b8ea049; ?>
<?php unset($__componentOriginal25c194a14642fa0ec21de5843b8ea049); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal25c194a14642fa0ec21de5843b8ea049 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal25c194a14642fa0ec21de5843b8ea049 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.navbar-link','data' => ['href' => ''.e(route('about')).'','active' => request()->routeIs('about')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('navbar-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => ''.e(route('about')).'','active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('about'))]); ?>
            <i class="ti ti-file-info fs-5"></i>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal25c194a14642fa0ec21de5843b8ea049)): ?>
<?php $attributes = $__attributesOriginal25c194a14642fa0ec21de5843b8ea049; ?>
<?php unset($__attributesOriginal25c194a14642fa0ec21de5843b8ea049); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal25c194a14642fa0ec21de5843b8ea049)): ?>
<?php $component = $__componentOriginal25c194a14642fa0ec21de5843b8ea049; ?>
<?php unset($__componentOriginal25c194a14642fa0ec21de5843b8ea049); ?>
<?php endif; ?>
    </div>
</section><?php /**PATH C:\3.BUWONO\Dokumen\kuliah\SEMESTER 7\KKN\proker\aplikasi-pengelolaan-data-member\aplikasi-pengelolaan-data-member\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>