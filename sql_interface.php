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
	
	if((int)$approved == 1)
	{
	if($zip == 'ANY')
	{
		if($type == 'ANY')
		{
			$query = oci_parse($conn, 'SELECT ID FROM listings_approved');
		}
		else
		{
			$query = oci_parse($conn, 'SELECT ID FROM listings_approved WHERE type=:type');
			oci_bind_by_name($query, ':type', $type);
		}
	}
	else
	{
		if($type == 'ANY')
		{
			$query = oci_parse($conn, 'SELECT ID FROM listings_approved WHERE zip=:zip');
			oci_bind_by_name($query, ':zip', $zip);
		}
		else
		{
			$query = oci_parse($conn, 'SELECT ID FROM listings_approved WHERE type=:type AND zip=:zip');	
			oci_bind_by_name($query, ':zip', $zip);
			oci_bind_by_name($query, ':type', $type);
		}
	}
	}
	else
	{
	if($zip == 'ANY')
	{
		if($type == 'ANY')
		{
			$query = oci_parse($conn, 'SELECT ID FROM listings_unapproved');
		}
		else
		{
			$query = oci_parse($conn, 'SELECT ID FROM listings_unapproved WHERE type=:type');
			oci_bind_by_name($query, ':type', $type);
		}
	}
	else
	{
		if($type == 'ANY')
		{
			$query = oci_parse($conn, 'SELECT ID FROM listings_unapproved WHERE zip=:zip');
			oci_bind_by_name($query, ':zip', $zip);
		}
		else
		{
			$query = oci_parse($conn, 'SELECT ID FROM listings_unapproved WHERE type=:type AND zip=:zip');	
			oci_bind_by_name($query, ':zip', $zip);
			oci_bind_by_name($query, ':type', $type);
		}
	}
	}

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
#	approved: Boolean indicating table in which to get ID 
function get_listing($id, $approved)
{
	$conn=get_conn();
	
	$query = NULL;
	if((int)$approved == 1)
	{
		$query = oci_parse($conn, "SELECT * FROM listings_approved WHERE ID=:id");
	}
	else
	{
		$query = oci_parse($conn, "SELECT * FROM listings_unapproved WHERE ID=:id");
	}
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
#	major: major of alumni
function insert_listing($ID, $approved, $name, $description, $type, $address, $country, $state, $zip, $alum_name, $grad_year, $major)
{
	$conn=get_conn();
	
	if((int)$approved == 1)
	{
		$query = oci_parse($conn, "INSERT INTO listings_approved VALUES (:ID, :name, :description, :type, :address, :country, :state, :zip, :alum_name, :grad_year, :major)");
	}
	else
	{
		$query = oci_parse($conn, "INSERT INTO listings_unapproved VALUES (:ID, :name, :description, :type, :address, :country, :state, :zip, :alum_name, :grad_year, :major)");
	}
	oci_bind_by_name($query, ':ID', $ID);
	oci_bind_by_name($query, ':name', $name);
	oci_bind_by_name($query, ':description', $description);
	oci_bind_by_name($query, ':type', $type);
	oci_bind_by_name($query, ':address', $address);
	oci_bind_by_name($query, ':country', $country);
	oci_bind_by_name($query, ':state', $state);
	oci_bind_by_name($query, ':zip', $zip);
	oci_bind_by_name($query, ':alum_name', $alum_name);
	oci_bind_by_name($query, ':grad_year', $grad_year);
	oci_bind_by_name($query, ':major', $major);
	$res = oci_execute($query);

	oci_free_statement($query);
	oci_close($conn);

	return $res;
}

# Function for admin to delete listing by ID
# PARAMS
#	id: id of listing to be deleted
#	approved: Boolean indicating table in which to delete ID
# RETURN
#	res: success code on deletion of row
function delete_listing($id, $approved)
{
	$conn=get_conn();
	
	if((int)$approved == 1)
	{
		$query = oci_parse($conn, "DELETE FROM listings_approved WHERE ID=:id");
	}
	else
	{
		$query = oci_parse($conn, "DELETE FROM listings_unapproved WHERE ID=:id");
	}
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

	$listing = get_listing($id, 0);
	if(count(get_listing($id, 1)["ID"]) != 0) {
		delete_listing($id,1);
	}
	$res = insert_listing((string)$listing["ID"][0], 1, (string)$listing["NAME"][0], (string)$listing["DESCRIPTION"][0], (string)$listing["TYPE"][0], (string)$listing["ADDRESS"][0], (string)$listing["COUNTRY"][0], (string)$listing["STATE"][0], (string)$listing["ZIP"][0], (string)$listing["ALUM_NAME"][0], (string)$listing["GRAD_YEAR"][0], (string)$listing["MAJOR"][0]);
	delete_listing($id, 0);

	oci_close($conn);

	return $res;
}

# Function to obtain ID for new listing as max between both tables
# RETURN
# 	id: new id
function new_id()
{
	$conn=get_conn();	

	#Get Max ID from approved
	$query = oci_parse($conn, 'SELECT MAX(id) FROM listings_approved');
	oci_execute($query);
	$max_id_1 = NULL;
	oci_fetch_all($query, $max_id_1);
	oci_free_statement($query);

	#Get Max ID from unapproved
	$query = oci_parse($conn, 'SELECT MAX(id) FROM listings_unapproved');
	oci_execute($query);
	$max_id_0 = NULL;
	oci_fetch_all($query, $max_id_0);
	oci_free_statement($query);

	oci_close($conn);


	$max_id = max((int)$max_id_1["MAX(ID)"][0], (int)$max_id_0["MAX(ID)"][0]) + 1;

	return $max_id;	
}
