<h2 class="mb-5">
      Todos as Enquetes
</h2>

<?php if( !empty($_SESSION["client"]) ): ?>
    <a href="<?=base_url('cadastrar-enquete')?>" class="btn btn-lg btn-outline-success mb-4">Cadastrar Enquetes</a>
<?php endif; ?>


<?php if( $quizzes ): ?>
    <?php foreach($quizzes as $quiz): ?>

        <div class="text-white mb-4 card bg-<?=($quiz['status']=='1'?'success':'secondary')?>">
            <div class="card-body">
                <h2 class="card-title"><?=$quiz['question']?> - <small>
                        <?php if( $quiz['status']=='1' ): ?>
                             Ativo
                                <?php if( !empty($_SESSION["client"]) ): ?>
                                    <a class="btn btn-warning btn-sm" href="<?=base_url('desativar-enquete/'.$quiz['id'])?>">desativar</a>
                                <?php endif; ?>

                        <?php else: ?>
                           Não Ativo
                                <?php if( !empty($_SESSION["client"]) ): ?>
                                    <a class="btn btn-success btn-sm" href="<?=base_url('ativar-enquete/'.$quiz['id'])?>">ativar</a>
                                <?php endif; ?>

                        <?php endif; ?>

                    </small></h2>
                <p class="card-text"><?=$quiz['description']?></p>
                <a href="<?=base_url('ver-enquete/'.$quiz['id'])?>" class="btn btn-primary">Ver Detalhes</a>
            </div>
        </div>
        <?php endforeach; ?>
<?php endif; ?>
