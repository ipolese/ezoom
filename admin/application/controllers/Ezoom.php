<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Ezoom extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('usuarios_model', '', true);
        $this->load->model('ezoom_model', '', true);
        
    }

    public function index()
    {
        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('ezoom/login');
        }		

        $this->data['menuPainel'] = 'Painel';
        $this->data['view'] = 'ezoom/painel';
        $this->load->view('tema/topo', $this->data);
      
    }

    public function login()
    {
        
        $this->load->view('ezoom/login');
        
    }
    public function sair()
    {
        $this->session->sess_destroy();
        redirect('ezoom/login');
    }


    public function verificarLogin()
    {
        
        header('Access-Control-Allow-Origin: '.base_url());
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type');
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'E-mail', 'valid_email|required|trim');
        $this->form_validation->set_rules('senha', 'Senha', 'required|trim');
        if ($this->form_validation->run() == false) {
            $json = array('result' => false, 'message' => validation_errors());
            echo json_encode($json);
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('senha');
            $this->load->model('ezoom_model');
            $user = $this->ezoom_model->check_credentials($email);

            if ($user) {
                if (password_verify($password, $user->senha)) {
                    $session_data = array(
                        'nome' => $user->nome, 
                        'email' => $user->email, 
                        'id' => $user->idUsuarios,
                        'permissao' => $user->permissoes_id , 
                        'logado' => true
                    );
                    $this->session->set_userdata($session_data);
                    $json = array('result' => true);
                    echo json_encode($json);
                } else {
                    $json = array('result' => false, 'message' => 'Os dados de acesso estão incorretos.');
                    echo json_encode($json);
                }
            } else {
                $json = array('result' => false, 'message' => 'Usuário não encontrado, verifique se suas credenciais estão corretass.');
                echo json_encode($json);
            }
        }
        die();
    }
}
