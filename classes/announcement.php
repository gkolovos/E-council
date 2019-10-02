<?php
  //connection to database
  $db = mysqli_connect('localhost','root','', 'ecounicldb');
  if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
  }

public class Announcement {
  private $announcement_id = 0;
  private $announcement_content = " ";
  private $announcement_date = GETDATE();
  private $announcement_by = " ";
  private $announcement_category = " ";
  private $kindofannouncement = " ";

  function __construct($announcement_id,$announcement_content,$announcement_date,$announcement_by,$announcement_category,$kindofannouncement) {
    $this->announcement_id = $announcement_id;
    $this->announcement_content = $_POST['announcement_content'];
    $this->announcement_date = GETDATE();
    $this->announcement_by = $_POST['username'];
    $this->announcement_category = $_POST['announcement_category'];
    $this->kindofannouncement = $_POST['kindofannouncement'];
  }
  //elegxos gia to an to announcement einai ligotero apo 200 xaraktires kai analoga me ton tipo tis anakoinosis nea i palia ginete antistoixa insert i update
  public function formatAnnouncement() {
    $stringlength = strlen($announcement_content);
    if ( $stringlength >= 200 ) {
      echo "Too many characters" ;
      header("Location: Post_announcement.php");
      die();
    } else {
      if ($kindofannouncement == 'new' ) {
        insertAnnouncement($announcement_content,$announcement_date,$announcement_by,$announcement_category);
        die();
      } else ($kindofannouncement == 'old') {
        updateAnnouncement($announcement_content,$announcement_id);
        die();
      }
    }
    }
  }
  //emfanisi olon ton announcement taksinomimeno me fthinousa imerominia
  public function selectAnnouncement() {
    $query = "SELECT * FROM announcements ORDER BY announcement_date DESC";
    $result = mysqli_query($db, $query);
      if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              echo ":announcement_id " . $row['announcement_id'].  "&nbsp&nbspContents&nbsp" .$row['announcement_content'].
              "&nbsp&nbspDate&nbsp" .$row['announcement_date']."&nbsp&nbspBy&nbsp" .$row['announcement_by']. "<br>" ;
            }
      } else {
            echo "0 results";
      }
  }
  public function insertAnnouncement($announcement_content,$announcement_date,$announcement_by,$announcement_category) {
      $query = "INSERT INTO announcements (announcement_content, announcement_date, announcement_by, announcement_category) VALUES ('$announcement_content','$announcement_date','$announcement_by','$announcement_category')";
      mysqli_query($db, $query);
  }

  public function updateAnnouncement($announcement_content,$announcement_id) {
    $query = "UPDATE announcement SET announcements_content = '$announcement_content'  WHERE anouncement_id = '$announcement_id'";
    mysqli_query($db, $query);
  }

  public function deleteAnnouncement($announcement_id) {
    $query = "DELETE FROM announcements WHERE anouncement_id = '$announcement_id' ";
    mysqli_query($db, $query);
  }
}

public class Results {
  private $result_id = 0;
  private $result_content = " ";
  private $aresult_date = GETDATE();

  function __construct() {

  }

  function showResults() {
      //results
  }
}
?>
