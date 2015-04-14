<?php
	class Player {
		private $coachName;
		private $coachContact;
		private	$groupID;
		private $groupName;
				
		public function Player($newCoachName,$newCoachContact,$newGroupID, $newGroupName)
		{
			$this->coachName = $newCoachName;
			$this->coachContact = $newCoachContact;
			$this->groupID = $newGroupID;
			$this->groupName = $newGroupName;
		}
		
		public function getCoachName()
		{
			return $this->coachName;
		}
		
		public function getCoachContact() 
		{
			return $this->coachContact;
		}
		
		public function getGroupID()
		{
			return $this->groupID;
		}
		
		public function getGroupName() 
		{
			return $this->groupName;	
		}
	}

?>