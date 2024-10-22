<?php 

class Usuario_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

    public function get_by_id($id){
        $this->db->select("*");
        $this->db->from("usuarios");
        $this->db->where("id_usuario", $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function check_login($nombre, $password){

        $this->db->select("id_usuario");
        $this->db->where("nombre", $nombre);
        $this->db->where("password", $password);
        $query = $this->db->get("usuarios");
        if ($query->num_rows() > 0) {
            $tmp = $query->row_array();
            return $tmp["id_usuario"];
        } else {
            return false;
        }
    }


}




?>