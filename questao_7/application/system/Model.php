<?php

/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 03/07/2018
 * Time: 14:00
 */
class Model
{

    protected $db;
    protected $table_name;
    protected $fields;

    public $debug = false;


    public function __construct()
    {

        $this->db = new Database();


    }


    /**
     * save
     *
     * salva os dados recebidos, atualizando ou criando novo conforme o envio ou não de id
     *
     * @author Sergisley Matias
     * @param $params
     * @return bool|string
     */
    public function save( $params ){


        if(isset($params['id'])){

            $fields = array();
            foreach($params['data'] as $field=>$value){
                if($field !=='id'){
                    $fields[] = " ".$field." = '".$value."' ";
                }
            }

            $query = "UPDATE ".$this->table_name." SET ".implode(",",$fields)." where id = '".$params['id']."' ";

            //se ativado o debug, exibe a query
            if($this->debug){
                print_r($query);
            }

            return $this->db->update($query);

        }else{

            $fields = $values = array();
            foreach($params['data'] as $field=>$value){
                if($field !=='id'){
                    $fields[] = $field;
                    $values[] = $value;
                }
            }

            $query = "INSERT INTO ".$this->table_name." (".implode(",",$fields).") VALUES ('".implode("','",$values)."') ";


            //se ativado o debug, exibe a query
            if($this->debug){
                print_r($query);
            }

            return $this->db->save($query);

        }
    }


    /**
     * Get
     *
     * retorna todos os dados ou adiciona where
     * @todo adicionar order by, group by e oturos modificadores
     *
     * @author Sergisley Matias
     * @param bool|false $params
     * @return array|bool
     */
    public function get( $params = false ){

        //setando query base
        $query = 'SELECT * FROM '.$this->table_name;

        //caso haja where, adiciona o mesmo à query
        if(isset($params['where'])){

            $fields = array();
            foreach($params['where'] as $field=>$value){
                $fields[] = " ".$field." = '".$value."' ";
            }

            $query .= ' WHERE '.implode(' AND ',$fields);

        }

        //se ativado o debug, exibe a query
        if($this->debug){
            print_r($query);
        }

        //executa a busca pela classe db
        return $this->db->get( $query );

    }


    /**
     * del
     *
     * deleta registros segundo parãmetro
     *
     * @author Sergisley Matias
     * @since  07/2018
     * @param $params
     * @return bool
     */
    public function del($where){

        $query = "DELETE FROM ".$this->table_name;


        $fields = array();
        foreach($where as $field=>$value){
            $fields[] = " ".$field." = '".$value."' ";
        }

        $query .= ' WHERE '.implode(' AND ',$fields);

        //se ativado o debug, exibe a query
        if($this->debug){
            print_r($query);
        }

        return $this->db->update($query);

    }

}