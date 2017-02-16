<?php
/**
 * @filename Form.php
 * @touch    13/02/2017 16:33
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms;


use TForms\Exception\RuntimeException;
use TForms\Exception\ValidationException;
use TForms\Validation\Validator;

abstract class Form extends Component implements \ArrayAccess
{
    /**
     * @var array 所有需要被执行的校验器列表
     */
    private $validators;

    /**
     *
     * @author wudege <hi@wudege.me>
     * @return array
     */
    public function attributeLabels()
    {
        return array();
    }

    /**
     *
     * @author wudege <hi@wudege.me>
     *
     * @param $attribute
     *
     * @return string
     */
    public function getAttributeLabel($attribute)
    {
        $labels = $this->attributeLabels();
        if (isset($labels[$attribute])) {
            return $labels[$attribute];
        } else {
            return $this->generateAttributeLabel($attribute);
        }
    }

    /**
     *
     * @author wudege <hi@wudege.me>
     *
     * @param $name
     *
     * @return string
     */
    public function generateAttributeLabel($name)
    {
        return ucwords(trim(strtolower(str_replace(array('-', '_', '.'), ' ', preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $name)))));
    }

    /**
     *  校验方法之前被执行的方法，只有返回true时才继续执行校验流程，否则方法内部应当处理异常及错误信息。
     *  如：异常情况在方法内部抛出 ValidationException
     * @author wudege <hi@wudege.me>
     * @return bool
     * @throws ValidationException
     */
    protected function beforeValidate()
    {
        return true;
    }

    /**
     *  校验方法之后被执行的方法
     * @author wudege <hi@wudege.me>
     */
    protected function afterValidate()
    {
    }


    /**
     *  校验方法，将遍历执行所有校验器的校验方法
     * @author wudege <hi@wudege.me>
     * @throws RuntimeException
     */
    public function validate()
    {
        if ($this->beforeValidate() === true) {
            /** @var Validator $validator */
            foreach ($this->getValidators() as $validator) {
                $validator->validate($this);
            }
            $this->afterValidate();

            return;
        }
        throw new RuntimeException(t('TForms', 'The beforeValidate method can only return true or throw exception.'));
    }

    /**
     *  所有校验规则
     * @author wudege <hi@wudege.me>
     * @return array
     */
    public function rules()
    {
        return array();
    }

    /**
     *  根据配置的校验规则生成指定的校验器列表
     * @author wudege <hi@wudege.me>
     * @return array
     * @throws RuntimeException
     */
    public function createValidators()
    {
        $validators = array();
        foreach ($this->rules() as $rule) {
            if (isset($rule[0], $rule[1])) {
                $validators[] = Validator::createValidator($rule[1], $this, $rule[0], array_slice($rule, 2));
            } else {
                throw new RuntimeException(t('TForms', '{class} has an invalid validation rule. The rule must specify attributes to be validated and the validator name.',
                    array('{class}' => get_class($this))));
            }
        }

        return $validators;
    }

    /**
     *  获取指定 属性/全部 的校验器
     * @author wudege <hi@wudege.me>
     *
     * @param null $attribute
     *
     * @return array
     */
    public function getValidators($attribute = NULL)
    {
        if ($this->validators === NULL) {
            $this->validators = $this->createValidators();
        }
        $validators = array();
        foreach ($this->validators as $validator) {
            if ($attribute === NULL || in_array($attribute, $validator->attributes, true)) {
                $validators[] = $validator;
            }
        }

        return $validators;
    }


    /**
     * Whether a offset exists
     * @link  http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset <p>
     *                      An offset to check for.
     *                      </p>
     *
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return property_exists($this, $offset);
    }

    /**
     * Offset to retrieve
     * @link  http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset <p>
     *                      The offset to retrieve.
     *                      </p>
     *
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->$offset;
    }

    /**
     * Offset to set
     * @link  http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset <p>
     *                      The offset to assign the value to.
     *                      </p>
     * @param mixed $value  <p>
     *                      The value to set.
     *                      </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->$offset = $value;
    }

    /**
     * Offset to unset
     * @link  http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset <p>
     *                      The offset to unset.
     *                      </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        unset($this->$offset);
    }
}