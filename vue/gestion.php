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
<td class="c_recherche" colspan="5">Mise en surveillance joueur</th>
</tr>
<tr>
<th>Coordonnées PM </td>
<th>Galaxie : <input name="g" type="text" maxlength="2" size="3" /></td>
<th>Systeme : <input name="s" type="text" maxlength="3" size="3" /></td>
<th>Planète : <input name="r" type="text" maxlength="2" size="3" /></td>
<th><input type="submit" value="Surveiller" /></td>
</tr>
</tbody>
</form>
</table>
<br>
	<table>
		<tr>
        <td class="c">Utilisateur</th>
				<td class="c">Coord PM</th>
				<td class="c">Joueur surveillé</th>
        <td class="c">Dernière mise à jour</th>
        <td class="c">Mettre à jour</th>
        <td class="c">Voir</th>
	    	<td class="c">Supprimer</th>
		</tr>
         <?php foreach ($player as $p) :?>
    <tr>
        <th><?php echo get_user_by_id($p['user_id']);?></td>
        <th><?php echo $p['coord'];?></td>
        <th><?php echo get_player_by_coord($p['coord']);?></td>
        <th><?php echo date("Y-m-d H:i:s" ,$p['datadate']);?></td>
        <th style="text-align:center;"><a href="index.php?action=emspyre&subaction=update&else=update&id=<?php echo $p['spyed_id'];?>"><img src="mod/emspyre/img/ic_refresh_green_24dp.png" title="voir" /></a></td>
        <th style="text-align:center;"><a href="index.php?action=emspyre&subaction=voir&else=voir&id=<?php echo $p['spyed_id'];?>"><img src="images/zoom_in.png" title="voir" /></a></td>
        <th style="text-align:center;"><a href="index.php?action=emspyre&subaction=gestion&else=del_player&id=<?php echo $p['spyed_id'];?>" ><img src="images/drop.png" title="Supprimer la surveillance" /></a></td>
    </tr>
          <?php endforeach; ?>
  </table>
