<?php
    if (! function_exists('format_date')) {
        function format_date($date, $format = 'Y-m-d'){
            return date($format, strtotime($date));
        }
    }
?>