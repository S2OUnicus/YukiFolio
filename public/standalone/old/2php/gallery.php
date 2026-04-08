<?php
$pageTitle = 'YUKINO-ONLINESITE';
$stylesheetHrefs = ['css/gallery.css'];
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
			<div id="main">
				<div id="graphic">
					<ul>
						<li class="now">
							<img class="image1" src="image/poster/strawberry.jpg" alt="苺ポスター">
						</li>
						<li><img class="image2" src="image/poster/peach.jpg" alt="桃ポスター"></li>
						<li><img class="image3" src="image/poster/grapes.jpg" alt="ぶどうポスター"></li>
						<li><img class="image4" src="image/poster/lemon.jpg" alt="レモンポスター"></li>
					</ul>
					<p>　ハンドクリーム一覧</p>
				</div>
				<div class="LINE">
					<a href="https://store.line.me/stickershop/product/31223760/ja?ref=Desktop">
						<img src="image/others/LINE-stamp.png" alt="LINEスタンプ">
					</a>
					<p>　　LINEスタンプ</p>
				</div>
				<div class="exhibition">
					<img src="image/others/exhibition.jpg" alt="作品展示会ポスター">
					<p>　作品展示会ポスター</p>
				</div>
				<div class="JIMCHI">
					<a href="JIMUCTI/loader.html">
						<img src="image/others/JIMCHI.png" alt="JIMCHI">
					</a>
					<p>　　JIMCHIサイト</p>
				</div>
				<section>
					<h2>作品一覧　(制作順)</h2>
					<div class="list">
						<a href="work?id=10">
							<figure><img src="image/gallery/1.png" alt="名刺"></figure>
							<h4>名刺</h4>
							<p>名刺交換に使える。</p>
						</a>
					</div>
					<div class="list">
						<a href="work?id=1">
							<figure><img src="image/gallery/2.png" alt="Tシャツ"></figure>
							<h4>Tシャツ</h4>
							<p>「音×宇宙」をテーマにしたＴシャツ。パンツと合わせると良い。</p>
						</a>
					</div>
					<div class="list">
						<a href="work?id=5">
							<figure><img src="image/gallery/3.png" alt="ハンドクリーム桃"></figure>
							<h4>ハンドクリーム桃</h4>
							<p>夏限定のハンドクリーム。桃の香りがする。</p>
						</a>
					</div>
					<div class="list">
						<a href="work?id=9">
							<figure><img src="image/gallery/4.png" alt="きのにゃんのLINEスタンプ"></figure>
							<h4>きのにゃんのLINEスタンプ</h4>
							<p>日常で使えるLINEスタンプ。実際にLINEストアで買える。</p>
						</a>
					</div>
					<div class="list">
						<a href="work?id=3">
							<figure><img src="image/gallery/5.png" alt="kinonyaのロゴ"></figure>
							<h4>kinonyaのロゴ</h4>
							<p>このサイトで使われているロゴ。</p>
						</a>
					</div>
					<div class="list">
						<a href="work?id=4">
							<figure><img src="image/gallery/6.png" alt="ハンドクリーム苺"></figure>
							<h4>ハンドクリーム苺</h4>
							<p>春限定のハンドクリーム。苺の香りがする。</p>
						</a>
					</div>
					<div class="list">
						<a href="work?id=6">
							<figure><img src="image/gallery/7.png" alt="ハンドクリームぶどう"></figure>
							<h4>ハンドクリームぶどう</h4>
							<p>秋限定のハンドクリーム。ぶどうの香りがする。</p>
						</a>
					</div>
					<div class="list">
						<a href="work?id=7">
							<figure><img src="image/gallery/8.png" alt="ハンドクリームレモン"></figure>
							<h4>ハンドクリームレモン</h4>
							<p>冬限定のハンドクリーム。レモンの香りがする。</p>
						</a>
					</div>
					<div class="list">
						<a href="work?id=11">
							<figure><img src="image/gallery/9.png" alt="HIPHOPかるた箱"></figure>
							<h4>HIPHOPかるた箱</h4>
							<p>作品展示会で制作したオリジナルかるたの箱。<br>102枚のカードが入っており、実際に遊べる。</p>
						</a>
					</div>
					<div class="list">
						<a href="work?id=12">
							<figure><img src="image/gallery/10.png" alt="HIPHOPかるたカード"></figure>
							<h4>HIPHOPかるたカード</h4>
							<p>作品展示会で制作したオリジナルかるたのカード。<br>102枚のカードが入っており、実際に遊べる。</p>
						</a>
					</div>
					<div class="list">
						<a href="work?id=2">
							<figure><img src="image/gallery/11.png" alt="パンツ"></figure>
							<h4>パンツ</h4>
							<p>深海→空→夜空のグラデーションのパンツ。Tシャツと合わせると良い。</p>
						</a>
					</div>
					<div class="list">
						<a href="work?id=13">
							<figure><img src="image/gallery/12.png" alt="入浴剤"></figure>
							<h4>入浴剤</h4>
							<p>季節の入浴剤。春夏秋冬の香りが楽しめる。</p>
						</a>
					</div>
					<div class="list">
						<a href="work?id=8">
							<figure><img src="image/gallery/13.png" alt="ロゴ２"></figure>
							<h4>kinonyaのロゴ２</h4>
							<p>ロゴ２つ目。このサイトで使われている。</p>
						</a>
					</div>
					<div class="list">
						<a href="work?id=14">
							<figure><img src="image/gallery/14.png" alt="ポートフォリオ集"></figure>
							<h4>ポートフォリオ集</h4>
							<p>作品集。今までの作品が収録されてる。</p>
						</a>
					</div>
				</section>
			</div>
		</div>
<?php
$scriptSrcs = ['js/Return-to-top.js', 'js/slideshow.js'];
require __DIR__ . '/common/footer.phtml';
