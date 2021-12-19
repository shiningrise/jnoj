<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="shortcut icon" href="<?= Yii::getAlias('@web') ?>/favicon.ico">
    
    <script type="text/javascript">(function(d,t) {var BASE_URL="https://app.chatwoot.com";var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.src=BASE_URL+"/packs/js/sdk.js";g.defer = true;g.async = true;s.parentNode.insertBefore(g,s);g.onload=function(){window.chatwootSDK.run({websiteToken: 'ZeevsM6MRJcF57KCYfrnSYjf',baseUrl: BASE_URL})}})(document,"script");</script>
    
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <header id="header" class="hidden-xs">
        <div class="container">
            <div class="page-header">
                <div class="logo pull-left">
                    <div class="pull-left">
                        <a class="navbar-brand" href="<?= Yii::$app->request->baseUrl ?>">
                            <img src="<?= Yii::getAlias('@web') ?>/images/logo.png" />
                        </a>
                    </div>
                    <div class="brand">
                        只要努力飞翔，即使再弱小的蝴蝶也可以飞的很高
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->setting->get('ojName'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default',
        ],
    ]);
    $menuItems = [
        ['label' => '<span class="glyphicon glyphicon-home"></span> ' . Yii::t('app', 'Home'), 'url' => ['/site/index']],
        [
            'label' => '题库分类',
            'items' => [
                ['label' => '普及组真题', 'url' => '/problem/index?tag=普及组真题'],
                    '<li class="divider"></li>',
                    //'<li class="dropdown-header">Dropdown Header</li>',
                ['label' => '提高组真题', 'url' => '/problem/index?tag=提高组真题'],
                '<li class="divider"></li>',
                ['label' => 'USACO经典训练题', 'url' => '/problem/index?tag=USACO'],
                '<li class="divider"></li>',
                ['label' => 'APIO历年真题', 'url' => '/problem/index?tag=APIO历年真题'],'<li class="divider"></li>',
                ['label' => 'NOI历年真题', 'url' => '/problem/index?tag=NOI历年真题'],'<li class="divider"></li>',
                ['label' => '省选题库', 'url' => '/problem/index?tag=省选'],
            ],
        ],
        [
            'label' => '课程分类',
            'items' => [
                ['label' => '语言和算法入门', 'url' => '/problem/index?tag=语言和算法入门'],
                    '<li class="divider"></li>',
                    //'<li class="dropdown-header">Dropdown Header</li>',
                ['label' => '竞赛基础算法', 'url' => '/problem/index?tag=竞赛基础算法'],
                '<li class="divider"></li>',
                ['label' => '动态规划', 'url' => '/problem/index?tag=动态规划'],
                '<li class="divider"></li>',
                ['label' => '数据结构基础', 'url' => '/problem/index?tag=数据结构基础'],'<li class="divider"></li>',
                ['label' => '编程与数学', 'url' => '/problem/index?tag=编程与数学'],
            ],
        ],
        ['label' => '<span class="glyphicon glyphicon-list"></span> ' . Yii::t('app', 'Problems'), 'url' => ['/problem/index']],
        ['label' => '<span class="glyphicon glyphicon-signal"></span> ' . Yii::t('app', 'Status'), 'url' => ['/solution/index']],
        /*[
            'label' => '<span class="glyphicon glyphicon-king"></span> ' . Yii::t('app', 'Rating'),
            'url' => ['/rating/problem'],
            'active' => Yii::$app->controller->id == 'rating'
        ],*/
        [
            'label' => '<span class="glyphicon glyphicon-user"></span> ' . Yii::t('app', 'Group'),
            'url' => Yii::$app->user->isGuest ? ['/group/index'] : ['/group/my-group']
        ],
        ['label' => '<span class="glyphicon glyphicon-knight"></span> ' . Yii::t('app', 'Contests'), 'url' => ['/contest/index']],
        [
            'label' => '<span class="glyphicon glyphicon-info-sign"></span> '. Yii::t('app', 'Wiki'),
            'url' => ['/wiki/index'],
            'active' => Yii::$app->controller->id == 'wiki'
        ],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '<span class="glyphicon glyphicon-new-window"></span> ' . Yii::t('app', 'Signup'), 'url' => ['/site/signup']];
        $menuItems[] = ['label' => '<span class="glyphicon glyphicon-log-in"></span> ' . Yii::t('app', 'Login'), 'url' => ['/site/login']];
    } else {
        if (Yii::$app->user->identity->isAdmin()) {
            $menuItems[] = [
                'label' => '<span class="glyphicon glyphicon-cog"></span> ' . Yii::t('app', 'Backend'),
                'url' => ['/admin'],
                'active' => Yii::$app->controller->module->id == 'admin'
            ];
        }
        $menuItems[] =  [
            'label' => '<span class="glyphicon glyphicon-user"></span> ' . Yii::$app->user->identity->nickname,
            'items' => [
                ['label' => '<span class="glyphicon glyphicon-home"></span> ' . Yii::t('app', 'Profile'), 'url' => ['/user/view', 'id' => Yii::$app->user->id]],
                ['label' => '<span class="glyphicon glyphicon-cog"></span> ' . Yii::t('app', 'Setting'), 'url' => ['/user/setting', 'action' => 'profile']],
                '<li class="divider"></li>',
                ['label' => '<span class="glyphicon glyphicon-log-out"></span> ' . Yii::t('app', 'Logout'), 'url' => ['/site/logout']],
            ]
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
        'encodeLabels' => false,
        'activateParents' => true
    ]);
    NavBar::end();
    ?>

    <?php
    if (!Yii::$app->user->isGuest && Yii::$app->setting->get('mustVerifyEmail') && !Yii::$app->user->identity->isVerifyEmail() && !strstr(Yii::$app->user->identity->email,"@jnoj.org")) {
        $a = Html::a('个人设置', ['/user/setting', 'action' => 'account']);
        echo "<div class=\"container\"><p class=\"bg-danger\">请前往设置页面验证您的邮箱：{$a}</p></div>";
    }
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->setting->get('ojName') ?> OJ <?= date('Y') ?></p>
        <p class="pull-left">
            <?= Html::a (' 中文简体 ', '?lang=zh-CN') . '| ' .
            Html::a (' English ', '?lang=en') ;
            ?>
        </p>
        <div align="right">
            <a href="http://beian.miit.gov.cn/">   粤ICP备2020079991号</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <script type="text/javascript">document.write(unescape("%3Cspan id='cnzz_stat_icon_1279244449'%3E%3C/span%3E%3Cscript src='https://s9.cnzz.com/z_stat.php%3Fid%3D1279244449%26online%3D1%26show%3Dline' type='text/javascript'%3E%3C/script%3E"));</script>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
