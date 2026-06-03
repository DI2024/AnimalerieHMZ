<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-primary/5 via-surface to-secondary/5 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full">
        <!-- Logo & Title -->
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <img src="<?php echo e(asset('images/logo animalerie.png')); ?>" alt="Animalerie HMZ" class="h-16">
            </div>
            <h2 class="text-3xl font-extrabold font-headline text-on-surface">
                Connexion
            </h2>
            <p class="mt-2 text-sm text-on-surface-variant">
                Accédez à votre compte Animalerie HMZ
            </p>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 border border-gray-100">
            <!-- Session Status -->
            <?php if(session('status')): ?>
                <div class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200">
                    <p class="text-sm text-green-600"><?php echo e(session('status')); ?></p>
                </div>
            <?php endif; ?>

            <?php if(session('success')): ?>
                <div class="mb-4 p-4 rounded-xl bg-green-50 border border-green-200">
                    <p class="text-sm text-green-600"><?php echo e(session('success')); ?></p>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="mb-4 p-4 rounded-xl bg-red-50 border border-red-200">
                    <p class="text-sm text-red-600"><?php echo e(session('error')); ?></p>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-6">
                <?php echo csrf_field(); ?>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-bold text-on-surface mb-2">
                        Email
                    </label>
                    <input id="email" 
                           type="email" 
                           name="email" 
                           value="<?php echo e(old('email')); ?>" 
                           required 
                           autofocus 
                           autocomplete="username"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-surface text-on-surface focus:ring-2 focus:ring-primary focus:border-transparent transition">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-bold text-on-surface mb-2">
                        Mot de passe
                    </label>
                    <input id="password" 
                           type="password" 
                           name="password" 
                           required 
                           autocomplete="current-password"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-surface text-on-surface focus:ring-2 focus:ring-primary focus:border-transparent transition">
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center">
                        <input id="remember_me" 
                               type="checkbox" 
                               name="remember"
                               class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary">
                        <span class="ml-2 text-sm text-on-surface-variant">Se souvenir de moi</span>
                    </label>

                    <?php if(Route::has('password.request')): ?>
                        <a href="<?php echo e(route('password.request')); ?>" class="text-sm font-medium text-primary hover:text-primary-container transition">
                            Mot de passe oublié?
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full bg-primary hover:bg-primary-container text-white font-bold py-4 px-6 rounded-xl transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 active:translate-y-0 flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">login</span>
                    Se connecter
                </button>
            </form>

            <!-- Register Link -->
            <div class="mt-6 text-center">
                <p class="text-sm text-on-surface-variant">
                    Pas encore de compte?
                    <a href="<?php echo e(route('register')); ?>" class="font-bold text-primary hover:text-primary-container transition">
                        Créer un compte
                    </a>
                </p>
            </div>

            <!-- Back to Home -->
            <div class="mt-4 text-center">
                <a href="<?php echo e(route('home')); ?>" class="text-sm text-on-surface-variant hover:text-primary transition flex items-center justify-center gap-1">
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                    Retour à l'accueil
                </a>
            </div>
        </div>


    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Desktop\animx\AnimalerieHMZ\resources\views/auth/login.blade.php ENDPATH**/ ?>