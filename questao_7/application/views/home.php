<h1>Enquetes Ativas:</h1>

<?php if($active_quizzes): ?>

    <?php foreach($active_quizzes as $quiz): ?>
        <div class="jumbotron">

        <div class="col-sm-8 mx-auto">

            <h1 class="mb-3 text-center"><?=$quiz['question']?></h1>

            <p><?=$quiz['description']?></p>

            <a class="btn btn-primary btn-lg btn-block" style="white-space: normal" href="<?=base_url('registrar-resposta/'.$quiz['id'].'/1')?>" ><?=$quiz['txt_answer_1']?></a>

            <a class="btn btn-primary btn-lg btn-block" style="white-space: normal" href="<?=base_url('registrar-resposta/'.$quiz['id'].'/2')?>" ><?=$quiz['txt_answer_2']?></a>

            <a class="btn btn-primary btn-lg btn-block" style="white-space: normal" href="<?=base_url('registrar-resposta/'.$quiz['id'].'/3')?>" ><?=$quiz['txt_answer_3']?></a>

            <a class="btn btn-primary btn-lg btn-block" style="white-space: normal" href="<?=base_url('registrar-resposta/'.$quiz['id'].'/4')?>" ><?=$quiz['txt_answer_4']?></a>

            <a class="btn btn-primary btn-lg btn-block" style="white-space: normal" href="<?=base_url('registrar-resposta/'.$quiz['id'].'/5')?>" ><?=$quiz['txt_answer_5']?></a>

        </div>


    </div>

    <?php endforeach; ?>

<?php endif; ?>
