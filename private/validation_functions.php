<?php

  // is_blank('abcd')
  function is_blank($value='') {
    return !isset($value) || trim($value) == '';
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    $length = strlen($value);
    if(isset($options['max']) && ($length > $options['max'])) {
      return false;
    } elseif(isset($options['min']) && ($length < $options['min'])) {
      return false;
    } elseif(isset($options['exact']) && ($length != $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

  // has_valid_email_format('test@test.com')
  function has_valid_email_format($value) {
    //FILTER_VALIDATE_EMAIL is ONLY responsible for verifying valid email based on RFC5321
    //Need to use preg_match to whitelist special characters
    //- need to be placed at the start or end of []
    //Otherwise it will be interpretted as range
      if(filter_var($value, FILTER_VALIDATE_EMAIL) !== false && preg_match("/^[-A-Za-z0-9_@.']+$/ ", $value)){
        return true;
      }
  }

  //has_valid_user_name
  //Valid username can only contain A-Z, a-z, 0-9, and _
  function has_valid_user_name($value){
    return preg_match("/^[A-Za-z0-9_']+$/ ", $value);
  }

  //has_valid_phone_number
  //Valid phone number can only contain 0-9, spaces, and ()-
  function has_valid_phone_number($value){
    return preg_match("/^[0-9-() ']+$/ ", $value);
  }

  //Optional Validation Rule #1 has_valid_country_id
  //Valid country_id can only be a positive integer, less than 1000
  function has_valid_country_id($value){
    if($value>0 && $value<1000){
      return true;
    }
  }

  //Optional Validation Rule #2 has_valid_code
  //Valid code can only contain Capital letters
  function has_valid_code($value){
    return preg_match("/^[A-Z]+$/ ", $value);
  }

  //Optional Validation Rule #3 has_valid_state_id
  //Valid State_id can only be a positive integer, less than 1000
  function has_valid_state_id($value){
    if($value>0 && $value<1000){
      return true;
    }
  }

  //Optional Validation Rule #4 has_valid_position
  //Valid position can only be a positive intefer, less than 100
  function has_valid_position($value){
    if($value > 0 && $value < 100){
      return true;
    }
  }

  //Optional Validation Rule #5 has_valid_user_name
  //Valid name (including state name and territory name) can only contain A-Z, a-z, -
  function has_valid_name($value){
    return preg_match("/^[A-Za-z- ']+$/ ", $value);
  }

  //Bonus: unique username
  function is_unique_username($value){
    global $db;
    $sql = "SELECT * FROM users WHERE username=  $value  ;";
    $result = $db->query($sql);
    if ($result['num_rows'] >0){
      return false;
    }
  }


?>
