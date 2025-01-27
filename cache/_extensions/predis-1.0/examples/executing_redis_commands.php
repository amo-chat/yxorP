<?php /* yxorP */


require __DIR__ . '/shared.php';

$client = new Predis\Client($single_server);

// Plain old SET and GET example...
$client->set('library', 'predis');
$response = $client->get('library');

var_export($response);
echo PHP_EOL;


// Redis has the MSET and MGET commands to set or get multiple keys in one go,
// cases like this Predis accepts arguments for variadic commands both as a list
// of arguments or an array containing all of the keys and/or values.
$mkv = array(
    'uid:0001' => '1st user',
    'uid:0002' => '2nd user',
    'uid:0003' => '3rd user'
);

$client->mset($mkv);
$response = $client->mget(array_keys($mkv));

var_export($response);
echo PHP_EOL;


// Predis can also send "raw" commands to Redis. The difference between sending
// commands to Redis the usual way and the "raw" way is that in the latter case
// their arguments are not filtered nor responses coming from Redis are parsed.

$response = $client->executeRaw(array(
    'MGET', 'uid:0001', 'uid:0002', 'uid:0003'
));

var_export($response);
echo PHP_EOL;

