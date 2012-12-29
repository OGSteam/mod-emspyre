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
    $requete = "delete  from ".EMSPYRE_USER." where coord = '".$db->sql_escape_string($coord)."' ";
 
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



?>