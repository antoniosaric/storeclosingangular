<?php 
include_once('../confi.php');
include '../assignVerifyJWT.php';
error_reporting(E_ALL);

//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$participantId = trim(strtolower($request->participantId));
$JWT = trim(strtolower($request->JWT));
$storename = trim(strtolower($request->storename));
$postalcode = generate_hash($request->postalcode);
$storeclosedate = trim(strtolower($request->storeclosedate));
$currentpercentlow = generate_hash($request->currentpercentlow);
$currentpercenthigh = trim(strtolower($request->currentpercenthigh));
$now = new DateTime();  
$date = $now->format('Y-m-d H:i:s');
$one = 1;
$null = NULL;

if($JWT == assignVerifyToken((string)$participantId))
{
  try {

    $conn = new mysqli($db_host, $db_username, $db_pass, $db_name);
    $sql = "INSERT INTO storepost(storename, address, city, state, postalCode, storeclosedate, currentpercentofflow, currentpercentoffhigh, timeStampField) VALUES (?,?,?,?,?,?,?,?,?)";  

    if ( !mysqli_connect_error() )
    {   
      $prepared = $conn->prepare($sql);
      $prepared->bind_param('sssssssss', $email);
      $result =$prepared->execute(); 
      $getresult = $prepared->get_result();
      $row = $getresult->fetch_assoc();
      $prepared->close();

      if(strlen($getresult))
      {
          $prepared2 = $conn->prepare($sql2);
          $prepared2->bind_param("ssis", $email, $password, $null, $date);
          $result2=$prepared2->execute(); 
          $usersId = $conn->insert_id;
          $prepared2->close();

          $data[] = array("status" => 200, "message" => "created post" );  

          echo json_encode($data);
      }
      else 
      {         
        $data = ['message' => "could not make post"];

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