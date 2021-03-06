# tforms
TForms is a flexible forms validation library for PHP API project.

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)
[![Latest Stable Version](https://img.shields.io/packagist/v/wudege/tforms.svg)](https://packagist.org/packages/wudege/tforms)
[![Total Downloads](https://img.shields.io/packagist/dt/wudege/tforms.svg)](https://packagist.org/packages/wudege/tforms)
[![Twitter URL](https://img.shields.io/twitter/url/http/shields.io.svg?style=social&style=flat-square)](https://twitter.com/wudege)

## INSTALL

* Use the composer command or the composer.json file. That's the recommend way. And the SDK is here [`wudege/tforms`][install-packagist]
```bash
$ composer require wudege/tforms
```

## USAGE

```php

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

```

## TEST

``` bash
$ ./vendor/bin/phpunit tests/TForms/Tests 
```

## LICENSE

The MIT License (MIT). [License File](https://github.com/wudege/tforms/blob/master/LICENSE).

[packagist]: http://packagist.org
[install-packagist]: https://packagist.org/packages/wudege/tforms
