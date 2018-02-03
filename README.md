# これは何
社内CTFに投稿する問題をちまちま作成するための環境です。
社内向けなので、特別なツールを使わず、かつCTF未経験者でも解けるレベルに抑えています。

# 必要なもの
* docker
* docker-compose

# 使い方
```bash
$ docker-compose up --build -d
$ docker-compose ps
# コンテナが起動していたらOK。Webブラウザでhttp://127.0.0.1/にアクセスする。
```
