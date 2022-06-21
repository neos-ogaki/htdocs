<link rel="stylesheet" href="./css/login.css">
<?php
// ↓エラー文を表示させるための記載
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

// //フォームからの値をそれぞれ変数に代入
$name = $_POST['name'];
$address = $_POST['address'];
$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
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
// print_r($pass);

if ($member['address'] === $address) {
    $msg = '同じメールアドレスが存在します。登録を最初からやり直してください。';
    $link = '<a href="signup.php">戻る</a>';
} else {
    //登録されていなければinsert 
    $sql = "INSERT INTO users(name, address, pass) VALUES (:name, :address, :pass)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':address', $address);
    $stmt->bindValue(':pass', $pass);
    $stmt->execute();
    $msg = '登録が完了しました';
    $link = '<a href="login_form.php">ログインページ</a>';
}
?>

<div class="message">
  <h2><?php echo $msg; ?></h2><!--メッセージの出力-->
</div>
<div class="return">
  <?php echo $link; ?>
</div>
