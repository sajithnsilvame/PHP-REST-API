<?php
//Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);

$category->id = isset($_GET['id']) ? $_GET['id'] : die();

$category->read_single_category();

$category_arr = array(
    'id'=> $category->id,
    'name' => $category->name
);

print_r(json_encode($category_arr));