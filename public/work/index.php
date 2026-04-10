<?php
declare(strict_types=1);

$baseDir      = __DIR__;
$pageDir      = $baseDir . '/page';
$fallbackFile = $baseDir . '/common/nowork.php';

$id = isset($_GET['id']) ? (string)$_GET['id'] : '';

// /work や /work/ のように id がなければ gallery へ
if ($id === '') {
    header('Location: /gallery', true, 302);
    exit;
}

// 数字のみ許可
if (!ctype_digit($id)) {
    http_response_code(404);
    require_once $fallbackFile;
    exit;
}

$pageFile = $pageDir . '/' . $id . '.phtml';

if (!is_file($pageFile) || !is_readable($pageFile)) {
    http_response_code(404);
    require_once $fallbackFile;
    exit;
}

$realPageDir = realpath($pageDir);
$realPageFile = realpath($pageFile);

if (
    $realPageDir === false ||
    $realPageFile === false ||
    strpos($realPageFile, $realPageDir . DIRECTORY_SEPARATOR) !== 0
) {
    http_response_code(500);
    require_once $fallbackFile;
    exit;
}

// 初期値
$title    = '';
$label    = '';
$imgurl   = '';

$target   = '';
$mokuteki = '';
$concept  = '';
$point    = '';
$tool     = '';

// 作品データ読み込み
require $realPageFile;

