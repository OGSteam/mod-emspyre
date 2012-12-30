<?php

function get_user_by_id($id)
{
    $requete = " select user_name from ".TABLE_USER." where user_id = '".(int)$id."' ";
    $retour = my_assoc($requete);
    
    return $retour[0]['user_name'];
}




function create_espace_perso($spyed_all_coord_p)
{
    // il faut verifier si une planete existe ou pas dans l espace perso
foreach($spyed_all_coord_p as $c) 
{
    if (!planete_exist($spyed_all_coord_p['coord']))
    {
        // dans ce cas, : false, il faut creer espace perso et en estimer diamettre et temperature
        // on recherche le premier espace libre en fonction de id_planete ( sup a 100)
        
        
        
    }
}
    
}


function planete_exist($coord)
{
    global $db;
    $retour = false;
    
    $requete = "select coordinates from ".EMSPYRE_USER_BUILDING." where coordinates = '$coord';";
    $result = $db->sql_query($requete);
    if ($db->sql_numrows()>0){ return $true;}
    return $retour;
    
}