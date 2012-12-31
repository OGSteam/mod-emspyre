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

function set_last_update($datadate , $spyed_id )
{
    global $db;
    $requete = "UPDATE ".EMSPYRE_USER." set datadate =  ".(int)$datadate." where spyed_id = ".$spyed_id." ";
    $db->sql_query($requete);
}



function MY_user_get_empire($id)
{
    global $db;
    /// on va reprendre les memes variables
    $user_data["user_id"] = $id;


    $planet = array(false, "user_id" => "", "planet_name" => "", "coordinates" => "",
        "fields" => "", "fields_used" => "", "temperature_min" => "", "temperature_max" =>
        "", "Sat" => "", "M" => 0, "C" => 0, "D" => 0, "CES" => 0, "CEF" => 0, "UdR" =>
        0, "UdN" => 0, "CSp" => 0, "HM" => 0, "HC" => 0, "HD" => 0, "CM" => 0,"CC" => 0,"CD" => 0,
        "Lab" => 0, "Ter" => 0, "Silo" => 0, "BaLu" => 0, "Pha" => 0, "PoSa" => 0, "DdR" => 0);

    $defence = array("LM" => 0, "LLE" => 0, "LLO" => 0, "CG" => 0, "AI" => 0, "LP" =>
        0, "PB" => 0, "GB" => 0, "MIC" => 0, "MIP" => 0);


    // pour affichage on selectionne 9 planetes minis

    if (MY_find_nb_planete_user( $user_data["user_id"]) < 9) {
        $nb_planete = 9;
    } else {
        $nb_planete = MY_find_nb_planete_user( $user_data["user_id"]);
    }


    // on met les planete a 0
    for ($i = 101; $i <= ($nb_planete + 100); $i++) {
        $user_building[$i] = $planet;
    }

    // on met les lunes a 0
    for ($i = 201; $i <= ($nb_planete + 200); $i++) {
        $user_building[$i] = $planet;
    }


    $request = "select planet_id, planet_name, `coordinates`, `fields`, temperature_min, temperature_max, Sat, M, C, D, CES, CEF, UdR, UdN, CSp, HM, HC, HD, CM, CC, CD, Lab, Ter, Silo, BaLu, Pha, PoSa, DdR";
    $request .= " from " . EMSPYRE_USER_BUILDING;
    $request .= " where user_id = " . $user_data["user_id"];
    $request .= " order by planet_id";
    $result = $db->sql_query($request);


    //	$user_building = array_fill(101,$nb_planete , $planet);
    while ($row = $db->sql_fetch_assoc($result)) {
        $arr = $row;
        unset($arr["planet_id"]);
        unset($arr["planet_name"]);
        unset($arr["coordinates"]);
        unset($arr["fields"]);
        unset($arr["temperature_min"]);
        unset($arr["temperature_max"]);
        unset($arr["Sat"]);
        $fields_used = array_sum(array_values($arr));


        $row["fields_used"] = $fields_used;
        $user_building[$row["planet_id"]] = $row;
        $user_building[$row["planet_id"]][0] = true;
    }


    $request = "select Esp, Ordi, Armes, Bouclier, Protection, NRJ, Hyp, RC, RI, PH, Laser, Ions, Plasma, RRI, Graviton, Astrophysique";
    $request .= " from " . EMSPYRE_USER_TECHNOLOGY;
    $request .= " where user_id = " . $user_data["user_id"];
    $result = $db->sql_query($request);

    $user_technology = $db->sql_fetch_assoc($result);

    $request = "select planet_id, LM, LLE, LLO, CG, AI, LP, PB, GB, MIC, MIP";
    $request .= " from " . EMSPYRE_USER_DEFENCE;
    $request .= " where user_id = " . $user_data["user_id"];
    $request .= " order by planet_id";
    $result = $db->sql_query($request);


    // on met les def planete a 0
    for ($i = 101; $i <= ($nb_planete + 100); $i++) {
        $user_defence[$i] = $defence;
    }

    // on met les def lunes a 0
    for ($i = 201; $i <= ($nb_planete + 200); $i++) {
        $user_defence[$i] = $defence;
    }

    //$user_defence = array_fill(1, $nb_planete_lune, $defence);
    while ($row = $db->sql_fetch_assoc($result)) {
        $planet_id = $row["planet_id"];
        unset($row["planet_id"]);
        $user_defence[$planet_id] = $row;
    }

    return array("building" => $user_building, "technology" => $user_technology,
        "defence" => $user_defence, );
}
/**
 * Récuperation du nombre de  planete de l utilisateur
 * TODO => cette fonction sera a mettre en adequation avec astro 
 * ( attention ancien uni techno a 1 planete mais utilisateur 9 possible  !!!!!)
 */
function MY_find_nb_planete_user($id)
{
    global $db;
     /// on va reprendre les memes variables
    $user_data["user_id"] = $id;


    $request = "select planet_id ";
    $request .= " from " . EMSPYRE_USER_BUILDING;
    $request .= " where user_id = " . $user_data["user_id"];
    $request .= " and planet_id < 199 ";
    $request .= " order by planet_id";

    $result = $db->sql_query($request);

    //mini 9 pour eviter bug affichage
    if ($db->sql_numrows($result) <= 9)
        return 9;

    return $db->sql_numrows($result);

}
function MY_find_nb_moon_user($id)
{
    global $db;
     /// on va reprendre les memes variables
    $user_data["user_id"] = $id;


    $request = "select planet_id ";
    $request .= " from " . EMSPYRE_USER_BUILDING;
    $request .= " where user_id = " . $user_data["user_id"];
    $request .= " and planet_id > 199 ";
    $request .= " order by planet_id";

    $result = $db->sql_query($request);

    //mini 9 pour eviter bug affichage
    if ($db->sql_numrows($result) <= 9)
        return 9;

    return $db->sql_numrows($result);

}


