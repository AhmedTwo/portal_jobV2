<?php

function render ($view, $data) {
    
    extract($data);
    
    ob_start();  // demarrage du buffer
    
    require_once 'views/pages/'.$view.'.html.php';
    
    $content = ob_get_clean(); // recuperation + nettoyage  du buffer
    
    
    require_once './views/base.html.php';
    
    }