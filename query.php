<?php
/**
 * query class created to connect to mysqli server and aaccess data from the database.
 */
class query {
  /**
   * @var string servername holds the server name.
   */
  private $servername = "localhost";
  /**
   * @var string username holds the database user name.
   */
  private $username = "garvita";
  /**
   * @var string servername holds the pasword for database user.
   */
  private $password = "1234";
  /**
   * @var string db holds the database name.
   */
  private $db = "employee";
  /**
   * @var string con holds the instance of mysqli server.
   */
  public $con;

  /**
   * Constructor for establishing connection with mysqli server.
   */
  public function __construct() {

    //Holds connection with the mysql server.
    $this->con = new mysqli($this->servername,$this->username,$this->password,$this->db);

    //Condition to check whether connection is established or not.
    if($this->con->connect_error) {
      die("connection failed:" . $this->con->connect_error);
    }

    //Selects required database.
    $this->con->select_db($this->db);
  }

  /**
   * Created to display result of first query.
   * 
   * @return void
   */
  public function query1(){
    echo "<h4>First Query Results:</h4>";

    //Query to extract first name of employee who have salary greater than 50k from database.
    $sql = "select d.employee_first_name from employee_details_table as d join employee_salary_table as s on d.employee_id = s.employee_id where s.employee_salary > '50k'";
    $result = $this->con->query($sql);
    
    //Condition to display records obtained as result of query. 
    if ($result->num_rows > 0) {
     echo "<table>";
     echo "<table border = 1>";
     echo "<tr>";
     echo "<th>" . "Employee First Name" ."</th>";
     echo "</tr>";
     //Loop to fetch record from the variable and display it within the table.
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

/**
 * Created to display result of second query.
 * 
 * @return void
 */
public function query2(){
  echo "<h4>Second Query Results:</h4>";

  //Query to extract last name of employee who have graduation percentile greater than 70% from database.
  $sql = "select employee_last_name from employee_details_table where Graduation_percentile > '70%'";
  $result = $this->con->query($sql);

  //Condition to display records obtained as result of query.
  if ($result->num_rows > 0) {
   echo "<table>";
   echo "<table border = 1>";
   echo "<tr>";
   echo "<th>" . "Employee Last Name" ."</th>";
   echo "</tr>";
   //Loop to fetch record from the variable and display it within the table.
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

/**
 * Created to display result of third query.
 * 
 * @return void
 */
public function query3(){
  echo "<h4>Third Query Results:</h4>";

  //Query to extract employee code name of employee who have graduation percentile less than 70% from database.
  $sql = "select c.employee_code_name from employee_code_table as c join employee_salary_table as s on c.employee_code = s.employee_code join employee_details_table as d on d.employee_id = s.employee_id where d.Graduation_percentile < '70%'";
  $result = $this->con->query($sql);
  
  //Condition to display records obtained as result of query.
  if ($result->num_rows > 0) {
   echo "<table>";
   echo "<table border = 1>";
   echo "<tr>";
   echo "<th>" . "Employee Code Name" ."</th>";
   echo "</tr>";
   //Loop to fetch record from the variable and display it within the table.
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

/**
 * Created to display result of fourth query.
 * 
 * @return void
 */
public function query4(){
  echo "<h4>Fourth Query Results:</h4>";

  //Query to extract full name of employee who have domain other than Java from database.
  $sql = "select concat(d.employee_first_name,' ',d.employee_last_name) as employee_full_name from employee_details_table as d join employee_salary_table as s on d.employee_id = s.employee_id join employee_code_table as c on c.employee_code = s.employee_code where not c.employee_domain = 'Java'";
  $result = $this->con->query($sql);
  
  //Condition to display records obtained as result of query.
  if ($result->num_rows > 0) {
   echo "<table>";
   echo "<table border = 1>";
   echo "<tr>";
   echo "<th>" . "Employee Full Name" ."</th>";
   echo "</tr>";
   //Loop to fetch record from the variable and display it within the table.
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

/**
 * Created to display result of fifth query.
 * 
 * @return void
 */
public function query5(){
  echo "<h4>Fifth Query Results:</h4>";

  //Query to extract domain and aggregate salary from database.
  $sql = "select c.employee_domain,sum(s.employee_salary) as salary from employee_salary_table as s join employee_code_table as c on c.employee_code = s.employee_code group by c.employee_domain";
  $result = $this->con->query($sql);
  
  //Condition to display records obtained as result of query.
  if ($result->num_rows > 0) {
   echo "<table>";
   echo "<table border = 1>";
   echo "<tr>";
   echo "<th>" . "Employee Domain" ."</th>";
   echo "<th>" . "Salary" . "</th>";
   echo "</tr>";
   //Loop to fetch record from the variable and display it within the table.
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

/**
 * Created to display result of sixth query.
 * 
 * @return void
 */
public function query6(){
  echo "<h4>Sixth Query Results:</h4>";

  //Query to extract domain and aggregate salary where aggregate salary is greater than 30k from database.
  $sql = "select c.employee_domain,sum(s.employee_salary) as salary from employee_salary_table as s join employee_code_table as c on c.employee_code = s.employee_code group by c.employee_domain having salary > '30k'";
  $result = $this->con->query($sql);
  
  //Condition to display records obtained as result of query.
  if ($result->num_rows > 0) {
   echo "<table>";
   echo "<table border = 1>";
   echo "<tr>";
   echo "<th>" . "Employee Domain" ."</th>";
   echo "<th>" . "Salary" . "</th>";
   echo "</tr>";
   //Loop to fetch record from the variable and display it within the table.
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

/**
 * Created to display result of seventh query.
 * 
 * @return void
 */
public function query7(){
  echo "<h4>Seventh Query Results:</h4>";

  //Query to extract employee id of employee whose employee code is not specified from database.
  $sql = "select employee_id from employee_salary_table where employee_code = NULL";
  $result = $this->con->query($sql);
  
  //Condition to display records obtained as result of query.
  if ($result->num_rows > 0) {
   echo "<table>";
   echo "<table border = 1>";
   echo "<tr>";
   echo "<th>" . "Employee ID" ."</th>";
   echo "</tr>";
   //Loop to fetch record from the variable and display it within the table.
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

/**
 * Destructor for closing connection with mysqli server.
 */
public function __destruct(){
  $this->con->close();
}
}
//Instance of class query.
$question = new query();
//Instance used to call required functions.
$question->query1();
$question->query2();
$question->query3();
$question->query4();
$question->query5();
$question->query6();
$question->query7();
?>
