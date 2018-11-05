<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->

        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/s.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Yii-shop</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
<!--        <form action="#" method="get" class="sidebar-form">-->
<!--            <div class="input-group">-->
<!--                <input type="text" name="q" class="form-control" placeholder="Search..."/>-->
<!--              <span class="input-group-btn">-->
<!--                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>-->
<!--                </button>-->
<!--              </span>-->
<!--            </div>-->
<!--        </form>-->
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => 'Articles', 'icon' => 'file-code-o', 'url' => ['/article']],
                    ['label' => 'Blog', 'icon' => 'fa fa-comments-o', 'url' => ['/blog']],
                    ['label' => 'Products', 'icon' => 'fa fa-window-restore', 'url' => ['/products']],
                    ['label' => 'Slider', 'icon' => 'fa fa-sliders', 'url' => ['/slider/slider']],
                    ['label' => 'Categories', 'icon' => 'dashboard', 'url' => ['/category']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],

                ],
            ]
        ) ?>

    </section>

</aside>
