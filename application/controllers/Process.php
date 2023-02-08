<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Process extends CI_Controller {
        
        function login(){
            $this->load->model('user');
            $form_data = $this->input->post();
            $id_client = $this->user->login($form_data); 
            if ($id_client != NULL && !empty($id_client)) {
                $is_admin = $this->user->isAdmin($id_client);
                $_SESSION['id_client'] = $id_client;
                $_SESSION['is_admin'] = $is_admin;
                $this->load->view("components/head");
                $this->load->view("index");
            } else {
                $data['errors'] = "Identifiant incorrecte";
                $this->load->view("components/head");
                $this->load->view("pages/login", $data);
            }
        }
        function registration(){
            $form_data = $this->input->post();
            $errors = $this->process_register($form_data);
            if (count($errors)==0) {
                $this->load->model("user");
                if($this->user->registration($form_data)){
                    $this->load->view("components/head");
                    $this->load->view("index");
                };
            } else {
                $data['errors'] = $errors;
                $this->load->view("components/head");
                $this->load->view("pages/create-account", $data);
            }
        }
        function process_register($data){
            $errors = array();

            foreach ($data as $field => $value){
                if (empty($value))
                {
                    $errors['champ'] = 'Tous les champs sont obligatoires';
                    return $errors;
                }
            }

            if (isset($data['password']) && $data['password']!=$data['confirm_password'])
            {
                $errors['password'] = 'Confirmer votre mot de passe';
            }
    
            if (isset($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL))
            {
                $errors['email'] = 'Le champ doit être une adresse e-mail valide';
            }
    
            return $errors;
        }
    }
?>