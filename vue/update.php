<?php
if (!defined('IN_SPYOGAME')) {
	die("Hacking attempt");
}

// variable
$spyed_id = (int)$pub_id;
$psyed_coord_pm = '';
$spyed_id_name = "";
$spyed_all_coord_p = array();
$spyed_all_coord_m = array();
$spyed_last_update = get_last_update($spyed_id);




?>
Recherche du coord du joueur : <?php $psyed_coord_pm = get_coord_by_spyed_id($spyed_id); echo $psyed_coord_pm; ?><br />
Recherche du nom du joueur : <?php $spyed_id_name = get_player_by_coord($psyed_coord_pm); echo $spyed_id_name; ?><br />
recherche des planetes du joueur : <?php $spyed_all_coord_p = get_all_coord_p_by_pseudo($spyed_id_name); foreach($spyed_all_coord_p as $p){ echo " ".$p['coord']." ";}?> <br />
recherche des lunes du joueur : <?php $spyed_all_coord_m = get_all_coord_m_by_pseudo($spyed_id_name); foreach($spyed_all_coord_m as $p){ echo " ".$p['coord']." ";}?> <br />
creation de l espace perso : <?php echo create_espace_perso_planete($spyed_id,$spyed_all_coord_p) ; ?><br />
creation de l espace perso (lune) : <?php echo create_espace_perso_moon($spyed_id,$spyed_all_coord_m) ; ?><br />
derniere importation : <?php echo $spyed_last_update; ?><br />
importation  des re et constitution de l espace perso <?php  import_re( $spyed_all_coord_p, $spyed_last_update);import_re( $spyed_all_coord_m, $spyed_last_update) ;?>




