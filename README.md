# Laravel 8 YouTube 影片下載器

引入 athlon1600 的 youtube-downloader 套件來擴增 YouTube 影片下載器，有人可能看到很喜歡的 YouTube 影片，會擔心它有一天被刪掉再也看不到，所以會想把它載下來嗎？要是手機沒有吃到飽，或是你要搭飛機怕旅途無聊，把幾部 YouTube 影片載到手機平板來看，也是很不錯。

## 使用方式
- 把整個專案複製一份到你的電腦裡，這裡指的「內容」不是只有檔案，而是指所有整個專案的歷史紀錄、分支、標籤等內容都會複製一份下來。
```sh
$ git clone
```
- 將 __.env.example__ 檔案重新命名成 __.env__，如果應用程式金鑰沒有被設定的話，你的使用者 sessions 和其他加密的資料都是不安全的！
- 當你的專案中已經有 composer.lock，可以直接執行指令以讓 Composer 安裝 composer.lock 中指定的套件及版本。
```sh
$ composer install
```
- 產生 Laravel 要使用的一組 32 字元長度的隨機字串 APP_KEY 並存在 .env 內。
```sh
$ php artisan key:generate
```
- 在瀏覽器中輸入已定義的路由 URL 來訪問，例如：http://127.0.0.1:8000。
- 你可以經由 `/youtube` 來進行 YouTube 影片抓取。

----

## 畫面截圖
![](https://i.imgur.com/OjVxCYo.gif)
> 儘管著作權法是告訴乃論、不告不理，此外也較難構成民事求償要件，但透過下載器下載 YouTube 影片最好僅限於個人使用，否則難保吃上官司。另一方面，儘管可以依照著作權法第 51 條主張合理使用，但 Google 提醒「在使用並非您所擁有的版權素材時，沒有任何妙方可以讓自己絕對受到合理使用原則保護。」