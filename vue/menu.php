<?php
if (!defined('IN_SPYOGAME'))
    die("Hacking attempt"); // Pas d'accès direct

function generate_menu($pub_subaction = "")
{
    global $pub_id;

    echo "<table>";
    echo '<tr align="center">';


    if ($pub_subaction != "gestion") {
        echo "\t\t\t" . "<td class='c' width='150' onclick=\"window.location = 'index.php?action=emspyre&subaction=gestion';\">";
        echo "<a style='cursor:pointer'><span style=\"color: lime; \">Gestion</span></a>";
        echo "</td>";

        if (isset($pub_id)) {
            echo "\t\t\t" . "<td class='c' width='150' onclick=\"window.location = 'index.php?action=emspyre&subaction=voir&else=voir&id=" .
                $pub_id . "';\">";
            echo "<a style='cursor:pointer'><span style=\"color: lime; \">Vue empire</span></a>";
            echo "</td>";

             echo "\t\t\t" . "<td class='c' width='150' onclick=\"window.location = 'index.php?action=emspyre&subaction=stat&else=voir&id=" .
                $pub_id . "';\">";
            echo "<a style='cursor:pointer'><span style=\"color: lime; \">Vue statistiques</span></a>";
            echo "</td>";

           // echo "\t\t\t" . "<td class='c' width='150' onclick=\"window.location = 'index.php?action=emspyre&subaction=simu&else=voir&id=" .$pub_id . "';\">";
           // echo "<a style='cursor:pointer'><font color='lime'>Vue simulation</font></a>";
           // echo "</td>";

            echo "\t\t\t" . "<td class='c' width='150' onclick=\"window.location = 'index.php?action=emspyre&subaction=flotte&else=voir&id=" .
                $pub_id . "';\">";
            echo "<a style='cursor:pointer'><span style=\"color: lime; \">Vue flotte</span></a>";
            echo "</td>";



            echo "\t\t\t" . "<td class='c' width='150' onclick=\"window.location = 'index.php?action=emspyre&subaction=update&else=update&id=" .
                $pub_id . "';\">";
            echo "<a style='cursor:pointer'><span style=\"color: lime; \">Mise à jour</span></a>";
            echo "</td>";
        }


    } else {
        echo "\t\t\t" . "<th width='150'>";
        echo "<a>Gestion</a>";
        echo "</th>";
    }


    echo '	</tr>';
    echo '</table>';


}
