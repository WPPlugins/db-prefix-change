<?php
if (preg_match ( '#' . basename ( __FILE__ ) . '#', $_SERVER ['PHP_SELF'] )) {
	die ( 'You are not allowed to call this page directly.' );
}
/* class for portfolio admin */
class CdpAdmin {
	/*
	 * PHP4 compatibility layer for calling the PHP5 constructor.
	 */
	public $message = '';
	public $tablename = '';
	/**
	 * CdpAdmin::__construct()
	 *
	 * @return void
	 */
	function __construct() {
		$this->cdp_Message="";
		$this->cdp_prefix=$wpdb->prefix;
		// code for POST updates
		if (isset ( $_REQUEST ['cdp_form_submit'] ) && $_REQUEST ['cdp_form_submit'] != '') {
			$this->portfolio_process ();
		} elseif (isset ( $_REQUEST ['action'] ) && ($_REQUEST ['action'] == 'add' || $_REQUEST ['action'] == 'edit')) {
			$this->cdp_content ();
		} elseif (isset ( $_REQUEST ['action'] ) && $_REQUEST ['action'] == 'delete') {
			$this->delete_portfolio ();
		} else {
			$this->cdp_render ();
		}
	}
	
	/**
	 * Perform the upload and add a new hook for plugins
	 *
	 * @return void
	 */
	function cdp_process() {
		$error = '';
		//Normal page display
		$dbhost = get_option('dbprefix_dbhost');
		$dbname = get_option('dbprefix_dbname');
		$dbuser = get_option('dbprefix_dbuser');
		$dbpwd = get_option('dbprefix_dbpwd');
		$dbprefix_exist = get_option('dbprefix_prefix_exist');
		$dbprefix_new = get_option('dbprefix_new');
		/* Save data for settings page */
		if (isset ( $_REQUEST ['cdp_form_submit'] ) && check_admin_referer ( plugin_basename ( __FILE__ ), 'cdp_nonce_name' )) {
			//Form data sent
			$old_dbprefix = $_POST['dbprefix_old_dbprefix'];
			update_option('dbprefix_old_dbprefix', $old_dbprefix);
			$dbprefix_new = $_POST['dbprefix_new'];
			update_option('dbprefix_new', $dbprefix_new);
			$wpdb =& $GLOBALS['wpdb'];
			$new_prefix = preg_replace("/[^0-9a-zA-Z_]/", "", $dbprefix_new);
			$dbprefix_class="dbprefix-error";
			if($_POST['dbprefix_new'] =='' || strlen($_POST['dbprefix_new']) < 2 ){$bprefix_Message .= 'Please provide a proper table prefix.';}
			else if ($new_prefix == $old_dbprefix) {$bprefix_Message .= 'No change! Please provide a new table prefix.';}
			else if (strlen($new_prefix) < strlen($dbprefix_new)){
				$bprefix_Message .='You have used some characters disallowed for the table prefix. Please use allowed characters instead of <b>'. $dbprefix_new .'</b>';
			}	else {
				$tables = dbprefix_getTablesToAlter();
				if (empty($tables)) {
					$bprefix_Message .= dbprefix_eInfo('There are no tables to rename!');
				}	else {
					$result = dbprefix_renameTables($tables, $old_dbprefix, $dbprefix_new);
					// check for errors
					if (!empty($result)){
						$bprefix_Message .='All tables have been successfully updated with prefix <b>'.$dbprefix_new.'</b> !<br/>';
						// try to rename the fields
						$bprefix_Message .= dbprefix_renameDbFields($old_dbprefix, $dbprefix_new);
						$dbprefix_wpConfigFile= ABSPATH.'wp-config.php';
						if (dbprefix_updateWpConfigTablePrefix($dbprefix_wpConfigFile, $old_dbprefix, $dbprefix_new)){
							$bprefix_Message .= 'The wp-config file has been successfully updated with prefix <b>'.$dbprefix_new.'</b>!';
							$dbprefix_class="dbprefix-success";
						}	else {
							$bprefix_Message .= 'The wp-config file could not be updated! You have to manually update the table_prefix variable to the one you have specified: '.$dbprefix_new;
						}
						// End if tables successfully renamed
						$bprefix_prefix=$dbprefix_new;
					}	else {
						$bprefix_Message .= 'An error has occurred and the tables could not be updated!';
					}
					$_POST['dbprefix_hidden'] = 'n';
				}
			}
		}
		return;
	}	
	/**
	 * Render the page content
	 *
	 * @return void
	 */
	function cdp_render() {
		include_once(INCLUDE_PATH."render_admin.php");
	}
}
?>