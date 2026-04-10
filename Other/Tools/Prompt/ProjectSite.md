PHP Nginxを使って
いまはこのようなページを作りたいと思います

nginx site config（一部）
```
```

nginx rewrite rules
```
```

ルールは以下のようにします
------

１．サイトルートに相対して「Project/index.php」を始め、今回の開発を始めます。以下すべてのファイルはこのファイルに相対してパスを決定します。
２．「Config/Project」フォルダはこれから「${config_dir}」と定義します。このフォルダのファイルは直接アクセスできないです。
３．「common」フォルダはこれから「${phtml_dir}」と定義します。このフォルダのファイルは直接アクセスできないです。

４．「${config_dir}」に以下のファイルとフォルダを新規します

```
- Project.php
- Page/
  - 1.php
- Post/
  - 1.php
- Special/
  - Dash.php
```


５．「${phtml_dir}」に以下のファイルとフォルダを新規します

```
- Project.phtml
- Page.phtml
- Post.phtml
- Special/
  - Dash.phtml
```


６．以下の変数と値を書きます

${config_dir}/Project.php
```
$csn = 1;
$vsm = 2;
```

${config_dir}/Page/Page-1.php
```
$list-1 = a;
$list-2 = b;
$list-3 = 8;
```

${config_dir}/Post/Post-1.php
```
$list-1 = g;
$list-2 = 7;
$list-3 = c;
```

${config_dir}/Special/Dash.php
```
$link = "https://example.com/page?id=3";
$title = "Example 3";
```


７．以下のページに以下のタグがあります

${phtml_dir}/Project.phtml
```
- div #csn
- div #vsm
```

${phtml_dir}/Page.phtml
```
- section .list
  - div .list-data
```

${phtml_dir}/Post.phtml
```
- section .list
  - div .list-data
```

${phtml_dir}/Special/Dash.phtml
```
- a #nsm [href="",title=""]
```

８．以下のルールで、「${phtml_dir}」のphtmlは「${config_dir}」での対応するページなかの変数を読み込んで、指定的な場所に内容を置き換えます。

```
${phtml_dir}/Project.phtml : 同名変数の値をphtmlタグのinnerHTMLを置き換えます

${phtml_dir}/Page.phtml : 以下のルールでidの値を取得して、それに対応する「${config_dir}」のファイルにその変数「$list-*」の値で、「.list」の中にいくつかの「div .list-data」を新規して、それらのinnerHTMLを置き換えます

${phtml_dir}/Post.phtml : 同上

${phtml_dir}/Special/Dash.phtml : 「a #nsm [href="$link",title="$title"]」の形にします

```


９．「index.php」に「div #pst_main」があります。
パラメータなしでアクセスすると、「require_once();」で「${phtml_dir}/Project.phtml」の内容を「div #pst_main」に入ります

１０．以下のページにアクセス

```
Project/Page/1
Project/Page/1/
Project/Page?id=1
Project/?Page&id=1
Project/?Page=1
Project/index?Page=1
Project/index.php?Page=1
```

すると、「${phtml_dir}/Page.phtml」は以上のルールに指定の「${config_dir}」ファイルを読み込んで、
「index.php」は「require_once();」で「${phtml_dir}/Page.phtml」の内容を「div #pst_main」に入ります。

「Page」、「id」のアルファベットは大文字か小文字区別しません

なお、「Project/page.php」は存在せず、そのパスは使用しません。


１１．Postは「ルール１０」を参照します。

１２．Page、Postのid部分は数字しか受けません。なお、ほかの内容かIDがないなら404します。

１３．以下のページにアクセス

```
Project/Special/Dash
Project/Special/Dash/
Project/Special?p=Dash
Project/?Special&p=Dash
Project/?Special=Dash
Project/index?Special=Dash
Project/index.php?Special=Dash
```

すると、「${phtml_dir}/Special/Dash.phtml」は以上のルールに指定の「${config_dir}」ファイルを読み込んで、
「index.php」は「require_once();」で「${phtml_dir}/Special/Dash.phtml」の内容を「div #stage」タグの中のすべての内容を置き換えます。

１４．「Special」のパラメータ「p」の値はアルファベットか数字しか受けません

１５．「div #pst_main」は「div #stage」の中にあります。

１６．これらのルールから外れたアクセスは全部404とします。なお、用に応じて、500も出来ます。

１７．すべてのファイルは安全性と異常処理を考えます

１８．すべてのファイルは四つのスペースでフォーマットし、LF改行します

１９．「index.php」の構造は以下のようになります

```
- head
- body
  - noscript
  - div #stage
    - header
    - nav
    - main
      - div #pst_main
    - footer
```

------

以上のルールでサイトを作ります

お願いします