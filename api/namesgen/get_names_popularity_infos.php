<?php
//Get all names infors:
    // - max male name length
    // - max female name length
    // - min male length
    // - min female lentgh
    // - min popularity male
    // - min popularity female
    // - max popularity male
    // - max popularity female
    header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Authorization');
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/RandomNameParams.php';
    include_once '../../Repositories/NamesRepository.php';   
    include_once '../../Repositories/NamesRepository.php';   
    include_once '../../models/NamesInfos.php'; 

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $params = new RandomNameParams();  
  $namesRepo = new NamesRepository($db);
  $namesPopularity = new NamesPopularity();


  $params->firstLetter = isset($_GET['firstLetter']) ? $_GET['firstLetter'] : '';
  $params->gender = isset($_GET['gender']) ? $_GET['gender'] : '';
  $params->maxLength = isset($_GET['maxLength']) ? $_GET['maxLength'] : '';
  $params->minLength = isset($_GET['minLength']) ? $_GET['minLength'] : '';

  // get specific names list
  $names_array = $namesRepo->get_specific_names($params);
  $noMatches = count($names_array);

  $namesPopularity->veryPopularName = 1;
  $namesPopularity->notPopularName = $noMatches;

  echo json_encode($namesPopularity);

  
