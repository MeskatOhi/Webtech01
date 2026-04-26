<!DOCTYPE html>
<html>
<head>
<title>Student Registration</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Student Registration Form</h2>

<?php
session_start();

$name = $email = $username = $password = $confirm = $age = $gender = $course = "";
$nameErr = $emailErr = $userErr = $passErr = $confirmErr = $ageErr = $genderErr = $courseErr = $termsErr = "";
$success = "";

if(isset($_POST["register"]))
{
    if(empty($_POST["name"]))
        $nameErr = "Name required";
    else{
        $name = $_POST["name"];
        if(!preg_match("/^[A-Za-z ]+$/", $name))
            $nameErr = "Only letters and spaces allowed";
    }

    if(empty($_POST["email"]))
        $emailErr = "Email required";
    else{
        $email = $_POST["email"];
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            $emailErr = "Invalid email";
    }

    if(empty($_POST["username"]))
        $userErr = "Username required";
    else{
        $username = $_POST["username"];
        if(strlen($username) < 5)
            $userErr = "Min 5 characters required";
    }

    if(empty($_POST["password"]))
        $passErr = "Password required";
    else{
        $password = $_POST["password"];
        if(strlen($password) < 6)
            $passErr = "Min 6 characters required";
    }

    if(empty($_POST["confirm"]))
        $confirmErr = "Confirm password required";
    else{
        $confirm = $_POST["confirm"];
        if($password != $confirm)
            $confirmErr = "Passwords do not match";
    }

    if(empty($_POST["age"]))
        $ageErr = "Age required";
    else{
        $age = $_POST["age"];
        if($age < 18)
            $ageErr = "Must be 18+";
    }

    if(empty($_POST["gender"]))
        $genderErr = "Select gender";
    else
        $gender = $_POST["gender"];

    if(empty($_POST["course"]))
        $courseErr = "Select course";
    else
        $course = $_POST["course"];

    if(!isset($_POST["terms"]))
        $termsErr = "Accept terms";

    if(empty($nameErr) && empty($emailErr) && empty($userErr) && empty($passErr) &&
       empty($confirmErr) && empty($ageErr) && empty($genderErr) &&
       empty($courseErr) && empty($termsErr))
    {
        $_SESSION["user"] = $username;
        setcookie("username", $username, time()+3600);
        $success = "Registration Successful!";
    }
}
?>

<form method="post">

<label>Full Name:</label><br>
<input type="text" name="name" value="<?php echo $name; ?>">
<span class="error"><?php echo $nameErr; ?></span><br>

<label>Email:</label><br>
<input type="text" name="email" value="<?php echo $email; ?>">
<span class="error"><?php echo $emailErr; ?></span><br>

<label>Username:</label><br>
<input type="text" name="username"
value="<?php echo isset($_COOKIE['username']) ? $_COOKIE['username'] : ''; ?>">
<span class="error"><?php echo $userErr; ?></span><br>

<label>Password:</label><br>
<input type="password" name="password">
<span class="error"><?php echo $passErr; ?></span><br>

<label>Confirm Password:</label><br>
<input type="password" name="confirm">
<span class="error"><?php echo $confirmErr; ?></span><br>

<label>Age:</label><br>
<input type="number" name="age" value="<?php echo $age; ?>">
<span class="error"><?php echo $ageErr; ?></span><br>

<label>Gender:</label><br>
<input type="radio" name="gender" value="Male"> Male
<input type="radio" name="gender" value="Female"> Female
<span class="error"><?php echo $genderErr; ?></span><br>

<label>Course:</label><br>
<select name="course">
<option value="">--Select--</option>
<option>CSE</option>
<option>EEE</option>
<option>BBA</option>
</select>
<span class="error"><?php echo $courseErr; ?></span><br>

<label>
<input type="checkbox" name="terms"> Accept Terms
</label>
<span class="error"><?php echo $termsErr; ?></span><br><br>

<input type="submit" name="register" value="Register">

</form>

<?php
if($success)
{
    echo "<p class='success'>$success</p>";
    echo "Name: $name <br>";
    echo "Email: $email <br>";
    echo "Username: $username <br>";
    echo "Age: $age <br>";
    echo "Gender: $gender <br>";
    echo "Course: $course <br>";
}
?>

</body>
</html>