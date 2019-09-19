<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * CompanyForm is the model behind the contact form.
 */
class CompanyForm extends Model
{
    public $name;
    public $inn;
    public $directory;
    public $address;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'inn', 'directory', 'address'], 'required', 'message' => 'Не заполнено поле']
        ];
    }/*

    
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setReplyTo([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
    }*/
}
