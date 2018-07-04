<?php



class Users_model extends Model
{

    //nome da tabela
    protected $table_name = 'users';
    protected $fields = array(
        'id',
        'name',
        'email',
        'password'
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

        if(!$data){
            return false;
        }


        return $data[0];
    }


    /**
     * get_by_email
     *
     * busca usuário por e-mail
     *
     * @author Sergisley Matias
     * @since  07/2018
     * @param $email
     * @return array|bool
     */
    public function get_by_email(  $email ){

        $params = array(
            'where'=>array('email'=>$email)
        );


        $data = parent::get($params);

        if(!$data){
            return false;
        }


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



    public function authenticate($email,$password){

        $params = array(
            'where'=>array('email'=>$email)
        );

        $data = parent::get($params);

        if(!$data){
            return false;
        }

        if( password_verify ( $password , $data[0]['password'] ) ){
            return $data[0];
        }else{
            return false;
        }

    }
}
