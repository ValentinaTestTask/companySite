<?php
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$script3 = <<< JS

$('#edit-button').on('click', function(){
	//jQuery('#edit-button').hide();
	jQuery('.edit-form').removeClass('hidden');
	//jQuery('.edit-form').prepend(jquery('.post-block'));
});

$('#clickButton2').on('click', function(){
	jQuery('.edit-form').addClass('hidden');
});

JS;
$this->registerJs($script3);
?>
<? Pjax::begin(); ?>
<div class="edit-form hidden">
	<div class="post-block">
		<?php
		if ($role == 'admin')
		{
		    $f = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'id' => 'editpost']);
		    echo $f->field($form, 'name') -> textInput(['value'=>$company->name]);
		    echo $f->field($form, 'inn') -> textInput(['value'=>$company->inn]);
		    echo $f->field($form, 'directory') -> textInput(['value'=>$company->directory]);
		    echo $f->field($form, 'address') -> textInput(['value'=>$company->address]);
		    ?>
		    <div>
		        <button class="btn btn-success" id="clickButton1" type="submit">Сохранить</button>
		        <button class="btn btn-danger" id="clickButton2">Отменить</button>
		    </div>
		    <?php
		    ActiveForm::end();
		}
		?>
	</div>
</div>
<? Pjax::end(); ?>
<h1>Компания <?=$company->name?></h1>
<?php
if ($role == 'admin')
{ ?>
<div class="row">
	<div class="col-xs-2">
		<button class="btn btn-primary" id="edit-button"><span class="glyphicon glyphicon-pencil"></span></button>
	</div>
	<div class="col-xs-2">
		<a href="<?=Yii::$app->urlManager->createUrl(['site/delcompany','id'=>$company->id])?>" class="btn btn-primary" id="del-button"><span class="glyphicon glyphicon-remove"></span></a>
	</div>
</div>
<?php
} ?>
<div><input type="hidden" name="id" value="<?=$company->id?>">
        <b>Директор: <?=$company->directory?></b>
        <p>ИНН: <?=$company->inn?></p>
        <p>Адрес: <?=$company->address?></p>
</div>