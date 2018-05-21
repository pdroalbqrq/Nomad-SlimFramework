    <?php
    // DIC configuration
    include("class_user.php");

    $container = $app->getContainer();

    // view renderer
    $container['renderer'] = function ($c) {
        $settings = $c->get('settings')['renderer'];
        return new Slim\Views\PhpRenderer($settings['template_path']);
    };

    // monolog
    $container['logger'] = function ($c) {
        $settings = $c->get('settings')['logger'];
        $logger = new Monolog\Logger($settings['name']);
        $logger->pushProcessor(new Monolog\Processor\UidProcessor());
        $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        return $logger;
    };

    // conection database
    $container['database'] = function ($c) { 
       $servername = "localhost:3306";
       $username = "root";
       $password = "";
       $myDB = "nomadwork";
       try {
           $conn = new PDO("mysql:host=$servername;dbname=$myDB", $username, $password);
           // set the PDO error mode to exception
           $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           echo "Connected successfully"; 
           }
       catch(PDOException $e)
           {
           echo "Connection failed: " . $e->getMessage();
           }
        return $conn;
    };
   
    // instert data
    $container['insertData'] = function ($c) {
        $user = new class_user();
        $user->insert();
    };

// list data
$container['listDb'] = function ($c) {
    $user = new class_user();
    $lista = $user->findAll();
    return $lista;
};