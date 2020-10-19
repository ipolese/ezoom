<?php

class Cursos extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('ezoom/login');
        }
        $this->load->helper(array('codegen_helper'));
        $this->load->model('cursos_model', '', true);
        $this->data['menuCursos'] = 'cursos';
    }
    
    function index()
    {
        $this->gerenciar();
    }

    function gerenciar()
    {

        $this->load->library('table');
        $this->load->library('pagination');
        
   
        $config['base_url'] = base_url().'index.php/cursos/gerenciar/';
        $config['total_rows'] = $this->cursos_model->count('cursos');
        $config['per_page'] = 10;
        $config['next_link'] = 'Próxima';
        $config['prev_link'] = 'Anterior';
        $config['full_tag_open'] = '<div class="pagination alternate"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a style="color: #2D335B"><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = 'Primeira';
        $config['last_link'] = 'Última';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        
        $this->pagination->initialize($config);
        
        $this->data['results'] = $this->cursos_model->get('cursos', '*', '', $config['per_page'], $this->uri->segment(3));
        
        $this->data['view'] = 'cursos/cursos';
        $this->load->view('tema/topo', $this->data);
        
    }
    
    function adicionar()
    {
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('cursos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {

            $image = $this->do_upload_file();
            $capa = base_url().'assets/uploads/'.$image;

            $data = array(
                'titulo' => set_value('titulo'),
                'descricao' => set_value('descricao'),
                'capa' => $capa,
                'dataCadastro' => date('Y-m-d')
            );

            if ($this->cursos_model->add('cursos', $data) == true) {
                $last_id = $this->db->insert_id();

                $this->session->set_flashdata('success', 'Curso adicionado com sucesso!');
                redirect(base_url() . 'index.php/cursos/galeria/'.$last_id);
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['view'] = 'cursos/adicionarCurso';
        $this->load->view('tema/topo', $this->data);

    }
    
    function galeria()
    {  
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('galeria') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {

            $galeria = $this->do_upload();

            $this->session->set_flashdata('success', 'Galeria cadastrada com sucesso!');
            redirect(base_url() . 'index.php/cursos/');
        }

        $this->data['result'] = $this->cursos_model->getById($this->uri->segment(3));
        $this->data['view'] = 'cursos/galeria';
        $this->load->view('tema/topo', $this->data);
    }

    function editar()
    {

        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('ezoom');
        }

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('cursos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {

            $userfile = $_FILES['userfile']['tmp_name'];

            if ($userfile !=  ""){
                $image = $this->do_upload_file();
                $capa = base_url().'assets/uploads/'.$image;

                $data = array(
                    'titulo' => set_value('titulo'),
                    'descricao' => set_value('descricao'),
                    'capa' => $capa,
                    'dataCadastro' => date('Y-m-d')
                );
            }
            else{
                $data = array(
                    'titulo' => set_value('titulo'),
                    'descricao' => set_value('descricao'),
                    'dataCadastro' => date('Y-m-d')
                );
            }

            if ($this->cursos_model->edit('cursos', $data, 'idCursos', $this->input->post('idCursos')) == true) {
                $this->session->set_flashdata('success', 'Curso editado com sucesso!');
                redirect(base_url() . 'index.php/cursos/editar/'.$this->input->post('idCursos'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }

        $this->data['result'] = $this->cursos_model->getById($this->uri->segment(3));
        $this->data['view'] = 'cursos/editarCurso';
        $this->load->view('tema/topo', $this->data);

    }

    public function visualizar()
    {

        if (!$this->uri->segment(3) || !is_numeric($this->uri->segment(3))) {
            $this->session->set_flashdata('error', 'Item não pode ser encontrado, parâmetro não foi passado corretamente.');
            redirect('ezoom');
        }

        $this->data['custom_error'] = '';
        $this->data['result'] = $this->cursos_model->getById($this->uri->segment(3));
        $this->data['galeria'] = $this->cursos_model->getGaleriaById($this->uri->segment(3));
        $this->data['view'] = 'cursos/visualizar';
        $this->load->view('tema/topo', $this->data);

        
    }
    
    public function excluir()
    {

        $id =  $this->input->post('id');

        $this->cursos_model->delete('cursos', 'idCursos', $id);

        $this->session->set_flashdata('success', 'Curso excluido com sucesso!');
        redirect(base_url().'index.php/cursos/gerenciar/');
    }

    function do_upload_file(){

        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('ezoom/login');
        }

        $this->load->library('upload');

        $image_upload_folder = FCPATH . 'assets/uploads';

        if (!file_exists($image_upload_folder)) {
            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
        }

        $this->upload_config = array(
            'upload_path'   => $image_upload_folder,
            'allowed_types' => 'png|jpg|jpeg|bmp',
            'max_size'      => 2048,
            'remove_space'  => true,
            'encrypt_name'  => true,
        );

        $this->upload->initialize($this->upload_config);

        if (!$this->upload->do_upload()) {
            $upload_error = $this->upload->display_errors();
            print_r($upload_error);
            exit();
        } else {
            $file_info = array($this->upload->data());
            return $file_info[0]['file_name'];
        }

    }

    public function do_upload(){       
        $this->load->library('upload', $config);

        $files = $_FILES;
        $cpt = count($_FILES['userfile']['name']);
        for($i=0; $i<$cpt; $i++)
        {           
            $_FILES['userfile']['name']= $files['userfile']['name'][$i];
            $_FILES['userfile']['type']= $files['userfile']['type'][$i];
            $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
            $_FILES['userfile']['error']= $files['userfile']['error'][$i];
            $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

            $this->upload->initialize($this->set_upload_options());
            $this->upload->do_upload();

            $file = $_FILES['userfile']['name'];
            $url = base_url().'assets/uploads/'.date('d-m-Y').'/'.$file;

            $data = array(
                'url' => $url,
                'cursos_id' => $this->input->post('idCursos'),
            );
            $this->cursos_model->add('galeria', $data);
        }
    }

    private function set_upload_options(){   
        //upload an image options
        $date = date('d-m-Y');

        $config = array();
        $config['upload_path'] = './assets/uploads/'.$date;
        $config['allowed_types'] = 'png|jpg|jpeg|bmp';
        $config['max_size']      = '2048';
        $config['overwrite']     = FALSE;

        if (!is_dir('./assets/uploads/'.$date)) {

            mkdir('./assets/uploads/' . $date, 0777, TRUE);

        }

        return $config;
    }
}
