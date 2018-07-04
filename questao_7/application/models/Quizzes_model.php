<?php


/**
 * Class Quizzes_model
 *
 *  gerencia a tabela quizzes
 *
 * @author Sergisley Matias
 */
class Quizzes_model extends Model
{

    //nome da tabela
    protected $table_name = 'quizzes';
    protected $fields = array(
        'id',
        'id_user',
        'question',
        'description',
        'txt_answer_1',
        'txt_answer_2',
        'txt_answer_3',
        'txt_answer_4',
        'txt_answer_5',
        'vlr_answer_1',
        'vlr_answer_2',
        'vlr_answer_3',
        'vlr_answer_4',
        'vlr_answer_5',
        'status'
    );


    /**
     * método construtor
     */
    function __construct(){
        parent::__construct();
    }


    /**
     * get_all
     *
     * retorna todos os valores na tabela
     *
     * @author Sergisley Matias
     * @return array|bool
     */
    public function get_all( ){

        return parent::get();

    }

    public function get_active( ){

        $params = array(
            'where'=>array('status'=>1)
        );

        return parent::get($params);
    }


    /**
     * get_by_id
     *
     * retorna dado resultado por id
     *
     * @author Sergisley Matias
     * @param $id
     * @return array|bool
     */
    public function get_by_id(  $id ){

        $params = array(
            'where'=>array('id'=>$id)
        );

        $data = parent::get($params);

        if(!$data)
            return false;


        return $data[0];
    }


    /**
     * save
     *
     * recebe um array de dados e salva. caso tenha id, faz update no banco e retorna true se houver sucesso. se não
     * tiver o campo id no array, salva como novo registro e retorna id do mesmo
     *
     * @author Sergisley Matias
     * @param $data
     * @return bool|string
     */
    public function save(  $data ){

        $params = array();
        if(isset($data['id'])){

            $params['id'] = $data['id'];
            unset($data['id']);

        }

        $params['data'] = $data;

        return parent::save($params);

    }


    /**
     * delete_by_id
     *
     * recebe o id de um dado e o remove do banco
     *
     * @author Sergisley Matias
     * @since  07/2018
     * @param $id
     * @return bool
     */
    public function delete_by_id($id){

        $where = array(
            'id'=>$id
        );

        return parent::del($where);

    }
}
