<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Teste Quiz">
    <meta name="author" content="Sergisley Matias">
    <link href="<?=base_url('assets/img/favicon.ico')?>" rel="icon" type="image/x-icon" />

    <title>Quiz!</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">

    <link href="<?=base_url('assets/css/main.css')?>" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">

    <a class="navbar-brand" href="<?=base_url()?>">Quiz!</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-toggle" aria-controls="navbar-toggle" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar-toggle">

        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?=base_url()?>">Home <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?=base_url('listar-enquetes')?>">Todas as Enquetes</a>
            </li>

            <?php

            if(!empty( $_SESSION["client"])){
                ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url('cadastrar-enquete')?>">Cadastrar Enquete</a>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sua Conta</a>

                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="<?=base_url('cadastro')?>">Editar dados</a>
                        <a class="dropdown-item" href="<?=base_url('logout')?>">Deslogar</a>
                    </div>
                </li>

                <?php
            }else{
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?=base_url('cadastro')?>">Cadastre-se para adicionar Enquetes<span class="sr-only">cadastrar</span></a>
                </li>
                <?php
            }

            ?>

        </ul>

        <?php if(empty( $_SESSION["client"])){
            ?>
            <form class="form-inline my-2 my-lg-0 ajax_form" action="<?=base_url('login')?>">
                <input class="form-control mr-sm-2" type="email" name="email" placeholder="E-mail" aria-label="E-mail">
                <input class="form-control mr-sm-2" type="password" name="password" placeholder="Senha" aria-label="Senha">
                <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Logar</button>
            </form>
            <?php
        } ?>

    </div>

</nav>


<div class="container main-content">


    <?php

    require_once($view_name . '.php');

    ?>


</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?=base_url('assets/js/jquery-3.3.1.min.js')?>"></script>
<script src="<?=base_url('assets/js/bootstrap.bundle.min.js')?>"></script>
<script src="<?=base_url('assets/js/app.js')?>"></script>

</body>
</html>