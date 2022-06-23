<link rel="stylesheet" href="./css/login.css">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

<?php

function gen_rand_num($length = 6) {
  $max = pow(10, $length) - 1;
  $rand = random_int(0, $max);
  $code = sprintf('%0' .$length. 'd', $rand);
  return $code;
}

// ↓エラー文を表示させるための記載
//error_reporting(E_ALL);
//
//ini_set('display_errors', '1');

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
$sql = "SELECT * FROM users WHERE address=:address";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':address', $address);
$stmt->execute();
$member = $stmt->fetch();

if ($address == "") {
    $result = '';
    $link = '';
} else if ($member['address'] === $address) {
    $sixNums =  gen_rand_num();
    $new_pswd = password_hash($sixNums, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET pass=:pswd WHERE address=:address";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':pswd', $new_pswd);
    $stmt->bindValue(':address', $address);
    $stmt->execute();
    $result = '新規パスワードを発行しました。';
    $link = '<a href="login_form.php">ログインページ</a>';

    //以下ユーザに新規パスワード通知用メール送付
    mb_language("Japanese");  //言語の指定
    mb_internal_encoding("UTF-8"); 

    $to = $address;
    $subject = '仮ログインパスワード発行の件';
    $message = "下記のパスワードでログインしてください。\n 仮パスワード:$sixNums";
    $headers = 'From:NeOS_IT_Collage';
    mb_send_mail($to, $subject, $message, $headers);

} else {
    $result = '登録されているメールアドレスではありません。もう一度お試しください。';
    $link = '<a href="pswd_reset.php">戻る</a>';
}
?>

<div class="main">
  <h2>パスワードリセット</h2>
  <div class="form-box">
    <form action="" method="post">
      <div class="form-list">
        <label>ご登録メールアドレス</label>
        <input type="text" name="address" required>
      </div>
      <input type="submit" value="パスワード新規発行">
    </form>
  </div>
  <div class="result-box" style="text-align: center;">
    <p style="color: red; font-size: 1.2rem; font-weight: 700;"><?php echo $result ?></p>
    <p><?php echo $link ?></p>
  </div>
</div>
