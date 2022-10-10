<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Db & connect
$database = new Database();
$db = $database->connect();

// blog category object
$category = new Category($db);

$result = $category->read_category();

$num = $result->rowCount();

if($num > 0){
    $category_arr = array();
    $category_arr['data'] = array();

    while($row= $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $category_items = array(
            'id' => $id,
            'name' => $name,
            'created_at' => $created_at

        );
        array_push($category_arr['data'], $category_items);
    }
    echo json_encode($category_arr);
}
else{
    echo json_encode(array('message' => 'not found'));
}










