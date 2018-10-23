<?php 

# returns all IDs
# PARAMS
# 	approved: 1 for approved listings, 0 for unapproved listings

# TODO exception checking
function get_ids($approved)
{
	$conn=oci_connect('rculkin', '1051271', '//dbserver.engr.scu.edu/db11g');
	if(!$conn) {
     	print "<br> connection failed:";
        exit;
	}
	
	$query = oci_parse($conn, 'SELECT ID FROM listings WHERE approved= :approved');
	oci_bind_by_name($query, ':approved', $approved);
	oci_execute($query);
	
	$ids = oci_fetch_all($query, OCI_BOTH);
	return $ids;
}



?>
