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
        '{attribute} is invalid.'                                                                                          => '{attribute} 的值无效。',
        '{attribute} is too short (minimum is {min} characters).'                                                          => '{attribute} 的值太短，最小值为 {min} 个字符。',
        '{attribute} is too long (maximum is {max} characters).'                                                           => '{attribute} 的值太长，最大值为 {max} 个字符。',
        '{attribute} cannot be blank.'                                                                                     => '{attribute} 的值不能为空。',
        '{attribute} must be {value}.'                                                                                     => '{attribute} 的值必须为 {value}　。',
        'The {attribute} property must be array type.'                                                                     => '{attribute} 必须为数组类型。',
        '{attribute} is not in the list.'                                                                                  => '{attribute} 不在列表中。',
        '{attribute} is in the list.'                                                                                      => '{attribute} 在列表中。',
        '{attribute} is not a valid email address.'                                                                        => '{attribute} 不是有效的邮箱地址。',
        '{attribute} is not a valid URL.'                                                                                  => '{attribute} 不是有效的URL。',
        '{attribute} must be an integer.'                                                                                  => '{attribute} 必须为整数。',
        '{attribute} must be a number.'                                                                                    => '{attribute} 必须为数字。',
        '{attribute} is too small (minimum is {min}).'                                                                     => '{attribute} 数值太小，最小值不能低于 {min}',
        '{attribute} is too big (maximum is {max}).'                                                                       => '{attribute} 数值太大，最大值不能高于 {max}',
        'The "pattern" property must be specified with a valid regular expression.'                                        => '"pattern" 必须设置为有效的正则表达式。',
    );
}