<?php

/**
 * @filename UrlExampleFormTest.php
 * @touch    18/02/2017 12:03
 * @author   wudege <hi@wudege.me> https://wudege.me
 */
class UrlExampleFormTest extends \PHPUnit_Framework_TestCase
{
    public function testValidate()
    {
        $form             = new \TForms\Examples\UrlExampleForm();
        $form->attributes = array(
            'url' => 'wtf',
        );
        try {
            $form->validate();
        } catch (\TForms\Exception\ValidationException $e) {
            $this->assertContains($form->getAttributeLabel('url'), $e->getMessage());
        }

        $form->attributes = array(
            'url' => 'https://wudege.me',
        );

        $this->assertNull($form->validate());
    }

}