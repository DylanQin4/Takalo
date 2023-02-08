<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('process_all_form')){
    function process_all_form($form_data){
        // Valider les données
        $errors = array();
        foreach ($form_data as $field => $value){
            if (empty($value))
            {
                $errors[] = $field . ' est vide';
            }
            elseif (strlen($value) < 5)
            {
                $errors[] = $field . ' est trop court (minimum 5 caractères)';
            }
        }

        // Traiter les données s'il n'y a pas d'erreurs
        if (empty($errors)){
            // Traitement des données ici (par exemple, enregistrement dans une base de données)
            return 'Données enregistrées avec succès';
        }
        else{
            return $errors;
        }
    }
}


if ( ! function_exists('generate_form'))
{
    function generate_form($form_data = array(), $action = '', $attributes = array(), $hidden = array())
    {
        $CI =& get_instance();
        return $CI->form_validation->open($action, $attributes, $hidden).PHP_EOL.
               form_inputs($form_data).PHP_EOL.
               form_submit().PHP_EOL.
               $CI->form_validation->close();
    }

    function form_inputs($form_data)
    {
        $inputs = '';
        foreach ($form_data as $input) {
            $inputs .= form_input($input).PHP_EOL;
        }
        return $inputs;
    }

    function form_submit()
    {
        return form_submit('submit', 'Submit', 'class="btn btn-primary"');
    }
}
?>