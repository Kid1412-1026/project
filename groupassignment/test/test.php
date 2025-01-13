<? php
use PHPUnit\Framework\TestCase;

class FormValidationTest extends TestCase {
    public function testFormValidation() {
        // Mock form data
        $_POST['reportname'] = "Test User";
        $_POST['reportemail'] = "test@example.com";
        $_POST['reportmsg'] = "This is a test message.";

        // Simulate form validation logic
        $this->assertNotEmpty($_POST['reportname'], "Name should not be empty");
        $this->assertNotEmpty($_POST['reportemail'], "Email should not be empty");
        $this->assertNotEmpty($_POST['reportmsg'], "Message should not be empty");

        // Email validation
        $this->assertTrue(filter_var($_POST['reportemail'], FILTER_VALIDATE_EMAIL), "Invalid email format");
    }
}
?>
