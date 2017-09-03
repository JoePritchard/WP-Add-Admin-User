<?php
/*

	Adds an Admin user to Wordpress using create user functionality.
	Put this file in the root folder of the WP site and edit to add
	username, password and email address.

	Run the script and then delete it.

*/

require_once('wp-blog-header.php');
require_once('wp-includes/registration.php');

// SET THESE BEFORE RUNNING
$newusername = '';
$newpassword = '';
$newemail = '';

//	Check valid configuration set up
if ( $newpassword != '' && $newemail != '' && $newusername !=''  ) 
{
	// Check that user doesn't already exist
	if ( !username_exists($newusername) && !email_exists($newemail) ) 
	{
		// Create user and set role to administrator
		$user_id = wp_create_user( $newusername, $newpassword, $newemail);
		if ( is_int($user_id) )
		{
			$wp_user_object = new WP_User($user_id);
			$wp_user_object->set_role('administrator');
			echo 'Successfully created new admin user as follows:';
			echo '<br />Username : ' . $newusername;
			echo '<br />Password : ' . $newpassword;
			echo '<br />Email Address : ' . $newemail;
		} 
		else {
			echo 'Error with wp_insert_user. The Admin user was not created.';
		}
	} 
	else {
		echo 'This user or email address already exists. Nothing was done.';
	}
} 
else {
	echo "Please set the user name, password and email address.";
}

?>