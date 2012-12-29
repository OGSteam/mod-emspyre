<?php 
if (!defined('IN_SPYOGAME')) {
	die("Hacking attempt");
}



function my_assoc($requete)
{
     global $db;
    $result = $db->sql_query($requete);
    $retour = array();    
    while ($row = $db->sql_fetch_assoc($result)) {
       $retour[] = $row;
              
           }
          
    return $retour;
   
    }


