<?php
namespace chessBackend;
use Slim\Factory\AppFactory;

require_once(__DIR__ . '/../vendor/autoload.php');

$app = AppFactory::create();
// Set CORS headers
header('Access-Control-Allow-Origin: *');  // Allow all origins or specify your frontend URL
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept');

// Handle preflight requests for OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);  // No content response for OPTIONS requests
    exit;  // Terminate script
}
$factory = new Factory();

$factory->createApplication()->startApp($app);
$app->run();
