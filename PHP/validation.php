<?php
	function isUser($username) {
		//Checks whether the string provided is only composed of characters, letters and underscores, and is more than two characters long
		$isUsername = true;
		if (!preg_match("/^\w+$/", $username) || strlen($username) < 2) {
			$isUsername = false;
		}
		return $isUsername;
	}
	
	function isName($name) {
		//Checks whether the string only has letters in it, and is more than two characters long
		$isAName = true;
		if (!preg_match("/^[A-Za-z]+$/", $name) || strlen($name) < 2) {
			$isAName = false;
		}
		return $isAName;
	}
	
	function isEmail($email) {
		//Checks whether the string is a valid email
		$isAnEmail = true;
		if (!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/", $email)) {
			$isAnEmail = false;
		}
		return $isAnEmail;
	}
	
	function isStrongPassword($password) {
		// This method checks if a given string is has at least 1 number 1 special character, 3 letters and must
		// be at least 6 characters long

		if (strlen($password) < 6) {
			return false;
		}

		$specialChars = "!@#$%^&*()";
		$letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvxyz";
		$numberChar = "0123456789";
		$letterCount = 0; 
		$numberCount = 0;
		$specialCharCount = 0;
		$chars = str_split($password);
		
		//Count each type of character in password
		foreach ($chars as $char) {
			if (strpos($letters, $char)>=0) {
				$letterCount++;
				continue;
			}

			if (strpos($numberChar, $char)>=0) {
				$numberCount++;
				continue;
			}

			if (strpos($specialChars, $char)>=0) {
				$specialCharCount++;
				continue;
			}


			if (preg_match("/\w/", $char)) {
				continue;

			}
			// debug statement
			// echo "this character is returning false".$char;
			return false;

		}
		//return ($numberCount > 0);
		return true;
		// return ($numberCount > 0 && $specialCharCount > 0 && $letterCount > 2); 
	}
	
	function sanitize($value) {
		// Removes whitespaces, slashes and converts html characters for a particular string
		$value = trim($value);
		$value = stripslashes($value);
		$value = htmlspecialchars($value);
		return $value;
	}

	function isUserTypeUser() {
		if($_SESSION['type'] != "user"){
            header("Location:../../php/login.php");
        }
	}

	function isUserTypeTechnician() {
		if($_SESSION['type'] != "technician"){
            header("Location:../../php/login.php");
        }
	}

	function isUserTypeAdmin() {
		if($_SESSION['type'] != "admin"){
            header("Location:../../php/login.php");
        }
	}
?>