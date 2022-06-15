<?php
session_start();
//DB接続
$tfid = $_POST['id'];
$user = $_SESSION['name'];
$dsn = "mysql:host=localhost;dbname=my-wp; charset=utf8";
$db_user = "root";
$db_pswd = "root";
$sql = "DELETE FROM `wp_mtssb_booking` WHERE user_name=:name and `booking_time`=:tfid"; 

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
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $user);
$stmt->bindValue(':tfid', $tfid);
$stmt->execute();


<h2>予約を取り消しました</h2>
<a href="test_reserve.php">ホーム</a>
?>