<?php
class employee {
  private $servername = "localhost";
  private $username = "garvita";
  private $password = "1234";
  private $db = "employee";
  public $con;

  public $employee_code , $employee_code_name , $employee_domain, $employee_salary ="";
  public $employee_id, $employee_first_name, $employee_last_name, $Graduation_percentile ="";

  public function __construct() {
    $this->con = new mysqli($this->servername,$this->username,$this->password,$this->db);
    if($this->con->connect_error) {
      die("connection failed:" . $this->con->connect_error);
    }
    $this->con->select_db($this->db);
  }
  public function codeTable(){
    $sql = "CREATE TABLE IF NOT EXISTS employee_code_table (
            employee_code varchar(100) PRIMARY KEY,
            employee_code_name varchar(100) NOT NULL,
            employee_domain char(100) NOT NULL
            )";
    if ($this->con->query($sql) !== TRUE) {
      echo "Error creating table : " . $this->con->error;
      return;
    }

  }
  public function salaryTable() {
    $sql ="CREATE TABLE IF NOT EXISTS employee_salary_table(
          employee_id varchar(20) PRIMARY KEY,
          employee_salary varchar(10) NOT NULL,
          employee_code varchar(100) NOT NULL,
          FOREIGN KEY(employee_code) REFERENCES employee_code_table(employee_code)
          )";
    if ($this->con->query($sql) !== TRUE) {
      echo "Error creating table : " . $this->con->error;
      return;
    }
  }
  public function detailsTable() {
    $sql ="CREATE TABLE IF NOT EXISTS employee_details_table(
          employee_id varchar(20),
          employee_first_name varchar(200) NOT NULL,
          employee_last_name varchar(200) NOT NULL,
          Graduation_percentile varchar(10)NOT NULL,
          FOREIGN KEY(employee_id) REFERENCES employee_salary_table(employee_id)
          )";
    if ($this->con->query($sql) !== TRUE) {
      echo "Error creating table : " . $this->con->error;
      return;
    }
  }
  public function insertCodeTable() {
    $this->employee_code = $_POST['employee_code'];
    $this->employee_code_name = $_POST['employee_code_name'];
    $this->employee_domain = $_POST['employee_domain'];
    $sql = "INSERT INTO employee_code_table(employee_code,employee_code_name,employee_domain) VALUES('" . $this->employee_code . "', '" . $this->employee_code_name."','" . $this->employee_domain ."')";
    if ($this->con->query($sql) !== TRUE) {
      echo "Error inserting data: " . $this->con->error;
  }
  }
  public function insertSalaryTable() {
    $this->employee_id = $_POST['employee_id'];
    $this->employee_salary = $_POST['employee_salary'];
    $this->employee_code = $_POST['employee_code'];
    $sql = "INSERT INTO employee_salary_table(employee_id,employee_salary,employee_code) VALUES('" . $this->employee_id . "', '" . $this->employee_salary."','" . $this->employee_code ."')";
    if ($this->con->query($sql) !== TRUE) {
      echo "Error inserting data: " . $this->con->error;
  }
  }
  public function insertDetailsTable() {
    $this->employee_id = $_POST['employee_id'];
    $this->employee_first_name = $_POST['employee_first_name'];
    $this->employee_last_name = $_POST['employee_last_name'];
    $this->Graduation_percentile = $_POST['Graduation_percentile'];
    $sql = "INSERT INTO employee_details_table(employee_id, employee_first_name, employee_last_name, Graduation_percentile) VALUES('" . $this->employee_id . "', '" . $this->employee_first_name . "', '" . $this->employee_last_name . "', '" . $this->Graduation_percentile . "')";

    if ($this->con->query($sql) !== TRUE) {
      echo "Error inserting data: " . $this->con->error;
  }
  }
  public function __destruct(){
    $this->con->close();
  }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user = new employee();
  $user->codeTable();
  $user->salaryTable();
  $user->detailsTable();
  $user->insertCodeTable();
  $user->insertSalaryTable();
  $user->insertDetailsTable();
}
?>
