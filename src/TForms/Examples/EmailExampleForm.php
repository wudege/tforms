<?php
/**
 * @filename EmailExampleForm.php
 * @touch    18/02/2017 10:44
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms\Examples;

use TForms\Form;

/**
 * Class EmailExampleForm
 * @package TForms\Examples
 */
class EmailExampleForm extends Form
{
    public $email;

    public function attributeNames()
    {
        return [
            'email',
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => t('Examples', 'Email'),
        ];
    }

    public function rules()
    {
        return [
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'length', 'max' => 32],
        ];
    }
}
