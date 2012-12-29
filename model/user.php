<?php

function get_user_by_id($id)
{
    $requete = " select user_name from ".TABLE_USER." where user_id = '".(int)$id."' ";
    $retour = my_assoc($requete);
    
    return $retour[0]['user_name'];
}

function get_player_by_coord($coord)
{
    $temp = explode(":",$coord);
    $g = $temp[0];
    $s = $temp[1];
    $r = $temp[2];
    
    $requete = " select player from ".TABLE_UNIVERSE." where galaxy = '".(int)$g."' and  system = '".(int)$s."' and  `row` = '".(int)$r."' ;  ";
    $retour = my_assoc($requete);
    
    return $retour[0]['player'];
}