<?php


/**
 * Class Controller
 *
 * classe pai dos controllers
 */
class Controller
{

    /**
     * construtor
     */
    public function __construct()
    {

    }


    /**
     * load_model
     *
     * carrega model como propriedade do controller
     *
     * @author Sergisley Matias
     * @since  07/2018
     * @param $model_name
     */
    protected function load_model($model_name){

        $model_name = ucfirst( $model_name );

        require_once __DIR__.'/../models/'.$model_name.'.php';


        $this->{$model_name} = new $model_name;

    }


    /**
     * load_view
     *
     * carrega views
     *
     * @author Sergisley Matias
     * @since  07/2018
     * @param            $view_name
     * @param            $data
     * @param bool|false $without_layoutc
     */
    protected function load_view($view_name,$data = false,$without_layout=false){

        if($data){
            extract($data);
        }

        ob_start();

        if($without_layout){

            require __DIR__.'/../views/'.$view_name.'.php';

        }else{

            require __DIR__.'/../views/layout.php';

        }

         ob_end_flush();


    }

}