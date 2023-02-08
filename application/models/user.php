<?php
if (defined('BASEPATH') OR exit('No direct script access allowed')){

    class User extends CI_Model {
        public function getInfo($id_client){
            $query = $this->db->query('SELECT * FROM user JOIN client ON user.id_client= client.id_client WHERE client.id_client='.$id_client);
            $data = array();
            foreach($query->result_array() as $row){
                $data[] = $row;
            }
            return $data;
        }
        public function login($form_data){
            $query = $this->db->query("SELECT client.id_client AS id_client FROM user JOIN client ON user.id_client= client.id_client WHERE user.email='".$form_data['email']."' AND user.pass='".$form_data['password']."'");
            $result = $query->row();
            if ($result != NULL) {
                return $result->id_client;
            }
            return NULL;
        }
        public function isAdmin($id_client){
            $query = $this->db->query("SELECT user.is_admin FROM user JOIN client ON user.id_client= client.id_client WHERE client.id_client=".$id_client);
            $result = $query->row();
            if ($result != NULL) {
                return $result->is_admin;
            }
            return FALSE;
        }
        public function countUser(){
            $query = $this->db->query("SELECT COUNT(*) AS count_user FROM user WHERE is_admin=FALSE");
            $result = $query->row();
            if ($result != NULL) {
                return $result->count_user;
            }
            return 0;
        }
        public function registration($form_data){
            $this->db->trans_begin();

            $data = array(
                'name_client' => $form_data['name'],
                'first_name' => $form_data['first_name'],
                'contact' => $form_data['contact'],
            );
            $this->db->set($data);
            $this->db->insert('client');

            $id_client = $this->db->insert_id();

            $data = array(
                'id_client' => $id_client,
                'pass' => $form_data['password'],
                'email' => $form_data['email'],
            );
            $this->db->set($data);
            $this->db->insert('user');

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return false;
            }
            else {
                $this->db->trans_commit();
                $_SESSION['id_client'] = $id_client;
                return true;
            }
        }
    }
}
?>