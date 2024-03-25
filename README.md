
## アプリのURL


<a href="https://to-do-rist-c67dabfc11d8.herokuapp.com/login"><b>To Do リスト</b></a><br>

<b>テストアカウント:</b>
- Mail: smile01183170@gmail.com
- Password: smile19931005


<br>

## 制作背景

このタスク管理アプリを開発する背景には、私自身が日常生活で様々な場面でメモを取る習慣がありました。<br>
そのため、買い物リストや授業、病院の予定などを整理するために、シンプルで分かりやすい方法が欲しいと考えていました。<br>
普段は、スマホのメモアプリやカレンダーアプリを使っていましたが、それぞれが独立しており、使い勝手が一貫していませんでした。<br>
そこで、メモを書く機能や期限を設定する機能などが一つのアプリにまとまっているタスク管理アプリを開発することを考えました。

<br>

## 開発環境

<b>使用言語：</b>
- PHP8.2
- Laravel9
- HTML
- CSS
- Tailwind

<b>開発環境：</b>
- Cloud9
- MariaDB
- GitHub
- Git

<b>デプロイ：</b>
- Heroku

<br>

## データ構成
<br>

<b>ER図</b>
<br>
<img width="700" alt="スクリーンショット 2024-03-25 19 37 35" src="https://github.com/FujiwaraSumire/seikabutsu/assets/154066077/8bbff497-95c1-4aab-9a89-1a3ce4b21fb8">

<br>
<br>

<b>各テーブル詳細</b>
<br>
|  posts table  |　categories table  |
| ---- | ---- |
| <img width="400" alt="スクリーンショット 2024-03-25 22 26 08" src="https://github.com/FujiwaraSumire/seikabutsu/assets/154066077/d2715411-2291-483e-8b83-fccd08042632"> | <img width="400" alt="スクリーンショット 2024-03-25 22 26 47 (1)" src="https://github.com/FujiwaraSumire/seikabutsu/assets/154066077/0a3854b4-50b8-479e-a518-9b58a8e526e5"> |

|  priorities table  |　users table  |
| ---- | ---- |
| <img width="400" alt="スクリーンショット 2024-03-25 22 27 22" src="https://github.com/FujiwaraSumire/seikabutsu/assets/154066077/acd987e8-c6de-4472-87a5-a9e4b111570d"> | <img width="400" alt="スクリーンショット 2024-03-25 22 29 06" src="https://github.com/FujiwaraSumire/seikabutsu/assets/154066077/0efcc13b-02bd-4218-9360-5b2d4ce7c83c"> |

<br>

## 機能一覧

- ログイン機能
- タスク作成機能(Title, To Do details, Category, Priority, Deadline)
- タスク編集機能
- タスクチェック機能
- タスク一覧表示
- タスク削除機能

<br>

## こだわった部分

・必要最低限の情報のみを一覧表示するシンプルなデザインにしている。<br>
・優先度が高いものや、期限が早いものを表の上の方に表示するようにしている。<br>
・カテゴリー名が同じものでまとめて並べるようにしている。<br>
・タスク一覧表でIncompleteのものを上の方に、Completedのものをその下の方に表示するようにしている。

<br>

<img width="700" alt="スクリーンショット 2024-03-25 23 35 13" src="https://github.com/FujiwaraSumire/seikabutsu/assets/154066077/0dabcae7-7223-4d51-8f65-a560af03dbf2">


<br>

## 使い方

<a href="https://github.com/FujiwaraSumire/seikabutsu/assets/154066077/d988033d-6555-4a5a-be25-8e2a32aaf35a"><b>使い方動画</b></a><br>

<b>・タスクの作成</b><br>
表の上にあるCreatボタンからTitle、 To Do details、 Category、 Priority、 Deadlineを記入または選択し作成。

<b>・タスクの編集、削除</b><br>
タスク一覧表のEdit、Deleteボタンからタスクの編集と削除が可能。

<b>・タスクのチェック</b><br>
タスクが完了したら、タスク一覧表のIncompleteボタンをCompletedに変更が可能。

<br>

## 今後の計画

- 通知機能の追加(Deadlineのお知らせ)
- ログイン画面の改良
- ユーザー新規登録画面の追加

<br>

## 制作者連絡先

Mail: smile01183170@gmail.com

