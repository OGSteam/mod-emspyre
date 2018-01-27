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
        echo "<a style='cursor:pointer'><font color='lime'>Gestion</font></a>";
        echo "</td>";

        if (isset($pub_id)) {
            echo "\t\t\t" . "<td class='c' width='150' onclick=\"window.location = 'index.php?action=emspyre&subaction=voir&else=voir&id=" .
                $pub_id . "';\">";
            echo "<a style='cursor:pointer'><font color='lime'>Vue empire</font></a>";
            echo "</td>";

             echo "\t\t\t" . "<td class='c' width='150' onclick=\"window.location = 'index.php?action=emspyre&subaction=stat&else=voir&id=" .
                $pub_id . "';\">";
            echo "<a style='cursor:pointer'><font color='lime'>Vue stat</font></a>";
            echo "</td>";

           // echo "\t\t\t" . "<td class='c' width='150' onclick=\"window.location = 'index.php?action=emspyre&subaction=simu&else=voir&id=" .$pub_id . "';\">";
           // echo "<a style='cursor:pointer'><font color='lime'>Vue simulation</font></a>";
           // echo "</td>";

            echo "\t\t\t" . "<td class='c' width='150' onclick=\"window.location = 'index.php?action=emspyre&subaction=flotte&else=voir&id=" .
                $pub_id . "';\">";
            echo "<a style='cursor:pointer'><font color='lime'>Vue flotte</font></a>";
            echo "</td>";



            echo "\t\t\t" . "<td class='c' width='150' onclick=\"window.location = 'index.php?action=emspyre&subaction=update&else=update&id=" .
                $pub_id . "';\">";
            echo "<a style='cursor:pointer'><font color='lime'>Mise &agrave; jour</font></a>";
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
?>
