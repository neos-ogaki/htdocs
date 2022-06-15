<?php
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
define( 'WPCACHEHOME', 'C:\MAMP\htdocs\wp\wp-content\plugins\wp-super-cache/' );
define( 'DB_NAME', 'my-wp' );

/** MySQL データベースのユーザー名 */
define( 'DB_USER', 'root' );

/** MySQL データベースのパスワード */
define( 'DB_PASSWORD', 'root' );

/** MySQL のホスト名 */
define( 'DB_HOST', 'localhost' );

/** データベースのテーブルを作成する際のデータベースの文字セット */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'Xy,VKYd9r})4G>T{}DHmlB.<H/i<R*l&kNnPkm)*,xQG4:682;G{|OfPpqlTNU]o' );
define( 'SECURE_AUTH_KEY',  'GOY$R)2pBfgeR#U9N3-R#q$B1bb7&x4Fzd&OxA,q0B]s?$U^2ebtbjHSiGt5g7d$' );
define( 'LOGGED_IN_KEY',    'jh-pPqr;A+ev@Esb+Hey$kGn&o/vYRf`jx0UT_nlQ~~xoQ,_/JTN,Fn( v9b&umg' );
define( 'NONCE_KEY',        '(cep-L}TlK%2%:WfTw&m (S8Y:QdN*^k$M_V}ub0eHqoFT.~_FE==shL()mr;Fcj' );
define( 'AUTH_SALT',        '#4x^;s+bP,:@g>@_T2^Fb01hqv]MU<ZK:$Maj>7(?3qF<)LWDXDyFd:bCclh7VPZ' );
define( 'SECURE_AUTH_SALT', 'V>VZcDX$D|MxeGnIn2cg*,J4h%Qhkh+Z45lOiBS)-e3#(nSg8B3W*&b/_*oIfuz}' );
define( 'LOGGED_IN_SALT',   'xWm?O!bSha_ORmH/6l@P/p[W~D{4I7u|dF9!i=4*B+NEi<U@v(#7HDeo|$B^e8tu' );
define( 'NONCE_SALT',       '}/3VQMc%]#k0Z(,(v}Y>j*)h&hg14;fOm9Yyst=],UqeJ0`#ZvwQp-gdevS$TjR ' );

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
