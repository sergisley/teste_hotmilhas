<?php

//controller a ser carregado quando nenhuma rota ser especifica, home do site
$controller_default = 'principal';

//rotas. é necessário especificar o controler, método e número de parâmetros, até 3. métodos sem rota não serão acessíveis
$routes['login']                = array( 'controller'=>'principal', 'method'=>'login',           'parameters'=>0 );
$routes['logout']               = array( 'controller'=>'principal', 'method'=>'logout',          'parameters'=>0 );
$routes['cadastro']             = array( 'controller'=>'principal', 'method'=>'edit_user',       'parameters'=>0 );
$routes['salvar-cadastro']      = array( 'controller'=>'principal', 'method'=>'save_user',       'parameters'=>0 );


$routes['listar-enquetes']      = array( 'controller'=>'principal', 'method'=>'list_quizzes',    'parameters'=>0 );
$routes['cadastrar-enquete']    = array( 'controller'=>'principal', 'method'=>'create_quiz',     'parameters'=>0 );
$routes['salvar-enquete']       = array( 'controller'=>'principal', 'method'=>'save_quiz',       'parameters'=>0 );
$routes['registrar-resposta']   = array( 'controller'=>'principal', 'method'=>'register_answer', 'parameters'=>2 );
$routes['ver-enquete']          = array( 'controller'=>'principal', 'method'=>'show_quiz',       'parameters'=>1 );
$routes['desativar-enquete']    = array( 'controller'=>'principal', 'method'=>'desactivate_quiz','parameters'=>1 );
$routes['ativar-enquete']       = array( 'controller'=>'principal', 'method'=>'activate_quiz',   'parameters'=>1 );