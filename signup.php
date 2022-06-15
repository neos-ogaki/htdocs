<link rel="stylesheet" href="./css/login.CSS">
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
    <div class="form_list">
        <label>名前</label>
        <p><?php echo $_POST['name']; ?></p>
    
        <label>メールアドレス</label>
        <p><?php echo $_POST['address']; ?></p>

        <label>パスワード</label>
        <p><?php echo $_POST['pass']; ?></p>
    </div>
    <input type="submit" name="btn_confirm" value="新規登録" formaction="./register.php">
    <input type="submit" name="btn_back" value="戻る">
    <input type="hidden" name="name" value="<?php echo $_POST['name']; ?>">
    <input type="hidden" name="address" value="<?php echo $_POST['address']; ?>">
    <input type="hidden" name="pass" value="">
    </form>
  </div>
  <?php else: ?>
  
    <!-- 処理を行う宛先を指定 -->
  <div class="form-box">
    <form action="./register.php" method="post">
    <div class="form_list">
        <label>名前</label><span id="result_name">aaaaaa</span>
        <input type="text" name="name" required>
    
        <label>メールアドレス</label>
        <input type="text" name="address" required>
    
        <label>パスワード</label>
        <input type="password" name="pass" required>

        <!-- <label>再確認用パスワード<label>
        <input type="password" name="pass" required> -->
    </div>
    <input type="submit" name="btn_confirm" value="入力内容を確認する">
    </form>
  <?php endif; ?>
  <div class="coment">
    <p>すでに登録済みの方は<a href="./login_form.php">こちら</a></p>
  </div>
  </div>
</div>
