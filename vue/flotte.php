<?php if (!defined( 'IN_SPYOGAME')) { die( "Hacking attempt"); } 

?>
<script src="<?php echo FOLDER_JS;?>flotte.js" type="text/javascript"></script>
<?php
$id = (int)$pub_id;
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


//var_dump($flotte);
?>
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
		</tr>
	</table>
    
    
<script type="text/javascript">
update_page();
</script>