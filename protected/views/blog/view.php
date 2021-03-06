<div class="body-bg bg-none"></div>
<script>
    $(document).ready(function () {
        $(".page-up").click(function () {
            $('html, body').animate({scrollTop: 0}, 500);
        });
    });
</script>


<div id="page" class="page page_blog">
    <a href="/">Главная</a> / <a href="/blog">Блог</a> / <span><?= $model->title ?></span>
    <br><br>

    <div class='blog_content'>
        <div class='blog_content_box'>
            <h2 class='blog_title'><?= $model->title ?></h2>

            <div class='blog_block'>
                <div class='blog_tame'><?= date('d-m-Y в H:i', strtotime($model->date)) ?></div>
            </div>
            <div class='blog_img'>
                <img src='/upload/post/<?= $model->img ?>'>
            </div>
            <div class='blog_text'>
                <?= $model->text ?>
            </div>
            <br><br>

            <p>Поделиться с друзьями</p>
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
            <div class="pluso" data-background="transparent"
                 data-options="medium,square,line,horizontal,nocounter,theme=04"
                 data-services="vkontakte,facebook,google,odnoklassniki,email"></div>
            <div style='clear:both'></div>
            <div class='blog_tags'>
                <? foreach ($model->tags as $t) { ?>
                    <? if ($t) ?>
                        <a href='/blog/category/<?= $t->tname ?>'><?= $t->name ?></a>&nbsp&nbsp
                <? } ?>
            </div>
        </div>
    </div>


    <div class='blog_right_side'>
        <p class='blog_nav_header'>РУБРИКИ</p>

        <ul class='blog_nav'>
            <? $rubriks = TagInPost::model()->findAll(array('order' => 'pos, id DESC, name')) ?>
            <? foreach ($rubriks as $r) { ?>
                <? if (count($r->posts)) { ?>
                    <li>
                        <a href='/blog/category/<?= $r->tname ?>'>
                            <?= $r->name ?><span class='blog_nav_count'><?= count($r->posts) ?></span>
                        </a>
                    </li>
                    <? /*a href="/blog/category/<?=$r->tname?>" ><?=$r->name." (".count($r->posts).")";?></a>
						<br><br*/ ?>
                <? } ?>
            <? } ?>
        </ul>


        <p class='blog_nav_header'>Популярное</p>

        <? $popular = Post::model()->findAll(array('order' => 'view DESC', 'limit' => '3')) ?>
        <? foreach ($popular as $p) { ?>
            <div class='popular_foods'>
                <a href="/blog/<?= $p->id ?>">
                    <img src='/upload/post/<?= $p->img ?>' style="max-width:223px;">
                    <?= $p->title ?>
                </a>
            </div>
        <? } ?>

    </div>


</div>