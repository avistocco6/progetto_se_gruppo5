<?php
//php code to send email to maintainer and to production manager
include_once '..\PgConnection.php';

function getemailmain(){

  $connector = new PgConnection();
  $conn = $connector->connect();

  if($conn == null) {
    return false;
  }

  $emailmain = $connector->query("SELECT email FROM Client WHERE username = 'Pippo1'");
  $row=pg_fetch_row($emailmain)[0];
  return $row;
}
function getemailproman(){

  $connector = new PgConnection();
  $conn = $connector->connect();

  if($conn == null) {
    return false;
  }

  $emailpro = $connector->query("SELECT email FROM Client WHERE username = 'ProManager'");
  $row=pg_fetch_row($emailpro)[0];
  return $row;
}
?>