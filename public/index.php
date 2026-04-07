<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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

	<link rel="icon" href="./favicon.ico">

	<title>YUKINO-ONLINESITE</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Klee+One&display=swap" rel="stylesheet">

    <!-- Uikit CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.23.13/css/uikit.min.css" integrity="sha512-giAxX2Dm0fHfTxCGThgfHXfyqC+NAsPAMI39ZDfs70vsKGALMfsNEbxlq6rZxPWWjH685ehdfvTQJkAWEgxOPw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Slick Core -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Base Style -->
    <link rel="stylesheet" href="./css/base.css?<?= time(); ?>">

    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
            <button id="st_nv_cmbtn" class="uk-button uk-button-default" type="button" uk-toggle="target: #st_as_mbmenu">≡</button>

            <!-- ブランド -->
            <div id="st_nv_brand" class="uk-flex uk-flex-middle">
                <!-- サイトロゴ -->
                <a id="st_nv_b_logo"></a>
            </div>

            <!-- PCメニュー -->
            <div id="st_nv_menu" class="uk-flex uk-flex-middle">
                <div class="st_nv_m_btn uk-flex uk-flex-middle uk-flex-center">Index</div>
                <div class="st_nv_m_btn uk-flex uk-flex-middle uk-flex-center">Gallery</div>
                <div class="st_nv_m_btn uk-flex uk-flex-middle uk-flex-center">Profile</div>
                <div class="st_nv_m_btn uk-flex uk-flex-middle uk-flex-center">FAQ</div>
                <div class="st_nv_m_btn uk-flex uk-flex-middle uk-flex-center">Inquiry</div>
            </div>
        </nav>

        <!-- 主要部分 -->
        <main class="uk-flex uk-flex-column">
            <!-- スライダー部分 -->
            <section id="st_mn_slider" class="uk-flex uk-flex-column">
                <!-- 画像容器 -->
                <div id="st_mn_sl_main"></div>

                <!-- スイッチ部分 -->
                <div id="st_mn_sl_switch"></div>
            </section>

            <!-- 正文部分 -->
            <section id="st_mn_content" class="uk-flex">
                <!-- 正文サイトバー部分 -->
                <div id="st_mn_ct_side">
                    <div class="uk-flex uk-flex-column uk-flex-middle">
                        <div class="st_mn_ct_sd_works uk-flex uk-flex-column">
                        <a href="#" class="st_mn_ct_sd_wk_img">
                            <img src="./image/others/JIMCHI.png" alt="">
                        </a>
                        <div class="st_mn_ct_sd_wk_info">
                            <span class="st_mn_ct_sd_wk_inf_title">
                                JIMCHIサイト制作しました。↓
                            </span>
                            <a href="./JIMUCTI/loader.html" class="st_mn_ct_sd_wk_inf_link"></a>
                        </div>
                    </div>
                    <div class="st_mn_ct_sd_works uk-flex uk-flex-column">
                        <a href="#" class="st_mn_ct_sd_wk_img">
                            <img src="./image/poster/grapes.jpg" alt="">
                        </a>
                        <div class="st_mn_ct_sd_wk_info">
                            <span class="st_mn_ct_sd_wk_inf_title">
                                季節限定ハンドクリーム
                            </span>
                            <a href="#" class="st_mn_ct_sd_wk_inf_link"></a>
                        </div>
                    </div>
                    <div class="st_mn_ct_sd_works uk-flex uk-flex-column">
                        <a href="./image/slide/slide4.png" class="st_mn_ct_sd_wk_img">
                            <img src="./image/others/spot-the-difference.png" alt="">
                        </a>
                        <div class="st_mn_ct_sd_wk_info">
                            <span class="st_mn_ct_sd_wk_inf_title">
                                ↑やってみる？
                            </span>
                            <a href="#" class="st_mn_ct_sd_wk_inf_link"></a>
                        </div>
                    </div>
                    <div class="st_mn_ct_sd_works uk-flex uk-flex-column">
                        <a href="#" class="st_mn_ct_sd_wk_img">
                            <img src="./image/others/exhibition.jpg" alt="">
                        </a>
                        <div class="st_mn_ct_sd_wk_info">
                            <span class="st_mn_ct_sd_wk_inf_title">
                                作品展示会が開催決定!
                            </span>
                            <a href="#" class="st_mn_ct_sd_wk_inf_link"></a>
                        </div>
                    </div>
                    <div class="st_mn_ct_sd_works uk-flex uk-flex-column">
                        <a href="#" class="st_mn_ct_sd_wk_img">
                            <img src="./image/others/portfolio.png" alt="">
                        </a>
                        <div class="st_mn_ct_sd_wk_info">
                            <span class="st_mn_ct_sd_wk_inf_title"></span>
                            <a href="./PDF/portfolio.pdf" class="st_mn_ct_sd_wk_inf_link">
                                中身を見る
                            </a>
                        </div>
                    </div>
                    <div class="st_mn_ct_sd_works uk-flex uk-flex-column">
                        <a href="#" class="st_mn_ct_sd_wk_img">
                            <img src="./image/others/LINE-stamp.png" alt="">
                        </a>
                        <div class="st_mn_ct_sd_wk_info">
                            <span class="st_mn_ct_sd_wk_inf_title">
                                LINEスタンプ<br>好評発売中↓
                            </span>
                            <a href="https://store.line.me/stickershop/product/31223760/ja" class="st_mn_ct_sd_wk_inf_link">
                                購入はこちらから
                            </a>
                        </div>
                    </div>
                    </div>
                </div>

                <!-- 正文メイン部分 -->
                <div id="st_mn_ct_main">
                    
                </div>
            </section>
        </main>

        <!-- モバイルメニュー -->
        <aside>
            <div id="st_as_mbmenu" class="" uk-offcanvas="overlay:true">
                <div class="uk-offcanvas-bar">
                    <ul class="uk-nav uk-nav-default">
                        <li class="uk-active"><a href="#">Active</a></li>
                        <li class="uk-parent">
                            <a href="#">Parent</a>
                            <ul class="uk-nav-sub">
                                <li><a href="#">Sub item</a></li>
                                <li><a href="#">Sub item</a></li>
                            </ul>
                        </li>
                        <li class="uk-nav-header">Header</li>
                        <li>
                            <a href="#"><span class="uk-margin-small-right" uk-icon="icon: table"></span> Item</a>
                        </li>
                        <li>
                            <a href="#"><span class="uk-margin-small-right" uk-icon="icon: thumbnails"></span> Item</a>
                        </li>
                        <li class="uk-nav-divider"></li>
                        <li>
                            <a href="#"><span class="uk-margin-small-right" uk-icon="icon: trash"></span> Item</a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>

        <!-- フッター -->
        <footer class="uk-flex uk-flex-column uk-flex-middle uk-flex-center">
        </footer>
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
    <script defer src="./js/Return-to-top.js"></script>
	<script defer src="./js/slick.js"></script>
	<script defer src="./js/slideshow.js"></script>
</body>
</html>