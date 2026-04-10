
	<link rel="manifest" href="../../manifest.webmanifest">
	<link rel="apple-touch-icon" href="../../image/icons/apple-touch-icon.png">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="default">
	<meta name="apple-mobile-web-app-title" content="ゆきフォリオ">
	<link rel="stylesheet" href="../../css/pwa-ui.css">
</head>
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
		<meta name="description" content="桃・苺・ぶどう・レモンの4つの香りを楽しめる、季節限定ハンドクリームのプロモーションページ。" />
		<link rel="icon" href="./favicon.ico">
		<title>季節のフレグランス ハンドクリーム - ゆきフォリオ (YUKINO Portfolio)</title>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Klee+One&display=swap" rel="stylesheet">
		<!-- Base Style -->
		<link rel="stylesheet" href="./base.css?<?= time(); ?>">
		<!-- JQuery -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	</head>

	<body>
		<header class="site-header">
			<div class="header-inner">
				<a class="brand" href="#top" aria-label="トップへ戻る">
					<span class="brand-mark">✦</span>
					<span>SEASONAL HAND CREAM</span>
				</a>
				<nav class="nav">
					<a href="#collection">シリーズ　</a>
					<a href="#idea">発想　</a>
					<a href="#feature">特徴　</a>
					<a class="btn btn-secondary" href="#cta">香りを選ぶ</a>
				</nav>
			</div>
		</header>
		<main id="top">
			<section class="hero">
				<canvas id="hero-three" aria-hidden="true"></canvas>
				<div class="container hero-grid">
					<div class="hero-copy reveal is-visible">
						<div class="eyebrow">FOUR SCENTS, FOUR MOODS</div>
						<h1>香りで選ぶ、<br>今日の手もと。</h1>
						<p class="hero-lead"> 桃・苺・ぶどう・レモン。<br> 季節ごとに気分を映す4つのフレグランスを、やさしい世界観で見せる商品宣伝ページとして設計しました。<br> ふんわり軽いトーンと、透明感のある立体演出で「手に取りたくなる空気感」を表現しています。 </p>
						<div class="hero-actions">
							<a class="btn btn-primary" href="#collection">4つの香りを見る</a>
							<a class="btn btn-secondary" href="#idea">デザインの発想を見る</a>
						</div>
						<div class="mood-chips">
							<span class="chip"><span class="chip-swatch" style="background: var(--peach)"></span> 桃 / やわらかい甘さ</span>
							<span class="chip"><span class="chip-swatch" style="background: var(--strawberry)"></span> 苺 / ふんわり華やか</span>
							<span class="chip"><span class="chip-swatch" style="background: var(--grape)"></span> ぶどう / 深みのある余韻</span>
							<span class="chip"><span class="chip-swatch" style="background: var(--lemon)"></span> レモン / 軽やかな爽快感</span>
						</div>
						<div class="product-link-row" aria-label="商品ページへのリンク">
							<a class="mini-link" href="../../work/5">桃を見る</a>
							<a class="mini-link" href="../../work/4">苺を見る</a>
							<a class="mini-link" href="../../work/6">ぶどうを見る</a>
							<a class="mini-link" href="../../work/7">レモンを見る</a>
						</div>
					</div>
					<div class="showcase reveal">
						<div class="showcase-stage" id="showcase-stage" aria-label="四つのハンドクリームを左右にドラッグして切り替え" tabindex="0">
							<div class="showcase-ring"></div>
							<a class="orbit-item" href="../../work/5" data-name="桃" data-link="../../work/5" aria-label="桃のページを見る">
								<div class="orbit-card">
									<div class="orbit-figure"><img src="assets/3.png" alt="桃の香りのハンドクリーム" /></div>
									<div class="orbit-meta">
										<span class="orbit-name">桃</span>
										<span class="orbit-copy">やわらかい甘さ</span>
									</div>
								</div>
							</a>
							<a class="orbit-item" href="../../work/4" data-name="苺" data-link="../../work/4" aria-label="苺のページを見る">
								<div class="orbit-card">
									<div class="orbit-figure"><img src="assets/6.png" alt="苺の香りのハンドクリーム" /></div>
									<div class="orbit-meta">
										<span class="orbit-name">苺</span>
										<span class="orbit-copy">ふんわり華やか</span>
									</div>
								</div>
							</a>
							<a class="orbit-item" href="../../work/6" data-name="ぶどう" data-link="../../work/6" aria-label="ぶどうのページを見る">
								<div class="orbit-card">
									<div class="orbit-figure"><img src="assets/7.png" alt="ぶどうの香りのハンドクリーム" /></div>
									<div class="orbit-meta">
										<span class="orbit-name">ぶどう</span>
										<span class="orbit-copy">深みのある余韻</span>
									</div>
								</div>
							</a>
							<a class="orbit-item" href="../../work/7" data-name="レモン" data-link="../../work/7" aria-label="レモンのページを見る">
								<div class="orbit-card">
									<div class="orbit-figure"><img src="assets/8.png" alt="レモンの香りのハンドクリーム" /></div>
									<div class="orbit-meta">
										<span class="orbit-name">レモン</span>
										<span class="orbit-copy">軽やかな爽快感</span>
									</div>
								</div>
							</a>
							<div class="showcase-hint" aria-hidden="true"><span>左右ドラッグで香りを回転</span></div>
						</div>
						<div class="hero-note"> その日の気分に、ひとつ香りを</div>
					</div>
				</div>
			</section>
			<section id="collection">
				<div class="container">
					<div class="section-head reveal">
						<div>
							<div class="section-kicker">Collection</div>
							<h2 class="section-title">季節で選べる、4つのフレグランス。</h2>
						</div>
						<p class="section-desc"> パッケージのやわらかい色味を主役にしながら、各商品ごとに気分・季節・印象がひと目で伝わる構成にしています。 画像を大きく見せ、香りの世界観をコピーで補強するLPデザインです。 </p>
					</div>
					<div class="cards">
						<article class="card reveal" style="background: linear-gradient(180deg, rgba(255,255,255,.80), rgba(248,216,222,.42));">
							<div class="badge">夏限定</div>
							<h3>桃</h3>
							<p>やわらかく、ほのかに甘い印象。淡いピンクと余白感で、涼しさとやさしさを同時に見せる主役フレグランス。</p>
							<div class="card-visual"><img src="assets/3.png" alt="桃のフレグランス ハンドクリーム" /></div>
							<div class="note-list">
								<span class="note-pill">やさしい雰囲気</span>
								<span class="note-pill">みずみずしい印象</span>
								<span class="note-pill">ギフトにも◎</span>
							</div>
							<div class="product-link-row"><a class="mini-link" href="../../work/5">桃の商品ページへ</a></div>
						</article>
						<article class="card reveal" style="background: linear-gradient(180deg, rgba(255,255,255,.80), rgba(245,200,207,.45));">
							<div class="badge">春限定</div>
							<h3>苺</h3>
							<p>かわいらしさと華やかさを感じるデザイン。小粒のいちごを散らし、手に取る前から楽しい気分をつくります。</p>
							<div class="card-visual"><img src="assets/6.png" alt="苺のフレグランス ハンドクリーム" /></div>
							<div class="note-list">
								<span class="note-pill">ふんわり甘い</span>
								<span class="note-pill">春らしい軽さ</span>
								<span class="note-pill">かわいい配色</span>
							</div>
							<div class="product-link-row"><a class="mini-link" href="../../work/4">苺の商品ページへ</a></div>
						</article>
						<article class="card reveal" style="background: linear-gradient(180deg, rgba(255,255,255,.80), rgba(212,195,234,.45));">
							<div class="badge">秋限定</div>
							<h3>ぶどう</h3>
							<p>深みのある紫をアクセントに、少し大人っぽい世界観へ。甘さだけでなく、落ち着きも感じられる一品として見せます。</p>
							<div class="card-visual"><img src="assets/7.png" alt="ぶどうのフレグランス ハンドクリーム" /></div>
							<div class="note-list">
								<span class="note-pill">上品な余韻</span>
								<span class="note-pill">秋のムード</span>
								<span class="note-pill">洗練感</span>
							</div>
							<div class="product-link-row"><a class="mini-link" href="../../work/6">ぶどうの商品ページへ</a></div>
						</article>
						<article class="card reveal" style="background: linear-gradient(180deg, rgba(255,255,255,.82), rgba(248,239,173,.42));">
							<div class="badge">冬限定</div>
							<h3>レモン</h3>
							<p>白を多く残したすっきりした構成で、軽やかな爽快感を表現。明るい黄色がページ全体の抜け感にもつながります。</p>
							<div class="card-visual"><img src="assets/8.png" alt="レモンのフレグランス ハンドクリーム" /></div>
							<div class="note-list">
								<span class="note-pill">すっきり爽やか</span>
								<span class="note-pill">清潔感</span>
								<span class="note-pill">ユニセックス感</span>
							</div>
							<div class="product-link-row"><a class="mini-link" href="../../work/7">レモンの商品ページへ</a></div>
						</article>
					</div>
				</div>
			</section>
			<section id="idea">
				<div class="container">
					<div class="section-head reveal">
						<div>
							<div class="section-kicker">Idea</div>
							<h2 class="section-title">このページの発想。</h2>
						</div>
						<p class="section-desc"> 商品画像そのものがかわいく完成しているため、過剰に装飾せず、透明感・余白・浮遊感で価値を引き上げる方向で設計しました。 </p>
					</div>
					<div class="idea-panel">
						<div class="idea-block reveal">
							<h3>内容の方向性</h3>
							<ul>
								<li>「香りの説明」だけでなく、「その香りを選びたくなる気分」まで言語化する。</li>
								<li>4商品を一覧で比較しやすくしつつ、1本ずつの個性が埋もれない見せ方にする。</li>
								<li>購買ページというより、世界観に惹かれてスクロールしたくなるブランドLPとして構成する。</li>
								<li>コピーはやわらかく、短く、写真やパッケージの繊細さを邪魔しないトーンにする。</li>
							</ul>
						</div>
						<div class="idea-block reveal">
							<h3>デザインの方向性</h3>
							<ul>
								<li>背景は淡いベージュ基調にして、パッケージの白とやさしくなじませる。</li>
								<li>桃・苺・ぶどう・レモンの色を淡いアクセントカラーとして使い、商品ごとに空気感を変える。</li>
								<li>ヒーローでは商品を“浮かせる”構成にして、軽やかさと特別感を演出する。</li>
								<li>three.js は主役ではなく補助演出として使い、香りの粒子のような静かな動きで高級感を足す。</li>
							</ul>
						</div>
					</div>
				</div>
			</section>
			<section id="feature">
				<div class="container">
					<div class="section-head reveal">
						<div>
							<div class="section-kicker">Feature</div>
							<h2 class="section-title">見せ方のポイント。</h2>
						</div>
						<p class="section-desc"> 商品の魅力を伝えるために、売り文句よりも体験の想像がふくらむ導線を重視しています。 </p>
					</div>
					<div class="feature-grid">
						<div class="feature reveal">
							<div class="num">01</div>
							<h4>香りで選ぶ導線</h4>
							<p>最初に「4つの香り」という入口を置くことで、ユーザーが直感的に好みの一本へ進めます。</p>
						</div>
						<div class="feature reveal">
							<div class="num">02</div>
							<h4>商品画像を主役化</h4>
							<p>パッケージの魅力が伝わるように、背景は控えめに。白場とやさしい影で存在感を出しています。</p>
						</div>
						<div class="feature reveal">
							<div class="num">03</div>
							<h4>季節感のラベリング</h4>
							<p>春夏秋冬の限定表記を小さなバッジに整理し、シリーズ感と特別感を同時に見せています。</p>
						</div>
						<div class="feature reveal">
							<div class="num">04</div>
							<h4>静かな立体演出</h4>
							<p>three.js の背景演出はあくまで補助。読みやすさを崩さず、香りの余韻だけをそっと加えます。</p>
						</div>
					</div>
				</div>
			</section>
			<section class="cta" id="cta">
				<div class="container">
					<div class="cta-box reveal">
						<div class="cta-copy">
							<div class="section-kicker">Call To Action</div>
							<h2>その日の気分に、<br>ひとつ香りを。</h2>
							<p> 「かわいい」だけで終わらせず、香りごとの気分やシーンまで提案することで、 商品を選ぶ時間そのものが楽しくなるページを目指しました。<br> ECボタンや購入導線を追加すれば、そのまま販促LPとして展開できます。 </p>
							<div class="hero-actions">
								<a class="btn btn-primary" href="#top">もう一度トップを見る</a>
								<a class="btn btn-secondary" href="#collection">コレクションを見る</a>
							</div>
							<div class="product-link-row" aria-label="各商品の詳細ページ">
								<a class="mini-link" href="../../work/5">桃</a>
								<a class="mini-link" href="../../work/4">苺</a>
								<a class="mini-link" href="../../work/6">ぶどう</a>
								<a class="mini-link" href="../../work/7">レモン</a>
							</div>
						</div>
						<div class="cta-visual" aria-hidden="true">
							<img src="assets/3.png" alt="" />
							<img src="assets/6.png" alt="" />
							<img src="assets/7.png" alt="" />
							<img src="assets/8.png" alt="" />
						</div>
					</div>
				</div>
			</section>
		</main>
		<footer class="site-footer">© 2026 ゆきフォリオ (YUKINO Portfolio). All Rights Reserved.</footer>
		<script defer src="https://unpkg.com/three@0.160.0/build/three.min.js"></script>
		<script defer src="./base.js?<?= time(); ?>"></script>
	
	<script>window.__PWA_CONFIG__ = { swPath: '../../service-worker.js' };</script>
	<script defer data-pwa-enhancements="1" src="../../js/pwa-enhancements.js"></script>
</body>

</html>
