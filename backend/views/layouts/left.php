<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'MAIN NAVIGATION', 'options' => ['class' => 'header']],
                    ['label' => 'Dashboard', 'icon' => 'fa fa-home', 'url' => ['/bukutamu/index']],
                    ['label' => 'Laporan', 'icon' => 'fa fa-dashboard', 'url' => ['/bukutamu/laporan']],
                    ['label' => 'Login', 'url' => ['bukutamu/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Settings',
                        'icon' => 'fa fa-cog',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Data User', 'icon' => 'fa fa-circle-o', 'url' => ['/bukutamu/datauser'],],
                            ['label' => 'Instansi', 'icon' => 'fa fa-circle-o', 'url' => ['/bukutamu/instansi'],],
                            ['label' => 'Sub Instansi', 'icon' => 'fa fa-circle-o', 'url' => ['/bukutamu/subinstansi'],],
                            ['label' => 'Pengaturan', 'icon' => 'fa fa-circle-o', 'url' => ['/bukutamu/preference'],],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
