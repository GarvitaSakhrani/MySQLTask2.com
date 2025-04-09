<?php
class query {
  private $servername = "localhost";
  private $username = "garvita";
  private $password = "1234";
  private $db = "employee";
  public $con;

  public function __construct() {
    $this->con = new mysqli($this->servername,$this->username,$this->password,$this->db);
    if($this->con->connect_error) {
      die("connection failed:" . $this->con->connect_error);
    }
    $this->con->select_db($this->db);
  }

  public function query1(){
    echo "<h4>First Query Results:</h4>";
    $sql = "select d.employee_first_name from employee_details_table as d join employee_salary_table as s on d.employee_id = s.employee_id where s.employee_salary > '50k'";
    $result = $this->con->query($sql);

    if ($result->num_rows > 0) {
     echo "<table>";
     echo "<table border = 1>";
     echo "<tr>";
     echo "<th>" . "Employee First Name" ."</th>";
     echo "</tr>";
     while($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td>" . $row['employee_first_name'] . "</td>";
      echo "</tr>";
    }
      echo "</table>";
  }
  else{
    echo "No records Found.";
  } 
}
public function query2(){
  echo "<h4>Second Query Results:</h4>";
  $sql = "select employee_last_name from employee_details_table where Graduation_percentile > '70%'";
  $result = $this->con->query($sql);

  if ($result->num_rows > 0) {
   echo "<table>";
   echo "<table border = 1>";
   echo "<tr>";
   echo "<th>" . "Employee Last Name" ."</th>";
   echo "</tr>";
   while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['employee_last_name'] . "</td>";
    echo "</tr>";
  }
    echo "</table>";
}
else{
  echo "No records Found.";
} 
}
public function query3(){
  echo "<h4>Third Query Results:</h4>";
  $sql = "select c.employee_code_name from employee_code_table as c join employee_salary_table as s on c.employee_code = s.employee_code join employee_details_table as d on d.employee_id = s.employee_id where d.Graduation_percentile < '70%'";
  $result = $this->con->query($sql);

  if ($result->num_rows > 0) {
   echo "<table>";
   echo "<table border = 1>";
   echo "<tr>";
   echo "<th>" . "Employee Code Name" ."</th>";
   echo "</tr>";
   while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['employee_code_name'] . "</td>";
    echo "</tr>";
  }
    echo "</table>";
}
else{
  echo "No records Found.";
} 
}
public function query4(){
  echo "<h4>Fourth Query Results:</h4>";
  $sql = "select concat(d.employee_first_name,' ',d.employee_last_name) as employee_full_name from employee_details_table as d join employee_salary_table as s on d.employee_id = s.employee_id join employee_code_table as c on c.employee_code = s.employee_code where not c.employee_domain = 'Java'";
  $result = $this->con->query($sql);

  if ($result->num_rows > 0) {
   echo "<table>";
   echo "<table border = 1>";
   echo "<tr>";
   echo "<th>" . "Employee Full Name" ."</th>";
   echo "</tr>";
   while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['employee_full_name'] . "</td>";
    echo "</tr>";
  }
    echo "</table>";
}
else{
  echo "No records Found.";
} 
}
public function query5(){
  echo "<h4>Fifth Query Results:</h4>";
  $sql = "select c.employee_domain,sum(s.employee_salary) as salary from employee_salary_table as s join employee_code_table as c on c.employee_code = s.employee_code group by c.employee_domain";
  $result = $this->con->query($sql);
  
  if ($result->num_rows > 0) {
   echo "<table>";
   echo "<table border = 1>";
   echo "<tr>";
   echo "<th>" . "Employee Domain" ."</th>";
   echo "<th>" . "Salary" . "</th>";
   echo "</tr>";
   while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['employee_domain'] . "</td>";
    echo "<td>" . $row['salary'] . "</td>";
    echo "</tr>";
  }
    echo "</table>";
}
else{
  echo "No records Found.";
} 
}
public function query6(){
  echo "<h4>Sixth Query Results:</h4>";
  $sql = "select c.employee_domain,sum(s.employee_salary) as salary from employee_salary_table as s join employee_code_table as c on c.employee_code = s.employee_code group by c.employee_domain having salary > '30k'";
  $result = $this->con->query($sql);
  
  if ($result->num_rows > 0) {
   echo "<table>";
   echo "<table border = 1>";
   echo "<tr>";
   echo "<th>" . "Employee Domain" ."</th>";
   echo "<th>" . "Salary" . "</th>";
   echo "</tr>";
   while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['employee_domain'] . "</td>";
    echo "<td>" . $row['salary'] . "</td>";
    echo "</tr>";
  }
    echo "</table>";
}
else{
  echo "No records Found.";
} 
}
public function query7(){
  echo "<h4>Seventh Query Results:</h4>";
  $sql = "select employee_id from employee_salary_table where employee_code = NULL";
  $result = $this->con->query($sql);
  
  if ($result->num_rows > 0) {
   echo "<table>";
   echo "<table border = 1>";
   echo "<tr>";
   echo "<th>" . "Employee ID" ."</th>";
   echo "</tr>";
   while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['employee_id'] . "</td>";
    echo "</tr>";
  }
    echo "</table>";
}
else{
  echo "No records Found.";
} 
}
public function __destruct(){
  $this->con->close();
}
}
$question = new query();
$question->query1();
$question->query2();
$question->query3();
$question->query4();
$question->query5();
$question->query6();
$question->query7();
?>
