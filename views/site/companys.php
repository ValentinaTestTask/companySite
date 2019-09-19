<h1>Компании</h1>
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
<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php 
if ($role == 'admin')
{
    $f = ActiveForm::begin();
    echo $f->field($form, 'name');
    echo $f->field($form, 'inn');
    echo $f->field($form, 'directory');
    echo $f->field($form, 'address');
    ?>
    <div>
        <button class="btn btn-primary" type="submit">Добавить компанию</button>
    </div>
    <?php
    ActiveForm::end();
}
?>