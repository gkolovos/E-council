<?php
  //connection to database
  $db = mysqli_connect('localhost','root','', 'ecounicldb');
  if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
  }

public class Session {

  private $session_id = 0;
  private $session_name = " ";
  private $start_date = GETDATE();
  private $end_date = GETDATE();
  private $avtivity_status = 0;
  private $extension = date_create("2019-05-19"); //getdate();
  private $next_session_id = 0;

  public function __construct($session_id,$session_name,$start_date,$end_date,$activity_numbers,$extension,$next_session_id) {
    $this->session_id = $_POST['session_id'];
    $this->session_name = $session_name ;
    $this->start_date = GETDATE();
    $this->end_date = $_POST['end_date'];
    $this->activity_numbers = $activity_numbers;
    $this->extension = $_POST['extension'];
    $this->next_session_id = $next_session_id;
  }
  //xroniki epektasi tou trexon session kai enimerosi tis start date tou epomenou
  public function updateSession($session_id,$extension,$end_date) {
    this->$end_date = date('Y-m-d', strtotime($end_date. " + {$extension} days "));
    this->$next_session_id = ($session_id + 1) % 3 ; //ginete me mod3 i praksi dioti ta id ton session ine 3 kai otan to session_id einai 3 theloume na pigenei apo tin arxi
    $query = "UPDATE sessions SET end_date = '$end_date'  WHERE session_id = '$session_id'";
    mysqli_query($db, $query);
    $query = "UPDATE sessions SET start_date = '$end_date'  WHERE session_id = '$next_session_id'";
    mysqli_query($db, $query);
    die();
  }
  //anakatefthinsi sto energo session
  public function redirectToActive() {
    $query = "SELECT session_id FROM sessions WHERE activity_numbers = '1'";
    $results = mysqli_query($db, $query);
    while($row = mysql_fetch_array($results, MYSQL_BOTH) {
      $session_id .= $row['session_id'];
    }
    if ($session_id == 0) {
      header("Location: Post_subject.php");
    } elseif ($session_id == 1) {
      header("Location: Post_solution.php");
    } else {
      header("Location: Vote_solution.php");
    }
    die();
  }
  //emfanisi pliroforion gia ola ta session
  public function selectSession() {
    $query = "SELECT * FROM sessions ";
    $result = mysqli_query($db, $query);
      if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              echo ":session_id " . $row["session_id"].  "&nbsp&nbspSession&nbspName&nbsp" .$row['session_name'].
              "&nbsp&nbspStart&nbspDate&nbsp" .$row['start_date']."&nbsp&nbspEnd&nbspDate&nbsp" .$row['end_date']."&nbsp&nbspActivity&nbsp" .$row['activity_numbers']. "<br>" ;
            }
      } else {
            echo "0 results";
      }
  }
  //epistrofi tou energou session
  public function sessionStatus() {
     $query = "SELECT * FROM sessions WHERE activity_status = '1' ";
     $result = mysqli_query($db, $query);
      if (mysqli_num_rows($result) == 1) {
            while($row = mysqli_fetch_assoc($result)) {
              echo ":session_id " . $row["session_id"].  "&nbsp&nbspSession&nbspName&nbsp" .$row['session_name'].
              "&nbsp&nbspStart&nbspDate&nbsp" .$row['start_date']."&nbsp&nbspEnd&nbspDate&nbsp" .$row['end_date']."&nbsp&nbspActivity&nbsp" .$row['activity_status']. "<br>" ;
            }
      } else {
            echo "0 results";
      }
  }
?>
