<h2 class="mb-4">
    Enquete: <?=$quiz['question']?>
</h2>

<?php if( !empty($msg) ): ?>

    <div class="alert alert-<?=$msg['type']?> alert-dismissible fade show" role="alert">
        <strong>Atenção!</strong><br>
        <?=$msg['content']?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

<?php endif; ?>


<div class="card">
    <div class="card-body">
        <h5 class="card-title">Criador: <?=$quiz['creator']?></h5>

        <?php if( $quiz['status']=='1' ): ?>
            <p class="card-text">Status: Ativo
            <?php if( !empty($_SESSION["client"]) ): ?>
                <a class="btn btn-warning btn-sm" href="<?=base_url('desativar-enquete/'.$quiz['id'])?>">desativar</a>
            <?php endif; ?>
            </p>
        <?php else: ?>
            <p class="card-text">Status: Não Ativo
            <?php if( !empty($_SESSION["client"]) ): ?>
                <a class="btn btn-success btn-sm" href="<?=base_url('ativar-enquete/'.$quiz['id'])?>">ativar</a>
            <?php endif; ?>
            </p>
        <?php endif; ?>


        <p class="card-text"><?=$quiz['description']?></p>

        <h4 class="text-center mt-3">Resultado:</h4>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item" style="font-weight: 700;font-size: 24px">
            <span class="float-left"><?=$quiz['txt_answer_1']?></span><span class="float-right"><?=$quiz['vlr_answer_1']?>
        </li>
        <li class="list-group-item" style="font-weight: 700;font-size: 24px">
            <span class="float-left"><?=$quiz['txt_answer_2']?></span><span class="float-right"><?=$quiz['vlr_answer_2']?>
        </li>
        <li class="list-group-item" style="font-weight: 700;font-size: 24px">
            <span class="float-left"><?=$quiz['txt_answer_3']?></span><span class="float-right"><?=$quiz['vlr_answer_3']?>
        </li>
        <li class="list-group-item" style="font-weight: 700;font-size: 24px">
            <span class="float-left"><?=$quiz['txt_answer_4']?></span><span class="float-right"><?=$quiz['vlr_answer_4']?>
        </li>
        <li class="list-group-item" style="font-weight: 700;font-size: 24px">
            <span class="float-left"><?=$quiz['txt_answer_5']?></span><span class="float-right"><?=$quiz['vlr_answer_5']?>
        </li>
    </ul>
</div>

