<?php 
include '../set_env.php';
include '../do_passwordHash.php';
include_once('../assignVerifyJWT.php');

// include('../../../error_handler.php');
//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
// $email = $request->email;
$email = 'saric.tony@gmail.com';
// $pass = $request->password;
$pass = 'asdf';
$rowcount = 0;
$data = [ [ ] , [ ] ]; 
// [ [ user info ] , [ post info ] ]

try {
  $conn = new mysqli($db_host, $db_username, $db_pass, $db_name);
  if ( !mysqli_connect_error() )
  {
    $sql = "SELECT users.id AS userId, users.password AS password FROM users WHERE email =?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();


      $database_password  = $row["password"];
      if( $result && validate_pw($pass, $database_password))
      {
        //$rowcount=mysqli_num_rows($result);
        $rowcount=$result->num_rows;

        if ( $rowcount > 0 )
        {
              // while(  )
              // {
              // }

          $data[0] = [ 'userId' => $row["userId"], 'JWT' => assignVerifyToken((string)$row["userId"]), 'email' => $email  ];

          http_response_code(200);
          header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
          header('Content-Type: application/json');
          header('Status: 200 OK');

          echo json_encode($data);

        }
        else
        {
          http_response_code(403);
          header("HTTP/1.1 403 Forbidden");
        }
      }
      else
      {
        $data = [ 'message' => 'email or password incorrect' ];
        http_response_code(500);
        header("HTTP/1.0 500 Internal Server Error");
        echo json_encode($data);
      }
    $conn->close();
  }
  else
  {
    http_response_code(500);
    header("HTTP/1.0 500 Internal Server Error");
  }
}
catch (Exception $e ) 
{
  header("HTTP/1.0 500 Internal Server Error");
  echo($e->message);
}
?>