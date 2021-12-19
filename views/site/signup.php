<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\SignupForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="form-signin">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>如果出现系统问题无法注册，请加入QQ讨论群联系管理人员</p>
    
    <p>QQ学生讨论群：576903793，其它群和备用网站网址见首页新闻</p>
    
    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'email') ?>
    <p>为防止恶意注册，邮箱后缀只支持qq.com,163.com,126.com,139.com,gmail.com,sina.com,sina.cn。</p>
    
    <p>如果输入不收支持的邮箱后缀，服务器将会报错。</p>

    <?= $form->field($model, 'studentNumber')->textInput(['placeholder' => '可不填，必须是整数']) ?>

    <?= $form->field($model, 'password')->passwordInput()->textInput(['placeholder'=>'最少6位，最多16位']) ?>

    <?= $form->field($model, 'verifyCode')->widget(\yii\captcha\Captcha::className()); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

