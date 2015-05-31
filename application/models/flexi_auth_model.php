<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* Name: flexi auth Model
*
* Author: 
* Rob Hussey
* flexiauth@haseydesign.com
* haseydesign.com/flexi-auth
*
* Copyright 2012 Rob Hussey
* 
* Previous Authors / Contributors:
* Ben Edmunds, benedmunds.com
* Phil Sturgeon, philsturgeon.co.uk
* Mathew Davies
* Filou Tschiemer (User Group Privileges)
*
* Licensed under the Apache License, Version 2.0 (the "License");
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
* 
* http://www.apache.org/licenses/LICENSE-2.0
* 
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*
* Description: A full login authorisation and user management library for CodeIgniter based on Ion Auth (By Ben Edmunds) which itself was based on Redux Auth 2 (Mathew Davies)
* Released: 13/09/2012
* Requirements: PHP5 or above and Codeigniter 2.0+
*/

class Flexi_auth_model extends Flexi_auth_lite_model
{
	public function __construct() {
	   $this->db = $this->load->database('eduity',true);
       
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// TOKEN GENERATION
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * generate_token
	 * Generates a random unhashed password / token / salt.
	 * Includes a safe guard to ensure vowels are removed to avoid offensive words when used for password generation.
	 * Additionally, 0, 1 removed to avoid confusion with o, i, l.
	 *
	 * @return string
	 */
	public function generate_token($length = 8) 
	{
		$characters = '23456789BbCcDdFfGgHhJjKkMmNnPpQqRrSsTtVvWwXxYyZz';
		$count = mb_strlen($characters);

		for ($i = 0, $token = ''; $i < $length; $i++) 
		{
			$index = rand(0, $count - 1);
			$token .= mb_substr($characters, $index, 1);
		}
		return $token;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * generate_hash_token
	 * Generates a new hashed password / token.
	 *
	 * @return string
	 * @author Rob Hussey
	 */
	public function generate_hash_token($token, $database_salt = FALSE, $is_password = FALSE)
	{
	    if (empty($token))
	    {
	    	return FALSE;
	    }
		
		// Get static salt if set via config file.
		$static_salt = $this->auth->auth_security['static_salt'];
		
		if ($is_password)
		{
			require_once(APPPATH.'libraries/phpass/PasswordHash.php');				
			$phpass = new PasswordHash(8, FALSE);
			
			return $phpass->HashPassword($database_salt . $token . $static_salt);
		}
		else
		{
			return sha1($database_salt . $token . $static_salt);
		}
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// USER MANAGEMENT / CRUD METHODS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
		
	/**
	 * insert_user
	 * Inserts user account and profile data, returning the users new id.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function insert_user($email, $username, $password, $custom_data = FALSE, $group_id = FALSE)
	{
		// Check that an email address and password have been set.
		// If a username is defined as an identity column, ensure it is also set.
		if (empty($email) || empty($password) || 
			(empty($username) && in_array($this->auth->tbl_col_user_account['username'], $this->auth->db_settings['identity_cols'])))
		{
			$this->set_error_message('account_creation_insufficient_data', 'config');
			return FALSE;
		}
				
		// Check email is unique.
		if (!$this->identity_available($email))
		{
			$this->set_error_message('account_creation_duplicate_email', 'config');
			return FALSE;
		}
		
		// If username is the primary identity column, check it is unique.
		// If it isn't unique, auto incrementing the username (See next 'if' condition) cannot be used, as user must know their new username to login.
		if ($this->auth->primary_identity_col == $this->auth->tbl_col_user_account['username'] && !$this->identity_available($username)) 
		{
			$this->set_error_message('account_creation_duplicate_username', 'config');
			return FALSE;
		}
		// Auto increment duplicate usernames (username1, username2...) if defined by config file.
		else if (!empty($username) && !$this->username_available($username))
		{
			if ($this->auth->auth_settings['auto_increment_username'])
			{
				$check_username = $username;
				for($i = 0; !$this->username_available($check_username); $i++)
				{
					$check_username = ($i > 0) ? $username.$i : $username;
				}
				$username = $check_username;
			}
			// Require user to try another username.
			else 
			{
				$this->set_error_message('account_creation_duplicate_username', 'config');
				return FALSE;
			}
		}
		
		###+++++++++++++++++++++++++++++++++###
		
		// Get group ID if it was passed in additional data array.
	    if (isset($custom_data[$this->auth->database_config['user_group']['columns']['id']]) && is_numeric($custom_data[$this->auth->database_config['user_group']['columns']['id']]))
	    {
			$group_id = $custom_data[$this->auth->database_config['user_group']['columns']['id']];
			unset($custom_data[$this->auth->database_config['user_group']['columns']['id']]);
	    }
		// Else, if a $group_id was not passed to the function, use the default group id defined via the config file.
	    else if (!is_numeric($group_id))
	    {
			$group_id = $this->auth->auth_settings['default_group_id'];
	    }

	    $ip_address = $this->input->ip_address();
		
		$store_database_salt = $this->auth->auth_security['store_database_salt'];
	    $database_salt = $store_database_salt ? $this->generate_token($this->auth->auth_security['database_salt_length']) : FALSE;
		
		$hash_password = $this->generate_hash_token($password, $database_salt, TRUE);
		$activation_token = sha1($this->generate_token(20));
		$suspend_account = ($this->auth->auth_settings['suspend_new_accounts']) ? 1 : 0;
		
		###+++++++++++++++++++++++++++++++++###

		// Start SQL transaction.
		$this->db->trans_start();
		
		// Main user account table.	
	    $sql_insert = array(
			$this->auth->tbl_col_user_account['group_id'] => $group_id,
			$this->auth->tbl_col_user_account['email'] => $email,
			$this->auth->tbl_col_user_account['username'] => ($username) ? $username : '',
			$this->auth->tbl_col_user_account['password'] => $hash_password,
			$this->auth->tbl_col_user_account['ip_address'] => $ip_address,
			$this->auth->tbl_col_user_account['last_login_date'] => $this->database_date_time(),
			$this->auth->tbl_col_user_account['date_added'] => $this->database_date_time(),
			$this->auth->tbl_col_user_account['activation_token'] => $activation_token,
			$this->auth->tbl_col_user_account['active'] => 0,		
			$this->auth->tbl_col_user_account['suspend'] => $suspend_account		
		);

	    if ($store_database_salt)
	    {
			$sql_insert[$this->auth->tbl_col_user_account['salt']] = $database_salt;
	    }

		// Loop through custom data columns for the main user table set via config file.
		foreach($this->auth->database_config['user_acc']['custom_columns'] as $column)
		{			
			if (array_key_exists($column, $custom_data))
			{
				$sql_insert[$column] = $custom_data[$column];
				unset($custom_data[$column]);
			}
		}

	    // Create main user account.
		$this->db->insert($this->auth->tbl_user_account, $sql_insert);
		
		###+++++++++++++++++++++++++++++++++###

		// Custom user data table(s).
		// Get newly created User Account id for join with custom user data table(s).
	    $user_id = $this->db->insert_id();
		
		$this->insert_custom_user_data($user_id, $custom_data);
		
		###+++++++++++++++++++++++++++++++++###

		// Complete SQL transaction.
		$this->db->trans_complete();

	    return is_numeric($user_id) ? $user_id : FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * update_user
	 * Updates the main user account table and any linked custom user tables.
	 *
	 * @return bool
	 * @author Rob Hussey
	 * @author Phil Sturgeon
	 */
	public function update_user($user_id, $user_data)
	{
		if (!is_array($user_data))
		{
			return FALSE;
		}
	
		// Get user information.
		$sql_select = array(
			$this->auth->primary_identity_col,
			$this->auth->tbl_col_user_account['salt']
		);
		
		$sql_where[$this->auth->tbl_col_user_account['id']] = $user_id;	
	
		$user = $this->get_users($sql_select, $sql_where)->row();
		
		// Check if users identity is being updated.
		// Loop through database identity columns to validate new identity is available.
		$identity_cols = $this->auth->db_settings['identity_cols'];
		for ($i = 0; count($identity_cols) > $i; $i++) 
		{
			// Check if identity column exists within $user_data keys.
			if (array_key_exists($identity_cols[$i], $user_data))
			{
				// Get identity value from $user_data and check if identity is available.
				if (!$this->identity_available($user_data[$identity_cols[$i]], $user_id))
				{
					// Identity already exists
					// Note: If using an identity other than email or username, this needs to be added to the language file.
					$this->set_error_message('account_creation_duplicate_'.$identity_cols[$i], 'config');
					return FALSE;
				}
			}
		}
		
		###+++++++++++++++++++++++++++++++++###
		
	    // Start SQL transaction.
		$this->db->trans_start();

		// Create an array of updatable columns.
		// Note: The global var $this->auth->tbl_col_user_account is not used as it prepend column names with the table name. 
		$user_account_cols = $this->auth->database_config['user_acc']['columns'];
		
		// Add any additional custom data columns from the main user account table to the array.
		foreach($this->auth->database_config['user_acc']['custom_columns'] as $column)
		{
			$user_account_cols[$column] = $column;
		}

		$sql_update = array();
		foreach($user_account_cols as $key => $column)
		{
			if (isset($user_data[$column]))
			{
				// If data is a new password, hash it.
				if ($column == $this->auth->database_config['user_acc']['columns']['password'])
				{
					$password = $user_data[$column];
					$database_salt = $user->{$this->auth->database_config['user_acc']['columns']['salt']};
					$hash_password = $this->generate_hash_token($password, $database_salt, TRUE);
					
					$sql_update[$this->auth->tbl_col_user_account[$key]] = $hash_password;
				}
				else
				{
					// Update users current session identifier (email / username etc) if being updated.
					if ($column == $this->auth->db_settings['primary_identity_col'])
					{
						$this->update_session_identifier($user_id, $user_data[$column]);
					}
					
					$sql_update[$this->auth->tbl_col_user_account[$key]] = $user_data[$column];
				}
				unset($user_data[$column]);
			}
		}
		
		if (count($sql_update) > 0)
		{
			$sql_where = array($this->auth->tbl_col_user_account['id'] => $user_id);
			
			$this->db->update($this->auth->tbl_user_account, $sql_update, $sql_where);
		}
		
		###+++++++++++++++++++++++++++++++++###

		// Custom user data table(s).
		// Note: Ensure that any custom data table data is accompanied with the records primary key.
		$this->update_custom_user_data(FALSE, FALSE, $user_data);

		###+++++++++++++++++++++++++++++++++###
		
		// Complete SQL transaction.
		$this->db->trans_complete();
		
		return $this->db->trans_status();
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * delete_user
	 * Deletes a user account and all linked custom user tables from the database.
	 *
	 * @return bool
	 * @author Rob Hussey
	 * @author Phil Sturgeon
	 */
	public function delete_user($user_id)
	{
		// Start SQL transaction.
		$this->db->trans_start();

		// Delete any user 'Remember me' sessions.
		$this->delete_database_login_session($user_id);

		// Delete user data.
		$this->db->delete($this->auth->tbl_user_account, array($this->auth->tbl_col_user_account['id'] => $user_id));
		
		// Loop through custom user data table(s).
		foreach ($this->auth->tbl_custom_data as $table)
		{
			$this->db->delete($table['table'], array($table['join'] => $user_id));
		}

		// Delete user privilege data.
		$this->db->delete($this->auth->tbl_user_privilege_users, array($this->auth->tbl_col_user_privilege_users['user_id'] => $user_id));

		// Complete SQL transaction
		$this->db->trans_complete();
		
		return $this->db->trans_status();
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * insert_custom_user_data
	 * Inserts data into a custom user table and returns the table name and row id of each record inserted.
	 *
	 * @return array/bool
	 * @author Rob Hussey
	 */
	public function insert_custom_user_data($user_id = FALSE, $custom_data = FALSE)
	{
		if (! is_numeric($user_id) || ! is_array($custom_data) || empty($this->auth->database_config['custom']))
		{
			return FALSE;
		}
	
		// Set a var to return the name and id of each table and row that is inserted to the database.
		$row_data = array();

		// Loop through custom data table(s) set via config file.
		foreach ($this->auth->database_config['custom'] as $custom_table => $table_data)
		{
			$sql_insert = array();
			
			// Loop through custom user data table and try to match columns with $custom_data values.
			if (! empty($table_data['custom_columns']))
			{
				foreach ($table_data['custom_columns'] as $key => $column)
				{
					if (is_array($custom_data) && isset($custom_data[$column]))
					{
						$sql_insert[$this->auth->tbl_custom_data[$custom_table]['custom_columns'][$key]] = $custom_data[$column];
					}
					else if ($this->input->post($column))
					{
						$sql_insert[$this->auth->tbl_custom_data[$custom_table]['custom_columns'][$key]] = $this->input->post($column);
					}
				}
			}
			
			if (count($sql_insert) > 0)
			{
				$sql_insert[$table_data['join']] = $user_id;

				$this->db->insert($table_data['table'], $sql_insert);
				
				// Get new table row id.
				if ($this->db->affected_rows() > 0) 
				{
					$row_data[$table_data['table']] = $this->db->insert_id();
				}
			}
		}
		
		return (! empty($row_data)) ? $row_data : FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * update_custom_user_data
	 * Updates a custom user table with any submitted data.
	 * To identify which row to update, a table name and row id can be submitted, alternatively, data can be updated by submitting custom data
	 * that contains an array key and value of the primary key column and row id from any of the custom tables set via the config file.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function update_custom_user_data($table = FALSE, $row_id = FALSE, $custom_data = FALSE)
	{
		if (! is_array($custom_data) || empty($this->auth->database_config['custom']))
		{
			return FALSE;
		}

		// Loop through user custom data table(s)
		foreach ($this->auth->database_config['custom'] as $custom_table => $table_data)
		{
			$identifier_id = FALSE;

			// Get tables primary key, if not submitted, try to match the rows secondard key column.
			if ($row_id && $table_data['table'] == $table)
			{
				$identifier_id = $row_id;
				$identifier_col = $table_data['primary_key'];
			}			
			else if (isset($custom_data[$table_data['primary_key']]))
			{
				$identifier_id = $custom_data[$table_data['primary_key']];
				$identifier_col = $table_data['primary_key'];
				unset($custom_data[$table_data['primary_key']]);
			}
			else if (isset($custom_data[$table_data['foreign_key']]))
			{
				$identifier_id = $custom_data[$table_data['foreign_key']];
				$identifier_col = $table_data['foreign_key'];
				unset($custom_data[$table_data['foreign_key']]);
			}

			$sql_update = array();

			// Update user custom data table
			if (! empty($table_data['custom_columns']))
			{
				// Match submitted data with the custom data columns set via the config file
				foreach ($table_data['custom_columns'] as $key => $column)
				{
					if (isset($custom_data[$column]))
					{					
						$sql_update[$this->auth->tbl_custom_data[$custom_table]['custom_columns'][$key]] = $custom_data[$column];
						unset($custom_data[$column]);
					}
				}

				if (count($sql_update) > 0)
				{
					if ($identifier_id)
					{
						$this->db->where($identifier_col, $identifier_id)
							->update($table_data['table'], $sql_update);
					}
					else
					{
						$this->set_error_message('custom_data_requires_primary_key', 'config');
					}
				}
			}
		}
	
		return TRUE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * delete_custom_user_data
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function delete_custom_user_data($table = FALSE, $row_id = FALSE)
	{
		if (empty($table) || !is_numeric($row_id))
		{
			return FALSE;
		}
		
		$delete_status = false;
		foreach ($this->auth->tbl_custom_data as $table_data)
		{
			if ($table == $table_data['table'])
			{
				$this->db->delete($table_data['table'], array($table_data['primary_key'] => $row_id));

				$delete_status = ($this->db->affected_rows() > 0) ? true : $delete_status;
			}
		}

		return $delete_status;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * insert_group
	 * Inserts a new user group to the database. If the group has admin privileges this can be set using $is_admin = TRUE.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function insert_group($name, $description = NULL, $is_admin = FALSE, $custom_data = array())
  	{
		if (empty($name))
		{
			return FALSE;
		}
		
		// Set any custom data that may have been submitted.
		$sql_insert = (is_array($custom_data)) ? $custom_data : array();
		
		// Set standard group data.
		$sql_insert[$this->auth->tbl_col_user_group['name']] = $name;
		$sql_insert[$this->auth->tbl_col_user_group['description']] = $description;
		$sql_insert[$this->auth->tbl_col_user_group['admin']] = (int)$is_admin;

		$this->db->insert($this->auth->tbl_user_group, $sql_insert);
		
		return ($this->db->affected_rows() == 1) ? $this->db->insert_id() : FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * update_group
	 * Updates a user group with any submitted data.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function update_group($group_id, $group_data)
  	{
		if (!is_numeric($group_id) || !is_array($group_data))
		{
			return FALSE;
		}
		
		$sql_update = array();		
		foreach ($this->auth->database_config['user_group']['columns'] as $key => $column)
		{
			if (isset($group_data[$column]))
			{
				$sql_update[$this->auth->tbl_col_user_group[$key]] = $group_data[$column];
				unset($group_data[$column]);
			}
		}

		$sql_where = array($this->auth->tbl_col_user_group['id'] => $group_id);
		
		$this->db->update($this->auth->tbl_user_group, $sql_update, $sql_where);
		
		return $this->db->affected_rows() == 1;	
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * delete_group
	 * Deletes a group from the user group table.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function delete_group($sql_where)
  	{
		if (is_numeric($sql_where))
		{
			$sql_where = array($this->auth->tbl_col_user_group['id'] => $sql_where);
		}
				
		$this->db->delete($this->auth->tbl_user_group, $sql_where);
		
		return $this->db->affected_rows() == 1;	
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
		
	/**
	 * insert_privilege
	 * Inserts a new user privilege to the database.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function insert_privilege($name, $description = NULL, $custom_data = array())
  	{
		if (empty($name))
		{
			return FALSE;
		}
		
		// Set any custom data that may have been submitted.
		$sql_insert = (is_array($custom_data)) ? $custom_data : array();
		
		// Set standard privilege data.
		$sql_insert[$this->auth->tbl_col_user_privilege['name']] = $name;
		$sql_insert[$this->auth->tbl_col_user_privilege['description']] = $description;

		$this->db->insert($this->auth->tbl_user_privilege, $sql_insert);
		
		return ($this->db->affected_rows() == 1) ? $this->db->insert_id() : FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * update_privilege
	 * Updates a user privilege with any submitted data.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function update_privilege($privilege_id, $privilege_data)
  	{
		if (!is_numeric($privilege_id) || !is_array($privilege_data))
		{
			return FALSE;
		}
		
		$sql_update = array();		
		foreach ($this->auth->database_config['user_privileges']['columns'] as $key => $column)
		{
			if (isset($privilege_data[$column]))
			{
				$sql_update[$this->auth->tbl_col_user_privilege[$key]] = $privilege_data[$column];
				unset($privilege_data[$column]);
			}
		}
		
		$sql_where = array($this->auth->tbl_col_user_privilege['id'] => $privilege_id);
		
		$this->db->update($this->auth->tbl_user_privilege, $sql_update, $sql_where);
		
		return $this->db->affected_rows() == 1;	
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * delete_privilege
	 * Deletes a privilege from the user privilege table.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function delete_privilege($sql_where)
  	{
		if (is_numeric($sql_where))
		{
			$sql_where = array($this->auth->tbl_col_user_privilege['id'] => $sql_where);
		}
		
		// Get a the ids of all rows that are to be deleted.
		$query = $this->db->get_where($this->auth->tbl_user_privilege, $sql_where);

		if ($query->num_rows() > 0)
		{
			// Delete privileges.
			$this->db->delete($this->auth->tbl_user_privilege, $sql_where);
			
			// Loop through deleted privilege ids and then deleted related user privileges.
			foreach($query->result_array() as $row)
			{
				$sql_where = array($this->auth->tbl_col_user_privilege_users['privilege_id'] => $row[$this->auth->database_config['user_privileges']['columns']['id']]);
				
				$this->db->delete($this->auth->tbl_user_privilege_users, $sql_where);
			}
			
			return TRUE;	
		}
		
		return FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * insert_privilege_user
	 * Inserts a new user privilege user to the database.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function insert_privilege_user($user_id, $privilege_id)
  	{
		if (!is_numeric($user_id) || !is_numeric($privilege_id))
		{
			return FALSE;
		}
		
		// Set standard privilege data.
		$sql_insert = array(
			$this->auth->tbl_col_user_privilege_users['user_id'] => $user_id,
			$this->auth->tbl_col_user_privilege_users['privilege_id'] => $privilege_id
		);

		$this->db->insert($this->auth->tbl_user_privilege_users, $sql_insert);
		
		return ($this->db->affected_rows() == 1) ? $this->db->insert_id() : FALSE;
	}
        
        
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * delete_privilege_user
	 * Deletes a privilege user from the privilege user table.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function delete_privilege_user($sql_where)
  	{
		if (is_numeric($sql_where))
		{
			$sql_where = array($this->auth->tbl_col_user_privilege_users['id'] => $sql_where);
		}
		
		$this->db->delete($this->auth->tbl_user_privilege_users, $sql_where);

		return $this->db->affected_rows() == 1;	
	}
        
        
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * insert_user_group_privilege
	 * Inserts a new user group privilege to the database.
	 *
	 * @return void
	 * @author Rob Hussey / Filou Tschiemer
	 */
	public function insert_user_group_privilege($group_id, $privilege_id)
  	{
		if (!is_numeric($group_id) || !is_numeric($privilege_id))
		{
			return FALSE;
		}
		
		// Set standard privilege data.
		$sql_insert = array(
			$this->auth->tbl_col_user_privilege_groups['group_id'] => $group_id,
			$this->auth->tbl_col_user_privilege_groups['privilege_id'] => $privilege_id
		);

		$this->db->insert($this->auth->tbl_user_privilege_groups, $sql_insert);
		
		return ($this->db->affected_rows() == 1) ? $this->db->insert_id() : FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * delete_user_group_privilege
	 * Deletes a user group privilege from the user privilege group table.
	 *
	 * @return bool
	 * @author Rob Hussey / Filou Tschiemer
	 */
	public function delete_user_group_privilege($sql_where)
  	{
		if (is_numeric($sql_where))
		{
			$sql_where = array($this->auth->tbl_col_user_privilege_groups['id'] => $sql_where);
		}
		
		$this->db->delete($this->auth->tbl_user_privilege_groups, $sql_where);

		return $this->db->affected_rows() == 1;	
	}
	

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// CHECK USER IDENTITIES
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
		
	/**
	 * identity_available
	 * Check identity does not exist in any of the databases identifier columns (Username or Email) set via the config file.
	 * The function also checks that values from different identity columns do not match each other.
	 * Example: If user #1's EMAIL is 'x@y.com' and user #2's USERNAME is 'x@y.com', neither would be able to login to their account.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function identity_available($identity = FALSE, $user_id = FALSE)
	{		
	    if (empty($identity))
	    {
			return FALSE;
	    }

		// Try and get the $user_id from the users current session if not passed to function.
		if (!is_numeric($user_id) && $this->auth->session_data[$this->auth->session_name['user_id']])
		{
			$user_id = $this->auth->session_data[$this->auth->session_name['user_id']];
		}

		// If $user_id is set, remove user from query so their current identity values are not found during the duplicate identity check.
		if (is_numeric($user_id))
		{
			$this->db->where($this->auth->tbl_col_user_account['id'].' != ',$user_id);
		}
		
		// Get identity columns.
		$identity_cols = $this->auth->db_settings['identity_cols'];
				
		// Loop through identity columns to try and find any duplicates in any of the columns.
		$sql_where = '(';
		for ($i = 0; count($identity_cols) > $i; $i++)
		{
			$sql_where .= $identity_cols[$i].' = '.$this->db->escape($identity).' OR ';
		}
		$sql_where = rtrim($sql_where,' OR ').')';

		$this->db->where($sql_where, NULL, FALSE);
			
		return $this->db->count_all_results($this->auth->tbl_user_account) == 0;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * email_available
	 * Check email does not exist in database.
	 * NOTE: This should not be used if the email field is defined in the 'identity_cols' set via the config file.
	 * In this case, use the identity_available() function instead.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function email_available($email = FALSE, $user_id = FALSE)
	{
	    if (empty($email))
	    {
			return FALSE;
	    }

		// Try and get the $user_id from the users current session if not passed to function.
		if (!is_numeric($user_id) && $this->auth->session_data[$this->auth->session_name['user_id']])
		{
			$user_id = $this->auth->session_data[$this->auth->session_name['user_id']];
		}

		// If $user_id is set, remove user from query so their current email is not found during the duplicate email check.
		if (is_numeric($user_id))
		{
			$this->db->where($this->auth->tbl_col_user_account['id'].' != ',$user_id);
		}
		
	    return $this->db->where($this->auth->tbl_col_user_account['email'], $email)
			->count_all_results($this->auth->tbl_user_account) == 0;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * username_available
	 * Check username does not exist in database.
	 * NOTE: This should not be used if the username field is defined in the 'identity_cols' set via the config file.
	 * In this case, use the identity_available() function instead.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function username_available($username = FALSE, $user_id = FALSE)
	{
	    if (empty($username))
	    {
			return FALSE;
	    }
		
		// Try and get the $user_id from the users current session if not passed to function.
		if (!is_numeric($user_id) && $this->auth->session_data[$this->auth->session_name['user_id']])
		{
			$user_id = $this->auth->session_data[$this->auth->session_name['user_id']];
		}

		// If $user_id is set, remove user from query so their current username is not found during the duplicate username check.
		if (is_numeric($user_id))
		{
			$this->db->where($this->auth->tbl_col_user_account['id'].' != ',$user_id);
		}

		return $this->db->where($this->auth->tbl_col_user_account['username'], $username)
			->count_all_results($this->auth->tbl_user_account) == 0;
	}


	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// USER TASK METHODS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * activate_user
	 * Activates a users account allowing them to login to their account. 
	 * If $verify_token = TRUE, a valid $activation_token must also be submitted.
	 *
	 * @return void
	 * @author Rob Hussey
	 * @author Mathew Davies
	 */
	public function activate_user($user_id, $activation_token = FALSE, $verify_token = TRUE, $clear_token = TRUE)
	{
		if ($activation_token)
		{
			// Confirm activation token is 40 characters long (length of sha1).
			if ($verify_token && strlen($activation_token) != 40)
			{
				return FALSE;
			}
			// Verify that $activation_token matches database record.
			else if ($verify_token && strlen($activation_token) == 40)
			{
				$sql_where = array(
					$this->auth->tbl_col_user_account['id'] => $user_id,
					$this->auth->tbl_col_user_account['activation_token'] => $activation_token
				);

				$query = $this->db->where($sql_where)
					->get($this->auth->tbl_user_account);

				if ($query->num_rows() !== 1)
				{
					return FALSE;
				}
			}
		}
		
		if ($clear_token)
		{
			$sql_update[$this->auth->tbl_col_user_account['activation_token']] = '';
		}
		$sql_update[$this->auth->tbl_col_user_account['active']] = 1;

		$this->db->update($this->auth->tbl_user_account, $sql_update, array($this->auth->tbl_col_user_account['id'] => $user_id));
							
	    return $this->db->affected_rows() == 1;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * deactivate_user
	 * Deactivates a users account, preventing them from logging in.
	 *
	 * @return void
	 * @author Rob Hussey
	 * @author Mathew Davies
	 */
	public function deactivate_user($user_id)
	{
	    if (empty($user_id))
	    {
			return FALSE;
	    }

	    $activation_token = sha1($this->generate_token(20));

	    $sql_update = array(
			$this->auth->tbl_col_user_account['activation_token'] => $activation_token,
			$this->auth->tbl_col_user_account['active'] => 0
	    );

		$this->db->update($this->auth->tbl_user_account, $sql_update, array($this->auth->tbl_col_user_account['id'] => $user_id));

	    return $this->db->affected_rows() == 1;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * verify_password
	 * Verify that a submitted password matches a user database record.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function verify_password($identity, $verify_password)
	{
		if (empty($identity) || empty($verify_password))
		{
			return FALSE;
		}
				
		$sql_select = array(
			$this->auth->tbl_col_user_account['password'],
			$this->auth->tbl_col_user_account['salt']
		);
		
		$query = $this->db->select($sql_select)
			->where($this->auth->primary_identity_col, $identity)
			->limit(1)
			->get($this->auth->tbl_user_account);
				 
	    $result = $query->row();

	    if ($query->num_rows() !== 1)
	    {
			return FALSE;
	    }
				
		$database_password = $result->{$this->auth->database_config['user_acc']['columns']['password']};
		$database_salt = $result->{$this->auth->database_config['user_acc']['columns']['salt']};
		$static_salt = $this->auth->auth_security['static_salt'];
		
		require_once(APPPATH.'libraries/phpass/PasswordHash.php');				
		$hash_token = new PasswordHash(8, FALSE);
					
		return $hash_token->CheckPassword($database_salt . $verify_password . $static_salt, $database_password);
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * change_password
	 * Validates a submitted 'Current' password against the database, if valid, the database is updated with the 'New' password. 
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function change_password($identity, $current_password, $new_password)
	{		
		// Verify current password matches
	    if ($this->verify_password($identity, $current_password))
	    {
			// Remove 'Remember me' database sessions so all remembered instances have to re-login, whilst maintaining current login session
			$user_id = $this->auth->session_data[$this->auth->session_name['user_id']];
			
			if ($session_token = $this->auth->session_data[$this->auth->session_name['login_session_token']])
			{
				$this->db->where($this->auth->tbl_col_user_session['token'].' != ', $session_token);
			}
			$this->db->where($this->auth->tbl_col_user_session['user_id'],$user_id);			
			$this->db->delete($this->auth->tbl_user_session);
			
			// Get users salt.
			$sql_select = $this->auth->tbl_col_user_account['salt'];

			$sql_where = array(
				$this->auth->primary_identity_col => $identity
			);
		
			$user = $this->get_users($sql_select, $sql_where)->row();
			
			// Create hash of password and store.
			$hash_new_password = $this->generate_hash_token($new_password, $user->{$this->auth->database_config['user_acc']['columns']['salt']}, TRUE);
			
			$sql_update[$this->auth->tbl_col_user_account['password']] = $hash_new_password;

			$sql_where[$this->auth->primary_identity_col] = $identity;

			$this->db->update($this->auth->tbl_user_account, $sql_update, $sql_where);

			return $this->db->affected_rows() == 1;
	    }

	    return FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * forgotten_password
	 * Inserts a forgotten password token.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function forgotten_password($identity)
	{
	    if (empty($identity))
	    {
			return FALSE;
	    }
	
		// Generate forgotten password token.
		$hash_token = $this->generate_hash_token($this->generate_token());
		
		// Set forgotten password token expiry time if defined by config file.
		if ($this->auth->auth_security['expire_forgotten_password'] > 0)
		{
			$expire_time = (60 * $this->auth->auth_security['expire_forgotten_password']); // 60 Secs * expire minutes.
			$this->db->set($this->auth->tbl_col_user_account['forgot_password_expire'], 
				$this->database_date_time($expire_time));
		}

		$this->db->set($this->auth->tbl_col_user_account['forgot_password_token'], $hash_token)
			->where($this->auth->primary_identity_col, $identity)
			->update($this->auth->tbl_user_account);
	
	    return $this->db->affected_rows() == 1;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###

	/**
	 * validate_forgotten_password_token
	 * Validates that a submitted Forgotten Password Token matches the database record and has not expired.
	 *
	 * @return bool
	 * @author by Rob Hussey
	 */
	public function validate_forgotten_password_token($user_id, $token)
	{
	    // Confirm token is 40 characters long (length of sha1).
		if (!is_numeric($user_id) || strlen($token) !== 40)
	    {
			return FALSE;
	    }
	
		$sql_where = array(
			$this->auth->tbl_col_user_account['id'] => $user_id,
			$this->auth->tbl_col_user_account['forgot_password_token'] => $token
		);
		
		// Check Forgotten Password Token hasn't expired, defined via config file.
		if ($this->auth->auth_security['expire_forgotten_password'] > 0)
		{
			$sql_where[$this->auth->tbl_col_user_account['forgot_password_expire'].' > '] = $this->database_date_time();
		}
		
	    $this->db->where($sql_where);
		
		return $this->db->count_all_results($this->auth->tbl_user_account) > 0;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###
	
	/**
	 * change_forgotten_password
	 * Changes a forgotten password to either a new submitted password, or it generates a new one.
	 *
	 * @return string
	 * @author Rob Hussey
	 */
	public function change_forgotten_password($user_id, $token, $new_password = FALSE, $database_salt = FALSE)
	{
	    // Confirm token is 40 characters long (length of sha1)
		if (!is_numeric($user_id) || strlen($token) !== 40) 
	    {
			return FALSE;
	    }
		
		// If forgotten password token matches and has not expired (expiry set via config)
	    if ($this->validate_forgotten_password_token($user_id, $token))
	    {
			// Delete any user 'Remember me' sessions
			$this->delete_database_login_session($user_id);
		
			// Create new password if not set
			if (!$new_password)
			{
				$new_password = $this->generate_token();
			}
						
			$hashed_new_password = $this->generate_hash_token($new_password, $database_salt, TRUE);
			
			$sql_update = array(
				$this->auth->tbl_col_user_account['password'] => $hashed_new_password,
				$this->auth->tbl_col_user_account['forgot_password_token'] => '',
				$this->auth->tbl_col_user_account['forgot_password_expire'] => 0
			);
			
			$sql_where = array(
				$this->auth->tbl_col_user_account['id'] => $user_id,
				$this->auth->tbl_col_user_account['forgot_password_token'] => $token
			);
			
			$this->db->update($this->auth->tbl_user_account, $sql_update, $sql_where);

			if ($this->db->affected_rows() == 1)
			{
				return $new_password;
			}		
	    }

	    return FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * set_update_email_token
	 * Inserts a Update Email Token and stores the new email address pending activation.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function set_update_email_token($user_id, $new_email)
	{
	    if (empty($user_id) || (empty($new_email)))
	    {
			return FALSE;
	    }
		
		$sql_update = array(
			$this->auth->tbl_col_user_account['update_email_token'] => $this->generate_hash_token($this->generate_token()),
			$this->auth->tbl_col_user_account['update_email'] => $new_email	
		);
		
		$sql_where[$this->auth->tbl_col_user_account['id']] = $user_id;

		$this->db->update($this->auth->tbl_user_account, $sql_update, $sql_where);
	
	    return $this->db->affected_rows() == 1;
	}
	
	/**
	 * verify_updated_email
	 * Verifies a submitted $update_email_token and updates their account with the new email address.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function verify_updated_email($user_id, $update_email_token)
	{
		if (empty($user_id) || empty($update_email_token))
		{
			$this->flexi_auth_model->set_error_message('update_unsuccessful', 'config');
			return FALSE;
		}
		
		// Get user information.
		$sql_select = array(
			$this->auth->tbl_col_user_account['update_email_token'],
			$this->auth->tbl_col_user_account['update_email']
		);
		
		$sql_where[$this->auth->tbl_col_user_account['id']] = $user_id;
		
		$user = $this->flexi_auth_model->get_users($sql_select, $sql_where)->row();

		if (!is_object($user))
		{
			$this->flexi_auth_model->set_error_message('update_unsuccessful', 'config');
			return FALSE;
		}
		
		$database_email_token = $user->{$this->auth->database_config['user_acc']['columns']['update_email_token']};
		$new_email = $user->{$this->auth->database_config['user_acc']['columns']['update_email']};
		
		// Check if token in database matches the submitted token.
		if ($database_email_token == $update_email_token)
		{
			$sql_update = array(
				$this->auth->tbl_col_user_account['email'] => $new_email,
				$this->auth->tbl_col_user_account['update_email_token'] => '',
				$this->auth->tbl_col_user_account['update_email'] => ''
			);
			
			$this->db->update($this->auth->tbl_user_account, $sql_update, $sql_where);

			if ($this->db->affected_rows() == 1)
			{
				// Update users current session identifier if the primary identity column is the users email.
				if ($this->auth->primary_identity_col == $this->auth->tbl_col_user_account['email'])
				{
					$this->flexi_auth_model->update_session_identifier($user_id, $new_email);
				}
			}
			
			return TRUE;
		}
		
		return FALSE;
	}
			

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// GET USER / GROUP / PRIVILEGE METHODS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
		
	/**
	 * get_primary_identity
	 * Looks-up database identity columns and return users primary identifier.
	 *
	 * @return string
	 * @author Rob Hussey
	 */
	public function get_primary_identity($identity)
	{
		if (empty($identity) || !is_string($identity))
		{
			return FALSE;
		}
			
		$identity_cols = $this->auth->db_settings['identity_cols'];

		// Loop through database identity columns.
		for ($i = 0; count($identity_cols) > $i; $i++) 
		{
			$this->db->or_where($identity_cols[$i], $identity);
		}
		
		$query = $this->db->select($this->auth->primary_identity_col)
			->get($this->auth->tbl_user_account);
		
		// Return users primary identity.
		if ($query->num_rows() == 1)
		{
			return $query->row()->{$this->auth->db_settings['primary_identity_col']};
		}
		return FALSE;
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * search_users
	 * Compare a search query against user columns defined in the config file.
	 *
	 * @return object
	 * @author Rob Hussey
	 */
	public function search_users($search_query = FALSE, $exact_match = FALSE, $sql_select = FALSE, $sql_where = FALSE, $sql_group_by = TRUE)
	{
		if (!empty($search_query))
		{
			// Get user table columns to be searched, set via config file.
			$user_cols = $this->auth->db_settings['search_user_cols'];

			// Create a concatenated string of user columns to search against.
			$concat_cols = "(CONCAT_WS(' '";
			foreach ($user_cols as $column)
			{
				$concat_cols .= ', '.$column;
			}

			// Convert search query to array if it isn't already.
			$query_terms = (is_array($search_query)) ? $search_query : explode(' ', $search_query);	
			
			// Define whether to use 'AND' or 'OR' condition.
			$sql_condition = ($exact_match) ? ' AND ' : ' OR ';
			
			// Create array of user column data and each search query term.
			$i = 0;
			$sql_like = "(";
			foreach ($query_terms as $term)
			{
				$sql_like .= $concat_cols.", ".$i++.") LIKE '%".$this->db->escape_like_str($term)."%')".$sql_condition;
			}
			$sql_like = rtrim($sql_like, $sql_condition).")";
			
			// Set SQL WHERE LIKE statement to be passed to get_users() function.
			$this->db->where($sql_like, NULL, FALSE);
		}
		
		return $this->get_users($sql_select, $sql_where, $sql_group_by);
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * get_unactivated_users
	 * Cleanup function to get unactivated users from database within expiry period.
	 * These can then be deleted using the library delete_unactivated_users() function.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function get_unactivated_users($inactive_days = 28, $sql_select = FALSE, $sql_where = FALSE)
	{
		if (!is_numeric($inactive_days))
		{
			return FALSE;
		}

		// SQL SELECT columns.
		if (!empty($sql_select))
		{
			$this->db->select($sql_select);
		}
		
		// SQL WHERE columns.
		if (!empty($sql_where))
		{
			$this->db->where($sql_where);
		}
		
		// Do not delete accounts added within set $inactive_days.
		$inactive_days = (60 * 60 * $inactive_days);
		$expire_date = $this->database_date_time(-$inactive_days);
		
		$sql_where = array(
			$this->auth->tbl_col_user_account['active'] => 0,
			$this->auth->tbl_col_user_account['date_added'].' < ' => $expire_date
		);
				
		$this->db->where($sql_where);
		
		return $this->get_users($sql_select);
	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * get_groups
	 * Returns a list of user groups matching the $sql_where condition.
	 *
	 * @return object
	 * @author Rob Hussey
	 */
	public function get_groups($sql_select = FALSE, $sql_where = FALSE)
  	{
		// Set any custom defined SQL statements.
		$this->flexi_auth_lite_model->set_custom_sql_to_db($sql_select, $sql_where);
		
	    return $this->db->get($this->auth->tbl_user_group);
  	}

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * get_privileges
	 * Returns a list of all privileges matching the $sql_where condition.
	 *
	 * @return void
	 * @author Rob Hussey
	 */
	public function get_privileges($sql_select, $sql_where)
	{
		// Set any custom defined SQL statements.
		$this->flexi_auth_lite_model->set_custom_sql_to_db($sql_select, $sql_where);

		return $this->db->get($this->auth->tbl_user_privilege);       
	}

	/**
	 * get_user_privileges
	 * Returns a list of user privileges matching the $sql_where condition.
	 *
	 * @return void
	 * @author Rob Hussey
	 */
	public function get_user_privileges($sql_select, $sql_where)
	{
		// Set any custom defined SQL statements.
		$this->flexi_auth_lite_model->set_custom_sql_to_db($sql_select, $sql_where);
		
		return $this->db->from($this->auth->tbl_user_privilege)
			->join($this->auth->tbl_user_privilege_users, $this->auth->tbl_col_user_privilege['id'].' = '.$this->auth->tbl_col_user_privilege_users['privilege_id'])
			->get();
	}
       
	/**
	 * get_user_group_privileges
	 * Returns a list of user group privileges matching the $sql_where condition.
	 *
	 * @return void
	 * @author Rob Hussey / Filou Tschiemer
	 */
	public function get_user_group_privileges($sql_select, $sql_where)
	{
		// Set any custom defined SQL statements.
		$this->flexi_auth_lite_model->set_custom_sql_to_db($sql_select, $sql_where);
		
		return $this->db->from($this->auth->tbl_user_privilege)
			->join($this->auth->tbl_user_privilege_groups, $this->auth->tbl_col_user_privilege['id'].' = '.$this->auth->tbl_col_user_privilege_groups['privilege_id'])
			->get();
	}

	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// LOGIN / VALIDATION METHODS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	
	/**
	 * login
	 * Verifies a users identity and password, if valid, they are logged in.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function login($identity = FALSE, $password = FALSE, $remember_user = FALSE)
	{	
		if (empty($identity) || empty($password) || (!$identity = $this->get_primary_identity($identity)))
	    {
			return FALSE;
	    }
		
		// Check if login attempts are being counted.
		if ($this->auth->auth_security['login_attempt_limit'] > 0)
		{
			// Check user has not exceeded login attempts.
			if ($this->login_attempts_exceeded($identity))
			{
				$this->set_error_message('login_attempts_exceeded', 'config');
				return FALSE;
			}
		}
		
		$sql_select = array(
			$this->auth->primary_identity_col, 
			$this->auth->tbl_col_user_account['id'], 
			$this->auth->tbl_col_user_account['password'], 
			$this->auth->tbl_col_user_account['group_id'], 
			$this->auth->tbl_col_user_account['activation_token'], 
			$this->auth->tbl_col_user_account['active'], 
			$this->auth->tbl_col_user_account['suspend'], 
			$this->auth->tbl_col_user_account['last_login_date'], 
			$this->auth->tbl_col_user_account['failed_logins']
		);
		
		$sql_where = array($this->auth->primary_identity_col => $identity);
		
		// Set any custom defined SQL statements.
		$this->flexi_auth_lite_model->set_custom_sql_to_db();

		$query = $this->db->select($sql_select)
			->where($sql_where)
			->get($this->auth->tbl_user_account);
		
		###+++++++++++++++++++++++++++++++++###
		
	    // User exists, now validate credentials.
		if ($query->num_rows() == 1)
	    {	
			$user = $query->row();
			
			// If an activation time limit is defined by config file and account hasn't been activated by email.
			if ($this->auth->auth_settings['account_activation_time_limit'] > 0 && 
				!empty($user->{$this->auth->database_config['user_acc']['columns']['activation_token']}))
			{
				if (!$this->validate_activation_time_limit($user->{$this->auth->database_config['user_acc']['columns']['last_login_date']}))
				{
					$this->set_error_message('account_requires_activation', 'config');
					return FALSE;
				}
			}

			// Check whether account has been activated.
			if ($user->{$this->auth->database_config['user_acc']['columns']['active']} == 0)
			{
				$this->set_error_message('account_requires_activation', 'config');
				return FALSE;
			}
			
			// Check if account has been suspended.
			if ($user->{$this->auth->database_config['user_acc']['columns']['suspend']} == 1)
			{
				$this->set_error_message('account_suspended', 'config');
				return FALSE;
			}
			
			// Verify submitted password matches database.
			if ($this->verify_password($identity, $password))
			{
				// Reset failed login attempts.
				if ($user->{$this->auth->database_config['user_acc']['columns']['failed_logins']} > 0)
				{
					$this->reset_login_attempts($identity);
				}
				
				// Set user login sessions.
				if ($this->set_login_sessions($user, TRUE))
				{
					// Set 'Remember me' cookie and database record if checked by user.
					if ($remember_user)
					{
						$this->remember_user($user->{$this->auth->database_config['user_acc']['columns']['id']});
					}
					// Else, ensure any existing 'Remember me' cookies are deleted.
					// This can occur if the user logs in via password, whilst already logged in via a "Remember me" cookie. 
					else
					{
						$this->flexi_auth_lite_model->delete_remember_me_cookies();
					}
					return TRUE;
				}
			}
			// Password does not match, log the failed login attempt if defined via the config file.
			else if ($this->auth->auth_security['login_attempt_limit'] > 0)
			{				
				$attempts = $user->{$this->auth->database_config['user_acc']['columns']['failed_logins']};

				// Increment failed login attempts.
				$this->increment_login_attempts($identity, $attempts);
			}
	    }
		
	    return FALSE;
	}
	
	/**
	 * login_remembered_user
	 *
	 * @return bool
	 * @author Rob Hussey
	 * @author Ben Edmunds
	 */
	public function login_remembered_user()
	{
	    if (!get_cookie($this->auth->cookie_name['user_id']) || !get_cookie($this->auth->cookie_name['remember_series']) || 
			!get_cookie($this->auth->cookie_name['remember_token']))
	    {
		    return FALSE;
	    }

		$user_id = get_cookie($this->auth->cookie_name['user_id']);
		$remember_series = get_cookie($this->auth->cookie_name['remember_series']);
		$remember_token = get_cookie($this->auth->cookie_name['remember_token']);
		
		$sql_select = array(
			$this->auth->primary_identity_col,
			$this->auth->tbl_col_user_account['id'], 
			$this->auth->tbl_col_user_account['group_id'], 
			$this->auth->tbl_col_user_account['activation_token'], 
			$this->auth->tbl_col_user_account['last_login_date']
		);

		// Database session tokens are hashed with user-agent to 'help' invalidate hijacked cookies used from different browser.
		$sql_where = array(
			$this->auth->tbl_col_user_account['id'] => $user_id,
			$this->auth->tbl_col_user_account['active'] => 1,
			$this->auth->tbl_col_user_account['suspend'] => 0,
			$this->auth->tbl_col_user_session['series'] => $this->hash_cookie_token($remember_series),
			$this->auth->tbl_col_user_session['token'] => $this->hash_cookie_token($remember_token),
			$this->auth->tbl_col_user_session['date'].' > ' => $this->database_date_time(-$this->auth->auth_security['user_cookie_expire'])
		);

		$query = $this->db->select($sql_select)
			->from($this->auth->tbl_user_account)
			->join($this->auth->tbl_user_session, $this->auth->tbl_join_user_account.' = '.$this->auth->tbl_join_user_session)
			->where($sql_where)
			->get();
			
		###+++++++++++++++++++++++++++++++++###

	    // If user exists.
	    if ($query->num_rows() == 1)
	    {
			$user = $query->row();
		
			// If an activation time limit is defined by config file and account hasn't been activated by email.
			if ($this->auth->auth_settings['account_activation_time_limit'] > 0 && 
				!empty($user->{$this->auth->database_config['user_acc']['columns']['activation_token']}))
			{
				if (!$this->validate_activation_time_limit($user->{$this->auth->database_config['user_acc']['columns']['last_login_date']}))
				{
					$this->set_error_message('account_requires_activation', 'config');
					return FALSE;
				}
			}

			// Set user login sessions.
			if ($this->set_login_sessions($user))
			{
				// Extend 'Remember me' if defined by config file.
				if ($this->auth->auth_security['extend_cookies_on_login'])
				{
					$this->remember_user($user->{$this->auth->database_config['user_acc']['columns']['id']});
				}
				return TRUE;
			}
	    }
		
		// 'Remember me' has been unsuccessful, for security, remove any existing cookies and database sessions.
		$this->delete_database_login_session($user_id);

	    return FALSE;
	}

	/**
	 * login_via_ajax
	 * Attempt to log a user in via ajax.
	 * This example is a much more simplified version of the above 'login' function example as it just returns a boolean value of
	 * whether or not the submitted details successfully logged a user in - no redirects or status messages are set.
	 */
	function login_via_ajax()
	{
		$remember_user = ($this->input->post('remember_me') == 1);

		// Verify login data.
		return $this->flexi_auth->login($this->input->post('login_identity'), $this->input->post('login_password'), $remember_user);
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// Account Registration
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * register_account
	 * Create a new user account. 
	 * Then if defined via the '$instant_activate' var, automatically log the user into their account.
	 */
	function register_account()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		// The custom rules 'identity_available' and 'validate_password' can be found in '../libaries/MY_Form_validation.php'.
		$validation_rules = array(
			array('field' => 'register_first_name', 'label' => 'First Name', 'rules' => 'required'),
			array('field' => 'register_last_name', 'label' => 'Last Name', 'rules' => 'required'),
			array('field' => 'register_phone_number', 'label' => 'Phone Number', 'rules' => 'required'),
			array('field' => 'register_newsletter', 'label' => 'Newsletter', 'rules' => 'integer'),
			array('field' => 'register_email_address', 'label' => 'Email Address', 'rules' => 'required|valid_email|identity_available'),
			array('field' => 'register_username', 'label' => 'Username', 'rules' => 'required|min_length[4]|identity_available'),
			array('field' => 'register_password', 'label' => 'Password', 'rules' => 'required|validate_password'),
			array('field' => 'register_confirm_password', 'label' => 'Confirm Password', 'rules' => 'required|matches[register_password]')
		);

		$this->form_validation->set_rules($validation_rules);

		// Run the validation.
		if ($this->form_validation->run())
		{
			// Get user login details from input.
			$email = $this->input->post('register_email_address');
			$username = $this->input->post('register_username');
			$password = $this->input->post('register_password');
			
			// Get user profile data from input.
			// You can add whatever columns you need to customise user tables.
			$profile_data = array(
				'upro_first_name' => $this->input->post('register_first_name'),
				'upro_last_name' => $this->input->post('register_last_name'),
				'upro_phone' => $this->input->post('register_phone_number'),
				'upro_newsletter' => $this->input->post('register_newsletter')
			);
			
			// Set whether to instantly activate account.
			// This var will be used twice, once for registration, then to check if to log the user in after registration.
			$instant_activate = FALSE;
	
			// The last 2 variables on the register function are optional, these variables allow you to:
			// #1. Specify the group ID for the user to be added to (i.e. 'Moderator' / 'Public'), the default is set via the config file.
			// #2. Set whether to automatically activate the account upon registration, default is FALSE. 
			// Note: An account activation email will be automatically sent if auto activate is FALSE, or if an activation time limit is set by the config file.
			$response = $this->flexi_auth->insert_user($email, $username, $password, $profile_data, 1, $instant_activate);

			if ($response)
			{
				// This is an example 'Welcome' email that could be sent to a new user upon registration.
				// Bear in mind, if registration has been set to require the user activates their account, they will already be receiving an activation email.
				// Therefore sending an additional email welcoming the user may be deemed unnecessary.
				$email_data = array('identity' => $email);
				$this->flexi_auth->send_email($email, 'Welcome', 'registration_welcome.tpl.php', $email_data);
				// Note: The 'registration_welcome.tpl.php' template file is located in the '../views/includes/email/' directory defined by the config file.
				
				###+++++++++++++++++###
				
				// Save any public status or error messages (Whilst suppressing any admin messages) to CI's flash session data.
				$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
				
				// This is an example of how to log the user into their account immeadiately after registering.
				// This example would only be used if users do not have to authenticate their account via email upon registration.
				if ($instant_activate && $this->flexi_auth->login($email, $password))
				{
					// Redirect user to public dashboard.
					redirect('auth_public/dashboard');
				}
				
				// Redirect user to login page
				redirect('auth');
			}
		}

		// Set validation errors.
		$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');

		return FALSE;
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// Account Activation
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * resend_activation_token
	 * Resends a new account activation token to a users email address.
	 */
	function resend_activation_token()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('activation_token_identity', 'Identity (Email / Login)', 'required');
		
		// Run the validation.
		if ($this->form_validation->run())
		{					
			// Verify identity and resend activation token.
			$response = $this->flexi_auth->resend_activation_token($this->input->post('activation_token_identity'));
			
			// Save any public status or error messages (Whilst suppressing any admin messages) to CI's flash session data.
			$this->session->set_flashdata('message', $this->flexi_auth->get_messages());

			// Redirect user.
			($response) ? redirect('auth') : redirect('auth/resend_activation_token');
		}
		else
		{	
			// Set validation errors.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			
			return FALSE;
		}
	}
	
	/**
	 * manual_reset_forgotten_password
	 * This example lets the user manually reset their password rather than automatically sending them a new random password via email.
	 * The function validates the user via a token within the url of the current site page, then validates their current and newly submitted passwords are valid.
	 */
	function manual_reset_forgotten_password($user_id, $token)
	{
		$this->load->library('form_validation');

		// Set validation rules
		// The custom rule 'validate_password' can be found in '../libaries/MY_Form_validation.php'.
		$validation_rules = array(
			array('field' => 'new_password', 'label' => 'New Password', 'rules' => 'required|validate_password|matches[confirm_new_password]'),
			array('field' => 'confirm_new_password', 'label' => 'Confirm Password', 'rules' => 'required')
		);
		
		$this->form_validation->set_rules($validation_rules);

		// Run the validation.
		if ($this->form_validation->run())
		{
			// Get password data from input.
			$new_password = $this->input->post('new_password');
		
			// The 'forgotten_password_complete()' function is used to either manually set a new password, or to auto generate a new password.
			// For this example, we want to manually set a new password, so ensure the 3rd argument includes the $new_password var, or else a  new password.
			// The function will then validate the token exists and set the new password.
			$this->flexi_auth->forgotten_password_complete($user_id, $token, $new_password);

			// Save any public status or error messages (Whilst suppressing any admin messages) to CI's flash session data.
			$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
			
			redirect('auth');
		}
		else
		{		
			// Set validation errors.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			
			return FALSE;
		}
	}
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// Manage User Account
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * update_account
	 * Updates a users account and profile data.
	 */
	function update_account()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		// The custom rule 'identity_available' can be found in '../libaries/MY_Form_validation.php'.
		$validation_rules = array(
			array('field' => 'update_first_name', 'label' => 'First Name', 'rules' => 'required'),
			array('field' => 'update_last_name', 'label' => 'Last Name', 'rules' => 'required'),
			array('field' => 'update_phone_number', 'label' => 'Phone Number', 'rules' => 'required'),
			array('field' => 'update_newsletter', 'label' => 'Newsletter', 'rules' => 'integer'),
			array('field' => 'update_email', 'label' => 'Email', 'rules' => 'required|valid_email|identity_available'),
			array('field' => 'update_username', 'label' => 'Username', 'rules' => 'min_length[4]|identity_available')
		);
		
		$this->form_validation->set_rules($validation_rules);
		
		// Run the validation.
		if ($this->form_validation->run())
		{
			// Note: This example requires that the user updates their email address via a separate page for verification purposes.

			// Get user id from session to use in the update function as a primary key.
			$user_id = $this->flexi_auth->get_user_id();
			
			// Get user profile data from input.
			// IMPORTANT NOTE: As we are updating multiple tables (The main user account and user profile tables), it is very important to pass the
			// primary key column and value in the $profile_data for any custom user tables being updated, otherwise, the function will not
			// be able to identify the correct custom data row.
			// In this example, the primary key column and value is 'upro_uacc_fk' => $user_id.
			$profile_data = array(
				'upro_uacc_fk' => $user_id,
				'upro_first_name' => $this->input->post('update_first_name'),
				'upro_last_name' => $this->input->post('update_last_name'),
				'upro_phone' => $this->input->post('update_phone_number'),
				'upro_newsletter' => $this->input->post('update_newsletter'),
				$this->flexi_auth->db_column('user_acc', 'email') => $this->input->post('update_email'),
				$this->flexi_auth->db_column('user_acc', 'username') => $this->input->post('update_username')
			);
			
			// If we were only updating profile data (i.e. no email or username included), we could use the 'update_custom_user_data()' function instead.
			$response = $this->flexi_auth->update_user($user_id, $profile_data);
			
			// Save any public status or error messages (Whilst suppressing any admin messages) to CI's flash session data.
			$this->session->set_flashdata('message', $this->flexi_auth->get_messages());

			// Redirect user.
			($response) ? redirect('auth_public/dashboard') : redirect('auth_public/update_account');
		}
		else
		{		
			// Set validation errors.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			
			return FALSE;
		}
	}


	/**
	 * send_new_email_activation
	 * This demo has 2 methods of updating a logged in users email address.
	 * The first option simply allows the users to change their email address along with the rest of their account data via entering it into a form fields.
	 * The second option requires users to verify their email address via clicking a link that is sent to that same email address.
	 * The purpose of the second option is to prevent users entering a mispelt email address, which would then prevent the user from logging back in.
	 */
	function send_new_email_activation()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		// The custom rule 'identity_available' can be found in '../libaries/MY_Form_validation.php'.
		$validation_rules = array(
			array('field' => 'email_address', 'label' => 'Email', 'rules' => 'required|valid_email|identity_available'),
		);
		
		$this->form_validation->set_rules($validation_rules);

		// Run the validation.
		if ($this->form_validation->run())
		{
			$user_id = $this->flexi_auth->get_user_id();
			
			// The 'update_email_via_verification()' function generates a verification token that is then emailed to the user.
			$this->flexi_auth->update_email_via_verification($user_id, $this->input->post('email_address'));
			
			// Save any public status or error messages (Whilst suppressing any admin messages) to CI's flash session data.
			$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
			
			redirect('auth_public/dashboard');
		}
		else
		{		
			// Set validation errors.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			
			return FALSE;
		}
	}
	

	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// Manage User Address Book
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	

	/**
	 * manage_address_book
	 * Loops through a POST array of all address IDs that where checked, and then proceeds to delete the addresses from the users address book.
	 * Note: The address book table ('demo_user_address') is used in this demo as an example of relating additional user data to the auth libraries account tables. 
	 */
	function manage_address_book()
	{
		// Delete addresses.
		if ($delete_addresses = $this->input->post('delete_address'))
		{
			foreach($delete_addresses as $address_id => $delete)
			{
				// Note: As the 'delete_address' input is a checkbox, it will only be present in the $_POST data if it has been checked,
				// therefore we don't need to check the submitted value.
				$this->flexi_auth->delete_custom_user_data('demo_user_address', $address_id);
			}
		}

		// Save any public status or error messages (Whilst suppressing any admin messages) to CI's flash session data.
		$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
		
		// Redirect user.
		redirect('auth_public/manage_address_book');
	}
	
	/**
	 * insert_address
	 * Inserts a new address to the users address book.
	 * Note: The address book table ('demo_user_address') is used in this demo as an example of relating additional user data to the auth libraries account tables. 
	 */
	function insert_address()
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$validation_rules = array(
			array('field' => 'insert_alias', 'label' => 'Address Alias', 'rules' => 'required'),
			array('field' => 'insert_recipient', 'label' => 'Recipient', 'rules' => 'required'),
			array('field' => 'insert_phone_number', 'label' => 'Phone Number', 'rules' => 'required'),
			array('field' => 'insert_address_01', 'label' => 'Address Line #1', 'rules' => 'required'),
			array('field' => 'insert_city', 'label' => 'City / Town', 'rules' => 'required'),
			array('field' => 'insert_county', 'label' => 'County', 'rules' => 'required'),
			array('field' => 'insert_post_code', 'label' => 'Post Code', 'rules' => 'required'),
			array('field' => 'insert_country', 'label' => 'Country', 'rules' => 'required'),
			array('field' => 'insert_company', 'label' => '', 'rules' => ''),
			array('field' => 'insert_address_02', 'label' => '', 'rules' => '')
		);
		
		$this->form_validation->set_rules($validation_rules);

		// Run the validation.
		if ($this->form_validation->run())
		{
			// Get user id from session to use in the insert function as a primary key.
			$user_id = $this->flexi_auth->get_user_id();
			
			// Get user address data from input.
			// You can add whatever columns you need to custom user tables.
			$address_data = array(
				'uadd_alias' => $this->input->post('insert_alias'),
				'uadd_recipient' => $this->input->post('insert_recipient'),
				'uadd_phone' => $this->input->post('insert_phone_number'),
				'uadd_company' => $this->input->post('insert_company'),
				'uadd_address_01' => $this->input->post('insert_address_01'),
				'uadd_address_02' => $this->input->post('insert_address_02'),
				'uadd_city' => $this->input->post('insert_city'),
				'uadd_county' => $this->input->post('insert_county'),
				'uadd_post_code' => $this->input->post('insert_post_code'),
				'uadd_country' => $this->input->post('insert_country')
			);		
	
			$response = $this->flexi_auth->insert_custom_user_data($user_id, $address_data);
			
			// Save any public status or error messages (Whilst suppressing any admin messages) to CI's flash session data.
			$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
			
			// Redirect user.
			($response) ? redirect('auth_public/manage_address_book') : redirect('auth_public/insert_address');
		}
		else
		{		
			// Set validation errors.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			
			return FALSE;
		}
	}
	
	/**
	 * update_address
	 * Updates an address from the users address book.
	 * Note: The address book table ('demo_user_address') is used in this demo as an example of relating additional user data to the auth libraries account tables. 
	 */
	function update_address($address_id)
	{
		$this->load->library('form_validation');

		// Set validation rules.
		$validation_rules = array(
			array('field' => 'update_alias', 'label' => 'Address Alias', 'rules' => 'required'),
			array('field' => 'update_recipient', 'label' => 'Recipient', 'rules' => 'required'),
			array('field' => 'update_phone_number', 'label' => 'Phone Number', 'rules' => 'required'),
			array('field' => 'update_address_01', 'label' => 'Address Line #1', 'rules' => 'required'),
			array('field' => 'update_city', 'label' => 'City / Town', 'rules' => 'required'),
			array('field' => 'update_county', 'label' => 'County', 'rules' => 'required'),
			array('field' => 'update_post_code', 'label' => 'Post Code', 'rules' => 'required'),
			array('field' => 'update_country', 'label' => 'Country', 'rules' => 'required'),
			array('field' => 'update_company', 'label' => '', 'rules' => ''),
			array('field' => 'update_address_02', 'label' => '', 'rules' => '')
		);
		
		$this->form_validation->set_rules($validation_rules);

		// Run the validation.
		if ($this->form_validation->run())
		{
			// Get user address data from input.
			// You can add whatever columns you need to custom user tables.
			$address_id = $this->input->post('update_address_id');
			
			$address_data = array(
				'uadd_alias' => $this->input->post('update_alias'),
				'uadd_recipient' => $this->input->post('update_recipient'),
				'uadd_phone' => $this->input->post('update_phone_number'),
				'uadd_company' => $this->input->post('update_company'),
				'uadd_address_01' => $this->input->post('update_address_01'),
				'uadd_address_02' => $this->input->post('update_address_02'),
				'uadd_city' => $this->input->post('update_city'),
				'uadd_county' => $this->input->post('update_county'),
				'uadd_post_code' => $this->input->post('update_post_code'),
				'uadd_country' => $this->input->post('update_country')
			);		
	
			// For added flexibility, to identify the table and row to update, you can either submit the table name and row id via the 
			// first 2 function arguments, or alternatively, submit the primary column name and row id value via the '$address_data' array.
			// An example of this is commented out just below. When using the second method, the function identifies the table automatically.
			$response = $this->flexi_auth->update_custom_user_data('demo_user_address', $address_id, $address_data);
			
			/**
			 *  Example of updating custom tables using just data within an array.
			 * 	$address_data = array(
			 * 		'uadd_id' => $address_id,
			 *		'uadd_alias' => $this->input->post('update_alias'),
			 *		'uadd_recipient' => $this->input->post('update_recipient')
			 * 		// ... etc ... // 
			 *	);
			 * 	$response = $this->flexi_auth->update_custom_user_data(FALSE, FALSE, $address_data);
			*/
							
			// Save any public status or error messages (Whilst suppressing any admin messages) to CI's flash session data.
			$this->session->set_flashdata('message', $this->flexi_auth->get_messages());
			
			// Redirect user.
			($response) ? redirect('auth_public/manage_address_book') : redirect('auth_public/update_address');
		}
		else
		{		
			// Set validation errors.
			$this->data['message'] = validation_errors('<p class="error_msg">', '</p>');
			
			return FALSE;
		}
	}


	/**
	 * update_last_login
	 * Updates the main user account table with the last time a user logged in and their IP address. 
	 * The data type of the date can be formatted via the config file.
	 *
	 * @return bool
	 * @author Rob Hussey
	 * @author Ben Edmunds
	 */
	public function update_last_login($user_id)
	{
		// Update user IP address and last login date.
		$login_data = array(
			$this->auth->tbl_col_user_account['ip_address'] => $this->input->ip_address(),
			$this->auth->tbl_col_user_account['last_login_date'] => $this->database_date_time()
		);
		
		$this->db->update($this->auth->tbl_user_account, $login_data, array($this->auth->tbl_col_user_account['id'] => $user_id));

	    return $this->db->affected_rows() == 1;
	}
	
	/**
	 * set_login_sessions
	 * Set all login session and database data.
	 *
	 * @return bool
	 * @author Rob Hussey / Filou Tschiemer
	 */
	private function set_login_sessions($user, $logged_in_via_password = FALSE)
	{
		if (!$user)
		{
			return FALSE;
		}
		
		$user_id = $user->{$this->auth->database_config['user_acc']['columns']['id']};
		
		// Regenerate CI session_id on successful login.
		$this->regenerate_ci_session_id();
		
		// Update users last login date.
		$this->update_last_login($user_id);
		
		// Set database and login session token if defined by config file.
		if ($this->auth->auth_security['validate_login_onload'] && ! $this->insert_database_login_session($user_id))
		{
			return FALSE;
		}
		
		// Set verified login session if user logged in via Password rather than 'Remember me'.
		$this->auth->session_data[$this->auth->session_name['logged_in_via_password']] = $logged_in_via_password;
		
		// Set user id and identifier data to session.
		$this->auth->session_data[$this->auth->session_name['user_id']] = $user_id;
		$this->auth->session_data[$this->auth->session_name['user_identifier']] = $user->{$this->auth->db_settings['primary_identity_col']};

		// Get group data.
		$sql_where[$this->auth->tbl_col_user_group['id']] = $user->{$this->auth->database_config['user_acc']['columns']['group_id']};
		
		$group = $this->get_groups(FALSE, $sql_where)->row();
		
		// Set admin status to session.
		$this->auth->session_data[$this->auth->session_name['is_admin']] = ($group->{$this->auth->database_config['user_group']['columns']['admin']} == 1);
		
		$this->auth->session_data[$this->auth->session_name['group']] = 
			array($group->{$this->auth->database_config['user_group']['columns']['id']} => $group->{$this->auth->database_config['user_group']['columns']['name']});
		
		###+++++++++++++++++++++++++++++++++###

		$privilege_sources = $this->auth->auth_settings['privilege_sources'];
		$privileges = array();

		// If 'user' privileges have been defined within the config 'privilege_sources'.
        if (in_array('user', $privilege_sources))
        {
            // Get user privileges.
            $sql_select = array(
                $this->auth->tbl_col_user_privilege['id'],
                $this->auth->tbl_col_user_privilege['name']
            );

            $sql_where = array($this->auth->tbl_col_user_privilege_users['user_id'] => $user_id);

            $query = $this->get_user_privileges($sql_select, $sql_where);

            // Create an array of user privileges.
            if ($query->num_rows() > 0)
            {
                foreach($query->result_array() as $data)
                {
                    $privileges[$data[$this->auth->database_config['user_privileges']['columns']['id']]] = $data[$this->auth->database_config['user_privileges']['columns']['name']];
                }
            }
        }
        
		// If 'group' privileges have been defined within the config 'privilege_sources'.
        if (in_array('group', $privilege_sources))
        {
            // Get group privileges.
            $sql_select = array(
                $this->auth->tbl_col_user_privilege['id'],
                $this->auth->tbl_col_user_privilege['name']
            );

            $sql_where = array($this->auth->tbl_col_user_privilege_groups['group_id'] => $user->{$this->auth->database_config['user_acc']['columns']['group_id']});

            $query = $this->get_user_group_privileges($sql_select, $sql_where);

            // Extend array of user privileges by group privileges.
            if ($query->num_rows() > 0)
            {
                foreach($query->result_array() as $data)
                {
                    $privileges[$data[$this->auth->database_config['user_privileges']['columns']['id']]] = $data[$this->auth->database_config['user_privileges']['columns']['name']];
                }
            }
        }

		// Set user privileges to session.
		$this->auth->session_data[$this->auth->session_name['privileges']] = $privileges;
		
		###+++++++++++++++++++++++++++++++++###
				
		$this->session->set_userdata(array($this->auth->session_name['name'] => $this->auth->session_data));

		return TRUE;
	}	
	
	/**
	 * update_session_identifier
	 * Updates a users current session identifier if they update the database record of their identity (i.e. Change their email).
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function update_session_identifier($user_id, $identity)
	{
		if ($user_id == $this->auth->session_data[$this->auth->session_name['user_id']])
		{
			$this->auth->session_data[$this->auth->session_name['user_identifier']] = $identity;
			$this->session->set_userdata(array($this->auth->session_name['name'] => $this->auth->session_data));
			
			return TRUE;
		}
		return FALSE;
	}
	
	/**
	 * insert_database_login_session
	 * Used in conjunction with $config['validate_login_onload'] set via the config file.
	 * The function inserts a login session token into the database and browser session. 
	 * These two tokens are then compared on every page load to ensure the users session is still valid.
	 *
	 * This method offers more control over login security as you can logout users immediately (By removing their database session or
	 * suspending / deactivating them), rather than having to wait for the users CodeIgniter session to expire.
	 * However, it requires more database calls per page load.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	private function insert_database_login_session($user_id)
	{
	    if (!is_numeric($user_id))
	    {
			return FALSE;
	    }
		
		// Generate session token.
		$session_token = sha1($this->generate_token(20));
		
		$sql_insert = array(
			$this->auth->tbl_col_user_session['user_id'] => $user_id,
			$this->auth->tbl_col_user_session['token'] => $session_token,
			$this->auth->tbl_col_user_session['date'] => $this->database_date_time()
		);

		$this->db->insert($this->auth->tbl_user_session, $sql_insert);
		
	    if ($this->db->affected_rows() > 0)
	    {
			// Create session.
			$this->auth->session_data[$this->auth->session_name['login_session_token']] = $session_token;
			$this->session->set_userdata(array($this->auth->session_name['name'] => $this->auth->session_data));

			// Hash database session token as it will be visible via cookie.
			$hash_session_token = $this->hash_cookie_token($session_token);
							
			// Create cookies to detect if user closes their browser (Defined by config file).
			if ($this->auth->auth_security['logout_user_onclose'])
			{
				set_cookie(array(
					'name' => $this->auth->cookie_name['login_session_token'],
					'value' => $hash_session_token,
					'expire' => 0 // Set to 0 so it expires on browser close.
				));
			}
			// Create a cookie to detect when a user has closed their browser since logging in via password (Defined by config file).
			// If the cookie is not set/valid, a users 'logged in via password' status will be unset.
			else if ($this->auth->auth_security['unset_password_status_onclose'])
			{
				set_cookie(array(
					'name' => $this->auth->cookie_name['login_via_password_token'],
					'value' => $hash_session_token,
					'expire' => 0 // Set to 0 so it expires on browser close.
				));
			}
			
			return TRUE;
		}
		return FALSE;
	}
	
	/**
	 * remember_user
	 * Creates a set of 'Remember me' cookies and inserts a database row containing the cookie session data.
	 *
	 * @return bool
	 * @author Rob Hussey
	 * @author Ben Edmunds
	 */
	private function remember_user($user_id)
	{
	    if (!is_numeric($user_id))
	    {
			return FALSE;
	    }

		// Use existing 'Remember me' series token if it exists.
	    if (get_cookie($this->auth->cookie_name['remember_series']))
		{
			$remember_series = get_cookie($this->auth->cookie_name['remember_series']);
		}
		else
		{
			$remember_series = $this->generate_token(40);
		}
		
	    // Set new 'Remember me' unique token.
		$remember_token = $this->generate_token(40);
		
		// Hash the database session tokens with user-agent to help invalidate hijacked cookies used from different browser.
		$sql_insert = array(
			$this->auth->tbl_col_user_session['user_id'] => $user_id,
			$this->auth->tbl_col_user_session['series'] => $this->hash_cookie_token($remember_series),
			$this->auth->tbl_col_user_session['token'] => $this->hash_cookie_token($remember_token),
			$this->auth->tbl_col_user_session['date'] => $this->database_date_time()
		);

		$this->db->insert($this->auth->tbl_user_session, $sql_insert);
		
		###+++++++++++++++++++++++++++++++++###
		
		// Cleanup and remove the now used 'Remember me' database session if they exist.
		if (get_cookie($this->auth->cookie_name['remember_series']) && get_cookie($this->auth->cookie_name['remember_token']))
		{
			$sql_where = array(
				$this->auth->tbl_col_user_session['user_id'] => $user_id,
				$this->auth->tbl_col_user_session['series'] => 
					$this->hash_cookie_token(get_cookie($this->auth->cookie_name['remember_series'])),
				$this->auth->tbl_col_user_session['token'] => 
					$this->hash_cookie_token(get_cookie($this->auth->cookie_name['remember_token']))
			);

			$this->db->delete($this->auth->tbl_user_session, $sql_where);
		}

		###+++++++++++++++++++++++++++++++++###
		
		// Set new 'Remember me' cookies.
	    if ($this->db->affected_rows() > 0)
	    {
			set_cookie(array(
				'name' => $this->auth->cookie_name['user_id'],
				'value' => $user_id,
				'expire' => $this->auth->auth_security['user_cookie_expire'],
			));

			set_cookie(array(
				'name' => $this->auth->cookie_name['remember_series'],
				'value' => $remember_series,
				'expire' => $this->auth->auth_security['user_cookie_expire'],
			));			

			set_cookie(array(
				'name' => $this->auth->cookie_name['remember_token'],
				'value' => $remember_token,
				'expire' => $this->auth->auth_security['user_cookie_expire'],
			));			
			
			return TRUE;
	    }

		// 'Remember me' has been unsuccessful, for security, remove any existing cookies and database sessions.
		$this->delete_database_login_session($user_id);

	    return FALSE;
	}
		
	/**
	 * validate_activation_time_limit 
	 * Validate whether a non-activatated account is within the activation time limit set via config.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	private function validate_activation_time_limit($last_login)
	{
		if (empty($last_login))
		{
			return FALSE;
		}
	
		// Set account activation expiry time.
		$expire_time = (60 * $this->auth->auth_settings['account_activation_time_limit']); // 60 Secs * expire minutes.		
		
		// Convert if using MySQL time.
		if (strtotime($last_login)) 
		{
			$last_login = strtotime($last_login);
		}
		
		// Account activation time has expired, user must now activate account via email.
		if (($last_login + $expire_time) < time())
		{
			return FALSE;
		}
		
		return TRUE;
	}
	
	/**
	 * ip_login_attempts_exceeded
	 * Validates whether the number of failed login attempts from a unique IP address has exceeded a defined limit.
	 * The function can be used in conjunction with showing a Captcha for users repeatedly failing login attempts.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function ip_login_attempts_exceeded()
	{
		// Compare users IP address against any failed login IP addresses.
		$sql_where = array(
			$this->auth->tbl_col_user_account['failed_login_ip'] => $this->input->ip_address(),
			$this->auth->tbl_col_user_account['failed_logins'].' >= ' => $this->auth->auth_security['login_attempt_limit']
		);	
	
	    $query = $this->db->where($sql_where)
			->get($this->auth->tbl_user_account);
		
		return $query->num_rows() > 0;
	}
	
	/**
	 * login_attempts_exceeded 
	 * Check whether user has made too many failed login attempts within a set time limit.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	private function login_attempts_exceeded($identity)
	{
		if (empty($identity))
		{
			return TRUE;
		}

		$sql_select = array(
			$this->auth->tbl_col_user_account['failed_logins'], 
			$this->auth->tbl_col_user_account['failed_login_ban_date']
		);
		
	    $query = $this->db->select($sql_select)
			->where($this->auth->primary_identity_col, $identity)
			->get($this->auth->tbl_user_account);

		if ($query->num_rows() == 1)
		{
			$user = $query->row();
			
			$attempts = $user->{$this->auth->database_config['user_acc']['columns']['failed_logins']};
			$failed_login_date = $user->{$this->auth->database_config['user_acc']['columns']['failed_login_ban_date']};
			
			// Check if login attempts are acceptable.
			if ($attempts < $this->auth->auth_security['login_attempt_limit'])
			{
				return FALSE;
			}
			// Login attempts exceed limit, now check if user has waited beyond time ban limit to attempt another login.
			else if ($this->database_date_time($this->auth->auth_security['login_attempt_time_ban'], $failed_login_date, TRUE) 
				< $this->database_date_time(FALSE, FALSE, TRUE))
			{
				return FALSE;
			}
		}
		
		return TRUE;
	}
	
	/**
	 * increment_login_attempts
	 * This function is called to log details of when a user has failed a login attempt.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	private function increment_login_attempts($identity, $attempts)
	{
		if (empty($identity) || !is_numeric($attempts))
		{
			return FALSE;
		}
		
		$attempts++;
		$time_ban = 0;
		
		// Length of time ban in seconds.
		if ($attempts >= $this->auth->auth_security['login_attempt_limit'])
		{
			// Set time ban message.
			$this->set_error_message('login_attempts_exceeded', 'config');
			
			$time_ban = $this->auth->auth_security['login_attempt_time_ban'];
		
			// If failed attempts continue for more than 3 times the limit, increase the time ban by a factor of 2.
			if ($attempts >= ($this->auth->auth_security['login_attempt_limit'] * 3))
			{
				$time_ban = ($time_ban * 2);
			}

			// Set time ban as a date.
			$time_ban = $this->database_date_time($time_ban);
		}
		
		// Record users ip address to compare future login attempts.
		$login_data = array(
			$this->auth->tbl_col_user_account['failed_login_ip'] => $this->input->ip_address(),
			$this->auth->tbl_col_user_account['failed_logins'] => $attempts,
			$this->auth->tbl_col_user_account['failed_login_ban_date'] => $time_ban
		);
		
		$this->db->update($this->auth->tbl_user_account, $login_data, array($this->auth->primary_identity_col => $identity));
		
	    return $this->db->affected_rows() == 1;
	}

	/**
	 * reset_login_attempts 
	 * This function is called when a user successfully logs in, it's used to remove any previously logged failed login attempts.
	 * This prevents a user accumulating a login time ban for every failed attempt they make.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	private function reset_login_attempts($identity)
	{
		if (empty($identity))
		{
			return FALSE;
		}
		
		$login_data = array(
			$this->auth->tbl_col_user_account['failed_login_ip'] => '',
			$this->auth->tbl_col_user_account['failed_logins'] => 0,
			$this->auth->tbl_col_user_account['failed_login_ban_date'] => 0
		);
		
		$this->db->update($this->auth->tbl_user_account, $login_data, array($this->auth->primary_identity_col => $identity));
				
	    return $this->db->affected_rows() == 1;
	}
	
	/**
	 * recaptcha
	 * Generates the html for Google reCAPTCHA.
	 * Note: If the reCAPTCHA is located on an SSL secured page (https), set $ssl = TRUE.
	 *
	 * @return string
	 * @author Rob Hussey
	 */
	public function recaptcha($ssl = FALSE)
	{
		$this->load->helper('recaptcha');

		// Get config settings.
		$captcha_theme = $this->auth->auth_security['recaptcha_theme'];
		$captcha_lang = $this->auth->auth_security['recaptcha_language'];
		
		// Set defaults.
		$theme = "theme:'clean',";
		$language = "lang:'en'";
		
		// Set reCAPTCHA theme.
		if (!empty($captcha_theme))
		{
			if ($captcha_theme == 'custom')
			{
				$theme = "theme:'custom', custom_theme_widget:'recaptcha_widget',";
			}
			else
			{
				$theme = "theme:'".$captcha_theme."',";
			}
		}
		
		// Set reCAPTCHA language.
		if (!empty($captcha_lang))
		{
			$language = "lang:'".$captcha_lang."'";
		}
		
		$theme_html = "<script>var RecaptchaOptions = { $theme $language };</script>\n";
		$captcha_html = recaptcha_get_html($this->auth->auth_security['recaptcha_public_key'], NULL, $ssl);

		return $theme_html.$captcha_html;
	}
	
	/**
	 * validate_recaptcha
	 * Validates if a Google reCAPTCHA answer submitted via http POST data is correct.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function validate_recaptcha()
	{
		$this->load->helper('recaptcha');

		$response = recaptcha_check_answer(
			$this->auth->auth_security['recaptcha_private_key'],
			$this->input->ip_address(),
			$this->input->post('recaptcha_challenge_field'),
			$this->input->post('recaptcha_response_field')
		);

		return $response->is_valid;
	}
	
	/**
	 * math_captcha
	 * Basic captcha reliant on maths questions rather than text images.
	 *
	 * @return array
	 * @author Rob Hussey
	 */
	public function math_captcha()
	{
		$min_operand_val = 1;
		$max_operand_val = 20;
		$total_operands = 2;
		$operators = array('+'=>' + ', '-'=>' - ');
		$equation = '';
		
        for ($i = 1; $total_operands >= $i; $i++) 
		{
			$operand = rand($min_operand_val, $max_operand_val);
			$operator = ($i < $total_operands) ? array_rand($operators) : '';			
			$equation .= $operand.$operator;
		}

		// Convert equation symbols to written symbols.
		$captcha['equation'] = str_replace(array_keys($operators), array_values($operators), $equation);
		
		// Convert equation string.
		eval("\$captcha['answer'] = ".$equation.";");
	
		return $captcha;
	}	
	
	
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
	// UTILITY METHODS
	###++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++###	
		
	/**
	 * send_email
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	public function send_email($email_to = NULL, $email_title = NULL, $data = NULL, $template = NULL)
	{
		if (empty($email_to) || empty($data) || empty($template))
		{
			return FALSE;
		}
		
		// Merge any additional template data that has been set via the template_data() function, (Must be called prior to parent function).
		if (!empty($this->auth->template_data['template_data']))
		{
			$data = array_merge($data, (array)$this->auth->template_data['template_data']);
		}
		
		// Overwrite default template file to send email via template_data() function (Must be called prior to parent function).
		if (!empty($this->auth->template_data['template']))
		{
			$template = $this->auth->template_data['template'];
		}
        //disable email sending for localhost
		$this->load->helper('url');
        if (base_url() == 'http://localhost/') { return true; }
        
		$message = $this->load->view($template, $data, TRUE);
		
		$this->load->library('email');
		$this->email->clear();
		$this->email->initialize(array('mailtype' => $this->auth->email_settings['email_type']));
		$this->email->set_newline("\r\n");
		$this->email->from($this->auth->email_settings['reply_email'], $this->auth->email_settings['site_title']);
		$this->email->to($email_to);
		$this->email->subject($this->auth->email_settings['site_title'] ." ". $email_title);
		$this->email->message($message);

        
			
		return $this->email->send();
	}
	
	/**
	 * regenerate_ci_session_id
	 * Regenerate CodeIgniters session id like native PHP session_regenerate_id(TRUE), used whenever a users permissions change.
	 *
	 * @return bool
	 * @author Rob Hussey
	 */
	private function regenerate_ci_session_id()
	{	
		// This is targeting a native CodeIgniter cookie, not a flexi_auth cookie.
		$ci_session = array(
			'name'   => $this->config->item('sess_cookie_name'),
			'value'  => '',
			'expire' => ''
		);
		set_cookie($ci_session);	
	}
}

/* End of file flexi_auth_model.php */
/* Location: ./application/controllers/flexi_auth_model.php */
