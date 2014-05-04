<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('_db.php');

if( !isset($_REQUEST['ratings']) ) {
    print 'no ratings';
}
if( !isset($_REQUEST['session']) ) {
    print 'no session';
}

if( isset($_REQUEST['ratings']) && isset($_REQUEST['session']) ) {

  try {
    $dbh = getDatabaseHandle();
  } catch( PDOException $e ) {
    echo $e->getMessage();
  }

  if( $dbh ) {


    $session  = $_REQUEST['session'];
    $worker = $_REQUEST['worker'];
    $ratings = $_REQUEST['ratings'];


    for( $i = 0; $i < count($ratings); $i++ ) {
      $ratingPair = explode(';', $ratings[$i]);
      $qid = $ratingPair[0];
      $rating = $ratingPair[1];
      $sth = $dbh->prepare("INSERT INTO simplicityratings (questionid, session, worker, rating) VALUES(:qid, :session, :worker, :rating)");
      $sth->execute(array(':qid'=>$qid, ':session'=>$session, ':worker'=>$worker, ':rating'=>$rating));
    }
    
    print("SUCCESS");
  }
  else {
    print("FAILING");
  }
}
?>
