<?php
if (!defined('IN_SPYOGAME')) {
    die("Hacking attempt");
}

function import_re($spyed_all_coord_p, $spyed_last_update, $spyed_id)
{
    // fonction principale d importation des res dans l espaces galaxie
    // pour chaque coordonnées :
    foreach ($spyed_all_coord_p as $c) {
        // on recherche tous les re correspondants
        $res = find_re($c['coord'], $spyed_last_update);

        /// on bouvle sur les re
        foreach ($res as $re) {
            $is_lune = is_lune($re);
            import_bat($re, $c, $is_lune, $spyed_id);
            import_def($re, $c, $is_lune, $spyed_id);
            import_techno($re, $c, $is_lune, $spyed_id);
            import_flotte($re, $c, $is_lune, $spyed_id);
          
            echo '<br />';
        }


    }
    
    // fin de le fonction inport_re, on va mettre le timestamp du jour pour eviter de rechercher sur de vieux re
    set_last_update(time(),$spyed_id);
}




function find_re($coord, $spyed_last_update)
{
    global $db;
    $requete = "select * from " . TABLE_PARSEDSPY . " where coordinates = '" . $coord .
        "' and dateRE > " . $spyed_last_update . " order by dateRE asc";
    $retour = my_assoc($requete);
    if ($db->sql_numrows() < 1) {
        echo 'Aucun Re a importer en ' . $coord . '<br />';
    }
    echo $db->sql_numrows() . ' RE a importer en  ' . $coord . '<br />';
    return $retour;
}

function is_lune($re)
{
    $is_lune = false;
    // il s agit d une lune uniquement si les batiments speciaaux lunes sont présent  et que dans le nom il y a lune de present.
    //erratum\cpas desoin d avoir le nom
    if ($re['BaLu'] > 0) {
        return true;
    }
    return $is_lune;
}

function find_planete_id_by_coord($is_lune, $c, $spyed_id)
{
    $requete = "Select planet_id from " . EMSPYRE_USER_BUILDING . " ";
    $requete .= " where ";
    $requete .= " coordinates = '" . $c['coord'] . "'  ";
    if ($is_lune) {
        $requete .= " and planet_id > 200 ";
    } else {
        $requete .= " and planet_id < 200 ";
    }
    $retour = my_assoc($requete);
    return $retour[0]['planet_id'];
}

function import_bat($re, $c, $is_lune, $spyed_id)
{
    global $db;


    $requete = " UPDATE " . EMSPYRE_USER_BUILDING . " ";
    $requete .= " SET ";
    $requete .= " planet_name = '" . $re['planet_name'] . "'   ";
    // la partie batiment uniquement si on la voit ...
    if ($re['M'] > 0) {
        $requete .= " ,  ";
        $requete .= " Sat = '" . $re['SAT'] . "' ,  ";
        $requete .= " M = '" . formatNonNegativ($re['M']) . "' ,  ";
        $requete .= " C = '" . formatNonNegativ($re['C']) . "' ,  ";
        $requete .= " D = '" . formatNonNegativ($re['D']) . "' ,  ";
        $requete .= " CES = '" . formatNonNegativ($re['CES']) . "' ,  ";
        $requete .= " CEF = '" . formatNonNegativ($re['CEF'] ). "' ,  ";
        $requete .= " UdR = '" . formatNonNegativ($re['UdR']) . "' ,  ";
        $requete .= " UdN = '" . formatNonNegativ($re['UdN']) . "' ,  ";
        $requete .= " CSp = '" . formatNonNegativ($re['CSp']) . "' ,  ";
        $requete .= " HM = '" . formatNonNegativ($re['HM']) . "' ,  ";
        $requete .= " HC = '" . formatNonNegativ($re['HC']) . "' ,  ";
        $requete .= " HD = '" . formatNonNegativ($re['HD']) . "' ,  ";
        //$requete .= " CM = '" . $re['CM'] . "' ,  ";
        //$requete .= " CC = '" . $re['CC'] . "' ,  ";
        //$requete .= " CD = '" . $re['CD'] . "' ,  ";
        $requete .= " CM = '0' ,  "; // invsible via RE
        $requete .= " CC = '0' ,  ";  // invsible via RE
        $requete .= " CD = '0' ,  ";  // invsible via RE
        $requete .= " Lab = '" . formatNonNegativ($re['Lab']) . "' ,  ";
        $requete .= " Ter = '" . formatNonNegativ($re['Ter']) . "' ,  ";
        $requete .= " DdR = '" . formatNonNegativ($re['DdR']) . "' ,  ";
        $requete .= " Silo = '" . formatNonNegativ($re['Silo']) . "' ,  ";
        $requete .= " BaLu = '" . formatNonNegativ($re['BaLu']) . "' ,  ";
        $requete .= " Pha = '" . formatNonNegativ($re['Pha']) . "' ,  ";
        $requete .= " PoSa = '" . formatNonNegativ($re['PoSa']) . "'   ";

    }

    /// where clause
    $requete .= " where ";
    $requete .= " user_id = '" . $spyed_id . "' ";
    $requete .= " and coordinates = '" . $c['coord'] . "' ";
    if ($is_lune) {
        $requete .= " and planet_id > 200 ";
    } else {
        $requete .= " and planet_id < 200 ";
    }


    $db->sql_query($requete);
    echo $c['coord'] . ' Importation Batiment oki <br />';
}


