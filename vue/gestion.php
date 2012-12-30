<?php 
if (!defined('IN_SPYOGAME')) {
	die("Hacking attempt"); }


 $player = get_all_player_spyed();
 
 
?>
    
<br />
to do list ( feuille de route ) :
<br /><br />
=> vue empire du joueur recherché<br />
=> update de l empire du joueur via les re depuis la xéme date<br />
=> fonction de sync empire ( suppression de planete n existant plus .... )<br />
=> réécrire les fonctions importante de la vue empire ( accepter les ids )<br />
=> ajouter les flottes dans la vue empire<br />
=> voir comment recuperer les point de l investissement empire ( cf stat )<br />
=> faire une recherche pour estimer flotte manquante ( pt manquant !!!! )<br />

<br />
<table>
<form method="POST" action="index.php?action=emspyre&subaction=gestion&else=add_player">
<input type="hidden" name="t" value="t" />
<tbody>
<tr>
<th class="c_recherche" colspan="5">Mise en surveillance joueur</th>
</tr>
<tr>
<td >Coordonn&eacute;e PM </td>
<td>Galaxie : <input name="g" type="text" maxlength="2" size="3" /></td>
<td>Systeme : <input name="s" type="text" maxlength="3" size="3" /></td>
<td>Row : <input name="r" type="text" maxlength="2" size="3" /></td>
<td><input type="submit" value="Ajouter" /></td>
</tr>
</tbody>
</form>
</table>
<br />
      
    
	<table>
		<tr>
        <th>Utilisateur</th>
		<th>Coord pm</th>
		<th>Joueur surveill&eacute;</th>
        <th>Derniere mise a jour</th>
        <th>mettre a jour</th>
        <th>voir</th>
	   <th>Supprimer</th>
		</tr>
         <?php foreach ($player as $p) :?>
              <tr>
          <td><?php echo get_user_by_id($p['user_id']);?></td>
          <td><?php echo $p['coord'];?></td>
           <td><?php echo get_player_by_coord($p['coord']);?></td>
        <td><?php echo date("Y-m-d H:i:s" ,$p['datadate']);?></td>
         <td><a href="index.php?action=emspyre&subaction=update&else=update&id=<?php echo $p['spyed_id'];?>" ><img src="images/save.png" title="voir" /></a></td>
        <td><a href="index.php?action=emspyre&subaction=voir&else=voir&id=<?php echo $p['spyed_id'];?>" ><img src="images/zoom_in.png" title="voir" /></a></td>
        <td><a href="index.php?action=emspyre&subaction=gestion&else=del_player&id=<?php echo $p['spyed_id'];?>" ><img src="images/drop.png" title="Supprimer la surveillance" /></a></td>
          </tr>
          <?php endforeach; ?>
      	</table>
    
    
   

    