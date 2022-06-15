<?php
$test_info1 = 'a:14:{s:7:"company";s:0:"";s:4:"name";s:4:"aaaa";s:8:"furigana";s:0:"";s:8:"birthday";s:0:"";s:6:"gender";s:0:"";s:5:"email";s:14:"aaaa@aaaaa.com";s:8:"postcode";s:0:"";s:8:"address1";s:0:"";s:8:"address2";s:0:"";s:3:"tel";s:0:"";s:5:"adult";i:1;s:5:"child";i:0;s:4:"baby";i:0;s:3:"car";i:0;}';
$test_info2 = 'a:14:{s:7:"company";s:0:"";s:4:"name";s:4:"aaaa";s:8:"furigana";s:0:"";s:8:"birthday";s:0:"";s:6:"gender";s:0:"";s:5:"email";s:14:"aaaa@aaaaa.com";s:8:"postcode";s:0:"";s:8:"address1";s:0:"";s:8:"address2";s:0:"";s:3:"tel";s:0:"";s:5:"adult";i:1;s:5:"child";i:0;s:4:"baby";i:0;s:3:"car";i:0;}';
$test_info3 = 'a:14:{s:7:"company";s:0:"";s:4:"name";s:4:"aaaa";s:8:"furigana";s:0:"";s:8:"birthday";s:0:"";s:6:"gender";s:0:"";s:5:"email";s:14:"aaaa@aaaaa.com";s:8:"postcode";s:0:"";s:8:"address1";s:0:"";s:8:"address2";s:0:"";s:3:"tel";s:0:"";s:5:"adult";i:1;s:5:"child";i:0;s:4:"baby";i:0;s:3:"car";i:0;}';
$test_info4 = 'a:14:{s:7:"company";s:0:"";s:4:"name";s:12:"田中太郎";s:8:"furigana";s:0:"";s:8:"birthday";s:0:"";s:6:"gender";s:0:"";s:5:"email";s:22:"sample_taro@sample.com";s:8:"postcode";s:0:"";s:8:"address1";s:0:"";s:8:"address2";s:0:"";s:3:"tel";s:0:"";s:5:"adult";i:1;s:5:"child";i:0;s:4:"baby";i:0;s:3:"car";i:0;}';
$test_info5 = 'a:14:{s:7:"company";s:0:"";s:4:"name";s:4:"aaaa";s:8:"furigana";s:0:"";s:8:"birthday";s:0:"";s:6:"gender";s:0:"";s:5:"email";s:14:"aaaa@aaaaa.com";s:8:"postcode";s:0:"";s:8:"address1";s:0:"";s:8:"address2";s:0:"";s:3:"tel";s:0:"";s:5:"adult";i:1;s:5:"child";i:0;s:4:"baby";i:0;s:3:"car";i:0;}';
$test_info6 = 'a:14:{s:7:"company";s:0:"";s:4:"name";s:4:"aaaa";s:8:"furigana";s:0:"";s:8:"birthday";s:0:"";s:6:"gender";s:0:"";s:5:"email";s:14:"aaaa@aaaaa.com";s:8:"postcode";s:0:"";s:8:"address1";s:0:"";s:8:"address2";s:0:"";s:3:"tel";s:0:"";s:5:"adult";i:1;s:5:"child";i:0;s:4:"baby";i:0;s:3:"car";i:0;}';
$client_list = [$test_info1, $test_info2, $test_info3, $test_info4, $test_info5, $test_info6];

$user = $_SESSION['name'];
$dsn = "mysql:host=localhost;dbname=my-wp; charset=utf8";
$db_user = "root";
$db_pswd = "root";

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
$stmt = $pdo->prepare($sql);
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
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':tfid', $tfid);
    $stmt->bindValue(':line', $info_line);
    $stmt->execute();
    break;
  }
}

?>

