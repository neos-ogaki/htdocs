<link rel="stylesheet" href="./css/login.css">
<!-- お目目 -->
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

<?php
session_start();

// ↓エラー文を表示させるための記載
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

$address = $_SESSION['address'];
$pass = $_POST['pass'];
$pass_old = $_POST['pass-old'];

require dirname(__FILE__) . '../../xserver_php/dsn.php';

try {
    // echo "接続成功\n";
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

$sql = "SELECT * FROM users WHERE address = :address";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':address', $address);
$stmt->execute();
$member = $stmt->fetch();


// echo $pass_old;
// echo $member['pass'];
// var_dump($member['pass']);
// print_r($member['pass']);
if ($pass_old == ""){
  $msg = '';
  $link = '';
}else if (password_verify($pass_old, $member['pass'])) {
    echo "old pswd matched";
    $new_pswd = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET pass=:pswd WHERE address=:address";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':pswd', $new_pswd);
    $stmt->bindValue(':address', $address);
    $stmt->execute();
    $msg = '新規パスワードを更新しました。';
    $link = '<a href="login_form.php">ログインページ</a>';
} else {
    echo "old pswd unmatched";
    $msg = '旧パスワードまたはリセット時発行パスワードが間違っています。';
    $link = '<a href="edit_pswd.php">戻る</a>';
}
?>

<script>
  function pushHideButton() {
      var txtPass = document.getElementById("pass");
      var btnEye = document.getElementById("buttonEye");
      if (txtPass.type === "text") {
        txtPass.type = "password";
        btnEye.className = "fa fa-eye";
      } else {
        txtPass.type = "text";
        btnEye.className = "fa fa-eye-slash";
      }
    }
</script>
<div class="main">
  <h2>パスワード変更</h2>
  <div class="form-box">
  <div class="result" style="text-align: center;">
    <p style="color: red; font-size: 1.1rem;"><?php echo $msg ?></p>
    <p><?php echo $link ?></p>
  </div>
  <form action="" method="post">
  <div class="form-list">
      <label>旧パスワード(またはリセット時発行パスワード)：</label></span>
      <div class="box">
        <input id="pass-old" type="password" name="pass-old" required>
      </div>
  </div>
  <div class="form-list">
      <label>新パスワード：</label><span id="pass-result"></span>
      <div class="box">
        <input id="pass" type="password" name="pass" required>
        <p id="buttonEye" class="fa fa-eye" onclick="pushHideButton()"></p>
      </div>
  </div>
  <div class="form-list">
      <label>確認用パスワード：</label><span id="pass-result-check"></span>
      <div class="box">
        <input id="pass-check" type="password" name="pass-check" required>
      </div>
  </div>
  <input type="submit" value="変更する">
  </form>
</div>
</div>
<script src="./js/validation.js"></script>
<script>
  passValidation();
  pschkValidation();
</script>
