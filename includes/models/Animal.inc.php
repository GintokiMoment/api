<?php
include_once("Model.inc.php");

class Animal extends Model{

	// remember, my model is Animal, but the table could be animal(s). Be sure the table matches..

	// INSTANCE VARIABLES
	public $id;
	public $name;
	public $species;
	public $age;
	public $available; // available_for_adoption

	
	/**
	 * Constructor for creating Contact model objects
	 * @param {asoociative array} $args 	key value pairs that map to the instance variables
	 *										NOTE: the $args param is OPTIONAL, if it is not passed in
	 * 										The default will be an empty array: []									
	 */
	public function __construct($args = []){

		$this->id = $args["id"] ?? 0;
        $this->name = $args["name"] ?? "";
		$this->species = $args["species"] ?? "";
		$this->age = $args["age"] ?? 0;
		$this->available = $args["available"] ?? false;

	
	}

	/**
	 * Validates the state of this object. 
	 * Returns true if it is valid, false otherwise.
	 * For any properties that are not valid, a key will be added
	 * to the validationErrors array and it's value will be a description of the error.
	 * 
	 * @return {boolean}
	 */
	public function isValid(){
		
		$valid = true;
		$this->validationErrors = [];

		$validSpecies = [
			"dog",
			"cat",
			"hamster",
			"bird",
			"rabbit",
			"lizard",
			"guinea pig",
			"mouse",
			"ferret"
		  ];
		
		// Validate the ID:
		// It must be a number equal to or greater than 0 
		// (0 is valid becuase it will indicate that we are inserting a new user)
		// If the ID is not valid then you should add an 'id' key to $this->validationErrors with a value of "ID is not valid"
        
		if(!is_numeric($this->id) || $this->id < 0){
            $valid = false;
            $this->validationErrors["id"] = "ID is not valid";
        }
    
    
		// validating name..
		if(empty($this->name)){
            $valid = false;
            $this->validationErrors["name"] = "Name is required";
        }else if(strlen($this->name) > 30){
            $valid = false;
            $this->validationErrors["name"] = "Name must be 30 characters or less";
        }


		// validate species
		// species should be only within $validSpecies' scope.


		if (!in_array(strtolower($this->species), $validSpecies)) {
			$valid = false;
			$this->validationErrors["species"] = "Species must be within the allowed species list.";
		} else if (empty($this->species)){
			$valid = false;
            $this->validationErrors["species"] = "Species is required";
		}
		

		// validating "age"!

		        
		if(!is_numeric($this->age) || $this->age < 0 || $this->age > 60){
            $valid = false;
            $this->validationErrors["age"] = "Age is not valid";
        }

		// validating "availability"
		
		if (!is_bool($this->available)) {
			$valid = false;
			$this->validationErrors["available"] = "The available_for_adoption setting is not valid";
		}
		
		return $valid;
	}

}
