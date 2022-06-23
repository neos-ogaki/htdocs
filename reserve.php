<?php require('./wp/wp-load.php'); ?>
<link rel="stylesheet" href="./css/style-reserve.css">
<?php 
session_start(); 
if(!isset($_SESSION['name'])){
    header("Location:login_form.php");
    exit(); 
}
?>
<?php wp_head(); ?>
<div class="wrap">
  <div class="title">
      <h2>教室座席予約</h2>
      <p>ようこそ<?php echo $_SESSION['name'] ?>さん</p>
      <p>hello<?php echo $_SESSION['address'] ?></p>
  </div>
  <div class="edit-pass">
    <p><a href="/edit_pswd.php">パスワードの変更</a></p>
  </div>
  <div class="top-carender">
    <?php echo do_shortcode('[monthly_calendar id="60"]'); ?>
  </div>
  
  <div class="text-box">
    <div class="content-1">
      <h3>注意事項</h3>
    </div>
    <div class="content-2">
      <h4>1.予約可能時間</h4>
      <p>第1部:10時～13時 3h</p>
      <p>第2部:13時～16時 3h</p>
      <p>第3部:16時～19時 3h</p>
      <p>第4部:19時～22時 4h</p>
      <p>※グレーで表示されている時間は満席となっております。</p>
    </div>
    <div class="content-3">
      <h4>2.キャンセルについて</h4>
      <p>キャンセルはメール又は、slackでご連絡ください。</p>
      <p>キャンセルはの場合は原則30分前までに行なってください。</p>
    </div>
  </div>
  <?php wp_footer(); ?>

<?php
//DB接続
require dirname(__FILE__) . '../../xserver_php/dsn.php';
$user = $_SESSION['name'];

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
$sql = "SELECT `booking_time` FROM `wp_mtssb_booking` WHERE `client` LIKE :name" ; 
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', "%".$user."%");
$stmt->execute();
$info = $stmt->fetchAll();

$tfid_from_db = [];
foreach($info as $i) {
   array_push($tfid_from_db, $i['booking_time']);
}
$tfid_from_db = json_encode($tfid_from_db);

// 重複予約禁止
echo <<<EOM
  <script>
    //HTMLよりIDリスト作成
    var tfid_list = [];
    var elements = document.querySelectorAll('.booking-timelink');
    elements.forEach(function(e){
      tfid_list.unshift(e.getAttribute('href').split('=').pop());
    });

    //DBよりIDのリスト作成
    var tfid_from_db = $tfid_from_db;;

    var duplicatedArr = tfid_list.filter(i => tfid_from_db.indexOf(i) !== -1)
    
    for (var j=0; j<elements.length; j++) {
        target_id = elements[j].getAttribute('href').split('=').pop();
        if (duplicatedArr.includes(target_id)) {
            elements[j].parentElement.innerHTML = '\
                <form action="cancel.php" method="get">\
                <button type="sumbit" name="tfid" value="' + target_id + '">予約取り消し</button>\
                </form>';

        }
    }
  </script>
EOM;
?>
