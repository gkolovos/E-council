<?php
  //connection to database
  $db = mysqli_connect('localhost','root','', 'ecounicldb');
  if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
  }

abstract class User {
  protected $username = " ";
  protected $lastname = " ";
  protected $firstname = " ";
  protected $password = " ";
  protected $email = " ";
  protected $id = 0;
  protected $level = " ";

  abstract protected function allow();

  public function __construct($username,$lastname,$firstname,$password,$email,$id,$level) {
    $this->username = $_POST['username'];
    $this->lastname = $_POST['lastname'];
    $this->firstname = $_POST['firstname'];
    $this->password = $_POST['password'];
    $this->email = $_POST['email'];
    $this->id = $_POST['id'];
    $this->level = $_POST['level'];
  }
}

class Student extends User {

  private $subject_by;
  private $countpost;
  private $countsolution;
  private $countvotesolution;

  public function __construct($username,$lastname,$firstname,$password,$email,$id,$level,$etos,$subject_by,$countpost,$countsolution,$countvotesolution) {
    parent::__construct($username,$lastname,$firstname,$password,$email,$id,$level);
    $this->subject_by = $_POST['subject_by'];
    $this->countpost = $countpost;
    $this->countsolution = $countsolution;
    $this->countvotesolution = $countvotesolution;
  }
  //getter gia to orio tou student sto na parathesei subject
  public function getCountPost() {
    $query = "SELECT countpost FROM student WHERE student_id = '$student_id'";
    $results = mysqli_query($db, $query);
    while($row = mysql_fetch_array($results, MYSQL_BOTH) {
     $countpost .= $row['countpost'];
    }
    return $this->countpost;
  }
  //elegxos an epitrepete ston student na parathesei subject, tou epitrepete 5 subject ana session
  public function allow($countpost,$student_id) {
    if ($countpost > 0) {
      $countpost = $countpost - 1;
      $query = "UPDATE student SET countpost = '$countpost'  WHERE student_id = '$student_id'";
      mysqli_query($db, $query);
      header("Location: Post_subject.php");
    } else {
      echo "Den epitrepete na parathesete thema, exete ipervei to orio";
    }
  }
  //getter gia to orio tou student sto na parathesei solution
  public function getCountSolution() {
    $query = "SELECT countsolution FROM submittedsolutions WHERE sub_student = '$student_id' AND onsubject = '$subject_id' ";
    $results = mysqli_query($db, $query);
    while($row = mysql_fetch_array($results, MYSQL_BOTH) {
     $countsolution .= $row['countsolution'];
    }
    return $this->countsolution;
  }
  //elegxos an epitrepete ston student na parathesei solution, tou epitrepete mono 1 solution se kathe ena subject ana session
  public function allow($countsolution,$student_id,$subject_id) {
    if ($countsolution > 0) {
      $countsolution = $countsolution - 1;
      $query = "UPDATE submittedsolutions SET countsolution = '$countsolution'  WHERE sub_student = '$student_id' AND onsubject = '$subject_id'";
      mysqli_query($db, $query);
      header("Location: Post_solution.php");
    } else {
      echo "Den epitrepete na parathesete lisi, exete ipervei to orio";
    }
  }
  //getter gia to orio tou student sto na psifisei solution
  public function getCountVoteSolution() {
    $query = "SELECT countvotesolution FROM student WHERE student_id = '$student_id'";
    $results = mysqli_query($db, $query);
    while($row = mysql_fetch_array($results, MYSQL_BOTH) {
     $countvotesolution .= $row['countvotesolution'];
    }
    return $this->countvotesolution;
  }
  //elegxos an epitrepete ston student na psifisei solution, tou epitrepete ana session
  public function allow($countvotesolution,$student_id) {
    if ($countsolution > 0) {
      $countvotesolution = $countvotesolution - 1;
      $query = "UPDATE student SET countpost = '$countvotesolution'  WHERE student_id = '$student_id'";
      mysqli_query($db, $query);
      header("Location: Vote_solution.php");
    } else {
      echo "Den epitrepete na psifisi allo sinolo liseon, exete idi psifisei";
    }
  }
}

class Moderator extends User {
  private $subjectok = 0;
  private $commentok = 0;

  public function __construct() {
    parent::__construct($username,$lastname,$firstname,$password,$email,$id,$level);
    $this->subjectok = $_POST['subjectok'];
    $this->commentok = $_POST['commentok'];
  }

  //analoga me tin krisi tou moderator i metabliti subjectok kathorizei an to subject itan katallilo i oxi
  public function subjectIsAppropriate($subjectok,$id) {
    if ($subjectok == 1) {
      $query = "UPDATE subjects SET subject_checked = 1 WHERE subject_id = '$id'";
      mysqli_query($db, $quert);
      echo "Subject now appropriate";
    } else {
      $query = "DELETE FROM subjects WHERE subject_id = '$id'";
      mysqli_query($db, $quert);
      echo "Subject deleted successfully";
    }
  }
  //antistoixa me tin parapano methodo elegxei an to comment itan katallilo i oxi
  public function commentIsAppropriate($id,$commentok) {
    if ($commentok == 1) {
      $query = "UPDATE comments SET comment_checked = 1 WHERE comment_id = '$id'";
      mysqli_query($db, $quert);
      echo "Comment now appropriate";
    } else {
      $query = "DELETE FROM comments WHERE comment_id = '$id'";
      mysqli_query($db, $quert);
      echo "Subject deleted successfully";
    }
  }
  //epistrefei ola ta subject poy den einai filtrarismena, ean den iparxoun sinexizei kai epistrefei ta comment se subject poy den einai filtrarismena
  public function selectUnfilteredSubjects() {
    $query = "SELECT subject_id,subject_name,subject_description FROM subjects WHERE subject_checked = '0' ORDER BY subject_id ASC";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        echo "subject_id: " . $row["subject_id"]. "<br>""subject_name" .$row['subject_name']. "&nbsp&nbspSubject_description&nbsp" .$row['subject_description']. ;
       }
    } else {
      echo "All subjects are filtered";
      echo "Now looking for unfiltered comments on subjects";
      $query = "SELECT comment_id,comment_content,comment_subject FROM comments WHERE comment_checked = '0' ORDER BY comment_subject ASC";
      $results = mysqli_query($db, $query);
      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          echo "comment_id: " . $row["comment_id"]. "<br>""comment_content" .$row["comment_content"]. "&nbsp&nbspComment from subject:&nbsp" .$row['comment_subject']. ;
         }
      } else {
        echo "All comments are filtered ";
      }
    }
  }
  //elegxei an kapoio subject einai diplotipo se periexomeno me kapoio allo.anaferete se
  //ksexwristous xristes kai apaitei enan algorithmo posostou omoiotitas
  public function subjectDuplicate() {
    //if-else
  }
}

class Admin extends User {

  public function __construct() {
  parent::__construct($username,$lastname,$firstname,$password,$email,$id,$level);
  }
}

class Professor extends User {

  public function __construct() {
    parent::__construct($username,$lastname,$firstname,$password,$email,$id,$level)
  }

  public function postSHSubject() {

  }
}
?>
