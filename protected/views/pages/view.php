<div class="body-bg bg-none"></div>
<div class="page" id="page">
    <div class="track"><a href="/">главная</a> / <?php echo $model->name; ?></div>
    <div class="blok">
        <h1><?php echo $model->name; ?></h1>
        <br>
        <?php echo $model->text; ?>

        <br>

        <h2>Поделиться с друзьями</h2>
        <script type="text/javascript">
            (function () {
                if (window.pluso)if (typeof window.pluso.start == "function") return;
                if (window.ifpluso == undefined) {
                    window.ifpluso = 1;
                    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                    s.type = 'text/javascript';
                    s.charset = 'UTF-8';
                    s.async = true;
                    s.src = ('https:' == window.location.protocol ? 'https' : 'http') + '://share.pluso.ru/pluso-like.js';
                    var h = d[g]('body')[0];
                    h.appendChild(s);
                }
            })();
        </script>
        <div class="pluso" data-background="transparent" data-options="medium,square,line,horizontal,nocounter,theme=04"
             data-services="vkontakte,facebook,google,odnoklassniki,email"></div>
    </div>
</div>