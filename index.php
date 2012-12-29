<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt"); // Pas d'accès direct
 // includes classes
include_once("mod/emspyre/common.php");


require_once("views/page_header.php");
// point d entree, sert de controleur...

// page par defaut
if (!isset($pub_subaction)) $pub_subaction = "gestion";
// on genere le menu
generate_menu($pub_subaction);


      
      
if ($pub_subaction == 'gestion')
{ 
   if (isset($pub_else))
   { 
    if ($pub_else == 'add_player'){add_player_for_spy((int)$pub_g,(int)$pub_s,(int)$pub_r);}
    if ($pub_else == 'del_player'){del_player_for_spy($pub_id);}
   }
  include(FOLDER."vue/gestion.php");
}
if ($pub_subaction == 'voir')
{ 
    include(FOLDER."vue/voir.php");
}









require_once("views/page_tail.php"); //on inclus la queue d'ogspy


//Voila le mod est fini ! Pas trop triste ? :D




?>

