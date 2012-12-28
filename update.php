<?php

  


if (!defined('IN_SPYOGAME')) {

    die("Hacking attempt");

}

global $db, $table_prefix;



//On récupère la version actuel du mod	

$mod_folder = "emspyre";

$mod_name = "emspyre";

 // includes classes
include("mod/".$mod_folder."/common.php");
create_table();

update_mod($mod_folder, $mod_name);





?>

