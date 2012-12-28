<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt"); // Pas d'accès direct

function generate_menu($pub_subaction = "")
{

echo		"<table>";
echo		'<tr align="center">';


if ($pub_subaction != "gestion") {
	echo "\t\t\t"."<td class='c' width='150' onclick=\"window.location = 'index.php?action=home&subaction=Gestion';\">";
	echo "<a style='cursor:pointer'><font color='lime'>Gestion</font></a>";
	echo "</td>";
}
else {
	echo "\t\t\t"."<th width='150'>";
	echo "<a>Gestion</a>";
	echo "</th>";
}



echo 	'	</tr>';
echo		'</table>';
        
        
        }
        ?>
