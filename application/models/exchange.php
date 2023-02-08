<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Exchange extends CI_Model {
        function insert($form_data){
            $this->load->database();
            $data = array(
                'id_object1' => $form_data['id_object1'],
                'id_object2' => $form_data['id_object2'],
                'sender' => $form_data['sender'],
                'receiver' => $form_data['receiver'],
                'status' => 1,
                'exchange_date' => date("Y-m-d H:i:s")
            );
            $this->db->set($data);
            $this->db->insert('exchange');
        }
        function acceptation($id_exchange){
            $data = array(
                'status' => 11
            );
            $this->db->where('id_exchange', $id_exchange);
            $this->db->update('exchange', $data);
        }
        function refus($id_exchange){
            $data = array(
                'status' => -1
            );
            $this->db->where('id_exchange', $id_exchange);
            $this->db->update('exchange', $data);
        }
        function getAll(){
            $query = $this->db->query('SELECT * FROM exchange');
            $data = array();
            foreach($query->result_array() as $row){
                $data[] = $row;
            }
            return $data;
        }
        function getExchange($sender){
            $query = $this->db->query('SELECT * FROM exchange WHERE sender='.$sender);
            $data = array();
            foreach($query->result_array() as $row){
                $data[] = $row;
            }
            return $data;
        }
    }
?>