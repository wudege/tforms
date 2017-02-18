<?php
/**
 * @filename functions.php
 * @touch    15/02/2017 14:10
 * @author   wudege <hi@wudege.me> https://wudege.me
 */

if (!function_exists('t')) {
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
    function t($category, $message, $params = [], $language = 'zh')
    {
        return TForms\Lang\Messages::t($category, $message, $params, $language);
    }
}
