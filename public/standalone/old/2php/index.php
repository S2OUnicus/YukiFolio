<?php
$pageTitle = 'YUKINO-ONLINESITE';
$stylesheetHrefs = ['css/style.css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css'];
require __DIR__ . '/common/head.phtml';
?>
<body>
<?php
$showHamburger = true;
$headerExtraHtml = <<<'HTML'
	<aside class="mainimg-slick">
		<div><img src="image/slide/slide1.png" alt="作品集"></div>
		<div><img src="image/slide/slide2.png" alt="YUKINOチラシ"></div>
		<div><img src="image/slide/slide3.png" alt="LINEスタンプ"></div>
		<div><img src="image/slide/slide4.png" alt="間違い探し"></div>
	</aside>
HTML;
require __DIR__ . '/common/header.phtml';
$peekCatAlt = 'kinonya';
require __DIR__ . '/common/peek-cat.phtml';
?>
<div class="JIMCHI">
			<img src="image/others/JIMCHI.png" alt="JIMCHI">
			<p class="poster2">JIMCHIサイト制作しました。↓</p>
			<a href="JIMUCTI/loader.html">
				<p>サイトを見る</p>
			</a>
		</div>
		<div id="contents">
			<div id="main">
				<section id="new">
					<h2>お知らせ</h2>
					<div class="list-free">
						<dl class="new">
							<dt>2026/03/23<span>ホームページ公開</span></dt>
							<dd>YUKINO-オンラインホームページが公開されました！</dd>
							<dt>2026/01/23<span class="icon-bg1">サイト制作</span></dt>
							<dd>焼肉店JIMCH様のホームページを製作させていただきました！<a href="JIMUCTI/loader.html">→JIMCHIサイト</a><br> 　※実案件のため一部非公開（現在クライアントと調整中）</dd>
							<dt>2025/12/16<span class="icon-bg1">ポートフォリオPDF</span></dt>
							<dd>ポートフォリオのPDFを作成しました！ <a href="PDF/portfolio.pdf" target="_blank">PDFを見る</a>
							</dd>
						</dl>
					</div>
				</section>
				<div id="graphic">
					<ul>
						<li class="now">
							<img class="image1" src="image/poster/strawberry.jpg" alt="苺ポスター">
						</li>
						<li><img class="image2" src="image/poster/peach.jpg" alt="桃ポスター"></li>
						<li><img class="image3" src="image/poster/grapes.jpg" alt="ぶどうポスター"></li>
						<li><img class="image4" src="image/poster/lemon.jpg" alt="レモンポスター"></li>
					</ul>
					<div class="poster">
						<p id="poster">季節限定ハンドクリーム</p>
					</div>
				</div>
				<section>
					<h2>季節限定ハンドクリーム</h2>
					<div class="list2">
						<a href="work?id=4">
							<figure>
								<img src="image/top/1.png" alt="ハンドクリーム苺">
							</figure>
							<h4>ハンドクリーム（苺の香り）</h4>
							<span class="option1">春限定</span>
						</a>
					</div>
					<div class="list2">
						<a href="work?id=5">
							<figure>
								<img src="image/top/2.png" alt="ハンドクリーム桃">
							</figure>
							<h4>ハンドクリーム（桃の香り）</h4>
							<span class="option2">夏限定</span>
						</a>
					</div>
					<div class="list2">
						<a href="work?id=6">
							<figure>
								<img src="image/top/3.png" alt="ハンドクリームぶどう">
							</figure>
							<h4>ハンドクリーム（ぶどうの香り）</h4>
							<span class="option3">秋限定</span>
						</a>
					</div>
					<div class="list2">
						<a href="work?id=7">
							<figure>
								<img src="image/top/4.png" alt="ハンドクリームレモン">
							</figure>
							<h4>ハンドクリーム（レモンの香り）</h4>
							<span class="option4">冬限定</span>
						</a>
					</div>
				</section>
				<div id="spot-the-difference">
					<figure class="mb20 c">
						<a href="image/slide/slide4.png" target="_blank">
							<img src="image/others/spot-the-difference.png" alt="間違い探し">
						</a>
					</figure>
					<p>↑やってみる？</p>
				</div>
				<section>
					<h2>アパレル商品</h2>
					<div class="list2">
						<a href="work?id=1">
							<figure>
								<img src="image/top/5.png" alt="Tシャツ">
							</figure>
							<h4>音×自由-Tシャツ-</h4>
							<span class="option5">セット</span>
						</a>
					</div>
					<div class="list2">
						<a href="work?id=2">
							<figure>
								<img src="image/top/6.png" alt="パンツ">
							</figure>
							<h4>音×自由-パンツ</h4>
							<span class="option5">セット</span>
						</a>
					</div>
				</section>
				<section>
					<h2>作品展示会用</h2>
					<div class="list2">
						<a href="work?id=11">
							<figure>
								<img src="image/top/7.png" alt="HIPHOPかるた箱">
							</figure>
							<h4>HIPHOPかるた箱</h4>
							<span class="option6">遊べる</span>
						</a>
					</div>
					<div class="list2">
						<a href="work?id=12">
							<figure>
								<img src="image/top/8.png" alt="HIPHOPかるたカード">
							</figure>
							<h4>HIPHOPかるたカード</h4>
							<span class="option6">遊べる</span>
						</a>
					</div>
				</section>
				<div class="exhibition">
					<img src="image/others/exhibition.jpg" alt="作品展示会ポスター">
					<p class="poster3">作品展示会が開催決定!</p>
				</div>
				<section>
					<h2>ロゴ</h2>
					<div class="list2">
						<a href="work?id=3">
							<figure>
								<img src="image/top/9.png" alt="ロゴ１">
							</figure>
							<h4>ロゴ１</h4>
							<span class="option9">ロゴ</span>
						</a>
					</div>
					<div class="list2">
						<a href="work?id=8">
							<figure>
								<img src="image/top/10.png" alt="ロゴ２">
							</figure>
							<h4>ロゴ２</h4>
							<span class="option9">ロゴ</span>
						</a>
					</div>
					<div class="list2">
						<a href="work?id=14">
							<figure>
								<img src="image/top/11.png" alt="作品集">
							</figure>
							<h4>作品集</h4>
							<span class="option11">作品集</span>
						</a>
					</div>
				</section>
				<div id="portfolio">
					<img src="image/others/portfolio.png" alt="PDF">
					<a href="PDF/portfolio.pdf">
						<p>中身を見る</p>
					</a>
				</div>
				<section>
					<h2>その他</h2>
					<div class="list2">
						<a href="work?id=10">
							<figure>
								<img src="image/top/12.png" alt="名刺">
							</figure>
							<h4>名刺</h4>
							<span class="option8">使える</span>
						</a>
					</div>
					<div class="list2">
						<a href="work?id=9">
							<figure>
								<img src="image/top/13.png" alt="LINEスタンプ">
							</figure>
							<h4>LINEスタンプ</h4>
							<span class="option7">買える</span>
						</a>
					</div>
					<div class="list2">
						<a href="work?id=13">
							<figure>
								<img src="image/top/14.png" alt="入浴剤">
							</figure>
							<h4>入浴剤</h4>
							<span class="option10">果実湯</span>
						</a>
					</div>
				</section>
				<div class="LINE">
					<img src="image/others/LINE-stamp.png" alt="LINEスタンプ">
					<p class="poster4"> LINEスタンプ<br> 好評発売中↓<br>
						<a href="https://store.line.me/stickershop/product/31223760/ja?ref=Desktop">購入はこちらから
					</p></a>
				</div>
			</div>
		</div>
<?php
$scriptSrcs = ['https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', 'js/Return-to-top.js', 'js/slick.js', 'js/slideshow.js'];
require __DIR__ . '/common/footer.phtml';
