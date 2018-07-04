<?php

//sempre inicia com a sessão
session_start();

//requerindo configurações, rotas e controller
require_once __DIR__.'/application/config/config.php';
require_once __DIR__.'/application/config/routes.php';
require_once __DIR__.'/application/system/Controller.php';
require_once __DIR__.'/application/system/Database.php';
require_once __DIR__.'/application/system/Model.php';


//definindo função base_url
function base_url($segment=''){

    //se houver https host, monta a url
    if(isset($_SERVER['HTTP_HOST'])) {

        //checando se há https
        $prefix = isset($_SERVER['HTTPS'])?'https://':'http://';
        $host = $_SERVER['HTTP_HOST'];
        $end = substr($_SERVER['SCRIPT_NAME'],0,-9);

        //montando url
        $base_url = $prefix.$host.$end ;

    }else{
        $base_url = 'http://localhost/';
    }

    return $base_url.$segment;
}



//roteando. se não houver path, procura o controller default
if(!isset($_SERVER['PATH_INFO'])){

    //checando se o controller default foi definido e mandando erro caso não esteja
    if(!isset($controller_default)) {

        http_response_code(500);
        die('Controller Default not found');

    }

    //ajustando nome do controller
    $controller_name = ucfirst($controller_default);

    //requerendo o controller
    require_once __DIR__.'/application/controllers/'.$controller_name.'.php';

    //instanciando o controller
    $controller = new $controller_name;

    //executando método index
    $controller->index();


    //caso haja requisição, ou seja, não estejam acessando o index
}else{

    //recebendo path
    $path= $_SERVER['PATH_INFO'];

    //passando para array
    $path = explode('/', ltrim($path));

    //se não existir requisiçaõ ou a rota desta requisição exibe erro 404
    if(!isset($path[1])||!isset($routes[$path[1]])){

        http_response_code(404);
        die('Route or Requisition not found');

    }

    //carregando os valores da rota
    $route = $routes[$path[1]];

    //tratando no me do controller
    $controller_name = ucfirst($route['controller']);

    //requerendo controller
    require_once __DIR__.'/application/controllers/'.$controller_name.'.php';

    //estanciando controller
    $controller = new $controller_name;

    //se não houver parametros, chama o método diretamente, caso haja, trata os parâmetros e chama o método conforme o caso
    if($route['parameters']===0){

        $controller->{$route['method']}();

    }else{

        $parameters = array();
        for($i=1;$i<=$route['parameters'];$i++){

            if(isset($path[$i+1])) {
                //adicionando +1 pois o primeiro parãmetro virá no index 2 do array path
                $parameters['parameter' . $i] = $path[$i + 1];
            }

        }


        //@todo passar dinamicamente as variáveis na chamada do método de forma flexível e sem limitação. a única limitação deve ser a informada no routes
        if(!empty($parameters)){

            switch(count($parameters)){
                case 1:
                    $controller->{$route['method']}($parameters['parameter1']);
                    break;
                case 2:
                    $controller->{$route['method']}($parameters['parameter1'],$parameters['parameter2']);
                    break;
                case 3:
                    $controller->{$route['method']}($parameters['parameter1'],$parameters['parameter2'],$parameters['parameter3']);
                    break;
            }

        }else{
            $controller->{$route['method']}();
        }


    }



}