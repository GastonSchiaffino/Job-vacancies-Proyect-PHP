<?php namespace Config;

define("ROOT", dirname(__DIR__) . "/");
//Path to your project's root folder
define("FRONT_ROOT", "/TPFinalMetodologiaI/");
define("VIEWS_PATH", "Views/");
define("CSS_PATH", FRONT_ROOT.VIEWS_PATH . "css/");
define("JS_PATH", FRONT_ROOT.VIEWS_PATH . "js/");
define("IMAGE_PATH", FRONT_ROOT."Assets/Image/");
define('API_KEY','4f3bceed-50ba-4461-a910-518598664c08');
define('API_URL','https://utn-students-api.herokuapp.com/api/');
define("FPDF_PATH", FRONT_ROOT."FPDF/");


//BDD
define("DB_HOST", "localhost");
define("DB_NAME", "bddtpfinal");
define("DB_USER", "root");
define("DB_PASS", "");

?>




