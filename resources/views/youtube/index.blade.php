<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
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
                            <input type="text" value="https://www.youtube.com/watch?v=2MehLt37ivA" size="50" id="txt_url" />
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
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
                            console.log(data);

                            oThis.attr("disabled", false);

                            var links = data["links"];
                            var error = data["error"];

                            if (error) {
                                alert("Error: " + error);
                                return;
                            }

                            // first link with video
                            var first = links.find(function (link) {
                                return link["format"].indexOf("video") !== -1;
                            });

                            if (typeof first === "undefined") {
                                alert("No video found!");
                                return;
                            }

                            var stream_url = "youtube/stream?url=" + encodeURIComponent(first["url"]);
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