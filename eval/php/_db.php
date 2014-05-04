<?php
  function getDatabaseHandle() {
    //echo("Connecting to DB...");
    $dbh = new PDO("sqlite:../db/questions.db");
    //echo("Got DB handle.");
    return $dbh;
  }
?>
