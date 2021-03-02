<?php
    $icons = array(
        'search' => array(
            'right' =>'<i class="fas fa-search fa-icon-right"></i>', 
            'left' => '<i class="fas fa-search fa-icon-left"></i>'
        ),
        'username' => array(
            'right' =>'<i class="fas fa-username fa-icon-right"></i>', 
            'left' => '<i class="fas fa-username fa-icon-left"></i>'
        ),
        'email' => array(
            'right' =>'<i class="fas fa-envelope fa-icon-right"></i>', 
            'left' => '<i class="fas fa-envelope fa-icon-left"></i>'
        ),
        'lock' => array(
            'right' =>'<i class="fas fa-lock fa-icon-right"></i>', 
            'left' => '<i class="fas fa-lock fa-icon-left"></i>'
        ),
        'flag' => array(
            'right' =>'<i class="fas fa-flag fa-icon-right"></i>', 
            'left' => '<i class="fas fa-flag fa-icon-left"></i>'
        ),
        'location' => array(
            'right' =>'<i class="fas fa-map-marker-alt fa-icon-right"></i>', 
            'left' => '<i class="fas fa-map-marker-alt fa-icon-left"></i>'
        )
    );

    function getIcon($iconName, $direction = "left") {
        global $icons;   
        return $icons[$iconName][$direction];
    }
?>