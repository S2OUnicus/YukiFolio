いまからPHPサイトを静的化しようと思います。
以下のルールを基づいて実行しましょう。

なお、「/public/standalone/JIMUCTI」なかの内容は処理せず、そのまま保留します。

------

１．「/.htaccess」を参考します。
２．外部レポジトリは「/public/external」フォルダのなかの内容で置き換え、「head > meta」の「preconnect」を削除します。
フォントは全部「/public/external/KleeOne-Regular.woff2」で置き換えます。
「/public/js/p_portfolio.js」に「import」の内容は「/public/external/pdf.min.mjs」で置き換え、下の内容もそれに応じて調整します。
ブラウザはローカルファイル直開きだと import を CORS 扱いで止めますので、portfolio 周りをモジュールなしで動く形に修正します
なお、外部サイトページへのリンク（line.me など）はそのまま保留します
３．CORSルールを削除します。
４．「head > meta」で、「meta name="page-generated"」の行、「?<?= time(); ?>」みたいパラメータを削除します。
５．ページへのリンクを「.html」拡張子を付け、「require_once()」で読み取る内容は親ページに合併します。すべてのページファイルは最後htmlにします。
６．「external」以外すべてのHTML、CSS、JSファイルは四つのスペースでフォーマットし、LF改行とします。
７．すべてのHTML、CSS、JSファイルに、「-------------------」のような単純分割用のメモ（文字がないメモ）を削除します。
８．「/public/common/page.phtml」を削除します。
９．「/public/work/common/nowork.php」、404ページなど else 処理のページは、静的サイトは動的機能はないですが、上のルールで phtml と合併したら、元のフォルダにそのまま保留します。
１０．「/public/image」フォルダで、すべての画像を圧縮します。なお、以下のフォルダやファイルは排除します。

```
- /public/image/gallery
- /public/image/materiaru
- /public/image/poster
```

なお、高さが900pxを超えた画像は、高さ900pxに、比率変わらずに縮小してから圧縮します。

------

以上のルールはHTML、CSS、JSに適用します。
なお、ファイル名は「.min.css」、「.min.js」が付いたものは改行・圧縮しません。

最後はリンクの有効性を全部チェックします。


お願いします。
