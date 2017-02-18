<?php
/**
 * @filename StringExampleForm.php
 * @touch    18/02/2017 11:57
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms\Examples;

use TForms\Form;

/**
 * Class StringExampleForm
 * @package TForms\Examples
 */
class StringExampleForm extends Form
{
    public $username;

    public function attributeNames()
    {
        return [
            'username',
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => t('Examples', 'Username'),
        ];
    }

    public function rules()
    {
        return [
            ['username', 'required'],
            ['username', 'length', 'min' => 4, 'max' => 32],
        ];
    }
}
