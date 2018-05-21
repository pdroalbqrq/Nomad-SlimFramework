<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

// $app->get('/[{name}]', function (Request $request, Response $response, array $args) {
//     // Sample log message
//     $this->logger->info("Slim-Skeleton '/' route");
//     var_dump($this->insertData);
//     var_dump($this->listDb);

//     // Render index view
//     return $this->renderer->render($response, 'index.phtml', $args);
// });
// $app->post('/user', function ($request, $response, $args) {
//     var_dump($this->insertData);
// });

$app->get('/user', function (Request $request, Response $response, array $args) {
    $this->logger->info("Slim-Skeleton '/user' route");
    $new_response = $response->withJson($this->listDb);
    return $new_response;
});


$app->get('/user/[{id}]', function (Request $request, Response $response, array $args) {

    $this->logger->info("Slim-Skeleton '/user/[{id}]' route");
    // $sql = "select * from user where user_id=" . $args[id] . ";" ;
    $sql  = "SELECT * FROM user WHERE name=(:id)";
    $stmt = DataBase::prepare($sql);
    $stmt->bindParam(':id', $args[id]);
    $stmt->execute();
    $new_response = $response->withJson($stmt->fetchAll());
    return $new_response;
});


$app->post('/user', function (Request $request, Response $response, array $args) {
    
    $json =json_decode($request->getBody());
    $sql  = " INSERT INTO user (name,email,full_name,pass,number) VALUES (:name,:email,:full_name,:pass,:number);";
    $stmt = DataBase::prepare($sql);
    $stmt->bindParam(':name', $json->name);
    $stmt->bindParam(':email', $json->email);
    $stmt->bindParam(':full_name', $json->full_name);
    $stmt->bindParam(':pass', $json->pass);
    $stmt->bindParam(':number', $json->number);
    $stmt->execute();
   // $new_response = $response->withJson(($stmt->execute())); 
   // return $new_response;

});
