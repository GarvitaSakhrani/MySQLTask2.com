<?php
/**
 * Employee class, created to connect to mysqli server and insert data into the database.
 */
class employee {
  /**
   * @var string servername holds the server name.
   */
  private $servername = "localhost";
  /**
   * @var string username holds the database user name.
   */
  private $username = "garvita";
  /** 
   * @var string password holds database user password to login.
   */
  private $password = "1234";
  /**
   * @var string db holds database name.
   */
  private $db = "employee";
  /**
   * @var con holds instance of mysqli.
   */
  public $con;
  /**
   * @var string employee_code, employee_code_name, employee_domain, employee_salary, employee_id, employee_first_name, employee_last_name, graduation_percentile defined as empty string to hold the value of fields within table.
   */
  public $employee_code , $employee_code_name , $employee_domain, $employee_salary ="";
  public $employee_id, $employee_first_name, $employee_last_name, $Graduation_percentile ="";

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
   * Implements the creation of code table.
   * 
   * @return void
   */
  public function codeTable(){

    //Query to create code table into database.
    $sql = "CREATE TABLE IF NOT EXISTS employee_code_table (
            employee_code varchar(100) PRIMARY KEY,
            employee_code_name varchar(100) NOT NULL,
            employee_domain char(100) NOT NULL
            )";

    //Checks if query executed successfully.        
    if ($this->con->query($sql) !== TRUE) {
      echo "Error creating table : " . $this->con->error;
      return;
    }

  }

  /**
   * Implements the creation of salary table.
   * 
   * @return void
   */
  public function salaryTable() {

    //Query to create salary table into database.
    $sql ="CREATE TABLE IF NOT EXISTS employee_salary_table(
          employee_id varchar(20) PRIMARY KEY,
          employee_salary varchar(10) NOT NULL,
          employee_code varchar(100) NOT NULL,
          FOREIGN KEY(employee_code) REFERENCES employee_code_table(employee_code)
          )";

    //Checks if query executed successfully.
    if ($this->con->query($sql) !== TRUE) {
      echo "Error creating table : " . $this->con->error;
      return;
    }
  }

  /**
   * Implements the creation of details table.
   * 
   * @return void
   */
  public function detailsTable() {

    //Query to create details table into database.
    $sql ="CREATE TABLE IF NOT EXISTS employee_details_table(
          employee_id varchar(20),
          employee_first_name varchar(200) NOT NULL,
          employee_last_name varchar(200) NOT NULL,
          Graduation_percentile varchar(10)NOT NULL,
          FOREIGN KEY(employee_id) REFERENCES employee_salary_table(employee_id)
          )";

    //Checks if query executed successfully.
    if ($this->con->query($sql) !== TRUE) {
      echo "Error creating table : " . $this->con->error;
      return;
    }
  }

  /**
   * Insert records into code table.
   * 
   * @return void
   */
  public function insertCodeTable() {

    //Initialisation of variables with data submitted within form.
    $this->employee_code = $_POST['employee_code'];
    $this->employee_code_name = $_POST['employee_code_name'];
    $this->employee_domain = $_POST['employee_domain'];

    //Query to insert records within the table.
    $sql = "INSERT INTO employee_code_table(employee_code,employee_code_name,employee_domain) VALUES('" . $this->employee_code . "', '" . $this->employee_code_name."','" . $this->employee_domain ."')";
    
    //Checks if query executed successfully.
    if ($this->con->query($sql) !== TRUE) {
      echo "Error inserting data: " . $this->con->error;
  }
  }

  /**
   * Insert records into salary table.
   * 
   * @return void
   */
  public function insertSalaryTable() {

    //Initialisation of variables with data submitted within form.
    $this->employee_id = $_POST['employee_id'];
    $this->employee_salary = $_POST['employee_salary'];
    $this->employee_code = $_POST['employee_code'];

    //Query to insert records within the table.
    $sql = "INSERT INTO employee_salary_table(employee_id,employee_salary,employee_code) VALUES('" . $this->employee_id . "', '" . $this->employee_salary."','" . $this->employee_code ."')";
    
    //Checks if query executed successfully.
    if ($this->con->query($sql) !== TRUE) {
      echo "Error inserting data: " . $this->con->error;
  }
  }

  /**
   * Insert records into details table.
   * 
   * @return void
   */
  public function insertDetailsTable() {

    //Initialisation of variables with data submitted within form.
    $this->employee_id = $_POST['employee_id'];
    $this->employee_first_name = $_POST['employee_first_name'];
    $this->employee_last_name = $_POST['employee_last_name'];
    $this->Graduation_percentile = $_POST['Graduation_percentile'];

    //Query to insert records within the table.
    $sql = "INSERT INTO employee_details_table(employee_id, employee_first_name, employee_last_name, Graduation_percentile) VALUES('" . $this->employee_id . "', '" . $this->employee_first_name . "', '" . $this->employee_last_name . "', '" . $this->Graduation_percentile . "')";
    
    //Checks if query executed successfully.
    if ($this->con->query($sql) !== TRUE) {
      echo "Error inserting data: " . $this->con->error;
  }
  }

  /**
   * Destructor for closing connection with mysqli server.
   */
  public function __destruct(){
    $this->con->close();
  }
}

//condition that creates instance only when form is submitted successfully.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //Instance of class employee.
  $user = new employee();
  //Instance used to call required functions.
  $user->codeTable();
  $user->salaryTable();
  $user->detailsTable();
  $user->insertCodeTable();
  $user->insertSalaryTable();
  $user->insertDetailsTable();
}
?>
