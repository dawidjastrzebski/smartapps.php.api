<?php 
  include_once '../../services/names-services/NamesParamsCreator.php';
  include_once '../../models/Names.php';
  class NamesRepository {
    // DB stuff
    private $conn;
    private $table = 'names';

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }
    ////////////////////////////////////
    /// Get all Names
    ////////////////////////////////////
    public function read_all() 
    {
        // Create query
        $query = 'SELECT * FROM '.$this->table;
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

            // Blog post query
        $result = $stmt;
        // Get row count
        $num = $result->rowCount();
        $names_array = array();
        // Check if any posts
        if($num > 0) {
        // $posts_arr['data'] = array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            
            extract($row);
            $names_item = array(
            'id' => $id,
            'name' => $name,
            'numberOfOccurances' => $numberOfOccurances,
            'gender' => $gender,
            'dateReleased' => $dateReleased
            );

            // Push to "data"
            array_push($names_array, $names_item);
            }}

      return $names_array;
    }

   
    ////////////////////////////////////
    /// Create
    ////////////////////////////////////
    public function create($nameModel) 
    {
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET name = :name, numberOfOccurances = :numberOfOccurances, gender = :gender, dateReleased = :dateReleased';

          // Prepare statement
          $stmt = $this->conn->prepare($query);         

          // Bind data
          $stmt->bindParam(':name', $nameModel->name);
          $stmt->bindParam(':numberOfOccurances', $nameModel->numberOfOccurances);
          $stmt->bindParam(':gender', $nameModel->gender);
          $stmt->bindParam(':dateReleased', $nameModel->dateReleased);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    ////////////////////////////////////
    /// Get Random
    ///////////////////////////////////
    public function get_specific_names($params) 
    {
        $paramsCreator = new NamesParamsCreator(); 
        $queryParams = $paramsCreator->CreateParams($params);
            
            // Create query
            $query = 'SELECT * FROM ' . $this->table. $queryParams;
            //echo $query ;
            
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

        $result = $stmt;

        // Get row count
        $num = $result->rowCount();
        $names_array = array();

        // Check if any posts
        if($num > 0) {
            // $posts_arr['data'] = array();

            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            
            extract($row);
            $names_item = array(
            'id' => $id,
            'name' => $name,
            'numberOfOccurances' => $numberOfOccurances,
            'gender' => $gender,
            'dateReleased' => $dateReleased
            );

            // Push to "data"
            array_push($names_array, $names_item);
            // array_push($posts_arr['data'], $post_item);
            }}

        return $names_array;
    }
    
}