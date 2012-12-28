<?php
function create_table()
{
      global $db;
		$query = "CREATE TABLE IF NOT EXISTS ".EMSPYRE_USER_BUILDING." (";
        $query .= "user_id int(11) NOT NULL default '0', ";
        $query .= " planet_id int(11) NOT NULL default '0', ";
        $query .= " planet_name varchar(20) NOT NULL default '', ";
        $query .= " coordinates varchar(8) NOT NULL default '', ";
        $query .= " `fields` smallint(3) NOT NULL default '0', ";
        $query .= " temperature_min smallint(2) NOT NULL default '0', ";
        $query .= "  temperature_max smallint(2) NOT NULL default '0', ";
        $query .= " Sat smallint(5) NOT NULL default '0', ";
        $query .= "  Sat_percentage smallint(3) NOT NULL default '100',";
        $query .= " M smallint(2) NOT NULL default '0',";
        $query .= " M_percentage smallint(3) NOT NULL default '100',"; 
        $query .= " C smallint(2) NOT NULL default '0',";
        $query .= " C_Percentage smallint(3) NOT NULL default '100',";
        $query .= " D smallint(2) NOT NULL default '0',";
        $query .= "  D_percentage smallint(3) NOT NULL default '100',"; 
        $query .= " CES smallint(2) NOT NULL default '0',";
        $query .= " CES_percentage smallint(3) NOT NULL default '100',";
        $query .= " CEF smallint(2) NOT NULL default '0',";
        $query .= " CEF_percentage smallint(3) NOT NULL default '100',";
        $query .= " UdR smallint(2) NOT NULL default '0',";
        $query .= " UdN smallint(2) NOT NULL default '0',";
        $query .= " CSp smallint(2) NOT NULL default '0',";
        $query .= " HM smallint(2) NOT NULL default '0',";
        $query .= "  HC smallint(2) NOT NULL default '0',";
        $query .= " HD smallint(2) NOT NULL default '0',";
        $query .= " CM smallint(2) NOT NULL default '0',";
        $query .= " CC smallint(2) NOT NULL default '0',";
        $query .= " CD smallint(2) NOT NULL default '0',";
        $query .= " Lab smallint(2) NOT NULL default '0',";
        $query .= " Ter smallint(2) NOT NULL default '0',";
        $query .= " DdR smallint(2) NOT NULL default '0',";
        $query .= " Silo smallint(2) NOT NULL default '0',";
        $query .= " BaLu smallint(2) NOT NULL default '0',";
        $query .= " Pha smallint(2) NOT NULL default '0',";
        $query .= " PoSa smallint(2) NOT NULL default '0',";
        $query .= "  PRIMARY KEY  (user_id,planet_id)";
        $query .= ") ; ";
        
		$db->sql_query($query);
        
        
        
        
        $query = "CREATE TABLE IF NOT EXISTS ".EMSPYRE_USER_DEFENCE." (";
        $query .= " user_id int(11) NOT NULL default '0', ";
        $query .= "   planet_id int(11) NOT NULL default '0', ";
        $query .= " LM int(11) NOT NULL default '0', ";
        $query .= " LLE int(11) NOT NULL default '0', ";
        $query .= "  LLO int(11) NOT NULL default '0', ";
        $query .= " CG int(11) NOT NULL default '0', ";
        $query .= "  AI int(11) NOT NULL default '0', ";
        $query .= "  LP int(11) NOT NULL default '0', ";
        $query .= "  PB smallint(1) NOT NULL default '0', ";
        $query .= " GB smallint(1) NOT NULL default '0', ";
        $query .= " MIC smallint(3) NOT NULL default '0', ";
        $query .= " MIP smallint(3) NOT NULL default '0', ";
        $query .= "   PRIMARY KEY  (user_id,planet_id) ";
        $query .= " ) ; ";
        
      $db->sql_query($query);



            $query = "CREATE TABLE IF NOT EXISTS ".EMSPYRE_USER_TECHNOLOGY." ( ";
             $query .= "user_id int(11) NOT NULL default '0',";
             $query .= "  Esp smallint(2) NOT NULL default '0', ";
            $query .= "  Ordi smallint(2) NOT NULL default '0', ";
            $query .= " Armes smallint(2) NOT NULL default '0', ";
            $query .= "  Bouclier smallint(2) NOT NULL default '0', ";
            $query .= " Protection smallint(2) NOT NULL default '0', ";
            $query .= " NRJ smallint(2) NOT NULL default '0', ";
            $query .= " Hyp smallint(2) NOT NULL default '0', ";
            $query .= " RC smallint(2) NOT NULL default '0', ";
            $query .= " RI smallint(2) NOT NULL default '0', ";
            $query .= " PH smallint(2) NOT NULL default '0', ";
            $query .= " Laser smallint(2) NOT NULL default '0', ";
            $query .= " Ions smallint(2) NOT NULL default '0', ";
            $query .= " Plasma smallint(2) NOT NULL default '0', ";
            $query .= "  RRI smallint(2) NOT NULL default '0', ";
            $query .= " Graviton smallint(2) NOT NULL default '0', ";
            $query .= "  Astrophysique smallint(2) NOT NULL default '0',";
            $query .= "   PRIMARY KEY  (user_id) ";
            $query .= " ) ; ";
            
            
            
             $db->sql_query($query);
             
              $query = "CREATE TABLE IF NOT EXISTS ".EMSPYRE_USER." (";
              $query .= " user_id int(11) NOT NULL default '0',"; // utilisateur ogspy qui met en surveillance
              $query .= " coord varchar(8) NOT NULL default '', "; // coordonné de la pm du joueur surveillé
              $query .= " PRIMARY KEY  (coord) ";
              $query .= " ) ; ";
              
               $db->sql_query($query);
        
   
               }


function drop_table()
{
   global $db;

    $tables = array(EMSPYRE_USER_BUILDING,EMSPYRE_USER_DEFENCE,EMSPYRE_USER_TECHNOLOGY,EMSPYRE_USER_FLOTTE,EMSPYRE_USER);
    
    foreach ($tables as $table)
    {
        $query = "DROP TABLE IF EXISTS ".$table." ;";
        $db->sql_query($query);
    }
}
?> 
  
  
  
  
  
  
  
 
  
  


