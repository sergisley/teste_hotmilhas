<?php

/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 03/07/2018
 * Time: 18:30
 */
class Database
{

    private $_PDO;

    private $host_name;
    private $user_name;
    private $password;
    private $database_name;


    /**
     * consturtor
     */
    public function __construct()
    {

        require __DIR__.'/../config/database.php';

        $this->host_name        = $config['host_name'];
        $this->user_name        = $config['user_name'];
        $this->password         = $config['password'];
        $this->database_name    = $config['database_name'];

        //conectando via PDO
        $this->_PDO = new PDO( 'mysql:host=' . $this->host_name . ';dbname=' . $this->database_name, $this->user_name , $this->password );

        // Seta o modo que o PDO tratará os erros
        $this->_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->connect();

    }


    /**
     * connect
     *
     * faz a conexão com o banco de dados e guarda na variável _PDO
     *
     * @author Sergisley Matias
     * @since  07/2018
     */
    private function connect(){

        //conectando via PDO
        $this->_PDO = new PDO(
            'mysql:host=' . $this->host_name . ';dbname=' . $this->database_name,
            $this->user_name ,
            $this->password ,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );




        // Seta o modo que o PDO tratará os erros
        $this->_PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }


    /**
     * disconnect
     *
     * Disconecta do banco de dados
     *
     * @author Sergisley Matias
     * @since  07/2018
     */
    public function disconnect()
    {
        // Fecha a conexão
        $this->_PDO = null;
    }


    /**
     * get
     *
     * busca dados da query dada
     *
     * @author Sergisley Matias
     * @since  07/2018
     * @param $query
     * @return bool
     */
    public function get($query){

        try {

            $result = $this->_PDO->query( $query );

            if($result){
                $data = $result->fetchAll(PDO::FETCH_ASSOC);

                if(!empty($data)){
                    return $data;
                }else{
                    return false;
                }

            }else{
                return false;
            }

        } catch (Exception $e) {
            http_response_code(500);
            die('Database Error: '. $e->getMessage());
        }

    }


    /**
     * update
     *
     * atualiza os dados conforme query dada e retorna true caso o consiga
     *
     * @author Sergisley Matias
     * @since  07/2018
     * @param $query
     * @return bool
     */
    public function update($query){


        try {

            //preparar o statement
            $stmt  = $this->_PDO->prepare($query);

            // Executa a query
            $stmt->execute();

            // se houve linhas atualizadas, retorna true
            if($stmt->rowCount() > 0){
                return true;
            }else{
                return false;
            }

        } catch (Exception $e) {
            http_response_code(500);
            die('Database Error: '. $e->getMessage());
        }

    }


    /**
     * save
     *
     * salva dados conforme query dada
     *
     * @author Sergisley Matias
     * @since  07/2018
     * @param $query
     * @return bool
     */
    public function save($query){

        try {

            //preparar o statement
            $stmt = $this->_PDO->prepare($query);

            // Executa a query
            $stmt->execute();

            // se houve linhas salvas, retorna o id
            if($stmt->rowCount() > 0){
                return  $this->_PDO->lastInsertId();
            }else{
                return false;
            }

        } catch (Exception $e) {
            http_response_code(500);
            die('Database Error: '. $e->getMessage());
        }

    }

}