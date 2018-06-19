<?php 
  include_once('set_env.php');

  function assignVerifyToken($userId)
  {     
    $key = 'kdfjaslkjfu45876458u6ijeo3u23u98yt4htg2y32hfqwiuefh34uh45h3oj3po2o3';    

    $header = [
      'typ' => 'JWT',
      'alg' => 'HS256'
    ];

    $header = json_encode($header);
    $header = base64_encode($header);

    $payload = [
      'iss' => 'storeclosing.com',
      'userId' => $userId
    ];

    $payload = json_encode($payload);
    $payload = base64_encode($payload);

    $secret = '';

    $signature = hash_hmac('sha256', "$header.$payload", $key, true); 
    $signature = base64_encode($signature);

    $token = "$header.$payload.$signature";

    return $token;

  };

  // function verifyToken($userId)
  // {

  //   $header = [
  //     'typ' => 'JWT',
  //     'alg' => 'HS256'
  //   ];

  //   $header = json_encode($header);
  //   $header = base64_encode($header);

  //   $payload = [
  //     'iss' => 'levelplaysports.com',
  //     'userId' => $userId
  //   ];

  //   $payload = json_encode($payload);
  //   $payload = base64_encode($payload);

  //   $signature = hash_hmac('sha256', "$header.$payload", $_ENV['key'], true);
  //   $signature = base64_encode($signature);

  //   $token = "$header.$payload.$signature";

  //   return $token;

  // };



?>