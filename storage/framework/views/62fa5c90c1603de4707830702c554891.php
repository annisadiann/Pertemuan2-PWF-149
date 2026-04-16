<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    
                    <div class="flex items-center gap-3 mb-6">
                        <a href="<?php echo e(route('product.index')); ?>"
                            class="p-1.5 rounded-md text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 tracking-tight">Product Detail</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Viewing product #<?php echo e($product->id); ?></p>
                        </div>
                    </div>

                    
                    <div class="rounded-lg border border-gray-200 dark:border-gray-700 divide-y divide-gray-100 dark:divide-gray-700">
                        <div class="flex items-center px-5 py-4">
                            <div class="w-32 shrink-0 text-sm text-gray-500 dark:text-gray-400">Product Name</div>
                            <div class="text-sm font-semibold text-gray-800 dark:text-gray-100"><?php echo e($product->name); ?></div>
                        </div>
                        <div class="flex items-center px-5 py-4">
                            <div class="w-32 shrink-0 text-sm text-gray-500 dark:text-gray-400">Quantity</div>
                            <div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    <?php echo e($product->quantity > 10 ? 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300' : 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-300'); ?>">
                                    <?php echo e($product->quantity); ?>

                                </span>
                                <?php echo e($product->quantity > 10 ? 'In Stock' : 'Low Stock'); ?>

                            </div>
                        </div>
                        <div class="flex items-center px-5 py-4">
                            <div class="w-32 shrink-0 text-sm text-gray-500 dark:text-gray-400">Price</div>
                            <div class="text-sm font-mono font-semibold text-gray-800 dark:text-gray-100">
                                Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?>

                            </div>
                        </div>
                        <div class="flex items-center px-5 py-4">
                            <div class="w-32 shrink-0 text-sm text-gray-500 dark:text-gray-400">Owner</div>
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-indigo-100 dark:bg-indigo-900/50 flex items-center justify-center text-indigo-600 dark:text-indigo-300 text-xs font-bold uppercase">
                                    <?php echo e(substr($product->user->name ?? '?', 0, 1)); ?>

                                </div>
                                <span class="text-sm text-gray-800 dark:text-gray-100"><?php echo e($product->user->name ?? '-'); ?></span>
                            </div>
                        </div>
                        <div class="flex items-center px-5 py-4">
                            <div class="w-32 shrink-0 text-sm text-gray-500 dark:text-gray-400">Created At</div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">
                                <?php echo e($product->created_at->format('d M Y, H:i')); ?>

                            </div>
                        </div>
                        <div class="flex items-center px-5 py-4">
                            <div class="w-32 shrink-0 text-sm text-gray-500 dark:text-gray-400">Updated At</div>
                            <div class="text-sm text-gray-600 dark:text-gray-300">
                                <?php echo e($product->updated_at->format('d M Y, H:i')); ?>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\laragon\www\Pertemuan2\resources\views/product/view.blade.php ENDPATH**/ ?>