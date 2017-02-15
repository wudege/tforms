<?php
/**
 * @filename functions.php
 * @touch    15/02/2017 14:10
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

namespace TForms;

if (!function_exists('TForms\t')) {
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
    function t($category, $message, $params = array(), $language = 'zh')
    {
        return Lang\Messages::t($category, $message, $params, $language);
    }
}