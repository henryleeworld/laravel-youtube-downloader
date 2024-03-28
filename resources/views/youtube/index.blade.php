<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>{{ __('YouTube Video Downloader') }}</title>
    </head>
    <body>
        <div class="container mt-3">
            <div class="card">
                <div class="card-header">{{ __('Video Downloader') }}</div>
                <div class="card-body">
                    <p class="card-text">
                        <form>
                            @csrf
                            <input type="text" value="https://www.youtube.com/watch?v=mnfewzlueXM" size="50" id="txt_url" />
                            <input type="button" id="btn_fetch" value="{{ __('Fetch') }}" />
                        </form>
                        <div class="ratio ratio-16x9 mt-3 video">
                            <video controls>
                                <source src="" type="video/mp4" />
                                <em>{{ __('Sorry, your browser doesn\'t support HTML5 video.') }}</em>
                            </video>
                        </div>
                    </p>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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