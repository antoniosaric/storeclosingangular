<?php 
include_once('../confi.php');
include '../assignVerifyJWT.php';
error_reporting(E_ALL);

//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$userId = (int)$request->userId;
$JWT = $request->JWT;

if($JWT == assignVerifyToken((string)$userId))
{
  try {

    $conn = new mysqli($db_host, $db_username, $db_pass, $db_name);

    $sql = "DELETE FROM users WHERE users.id=?";  

    if ( !mysqli_connect_error() )
    {   
      $prepared = $conn->prepare($sql);
      $prepared->bind_param('i', $userId);
      $result =$prepared->execute(); 
      $prepared->close();

      if($result)
      {
          $data[] = array("status" => 200, "message" => "post deleted" );  

          echo json_encode($data);
      }
      else 
      {         
        $data = ['message' => "delete error"];

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
}
else
{
  http_response_code(403);
  $data = ['message' => 'JWT failed'];
  echo json_encode($data);
}   

?>