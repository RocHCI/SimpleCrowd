<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

include('_db.php');

if( !isset($_REQUEST['session']) ) {
    print 'no session info';
}
if( !isset($_REQUEST['worker']) ) {
    print 'no worker id';
}

if( isset($_REQUEST['session']) && isset($_REQUEST['worker']) ) {

    try {
        $dbh = getDatabaseHandle();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    if ($dbh) {
        $session = $_REQUEST['session'];
        $worker = $_REQUEST['worker'];
        $sth = $dbh->prepare("SELECT id, question FROM questions WHERE session=:session AND :worker NOT IN (SELECT worker FROM simplicityratings WHERE session=:session) ORDER BY RANDOM()");
        $sth->execute(array(':session'=>$session,':worker'=>$worker));

        // Return the results
	$retAry = array();
        while( $row = $sth->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT) ) {
        
	//$retAry["question"] = $row["question"];
	//$retAry["id"] = $row["id"];
        //print(json_encode($retAry));

		array_push($retAry, $row);
	}

        print(json_encode($retAry));
    } else {
        print("FAILING");
    }
}

?>
