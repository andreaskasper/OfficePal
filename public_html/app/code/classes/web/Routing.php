<?php

namespace web;

/**
  * Class for routing web-requests
  */
class Routing {

  /**
    * starting function for the routing of web requests
    */
  public static function start() {
    $_SERVER["REQUEST_URI2"] = substr($_SERVER["REQUEST_URI"],strlen($_SERVER["SCRIPT_NAME"])-10);
		$p = strpos($_SERVER["REQUEST_URI2"],"?");
		if (!$p) $_SERVER["REQUEST_URIpure"] = $_SERVER["REQUEST_URI2"]; else $_SERVER["REQUEST_URIpure"] = substr($_SERVER["REQUEST_URI2"],0, $p);

    switch ($_SERVER["REQUEST_URIpure"]) {
      case "/":
      case "/index.html":
        PageEngine::html("page_dashboard"); exit(1);
    }

    PageEngine::html("page_404"); exit(1);
  }



}
