<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css" integrity="sha512-GQGU0fMMi238uA+a/bdWJfpUGKUkBdgfFdgBm72SUQ6BeyWjoY/ton0tEjH+OSH9iP4Dfh+7HM0I9f5eR0L/4w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Youtube 影片下載</title>
    </head>
    <body>
        <div class="container">
            <div class="card">
                <div class="card-header">影片下載</div>
                <div class="card-body">
                    <p class="card-text">
                        <form>
                            @csrf
                            <input type="text" value="https://www.youtube.com/watch?v=2QYF_Pxhtwk" size="50" id="txt_url" />
                            <input type="button" id="btn_fetch" value="抓取" />
                        </form>
                        <div class="embed-responsive embed-responsive-4by3 video">
                            <video controls>
                                <source src="" type="video/mp4" />
                                <em>抱歉，您的瀏覽器不支援 HTML5 影片。</em>
                            </video>
                        </div>
                    </p>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/js/bootstrap.min.js" integrity="sha512-OvBgP9A2JBgiRad/mM36mkzXSXaJE9BEIENnVEmeZdITvwT09xnxLtT4twkCa8m/loMbPHsvPl0T8lRGVBwjlQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(function () {
                $(".video").hide();
                $("#btn_fetch").click(function () {
                    var url = $("#txt_url").val();
                    var oThis = $(this);
                    oThis.attr("disabled", true);

                    $.ajax({
                        url: 'youtube/download',
                        type: 'post',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "url": url,
                        },
                        headers: {
                        },
                        dataType: 'json',
                        success: function (data) {
                            oThis.attr("disabled", false);

                            var links = data["links"];
                            var error = data["error"];

                            if (error) {
                                alert("Error: " + error);
                                return;
                            }

                            var stream_url = "youtube/stream?url=" + encodeURIComponent(links);
                            var video = $("video");
                            video.attr("src", stream_url);
                            video[0].load();
                            $(".video").show();
                        }
                    });
                });
            });
        </script>
    </body>
</html>