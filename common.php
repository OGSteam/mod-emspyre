<?php
if (!defined('IN_SPYOGAME')) die("Hacking attempt");


global $table_prefix;
/// nom des tables
define("TAB_PREFIX", "emspyre");
define("EMSPYRE_USER_BUILDING", $table_prefix.TAB_PREFIX."_user_building");
define("EMSPYRE_USER_DEFENCE", $table_prefix.TAB_PREFIX."_user_defence");
define("EMSPYRE_USER_TECHNOLOGY", $table_prefix.TAB_PREFIX."_user_technology");
define("EMSPYRE_USER_FLOTTE", $table_prefix.TAB_PREFIX."_user_flotte");
define("EMSPYRE_USER", $table_prefix.TAB_PREFIX."_user");
/// fin tables

/// includes des fichiers
define("FOLDER","mod/emspyre/");
include(FOLDER."model/install.php");
include(FOLDER."model/sql.php");
include(FOLDER."model/user.php");
include(FOLDER."model/gestion.php");
include(FOLDER."model/re.php");
include(FOLDER."vue/menu.php");
include(FOLDER."include/ogame.php");




?>
