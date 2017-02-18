<?php

/**
 * @filename RangeExampleFormTest.php
 * @touch    18/02/2017 11:25
 * @author   wudege <hi@wudege.me> https://wudege.me
 */
class RangeExampleFormTest extends \PHPUnit_Framework_TestCase
{
    public function testValidate()
    {
        $form             = new \TForms\Examples\RangeExampleForm();
        $form->attributes = array(
            'gender' => 5,
        );
        try {
            $form->validate();
        } catch (\TForms\Exception\ValidationException $e) {
            $this->assertContains($form->getAttributeLabel('gender'), $e->getMessage());
        }
        $form->attributes = array(
            'gender' => 1,
        );
        $this->assertNull($form->validate());

    }
}