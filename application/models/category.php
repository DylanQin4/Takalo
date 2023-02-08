<?php
if (defined('BASEPATH') OR exit('No direct script access allowed')){

    class Category extends CI_Model {
        function getAll(){
            $query = $this->db->query('SELECT * FROM category');
            $data = array();
            foreach($query->result_array() as $row){
                $data[] = $row;
            }
            return $data;
        }
        function getCategory($id_category){
            $query = $this->db->query('SELECT * FROM category WHERE id_category='.$id_category);
            $data = array();
            foreach($query->result_array() as $row){
                $data[] = $row;
            }
            return $data;
        }
    }
}
?>