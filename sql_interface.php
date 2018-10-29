<?php 

# Get connection variable for further connections
# PARAMS
#	None
function get_conn()
{
	$conn=oci_connect('rculkin', '1051271', '//dbserver.engr.scu.edu/db11g');
	if(!$conn) {
	     	echo "<br> connection failed:";
	}
	
	return $conn;
}

# returns all IDs
# PARAMS
# 	approved: 1 for approved listings, 0 for unapproved listings

# TODO exception checking
function get_ids($approved)
{
	$conn=get_conn();
	
	$query = oci_parse($conn, 'SELECT ID FROM listings WHERE approved=:approved');
	oci_bind_by_name($query, ':approved', $approved);
	oci_execute($query);
	
	$oci_val = OCI_BOTH;
	$ids = NULL;
	$nrows = oci_fetch_all($query, $ids);

	oci_free_statement($query);
	oci_close($conn);
	return $ids;
}

#View listing by ID
#PARAMS
#	id: id as retrieved from get_ids()
function get_listing($id)
{
	$conn=get_conn();
	
	$query = oci_parse($conn, "SELECT * FROM listings WHERE ID=:id");
	oci_bind_by_name($query, ':id', $id);
	oci_execute($query);

	$listings = NULL;
	$nrows = oci_fetch_all($query, $listings);

	oci_free_statement($query);
	oci_close($conn);

	return $listings;
}


?>