// 出力用 helper
function h(?string $value): string
{
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

// img src 用 helper
function safe_img_url(?string $value): string
{
    $value = trim((string)$value);

    if ($value === '') {
        return '/assets/img/common/noimage.png';
    }

    // javascript: などを避ける
    if (preg_match('/^\s*javascript:/i', $value)) {
        return '/assets/img/common/noimage.png';
    }

    return $value;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Cache-Control" content="no-siteapp">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<meta name="referrer" content="origin-when-cross-origin">
	<meta name="robots" content="index,follow">
	<meta name="page-generated" content="<?php echo date('Y-m-d H:i:s T'); ?>">

	<meta name="viewport" content="width=device-width,height=device-height,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="format-detection" content="telephone=no,email=no">
	<meta name="google" content="notranslate">

	<meta name="theme-color" content="#c2a384">
	<meta name="author" content="Yukino, @S2OUnicus">

	<link rel="icon" href="../favicon.ico">

	<title><?= h($title) ?> - ゆきフォリオ (YUKINO Portfolio)</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Klee+One&display=swap" rel="stylesheet">

    <!-- Uikit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.23.13/css/uikit.min.css" integrity="sha512-giAxX2Dm0fHfTxCGThgfHXfyqC+NAsPAMI39ZDfs70vsKGALMfsNEbxlq6rZxPWWjH685ehdfvTQJkAWEgxOPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Slick Core -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Base Style -->
    <link rel="stylesheet" href="../css/base.css?<?= time(); ?>">
    <link rel="stylesheet" href="../css/work_detail.css?<?= time(); ?>">

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<link rel="manifest" href="../manifest.webmanifest">
	<link rel="apple-touch-icon" href="../image/icons/apple-touch-icon.png">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="default">
	<meta name="apple-mobile-web-app-title" content="ゆきフォリオ">
	<link rel="stylesheet" href="../css/pwa-ui.css">
</head>
<body>
    <noscript>This Page Requires Javascript.</noscript>

    <!-- ------------------------------------------------------- -->
    <!-- ------------------------------------------------------- -->
    <!-- ------------------------------------------------------- -->

    <div id="stage">
        <!-- ナビゲーション -->
        <nav class="uk-flex uk-flex-middle">
            <!-- モバイルメニュー呼び出しボタン -->
            <button id="st_nv_cmbtn" class="uk-button uk-button-default uk-flex uk-flex-center uk-flex-middle" type="button" uk-toggle="target: #st_as_mbmenu">
                <span class="uk-flex uk-flex-center uk-flex-middle" uk-icon="table"></span>
            </button>

            <!-- ブランド -->
            <div id="st_nv_brand" class="uk-flex uk-flex-middle">
                <!-- サイトロゴ -->
                <a id="st_nv_b_logo" href="../"></a>
            </div>

            <!-- PCメニュー -->
            <div id="st_nv_menu" class="uk-flex uk-flex-middle uk-flex-right">
                <a href="../" class="st_nv_m_btn uk-flex uk-flex-middle uk-flex-center" uk-tooltip="title:トップ（ホーム）;pos:bottom">Index</a>
                <a href="../gallery" class="st_nv_m_btn uk-flex uk-flex-middle uk-flex-center" uk-tooltip="title:ギャラリー（作品集）;pos:bottom">Gallery</a>
                <a href="../profile" class="st_nv_m_btn uk-flex uk-flex-middle uk-flex-center" uk-tooltip="title:プロフィール;pos:bottom">Profile</a>
                <a href="../FAQ" class="st_nv_m_btn uk-flex uk-flex-middle uk-flex-center" uk-tooltip="title:質問＆回答;pos:bottom">FAQ</a>
                <a href="../contact" class="st_nv_m_btn uk-flex uk-flex-middle uk-flex-center" uk-tooltip="title:お問い合わせ;pos:bottom">Inquiry</a>
            </div>
        </nav>

        <!-- 主要部分 -->
        <main class="uk-flex uk-flex-column uk-flex-middle">
            <section id="st_mn_content" class="uk-flex">
<?php
// 正常時
require_once "common/index_inner.phtml";
?>
            </section>
        </main>

        <!-- モバイルメニュー -->
        <aside>
            <div id="st_as_mbmenu" uk-offcanvas="overlay:true">
                <div class="uk-offcanvas-bar">
                    <ul class="uk-nav uk-nav-default" uk-margin>
                        <li id="st_as_m_title" class="uk-active">
                            <a href="../" class="uk-flex uk-flex-middle">
                                <img id="st_as_m_tt_logo" src="../favicon.ico" alt="">
                                <div class="uk-flex uk-flex-column uk-margin-left">
                                    <span class="uk-text-default uk-text-bold">ゆきフォリオ</span>
                                    <span class="uk-text-meta">YUKINO Portfolio</span>
                                </div>
                            </a>
                        </li>
                        <li class="uk-text-default uk-nav-header">メニュー</li>

                        <li class="uk-nav-divider uk-margin-small-top uk-margin-small-bottom"></li>

                        <li>
                            <a href="../" class="uk-flex uk-flex-middle"><span class="uk-margin-small-right" uk-icon="icon: home"></span> ホーム<span class="uk-badge">Index</span></a>
                        </li>
                        <li>
                            <a href="../gallery" class="uk-flex uk-flex-middle"><span class="uk-margin-small-right" uk-icon="icon: image"></span> 作品一覧<span class="uk-badge">Gallery</span></a>
                        </li>
                        <li>
                            <a href="../profile" class="uk-flex uk-flex-middle"><span class="uk-margin-small-right" uk-icon="icon: user"></span> プロフィール<span class="uk-badge">Profile</span></a>
                        </li>
                        <li>
                            <a href="../FAQ" class="uk-flex uk-flex-middle"><span class="uk-margin-small-right" uk-icon="icon: question"></span> 質問＆回答<span class="uk-badge">FAQ</span></a>
                        </li>
                        <li>
                            <a href="../contact" class="uk-flex uk-flex-middle"><span class="uk-margin-small-right" uk-icon="icon: comments"></span> お問い合わせ<span class="uk-badge">Inquiry</span></a>
                        </li>

                        <li class="uk-nav-divider uk-margin-small-top uk-margin-small-bottom"></li>

                        <li class="uk-text-meta">Designed By YUKINO</li>
                    </ul>
                </div>
            </div>
        </aside>

        <!-- フッター -->
        <footer class="uk-flex uk-flex-column uk-flex-middle uk-flex-center">
            <section id="st_ft_link" class="uk-flex uk-flex-middle uk-flex-center">
				<a href="../index">トップ</a>
				<a href="../gallery">ギャラリー（作品集）</a>
				<a href="../profile">プロフィール</a>
				<a href="../FAQ">質問＆回答</a>
				<a href="../contact">お問い合わせ</a>
			</section>

            <section id="st_ft_info" class="uk-flex uk-flex-column uk-flex-middle uk-flex-center">
                <span id="st_ft_inf_copyright" class="uk-flex uk-flex-middle uk-flex-center">
                    © 2026&nbsp;<a href="../">ゆきフォリオ (YUKINO Portfolio)</a>. All Rights Reserved.
                </span>
            </section>
        </footer>
    </div>

    <div class="peek-cat" id="peekCat">
	<img
		id="peekCatImage"
		class="peek-cat-image"
		src="../image/materiaru/kinonya.png"
		alt="トップに戻る"
		role="button"
		tabindex="0"
		decoding="async"
		draggable="false"
	>
	<button type="button" class="peek-cat-tip" id="peekCatTip">
		トップに戻る
	</button>
</div>

    <!-- ------------------------------------------------------- -->
    <!-- ------------------------------------------------------- -->
    <!-- ------------------------------------------------------- -->

    <!-- Uikit CSS -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.23.13/js/uikit.min.js" integrity="sha512-g9wkFlti+bZT3YNTbVcMumimOS+hJSfbBEnKKP+e307qqQ3Ye4Bx7p/xUJ8yNRMotwudcofKL60ck1BGxk1t6Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.23.13/js/uikit-icons.min.js" integrity="sha512-fyzBJExpV4/Aprql1Gm4X0g3Qtmyev/D8KFVkuYYLD4ixhkVwTrSm/3rvYWWKTFtxN0H5/xTBQYxqOgL8CL5Rw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Slick Core -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- User JS -->
    <script defer src="../js/Return-to-top.js?<?= time(); ?>"></script>

	<script>window.__PWA_CONFIG__ = { swPath: '../service-worker.js' };</script>
	<script defer data-pwa-enhancements="1" src="../js/pwa-enhancements.js"></script>
</body>
</html>