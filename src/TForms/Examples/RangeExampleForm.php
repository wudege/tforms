<?php
/**
 * @filename RangeExampleForm.php
 * @touch    18/02/2017 11:19
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms\Examples;

use TForms\Form;

/**
 * Class RangeExampleForm
 * @package TForms\Examples
 */
class RangeExampleForm extends Form
{
    const GENDER_MALE    = 1;
    const GENDER_FEMALE  = 2;
    const GENDER_OTHER   = 3;
    const GENDER_UNKNOWN = 4;

    public $gender;

    public function attributeNames()
    {
        return [
            'gender',
        ];
    }


    public function attributeLabels()
    {
        return [
            'gender' => t('Examples', 'Gender'),
        ];
    }

    public function rules()
    {
        return [
            ['gender', 'required'],
            ['gender', 'in', 'range' => self::getGenderValues()],
        ];
    }

    public static function getGenderValues()
    {
        return [
            self::GENDER_MALE,
            self::GENDER_FEMALE,
            self::GENDER_OTHER,
            self::GENDER_UNKNOWN,
        ];
    }
}
