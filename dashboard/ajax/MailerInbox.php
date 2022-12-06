<?php
session_start(); 
include '../conn.php';
   $customerId = $_SESSION['customerId'];

// echo  chack_login ();
$status = 0;

$url = "https://tigermed-eg.com/mail.php";
// ?from=lotfyaymanelnaggar@gmail.com&to=zxsofazx@gmail.com&name=New Mail&sub=Test The New Mail&mes=Test The New Mail With Mostafa Is Very Fun For Me\r\nI Love Mostafa Elbagory&postKay=1f76f21f7b174de3448d9d458f34a5e5c84d0297



if (!filter_var($_POST['from'], FILTER_VALIDATE_EMAIL) or !filter_var($_POST['to'], FILTER_VALIDATE_EMAIL) ) {
  $message = 'تحقق من البريد ';
  $code = 1;
  $status = 1;
} else {
  $to = filter_var($_POST['to'], FILTER_VALIDATE_EMAIL);
}
$from = filter_var($_POST['from'], FILTER_VALIDATE_EMAIL);

if (empty($_POST['name']) or empty($_POST['sub'] ) ) {
  $message = 'تحققق عنوان الرسالة أو الموضوع  ';
  $code = 2;
  $status = 1;
}else {
  
  $sub = filter_var($_POST['sub'], FILTER_SANITIZE_STRING);
  $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
}


// echo $from . ' / ' .$to ; 
// exit ;

if ($status == 0 ) {
$mes      = $_POST['mes'];
$pass_post = 'sofa_php';
$password =  sha1($pass_post);

$data = array(
  'from' => $from, 'name' => $name,
  'sub' => $sub, 'to' => $to,
  'mes' => $mes, 'postKay' => $password
);

$options = array(
  'http' =>
  array(
    'ignore_errors' => true,
    'method'  => 'POST',
    'header'  => 'Content-type: application/x-www-form-urlencoded; charset=UTF-8',
    'user-agent:'  => 'Mozilla/5.0 (iPhone; CPU iPhone OS 13_2_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/13.0.3 Mobile/15E148 Safari/604.1',
    'content' => http_build_query($data),
  ),

  'ssl' =>
  array(
    'verify_peer' => false,
    'verify_peer_name' => false,
  ),

);

$streamContext  = stream_context_create($options);
$result = file_get_contents($url, false, $streamContext);
$Array = json_decode($result);
$msgJeson  = $Array->status;
if ($msgJeson == 'dn') {
    $code = 'done'; 
    $message = 'تم إرسال الرسالة بنجاح ';
$sql = "INSERT INTO `orders` ( `id_user`, `date`, `Status`, `from`, `name`, `sub`, `to`) VALUES ('$customerId', now(), 0, '$from', '$name', '$sub', '$to');";
  $conn->query($sql);
$conn->close();


 }

  }


  echo json_encode(['status' => $code, 'msg' =>$message]);
