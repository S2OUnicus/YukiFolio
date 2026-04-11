PHP 8.5 Nginxを使って
いまはこのようなサブサイトを作りたいと思います
ルールは以下の内容となります

------

１．メインサイトのルートが

```
root /www/wwwroot/Open/Yukino/Portfolio/Main/public;
```

２．既存の nginx rewrite rules が
```
error_page 404 /common/404.html;
error_page 502 /common/404.html;

rewrite ^/(?:old|game|JIMUCTI|Project)(?:/.*)?$ /standalone$uri last;

# /old, /game, /JIMUCTI 本体と配下を /standalone へ
rewrite ^/(old|game|JIMUCTI)(/.*)?$ /standalone$uri last;

# /work/数字 だけを内部リライト
rewrite ^/work/([0-9]+)/?$ /work/index.php?id=$1 last;

# /work と /work/ は gallery へ
rewrite ^/work/?$ /gallery permanent;

location / {
    try_files $uri $uri/ $uri.php?$query_string;
}

```

３．「/www/wwwroot/Open/Yukino/Portfolio/Main/Config/Project/base.set.php」を新規して
以下のパスは「base.set.php」に相対するパスで定義します。

```
-「/www/wwwroot/Open/Yukino/Portfolio/Main/Config/Project」は「${config_dir}」と定義します

- 「/www/wwwroot/Open/Yukino/Portfolio/Main/public/standalone/Project」は「${home_dir}」と定義します

-「/www/wwwroot/Open/Yukino/Portfolio/Main/public/standalone/Project/common」は「${common_dir}」と定義します
-「/www/wwwroot/Open/Yukino/Portfolio/Main/public/standalone/Project/inner」は「${inner_dir}」と定義します
```

これらのフォルダは、「${home_dir}」以外のフォルダは、それらの中のファイルは直接アクセスしてはいけないです。


４．「${home_dir}」で、以下のファイルを新規します
```
- index.php
- Page.php
- Post.php
- SP.php
```


５．「${common_dir}」で、以下のファイルを新規します
```
- meta.phtml
- link.phtml
- pwa.phtml（空白ファイルだけ新規します、今の時点はPWA機能が使いません）
- css.phtml
- script_first.phtml

- noscript.phtml
- script_last.phtml
```


６．「${inner_dir}」で、以下のファイルを新規します
```
- index_im.phtml
- Page.phtml
- Post.phtml
- SP.phtml
```


7.「${config_dir}」で、以下のファイルを新規します

```
- Project.php

- index_im.php
- Page.php
- Post.php
- SP.php

- Data/Page/1.php
- Data/Post/1.php
- Data/SP/Dash.php
```


８．以下のページは、それぞれの構造を書きます

- ${home_dir}/index.php
```
- head
  - meta 部分：require_once("${common_dir}\meta.phtml");
  - title
  - link 部分：require_once("${common_dir}\link.phtml");
  - PWA 部分：require_once("${common_dir}\pwa.phtml");
  - CSS ファイル導入部分：require_once("${common_dir}\css.phtml");
  - JS ファイル導入部分（head 入れ部分）：require_once("${common_dir}\script_first.phtml");

- body
  - noscript 部分：require_once("${common_dir}\noscript.phtml");
  - div #stage
    - require_once("${inner_dir}/index_im.phtml");
  - JS ファイル導入部分（body 入れ部分）：require_once("${common_dir}\script_last.phtml");
```

- ${home_dir}/Page.php
```
- head
  - meta 部分：require_once("${common_dir}\meta.phtml");
  - title
  - link 部分：require_once("${common_dir}\link.phtml");
  - PWA 部分：require_once("${common_dir}\pwa.phtml");
  - CSS ファイル導入部分：require_once("${common_dir}\css.phtml");
  - JS ファイル導入部分（head 入れ部分）：require_once("${common_dir}\script_first.phtml");

- body
  - noscript 部分：require_once("${common_dir}\noscript.phtml");
  - div #stage
    - require_once("${inner_dir}/Page.phtml");
  - JS ファイル導入部分（body 入れ部分）：require_once("${common_dir}\script_last.phtml");
```

