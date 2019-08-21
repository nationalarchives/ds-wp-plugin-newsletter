<?php

class tnaNewsletterTest extends PHPUnit_Framework_TestCase
{
    public function testApiConnection()
    {
        $this->assertTrue(class_exists('ApiConnection'));
    }

    public function testNewsletterFormBuilder()
    {
        $this->assertTrue(class_exists('Newsletter_Form_Builder'));
    }
}