<?php
	class Player {
		private $playerName;
		private $playerContact;
		private	$playerID;		
				
		public function Player($newName,$newContact,$newID)
		{
			$this->playerName = $newName;
			$this->playerContact = $newContact;
			$this->playerID = $newID;	
		}
		
		public function getName()
		{
			return $this->playerName;
		}
		
		public function getContact() 
		{
			return $this->playerContact;
		}
		
		public function getID()
		{
			return $this->playerID;
		}
	}

?>