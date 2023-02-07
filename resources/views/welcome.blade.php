<?php
echo 'Hello World' . PHP_EOL;
try {
    $dbh = new PDO('mysql:host=' . gethostbyname('mariadb') . ';dbname=' . getenv('DB_DATABASE'), getenv('DB_USER'), getenv('DB_PASSWORD'), [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    echo "Connected to the database at hostname 'mariadb': " . gethostbyname('mariadb') . "\n" . PHP_EOL;
} catch (Exception $e) {
    echo $e->getMessage();
}
use Illuminate\Support\Facades\Redis;
// //Connecting to Redis server on localhost
echo 'Redis IP: ' . gethostbyname('redis');
try {
    Redis::connect(gethostbyname('redis'), 6379);
    echo 'Connection to Redis worked.';
} catch (\Exception $e) {
    echo $e->getMessage();
    echo 'Connection to Redis failed.';

}
//check whether server is running or not
phpinfo();
