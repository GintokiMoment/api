<?php
include_once("../includes/models/Vaccination.inc.php");

// Valid vaccination vaccination..

$options = array(
    'id' => 2,
    'animalId' => 2,
    'vacName' => "Feline Distemper",
    'date' => "2023-10-08"
);

// This array will store the test results
$testResults = array();

// Defining the isDateValid function inside.. 
function isDateValid($dateStr) {
    $date = DateTime::createFromFormat('Y-m-d', $dateStr);
    return $date && $date->format('Y-m-d') === $dateStr;
}

// run the test functions
testConstructor();
testIsValid();

// display the results
echo(implode("<br>", $testResults));

function testConstructor() {

    global $testResults, $options;
    $testResults[] = "<b>Testing isValid()...</b>";

    // TEST - Make sure we can create an Vaccination object
	$v = new Vaccination();

    	
	if($v){
		$testResults[] = "PASS - Created instance of Vaccination model object";
	}else{
		$testResults[] = "FAIL - DID NOT creat instance of an Vaccination model object";
	}

    // TEST, Make sure name is set properly..

    $v = new Vaccination($options);

    if($v->id === 2){
        $testResults[] = "PASS - Set id properly";
	}else{
		$testResults[] = "FAIL - DID NOT set id properly";
	}

    if($v->animalId === 2){
        $testResults[] = "PASS - Set Animal ID properly";
	}else{
		$testResults[] = "FAIL - DID NOT set Animal ID properly";
	}
    

    if($v->vacName == "Feline Distemper"){
		$testResults[] = "PASS - Set name properly";
	}else{
		$testResults[] = "FAIL - DID NOT set name properly";
	}

    
	if($v->date === "2023-10-08"){
		$testResults[] = "PASS - Set date properly";
	}else{
		$testResults[] = "FAIL - DID NOT set date properly";
	}
    

}

function testIsValid() {
    global $testResults, $options;
    $testResults[] = "<b>Testing isValid()...</b>";

    // REGULAR ID 

    $v = new Vaccination($options);
    $v->id = "";

    if ($v->isValid() === false) {
        $testResults[] = "PASS - isValid() returns false when ID is not numeric";
    } else {
        $testResults[] = "FAIL - isValid() DOES NOT return false when ID is not numeric";
    }

    $v->id = -1;
    if ($v->isValid() === false) {
        $testResults[] = "PASS - isValid() returns false when ID is a negative number";
    } else {
        $testResults[] = "FAIL - isValid() DOES NOT return false when ID is a negative number";
    }

    // If the ID is not valid, then the validation errors array should include an 'id' key
	$errors = $v->getValidationErrors();
	if(isset($errors['id'])){
		$testResults[] = "PASS - validationErrors includes key for ID";
	}else{
		$testResults[] = "FAIL - validationErrors does NOT include key for ID";
	}

    // ANIMAL ID

    $v = new Vaccination($options);
    $v->animalId = "";

    if ($v->isValid() === false) {
        $testResults[] = "PASS - isValid() returns false when Animal ID is not numeric";
    } else {
        $testResults[] = "FAIL - isValid() DOES NOT return false when Animal ID is not numeric";
    }

    $v->id = -1;
    if ($v->isValid() === false) {
        $testResults[] = "PASS - isValid() returns false when Animal ID is a negative number";
    } else {
        $testResults[] = "FAIL - isValid() DOES NOT return false when Animal ID is a negative number";
    }

    // VACCINATION NAME

    $v = new Vaccination($options);
    $v->vacName = "";
    if ($v->isValid() === false) {
        $testResults[] = "PASS - isValid() returns false when vacName is empty";
    } else {
        $testResults[] = "FAIL - isValid() DOES NOT return false when vacName is empty";
    }

    $v = new Vaccination($options);
    $v->vacName = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
    if ($v->isValid() === false) {
        $testResults[] = "PASS - isValid() returns false when vacName is too long";
    } else {
        $testResults[] = "FAIL - isValid() DOES NOT return false when vacName is too long";
    }

    // VACCINATION DATE

    $v = new Vaccination($options);
    $v->date = "";
    if ($v->isValid() === false) {
        $testResults[] = "PASS - isValid() returns false when date is empty";
    } else {
        $testResults[] = "FAIL - isValid() DOES NOT return false when date is empty";
    }

    $v = new Vaccination($options);
    $v->date = "yib shmorga";
    if ($v->isValid() === false) {
        $testResults[] = "PASS - isValid() returns false if date is invalid.";
    } else {
        $testResults[] = "FAIL - isValid() returns true if date is invalid.";
    }

    //second test to see if date format is correct..
    $v = new Vaccination($options);
    $v->date = "11-22-2022";
    if ($v->isValid() === false) {
        $testResults[] = "PASS - isValid() returns false if date is incorrect format.";
    } else {
        $testResults[] = "FAIL - isValid() returns true if date is incorrect format.";
    }

    	// When the user is valid, isValid() should return true
	$v = new Vaccination($options);

	if($v->isValid() === true){
		$testResults[] = "PASS - isValid() returns true when the vaccination is valid";
	}else{
		$testResults[] = "FAIL - isValid() DOES NOT return true when the vaccination is valid";
	}

	// When the vaccination is valid, the validation errors should be an empty array
	$errors = $v->getValidationErrors();
	if(empty($errors)){
		$testResults[] = "PASS - There are no error messages when the vaccination is valid";
	}else{
		$testResults[] = "FAIL - There ARE error messages when the vaccination is valid";
	}



}
?>
