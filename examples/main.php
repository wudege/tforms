<?php

require __DIR__ . '/../vendor/autoload.php';

class UserEditForm extends \TForms\Form
{
    const GENDER_MALE   = 1;
    const GENDER_FEMALE = 0;

    public $username;
    public $email;
    public $age;
    public $gender;
    public $blog;

    /**
     *
     * @author wudege <hi@wudege.me>
     * @return array
     */
    public function attributeNames()
    {
        return [
            'username',
            'email',
            'age',
            'gender',
            'blog',
        ];
    }

    public function attributeLabels()
    {
        return [
            'username',
            'email',
            'age',
            'gender',
            'blog',
        ];
    }

    public function rules()
    {
        return [
            ['username, email, age, gender, blog', 'required'],
            ['username', 'length', 'min' => 4, 'max' => 32],
            ['email', 'email'],
            ['age', 'numerical', 'min' => 18, 'max' => 28, 'integerOnly' => true],
            ['gender', 'in', 'range' => [self::GENDER_MALE, self::GENDER_FEMALE]],
            ['blog', 'url'],
        ];
    }
}

$form             = new UserEditForm();
$form->attributes = [
    'username' => 'wudege',
    'email'    => 'hi@wudege.me',
    'age'      => 20,
    'gender'   => 1,
    'blog'     => 'https://wudege.me',
];

try {
    $form->validate();
} catch (\TForms\Exception\ValidationException $e) {
    die($e->getMessage());
}
die('done');