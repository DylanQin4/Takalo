<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Redirect extends CI_Controller {
        function to($view){
            $this->load->view($view);
        }
    }
?>