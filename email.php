<?php
	class Email 
	{
		private $senderAddress = "";
		private $sendToAddress = "";
		private $messageLine = "";
		private $subjectLine = "";
		private $body = "";

		public function __construct()
		{
		}
		// SET

		public function setSenderAddress($inSenderAddress) {
			$this->senderAddress = $inSenderAddress;
		}
		public function setSendToAddress($inSendToAddress) {
			$this->sendToAddress = $inSendToAddress;
		}
		public function setMessageLine($inMessageLine) {
			$this->messageLine = $inMessageLine;
		}
		public function setSubjectLine($inSubjectLine) {
			$this->subjectLine = $inSubjectLine;
		}
		public function setBody(){
			$this->body .= "To: ".$this->getSendToAddress."\r\n";
			$this->body .= "From: ".$this->getSenderAddress."\r\n";
			$this->body .= "Message: ".$this->getMessageLine;
			}

		//GET
		public function getSenderAddress(){
			return $this->senderAddress;
		}

		public function getSendToAddress(){	
			return $this->sendToAddress;
		}

		public function getMessageLine(){
			return $this->messageLine;
		} 
		
		public function getSubjectLine(){
			return $this->subjectLine;
		}

		public function getBody(){
			return $this->body;
		}

		public function sendPHPEmail(){	
			mail($this->sendToAddress,$this->subjectLine,$this->messageLine,"From: ".$this->senderAddress);
		}			
	}	
?>