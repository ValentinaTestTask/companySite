<?php
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$script3 = <<< JS

$('#add-button').on('click', function(){
    jQuery('.add-form').removeClass('hidden');
});

$('#clickButton2').on('click', function(){
    jQuery('.add-form').addClass('hidden');
});

JS;
$this->registerJs($script3);
?>
<h1>Компании</h1>
<?php 
if ($role == 'admin')
{ ?>
<? Pjax::begin(); ?>
<div class=" row add-form hidden" style="padding-bottom:15px;">
    <div class=" col-xs-12 post-block">
    <?php
    $f = ActiveForm::begin();
    echo $f->field($form, 'name');
    echo $f->field($form, 'inn');
    echo $f->field($form, 'directory');
    echo $f->field($form, 'address');
    ?>
    <div>
        <button class="btn btn-primary" type="submit">Добавить компанию</button>
        <button class="btn btn-danger" id="clickButton2">Отменить</button>
    </div>
    <?php
    ActiveForm::end();
    ?>
    </div>
</div>
<? Pjax::end(); ?>
<?php
}
?>
<?php
if ($role == 'admin')
{ ?>
<div class="row">
    <div class="col-xs-2">
        <button class="btn btn-primary" id="add-button"><span class="glyphicon glyphicon-plus"></span></button>
    </div>
</div>
<?php
} ?>
<ul>
<?php foreach ($companys as $company) { ?>
    <li>
        <input type="hidden" name="id" value="<?=$company->id?>">
        <a href="<?=Yii::$app->urlManager->createUrl(['site/company','id'=>$company->id])?>"><b><?=$company->name?>: <?=$company->directory?></b></a>
        <p>ИНН: <?=$company->inn?></p>
        <p>Адрес: <?=$company->address?></p>
    </li>
<?php } ?>
</ul>
