<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * CdprefixAjaxHandler class.
 */
class CdprefixAjaxHandler {

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		add_action( 'wp_ajax_ajaxDataSubmit', array( $this, 'ajaxDataSubmit' ) );
		require_once( 'bootstrapClass.php' );
		$this->ObjBoostrapCodes = BoostrapCodes::Create();
	}

	/**
	 * ajaxDataSubmit function.
	 *
	 * @access public
	 * @return void
	 */
	public function ajaxDataSubmit() {
		global $wpdb;

		$cdPrefix=$wpdb->prefix;
		//Form data sent
		$old_cdprefix = $_POST['old_prefix'];
		$new_cdprefix = $_POST['new_prefix'];		
		$cdPrefixWpConfigFile= ABSPATH.'wp-config.php';
		update_option('new_cdprefix', $new_cdprefix);
		update_option('old_cdprefix', $old_cdprefix);
		
		$wpdb =& $GLOBALS['wpdb'];
		$new_prefix = preg_replace("/[^0-9a-zA-Z_]/", "", $new_cdprefix);
		$cdPrefixMessage ='danger';
		$msg_head = 'Error!';
		if($new_cdprefix =='' || strlen($new_cdprefix) < 2 ){
			$cdPrefixMessage .= 'Please provide a proper table prefix.';
		}
		else if ($new_prefix == $old_cdprefix) {
			$cdPrefixMessage .= 'No change! Please provide a new table prefix.';
		}
		else if (strlen($new_prefix) < strlen($new_cdprefix)){
			$cdPrefixMessage .='You have used some characters disallowed for the table prefix. Please use allowed characters instead of <b>'. $new_cdprefix .'</b>';
		}	else {
			$tables = $this->cdPrefixGetTablesToAlter();
			if (empty($tables)) {
				$cdPrefixMessage .= _e('There are no tables to rename!');
			}	else {
				$result = $this->cdPrefixRenameTables($tables, $old_cdprefix, $new_cdprefix);
				// check for errors
				if (!empty($result)){
					$cdPrefixMessage .='All tables have been successfully updated with prefix <b>'.$new_cdprefix.'</b> !<br/>';
					// try to rename the fields
					$cdPrefixMessage .= $this->cdPrefixRenameDbFields($old_cdprefix, $new_cdprefix);
										
					if ($this->cdPrefixUpdateWpConfigTablePrefix($cdPrefixWpConfigFile, $old_cdprefix, $new_cdprefix)){
						$cdPrefixMessage .= 'The wp-config file has been successfully updated with prefix <b>'.$new_cdprefix.'</b>!';
						$dbprefix_class="success";
						$msg_head = 'success!';
					}	else {
						$cdPrefixMessage .= 'The wp-config file could not be updated! You have to manually update the table_prefix variable to the one you have specified: '.$new_cdprefix;
					}
					// End if tables successfully renamed
					$cdPrefix=$new_cdprefix;
				}	else {
					$cdPrefixMessage .= 'An error has occurred and the tables could not be updated!';
				}
			}
		}
		$close = true;
		$xclass = 'col-xs-8 col-xs-offset-2';
		$return_val = $this->ObjBoostrapCodes->bootstrap_alert( $dbprefix_class,$close, $cdPrefixMessage, $xclass,$msg_head);
		$data['result']['Prefix'] = $cdPrefix;
		$data['result']['message'] = $return_val;
		echo json_encode($data);
		die();
	}
	protected function cdPrefixGetTablesToAlter(){
		global $wpdb;
		return $wpdb->get_results("SHOW TABLES LIKE '".$GLOBALS['table_prefix']."%'", ARRAY_N);
	}
	protected function cdPrefixRenameTables($tables, $currentPrefix, $newPrefix){
		global $wpdb;
		$changedTables = array();
		foreach ($tables as $k=>$table)	{
			$tableOldName = $table[0];
			// Hide errors
			$wpdb->hide_errors();
		
			// To rename the table
			$tableNewName = substr_replace($tableOldName, $newPrefix, 0, strlen($currentPrefix));
			$wpdb->query("RENAME TABLE `{$tableOldName}` TO `{$tableNewName}`");
			array_push($changedTables, $tableNewName);
		
		}
		return $changedTables;
	}
	protected function cdPrefixUpdateWpConfigTablePrefix($cdPrefixWpConfigFile, $oldPrefix, $newPrefix)
	{
		// Check file' status's permissions
		if (!is_writable($cdPrefixWpConfigFile))
		{
			return -1;
		}
	
		if (!function_exists('file')) {
			return -1;
		}
	
		// Try to update the wp-config file
		$lines = file($cdPrefixWpConfigFile);
		$fcontent = '';
		$result = -1;
		foreach($lines as $line)
		{
			$line = ltrim($line);
			if (!empty($line)){
				if (strpos($line, '$table_prefix') !== false){
					$line = preg_replace("/=(.*)\;/", "= '".$newPrefix."';", $line);
				}
			}
			$fcontent .= $line;
		}
		if (!empty($fcontent)){
			// Save wp-config file
			$result = file_put_contents($cdPrefixWpConfigFile, $fcontent);
		}
	
		return $result;
	}
	protected function cdPrefixRenameDbFields($oldPrefix,$newPrefix)
	{
		global $wpdb;		
		/*
		 * usermeta table
		 *===========================
		 wp_*
		* options table
		* ===========================
		wp_user_roles
		*/
		$str = '';
		if (false === $wpdb->query("UPDATE {$newPrefix}options SET option_name='{$newPrefix}user_roles' WHERE option_name='{$oldPrefix}user_roles';")) {
			$str .= '<br/>Changing value: '.$newPrefix.'user_roles in table <strong>'.$newPrefix.'options</strong>: <font color="#ff0000">Failed</font>';
		}
		$query = 'update '.$newPrefix.'usermeta set meta_key = CONCAT(replace(left(meta_key, ' . strlen($oldPrefix) . "), '{$oldPrefix}', '{$newPrefix}'), SUBSTR(meta_key, " . (strlen($oldPrefix) + 1) . ")) where meta_key in ('{$oldPrefix}autosave_draft_ids', '{$oldPrefix}capabilities', '{$oldPrefix}metaboxorder_post', '{$oldPrefix}user_level', '{$oldPrefix}usersettings','{$oldPrefix}usersettingstime', '{$oldPrefix}user-settings', '{$oldPrefix}user-settings-time', '{$oldPrefix}dashboard_quick_press_last_post_id')";
		if (false === $wpdb->query($query)) {
			$str .= '<br/>Changing values in table <strong>'.$newPrefix.'usermeta</strong>: <font color="#ff0000">Failed</font>';
		}
		if (!empty($str)) {
			$str = '<br/><p>Changing database prefix:</p><p>'.$str.'</p>';
		}
		return $str;
	}
	
}

new CdprefixAjaxHandler();