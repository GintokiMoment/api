<?php
include_once("../includes/models/Animal.inc.php");

// Valid animal...

$options = array(
        'id' => 1,
        'name' => "Bingo",
        'species' => "mouse",
        'age' => 1,
        'available' => true
);

// This array will store the test results
$testResults = array();

// run the test functions
testConstructor();
testIsValid();


// display the results
echo(implode("<br>",$testResults));

function testConstructor(){
	global $testResults, $options;
	$testResults[] = "<b>Testing the constructor...</b>";

	// TEST - Make sure we can create an Animal object
	$a = new Animal();

    	
	if($a){
		$testResults[] = "PASS - Created instance of Animal model object";
	}else{
		$testResults[] = "FAIL - DID NOT creat instance of an Animal model object";
	}

    // TEST, Make sure name is set properly..

    $a = new Animal($options);

    if($a->id === 1){
        $testResults[] = "PASS - Set id properly";
	}else{
		$testResults[] = "FAIL - DID NOT set id properly";
	}
    

    if($a->name == "Bingo"){
		$testResults[] = "PASS - Set name properly";
	}else{
		$testResults[] = "FAIL - DID NOT set name properly";
	}

    
	if($a->species === "mouse"){
		$testResults[] = "PASS - Set species properly";
	}else{
		$testResults[] = "FAIL - DID NOT set species properly";
	}
    
    
	if($a->age === 1){
		$testResults[] = "PASS - Set age properly";
	}else{
		$testResults[] = "FAIL - DID NOT set age properly";
	}
    
    if($a->available == "yes"){ // can also be yes! 
		$testResults[] = "PASS - Set available_for_adoption properly";
	}else{
		$testResults[] = "FAIL - DID NOT set available_for_adoption properly";
	}


}

function testIsValid(){
	global $testResults, $options;
	$testResults[] = "<b>Testing isValid()...</b>";
		
	// isValid() should return false when the ID is not numeric
	$a = new Animal($options);
	$a->id = "";

	
	if($a->isValid() === false){
		$testResults[] = "PASS - isValid() returns false when ID is not numeric";
	}else{
		$testResults[] = "FAIL - isValid() DOES NOT return false when ID is not numeric";
	}

	// isValid() should return false when the ID is a negative number
	$a->id = -1;
	if($a->isValid() === false){
		$testResults[] = "PASS - isValid() returns false when ID is a negative number";
	}else{
		$testResults[] = "FAIL - isValid() DOES NOT return false when ID is a negative number";
	}

	// If the ID is not valid, then the validation errors array should include an 'id' key
	$errors = $a->getValidationErrors();
	if(isset($errors['id'])){
		$testResults[] = "PASS - validationErrors includes key for ID";
	}else{
		$testResults[] = "FAIL - validationErrors does NOT include key for ID";
	}

	// ANIMAL NAME

	$a = new Animal($options);
	$a->name = "";
	if($a->isValid() === false){
		$testResults[] = "PASS - isValid() returns false when name is empty";
	}else{
		$testResults[] = "FAIL - isValid() DOES NOT return false when name is empty";
	}


	// When the name is longer than 30 characters, isValid() should return false
	$a = new Animal($options);
	$a->name = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
	if($a->isValid() === false){
		$testResults[] = "PASS - isValid() returns false when name is too long";
	}else{
		$testResults[] = "FAIL - isValid() DOES NOT return false when name is too long";
	}

	// ANIMAL SPECIES
	$a = new Animal($options);
	$a->species = "snake";
	if($a->isValid() === false){
		$testResults[] = "PASS - isValid() returns false when species is not valid";
	}else{
		$testResults[] = "FAIL - isValid() DOES NOT return false when species is not valid";
	}


	$a = new Animal($options);
	$a->species = "";
	if($a->isValid() === false){
		$testResults[] = "PASS - isValid() returns false when species is empty";
	}else{
		$testResults[] = "FAIL - isValid() DOES NOT return false when species is empty";
	}

	// ANIMAL AGE

	$a = new Animal($options);
	$a->age = "";

	
	if($a->isValid() === false){
		$testResults[] = "PASS - isValid() returns false when age is not numeric";
	}else{
		$testResults[] = "FAIL - isValid() DOES NOT return false when age is not numeric";
	}

	// isValid() should return false when the age is a negative number
	$a->age = -1;
	if($a->isValid() === false){
		$testResults[] = "PASS - isValid() returns false when ID is a negative number";
	}else{
		$testResults[] = "FAIL - isValid() DOES NOT return false when ID is a negative number";
	}

	// ANIMAL AVAILABLE

	$a = new Animal($options);
	$a->available = "";

	if($a->isValid() === false){
		$testResults[] = "PASS - isValid() returns false when the availability is not valid";
	}else{
		$testResults[] = "FAIL - isValid() DOES NOT return false when the availability is not valid";
	}

	// When the user is valid, isValid() should return true
	$a = new Animal($options);

	if($a->isValid() === true){
		$testResults[] = "PASS - isValid() returns true when the animal is valid";
	}else{
		$testResults[] = "FAIL - isValid() DOES NOT return true when the animal is valid";
	}

	// When the animal is valid, the validation errors should be an empty array
	$errors = $a->getValidationErrors();
	if(empty($errors)){
		$testResults[] = "PASS - There are no error messages when the animal is valid";
	}else{
		$testResults[] = "FAIL - There ARE error messages when the animal is valid";
	}



}

?>