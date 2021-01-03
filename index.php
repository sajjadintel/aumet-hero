<?php

// Reports all errors
error_reporting(E_ALL);

// Do not display errors for the end-users (security issue)
ini_set('display_errors', 'On');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

date_default_timezone_set("Asia/Dubai");

require_once("vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$f3 = \Base::instance();

$f3->set('AUTOLOAD', "app/controllers/ | app/classes/ | app/models/");

/* Config */
$f3->set('DEBUG', '3');
$f3->set('UI', 'ui/');
$f3->set('LOGS', 'logs/');
$f3->set('LOCALES', 'app/translations/');
$f3->set('FALLBACK', 'en');
$f3->set('ENCODING', 'UTF-8');


$f3->set('CACHE', 'redis=127.0.0.1');

//$f3->set('AUMET_CACHE', TRUE);

$f3->set('rootDIR', dirname(__FILE__));

$f3->set('tempDIR', dirname(__FILE__) . '/tmp/');

$f3->set('uploadDIR', dirname(__FILE__).'/files/uploads/');
$f3->set('uploadDIRServe', 'https://d2qyez1diqag7p.cloudfront.net/uploads/');

$f3->set('authServerKey', '-SC4,=$?.3:&KRR]:DCQx{~wY!)`+--CkhE`2ur<VCZ(Tk8Pt2YXvdp3mz>3wsW`');

$dbPGPort = getenv('PGDB_PORT');
$dbPGHost = getenv('PGDB_HOST');
$dbPGUsername = getenv('PGDB_USER');
$dbPGPassword = getenv('PGDB_PASS');

$dbNameAumet = getenv('DB_NAME_AUMET');

global $dbConnectionAumet;

$dbConnectionAumet = new DB\SQL(
    "pgsql:host=$dbPGHost;port=$dbPGPort;dbname=$dbNameAumet",
    $dbPGUsername,
    $dbPGPassword,
    array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)
);

$f3->set('rootDomain', getenv('rootDomain'));
$f3->set('rootDomainUrl', getenv('rootDomainUrl'));
$f3->set('emailAssetsDirectory', getenv('emailAssetsDirectory'));

if (getenv('ENV') == Constants::ENV_PROD) {
    $f3->set('platformVersion', '?v=0.04');
} else {
    $f3->set('platformVersion', '?v=' . date('His'));
}

define('CHUNK_SIZE', 1024 * 1024);

global $emailSender;

$emailSender = new AumetEmail("Aumet", "no-reply@aumet.me", getenv('SENDGRID_API_KEY'));

include_once("routes.php");

if (getenv('ENV') == Constants::ENV_LOC) {
    ini_set('max_execution_time', '0');
    $f3->set('DEBUG', '9');
} else {
    $f3->set('DEBUG', 0);
    $f3->set(
        'ONERROR',
        function ($f3) {
            if ($f3->get('ERROR.code') == 404) {
                $f3->reroute('/');
            } else {
                echo $f3->get('ERROR.text');
                //var_dump($f3->get('ERROR'));
            }
        }
    );
}

$timeout = 0;

// Set the maxlifetime of session
ini_set( "session.gc_maxlifetime", $timeout );

// Also set the session cookie timeout
ini_set( "session.cookie_lifetime", $timeout );

ini_set('max_execution_time', '0');

session_start();

$f3->run();