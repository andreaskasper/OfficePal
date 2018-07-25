<?php
/*
 * Hier startet die gesamte Webseite
 *
 */

define("asi_allowed_entrypoint", true);

ini_set("error_reporting", E_ALL | E_STRICT);
//if(function_exists('xdebug_disable')) { xdebug_disable(); }

$_ENV["basepath"] = __DIR__;

/*
 * Mit dieser Funktion werden Klassen anhand ihres Namens automatisch geladen. Das Ergebnis spiegelt den Erfolg der Ausführung
 * @param string $class_name Name der Klasse, die geladen werden muss
 * @return boolean
 */
spl_autoload_register(function($class_name) {
	$prio = array();

	$prio[] = __DIR__."/app/code/classes/".str_replace(chr(92), DIRECTORY_SEPARATOR, $class_name).".php";

	foreach ($prio as $file) {
		if (file_exists($file)) {
			require($file);
			return true;
		}
	}
  trigger_error("Class ".$class_name." not found!", E_USER_WARNING);
	return false;
});

//TODO: From Config
date_default_timezone_set("Europe/Berlin");

SQL::init(0, "mysql://officepal:officepal@localhost/officepal/");

\web\Routing::start();

function html($txt) {
	return htmlentities($txt, 3, "UTF-8");
}

function htmlattr($txt) {
	return str_replace(array("&"),array("&amp;"),html($txt));
}

function htmlhref($txt) {
	$txt = str_replace(array(" ","ä","ö","ü","ß","Ä","Ö","Ü"),array("_","ae","oe","ue","ss","Ae","Oe","Ue"),$txt);
	$txt = preg_replace("@[^a-zA-Z0-9\_\-]@iU","",$txt);
	return $txt;
}
