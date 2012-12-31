<?php
if (!defined('IN_SPYOGAME')) {
	die("Hacking attempt");
}

function import_re($spyed_all_coord_p, $spyed_last_update,$spyed_id)
{
    // fonction principale d importation des res dans l espaces galaxie
   // pour chaque coordonnées :
   foreach($spyed_all_coord_p as $c) 
   {
    // on recherche tous les re correspondants
    $res = find_re($c['coord'],$spyed_last_update);
    
   /// on bouvle sur les re 
   foreach($res as $re)
   {
    $is_lune = is_lune($re);
  import_bat($re , $c , $is_lune,$spyed_id);
  import_def($re , $c , $is_lune,$spyed_id);
  //import_tec($re , $c , $coord);
 // import_flotte($re , $c , $coord);
    //var_dump($re);    
    echo '<br />';
   }
    
    
    
    
    
    
    
   } 
    
}


function find_re($coord,$spyed_last_update)
{
    global $db;
    $requete = "select * from ".TABLE_PARSEDSPY." where coordinates = '".$coord."' and dateRE > ".$spyed_last_update." order by dateRE asc";
    $retour =my_assoc($requete);
    if ($db->sql_numrows()<1){ echo 'Aucun Re a importer en '.$coord.'<br />';}
    echo $db->sql_numrows().' RE a importer en  '.$coord.'<br />';
    return $retour;
}

function is_lune($re)
{
    $is_lune = false;
    // il s agit d une lune uniquement si les batiments speciaaux lunes sont présent  et que dans le nom il y a lune de present.
    //erratum\cpas desoin d avoir le nom
    if ($re['BaLu']>0){ return true;}
    return $is_lune;
}

function find_planete_id_by_coord($is_lune,$c,$spyed_id)
{
    $requete =  "Select planet_id from ".EMSPYRE_USER_BUILDING." ";
    $requete .= " where ";
    $requete .=  " coordinates = '".$c['coord']."'  ";
     if ($is_lune)
    {
         $requete .= " and planet_id > 200 ";
    }
    else
    {
         $requete .= " and planet_id < 200 ";
    }
    $retour =my_assoc($requete);
    return $retour[0]['planet_id'];
}

function import_bat($re , $c , $is_lune ,$spyed_id )
{
    global $db;
   
    
    $requete = " UPDATE ".EMSPYRE_USER_BUILDING." ";
    $requete .= " SET ";
    $requete .= " planet_name = '".$re['planet_name']."'   ";
    // la partie batiment uniquement si on la voit ...
    if ($re['M']>0)
    {
    $requete .= " ,  ";
    $requete .= " Sat = '".$re['SAT']."' ,  ";
    $requete .= " M = '".$re['M']."' ,  ";
    $requete .= " C = '".$re['C']."' ,  ";
    $requete .= " D = '".$re['D']."' ,  ";
    $requete .= " CES = '".$re['CES']."' ,  ";
    $requete .= " CEF = '".$re['CEF']."' ,  ";
    $requete .= " UdR = '".$re['']."' ,  ";
    $requete .= " UdN = '".$re['UdN']."' ,  ";
    $requete .= " CSp = '".$re['CSp']."' ,  ";
    $requete .= " HM = '".$re['HM']."' ,  ";
    $requete .= " HC = '".$re['HC']."' ,  ";
    $requete .= " HD = '".$re['HD']."' ,  ";
    $requete .= " CM = '".$re['CM']."' ,  ";
    $requete .= " CC = '".$re['CC']."' ,  ";
    $requete .= " CD = '".$re['CD']."' ,  ";
    $requete .= " Lab = '".$re['Lab']."' ,  ";
    $requete .= " Ter = '".$re['Ter']."' ,  ";
    $requete .= " DdR = '".$re['DdR']."' ,  ";
    $requete .= " Silo = '".$re['Silo']."' ,  ";
    $requete .= " BaLu = '".$re['BaLu']."' ,  ";
    $requete .= " Pha = '".$re['Pha']."' ,  ";
    $requete .= " PoSa = '".$re['PoSa']."'   ";
    
    }
   
    
    
    /// where clause
    $requete .= " where " ;
    $requete .= " user_id = '".$spyed_id."' ";
    $requete .= " and coordinates = '".$c['coord']."' ";
    if ($is_lune)
    {
         $requete .= " and planet_id > 200 ";
    }
    else
    {
         $requete .= " and planet_id < 200 ";
    }
 
    
   
  
    $db->sql_query($requete);
    echo $c['coord'].' Importation Batiment oki <br />';
}


function import_def($re , $c , $is_lune ,$spyed_id )
{
    global $db;
  //  var_dump($re);
   $planete_id =   find_planete_id_by_coord($is_lune,$c,$spyed_id);
   // la partie def uniquement si on la voit ...
    if ($re['LM']>0)
    {
       $requete = " replace into  ".EMSPYRE_USER_DEFENCE." ";
   $requete .= " ( ";
    $requete .= " user_id , planet_id , LM , LLE , LLO , CG , AI , LP , PB , GB , MIC , MIP";
   $requete .= " ) ";
  $requete .= " Values ";
    $requete .= " ( ";
     $requete .= " ".$spyed_id."  , ".$planete_id." , ".$re['LM']."  , ".$re['LLE']."  , ".$re['LLO']." , ".$re['CG']." , ".$re['AI']." , ".$re['LP']." , ".$re['PB']." , ".$re['GB']." , ".$re['MIC']." , ".$re['MIP']."  ";
     $requete .= " ) ";
  
    $db->sql_query($requete);   
       echo $c['coord'].' Importation def oki <br />'; 
   }
}


function where_clause()
{
    
}





