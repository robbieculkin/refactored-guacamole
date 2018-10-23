/* CONSUMER: VIEW ALL LISTINGS */
SELECT * FROM listings WHERE approved=1;

/* CONSUMER: FILTER LISTINGS BY LOCATION/CATEGORY*/
SELECT * FROM listings WHERE approved=1,
	AND zip=/*zip_input*/
	AND type=/*type_input*/;

/* ADMIN: VIEW ALL UNAPPROVED LISTINGS */
SELECT * FROM listings WHERE approved=0;

/* ADMIN: APPROVE LISTING */
UPDATE listings SET approved=1 WHERE ID=/*id_input*/; 

/* ADMIN: REJECT LISTING */
DELETE FROM listings WHERE ID=/*id_input*/;

/* OWNER: SUBMIT LISTING ... TODO need a way to make IDs */
INSERT INTO listings VALUES (/*id, name, description, type, address, country, state, zip, approved, alum_name, grad_year*/);
