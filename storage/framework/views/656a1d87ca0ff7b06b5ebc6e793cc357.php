<?php $__env->startSection('content'); ?>
<div class="h-screen bg-gradient-to-br from-primary/5 via-surface to-secondary/5 flex items-center justify-center py-4 px-4 sm:px-6 lg:px-8 overflow-hidden">
    <div class="max-w-md w-full">
        <!-- Logo & Title -->
        <div class="text-center mb-4">
            <div class="flex justify-center mb-2">
                <img src="<?php echo e(asset('images/logo animalerie.png')); ?>" alt="Animalerie HMZ" class="h-12">
            </div>
            <h2 class="text-2xl font-extrabold font-headline text-on-surface">
                Créer un compte
            </h2>
            <p class="mt-1 text-sm text-on-surface-variant">
                Rejoignez la communauté Animalerie HMZ
            </p>
        </div>

        <!-- Register Card -->
        <div class="bg-white rounded-3xl shadow-2xl p-6 border border-gray-100">
            <form method="POST" action="<?php echo e(route('register')); ?>" class="space-y-3">
                <?php echo csrf_field(); ?>

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-bold text-on-surface mb-1">
                        Nom complet
                    </label>
                    <input id="name" 
                           type="text" 
                           name="name" 
                           value="<?php echo e(old('name')); ?>" 
                           required 
                           autofocus 
                           autocomplete="name"
                           class="w-full px-3 py-2 rounded-xl border border-gray-200 bg-surface text-on-surface focus:ring-2 focus:ring-primary focus:border-transparent transition text-sm">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-xs text-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-bold text-on-surface mb-1">
                        Email
                    </label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="<?php echo e(old('email')); ?>" 
                           required 
                           autocomplete="username"
                           class="w-full px-3 py-2 rounded-xl border border-gray-200 bg-surface text-on-surface focus:ring-2 focus:ring-primary focus:border-transparent transition text-sm">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-xs text-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-bold text-on-surface mb-1">
                        Mot de passe
                    </label>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="new-password"
                           class="w-full px-3 py-2 rounded-xl border border-gray-200 bg-surface text-on-surface focus:ring-2 focus:ring-primary focus:border-transparent transition text-sm">
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-xs text-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-bold text-on-surface mb-1">
                        Confirmer le mot de passe
                    </label>
                    <input id="password_confirmation" 
                           type="password" 
                           name="password_confirmation" 
                           required 
                           autocomplete="new-password"
                           class="w-full px-3 py-2 rounded-xl border border-gray-200 bg-surface text-on-surface focus:ring-2 focus:ring-primary focus:border-transparent transition text-sm">
                    <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-xs text-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Terms -->
                <div class="flex items-start">
                    <input id="terms" 
                           type="checkbox" 
                           required
                           class="mt-0.5 rounded border-gray-300 text-primary shadow-sm focus:ring-primary">
                    <label for="terms" class="ml-2 text-xs text-on-surface-variant">
                        J'accepte les <a href="#" class="text-primary hover:underline">conditions d'utilisation</a> et la <a href="#" class="text-primary hover:underline">politique de confidentialité</a>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-primary hover:bg-primary-container text-white font-bold py-3 px-6 rounded-xl transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-lg">person_add</span>
                    Créer mon compte
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-4 text-center">
                <p class="text-xs text-on-surface-variant">
                    Vous avez déjà un compte?
                    <a href="<?php echo e(route('login')); ?>" class="font-bold text-primary hover:text-primary-container transition">
                        Se connecter
                    </a>
                </p>
            </div>

            <!-- Back to Home -->
            <div class="mt-2 text-center">
                <a href="<?php echo e(route('home')); ?>" class="text-xs text-on-surface-variant hover:text-primary transition flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                    Retour à l'accueil
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/auth/register.blade.php ENDPATH**/ ?>