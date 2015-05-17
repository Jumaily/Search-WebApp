<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
date_default_timezone_set('America/New_York');

# path to database file
define('sqliteDB',PATH."databases/salaries.db");

require_once(PATH."phpinc/sessions.class.php"); $SESSION = new Session();
?>