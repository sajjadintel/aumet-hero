<?php

// Reports all errors
error_reporting(E_ALL);

// Do not display errors for the end-users (security issue)
ini_set('display_errors', 'On');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

date_default_timezone_set("Asia/Amman");

require_once("vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$f3 = \Base::instance();

$f3->set('AUTOLOAD', "app/controllers/ | app/classes/ | app/models/ | app/modules/common/ | app/modules/company/ | app/modules/company/models | app/modules/product/ | app/modules/matching/ | app/modules/inquiry/ | app/modules/communication/");

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

$f3->set('uploadDIR', dirname(__FILE__) . '/files/uploads/');
$f3->set('uploadDIRServe', 'https://d2qyez1diqag7p.cloudfront.net/uploads/');

$f3->set('authServerKey', '-SC4,=$?.3:&KRR]:DCQx{~wY!)`+--CkhE`2ur<VCZ(Tk8Pt2YXvdp3mz>3wsW`');

$dbPGNameAumet = getenv('ONEX_DB_NAME_AUMET');

if (getenv('ENV') == Constants::ENV_LOC) {
    $dbPGHost = getenv('ONEX_DB_HOST_DEV');
    $dbPGPort = getenv('ONEX_DB_PORT_DEV');
    $dbPGUsername = getenv('ONEX_DB_USER_DEV');
    $dbPGPassword = getenv('ONEX_DB_PASS_DEV');
} else if (getenv('ENV') == Constants::ENV_PROD) {
    $dbPGHost = getenv('ONEX_DB_HOST_PROD');
    $dbPGPort = getenv('ONEX_DB_PORT_PROD');
    $dbPGUsername = getenv('ONEX_DB_USER_PROD');
    $dbPGPassword = getenv('ONEX_DB_PASS_PROD');
}

global $dbConnectionAumet;

$dbConnectionAumet = new DB\SQL(
    "pgsql:host=$dbPGHost;port=$dbPGPort;dbname=$dbPGNameAumet",
    $dbPGUsername,
    $dbPGPassword,
    array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)
);


$dbMyNameAumet = getenv('MP_DB_NAME_AUMET');

if (getenv('ENV') == Constants::ENV_LOC) {
    $dbMyHost = getenv('MP_DB_HOST_DEV');
    $dbMyPort = getenv('MP_DB_PORT');
    $dbMyUsername = getenv('MP_DB_USER_DEV');
    $dbMyPassword = getenv('MP_DB_PASS_DEV');
} else if (getenv('ENV') == Constants::ENV_PROD) {
    $dbMyHost = getenv('MP_DB_HOST_PROD');
    $dbMyPort = getenv('MP_DB_PORT');
    $dbMyUsername = getenv('MP_DB_USER_PROD');
    $dbMyPassword = getenv('MP_DB_PASS_PROD');
}

global $dbMPConnectionAumet;

$dbMPConnectionAumet = new DB\SQL(
    "mysql:host=$dbMyHost;port=$dbMyPort;dbname=$dbMyNameAumet",
    $dbMyUsername,
    $dbMyPassword,
    array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)
);


/*
global $dbConnectionUniOrder;
$dbConnectionUniOrder = new DB\SQL(
    "sqlsrv:Server=smartsrvr.database.windows.net,1433;Database=uniorders",
    "Smart",
    "MoonLight@2",
    array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)
);*/

$f3->set('rootDomain', getenv('rootDomain'));
$f3->set('rootDomainUrl', getenv('rootDomainUrl'));

if (getenv('rootDomainOnexUrl') == '') {
    $f3->set('rootDomainOnexUrl', 'https://dev-onex.aumet.tech');
} else {
    $f3->set('rootDomainOnexUrl', getenv('rootDomainOnexUrl'));
}
$f3->set('emailAssetsDirectory', getenv('emailAssetsDirectory'));

if (getenv('ENV') == Constants::ENV_PROD) {
    $f3->set('platformVersion', '?v=1.0.1');
    $f3->set('platformEnv', 'production');
    $f3->set('firebaseAdminKeyFile', dirname(__FILE__) . '/config/aumet-com-firebase-adminsdk-2nsnx-64efaf5c39.json');
} else {
    $f3->set('platformVersion', '?v=' . date('His'));
    $f3->set('platformEnv', 'staging');
    $f3->set('firebaseAdminKeyFile', dirname(__FILE__) . '/config/aumet-dev-c4772d6b4b5b.json');
}

define('CHUNK_SIZE', 1024 * 1024);

//Old sendgrid credentials
/*global $emailSender;
$emailSender = new AumetEmail("Aumet", "no-reply@aumet.me", getenv('SENDGRID_API_KEY'));*/

global $emailSender;
$emailSender = new AumetEmail("Aumet", "info@aumet.com", getenv('SENDGRID_API_KEY'));

//$emailSender = new AumetEmail("Aumet", "no-reply@aumet.me", getenv('SENDGRID_API_KEY'));
//$emailSender = new AumetEmail("Aumet", "info@aumet.com", getenv('SENDGRID_API_KEY'));

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
                //echo $f3->get('ERROR.text');
                var_dump($f3->get('ERROR'));
            }
        }
    );
}

$timeout = 0;

// Set the maxlifetime of session
ini_set("session.gc_maxlifetime", $timeout);

// Also set the session cookie timeout
ini_set("session.cookie_lifetime", $timeout);

ini_set('max_execution_time', '0');

session_start();

$f3->run();
