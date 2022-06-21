<link rel="stylesheet" href="./css/login.css">
<!-- お目目 -->
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
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
<?php
// 変数の初期化
$page_flag = 0;

if( !empty($_POST['btn_confirm'])) {
  $page_flag = 1;
} elseif ($_POST['btn_back']) {
  $page_flag =0;
}
?>
<div class="main">
  <h2>新規登録</h2>
  <?php if( $page_flag === 1 ): ?>
  <h3>入力内容確認画面</h3>
  <div class="form-box">
    <form action="./register.php" method="post">
    <div class="form-list">
        <label>名前</label>
        <p><?php echo $_POST['name']; ?></p>
    
        <label>メールアドレス</label>
        <p><?php echo $_POST['address']; ?></p>

        <label>パスワード</label>
        <p><?php echo $_POST['pass']; ?></p>
    </div>
    <input type="submit" name="btn_confirm" value="新規登録" formaction="./register.php">
    <button type="button" onclick="history.back()">戻る</button>
    <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
    <input type="hidden" name="address" value="<?php echo $_POST['address']; ?>">
    <input type="hidden" name="pass" value="">
    </form>
  </div>
  <?php else: ?>
  
    <!-- 処理を行う宛先を指定 -->
  <div class="form-box">
  <form action="?" method="post" id="form">
  <div class="form-list">
      <label>名前：</label><span id="name-result"></span>
      <input id="name" type="text" name="name" required>
  </div>
  <div class="form-list">
      <label>メールアドレス：</label><span id="address-result"></span>
      <input id="address" type="text" name="address" placeholder="xxxx@gmail.com" required>
  </div>
  <div class="form-list">
      <label>パスワード：</label><span id="pass-result"></span>
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
  <input id="submit" type="submit" name="btn_confirm" value="入力内容を確認する" disabled>
  </form>
  <?php endif; ?>
  <div class="coment">
    <p>すでに登録済みの方は<a href="./login_form.php">こちら</a></p>
  </div>
  </div>
</div>
<script src="./js/validation.js"></script>
<script>
nameValidation();
addrValidation();
passValidation();
pschkValidation();
</script>
