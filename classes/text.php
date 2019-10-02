<?php
abstract class Text {

protected $id = 0 ;
protected $content = " ";
protected $date = GETDATE();
protected $by =_POST['username'];
protected $checked=0;

abstract protected function format();
abstract protected function insert();

  function __construct($id,$content,$date,$by,$checked) {
    $this->id = $id;
    $this->content = $_POST['content'];
    $this->date = GETDATE();
    $this->by = $_POST['username'];
    $this->checked = $checked;
  }
}

public class Solutions {

  private $solution_subject;
  private $solution_vote_count = 0;
  public function __construct($id,$content,$date,$solution_subject,$by,$solution_vote_count) {
  parent::__construct($id,$content,$date,$by,$checked);
      $this->solution_subject = $_POST['solution_subject'];
      $this->solution_vote_count = $solution_vote_count;
  }
  //elegxos periexomenou tou solution an teirei tis prodiagrafes(ligotero apo 500 xaraktires)
  public function format($content,$date,$solution_subject,$by) {
    $stringlength = strlen($content);
    if ( $stringlength >= 500 ) {
      echo "Too many characters" ;
      header("Location: Post_solution.php");
      die();
    } else {
        insert($content,$date,$solution_subject,$by);
        die();
    }
  }
  //eisagogi tou neou solution pou anaferete se sigkekrimeno subject
  public function insert($content,$date,$solution_subject,$by) {
    $query = "INSERT INTO solutions (solution_content, solution_date, solution_subject, solution_by ) VALUES ('$ontent','$date','$solution_subject','$by')";
    mysqli_query($db, $query);
  }
  //diadikasia afksisis psifou enos solution otan afto psifizete
  public function updateSolutionVote($id) {
    $query = "SELECT solution_vote_count FROM solutions WHERE solution_id = '$id'";
    $results = mysqli_query($db, $query);
    while($row = mysql_fetch_array($results, MYSQL_BOTH) {
     $solution_vote_count .= $row['solution_vote_count'];
    }
    $solution_vote_count = $solution_vote_count + 1 ;
    $query = "UPDATE solution SET solution_vote_count = '$solution_vote_count'  WHERE solution_id = '$id'";
    mysqli_query($db, $query);
  }
  //emfanisi ton 10  subject,mazi me ta solutions tous, me to megalitero plithos apo psifous
  public function selectSolutions() {
    $query = "SELECT subjects.subject_name , subjects.subject_description , solutions.solutions_content FROM subjects,solutions WHERE subjects.subject_id = solutions.solution_subject
    ORDER BY subjects.subject_vote_count LIMIT 10 , solutions.solution_id DESC ";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        echo "subject_name: " . $row["subject_name"]. "<br>""subject_description" .$row['subject_description']. "&nbsp&nbspΛύση:&nbsp" .$row['solution_content']. "<br>" ;
       }
    } else {
      echo "0 results";
    }
  }
}

public class Subject {

  private $subject_description = " ";
  private $subject_cat = " ";
  private $subject_vote_count = 0;

  public function __construct($subject_description,$date,$by,$subject_cat,$content,$id,$checked,$subject_vote_count) {
    parent::__construct($id,$content,$date,$by,$checked);
    $this->subject_description = $_POST['subject_description'];
    $this->subject_cat = $_POST['category'];
    $this->subject_vote_count = $subject_vote_count;
  }
  //elegxos periexomenou tou subject an tirei tis prodiagrafes(ligotero apo 300 xaraktires)
  public function format($subject_description,$content,$subject_cat,$by) {
    $stringlength = strlen($subject_description);
    if ( $stringlength >= 300 ) {
      echo "Too many characters";
      header("Location: Post_subject.php");
      die();
    } else {
        insert_subject($subject_description,$content,$subject_cat,$by);
        die();
    }
  }
  //eisagogi tou neou subject sto pedio tou forum
  public function insert($subject_description,$content,$subject_cat,$by) {
    $query = "INSERT INTO subjects (subject_description, subject_date, subject_by, subject_name, subject_cat) VALUES ('$subject_description','$date','$by','$content','$subject_cat')";
    mysqli_query($db, $query);
  }
}

public class Comment {

  private $comment_subject = 0;

  public function __construct($id,$content,$date,$by,$comment_subject,$checked) {
    parent::__construct($id,$content,$date,$by,$checked);
    $this->comment_subject = $_POST['subject_id'];
  }
  //elegxos periexomenou tou comment an teirei tis prodiagrafes(ligotero apo 200 xaraktires)
  public function format($content,$by,$comment_subject) {
    $stringlength = strlen($comment_content);
    if ( $stringlength >= 200 ) {
      echo "Too many characters" ;
      header("Location: Post_comment.php");
      die();
    } else {
        insert($content,$by,$comment_subject);
        die();
    }
  }
  //eisagogi tou neou comment sto pedio tou forum
  public function insert($content,$by,$comment_subject) {
    $query = "INSERT INTO comments (comment_content, comment_date, comment_by, comment_subject, comment_checked) VALUES ('$comment_content','$comment_date','$comment_by','$comment_subject','$comment_checked')";
    mysqli_query($db, $query);
  }
}
?>
