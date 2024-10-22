<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contacto extends CI_Controller{
	
	public function __construct()
	{
		parent::__construct(); 
		if(!$this->session->userdata('id_usuario')){
			redirect('auth/login');
		}
        $this->load->model('contacto_model');
	}

	public function index()
	{
		redirect('contacto/principal');
	}
    
	public function principal()
    {
            $datos = array();
            $this->contacto_model->set_usuario_id($this->session->userdata('id_usuario'));
            $datos['contactos'] = $this->contacto_model->listar(); 
            $this->load->view('contacto', $datos); 
    }
    
    public function nuevo()
    {
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido'); 
        $email = $this->input->post('email'); 
        $telefono = $this->input->post('telefono');  
        $usuario_id = $this->session->userdata('id_usuario'); 
        $this->contacto_model->nuevo($nombre,$apellido,$email,$telefono, $usuario_id);
        redirect('contacto');
    }
    
	
}