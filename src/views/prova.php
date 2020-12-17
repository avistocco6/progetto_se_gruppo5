<?php
    include_once '..\PgConnection.php';
    header('Content-Type: application\json');
    if(isset($_POST['user'])){

        $maintainer =$_POST['user'];
        echo("il nome del manutentore è". $maintainer ); 
    } 

   function getemailmain(){

    $connector = new PgConnection();
    $conn = $connector->connect();

    if($conn == null) {
      return false;
    }

    $username =$_POST['user'];
    echo("il nome del manutentore è". $username ); 
    $emailmain = $connector->query("SELECT email FROM Client WHERE username = " . "'". $username . "'");
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