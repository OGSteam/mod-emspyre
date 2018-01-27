<?php if (!defined( 'IN_SPYOGAME')) { die( "Hacking attempt"); } 

?>
<script src="<?php echo FOLDER_JS;?>flotte.js" type="text/javascript"></script>
<?php
$id = (int)$pub_id;
$user_stat_name = get_name_by_spyed_id($id) ;
$last_pts_general = get_last_pts_general_by_stat_name($user_stat_name);
$last_nb_flotte = get_last_nb_flotte_by_stat_name($user_stat_name);
//inutile puisque flotte + def + qq type de batiment $last_pt_flotte = get_last_pts_flotte_by_stat_name($user_stat_name);

$flotte = get_flotte($id);


$flotte_ids[] = array('SAT', 'Satellite solaire' ,0 ); /// a aller chercher : somme de tous les sat dans bulding
$flotte_ids[] = array('PT', 'Petit Transporteur' , $flotte['PT'] );
$flotte_ids[] = array('GT', 'Grand Transporteur' , $flotte['GT'] );
$flotte_ids[] = array('CLE', 'Chasseur Leger' , $flotte['CLE'] );
$flotte_ids[] = array('CLO', 'Chasseur Lourd' , $flotte['CLO'] );
$flotte_ids[] = array('CR', 'Croiseur' , $flotte['CR'] );
$flotte_ids[] = array('VB', 'Vaisseau de bataille' , $flotte['VB'] );
$flotte_ids[] = array('VC', 'Vaisseau de colonisation' , $flotte['VC'] );
$flotte_ids[] = array('REC', 'Recycleur' , $flotte['REC'] );
$flotte_ids[] = array('SE', 'Sonde espionnage' , $flotte['SE'] );
$flotte_ids[] = array('BMD', 'Bombardier' , $flotte['BMD'] );
$flotte_ids[] = array('DST', 'Destructeur' , $flotte['DST'] );
$flotte_ids[] = array('EDLM', 'EDLM' , $flotte['EDLM'] );
$flotte_ids[] = array('TRA', 'Traqueur' , $flotte['TRA'] );

$user_empire = my_user_get_empire($id);
//var_dump($user_empire);
$user_building = $user_empire["building"];
$user_defence = $user_empire["defence"];
$user_technology = $user_empire["technology"];

$nb_planete = my_find_nb_planete_user($id);
//var_dump($nb_planete);
$b = round(all_building_cumulate(array_slice($user_building, 0, $nb_planete)) /
    1000);
$d = round(all_defence_cumulate(array_slice($user_defence, 0, $nb_planete)) /
    1000);
$l = round(all_lune_cumulate(array_slice($user_building, $nb_planete, $nb_planete),
    array_slice($user_defence, $nb_planete, $nb_planete)) / 1000);
$t = round(all_technology_cumulate($user_technology) / 1000);
$f_calculé = $last_pts_general - $b - $d - $l - $t;


///var_dump($last["general_pts"]);
?>
<table>
<tr>
<td>

	<table>
		<tr>
			<td class="c">
			</td>
			<td class="c">
				Nombre scann&eacute;
			</td>
			<td class="c">
				Nombre estim&eacute; manquant
			</td>
			<td class="c">
				TOTAL
			</td>
		<td class="c">
				Total Points
			</td>
		</tr>
        

<?php foreach($flotte_ids   as $flotte_id ) : ?>
            <tr>
			<td class="c">
                <?php echo $flotte_id[1]; ?>
			</td>
			<th id="flotte_scanne_<?php echo $flotte_id[0];?>">
				 <?php echo $flotte_id[2]; ?>
			</th>
			<th>
				<input id="flotte_estime_<?php echo $flotte_id[0];?>" type='text' value='0' onchange='update_page()' />
			</th>
			<th id="flotte_flottes_<?php echo $flotte_id[0];?>">
				
			</th>
            <th id="flotte_flottes_points_<?php echo $flotte_id[0];?>">
				
			</th>
		</tr>
<?php endforeach; ?><tr>
			<td class="c">
                TOTAL
             </td>
			<th id="total_flotte_scanne">
				
			</th>
			<th id="total_flotte_estime">
				
			</th>
			<th id="total_flottes">
				
			</th>
		      <th id="total_flottes_points">
				
			</th>
		</tr>
	</table>
    </td>
<td>
<table>
<tr>
<td class="c" colspan="2">Information Stat</td>
</tr>
<tr>
<td class="c" >Points totaux classement</td>
<th id="vaisseaux_classement"><?php echo $last_pts_general;?></th>
</tr>
<tr>
<td class="c" >Nombre de vaisseaux classement</td>
<th><input id="nb_vaisseaux_classement" value="<?php echo $last_nb_flotte;?>" onchange='update_page()' /> </th>
</tr>
<tr>
<td class="c" colspan="2">Repartition des points connue</td>
</tr>

<tr>
<td class="c" >Points  Batiments</td>
<th> <?php echo $b; ?></th>
</tr>
</tr>
<tr>
<td class="c" >Points  Defenses</td>
<th> <?php echo $d; ?></th>
</tr>
<tr>
<td class="c" >Points  Flotte</td>
<th id="pts_flotte_calcule"> <?php echo $f_calculé;?> </th>
</tr>
<tr>
<td class="c" >Points  Technologies</td>
<th> <?php echo $t; ?> </th>
</tr>
<tr>
<td class="c" >Points  Lunes</td>
<th> <?php echo $l; ?> </th>
</tr>
<tr>
<td> </td>
<td> </td>
</tr>
<tr>
<td class="c" colspan="2">Analyse</td>
</tr>
<tr>
<td class="c" >points flotte manquante</td>
<th id="flotte_manquante_pt_a"> ?????</th>
</tr>
<tr>
<td class="c" >Nombre vaisseau manquant</td>
<th id="flotte_manquante_nb_a"> ?????</th>
</tr>
<tr>
<td class="c" colspan="2">Recherche</td>
</tr>
<tr>
<td class="c" colspan="2" >Nombre max possible de ce type :</td>
</tr>
<td>
<select name="nom_select" id="nom_select" onchange="re_calcul_max_vaisseaux();">

</select>
</td>
<th id="calcul_max_vaisseaux"> ?????</th>
</table>
</td>
</tr>
</table>
 <br />



    
<script type="text/javascript">
update_page();
create_option_value();
</script>