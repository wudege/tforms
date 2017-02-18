<?php
/**
 * @filename UrlExampleForm.php
 * @touch    18/02/2017 12:02
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms\Examples;

use TForms\Form;

/**
 * Class UrlExampleForm
 * @package TForms\Examples
 */
class UrlExampleForm extends Form
{
    public $url;

    public function attributeNames()
    {
        return [
            'url',
        ];
    }

    public function attributeLabels()
    {
        return [
            'url' => 'Url',
        ];
    }

    public function rules()
    {
        return [
            ['url', 'required'],
            ['url', 'url'],
        ];
    }
}
