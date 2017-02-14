<?php
/**
 * @filename functions.php
 * @touch    14/02/2017 17:32
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms;

use TForms\Lang\Messages;

if (!function_exists('TForms\t')) {
    function t($category, $message, $params = array(), $language = 'zh')
    {
        /** @var Messages $className */
        $className = 'TForms\Lang\\' . strtoupper($language) . '\\' . $category;
        if (get_parent_class($className) === 'TForms\Lang\Messages') {
            $messages = $className::$messages;
            if (isset($messages[$message])) {
                $message = $messages[$message];
                if ($params !== array()) {
                    
                }
            }
        }

        return $message;
    }
}