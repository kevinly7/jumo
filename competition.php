<body>
    <h4>Add Competition</h4>

    <form action = "competition.php" method = "POST"> 
        <br>
        <h6><b>Filters</b></h6> 
        <br>

    <?php 
        include ('database.php');
    ?>

        <select name="yearSelect" class="browser-default">
            <option value="" >Please select a year</option>

        <?php
            $datearray = array();
            foreach($connection->query("SELECT YEAR(dateName) AS 'year' FROM tblDATE") as $row) {
                if ($row['year'] != '0' && strlen($row['year']) > 0) { 
                    
                    $datearray[$row['year']] = $row['year'];
                }
            }
            foreach ($datearray as $value) {
                $mpieces = explode(" ", $value);
                $year1 = $mpieces[0];        
                ?>
                <option>
                    <span >
                        <?php 
                            echo  $year1;
                        ?>
                    </span>
                    </br>
                </option>                
            <?php }   
            ?>
        </select>    

        <select name="monthSelect" class="browser-default">
            <option value="" disabled selected>Please select a month</option> 
            <option>January</option> 
            <option>February</option> 
            <option>March</option> 
            <option>April</option>
            <option>May</option> 
            <option>June</option> 
            <option>July</option> 
            <option>August</option> 
            <option>September</option> 
            <option>October</option> 
            <option>November</option> 
            <option>December</option>  
        </select>

        <select name="daySelect" class="browser-default">
            <option value="" disabled selected>Please select a day</option> 
            <option>01</option> 
            <option>02</option> 
            <option>03</option> 
            <option>04</option>
            <option>05</option> 
            <option>06</option> 
            <option>07</option> 
            <option>08</option>
            <option>09</option> 
            <option>10</option> 
            <option>11</option> 
            <option>12</option>
            <option>13</option> 
            <option>14</option> 
            <option>15</option> 
            <option>16</option>
            <option>17</option> 
            <option>18</option> 
            <option>19</option> 
            <option>20</option>
            <option>21</option> 
            <option>22</option> 
            <option>23</option> 
            <option>24</option>
            <option>25</option> 
            <option>26</option> 
            <option>27</option> 
            <option>28</option>
            <option>29</option> 
            <option>30</option> 
            <option>31</option>  
        </select>

        <?php $groupArray = array();?>
        <select name="groupSelect" class="browser-default">
            <option value="" disabled selected>Please select a group</option>
            <option>All</option>
            <?php 
            foreach($connection->query("Select * from tblGROUP") as $row) {?>
                <option value = <?php echo $row['GroupID'] ?>>
                    <span>
                        <?php 
                            $groupArray[$row['GroupID']] = $row['GroupName'];
                            echo $row['GroupName'];
                        ?>
                    </span>
                    </br>
                </option>
            <?php }?>
            ?>
        </select>

        </br><!-- <input name = "formSubmit" type="submit" value="Select View"> -->
        <button class="btn waves-effect waves-light amber accent-3 white-text" type="submit" id="submitGroup" name="competitionSubmit">Select View</button>
    </form>
    <?php 
    if(isset($_POST['competitionSubmit'])) {
        $year = $_POST['yearSelect'];
        $monthSelect = $_POST['monthSelect'];
        $month = date('m',strtotime($monthSelect));
        $day = $_POST['daySelect'];
        $group = $_POST['groupSelect'];
        $date = $year.$month.$day;

        $datequery = $connection->query("SELECT DateID FROM tblDATE d WHERE d.DateName = '$date'");
        $datequery->execute();
        $dateResult = $datequery->fetch(PDO::FETCH_ASSOC);
        $dateID = $dateResult['DateID'];
        //echo $dateID . "date";


        $practicequery = $connection->query("SELECT PracticeID FROM tblPRACTICE p WHERE p.GroupID = $group AND p.DateID = $dateID");
        $practicequery->execute();
        $result = $practicequery->fetch(PDO::FETCH_ASSOC);
        $practiceID = $result['PracticeID'];
        $statement = $connection->prepare ("UPDATE tblPRACTICE p SET p.PracticeTypeID=2 WHERE p.PracticeID=$practiceID"); 
        echo $practiceID . " practice";
        if($practicequery->rowCount() == 1)
        {
          $statement -> execute();
        }
    }
    ?>

</body>