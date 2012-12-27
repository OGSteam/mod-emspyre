<?php




if (!defined('IN_SPYOGAME')) die("Hacking attempt"); // Pas d'accès direct

global $db, $table_preffix;


require_once("views/page_header.php");

$user_empire = user_get_empire();

$user_building = $user_empire["building"];
$user_defence = $user_empire["defence"];
$user_technology = $user_empire["technology"];


$nb_plapla =  find_nb_planete_user();

// on va réordonner tout ca
$account = array();
$j=0;
$i=0;

//$account = inverse_array_empire($user_building,$nb_plapla,100);
//$account = inverse_array_empire($user_defence,$nb_plapla,100);
//$account = array_merge($account, inverse_array_empire($user_defence,$nb_plapla,100) ); // ajout defense
//$account = array_merge($account, inverse_array_empire($user_technology,$nb_plapla,100) ); // ajout techno

//$futur_tab= add_first_colonne($user_technology);
/// faut faire tableau avec
/// premiere ligne les noms
/// premiere colonne les noms

//foreach($user_empire["building"] as $cc => $ccc)



var_dump($futur_tab);



//affichage
foreach($futur_tab as $count => $count_bis)
{
    echo '[tr]';
   foreach( $count_bis as $c)
    {
        echo '[td]';
         echo $c;
          echo '[/td]';
    }
    //echo $count ;
    echo '[/tr]';
    
}


require_once("views/page_tail.php"); //on inclus la queue d'ogspy


//Voila le mod est fini ! Pas trop triste ? :D





function inverse_array_empire($array , $nb_plapla , $step_planete)
{
    $account = array();
    for ($i=101 ; $i<=$nb_plapla+100 ; $i++) 
{
    foreach($array[$i] as $clef => $value)
    {   
        $account[$clef][] = $value;
    }
     
   // echo '<br />';
   
 }
 return  $account;
}

function add_first_colonne($account)
{
    $futur_tab= array();
    foreach($account as $count => $count_bis)
{
   array_unshift($count_bis,$count) ; // on ajoute la premiere colonne
   $futur_tab[] = $count_bis ;
   }
return $futur_tab;
}
?>

