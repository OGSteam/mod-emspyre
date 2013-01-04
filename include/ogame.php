<?php
if (!defined('IN_SPYOGAME')) {
	die("Hacking attempt");
}


// il s agit d une estimation part variable ( temp moyenne constaté)
function get_temperature_by_coord($coord)
{
    $temp = array(); // tab de temperature min /max
    $my_coord = split_coord($coord) ;
    $r = $my_coord['r'];
   
    // cf tableau de temperature
    $tab[1] = array(220,260); // a la ligne 1
    $tab[2] = array(170,210); 
    $tab[3] = array(120,160); 
    $tab[4] = array(70,110); 
    $tab[5] = array(60,100); 
    $tab[6] = array(50,90); 
    $tab[7] = array(40,80); 
    $tab[8] = array(30,70); 
    $tab[9] = array(20,60); 
    $tab[10] = array(10,50); 
    $tab[11] = array(0,40); 
    $tab[12] = array(-10,30); 
    $tab[13] = array(-50,-10); 
    $tab[14] = array(-90,-50); 
    $tab[15] = array(-130,-90); 
    
    $temp = $tab[$r];
    return $temp;
    
    
}

// il s agit d une estimation part variable
function get_diametre_by_coord($coord)
{
    $diam = "";
    $my_coord = split_coord($coord) ;
    $r = $my_coord['r'];
    
    $tab = array();
    $tab[1]= 100;
    $tab[2] = 103;
    $tab[3] = 118;
    $tab[4] = 164;
    $tab[5] = 179;
    $tab[6] =  194;
    $tab[7] = 193;
    $tab[8] = 208;
    $tab[9] =  197;
    $tab[10] = 188;
    $tab[11] =176;
    $tab[12] = 154;
    $tab[13] = 115;
    $tab[14] = 86;
    $tab[15] = 69;
    
    $diam = $tab[$r];
    
    return $diam;
}

function split_coord($coord)
{ 
    $retour = array();
    $temp = explode(":",$coord);
    $retour['g'] = $temp[0];
    $retour['s'] = $temp[1];
    $retour['r'] = $temp[2];
    return $retour;
    
    
}


