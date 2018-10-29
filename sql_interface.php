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
function get_ids($approved, $zip='ANY',$type='ANY')
{
	$conn=get_conn();
	
	$query = oci_parse($conn, 'SELECT ID FROM listings WHERE approved=:approved AND zip=:zip AND type=:type');
	oci_bind_by_name($query, ':approved', $approved);
	oci_bind_by_name($query, ':zip', $zip);
	oci_bind_by_name($query, ':type', $type);
	oci_execute($query);
	
	$oci_val = OCI_BOTH;
	$ids = NULL;
	$nrows = oci_fetch_all($query, $ids);

	oci_free_statement($query);
	oci_close($conn);
	return $ids;
}

#View all listings
#PARAMS
#	id: id as retrieved from get_ids()
function get_listing($id)
{
	$conn=get_conn();
	
	$query = oci_parse($conn, "SELECT * FROM listings WHERE approved=1");
	oci_execute($query);

	$nrows = oci_fetch_array($query, OCI_RETURN_NULLS+OCI_ASSOC);

	oci_free_statement($query);
	oci_close($conn);

	return $results;
}
