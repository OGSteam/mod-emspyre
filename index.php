<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt"); // Pas d'acc�s direct
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
if ($pub_subaction == 'update')
{ 
    if (isset($pub_id)){
    include(FOLDER."vue/update.php");
}}

if ($pub_subaction == 'voir')
{ 
    include(FOLDER."vue/voir.php");
}

if ($pub_subaction == 'stat')
{ 
    include(FOLDER."vue/stat.php");
}

if ($pub_subaction == 'simu')
{ 
    include(FOLDER."vue/simu.php");
}

if ($pub_subaction == 'flotte')
{ 
    include(FOLDER."vue/flotte.php");
}

if ($pub_subaction == 'presence')
{ 
    include(FOLDER."vue/presence.php");
}

if ($pub_subaction == 'prod')
{ 
    include(FOLDER."vue/prod.php");
}



require_once("views/page_tail.php"); //on inclus la queue d'ogspy


//Voila le mod est fini ! Pas trop triste ? :D

