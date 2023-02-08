<?php
if (defined('BASEPATH') OR exit('No direct script access allowed')){

    class Objects extends CI_Model {
        function changeOwner($id_object, $id_client){
            $data = array(
                'id_client' => $id_client
                );
            $this->db->where('id_object', $id_object);
            $this->db->update('object', $data);
        }
        function insert($form_data){
            $data = array(
                'id_client' => $_SESSION['id_client'],
                'id_category' => $form_data['category'],
                'name_object' => $form_data['name'],
                'title' => $form_data['title'],
                'description' => $form_data['description'],
                'estimated_price' => $form_data['price']
            );
            $this->db->set($data);
            $this->db->insert('object');
        }
        function delete($id_object){
            $this->db->where('id_object', $id_object);
            $this->db->delete('object');
        }
        function update($form_data, $id_object){
            $data = array(
            'id_category' => $form_data['category'],
            'name_object' => $form_data['name'],
            'title' => $form_data['title'],
            'description' => $form_data['description'],
            'estimated_price' => $form_data['price']
            );
            $this->db->where('id_object', $id_object);
            $this->db->update('object', $data);
        }
        function getObject($id_object){
            $query = $this->db->query('SELECT * FROM object JOIN category ON object.id_category=category.id_category WHERE object.id_object='.$id_object);
            $data = array();
            foreach($query->result_array() as $row){
                $data[] = $row;
            }
            return $data;
        }
        function getObjectOthers($id_client){
            $query = $this->db->query('SELECT * FROM object JOIN client ON object.id_client=client.id_client JOIN category ON object.id_category=category.id_category WHERE client.id_client != '.$id_client);
            $data = array();
            foreach($query->result_array() as $row){
                $data[] = $row;
            }
            return $data;
        }

        function getMyObjects($id_client){
            $query = $this->db->query('SELECT * FROM object JOIN client ON object.id_client=client.id_client JOIN category ON object.id_category=category.id_category WHERE client.id_client='.$id_client);
            $data = array();
            foreach($query->result_array() as $row){
                $data[] = $row;
            }
            return $data;
        }

        function setOwnerTo($id_object, $id_client){
            $this->db->set("id_client", $id_client);
            $this->db->where('id', $id_object);
            $this->db->update('object');
        }
    }

}
?>