<link rel="stylesheet" href="./css/login.css">
<?php session_start(); ?>
<?php
$tfid = $_GET['tfid'];
$user = $_SESSION['name'];
require dirname(__FILE__) . '../../xserver_php/dsn.php';

try {
    //echo "接続成功\n"; 
    $pdo = new PDO($dsn, $db_user, $db_pswd,
    [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
  );
} catch (PDOException $e) {
    $msg = $e->getMessage();
    echo "接続失敗です" . $msg;
}

//DBユーザー予約日程取得
$get_sql = "SELECT `client` FROM `wp_mtssb_booking` WHERE booking_time=:tfid" ; 
$stmt = $pdo->prepare($get_sql);
$stmt->bindValue(':tfid', $tfid);
$stmt->execute();
$info = $stmt->fetchAll();

$client_list = [];
foreach($info as $i) {
  array_push($client_list, $i['client']);
}

foreach ($client_list as $info_line) {
  if ($user == explode('"', $info_line)[7]) {
    $send_sql = "DELETE FROM `wp_mtssb_booking` WHERE booking_time=:tfid and client=:line" ; 
    $stmt = $pdo->prepare($send_sql);
    $stmt->bindValue(':tfid', $tfid);
    $stmt->bindValue(':line', $info_line);
    $stmt->execute();
    break;
  }
}
?>

<div class="message">
  <h2>予約の取り消しが完了しました</h2><!--メッセージの出力-->
</div>
<div class="return">
  <a href="reserve.php">戻る</a>
</div>

