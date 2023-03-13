<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Youtube 影片下載</title>
    </head>
    <body>
        <div class="container mt-3">
            <div class="card">
                <div class="card-header">影片下載</div>
                <div class="card-body">
                    <p class="card-text">
                        <form>
                            @csrf
                            <input type="text" value="https://www.youtube.com/watch?v=PvKiPCgsH3c" size="50" id="txt_url" />
                            <input type="button" id="btn_fetch" value="抓取" />
                        </form>
                        <div class="ratio ratio-16x9 mt-3 video">
                            <video controls>
                                <source src="" type="video/mp4" />
                                <em>抱歉，您的瀏覽器不支援 HTML5 影片。</em>
                            </video>
                        </div>
                    </p>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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