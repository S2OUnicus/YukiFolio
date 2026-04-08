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

	<title>ゆきフォリオ (YUKINO Portfolio)</title>

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
            <button id="st_nv_cmbtn" class="uk-button uk-button-default uk-flex uk-flex-center uk-flex-middle" type="button" uk-toggle="target: #st_as_mbmenu">
                <span class="uk-flex uk-flex-center uk-flex-middle" uk-icon="table"></span>
            </button>

            <!-- ブランド -->
            <div id="st_nv_brand" class="uk-flex uk-flex-middle">
                <!-- サイトロゴ -->
                <a id="st_nv_b_logo"></a>
            </div>

            <!-- PCメニュー -->
            <div id="st_nv_menu" class="uk-flex uk-flex-middle uk-flex-right">
                <a href="#" class="st_nv_m_btn uk-flex uk-flex-middle uk-flex-center">Index</a>
                <a href="#" class="st_nv_m_btn uk-flex uk-flex-middle uk-flex-center">Gallery</a>
                <a href="#" class="st_nv_m_btn uk-flex uk-flex-middle uk-flex-center">Profile</a>
                <a href="#" class="st_nv_m_btn uk-flex uk-flex-middle uk-flex-center">FAQ</a>
                <a href="#" class="st_nv_m_btn uk-flex uk-flex-middle uk-flex-center">Inquiry</a>
            </div>
        </nav>

        <!-- 主要部分 -->
        <main class="uk-flex uk-flex-column uk-flex-middle">
            <!-- スライダー部分 -->
            <section id="st_mn_slider">
                <div class="mainimg-slick">
                    <div>
                        <a href="./gallery">
                            <img src="./image/slide/slide1.png" alt="作品集">
                        </a>
                    </div>
                    <div>
                        <a href="./standalone/PDF/portfolio.pdf">
                            <img src="./image/slide/slide2.png" alt="YUKINOチラシ">
                        </a>
                    </div>
                    <div>
                        <a href="https://store.line.me/stickershop/product/31223760/ja">
                            <img src="./image/slide/slide3.png" alt="LINEスタンプ">
                        </a>
                    </div>
                    <div>
                        <a href="./game/diffcat.php">
                            <img src="./image/slide/slide4.png" alt="間違い探し">
                        </a>
                    </div>
                </div>
            </section>

            <!-- 正文部分 -->
            <section id="st_mn_content" class="uk-flex">
                <!-- 正文サイトバー部分 -->
                <div id="st_mn_ct_side">
                    <div class="uk-flex uk-flex-column uk-flex-top">
                        <div class="st_mn_ct_sd_works uk-flex uk-flex-column">
                        <a href="./standalone/JIMUCTI/loader.html" class="st_mn_ct_sd_wk_img">
                            <img src="./image/others/JIMCHI.png" alt="JIMCHI">
                        </a>
                        <div class="st_mn_ct_sd_wk_info uk-flex uk-flex-column uk-flex-middle">
                            <span class="st_mn_ct_sd_wk_inf_title">
                                JIMCHIサイト制作しました。↓
                            </span>
                            <a href="./standalone/JIMUCTI/loader.html" class="st_mn_ct_sd_wk_inf_link"></a>
                        </div>
                    </div>
                    <div class="st_mn_ct_sd_works uk-flex uk-flex-column">
                        <a href="#" class="st_mn_ct_sd_wk_img">
                            <img src="./image/poster/grapes.jpg" alt="">
                        </a>
                        <div class="st_mn_ct_sd_wk_info uk-flex uk-flex-column uk-flex-middle">
                            <span class="st_mn_ct_sd_wk_inf_title">
                                季節限定ハンドクリーム
                            </span>
                            <a href="#" class="st_mn_ct_sd_wk_inf_link"></a>
                        </div>
                    </div>
                    <div class="st_mn_ct_sd_works uk-flex uk-flex-column">
                        <a href="./game/diffcat.php" class="st_mn_ct_sd_wk_img">
                            <img src="./image/others/spot-the-difference.png" alt="">
                        </a>
                        <div class="st_mn_ct_sd_wk_info uk-flex uk-flex-column uk-flex-middle">
                            <span class="st_mn_ct_sd_wk_inf_title">
                                ↑やってみる？
                            </span>
                            <a href="" class="st_mn_ct_sd_wk_inf_link"></a>
                        </div>
                    </div>
                    <div class="st_mn_ct_sd_works uk-flex uk-flex-column">
                        <a href="#" class="st_mn_ct_sd_wk_img">
                            <img src="./image/others/exhibition.jpg" alt="">
                        </a>
                        <div class="st_mn_ct_sd_wk_info uk-flex uk-flex-column uk-flex-middle">
                            <span class="st_mn_ct_sd_wk_inf_title">
                                作品展示会が開催決定!
                            </span>
                            <a href="#" class="st_mn_ct_sd_wk_inf_link"></a>
                        </div>
                    </div>
                    <div class="st_mn_ct_sd_works uk-flex uk-flex-column">
                        <a href="./standalone/PDF/portfolio.pdf" class="st_mn_ct_sd_wk_img">
                            <img src="./image/others/portfolio.png" alt="">
                        </a>
                        <div class="st_mn_ct_sd_wk_info uk-flex uk-flex-column uk-flex-middle">
                            <span class="st_mn_ct_sd_wk_inf_title"></span>
                            <a href="./standalone/PDF/portfolio.pdf" class="st_mn_ct_sd_wk_inf_link">
                                中身を見る
                            </a>
                        </div>
                    </div>
                    <div class="st_mn_ct_sd_works uk-flex uk-flex-column">
                        <a href="https://store.line.me/stickershop/product/31223760/ja" class="st_mn_ct_sd_wk_img">
                            <img src="./image/others/LINE-stamp.png" alt="">
                        </a>
                        <div class="st_mn_ct_sd_wk_info uk-flex uk-flex-column uk-flex-middle">
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
                    <!-- お知らせ部分 -->
                    <section id="st_mn_ct_mn_notice">
                        <div id="st_mn_ct_mn_n_title" class="uk-flex uk-flex-middle uk-flex-center">
                            <span>お知らせ</span>
                        </div>
                        <div id="st_mn_ct_mn_n_list">
                            <!-- 新聞箇条 -->
                            <div class="st_mn_ct_mn_n_ls_news">
                                <!-- 一行目：日付・ラベル -->
                                <div class="st_mn_ct_mn_n_ls_n_info uk-flex uk-flex-middle">
                                    <time datetime="2026-03-23">2026/03/23</time>
                                    <span class="fc-news-tag-blank st_mn_ct_mn_n_ls_n_inf_label uk-flex uk-flex-middle uk-flex-center">
                                        ホームページ公開
                                    </span>
                                </div>
                                <!-- 二行目以降：情報 -->
                                <div class="st_mn_ct_mn_n_ls_n_text uk-flex uk-flex-column">
                                    <span>
                                        YUKINO-オンラインホームページが公開されました！
                                    </span>
                                </div>
                            </div>
                            <div class="st_mn_ct_mn_n_ls_news">
                                <div class="st_mn_ct_mn_n_ls_n_info uk-flex uk-flex-middle">
                                    <time datetime="2026-01-23">2026/01/23</time>
                                    <span class="fc-news-tag-fill st_mn_ct_mn_n_ls_n_inf_label">
                                        サイト制作
                                    </span>
                                </div>
                                <div class="st_mn_ct_mn_n_ls_n_text uk-flex uk-flex-column">
                                    <span>
                                        焼肉店JIMCH様のホームページを製作させていただきました！<a href="./JIMUCTI/loader.html"> → JIMCHIサイト</a>
                                    </span>
                                    <span>
                                        ※実案件のため一部非公開（現在クライアントと調整中）
                                    </span>
                                </div>
                            </div>
                            <div class="st_mn_ct_mn_n_ls_news">
                                <div class="st_mn_ct_mn_n_ls_n_info uk-flex uk-flex-middle">
                                    <time datetime="2025-12-16">2025/12/16</time>
                                    <span class="fc-news-tag-fill st_mn_ct_mn_n_ls_n_inf_label">
                                        ポートフォリオPDF
                                    </span>
                                </div>
                                <div class="st_mn_ct_mn_n_ls_n_text uk-flex uk-flex-column">
                                    <span>ポートフォリオのPDFを作成しました！<a href="./standalone/PDF/portfolio.pdf" target="_blank"> PDFを見る</a></span>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 商品部分 -->
                    <section id="st_mn_ct_mn_product">
                        <!-- グループ：季節限定ハンドクリーム -->
                        <div class="st_mn_ct_mn_pd_group uk-flex uk-flex-column uk-flex-middle">
                            <!-- グループタイトル -->
                            <div class="st_mn_ct_mn_pd_g_title uk-flex uk-flex-middle">
                                季節限定ハンドクリーム
                            </div>
                            <!-- グループリスト -->
                            <section class="st_mn_ct_mn_pd_g_list uk-flex" uk-grid>
                                <!-- 商品カードユニット -->
                                <div class="st_mn_ct_mn_pd_g_ls_work uk-flex uk-flex-column uk-flex-middle uk-width-1-3@s uk-width-1-4@m">
                                    <a href="#" class="st_mn_ct_mn_pd_g_ls_wk_img"><img src="./image/top/1.png" alt=""></a>
                                    <span class="st_mn_ct_mn_pd_g_ls_wk_title">
                                        ハンドクリーム（苺の香り）
                                    </span>
                                </div>
                                <div class="st_mn_ct_mn_pd_g_ls_work uk-flex uk-flex-column uk-flex-middle uk-width-1-3@s uk-width-1-4@m">
                                    <a href="#" class="st_mn_ct_mn_pd_g_ls_wk_img"><img src="./image/top/2.png" alt=""></a>
                                    <span class="st_mn_ct_mn_pd_g_ls_wk_title">
                                        ハンドクリーム（桃の香り）
                                    </span>
                                </div>
                                <div class="st_mn_ct_mn_pd_g_ls_work uk-flex uk-flex-column uk-flex-middle uk-width-1-3@s uk-width-1-4@m">
                                    <a href="#" class="st_mn_ct_mn_pd_g_ls_wk_img"><img src="./image/top/3.png" alt=""></a>
                                    <span class="st_mn_ct_mn_pd_g_ls_wk_title">
                                        ハンドクリーム（ぶどうの香り）
                                    </span>
                                </div>
                                <div class="st_mn_ct_mn_pd_g_ls_work uk-flex uk-flex-column uk-flex-middle uk-width-1-3@s uk-width-1-4@m">
                                    <a href="#" class="st_mn_ct_mn_pd_g_ls_wk_img"><img src="./image/top/4.png" alt=""></a>
                                    <span class="st_mn_ct_mn_pd_g_ls_wk_title">
                                        ハンドクリーム（レモンの香り）
                                    </span>
                                </div>
                            </section>
                        </div>

                        <!-- グループ：アパレル商品 -->
                        <div class="st_mn_ct_mn_pd_group uk-flex uk-flex-column uk-flex-middle">
                            <!-- グループタイトル -->
                            <div class="st_mn_ct_mn_pd_g_title uk-flex uk-flex-middle">
                                アパレル商品
                            </div>
                            <!-- グループリスト -->
                            <section class="st_mn_ct_mn_pd_g_list uk-flex" uk-grid>
                                <div class="st_mn_ct_mn_pd_g_ls_work uk-flex uk-flex-column uk-flex-middle uk-width-1-3@s uk-width-1-4@m">
                                    <a href="#" class="st_mn_ct_mn_pd_g_ls_wk_img"><img src="./image/top/5.png" alt=""></a>
                                    <span class="st_mn_ct_mn_pd_g_ls_wk_title">
                                        音×自由-Tシャツ-
                                    </span>
                                </div>
                                <div class="st_mn_ct_mn_pd_g_ls_work uk-flex uk-flex-column uk-flex-middle uk-width-1-3@s uk-width-1-4@m">
                                    <a href="#" class="st_mn_ct_mn_pd_g_ls_wk_img"><img src="./image/top/6.png" alt=""></a>
                                    <span class="st_mn_ct_mn_pd_g_ls_wk_title">
                                        音×自由-パンツ
                                    </span>
                                </div>
                            </section>
                        </div>

                        <!-- グループ：作品展示会用 -->
                        <div class="st_mn_ct_mn_pd_group uk-flex uk-flex-column uk-flex-middle">
                            <!-- グループタイトル -->
                            <div class="st_mn_ct_mn_pd_g_title uk-flex uk-flex-middle">
                                作品展示会用
                            </div>
                            <!-- グループリスト -->
                            <section class="st_mn_ct_mn_pd_g_list uk-flex" uk-grid>
                                <div class="st_mn_ct_mn_pd_g_ls_work uk-flex uk-flex-column uk-flex-middle uk-width-1-3@s uk-width-1-4@m">
                                    <a href="#" class="st_mn_ct_mn_pd_g_ls_wk_img"><img src="./image/top/7.png" alt=""></a>
                                    <span class="st_mn_ct_mn_pd_g_ls_wk_title">
                                        HIPHOPかるた箱
                                    </span>
                                </div>
                                <div class="st_mn_ct_mn_pd_g_ls_work uk-flex uk-flex-column uk-flex-middle uk-width-1-3@s uk-width-1-4@m">
                                    <a href="#" class="st_mn_ct_mn_pd_g_ls_wk_img"><img src="./image/top/8.png" alt=""></a>
                                    <span class="st_mn_ct_mn_pd_g_ls_wk_title">
                                        HIPHOPかるたカード
                                    </span>
                                </div>
                            </section>
                        </div>

                        <!-- グループ：ロゴ -->
                        <div class="st_mn_ct_mn_pd_group uk-flex uk-flex-column uk-flex-middle">
                            <!-- グループタイトル -->
                            <div class="st_mn_ct_mn_pd_g_title uk-flex uk-flex-middle">
                                ロゴ
                            </div>
                            <!-- グループリスト -->
                            <section class="st_mn_ct_mn_pd_g_list uk-flex" uk-grid>
                                <div class="st_mn_ct_mn_pd_g_ls_work uk-flex uk-flex-column uk-flex-middle uk-width-1-3@s uk-width-1-4@m">
                                    <a href="#" class="st_mn_ct_mn_pd_g_ls_wk_img"><img src="./image/top/9.png" alt=""></a>
                                    <span class="st_mn_ct_mn_pd_g_ls_wk_title">
                                        ロゴ１
                                    </span>
                                </div>
                                <div class="st_mn_ct_mn_pd_g_ls_work uk-flex uk-flex-column uk-flex-middle uk-width-1-3@s uk-width-1-4@m">
                                    <a href="#" class="st_mn_ct_mn_pd_g_ls_wk_img"><img src="./image/top/10.png" alt=""></a>
                                    <span class="st_mn_ct_mn_pd_g_ls_wk_title">
                                        ロゴ２
                                    </span>
                                </div>
                                <div class="st_mn_ct_mn_pd_g_ls_work uk-flex uk-flex-column uk-flex-middle uk-width-1-3@s uk-width-1-4@m">
                                    <a href="#" class="st_mn_ct_mn_pd_g_ls_wk_img"><img src="./image/top/11.png" alt=""></a>
                                    <span class="st_mn_ct_mn_pd_g_ls_wk_title">
                                        作品集
                                    </span>
                                </div>
                            </section>
                        </div>

                        <!-- グループ：その他 -->
                        <div class="st_mn_ct_mn_pd_group uk-flex uk-flex-column uk-flex-middle">
                            <!-- グループタイトル -->
                            <div class="st_mn_ct_mn_pd_g_title uk-flex uk-flex-middle">
                                その他
                            </div>
                            <!-- グループリスト -->
                            <section class="st_mn_ct_mn_pd_g_list uk-flex" uk-grid>
                                <div class="st_mn_ct_mn_pd_g_ls_work uk-flex uk-flex-column uk-flex-middle uk-width-1-3@s uk-width-1-4@m">
                                    <a href="#" class="st_mn_ct_mn_pd_g_ls_wk_img"><img src="./image/top/12.png" alt=""></a>
                                    <span class="st_mn_ct_mn_pd_g_ls_wk_title">
                                        名刺
                                    </span>
                                </div>
                                <div class="st_mn_ct_mn_pd_g_ls_work uk-flex uk-flex-column uk-flex-middle uk-width-1-3@s uk-width-1-4@m">
                                    <a href="#" class="st_mn_ct_mn_pd_g_ls_wk_img"><img src="./image/top/13.png" alt=""></a>
                                    <span class="st_mn_ct_mn_pd_g_ls_wk_title">
                                        LINEスタンプ
                                    </span>
                                </div>
                                <div class="st_mn_ct_mn_pd_g_ls_work uk-flex uk-flex-column uk-flex-middle uk-width-1-3@s uk-width-1-4@m">
                                    <a href="#" class="st_mn_ct_mn_pd_g_ls_wk_img"><img src="./image/top/14.png" alt=""></a>
                                    <span class="st_mn_ct_mn_pd_g_ls_wk_title">
                                        入浴剤
                                    </span>
                                </div>
                            </section>
                        </div>
                    </section>
                </div>
            </section>
        </main>

        <!-- モバイルメニュー -->
        <aside>
            <div id="st_as_mbmenu" class="" uk-offcanvas="overlay:true">
                <div class="uk-offcanvas-bar">
                    <ul class="uk-nav uk-nav-default">
                        <li class="uk-active"><a href="#">ゆきフォリオ（YUKINO Portfolio）</a></li>
                        <li class="uk-nav-header">メニュー</li>

                        <li class="uk-nav-divider"></li>
                        <br>

                        <li>
                            <a href="#"><span class="uk-margin-small-right" uk-icon="icon: home"></span> Index</a>
                        </li>
                        <li>
                            <a href="#"><span class="uk-margin-small-right" uk-icon="icon: image"></span> Gallery</a>
                        </li>
                        <li>
                            <a href="#"><span class="uk-margin-small-right" uk-icon="icon: user"></span> Profile</a>
                        </li>
                        <li>
                            <a href="#"><span class="uk-margin-small-right" uk-icon="icon: question"></span> FAQ</a>
                        </li>
                        <li>
                            <a href="#"><span class="uk-margin-small-right" uk-icon="icon: comments"></span> Inquiry</a>
                        </li>

                        <br>
                        <li class="uk-nav-divider"></li>

                        <li>Version: v0.2.2 (Built 260408 041123+09)</li>
                        <li>@S2OUnicus</li>
                    </ul>
                </div>
            </div>
        </aside>

        <!-- フッター -->
        <footer class="uk-flex uk-flex-column uk-flex-middle uk-flex-center">
            <section id="st_ft_link" class="uk-flex uk-flex-middle uk-flex-center">
				<a href="index.html">トップ</a>
				<a href="gallery.html">ギャラリー</a>
				<a href="profile.html">プロフィール</a>
				<a href="FAQ.html">質問</a>
				<a href="contact.html">お問い合わせ</a>
			</section>

            <section id="st_ft_info" class="uk-flex uk-flex-column uk-flex-middle uk-flex-center">
                <span id="st_ft_inf_copyright" class="uk-flex uk-flex-middle uk-flex-center">
                    © 2026 ゆきフォリオ (YUKINO Portfolio). All Rights Reserved.
                </span>
            </section>
        </footer>
    </div>

    <div class="peek-cat" id="peekCat">
	<img
		id="peekCatImage"
		class="peek-cat-image"
		src="image/materiaru/kinonya.png"
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
    <script defer src="./js/Return-to-top.js?<?= time(); ?>"></script>
	<script defer src="./js/slick.js?<?= time(); ?>"></script>
	<script defer src="./js/slideshow.js?<?= time(); ?>"></script>
</body>
</html>