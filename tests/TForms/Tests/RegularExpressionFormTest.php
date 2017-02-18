<?php

/**
 * @filename RegularExpressionFormTest.php
 * @touch    18/02/2017 11:53
 * @author   wudege <hi@wudege.me> https://wudege.me
 */
class RegularExpressionFormTest extends \PHPUnit_Framework_TestCase
{
    public function testValidate()
    {
        $form             = new \TForms\Examples\RegularExpressionForm();
        $form->attributes = array(
            'sort' => 'wtf',
        );

        try {
            $form->validate();
        } catch (\TForms\Exception\ValidationException $e) {
            $this->assertContains($form->getAttributeLabel('sort'), $e->getMessage());
        }

        $form->attributes = array(
            'sort' => 'asc',
        );

        $this->assertNull($form->validate());
    }
}