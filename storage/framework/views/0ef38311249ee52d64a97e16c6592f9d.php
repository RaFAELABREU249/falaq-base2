<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'FalaQ-Eu_T_3scuto'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>
        body { background-color: #0f1117; color: #e2e8f0; font-family: system-ui, sans-serif; }
        .card { background-color: #1a1d27; border: 1px solid #2e3347; color: #e2e8f0; }
        .navbar { background-color: #1a1d27; border-bottom: 1px solid #2e3347; }
        .btn-primary { background-color: #7c6af7; border-color: #7c6af7; }
        .btn-primary:hover { background-color: #6352de; border-color: #6352de; }
        .pagination .page-link { background-color: #1a1d27; border-color: #2e3347; color: #7c6af7; }
        .pagination .page-item.active .page-link { background-color: #7c6af7; border-color: #7c6af7; color: #fff; }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?php echo e(route('eventos.index')); ?>">
                🚀 FalaQ-Eu_T_3scuto <span class="badge bg-secondary fs-6">MVP</span>
            </a>
            <?php if(auth()->guard()->check()): ?>
                <span>Olá, <?php echo e(Auth::user()->name); ?></span>
                <form method="post" action="<?php echo e(route('auth.logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="bg-gray-800 text-gray-200 px-4 py-2 rounded-md hover:bg-blue-700">Logout</button>
                </form>
            <?php endif; ?>
            <?php if(auth()->guard()->guest()): ?>          
                <a class="navbar-brand" href="<?php echo e(route('login.create')); ?>">
                    Login
                </a>
                <a class="navbar-brand" href="<?php echo e(route('register.create')); ?>">
                    Registro
                </a>
            <?php endif; ?>

        </div>
    </nav>

    <div class="container pb-5">
        <?php if(session('sucesso') || session('status')): ?>
            <div class="alert alert-success border-0 shadow-sm mb-4">
                <?php echo e(session('sucesso') ?? session('status')); ?>

            </div>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\Users\rafae\OneDrive\Área de Trabalho\falaq-base-main\resources\views/layouts/app.blade.php ENDPATH**/ ?>