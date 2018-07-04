
<h2 class="mb-5">
    <?php if( empty($_SESSION["client"]) ): ?>
        Cadastre-se
    <?php else: ?>
        Editar Dados
    <?php endif; ?>

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


<form method="post" action="<?=base_url('salvar-cadastro')?>">


    <div class="form-group">
        <label for="name">Nome</label>
        <input required type="text" class="form-control" id="name" name="name" value="<?=(!empty($name)?$name:'')?>" placeholder="Digite o seu nome">
    </div>

    <div class="form-group">
        <label for="email">Endereço de e-mail</label>
        <input required type="email" class="form-control" id="email" name="email" value="<?=(!empty($email)?$email:'')?>" placeholder="Digite o seu e-mail">
    </div>

    <div class="form-group">
        <label for="password">Senha</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>

</form>