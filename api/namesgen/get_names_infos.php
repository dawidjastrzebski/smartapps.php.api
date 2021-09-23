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
    include_once '../../models/NamesInfos.php';
    include_once '../../Repositories/NamesRepository.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $namesInfo = new NamesInfos();
  $namesRepo = new NamesRepository($db);

  $names_array = $namesRepo->read_all();

  $maleNamesArray = array();
  $femaleNamesArray = array();

  foreach($names_array as $name)
  {
    if($name['gender'] == "MALE")
    {
        array_push($maleNamesArray,$name);

        if(strlen($name['name'])>$namesInfo->maxMaleLength)
        {
            $namesInfo->maxMaleLength = strlen($name['name']); 
        }

        if(strlen($name['name'])<$namesInfo->minMaleLength)
        {
            $namesInfo->minMaleLength = strlen($name['name']); 
        }
        
    }
    else
    {
        array_push($femaleNamesArray,$name);

        if(strlen($name['name'])>intval($namesInfo->maxFemaleLength))
        {
            $namesInfo->maxFemaleLength = strlen($name['name']); 
        }

        if(strlen($name['name'])<$namesInfo->minFemaleLenth)
        {
            $namesInfo->minFemaleLenth = strlen($name['name']); 
        }

    }
  }

  //$maxPopularity = max(array_column($names_array,'numberOfOccurances'));

  echo json_encode($namesInfo);

  
