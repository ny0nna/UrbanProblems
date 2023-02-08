<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

$id_user = Yii::$app->user->id;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' =>'../Images/logo.png']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <img src='../Images/logo.png' alt=''>
<?php

if (Yii::$app->user->isGuest){
    $items=[
        ['label' => 'Главная', 'url' => ['/site/about']],
        ['label' => 'Где нас найти?', 'url' => ['/site/contact']],
        ['label' => 'Регистрация', 'url' => ['/user/create']],
        ['label' => 'Авторизация', 'url' => ['/site/login']]
    ];}
else {
    Yii::$app->user->identity->is_admin==1 ?
        ( $items=[
            ['label' => 'Главная', 'url' => ['/site/about']],
            ['label' => 'Панель администратора', 'url' => ['/admin/index']],
            ['label' => 'Личный кабинет', 'url' => ['/user/view?id_user='.$id_user]],
            ['label' => 'Где нас найти?', 'url' => ['/site/contact']],
        ])
        :
        ($items=[
            ['label' => 'Главная', 'url' => ['/site/about']],
            ['label' => 'Личный кабинет', 'url' => ['/user/view?id_user='.$id_user]],
            ['label' => 'Заявки', 'url' => ['/claim/index?ClaimSearch[id_claim]=&ClaimSearch[id_user]='.$id_user]],
            ['label' => 'Где нас найти?', 'url' => ['/site/contact']]
        ]);

    array_push($items, '<li class="nav-item">'
 . Html::beginForm(['/site/logout'])
 . Html::submitButton(
     'Выйти (' . Yii::$app->user->identity->login . ')',
     ['class' => 'nav-link btn btn-link logout']
 )
 . Html::endForm()
 . '</li>');
}
NavBar::begin([
    'brandImage'=> '../Images/logo.png',
    'brandUrl' => Yii::$app->homeUrl,
    'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark
fixed-top']
]);
echo
Nav::widget([
    'options' => ['class' => 'navbar-nav'],
    'items' => $items
]);
NavBar::end(['brandLabel' => Yii::$app->name,]);
?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-dark">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start"> Сайт городского планирования</div>
            <div class="col-md-6 text-center text-md-end">&copy; My City <?= date('Y') ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
