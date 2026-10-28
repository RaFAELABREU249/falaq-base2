<?php $__env->startSection('title', $evento->titulo . ' — FalaQ'); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <!-- Formularço de envio de Pergunta -->
    <div class="col-md-5 mb-4">
        <div class="card shadow-sm p-3">
            <h4 class="fw-bold mb-3">💬 Faça sua Pergunta</h4>
            <form action="<?php echo e(route('eventos.perguntas.store', $evento->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="evento_id" value="<?php echo e($evento->id); ?>">
                <div class="mb-3">
                    <label for="texto" class="form-label text-secondary">Texto da Pergunta</label>

                    <textarea name="texto" id="texto" rows="4" 
                              class="form-control bg-dark text-white border-secondary <?php $__errorArgs = ['texto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                              placeholder="Digite sua dúvida ou comentário para o palestrante..."></textarea>

                    <?php $__errorArgs = ['texto'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback fw-bold">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <button type="submit" class="btn btn-primary w-100 fw-bold">Enviar Pergunta</button>
            </form>
        </div>
    </div>

    <!-- Lista de Perguntas (TICKET #002) -->
    <div class="col-md-7">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold m-0">📋 Perguntas do Evento</h4>
            <span class="text-secondary small">Total no Banco: <?php echo e($perguntas->total()); ?></span>
        </div>

        <?php $__empty_1 = true; $__currentLoopData = $perguntas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pergunta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $usuarioJaVotou = auth()->check() && $pergunta->votos->contains(fn ($usuario) => $usuario->id === auth()->id());
            ?>
            <div class="card mb-3 shadow-sm border-start border-4 border-primary">
                <div class="card-body">
                    <p class="fs-5 mb-2 text-white"><?php echo e($pergunta->texto); ?></p>
                    <p class="mb-2 text-secondary"><?php echo e($pergunta->user->name ?? 'Anônimo'); ?></p>
                    <div class="d-flex justify-content-between align-items-center text-secondary small">
                        <span>Status: <span class="badge bg-success"><?php echo e($pergunta->status); ?></span></span>
                        <span><?php echo e($pergunta->created_at->format('d/m/Y H:i')); ?></span>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <form action="<?php echo e(route('perguntas.votar', $pergunta)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-sm <?php echo e($usuarioJaVotou ? 'btn-warning text-dark fw-bold' : 'btn-outline-warning'); ?>">
                                <?php echo e($usuarioJaVotou ? '✅ Votado (remover)' : '👍 Upvote'); ?>

                                <span class="badge <?php echo e($usuarioJaVotou ? 'bg-dark text-warning' : 'bg-warning text-dark'); ?> ms-1"><?php echo e($pergunta->votos_count); ?></span>
                            </button>
                        </form>
                        <span class="text-secondary small">Votos: <?php echo e($pergunta->votos_count); ?></span>
                    </div>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $pergunta)): ?>
                        <form action="<?php echo e(route('eventos.perguntas.destroy', $pergunta)); ?>" method="POST" class="mt-3">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <?php if (isset($component)) { $__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.danger-button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('danger-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Excluir Pergunta <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11)): ?>
<?php $attributes = $__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11; ?>
<?php unset($__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11)): ?>
<?php $component = $__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11; ?>
<?php unset($__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11); ?>
<?php endif; ?>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="alert alert-dark text-center p-4">
                Nenhuma pergunta enviada ainda. Seja o primeiro!
            </div>
        <?php endif; ?>

        <!-- TICKET #002: Renderização dos Botões de Paginação -->
        <?php if(method_exists($perguntas, 'links')): ?>
            <div class="d-flex justify-content-center mt-4">
                <?php echo e($perguntas->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\rafae\OneDrive\Área de Trabalho\falaq-base-main\resources\views/eventos/show.blade.php ENDPATH**/ ?>