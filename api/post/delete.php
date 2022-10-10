<?php
// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Autherization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Instantiate blo post object
$post = new Post($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;


// delete post
if ($post->delete_post()) {
    echo json_encode(
        array('message' => 'post deleted')
    );
} else {
    echo json_encode(
        array('message' => 'post not deleted')
    );
}