function formatNonNegativ($value)
{
    if ($value == -1){
        return 0;
    }
    else
    {
        return  $value;
    }
}




function import_def($re, $c, $is_lune, $spyed_id)
{
    global $db;
    //  var_dump($re);
    $planete_id = find_planete_id_by_coord($is_lune, $c, $spyed_id);
    // la partie def uniquement si on la voit ...
    if ($re['LM'] > -1) {
        $requete = " replace into  " . EMSPYRE_USER_DEFENCE . " ";
        $requete .= " ( ";
        $requete .= " user_id , planet_id , LM , LLE , LLO , CG , AI , LP , PB , GB , MIC , MIP";
        $requete .= " ) ";
        $requete .= " Values ";
        $requete .= " ( ";
        $requete .= " " . $spyed_id . "  
            , " . $planete_id . " 
            , " . formatNonNegativ($re['LM']) . "  , 
            " . formatNonNegativ($re['LLE']) . "  , 
            " . formatNonNegativ($re['LLO']) . " , 
            " .formatNonNegativ($re['CG']) . " , 
            " . formatNonNegativ($re['AI']) . " , 
            " . formatNonNegativ($re['LP']) . " , 
            " . formatNonNegativ($re['PB']) . " , 
            " . formatNonNegativ($re['GB']) . " , 
            " . formatNonNegativ($re['MIC']) . " , 
            " .  formatNonNegativ($re['MIP']) . "  ";
        $requete .= " ) ";

        $db->sql_query($requete);
        echo $c['coord'] . ' Importation def oki <br />';
    }
}


function import_techno($re, $c, $is_lune, $spyed_id)
{
      global $db;
      // il s agit d importer la techno betement ...
      // de toute facon e peut pas etre inferieur ...
       if ($re['Esp'] > -1) {
        $requete = " replace into  " . EMSPYRE_USER_TECHNOLOGY . " ";
        $requete .= " ( ";
        $requete .= " user_id , 	Esp,	Ordi,	Armes,	Bouclier,	Protection,	NRJ,	Hyp,	RC,	RI,	PH	,Laser,	Ions,	Plasma,	RRI	,Graviton,	Astrophysique";
        $requete .= " ) ";
        $requete .= " Values ";
        $requete .= " ( ";
        $requete .= " " . $spyed_id . " , " .  formatNonNegativ($re['Esp']) . "  ,    " .  formatNonNegativ($re['Ordi']) . "  , " .  formatNonNegativ($re['Armes']) . "  , 
        " .  formatNonNegativ($re['Bouclier']) . "  , " .  formatNonNegativ($re['Protection']) . "  ," .  formatNonNegativ($re['NRJ']) . "  ," .  formatNonNegativ($re['Hyp']) . "
        ," .  formatNonNegativ($re['RC']) . "," .  formatNonNegativ($re['RI']) . ", " .  formatNonNegativ($re['PH']) . ", " .  formatNonNegativ($re['Laser'] ). "
        , " .  formatNonNegativ($re['Ions'] ). ", " .  formatNonNegativ($re['Plasma']) . ",  " .  formatNonNegativ($re['RRI']) . ", " .  formatNonNegativ($re['Graviton']) . ",
           " . formatNonNegativ($re['Astrophysique'] ). "  ";
        $requete .= " ) ";

        $db->sql_query($requete);
        echo $c['coord'] . ' Importation techno oki <br />';
    }
    }

    function import_flotte_empty($spyed_id)
    {
        global $db;
        // on importe que si superieur a ce qui se trouve en base
        //pas besoin de  if ($re['PT'] > -1) { => de toute facon inopérant car si pas de pt mais autre chose à la place .... :s
        //  if ($re['PT'] > -1) {
        $requete = " replace into  " . EMSPYRE_USER_FLOTTE . " ";
        $requete .= " ( ";
        $requete .= " user_id ";
        $requete .= " ) ";
        $requete .= " Values ";
        $requete .= " ( ";
        $requete .= " " . $spyed_id . "  ";
        $requete .= " ) ";
        $db->sql_query($requete);
    }


