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
	
	if($zip == 'ANY')
	{
		if($type == 'ANY')
		{
			$query = oci_parse($conn, 'SELECT ID FROM listings WHERE approved=:approved');
		}
		else
		{
			$query = oci_parse($conn, 'SELECT ID FROM listings WHERE approved=:approved AND type=:type');
			oci_bind_by_name($query, ':type', $type);
		}
	}
	else
	{
		if($type == 'ANY')
		{
			$query = oci_parse($conn, 'SELECT ID FROM listings WHERE approved=:approved AND zip=:zip');
			oci_bind_by_name($query, ':zip', $zip);
		}
		else
		{
			$query = oci_parse($conn, 'SELECT ID FROM listings WHERE approved=:approved AND type=:type AND zip=:zip');	
			oci_bind_by_name($query, ':zip', $zip);
			oci_bind_by_name($query, ':type', $type);
		}
	}

	oci_bind_by_name($query, ':approved', $approved);
	oci_execute($query);
	
	$oci_val = OCI_BOTH;
	$ids = NULL;
	$nrows = oci_fetch_all($query, $ids);

	oci_free_statement($query);
	oci_close($conn);
	return $ids;
}

# View listing by ID
# PARAMS
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

# Insert listing into oracle database
# Params
#	ID: id given by system
#	name: Name of business
#	description: Description of business
#	type: Type of business
#	address: Address of business
#	country: Country business is housed in
#	state: State business is housed in
#	zip: Zipcode business is housed in
#	approved: Has listing been approved by administrators
#	alum_name: Name of alumni that owns business
#	grad_year: Year alumni graduated
function insert_listing($ID, $name, $description, $type, $address, $country, $state, $zip, $approved, $alum_name, $grad_year)
{
	$conn=get_conn();
	
	$query = oci_parse($conn, "INSERT INTO listings VALUES (:ID, :name, :description, :type, :address, :country, :state, :zip, :approved, :alum_name, :grad_year)");
	oci_bind_by_name($query, ':ID', $ID);
	oci_bind_by_name($query, ':name', $name);
	oci_bind_by_name($query, ':description', $description);
	oci_bind_by_name($query, ':type', $type);
	oci_bind_by_name($query, ':address', $address);
	oci_bind_by_name($query, ':country', $country);
	oci_bind_by_name($query, ':state', $state);
	oci_bind_by_name($query, ':zip', $zip);
	oci_bind_by_name($query, ':approved', $approved);
	oci_bind_by_name($query, ':alum_name', $alum_name);
	oci_bind_by_name($query, ':grad_year', $grad_year);
	$res = oci_execute($query);

#	$listings = NULL;
#	$nrows = oci_fetch_all($query, $listings);

	oci_free_statement($query);
	oci_close($conn);

	return $res;
}

# Function for admin to delete listing by ID
# PARAMS
#	id: id of listing to be deleted
# RETURN
#	res: success code on deletion of row
function delete_listing($id)
{
	$conn=get_conn();
	
	$query = oci_parse($conn, "DELETE FROM listings WHERE ID=:id");
	oci_bind_by_name($query, ':id', $id);
	$res = oci_execute($query);

	oci_free_statement($query);
	oci_close($conn);

	return $res;
}

# Function for admin to approve listings
# PARAMS
#	id: id of listing to be approved
# RETURN
#	res: success code on approval of listing
function approve_listing($id)
{
	$conn=get_conn();

	$query = oci_parse($conn, 'UPDATE listings SET approved=1 WHERE ID=:id');
	oci_bind_by_name($query, ':id', $id);
	$res = oci_execute($query);

	oci_free_statement($query);
	oci_close($conn);

	return $res;
}
