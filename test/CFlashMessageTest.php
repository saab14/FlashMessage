<?php
namespace Anax\CFlashMessage; 
//include '../src/flashMessage/CFlashMessage_Test.php';
/**
 * Class
 * @author Andreas Andersson / (saab14) /
 *
 */
class CflashMessageTest extends \PHPUnit_Framework_TestCase
{
	public function testCreateElement()
	{
		$flashMessageObj = new \src\CFlashMessage\CflashMessage(new FakeSession());
		$res = $flashMessageObj->isEmpty();
		$exp = true;
		$this->assertEquals($res, $exp, "Created element created and empty.");
	}
	public function testAddMessages()
	{
		$flashMessageObj = new \src\CFlashMessage\CflashMessage(new FakeSession());
		$flashMessageObj->addDebugMessage("Debug: For your information!");
		$res = $flashMessageObj->messagesHtml();
		$exp = "<div class='message-debug'>Debug: For your information!</div>";
		$this->assertEquals($res, $exp, "Debug message not created successfully.");
		$flashMessageObj->clearMessages();
		$flashMessageObj->addWarningMessage("Warning: May not work!");
		$res = $flashMessageObj->messagesHtml();
		$exp = "<div class='message-warning'>Warning: May not work!</div>";
		$this->assertEquals($res, $exp, "Warning message not created successfully.");
		$flashMessageObj->clearMessages();
		$flashMessageObj->addErrorMessage("Error: Not working!");
		$res = $flashMessageObj->messagesHtml();
		$exp = "<div class='message-error'>Error: Not working!</div>";
		$this->assertEquals($res, $exp, "Error message not created successfully.");
		$flashMessageObj->clearMessages();
		$flashMessageObj->addSuccessMessage("Success: Yayy!");
		$res = $flashMessageObj->messagesHtml();
		$exp = "<div class='message-success'>Success: Yayy!</div>";
		$this->assertEquals($res, $exp, "Success message not created successfully.");
		$flashMessageObj->clearMessages();
	}
	public function testEmpty()
	{
		$flashMessageObj = new \src\CFlashMessage\CflashMessage(new FakeSession());
		$res = $flashMessageObj->isEmpty();
		$exp = true;
		$this->assertEquals($res, $exp, "Newly created object not empty.");
		$flashMessageObj->addDebugMessage("Debug: For your information!");
		$res = $flashMessageObj->isEmpty();
		$exp = false;
		$this->assertEquals($res, $exp, "None empty object reported as empty.");
	}
}
class FakeSession
{
	private $sessionData = array();
	public function has($sessionVariable)
	{
		return isset($this->sessionData[$sessionVariable]);
	}
	public function set($sessionVariable, $allMessages)
	{
		$this->sessionData[$sessionVariable] = $allMessages;
	}
	public function get($sessionVariable)
	{
		if($this->sessionData != null && $this->sessionData[$sessionVariable] != null)
			return $this->sessionData[$sessionVariable];
		return null;
	}
}