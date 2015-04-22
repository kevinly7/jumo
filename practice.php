<?php
	class Practice {
		private $dateID;
		private $groupID;
		private	$practiceTypeID;
		private $startTime;
		private $endTime;		
				
		public function Practice($date,$group,$practiceType, $startTime, $endTime)
		{
			$this->dateID = $date;
			$this->groupID = $groupID;
			$this->practiceTypeID = $practiceTypeID;
			$this->startTime = $startTime;
			$this->endTime = $endTime;	
		}
		
		public function getDateID()
		{
			return $this->dateID;
		}
		
		public function practiceTypeID() 
		{
			return $this->practiceTypeID;
		}
		
		public function getStartTime()
		{
			return $this->startTime;
		}

		public function getEndTime()
		{
			return $this->endTime;
		}
	}

?>