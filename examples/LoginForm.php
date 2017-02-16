<?php

require __DIR__ . '/../vendor/autoload.php';

use TForms\Form;
use TForms\Exception\RuntimeException;
use TForms\Exception\ValidationException;

class LoginForm extends Form
{

    public $username;
    public $password;
    public $email;

    public function rules()
    {
        return array(
            array('username, password, email', 'required'),
            array('username', 'length', 'min' => 4, 'max' => 32),
            array('password', 'length', 'min' => 6, 'max' => 18, 'tooShort' => '哥，密码太短了'),
//            array('username', 'userVerify'),
            array('email', 'email'),
        );
    }

    public function beforeValidate()
    {
        return true;
    }

    public function userVerify($attribute, $params)
    {
        if ($this->username === 'wudege') {
            return;
        }
        throw new ValidationException('非法访问');
    }

}

$v = new TForms\Validation\RequiredValidator;

$form           = new LoginForm();
$form->username = 'wudege';
$form->password = 'password';
$form->email    = 'hi';
try {
    $form->validate();
} catch (ValidationException $e) {
    die('Validation Exception: ' . $e->getMessage());
} catch (RuntimeException $e) {
    die('Runtime Exception: ' . $e->getMessage());
}