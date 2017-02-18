<?php

/**
 * @filename EmailExampleFormTest.php
 * @touch    18/02/2017 11:00
 * @author   wudege <hi@wudege.me> https://wudege.me
 */
class EmailExampleFormTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @author wudege <hi@wudege.me>
     */
    public function testValidate()
    {
        $form             = new \TForms\Examples\EmailExampleForm();
        $form->attributes = array(
            'email' => 'wrong-email-address'
        );

        try {
            $form->validate();
        } catch (\TForms\Exception\ValidationException $e) {

            $this->assertContains($form->getAttributeLabel('email'), $e->getMessage());
        }

        $form->attributes = array(
            'email' => 'hi@wudege.me',
        );
        $this->assertNull($form->validate());

        $form->attributes = array(
            'email' => 'abcdefghhijklmnopkrstuvwxyzabcdefghijk@wudege.me',
        );
        try {
            $form->validate();
        } catch (\TForms\Exception\ValidationException $e) {
            $this->assertContains($form->getAttributeLabel('email'), $e->getMessage());
        }
    }
}