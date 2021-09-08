<?php 
  // Headers
  header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type, Authorization');
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');


  include_once '../../config/Database.php';
  include_once '../../models/Names.php';
  include_once '../../models/RandomNameParams.php';
  include_once '../../Repositories/NamesRepository.php';
  
  

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $params = new RandomNameParams();
  $namesRepo = new NamesRepository($db);

//   public $firstLetter;    
//   public $sex;
//   public $topX;
//   public $length;

  // Instantiate blog post object
  $names = new Names();
  
  // Get params
  $params->firstLetter = isset($_GET['firstLetter']) ? $_GET['firstLetter'] : '';
  $params->gender = isset($_GET['gender']) ? $_GET['gender'] : '';
  $params->topX = isset($_GET['topX']) ? $_GET['topX'] : '';
  $params->maxLength = isset($_GET['maxLength']) ? $_GET['maxLength'] : '';
  $params->minLength = isset($_GET['minLength']) ? $_GET['minLength'] : '';
  $params->maxPopularity = isset($_GET['maxPopularity']) ? $_GET['maxPopularity'] : '';
  $params->minPopularity = isset($_GET['minPopularity']) ? $_GET['minPopularity'] : '';
  
  // Blog post query
  $names_array = $namesRepo->get_specific_names($params);
  $noMatches = count($names_array);
  
  $nameToReturn = "";

  //Get random name from specific names:
    if($noMatches>0)
    {
      //Draw name
      $randomItem = rand(1, $noMatches) - 1;
      
      $nameToReturn = json_encode($names_array[$randomItem]);
    }
    else {
      $nameToReturn = json_encode(array(
        'name' => 'No Names Found')
      );
    }


    echo $nameToReturn;
  
