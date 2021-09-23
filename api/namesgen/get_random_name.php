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
  $params->maxLength = isset($_GET['maxLength']) ? $_GET['maxLength'] : '';
  $params->minLength = isset($_GET['minLength']) ? $_GET['minLength'] : '';
  $params->veryPopularName = isset($_GET['veryPopularName']) ? $_GET['veryPopularName'] : '';
  $params->notPopularName = isset($_GET['notPopularName']) ? $_GET['notPopularName'] : '';
  
  // Blog post query
  $names_array = $namesRepo->get_specific_names($params);
  $noMatches = count($names_array);
  
  $nameToReturn = "";

  //Get random name from specific names:
    if($noMatches>0)
    {
      //Draw name

      //17210

      $randomItem = rand(0, $noMatches-1);      
      //$drawedItem = $names_array[17210];
      $drawedItem = $names_array[$randomItem];
      $additional = array("additional info" => " random item - " . strval($randomItem)." no maches - ".strval($noMatches));      
      array_merge($drawedItem, $additional);
      $nameToReturn = json_encode(array_merge($drawedItem, $additional));
      if(empty($nameToReturn))
      {
        $nameToReturn = json_encode($additional);
      } 
    }
    else {
      $nameToReturn = json_encode(array(
        'name' => 'No Names Found')
      );
    }


    echo $nameToReturn;
  
