<?php

//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link https://ja.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/home/xs890782/nic-neos.jp/public_html/wp/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', 'xs890782_wp2' );

/** MySQL データベースのユーザー名 */
define( 'DB_USER', 'xs890782_wp4' );

/** MySQL データベースのパスワード */
define( 'DB_PASSWORD', 'scb8rlz5d0' );

/** MySQL のホスト名 */
define( 'DB_HOST', 'mysql10081.xserver.jp' );

/** データベースのテーブルを作成する際のデータベースの文字セット */
define( 'DB_CHARSET', 'utf8' );

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define( 'DB_COLLATE', '' );

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'I )_= <^1$%ou[D/1o3dLg?N$c9N5IBgbMJh(HQLKPd<0KOO`@D@k#0O4$/.nEES' );
define( 'SECURE_AUTH_KEY',  '2%d2;%k5C/&%w)as(C2I%Clr2]K,gRB@!}<8lqM=oDoAei(U6g[gd|B{25-[JtAZ' );
define( 'LOGGED_IN_KEY',    '.ZT#wu),Upv7:P7<D`89wsTP^~_4NfDVVa4Ay`f]+PXPc`)HF/tX[#v9:d<^SD]S' );
define( 'NONCE_KEY',        'b@Xq;#Hkir@etNf BZ>tpd*Jj3=p7aR&v?</n-G>&`rG9+@f<^{%Tq6stas+lOW{' );
define( 'AUTH_SALT',        'XOp>04Y8cTDiW }XP|23D3dj3&?`DCAdz$Y= pa$npC[wHDXCyj49*TkNx^cO3&E' );
define( 'SECURE_AUTH_SALT', 'Ol-,Pv*S#c>ahyr#pW?lbiJI2rw~~rj=437u-M*%(<iOTh+z.).AZWBH vn!.g)/' );
define( 'LOGGED_IN_SALT',   'S=T2+`^$`Ar&X|mg4PD:w,dz:Zyj I(<HdCC.h#3W>}`QwD28(A$B&c0nlK4{rvb' );
define( 'NONCE_SALT',       '!+B;CJ512;qOf^-wSi8<DT=p,I[9s2nORO)KE/#kC<[VC:jpCTHR1kcf=/Xs{r^[' );
define( 'WP_CACHE_KEY_SALT','iiA`x.k`cZ&_1m*pu/Ru#}F#0VYxK}>9696uZ|cr(U:tjhceixZyt/AuB[>#3z`j' );

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数についてはドキュメンテーションをご覧ください。
 *
 * @link https://ja.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* 編集が必要なのはここまでです ! WordPress でのパブリッシングをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
