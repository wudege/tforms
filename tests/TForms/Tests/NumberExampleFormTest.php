<?php

/**
 * @filename NumberExampleFormTest.php
 * @touch    18/02/2017 11:12
 * @author   wudege <hi@wudege.me> https://wudege.me
 */
class NumberExampleFormTest extends \PHPUnit_Framework_TestCase
{
    /**
     *
     * @author wudege <hi@wudege.me>
     */
    public function testValidate()
    {
        $form             = new \TForms\Examples\NumberExampleForm();
        $form->attributes = array(
            'id' => 9527,
        );
        try {
            $form->validate();
        } catch (\TForms\Exception\ValidationException $e) {
            $this->assertContains('ID', $e->getMessage());
        }

        $form->attributes = array(
            'id' => 888,
        );
        $this->assertNull($form->validate());

        $form->attributes = array(
            'id' => 99,
        );
        try {
            $form->validate();
        } catch (\TForms\Exception\ValidationException $e) {
            $this->assertContains('ID', $e->getMessage());
        }
    }
}