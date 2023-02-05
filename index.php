<?php
echo 'Hello World'.PHP_EOL;
try {
    $dbh = new PDO("mysql:host=".gethostbyname('mariadb').";dbname=".getenv('DB_DATABASE'), getenv('DB_USER'), getenv('DB_PASSWORD'), [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "Connected to the database at hostname 'mariadb': " . gethostbyname('mariadb') . "\n".PHP_EOL;
} catch(Exception $e) {
    echo $e->getMessage();
}
phpinfo();
