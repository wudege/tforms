<?php
/**
 * @filename Messages.php
 * @touch    14/02/2017 18:01
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms\Lang;


abstract class Messages
{
    public static $messages = array();

    /**
     *
     * @author wudege <hi@wudege.me>
     *
     * @param        $category
     * @param        $message
     * @param array  $params
     * @param string $language
     *
     * @return mixed
     */
    public static function t($category, $message, $params = array(), $language = 'zh')
    {
        /** @var Messages $className */
        $className = 'TForms\Lang\\' . strtoupper($language) . '\\' . $category;
        if (get_parent_class($className) === 'TForms\Lang\Messages') {
            $messages = $className::$messages;
            if (isset($messages[$message])) {
                $message = $messages[$message];
                if ($params !== array()) {
                    $message = str_replace(array_keys($params), array_values($params), $message);
                }
            }
        }

        return $message;
    }
}