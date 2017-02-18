<?php

/**
 * @filename StringExampleFormTest.php
 * @touch    18/02/2017 11:59
 * @author   wudege <hi@wudege.me> https://wudege.me
 */
class StringExampleFormTest extends \PHPUnit_Framework_TestCase
{
    public function testValidate()
    {
        $form             = new \TForms\Examples\StringExampleForm();
        $form->attributes = array(
            'username' => 'hey',
        );
        try {
            $form->validate();
        } catch (\TForms\Exception\ValidationException $e) {
            $this->assertContains($form->getAttributeLabel('username'), $e->getMessage());
        }

        $form->attributes = array(
            'username' => 'hello world',
        );
        $this->assertNull($form->validate());

        
    }
}