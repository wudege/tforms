<?php
/**
 * @filename RegularExpressionForm.php
 * @touch    18/02/2017 11:40
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms\Examples;

use TForms\Form;

/**
 * Class RegularExpressionForm
 * @package TForms\Examples
 */
class RegularExpressionForm extends Form
{
    const SORT_TYPE_REGEX = '/^((asc)|(desc))$/i';

    public $sort;

    public function attributeNames()
    {
        return [
            'sort',
        ];
    }

    public function attributeLabels()
    {
        return [
            'sort' => t('Examples', 'Sort'),
        ];
    }

    public function rules()
    {
        return [
            ['sort', 'required'],
            ['sort', 'match', 'pattern' => self::SORT_TYPE_REGEX],
        ];
    }
}
