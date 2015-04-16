<?php  
echo "hello";
echo '<br />';

$txt_file    = file_get_contents('timelog2.txt');
$rows        = explode("\n", $txt_file);
array_shift($rows);
$count = 0;

foreach($rows as $row => $data)
{
    //get row data
    $row_data = explode(' ', $data);
$count++;
echo $row_data[0];
echo '<br />';
echo $count.'<br />';
}

?>