- ${home_dir}/Post.php
```
- head
  - meta 部分：require_once("${common_dir}\meta.phtml");
  - title
  - link 部分：require_once("${common_dir}\link.phtml");
  - PWA 部分：require_once("${common_dir}\pwa.phtml");
  - CSS ファイル導入部分：require_once("${common_dir}\css.phtml");
  - JS ファイル導入部分（head 入れ部分）：require_once("${common_dir}\script_first.phtml");

- body
  - noscript 部分：require_once("${common_dir}\noscript.phtml");
  - div #stage
    - require_once("${inner_dir}/Post.phtml");
  - JS ファイル導入部分（body 入れ部分）：require_once("${common_dir}\script_last.phtml");
```

- ${home_dir}/SP.php
```
- head
  - meta 部分：require_once("${common_dir}\meta.phtml");
  - title
  - link 部分：require_once("${common_dir}\link.phtml");
  - PWA 部分：require_once("${common_dir}\pwa.phtml");
  - CSS ファイル導入部分：require_once("${common_dir}\css.phtml");
  - JS ファイル導入部分（head 入れ部分）：require_once("${common_dir}\script_first.phtml");

- body
  - noscript 部分：require_once("${common_dir}\noscript.phtml");
  - div #stage
    - require_once("${inner_dir}/SP.phtml");
  - JS ファイル導入部分（body 入れ部分）：require_once("${common_dir}\script_last.phtml");
```


${inner_dir}/index_im.phtml
```
- div #csn
- div #vsm
```


${inner_dir}/Page.phtml（このページは以下の内容だけ、headなどはいらないです）
```
- section #list
```


${inner_dir}/Post.phtml（このページは以下の内容だけ、headなどはいらないです）
```
- section #ist
```


${inner_dir}/SP.phtml（このページは以下の内容だけ、headなどはいらないです）
```
- a #nsm [href="",title=""]
```


９．以下のページで、それぞれ変数と値を書きます

${config_dir}/index_im.php
```
$csn = 1;
$vsm = 2;
```

${config_dir}/Data/Page/1.php
```
$list-1 = a;
$list-2 = b;
$list-3 = 8;
```

${config_dir}/Data/Post/1.php
```
$list-1 = g;
$list-2 = 7;
$list-3 = c;
```

${config_dir}/Data/SP/Dash.php
```
$link = "https://example.com/page?id=3";
$title = "Example 3";
```


１０．以下のロジックがあります
なお、「${id}」は数字のみを受け入り、「${word}」は数字かアルファベットしか受けません

- ユーザーが「/Project/」か「/Project/index」か「/Project/index.php」をアクセスすると、「${inner_dir}/index_im.phtml」は「${config_dir}/index_im.php」を読み取り、「$csn」と「$vsm」の値を取得して、それぞれ「div #csn」と「div #vsm」のinnerHTMLを置き換えます

- ユーザーが「/Project/Page/${id}」か「/Project/Page?id=${id}」をアクセスすると、「${inner_dir}/Page.phtml」は「${config_dir}/Data/Page/${id}.php」を読み取り、「$list-*」の数量とそれぞれの値を取得して、「section #list」の中にそれの数量と一致する「div #list-1 .list-data」を新規して、変数の値はそれらのinnerHTMLとして書きます

- ユーザーが「/Project/Post/${id}」か「/Project/Post?id=${id}」をアクセスすると、「${inner_dir}/Page.phtml」は「${config_dir}/Data/Page/${id}.php」を読み取り、「$list-*」の数量とそれぞれの値を取得して、「section #list」の中にそれの数量と一致する「div #list-1 .list-data」を新規して、変数の値はそれらのinnerHTMLとして書きます

- ユーザーが「/Project/SP/${word}」か「/Project/SP?wd=${word}」をアクセスすると、「${inner_dir}/SP.phtml」は「${config_dir}/Data/SP/${word}.php」を読み取り、「$link」と「$title」の値を取得して、「a #nsm [href="",title=""]」を「a #nsm [href="$link",title="$title"]」に置き換えます


１１．すべてのファイルは安全性と異常処理を考えます

１２．すべてのファイルは四つのスペースでフォーマットし、LF改行します


------

以上のルールでサイトと作ります

お願いします