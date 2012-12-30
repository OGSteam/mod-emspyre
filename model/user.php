<?php
if (!defined('IN_SPYOGAME')) {
	die("Hacking attempt");
}


function get_user_by_id($id)
{
    $requete = " select user_name from ".TABLE_USER." where user_id = '".(int)$id."' ";
    $retour = my_assoc($requete);
    
    return $retour[0]['user_name'];
}

function create_espace_perso_moon($spyed_id, $spyed_all_coord_m)
{
foreach($spyed_all_coord_m as $c) 
{
    // premiere lune 
    echo "<br />";
   // on regarde que la planete correspondante existe ( sinon c une grosse farce ...)
   $exist = moon_exist($c['coord'],$spyed_id);
   if (!$exist)
   {
    // on recupere l id de la planete ( on ajoutera 100 pour la lune)
    echo 'création espace perso lune :  '.$c['coord'].'  ';
    $emplacement_libre = find_planete_mere_of_moon($c['coord'],$spyed_id);
    echo ' emplacement libre : '.$emplacement_libre;
    set_plapla($spyed_id,$c['coord'],$emplacement_libre);
    echo '... OK';
    
   }
   else
   {
     
        echo 'Lune existante : '.$c['coord'] ; 
    
   }
    
}
}


function create_espace_perso_planete($spyed_id, $spyed_all_coord_p)
{
    // il faut verifier si une planete existe ou pas dans l espace perso
foreach($spyed_all_coord_p as $c) 
{ 
    // premiere planete 
    echo "<br />";
    $exist = planete_exist($c['coord'],$spyed_id);
    // cf http://wiki.ogame.org/index.php/Tutorial:Colonisation
    if (!$exist)
    {
      
        echo 'création espace perso planete :  '.$c['coord'].'  ';
          /// avant de creer la planete on trouve le premier emplacement libre
        $emplacement_libre = find_first_emplacement_free($spyed_id);
        echo 'emplacement libre :'.$emplacement_libre;
        set_plapla($spyed_id,$c['coord'],$emplacement_libre);
        echo '... OK';
       
    }
    {
        echo 'Planete existante : '.$c['coord'] ; 
    }
}
    
}


function planete_exist($coord,$spyed_id)
{
    global $db;
    $retour = false;
    
    $requete = "select * from ".EMSPYRE_USER_BUILDING." where coordinates = '".$coord."' and user_id = ".(int)$spyed_id.";";
    $result = $db->sql_query($requete);
   
    if ($db->sql_numrows()>0){ return true;}
    return $retour;
    
}

function moon_exist($coord,$spyed_id)
{
    global $db;
    $retour = false;
    
    $requete = "select * from ".EMSPYRE_USER_BUILDING." where coordinates = '".$coord."' and user_id = ".(int)$spyed_id." and planet_id > 200 ;";
    $result = $db->sql_query($requete);
   
    if ($db->sql_numrows()>0){ return true;}
    return $retour;
    
}


function find_first_emplacement_free($spyed_id)
{
    global $db;
    // premier emplacement libre
    for ($first_emplacement = 101 ; $first_emplacement <= 120 ; $first_emplacement++) // on limite pour eviter la boucle infini
   {
      $requete = " select planet_id from ".EMSPYRE_USER_BUILDING." where  planet_id = '".(int)$first_emplacement."' and user_id = '".(int)$spyed_id."'	";
        $result = $db->sql_query($requete);
       if ($db->sql_numrows()<1){ return $first_emplacement ;} /// si pas de retour c que l emplacement est libre :p
          
   }
   return 0;
    
}

function set_plapla($spyed_id,$coord,$emplacement_libre)
{
    global $db;
    $temperature = get_temperature_by_coord($coord);
    $field = get_diametre_by_coord($coord);
    
    $requete =  "INSERT INTO  ".EMSPYRE_USER_BUILDING." "; 
    $requete .=  " (user_id, planet_id, planet_name, coordinates, fields, temperature_min, temperature_max)  " ; 
    $requete .= "VALUES ";
    $requete .= " (".$spyed_id.", ".$emplacement_libre.", '".$emplacement_libre."', '".$coord."', ".$field.", ".$temperature[0].", ".$temperature[1].");";
    $result = $db->sql_query($requete);
    
    return true;
    
 
    
    
}

function find_planete_mere_of_moon($coord,$spyed_id)
{
   global $db;
       $requete = " select planet_id from ".EMSPYRE_USER_BUILDING." where  coordinates = '".$coord."' and user_id = '".(int)$spyed_id."'	";
        $retour = my_assoc($requete); 
       
        if ($db->sql_numrows()>1){ return 0 ;} /// si pas de retour c que l emplacement est libre :p
     else
     {
        $id = ($retour[0]['planet_id'] + 100) ;
       
        return $id;
        
     }
          
    
    
}

function get_last_update($spyed_id)
{
     $requete = " select * from ".EMSPYRE_USER."  where spyed_id = ".(int)$spyed_id." ";
    $retour = my_assoc($requete);
     return $retour[0]['datadate'];
}



