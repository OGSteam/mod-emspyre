<?php

 



if (!defined('IN_SPYOGAME')) {

    die("Hacking attempt");

}



$is_ok = false;

$mod_folder = "emspyre";

$is_ok = install_mod ($mod_folder);

if ($is_ok == true)

	{

		//Ensuite, on cr�e les tables

	
	}

else

	{

		echo  "<script>alert('D�sol�, un probl�me a eu lieu pendant l'installation, corrigez les probl�mes survenue et r�essayez.');</script>";

	}

?>

