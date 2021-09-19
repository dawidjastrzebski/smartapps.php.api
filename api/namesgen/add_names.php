<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: applicaiton/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Names.php';
  include_once '../../Repositories/NamesRepository.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Get raw data
  $data = file_get_contents("php://input");

  $lines = explode("\n",$data);
  $successAdded = 0;
  $fails = 0;
  $released = $lines[0];
  for ($i = 1; $i <= count($lines)-1; $i++) {        
    $linearray = explode(",", $lines[$i]);
    $names = new Names();
    $namesRepo = new NamesRepository($db);
    $names->name = $linearray[0];
    $names->gender = $linearray[1] == "MĘŻCZYZNA" ? "MALE" : "FEMALE";
    $names->numberOfOccurances =str_replace("\r", "", $linearray[2]);
    $names->dateReleased = $released;
      if($namesRepo->create($names)) {
        $successAdded++;
      } else {
        $fails++;      
      }
  }

  echo json_encode(
    array('successfully added' => $successAdded)
  );




  // public $id;
  // public $name;
  // public $numberOfOccurances;
  // public $sex;
  // public $dateReleased;