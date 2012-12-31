<?php
if (!defined('IN_SPYOGAME')) {
	die("Hacking attempt");
}


function get_all_player_spyed()
{
    
    $requete = "select *  from ".EMSPYRE_USER."";
    $retour =  my_assoc($requete);
    return $retour;
   
    }

function del_player_for_spy($coord)
{
    global $db ; 
    $requete = "delete  from ".EMSPYRE_USER." where psyed_id = '".$db->sql_escape_string($coord)."' ";
 
    $db->sql_query($requete);
    }

function add_player_for_spy($g,$s,$r)
{
    global $db ;
    // on verifi l existance d un joueur a ses coodonné
    $requete = "select * from ".TABLE_UNIVERSE." where galaxy = '".(int)$g."' and system = '".(int)$s."' and `row` = '".(int)$r."' ";
    $result = $db->sql_query($requete);
    $all_is_possible = false ;
    $player = '';
    if ($db->sql_numrows() <1){ return null ;}
  while ($row =  $db->sql_fetch_assoc($result))
   {
    $all_is_possible = true ;
    $player = $row['player'];
   }
    if ($all_is_possible ==  false){return null ;}
    if ($player == null ) {return null; }
    if (  $player == '' ) {return null; }
   
   
   // toutes les verifs sont faites, on peut inserer
   global $user_data;
   //var_dump($user_data);
   $requete = " replace into ".EMSPYRE_USER." ( user_id , coord ) VALUES (".$user_data['user_id'].",'".$g.":".$s.":".$r."');";
    $db->sql_query($requete);
    
    
    
}
function get_name_by_spyed_id($spied_id)
{
   // on cherche les coord 
   $coord =  get_coord_by_spyed_id($spied_id);
   // ensuite on trouve le nom
   $name = get_player_by_coord($coord);
    return $name ;
}

function get_player_by_coord($coord)
{
    $my_coord = split_coord($coord);

    $g = $my_coord['g'];
    $s = $my_coord['s'];
    $r = $my_coord['r'];
    
    $requete = " select player from ".TABLE_UNIVERSE." where galaxy = '".(int)$g."' and  system = '".(int)$s."' and  `row` = '".(int)$r."' ;  ";
    $retour = my_assoc($requete);
    
    return $retour[0]['player'];
}


function get_coord_by_spyed_id($spyed_id)
{
    $requete = "select * from ".EMSPYRE_USER." where spyed_id = '".(int)($spyed_id)."' ; ";
    $retour = my_assoc($requete);
    return $retour[0]['coord'];
}


function get_all_coord_p_by_pseudo($pseudo)
{
    $requete = " select CONCAT(galaxy,':',system,':',`row`) as coord from ".TABLE_UNIVERSE." where player = '".$pseudo."'  ;  ";
    $retour = my_assoc($requete);
      return $retour;
    
}

function get_all_coord_m_by_pseudo($pseudo)
{
    $requete = " select CONCAT(galaxy,':',system,':',`row`) as coord from ".TABLE_UNIVERSE." where player = '".$pseudo."' and  moon = '1' ;  ";
    $retour = my_assoc($requete);
      return $retour;
    
}


?>