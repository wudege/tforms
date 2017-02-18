<?php
/**
 * @filename NumberExampleForm.php
 * @touch    18/02/2017 11:10
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms\Examples;

use TForms\Form;

/**
 * Class NumberExampleForm
 * @package TForms\Examples
 */
class NumberExampleForm extends Form
{

    public $id;

    /**
     *
     * @author wudege <hi@wudege.me>
     * @return array
     */
    public function attributeNames()
    {
        return [
            'id',
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
        ];
    }

    public function rules()
    {
        return [
            ['id', 'required'],
            ['id', 'numerical', 'min' => 100, 'max' => 1000],
        ];
    }
}
