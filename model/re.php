<?php
if (!defined('IN_SPYOGAME')) {
	die("Hacking attempt");
}

function import_re($spyed_all_coord_p, $spyed_last_update)
{
    // fon,ction principale d importation des res dans l espaces galaxie
   // pour chaque coordonnées :
   foreach($spyed_all_coord_p as $c) 
   {
    // on recherche tous les re correspondants
    $res = find_re($c['coord'],$spyed_last_update);
   // var_dump($res); 
    //echo '<br />';
    
    
    
    
    
    
    
   } 
    
}


function find_re($coord,$spyed_last_update)
{
    global $db;
    $requete = "select * from ".TABLE_PARSEDSPY." where coordinates = '".$coord."' and dateRE > ".$spyed_last_update."";
    $retour =my_assoc($requete);
    return $retour;
}











