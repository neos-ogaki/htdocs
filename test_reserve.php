<?php require('./wp/wp-load.php'); ?>
<link rel="stylesheet" href="./css/style-reserve.CSS">
<?php session_start(); ?>
<?php
if(isset($_SESSION['name'])){
          echo "ようこそ、".$_SESSION['name']."さん！";
          print_r( $_SESSION );

        }else{
          header('Location:login_form.php');
          exit;
        }
?>
<?php wp_head(); ?>
<div class="wrap">
  <div class="title">
      <h2>教室座席予約</h2>
  </div>
  <h1><?php echo $msg; ?></h1>
      <?php echo $link; ?>
  <div class="top-carender">
    <?php echo do_shortcode('[monthly_calendar id="12"]'); ?>
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
      <p>※赤字で表示されている時間は満席となっております。</p>
    </div>
    <div class="content-3">
      <h4>2.キャンセルについて</h4>
      <p>キャンセルはメール又は、slackでご連絡ください</p>
      <p>キャンセルはの場合は原則30分前までに行なってください。</p>
    </div>
  </div>
  <?php wp_footer(); ?>

<?php
//DB接続
$user = $_SESSION['name'];
$dsn = "mysql:host=localhost;dbname=my-wp; charset=utf8";
$db_user = "root";
$db_pswd = "root";
$sql = "SELECT `booking_time` FROM `wp_mtssb_booking` WHERE user_name=:name" ; // change user_name to client array

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
$stmt->execute();
$info = $stmt->fetchAll();

$tfid_from_db = [];
foreach($info as $i) {
   array_push($tfid_from_db, $i['booking_time']);
}
$tfid_from_db = json_encode($tfid_from_db);

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
                <form action="cancel.php" method="post">\
                <input type="submit" name="id" value="' + target_id + '">\
                </form>';

        }
    }

    // document.getElementById('cancel-trigger').addEventListener('click', function() {
    //     fetch('cancel.php', {
    //         method: 'POST',
    //         headers: { 'Content-Type': 'application/json' },
    //         body: JSON.stringify()
    // }, false);
  </script>
EOM;
?>
