<?php
	class Email 
	{
		public $sendFrom = "nkbrockhoff@gmail.com";
		public $sendTo;
		public $message;
		public $subject;
		public $body;

		function __construct()
		{
		}

		function set_sender($new_sender) {
			$this->sendFrom = $new_sender;
		}
		function get_sender(){
			return $this->sendFrom;
		}

		function set_sendTo($new_sendTo) {
			$this->sendTo = $new_sendTo;
		}
		function get_recipient(){	
			return $this->sendTo;
		}

		function set_message($new_message) {
			$this->message = $new_message;
		}
		function get_message(){
			return $this->message;
		}

		function set_subject($new_subject) {
			$this->subject = $new_subject;
		} 
		function get_subject(){
			return $this->subject;
		}

		function set_body(){
		$this->body .= "To: ".$this->sendTo."\r\n";
		$this->body .= "From: ".$this->sendFrom."\r\n";
		$this->body .="Message: ".$this->message;
		}

		function get_body(){
			return $this->body;
		}

		function sendEmail(){	
			mail($this->sendTo,$this->subject,$this->body,$this->sendFrom);
		}			
	}	
?>