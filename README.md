## まずはじめに 
ご覧いただきありがとうございます。このリポジトリはポートフォリオとして作成したタスク管理システムのリポジトリです。  
AWSのEC2インスタンスにてデプロイ
Link:(http://35.78.92.128)

### アプリを作る際に使用したもの
- PHP(Laravelフレームワーク)
- HTML
- CSS※1
- Javascript※1
- Docker for Windows
- AWS

※1 https://template-party.com
にて基本的なレイアウトを用い、追加したい箇所や、削除したい箇所を手修正。

---

## タスク管理システムの機能
- ユーザー認証機能
　- ユーザー登録
  - ログインログオフ
  - ログイン維持
  - パスワードリセット
- 進捗を管理する機能
  - 表のような形式でどのタスクがどの工程まで進んでいるかを一目で確認可能
  - また、タスクにはそれぞれ詳細ページを持ち、その中で案件の詳細を確認したり、コメントなどを投稿することもできる
  - 自身の関わるタスクだけをマイタスクとして登録し、自分が管理したいタスクだけを表示することができる機能
  - マイタスクとして登録したタスクに限っては、進捗管理の署名を入力する際に、エクセルシートのセルに入力するかのように簡単に可能
  - またタスクを作成を行ったり削除を行う場合には権限が必要になっている
- チャットグループ作成機能
  - チャットグループを作成することができる。
  - 作成者は権限が必要になる。また作成する際にチャットグループの名前とどのユーザーをグループに参加させるかを選択可能。（作成した後も変更可能）。
  - チャットグループを作成したものは自身が作成したグループを削除することが可能。
  - チャットグループに入っているユーザーはCHATメニューにて自身が参加しているグループを確認可能。
- 通知機能
  - 自身がマイタスクとして登録しているタスクの進捗更新や、詳細やコメントの追加があった場合、通知してくれる。
  - チャットグループに関しても自身がグループに追加されたときや、参加しているグループに新着コメントがあったときなどに通知してくれる。
- 設定機能
  - 基本的なユーザー機能の変更やパスワード変更が可能
  - 通知する種類を選択したり、一言コメントを記入することによって他のユーザーに簡単に伝えたいことを設定することができる。
- 権限管理機能
  - タスクを追加削除する権利をもつタスク管理機能
  - チャットグループを作成削除および変更することが可能なチャットグループ管理機能
  - 上記二つをどのユーザーに付与させるかを、マスター管理者にて設定可能


---

## なぜこのようなシステムをポートフォリオにしたか
今働いている職場にて進捗管理をエクセルや他のWebシステムにて行っており、実際に進捗を管理する際の不満や改善点などを把握していたために、作成する際の欲しい機能などの選定がしやすかった。
- 職場における進捗管理する際の問題点
  - 誰かがそのエクセルファイルを開いていると、他の人は書き込みができない
  - 進捗や仕様を確認するファイルなどが分散しているため、確認漏れが増える可能性。また手間も増えてしまう


職場において他にサイボウズやMicrosoft teams なども使っているが、それらで用いている機能を集めて実装することで、各情報にアクセスするのがより容易なシステムを作ればよいと思った。

---

## 工夫した箇所
### マイタスクにあるタスクに関しては、ページ遷移を跨がずに進捗の更新が可能
![mytaskinput](https://user-images.githubusercontent.com/92261162/166848180-4f317871-9fd4-4ec6-a446-87468f73e79f.gif)  
進捗を更新するたびに各タスクの詳細ページに行って編集画面から更新するのは非常にめんどくさいため、自分が関わっているものに関しては楽に更新できるようにした。  
また、ご入力で更新してしまう恐れもあるため、デフォルトではロックされている。（鍵マークをクリックすることで入力可能になる）  

### フィルター機能について
![filter](https://user-images.githubusercontent.com/92261162/166849585-dcc318aa-2af6-4d0e-a8b0-11936eec4d0c.gif)  
フィルター機能について、選択するカラムを複数個選択させることによって、ある程度柔軟にフィルタリングを行えるようにした。
こちらに関しては毎回サーバーにリクエストを送信して、リクエストからクエリを生成し、その処理結果をクライアントに送信している。

---

## ポートフォリオ作成に当たり困難だったことまた改善すべきこと
- 命名規則や、ファイル管理について
  - どの処理内容をどのファイルに書くか、またどのようなファイル名、関数名、オブジェクト名にするかなど。これに関してはコミュニティに応じても変わると思うので、経験を積んでいくしかない気がする。。。
- セキュリティ対策について
  - とりあえずユーザー個人情報周りのセキュリティやCSRF対策などは施しているが、今現状Webシステムにおいてどのようなハッキング手法があるのかを知らないため、何のために何を実装するのかがわかっていない。セキュリティに関しては勉強していく必要が特にあると感じる。業務として開発をするのであればかなり優先度は高いように感じる。

## DBのテーブル設計について
![スクリーンショット 2022-05-05 104343](https://user-images.githubusercontent.com/92261162/166852987-5265cc22-b188-4931-a43b-29db83960718.png)  
緑色枠内：ユーザ管理やユーザー設定に関するTable  
青色枠内：タスクに関するTable  
オレンジ色枠内；チャットグループに関するTable  

とりあえず手あたり次第作っていたので、各tableの似たようなColumn（名前など）の命名規則などあいまい。またリレーションが汚く感じる。

---

## アプリの
