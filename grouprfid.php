<?php 

function convertgroup($id) {

	$strlen = strlen( $id );
	$groupid = 4;
for( $i = 0; $i <= $strlen; $i++ ) {
    $char = substr( $id, $i, 1 );
    $groupid .= ord($char);
    // $char contains the current character, so do your processing here
}

return $groupid;

}

?>