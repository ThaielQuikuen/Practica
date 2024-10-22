<?php
    class contacto_model extends CI_Model {
        private $usuario_id = null;

        public function set_usuario_id($valor){
            $this->usuario_id = $valor;
        }
        public function listar(){
            $this->db->select('contactos.*');
            $this->db->from('contactos');
            if($this->usuario_id != null){
                $this->db->where('id_usuario',$this->usuario_id);
            }
            return $this->db->get()->result_array();
        }
        public function nuevo($nombre="",$apellido="",$email="",$telefono="", $usuario_id=0)
        {
            //lo guardamos en la base de datos 
            $this->db->set('nombre', $nombre);
            $this->db->set('apellido', $apellido);
            $this->db->set('email', $email);
            $this->db->set('telefono', $telefono);
            $this->db->set('id_usuario', $usuario_id); 
            $this->db->insert('contactos');
            
            return $this->db->insert_id(); //devuelve que inserto la ultima consulta
        }
        
    }


?>