<?php
include_once('../confi.php');
error_reporting(E_ALL);

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

//

// $storename = trim(strtolower($request->storename));
// $address = generate_hash($request->address);
// $city = generate_hash($request->city);
// $state = generate_hash($request->state);
// $postalcode = generate_hash($request->postalcode);
// $storeclosedate = trim(strtolower($request->storeclosedate));
// $currentpercentlow = generate_hash($request->currentpercentlow);
// $currentpercenthigh = trim(strtolower($request->currentpercenthigh));
//

// $string = mysqli_real_escape_string($request->paramString);
$string = "WHERE storename='bob burgers'";
$data = [];

try
{
  if ( !mysqli_connect_error() )
  {
    //Get the variables here end
    $sql = "SELECT *, storepost.id AS storeId FROM storepost INNER JOIN storepost_type_mm ON storepost_type_mm.storepostId= storepost.id INNER JOIN storeposttype ON storepost_type_mm.storeposttypeId=storeposttype.id ".$string;

    $result = $conn->query($sql);

    if($result){
      while( $row = $result->fetch_assoc()){
        array_push($data, [ "storeId" =>$row['storeId'],  "storename" => $row['storename'], "address" => $row['address'], "city" => $row['city'], "state" => $row['state'], "postalcode" => $row['postalCode'], "storeclosedate" => $row['storeclosedate'], "currentpercentofflow" => $row['currentpercentofflow'], "currentpercentoffhigh" => $row['currentpercentoffhigh'] ] );
      }
    }

    /* Output header */
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
    echo json_encode($data);
  }
  else
  {
    http_response_code(500);
    header("HTTP/1.0 500 Internal Server Error");
    echo json_encode($e->message);
  }
  $conn->close(); 
}
catch (Exception $e )
{
  http_response_code(500);
  header("HTTP/1.0 500 Internal Server Error");
  echo json_encode($e->message);
}
?>