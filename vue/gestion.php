<?php 
if (!defined('IN_SPYOGAME')) {
	die("Hacking attempt"); }


 $player = get_all_player_spyed();
 
 
?>
    
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
        <th>voir</th>
	   <th>Supprimer</th>
		</tr>
        
        <?php foreach ($player as $p) :?>
          <tr>
          <td><?php echo get_user_by_id($p['user_id']);?></td>
          <td><?php echo $p['coord'];?></td>
           <td><?php echo get_player_by_coord($p['coord']);?></td>
        <td><a href="index.php?action=emspyre&subaction=voir&else=voir&id=<?php echo $p['coord'];?>" ><img src="images/zoom_in.png" title="voir" /></a></td>
        <td><a href="index.php?action=emspyre&subaction=gestion&else=del_player&id=<?php echo $p['coord'];?>" ><img src="images/drop.png" title="Supprimer la surveillance" /></a></td>
          </tr>
          <?php endforeach; ?>
      	</table>
    
    
   

    