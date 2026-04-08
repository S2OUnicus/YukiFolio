<?php
$rootDir = dirname(__DIR__);
$basePath = '../';
$workId = $_GET['id'] ?? null;
if ($workId === null || !preg_match('/^\d+$/', (string)$workId)) {
	http_response_code(404);
	echo '作品が見つかりません。';
	exit;
}
$workPath = $rootDir . '/cont/work/' . $workId . '.phtml';
if (!is_file($workPath)) {
	http_response_code(404);
	echo '作品が見つかりません。';
	exit;
}
$pageTitle = 'YUKINO-ONLINESITE';
$stylesheetHrefs = [$basePath . 'css/work.css'];
require $rootDir . '/common/head.phtml';
?>
<body>
<?php
$showHamburger = false;
$headerExtraHtml = '';
require $rootDir . '/common/header.phtml';
$peekCatAlt = 'kinonya';
require $rootDir . '/common/peek-cat.phtml';
?>
		<div id="contents">
			<div id="main">
<?php require $workPath; ?>
			</div>
		</div>
<?php
$scriptSrcs = [$basePath . 'js/Return-to-top.js'];
require $rootDir . '/common/footer.phtml';
