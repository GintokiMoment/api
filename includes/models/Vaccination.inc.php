<?php
include_once("Model.inc.php");

class Vaccination extends Model{

	// table: animal_vaccinations

	// INSTANCE VARIABLES
	public $id;
	public $animalId;
	public $vacName;
	public $date;

	
	/**
	 * Constructor for creating Contact model objects
	 * @param {asoociative array} $args 	key value pairs that map to the instance variables
	 *										NOTE: the $args param is OPTIONAL, if it is not passed in
	 * 										The default will be an empty array: []									
	 */


	public function __construct($args = []){

		$this->id = $args["id"] ?? 0;
        $this->animalId = $args["animalId"] ?? 0;
		$this->vacName = $args["vacName"] ?? "";
		$this->date = $args["date"] ?? "";
	
	}


	/**
	 * Validates the state of this object. 
	 * Returns true if it is valid, false otherwise.
	 * For any properties that are not valid, a key will be added
	 * to the validationErrors array and it's value will be a description of the error.
	 * 
	 * @return {boolean}
	 */


	public function isDateValid($dateStr){

		$date = DateTime::createFromFormat('Y-m-d', $dateStr);

		return $date && $date->format('Y-m-d') === $dateStr;
	}


	public function isValid(){
		
		$valid = true;
		$this->validationErrors = [];

		
		// there are many different vaccinations for all types of animal disease, if i wanted to go crazy I might take from a vaccination database but that scope is too wide. for now, simply length validation is alright.
		
        
		// validating vacc_ID..
		if(!is_numeric($this->id) || $this->id < 0){
            $valid = false;
            $this->validationErrors["id"] = "ID is not valid";
        }
    
		// validating animal_ID..
		if(!is_numeric($this->animalId) || $this->animalId < 0){
            $valid = false;
            $this->validationErrors["animalId"] = "Animal's ID is not valid";
        }    

		// validating vaccination name..

		
		if(empty($this->vacName)){
            $valid = false;
            $this->validationErrors["vacName"] = "Vaccination Name is required";
        }else if(strlen($this->vacName) > 30){
            $valid = false;
            $this->validationErrors["vacName"] = "Vaccination Name must be 50 characters or less";
        }

		// validating "date"

		if(empty($this->date)){
			$valid = false;
			$this->validationErrors["date"] = "The date is invalid";
		} else if (!isDateValid($this->date)){
			$valid = false;
			$this->validationErrors["date"] = "The date is invalid";
		}

		return $valid;
	}

}
