<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Takalo extends CI_Controller {
        function index() {
            if (isset($_SESSION['id_client'])) {
                $this->load->view("components/head");
                $this->load->view('index');
            } else {
                $this->toLogin();
            }
        }
        function stat(){
            $this->load->model("user");
            $data['count_user'] = $this->user->countUser();
            $this->load->view("components/head");
            $this->load->view("stat", $data);
        }
        function objectAttente($listAttente){
            $this->load->model("objects");
            $rep = array();
            for ($i=0; $i < count($listAttente); $i++) { 
                $rep[] = $this->objects->getObject($listAttente[$i]['id_object1']);
            }
            return $rep;
        }

        function invitation(){
            $data['listAttente'] = $this->getInvitation();
            $data['objectAttente'] = $this->objectAttente($data['listAttente']);
            $this->load->view("components/head");
            $this->load->view("invitation", $data);
        }
        function acceptation(){
            $form_data = $this->input->post();
            $this->load->model("exchange");
            $this->load->model("objects");
            if (isset($form_data['accept'])) {
                $this->exchange->acceptation($form_data['id_exchange']);
                $this->objects->changeOwner($form_data['id_object1'], $form_data['receiver']);
                $this->objects->changeOwner($form_data['id_object2'], $form_data['sender']);
            } else if (isset($form_data['refus'])) {
                $this->exchange->refus($form_data['id_exchange']);
            }
            $this->invitation();
        }
        function getInvitation(){
            $this->load->model("exchange");
            $allExchange = $this->exchange->getAll();
            $this->load->model("objects");
            $data['objectOthers'] = $this->objects->getObjectOthers($_SESSION['id_client']);
            $rep = array();
            for ($i=0; $i < count($allExchange); $i++) { 
                if ($allExchange[$i]['status'] == 1 && $allExchange[$i]['sender'] != $_SESSION['id_client']) {
                    $rep[] = $allExchange[$i];
                }
            }
            return $rep;
        }

        function exchange(){
            $form_data = $this->input->post();
            $this->load->model("exchange");
            $this->exchange->insert($form_data);
            $this->objectOthers();
        }

        function objectOthers(){
            $this->load->model("category");
            $this->load->model("objects");
            $data['objectOthers'] = $this->objects->getObjectOthers($_SESSION['id_client']);
            $data['myObjects'] = $this->objects->getMyObjects($_SESSION['id_client']);
            $data['category'] = $this->category->getAll();
            $data['enAttente'] = $this->getEnAttente();
            $this->load->view("components/head");
            $this->load->view("objectOthers", $data);
        }
        function getEnAttente(){
            $this->load->model("exchange");
            $allExchange = $this->exchange->getAll();
            $rep = array();
            for ($i=0; $i < count($allExchange); $i++) { 
                if ($allExchange[$i]['status'] == 1 && $allExchange[$i]['sender'] == $_SESSION['id_client']) {
                    $rep[] = $allExchange[$i]['id_object1'];
                }
            }
            return $rep;
        }

        function toRegister(){
            $this->load->view("components/head");
            $this->load->view("pages/create-account");
        }

        function toLogin(){
            $this->load->view("components/head");
            $this->load->view("pages/login");
        }

        function myObjects(){
            $this->load->view("components/head");
            $this->load->model("objects");
            $data['myObjects'] = $this->objects->getMyObjects($_SESSION['id_client']);
            $this->load->view("myobjects", $data);
        }

        function updateObject($id_object){
            $this->load->model("objects");
            $form_data = $this->input->post();
            $this->objects->update($form_data, $id_object);
            $this->load->view("components/head");
            $this->myObjects();
        } 
        function deleteObject($id_object){
            $this->load->model("objects");
            $this->objects->delete($id_object);
            $this->load->view("components/head");
            $this->myObjects();
        }
        function logOut(){
            session_destroy();
            redirect(base_url(""));
        }

        public function insertObject(){
            $this->load->model("objects");
            $form_data = $this->input->post();
            $this->objects->insert($form_data);
            $this->load->view("components/head");
            $this->myObjects();
        }

        public function addObject(){
            $this->load->model('category');
            $data['category'] = $this->category->getAll();
            $this->load->view("components/head");
            $this->load->view("addObjects", $data);
        }

        function myobject($id_object){
            $form_data = $this->input->post();
            if (isset($form_data['update'])) {
                $this->load->model('objects');
                $this->load->model('category');
                $this->load->view("components/head");
                $data['object'] = $this->objects->getObject($id_object);
                $data['category'] = $this->category->getAll();
                $data['id_category'] = $this->category->getCategory($data['object'][0]['id_category']);
                $this->load->view("modifyObject", $data);
            } else if (isset($form_data['delete'])) {
                $this->deleteObject($id_object);
            }
            
        }
    }
?>