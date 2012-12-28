<?php 
if (!defined('IN_SPYOGAME')) {
	die("Hacking attempt");
    
        
   $data = get_all_player_spyed();
   var_dump($data);
}

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
        <tr>
        <?php   
       
        ?>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        </tr>
	</table>