<h2 class="mb-5">
    Cadastrar Enquetes
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


<form method="post" action="<?=base_url('salvar-enquete')?>">


    <div class="form-group">
        <label for="question">Questão</label>
        <input required type="text" class="form-control" id="question" name="question" value="<?=!empty($question)?$question:''?>">
    </div>


    <div class="form-group">
        <label for="description">Descrição (opcional)</label>
        <textarea class="form-control" id="description" rows="3" name="description"><?=!empty($description)?$description:''?></textarea>
    </div>

    <div class="form-group">
        <label for="txt_answer_1">Resposta 1</label>
        <input required type="text" class="form-control" id="txt_answer_1" name="txt_answer_1" value="<?=!empty($txt_answer_1)?$txt_answer_1:''?>">
    </div>

    <div class="form-group">
        <label for="txt_answer_2">Resposta 2</label>
        <input required type="text" class="form-control" id="txt_answer_2" name="txt_answer_2" value="<?=!empty($txt_answer_2)?$txt_answer_2:''?>">
    </div>

    <div class="form-group">
        <label for="txt_answer_3">Resposta 3</label>
        <input required type="text" class="form-control" id="txt_answer_3" name="txt_answer_3" value="<?=!empty($txt_answer_3)?$txt_answer_3:''?>">
    </div>

    <div class="form-group">
        <label for="txt_answer_4">Resposta 4</label>
        <input required type="text" class="form-control" id="txt_answer_4" name="txt_answer_4" value="<?=!empty($txt_answer_4)?$txt_answer_4:''?>">
    </div>

    <div class="form-group">
        <label for="txt_answer_5">Resposta 5</label>
        <input required type="text" class="form-control" id="txt_answer_5" name="txt_answer_5" value="<?=!empty($txt_answer_5)?$txt_answer_5:''?>">
    </div>

    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="status" value="1" <?=!empty($status)?($status=='1'?'checked':''):''?>>
        <label class="form-check-label" for="exampleCheck1">Ativa</label>
    </div>
    
    <button type="submit" class="btn btn-primary">Salvar</button>

</form>
