<?php



if (!defined('IN_SPYOGAME')) {

    die("Hacking attempt");

}




 // includes classes
include("mod/emspyre/common.php");

 drop_table();
    

$mod_uninstall_name = "emspyre";
$table_name = array();



uninstall_mod ($mod_uninstall_name,$table_name);



?>