function import_flotte($re, $c, $is_lune, $spyed_id)
{
      global $db;
    // on importe que si superieur a ce qui se trouve en base
    //pas besoin de  if ($re['PT'] > -1) { => de toute facon inopérant car si pas de pt mais autre chose à la place .... :s
     //  if ($re['PT'] > -1) {
        $flotte = find_flotte($spyed_id);
        $requete = " replace into  " . EMSPYRE_USER_FLOTTE . " ";
        $requete .= " ( ";
        $requete .= " user_id ";
        $requete .= " , PT,	GT	,CLE,	CLO,	CR,	VB,	VC,	REC,	SE,	BMD	,DST,	EDLM,	TRA";
        $requete .= " ) ";
        $requete .= " Values ";
        $requete .= " ( ";
        $requete .= " " . $spyed_id . "  ";
        $requete .=  iif($re['PT']>$flotte['PT'] , " , ".$re['PT']." " ,  " , ".$flotte['PT']." " );
        $requete .=  iif($re['GT']>$flotte['GT'] , " , ".$re['GT']." " ,  " , ".$flotte['GT']." " );
        $requete .=  iif($re['CLE']>$flotte['CLE'] , " , ".$re['CLE']." " ,  " , ".$flotte['CLE']." " );
        $requete .=  iif($re['CLO']>$flotte['CLO'] , " , ".$re['CLO']." " ,  " , ".$flotte['CLO']." " );
        $requete .=  iif($re['CR']>$flotte['CR'] , " , ".$re['CR']." " ,  " , ".$flotte['CR']." " );
        $requete .=  iif($re['VB']>$flotte['VB'] , " , ".$re['VB']." " ,  " , ".$flotte['VB']." " );
        $requete .=  iif($re['VC']>$flotte['VC'] , " , ".$re['VC']." " ,  " , ".$flotte['VC']." " );
        $requete .=  iif($re['REC']>$flotte['REC'] , " , ".$re['REC']." " ,  " , ".$flotte['REC']." " );
        $requete .=  iif($re['SE']>$flotte['SE'] , " , ".$re['SE']." " ,  " , ".$flotte['SE']." " );
        $requete .=  iif($re['BMD']>$flotte['BMD'] , " , ".$re['BMD']." " ,  " , ".$flotte['BMD']." " );
        $requete .=  iif($re['DST']>$flotte['DST'] , " , ".$re['DST']." " ,  " , ".$flotte['DST']." " );
        $requete .=  iif($re['EDLM']>$flotte['EDLM'] , " , ".$re['EDLM']." " ,  " , ".$flotte['EDLM']." " );
        $requete .=  iif($re['TRA']>$flotte['TRA'] , " , ".$re['TRA']." " ,  " , ".$flotte['TRA']." " );
        $requete .= " ) ";
        $db->sql_query($requete);
        echo $c['coord'] . ' Importation flotte oki <br />';
        
        
    //}
      
}

function find_flotte($spyed_id)
{
    global $db ;
    $requete  = " select * from ".EMSPYRE_USER_FLOTTE." where user_id = ".$spyed_id." ";
    $result = my_assoc($requete);
    return $result[0];
}

/// j aurais mieux fait de m abstenir de la faire ...
function iif($condition,$ok,$nok='') {
	return ($condition ? $ok : $nok);
}

