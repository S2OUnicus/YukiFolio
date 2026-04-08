<?php
$pageTitle = 'YUKINO-ONLINESITE';
$stylesheetHrefs = ['css/contact.css'];
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
<div id="inquiry">
			<article>
				<h1 class="inquiry">お問い合わせ</h1>
				<p>アイデアやアドバイス、製作者に聞きたいことなどを募集しております！<br> お気軽にお問い合わせください！</p><br>
				<ul>
					<li>必要事項を記入し、「確認する」をクリックしてください。</li>
					<li>ご登録いただいた個人情報は、お問い合わせ内容の確認以外には使用いたしません。</li>
				</ul>
				<form action="#">
					<p><label>ニックネーム（必須）<br>
							<input type="text" name="name" required></label></p>
					<p><label>メールアドレス（必須）<br>
							<input type="email" name="mail" required></label></p>
					<p>お問い合わせ種類<br>
						<label><input type="radio" name="kind" value="0">アイデア</label><br>
						<label><input type="radio" name="kind" value="1">アドバイス</label><br>
						<label><input type="radio" name="kind" value="2">質問</label><br>
						<label><input type="radio" name="kind" value="3">その他</label>
					</p>
					<p><label>内容<br>
							<textarea name="comment"></textarea></label></p>
					<input type="checkbox" id="agree" name="agree" required>
					<label for="agree">メールマガジンの配信を希望</label><br>
					<input type="checkbox" id="agree" name="agree" required>
					<label for="agree">今後の更新情報を受け取る</label><br><br>
					<p><input type="submit" value="確認する"></p>
				</form>
			</article>
			<div id="sample">
				<img src="image/materiaru/SAMPLE.png" alt="サンプル">
			</div>
		</div>
<?php
$scriptSrcs = ['js/Return-to-top.js'];
require __DIR__ . '/common/footer.phtml';
