<?php 

namespace Anax\CFlashMessage; 

/** 
 * Class for saving different types of flash messages in the session and 
 * displaying them to the user in different styles depending on the type. 
 * It is possible to store several messages at the same time.  
 * 
 */ 
class CFlashMessage 
{ 
    use \Anax\DI\TInjectable; 

    // Some settings etc 
    private $sessionVariable = 'CFlashMessage'; 
    private $messageTypes = ['info', 'warning', 'error', 'success']; 

    // Where all messages will be stored when class instance is created 
    private $allMessages = null; 

    // Variable for the anax session object 
    private $session = null; 

    public function __construct($di)  
    { 
        $this->di = $di; 
        $this->session = $this->di->session(); 

        if($this->session->has($this->sessionVariable)) 
        { 
            $this->retrieveMessages(); 
        } 
    } 

    /** 
     * Adds a flash message to the session. 
     *  
     * @param type The type of message 
     * @param message The message to add 
     */ 
    private function addMessage($type = 'info', $message) 
    { 
        $flashMessage = ['type' => $type, 'message' => $message]; 

        if(is_null($this->allMessages)) 
        { 
            $this->allMessages = array(); 
        } 

        array_push($this->allMessages, $flashMessage); 

        $this->session->set($this->sessionVariable, $this->allMessages); 
    } 

    /** 
     * Adds a debug message to the session. 
     *  
     * @param message The message to add 
     */ 
    public function infoMessage($message) 
    { 
        $this->addMessage('info', $message); 
    } 

    /** 
     * Adds a warning message to the session. 
     *  
     * @param message The message to add 
     */ 
    public function warningMessage($message) 
    { 
        $this->addMessage('warning', $message); 
    } 

    /** 
     * Adds a error message to the session. 
     *  
     * @param message The message to add 
     */ 
    public function errorMessage($message) 
    { 
        $this->addMessage('error', $message); 
    } 

    /** 
     * Adds a success message to the session. 
     *  
     * @param message The message to add 
     */ 
    public function successMessage($message) 
    { 
        $this->addMessage('success', $message); 
    } 

    /** 
     * Clears all messages from the session. 
     *  
     */ 
    public function clearMessages()  
    { 
        $this->session->set($this->sessionVariable, null); 
    } 

    /** 
     * Retrieves the array of messages from the session and store 
     * store them in the $allMessages variable. 
     *  
     */ 
    public function retrieveMessages() 
    { 
        $this->allMessages = $this->session->get($this->sessionVariable); 
    } 

    /** 
     * Returns the html for the divs with the messages. 
     * 
     * @return The string with the HTML  
     */ 
    public function messagesHtml() 
    { 
        $msgHtml = ""; 

        if(is_null($this->allMessages)) 
            return $msgHtml; 

        foreach ($this->allMessages as $message) { 
            $type = $message['type']; 
            $message = $message['message']; 

            $msgHtml .= "<div class='flash_".$type."'>".$message."</div>"; 
        } 

        $this->clearMessages(); 

        return $msgHtml; 
    } 

    /** 
     * Checks if the $allMessages variable is set or not. 
     *  
     * @return True if the session is empty, otherwise false. 
     */ 
    public function isEmpty()  
    { 
        if(is_null($this->allMessages)) 
        { 
            return true; 
        } 
        return false; 
    } 


} 
