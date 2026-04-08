<?php
$pageTitle = 'YUKINO-ONLINESITE';
$stylesheetHrefs = ['css/profile.css'];
require __DIR__ . '/common/head.phtml';
?>
<body>
<?php
$showHamburger = false;
$headerExtraHtml = '';
require __DIR__ . '/common/header.phtml';
$peekCatAlt = 'kinonya';
require __DIR__ . '/common/peek-cat.phtml';
?>
<div id="contents">
			<section class="profile-box">
				<h1 id="profile-title">プロフィール</h1>
				<img src="image/season/spring.png" class="slide-right" alt="プロフィールメイン">
				<img src="image/season/summer.png" class="slide-left" alt="プロフィールスキル">
				<img src="image/season/autumn.png" class="slide-right" alt="プロフィール取得検定">
				<img src="image/season/winter.png" class="slide-left" alt="プロフィール詳細">
			</section>
		</div>
<?php
$scriptSrcs = ['js/Return-to-top.js', 'js/scroll.js'];
require __DIR__ . '/common/footer.phtml';
