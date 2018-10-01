<?php


if (!defined('IN_SPYOGAME')) {

    die("Hacking attempt");

}


$is_ok = false;
$mod_folder = "emspyre";
$is_ok = install_mod($mod_folder);

if ($is_ok == true) {
    include("mod/emspyre/common.php");
    create_table();
} else {
    echo "<script>alert('Désolé, un problème a eu lieu pendant l'installation, corrigez les problèmes survenue et réessayez.');</script>";
}


