<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class Login extends Model
{
    public $login;
    public $password;

    public function rules()
    {
        return [
            [['login','password'],'required'],
            ['password','validatePassword']
        ];
    }

    public function validatePassword($attribute,$params)
    {
        if (!$this->hasErrors())
        {
            $user = $this->getUser();

            if (!$user || ($user->password != sha1($this->password)))
            {
                $this->addError($attribute,'Пароль или пользователь введены неверно');
            }

        }
    }

    public function getUser()
    {
        return User::findOne(['login'=>$this->login]);
    }
}
