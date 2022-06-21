<link rel="stylesheet" href="./css/login.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<div class="main">
  <h2>パスワードリセット</h2>
  <div class="form-box">
  <form action="./login.php" method="post">
  <div class="form-list">
      <label>ご登録メールアドレス</label>
      <input type="text" name="address" required>
  </div>
  <input type="submit" value="パスワード新規発行">
  </form>
</div>
</div>

<?php

public function gen_rand_num($length = 6) {
  $max = pow(10, $length) - 1;
  $rand = random_int(0, $max);
  $code = sprintf('%0' .$length. 'd', $rand);
  return $code;
}

// ↓エラー文を表示させるための記載
error_reporting(E_ALL);
ini_set('display_errors', '1');

$address = $_POST['address'];
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

//フォームに入力されたaddressがすでに登録されていないかチェック
$sql = "SELECT * FROM users WHERE address = :address";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':address', $address);
$stmt->execute();
$member = $stmt->fetch();

if ($member['address'] === $address) {
    new_pswd = password_hash(gen_rand_num(), PASSWORD_DEFAULT);
    $sql = "UPDATE users SET :pswd WHERE address=:address";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':pswd', $new_paswd);
    $stmt->bindValue(':address', $address);
    $stmt->execute();
    $msg = '新規パスワードを発行しました。'
    $link = '<a href="login_form.php">ログインページ</a>';

    //以下ユーザに新規パスワード通知用メール送付
    echo "something";
    $to = $address
    $subject = "メールの件名";
    $message = "メールの内容";
    $headers = "From: どこからのメールなのか";
    mail($to, $subject, $message, $headers);

} else {
    $msg = '登録されているメールアドレスではありません。もう一度お試しください。';
    $link = '<a href="pswd_reset.php">戻る</a>';
}
?>
