<?php 
include_once('../confi.php');
include '../do_passwordHash.php';
include '../assignVerifyJWT.php';
error_reporting(E_ALL);

//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$email = trim(strtolower($request->email));
@$password = generate_hash($request->password);
$one = 1;
$null = NULL;

try {
  $conn = new mysqli($db_host, $db_username, $db_pass, $db_name);
  $now = new DateTime();  
  $date = $now->format('Y-m-d H:i:s');

  $sql2 = "INSERT INTO users(email , password, secure_key, timeStampField) VALUES (?,?,?,?)";  

  $alreadyRegisteredSql = "SELECT * , users.email FROM users WHERE email = ?";

  if ( !mysqli_connect_error() )
  {   
    $prepared = $conn->prepare($alreadyRegisteredSql);
    $prepared->bind_param('s', $email);
    $result =$prepared->execute(); 
    $getresult = $prepared->get_result();
    $row = $getresult->fetch_assoc();
    $prepared->close();

    if( !$row["email"])
    { 
      if(strlen($email) > 4)
      {
        $prepared2 = $conn->prepare($sql2);
        $prepared2->bind_param("ssis", $email, $password, $null, $date);
        $result2=$prepared2->execute(); 
        $usersId = $conn->insert_id;
        $prepared2->close();

        $data[] = array("status" => 200, "userId" => $usersId, "message" => "Registered email and password", 'JWT' => assignVerifyToken((string)$usersId), 'email' => $email );  

        echo json_encode($data);
      }
      else
      {
        //length of email is 0
        $data = ['message' => "Not An Email Address"];
        echo json_encode($data);
      }  
    }
    else 
    {         
      $data = ['message' => "Account With That Email Exists, Cannot Register"];

      // clear the old headers
      header_remove();
      // set the actual code
      http_response_code(200);
      // set the header to make sure cache is forced
      header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
      // treat this as json
      header('Content-Type: application/json');
      // successful request
      header('Status: 200 OK');
      // return the encoded json
      /*return json_encode(array(
      'status' => 200, // success or not?
      'data' => $data
      ));
      */
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