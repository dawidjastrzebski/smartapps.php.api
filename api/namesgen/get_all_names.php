<?php 
  // Headers
  header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Authorization');
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../Repositories/NamesRepository.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $namesRepo = new NamesRepository($db);

  $names_array = $namesRepo->read_all();

  if(count($names_array)>0){
    // Turn to JSON & output
    echo json_encode($names_array);

  } else {
    // No Posts
    echo json_encode(
      array('message' => 'No Names Found')
    );
  }
