<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-[1280px] mx-auto px-6">
        
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                    Paramètres du compte
                </h1>
                <p class="text-gray-600">
                    Gérez vos informations personnelles et votre sécurité
                </p>
            </div>
            <a href="<?php echo e(route('dashboard')); ?>" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-lg transition flex items-center gap-2">
                <span class="material-symbols-outlined">arrow_back</span>
                Retour
            </a>
        </div>

        <div class="space-y-6">
            <!-- Profile Information -->
            <div class="bg-white rounded-xl p-6 md:p-8 border border-gray-200 shadow-sm">
                <div class="max-w-2xl">
                    <?php echo $__env->make('profile.partials.update-profile-information-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>

            <!-- Update Password -->
            <div class="bg-white rounded-xl p-6 md:p-8 border border-gray-200 shadow-sm">
                <div class="max-w-2xl">
                    <?php echo $__env->make('profile.partials.update-password-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>

            <!-- Delete Account -->
            <div class="bg-white rounded-xl p-6 md:p-8 border border-gray-200 shadow-sm">
                <div class="max-w-2xl">
                    <?php echo $__env->make('profile.partials.delete-user-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/profile/edit.blade.php ENDPATH**/ ?>