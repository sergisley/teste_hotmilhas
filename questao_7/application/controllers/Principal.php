<?php



class Principal extends Controller
{



    function __construct(  )
    {
        parent::__construct();

    }


    public function index()
    {

        $this->load_model('Quizzes_model');

        $data['active_quizzes'] = $this->Quizzes_model->get_active() ;

        if($data['active_quizzes']){
            $data['active_quizzes'] = array_reverse($data['active_quizzes']);
        }

        $this->load_view('home',$data);

    }



    public function edit_user(){

        $data = array();
        if(!empty($_SESSION["client"])){

            $data['email']  = $_SESSION['client']['email'];
            $data['name']   = $_SESSION['client']['name'];

        }

        $this->load_view('edit_user',$data);

    }


    /**
     * save_user
     *
     * cadastr ou atualiza os dados de um usuário
     *
     * @author Sergisley Matias
     * @since  07/2018
     */
    public function save_user(){

        $data['name']       = !empty($_POST['name'])        ?   $_POST['name']     :   false;
        $data['email']      = !empty($_POST['email'])       ?   $_POST['email']     :   false;
        $data['password']   = !empty($_POST['password'])    ?   $_POST['password']  :   false;


        if(!empty($_SESSION["client"])){

            if($data['name'] && $data['email'] ){


                $this->load_model('Users_model');


                $user_email = $this->Users_model->get_by_email(trim($data['email']));

                if($user_email){

                    if($user_email['id']!=$_SESSION['client']['id']){

                        $data['msg'] = array('type'=>'danger','content'=>'E-mail já utilizado por outro usuário.');
                        $this->load_view('edit_user',$data);
                        exit;

                    }
                }

                $user_data = array(
                    'id'   => $_SESSION['client']['id'],
                    'name' => trim($data['name']),
                    'email'=> trim($data['email'])
                );

                if($data['password']){
                    $user_data['password'] = password_hash(trim($data['password']),PASSWORD_DEFAULT);
                }


                $this->Users_model->save($user_data);


                $database_user_data = $this->Users_model->get_by_id($_SESSION['client']['id']);
                $this->set_session_data( $database_user_data );

                $data['msg'] = array('type'=>'success','content'=>'Cadastro atualizado com sucesso.');


                $this->load_view('edit_user',$data);


            }else{

                $data['msg'] = array('type'=>'warning','content'=>'Há dados obrigatórios não preenchidos no formulário.');
                $this->load_view('edit_user',$data);

            }


        }else{


            if($data['name'] && $data['email'] && $data['password']){

                $this->load_model('Users_model');


                if( !$this->Users_model->get_by_email(trim($data['email'])) ){

                    $user_data = array(
                        'name' => trim($data['name']),
                        'email'=> trim($data['email']),
                        'password' => password_hash(trim($data['password']),PASSWORD_DEFAULT)
                    );

                    $id_user = $this->Users_model->save($user_data);


                    $database_user_data = $this->Users_model->get_by_id($id_user);

                    $this->set_session_data( $database_user_data);


                    $data['msg'] = array('type'=>'success','content'=>'Cadastro realizado com sucesso.');
                    $this->load_view('edit_user',$data);

                }else{

                    $data['msg'] = array('type'=>'danger','content'=>'E-mail já utilizado.');
                    $this->load_view('edit_user',$data);

                }

            }else{

                $data['msg'] = array('type'=>'warning','content'=>'Há campos obrigatórios não preenchidos no formulário.');
                $this->load_view('edit_user',$data);

            }


        }

    }


    /**
     * set_session_data
     *
     * seta a sessão e salva os dados de usuário na mesma
     *
     * @author Sergisley Matias
     * @since  07/2018
     * @param $user_data
     */
    private function set_session_data($user_data){

        $_SESSION["client"]["id"]              =   $user_data['id'];
        $_SESSION["client"]["name"]            =   $user_data["name"];
        $_SESSION["client"]["email"]           =   $user_data["email"];


    }


    /**
     * login
     *
     * executa login do usuário
     *
     * @author Sergisley Matias
     * @since  07/2018
     */
    public function login(){

        $email      = !empty($_POST['email'])       ?   $_POST['email']     :   false;
        $password   = !empty($_POST['password'])    ?   $_POST['password']  :   false;

        $this->load_model('Users_model');

        $data = $this->Users_model->authenticate(trim($email),trim($password));

        if(!empty($data)){

            $this->set_session_data( $data );

            echo json_encode(array('js'=>'location.reload();'));

        }else{
            echo json_encode(array('js'=>'dialogo("Usuário ou Senha inválidos. Tente novamente.");'));
        }

    }


    /**
     * logout
     *
     * executa logout do usuário
     *
     * @author Sergisley Matias
     * @since  07/2018
     */
    public function logout(){

        session_destroy();

        $base_url = base_url();

        header("Location: ".$base_url);

    }


    /**
     * list_quizzes
     *
     * lista quiz
     *
     * @author Sergisley Matias
     * @since  07/2018
     */
    public function list_quizzes(){


        $this->load_model('Quizzes_model');

        $data['quizzes'] = $this->Quizzes_model->get_all();

        if($data['quizzes']){
            $data['quizzes'] = array_reverse($data['quizzes']);
        }

        $this->load_view('list_quizzes',$data);


    }


    /**
     * create_quiz
     *
     * exibe form para criação da quiz
     *
     * @author Sergisley Matias
     * @since  07/2018
     */
    public function create_quiz(){

        if(!empty($_SESSION["client"])) {

            $this->load_view('create_quiz');

        }else{
            $base_url = base_url();

            header("Location: " . $base_url);
        }

    }


