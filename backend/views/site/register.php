<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form ActiveForm */
?>
<div class="register">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'status') ?>
        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'password_hash')->passwordInput()->label('Password') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- register -->
