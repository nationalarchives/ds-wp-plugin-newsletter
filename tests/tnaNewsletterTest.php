<?php

class tnaNewsletterTest extends PHPUnit_Framework_TestCase
{
    public function testExistanceOfApiConnection()
    {
        $this->assertTrue(class_exists('ApiConnection'));
    }

    public function testExistanceOfNewsletterFormBuilder()
    {
        $this->assertTrue(class_exists('Newsletter_Form_Builder'));
    }

    public function testNewsletterFormBuilder()
    {
        function esc_attr( $text ) {
            return filter_var($text, FILTER_SANITIZE_STRING);
        }

        $_POST['Submit'];
        
        $content = array(
            'Sign up to our mailing list',
            'Subscribe now for regular news, updates and priority booking for events',
            'I have read and understand the'
        );

        $error = 'Some errors won\'t harm anyone';
        
        $form = new Newsletter_Form_Builder('signup','signup','','post',$error, $content);
        $incompleteInstanceForm = new Newsletter_Form_Builder('','','','','',array());
        
        $incompleteTopBodyForm = '<form name="" id="" action="" method="" role="form"><input type="hidden" name="signup" value="NDQ1"><input type="hidden" name="confirmation_subject" value=""><input type="hidden" name="confirmation" value=""><input type="hidden" name="list" value="3"><input type="hidden" name="source" value="web"><input type="hidden" name="opt_in" value="1">';

        // Main Newsletter Form Builder Class
        $this->assertInstanceOf(Newsletter_Form_Builder::class, $form);
        
        // @method->get_form_body()
        $this->assertTrue(method_exists($form, 'get_form_body'));
        $this->assertNotEquals($incompleteTopBodyForm,$form->get_form_body());
        
        // @method->is_close_form()
        $this->assertTrue(method_exists($form, 'is_close_form'));
        $this->assertEquals('</form>',$form->is_close_form());
        $this->assertNotEquals('<form>',$form->is_close_form());
        $this->assertNotEquals(null,$form->is_close_form());
        $this->assertEquals(gettype(''),gettype($form->is_close_form()));

        // @method->get_paragraph()
        $this->assertTrue(method_exists($form, 'get_paragraph'));
        $this->assertEquals('<div class="form-row"><p>Subscribe now for regular news, updates and priority booking for events</p></div>',$form->get_paragraph());
        $this->assertEquals(gettype(''),gettype($form->get_paragraph()));

        // @method->get_legend()
        $this->assertTrue(method_exists($form, 'get_legend'));
        $this->assertEquals('<legend>Sign up to our mailing list</legend>',$form->get_legend());
        $this->assertNotEquals('',$form->get_legend());
        $this->assertNotEquals(null,$form->get_legend());

        // @method->get_email_input()
        $this->assertTrue(method_exists($form, 'get_email_input'));
        $this->assertEquals('<div class="form-row"><label for="email">Email address</label><input type="email" name="email" id="email" placeholder="Enter your email address" aria-labelledby="newsletterAccessibility" required></div>', $form->get_email_input());
        $this->assertNotEquals(null,$form->get_email_input());

        // $method->get_first_name_input()
        $this->assertTrue(method_exists($form, 'get_first_name_input'));
        $this->assertEquals('<div class="form-row"><label for="firstname">First name <span class="optional">(optional)</span></label><input type="text" name="firstname" id="firstname" placeholder="Enter your first name" aria-labelledby="newsletterAccessibility"></div>', $form->get_first_name_input());
        $this->assertNotEquals(null,$form->get_first_name_input());

        // @method->get_last_name_input()
        $this->assertTrue(method_exists($form, 'get_last_name_input'));
        $this->assertEquals('<div class="form-row"><label for="lastname">Last name <span class="optional">(optional)</span></label><input type="text" name="lastname" id="lastname" placeholder="Enter your last name" aria-labelledby="newsletterAccessibility"></div>', $form->get_last_name_input());
        $this->assertNotEquals(null,$form->get_last_name_input());

        // @method->get_terms_checkbox()
        $this->assertTrue(method_exists($form, 'get_terms_checkbox'));
        $this->assertEquals('<div class="form-row checkbox"><input id="privacy_policy" type="checkbox" name="privacy_policy"><label for="privacy_policy">I have read and understand the <a href="https://nationalarchives.gov.uk/legal/privacy-policy/">Privacy Policy</a>.</label></div>', $form->get_terms_checkbox());
        $this->assertNotEquals(null,$form->get_terms_checkbox());

        // @method->is_sign_up()
        $this->assertTrue(method_exists($form, 'is_sign_up'));
        $this->assertEquals('<div class="form-row"><input id="newsletterSignUp" type="submit" name="Submit" value="Submit" class="margin-left-medium disabled"></div>', $form->is_sign_up());

        // @method->is_open_fieldset()
        $this->assertTrue(method_exists($form, 'is_open_fieldset'));
        $this->assertEquals('<fieldset>', $form->is_open_fieldset());
        $this->assertNotEquals('</fieldset>',$form->is_open_fieldset());
        $this->assertNotEquals(null,$form->is_open_fieldset());
        $this->assertEquals(gettype(''),gettype($form->is_open_fieldset()));

        // @method->is_close_fieldset()
        $this->assertTrue(method_exists($form, 'is_close_fieldset'));
        $this->assertEquals('</fieldset>', $form->is_close_fieldset());
        $this->assertNotEquals('<fieldset>',$form->is_close_fieldset());
        $this->assertNotEquals(null,$form->is_close_fieldset());
        $this->assertEquals(gettype(''),gettype($form->is_close_fieldset()));

        // @method->is_error_message()
        $this->assertTrue(method_exists($form, 'is_error_message'));

        // @method->init_form()
        $this->assertEquals(gettype(''),gettype($form->is_open_fieldset()));
        $this->assertTrue(method_exists($form, 'init_form'));
    }

    public function testThankYouMessage() {
        $this->assertTrue(function_exists('thank_you_message'));
    }
}