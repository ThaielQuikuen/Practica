<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    // La funcion index tiene que estar en todos los controllers
    public function index()
    {
        redirect('auth/login');
    }
    public function login()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nombre','Usuario', 'trim|strtolower|required');//primero nombre real, luego como el usuario lo ve,
        $this->form_validation->set_rules('password','Contraseña','required');
        if( $this->form_validation->run() == FALSE ){ //run va a devolver true si pasaron las reglas o falso si no pasaron
            $this->load->view('login');
        }else{
            $this->load->model('usuario_model');
            $usuario = set_value("nombre");
            $password = set_value("password");
            if( $uid = $this->usuario_model->check_login($usuario, $password) ){
                $u=$this->usuario_model->get_by_id($uid);
                    $this->session->set_userdata("id_usuario",$uid);
                    $this->session->set_userdata("usuario", $u["usuario"]);
                    redirect('contacto');
            }else{
                //$this->session->set_flashdata("OP", "INCORRECTO");
                redirect('auth/login');
            }
        }
    }
    public function logout(){   
        $this->session->sess_destroy();
        //$this->session->set_flashdata("OP", "SALIO");
        redirect('auth/login');
    }
}