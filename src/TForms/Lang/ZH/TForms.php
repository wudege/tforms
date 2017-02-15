<?php
/**
 * @filename TForms.php
 * @touch    14/02/2017 17:58
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms\Lang\ZH;


use TForms\Lang\Messages;

final class TForms extends Messages
{
    public static $messages = array(
        'The beforeValidate method can only return true or throw exception.'                                               => 'beforeValidate方法只能返回 true 或 抛出异常。',
        'Property "{class}.{property}" is not defined.'                                                                    => '属性 "{class}.{property}" 未被定义。',
        '{class} has an invalid validation rule. The rule must specify attributes to be validated and the validator name.' => '{class} 填写了非法的校验规则。校验器必须填写需要校验的属性列表以及校验器名称。',
        '{attribute} is invalid.'                                                                                          => '属性 {attribute} 的值无效。',
        '{attribute} is too short (minimum is {min} characters).'                                                          => '属性 {attribute} 的值太短，最小值为 {min} 个字符。',
        '{attribute} is too long (maximum is {max} characters).'                                                           => '属性 {attribute} 的值太长，最大值为 {max} 个字符。',
        '{attribute} cannot be blank.'                                                                                     => '属性 {attribute} 的值不能为空。',
        '{attribute} must be {value}.'                                                                                     => '属性 {attribute} 的值必须为 {value}',
    );
}