    /**
     * save_quiz
     *
     * salva a quiz nova
     *
     * @author Sergisley Matias
     * @since  07/2018
     */
    public function save_quiz(){

        if(!empty($_SESSION["client"])) {

            $data['question']       = !empty($_POST['question'])            ?   $_POST['question']          :   false;
            $data['description']    = !empty($_POST['description'])         ?   $_POST['description']       :   false;
            $data['txt_answer_1']   = !empty($_POST['txt_answer_1'])        ?   $_POST['txt_answer_1']      :   false;
            $data['txt_answer_2']   = !empty($_POST['txt_answer_2'])        ?   $_POST['txt_answer_2']      :   false;
            $data['txt_answer_3']   = !empty($_POST['txt_answer_3'])        ?   $_POST['txt_answer_3']      :   false;
            $data['txt_answer_4']   = !empty($_POST['txt_answer_4'])        ?   $_POST['txt_answer_4']      :   false;
            $data['txt_answer_5']   = !empty($_POST['txt_answer_5'])        ?   $_POST['txt_answer_5']      :   false;
            $data['status']         = !empty($_POST['status'])              ?   $_POST['status']            :   0;


            $data['id_user'] = $_SESSION["client"]['id'];

            if( $data['question'] && $data['txt_answer_1'] && $data['txt_answer_2']  && $data['txt_answer_3']  &&  $data['txt_answer_4']   && $data['txt_answer_5'] ){

                $this->load_model('Quizzes_model');

                $this->Quizzes_model->save($data);


                $this->load_view('create_quiz',array('msg'=>array('type'=>'success','content'=>'Enquete salva com sucesso.')));

            }else{

                $data['msg'] = array('type'=>'warning','content'=>'Há campos obrigatórios não preenchidos no formulário.');
                $this->load_view('create_quiz',$data);

            }

        }else{
            $base_url = base_url();

            header("Location: " . $base_url);
        }

    }


    /**
     * register_answer
     *
     * recebe o id de uma enquete e sua rsposta e resposta e exibe o resultado. se a enquente estiver ativa, contabiliza ela
     *
     * @author Sergisley Matias
     * @since  07/2018
     * @param $id_quiz
     * @param $answer
     */
    public function register_answer($id_quiz, $answer)
    {


        $this->load_model('Quizzes_model');

        $quiz = $this->Quizzes_model->get_by_id($id_quiz);

        if($quiz){

            if($quiz['status']=='1') {

                if (isset($quiz['vlr_answer_' . $answer])) {


                    $num_count = (int)$quiz['vlr_answer_' . $answer];

                    $data_quiz = array(
                        'id' => $id_quiz,
                        'vlr_answer_' . $answer => ($num_count + 1)
                    );


                    $this->Quizzes_model->save($data_quiz);


                    $base_url = base_url('ver-enquete/' . $id_quiz);

                    header("Location: " . $base_url);

                }else{

                    http_response_code(404);
                    die('Resposta não encontrada.');
                }
            }else{

                http_response_code(403);
                die('Enquete não Ativa.');
            }
        }else{

            http_response_code(404);
            die('Enquete não encontrada.');
        }
    }


    /**
     * show_quiz
     *
     * Exibe uma enquete
     *
     * @author Sergisley Matias
     * @since  07/2018
     * @param $id_quiz
     */
    public function show_quiz($id_quiz)
    {

        $this->load_model('Quizzes_model');

        $data['quiz'] = $this->Quizzes_model->get_by_id($id_quiz);

        if($data['quiz']){

            $this->load_model('Users_model');

            $creator = $this->Users_model->get_by_id( $data['quiz']['id_user']);

            $data['quiz']['creator'] = $creator?$creator['name']:'---';

            $this->load_view('show_quiz',$data);

        }else{

            http_response_code(404);
            die('Enquete não encontrada.');
        }


    }


    /**
     * activate_quiz
     *
     * ativa enquete
     *
     * @author Sergisley Matias
     * @since  07/2018
     * @param $id_quiz
     */
    public function activate_quiz($id_quiz)
    {
        if(!empty($_SESSION["client"])) {

            $this->load_model('Quizzes_model');

            $data['quiz'] = $this->Quizzes_model->get_by_id($id_quiz);

            if ($data['quiz']) {

                $data_quiz = array(
                    'id' => $id_quiz,
                    'status' => 1
                );

                $this->Quizzes_model->save($data_quiz);

                $base_url = base_url('ver-enquete/' . $id_quiz);

                header("Location: " . $base_url);

            } else {

                http_response_code(404);
                die('Enquete não encontrada.');
            }
        }

    }


    /**
     * desactivate_quiz
     *
     * desativa enquete
     *
     * @author Sergisley Matias
     * @since  07/2018
     * @param $id_quiz
     */
    public function desactivate_quiz($id_quiz)
    {
        if(!empty($_SESSION["client"])) {

            $this->load_model('Quizzes_model');

            $data['quiz'] = $this->Quizzes_model->get_by_id($id_quiz);

            if ($data['quiz']) {

                $data_quiz = array(
                    'id' => $id_quiz,
                    'status' => 0
                );

                $this->Quizzes_model->save($data_quiz);

                $base_url = base_url('ver-enquete/' . $id_quiz);

                header("Location: " . $base_url);

            } else {

                http_response_code(404);
                die('Enquete não encontrada.');
            }
        }

    }




}