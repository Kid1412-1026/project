<?php
use PHPUnit\Framework\TestCase;

class ReportTest extends TestCase
{
    public function testFormSubmission()
    {
        // Simulate form data
        $_POST['reportname'] = 'Test User';
        $_POST['reportemail'] = 'testuser@example.com';
        $_POST['reportmsg'] = 'This is a test message.';

        // Include the script to test
        ob_start();
        include 'report_action.php';
        $output = ob_get_clean();

        // Assert that a success message is returned
        $this->assertStringContainsString('Report sent successfully!', $output);
    }

    public function testFormValidation()
    {
        // Test missing required fields
        $_POST['reportname'] = '';
        $_POST['reportemail'] = 'invalid-email';
        $_POST['reportmsg'] = '';

        ob_start();
        include 'report_action.php';
        $output = ob_get_clean();

        // Assert that an error is returned for invalid input
        $this->assertStringContainsString('Error:', $output);
    }
}
?>
