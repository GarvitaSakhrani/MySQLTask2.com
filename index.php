<?php
//Condition to verify if query parameter is passed within the URL, if true then redirects it to query.php file.
if(isset($_GET['q']) && $_GET['q'] === 'query'){
  header("Location: query.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mysql Task2</title>
</head>
<body>
<!-- Heading for the form -->
<h1>Employee Registration Form</h1>
<!-- Form starts here -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  
  <label for="employee_id">ID:</label><br>
  <input type="text" id="employee_id" name="employee_id">
  <br><br>

  <label for="employee_first_name">First Name:</label><br>
  <input type="text" id="employee_first_name" name="employee_first_name">
  <br><br>

  <label for="employee_last_name">Last Name:</label><br>
  <input type="text" id="employee_last_name" name="employee_last_name">
  <br><br>

  <label for="employee_code">Code:</label><br>
  <input type="text" id="employee_code" name="employee_code">
  <br><br>

  <label for="employee_code_name">Code Name:</label><br>
  <input type="text" id="employee_code_name" name="employee_code_name">
  <br><br>

  <label for="employee_domain">Domain:</label><br>
  <input type="text" id="employee_domain" name="employee_domain">
  <br><br>
  
  <label for="employee_salary">Salary:</label><br>
  <input type="text" id="employee_salary" name="employee_salary">
  <br><br>

  <label for="Graduation_percentile">Graduation Percentile:</label><br>
  <input type="text" id="Graduation_percentile" name="Graduation_percentile">
  <br><br>

  <input type="submit" value="Submit">
</form>
<!-- Incorporated form-validation file  -->
<?php require 'form-validation.php'?>
</body>
</html>
