<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("Persons.php");

class Employees extends Persons
{
	public function __construct()
	{
		parent::__construct('employees');
		$this->load->library('sale_lib');
	}

	/*
	Returns employee table data rows. This will be called with AJAX.
	*/
	public function search()
	{
		$search = $this->input->get('search');
		$limit  = $this->input->get('limit');
		$offset = $this->input->get('offset');
		$sort   = $this->input->get('sort');
		$order  = $this->input->get('order');

		$employees = $this->Employee->search($search, $limit, $offset, $sort, $order);
		$total_rows = $this->Employee->get_found_rows($search);

		$data_rows = array();
		foreach($employees->result() as $person)
		{
			$data_rows[] = get_person_data_row($person, $this);
		}

		$data_rows = $this->xss_clean($data_rows);

		echo json_encode(array('total' => $total_rows, 'rows' => $data_rows));
	}

	/*
	Gives search suggestions based on what is being searched for
	*/
	public function suggest_search()
	{
		$suggestions = $this->xss_clean($this->Employee->get_search_suggestions($this->input->post('term')));

		echo json_encode($suggestions);
	}

	/*
	Loads the employee edit form
	*/
	public function view($employee_id = -1)
	{
		$person_info = $this->Employee->get_info($employee_id);
		foreach(get_object_vars($person_info) as $property => $value)
		{
			$person_info->$property = $this->xss_clean($value);
		}
		
		$data['person_info'] = $person_info;
		$data['selected_role'] = $person_info->roles;
		/*$roles = array('' => $this->lang->line('employees_roles'),'admin_dash' => 'Admin','cashier' => 'Cashier','invent' => 'Inventory Manager','ceo' => 'CEO','lab_cashier' => 'Laboratory Cashier','lab_account' => 'Laboratory Accountant','lab_result' => 'Laboratory Scientist','custom' => 'Custom');
		foreach($suppliersd as $row => $value)
		{
			$roles[$row] = $value;
		}*/
		$roles = array('' => $this->lang->line('items_none'));
		foreach($this->Supplier->get_all_roles()->result_array() as $row)
		{
			$roles[$this->xss_clean($row['id'])] = $this->xss_clean($row['role']);
		}

		$modules = array();
		//$special_module=$this->sale_lib->get_modulecart();
		foreach($this->Module->get_all_modules()->result() as $module)
		{
			$module->module_id = $this->xss_clean($module->module_id);
			$module->grant = $this->xss_clean($this->Employee->has_grant($module->module_id, $person_info->person_id));

			$modules[] = $module;
		}
		$newmodule = array();
		
		$newmodules[0]->module_id=items;
		$newmodules[1]->module_id=receivings;
		$newmodules[2]->module_id=suppliers;
		foreach($newmodules as $module)
		{
			$module->module_id = $this->xss_clean($module->module_id);
			$module->grant = $this->xss_clean($this->Employee->has_grant($module->module_id, $person_info->person_id));

			$newmodule[] = $module;
		}
		$cashiermodules[0]->module_id=sales;
		foreach($cashiermodules as $module)
		{
			$module->module_id = $this->xss_clean($module->module_id);
			$module->grant = $this->xss_clean($this->Employee->has_grant($module->module_id, $person_info->person_id));

			$cashiermodule[] = $module;
		}
		$labaccountmodules[0]->module_id=account;
		foreach($labaccountmodules as $module)
		{
			$module->module_id = $this->xss_clean($module->module_id);
			$module->grant = $this->xss_clean($this->Employee->has_grant($module->module_id, $person_info->person_id));

			$labaccountmodule[] = $module;
		}
		$lab_cashiermodules[0]->module_id=laboratory;
		$lab_cashiermodules[1]->module_id=customers;
		foreach($lab_cashiermodules as $module)
		{
			$module->module_id = $this->xss_clean($module->module_id);
			$module->grant = $this->xss_clean($this->Employee->has_grant($module->module_id, $person_info->person_id));

			$lab_cashiermodule[] = $module;
		}
		$ceomodules[0]->module_id=reports;
		foreach($ceomodules as $module)
		{
			$module->module_id = $this->xss_clean($module->module_id);
			$module->grant = $this->xss_clean($this->Employee->has_grant($module->module_id, $person_info->person_id));

			$ceomodule[] = $module;
		}
		$adminmodules[0]->module_id=employees;
		$adminmodules[1]->module_id=config;
		foreach($adminmodules as $module)
		{
			$module->module_id = $this->xss_clean($module->module_id);
			$module->grant = $this->xss_clean($this->Employee->has_grant($module->module_id, $person_info->person_id));

			$adminmodule[] = $module;
		}
		$data['adminmodules'] = $adminmodule;
		$data['labaccountmodules'] = $labaccountmodule;
		$data['lab_cashiermodules'] = $lab_cashiermodule;
		$data['ceomodules'] = $ceomodule;
		$data['cashiermodules'] = $cashiermodule;
		$data['anewmodule'] = $newmodule;
		$data['all_modules'] = $modules;
		$data['roles'] = $roles;

		$permissions = array();
		foreach($this->Module->get_all_subpermissions()->result() as $permission)
		{
			$permission->module_id = $this->xss_clean($permission->module_id);
			$permission->permission_id = $this->xss_clean($permission->permission_id);
			$permission->grant = $this->xss_clean($this->Employee->has_grant($permission->permission_id, $person_info->person_id));

			$permissions[] = $permission;
		}
		$data['all_subpermissions'] = $permissions;

		$this->load->view('employees/form', $data);
	}
	public function view_assign($employee_id = -1)
	{
		$person_info = $this->Employee->get_info($employee_id);
		foreach(get_object_vars($person_info) as $property => $value)
		{
			$person_info->$property = $this->xss_clean($value);
		}
		
		$data['person_info'] = $person_info;
		$data['selected_role'] = $this->input->post('role_input')==''? $person_info->roles: $this->input->post('role_input');
		/*$roles = array('' => $this->lang->line('employees_roles'),'admin_dash' => 'Admin','cashier' => 'Cashier','invent' => 'Inventory Manager','ceo' => 'CEO','lab_cashier' => 'Laboratory Cashier','lab_account' => 'Laboratory Accountant','lab_result' => 'Laboratory Scientist','custom' => 'Custom');
		foreach($suppliersd as $row => $value)
		{
			$roles[$row] = $value;
		}*/
		$roles = array('' => $this->lang->line('items_none'));
		foreach($this->Supplier->get_all_roles()->result_array() as $row)
		{
			$roles[$this->xss_clean($row['id'])] = $this->xss_clean($row['role']);
		}

		$modules = array();
		$role_input=$this->input->post('role_input')==''? $person_info->roles: $this->input->post('role_input');
		//$special_module=$this->sale_lib->get_modulecart();
		foreach($this->Module->get_all_modules_role($role_input)->result() as $module)
		{
			$module->module_id = $this->xss_clean($module->module_id);
			$module->grant = $this->xss_clean($this->Employee->has_grant($module->module_id, $person_info->person_id));

			$modules[] = $module;
		}
		$newmodule = array();
		
		
		$data['all_modules'] = $modules;
		$data['roles'] = $roles;

		$permissions = array();
		foreach($this->Module->get_all_subpermissions()->result() as $permission)
		{
			$permission->module_id = $this->xss_clean($permission->module_id);
			$permission->permission_id = $this->xss_clean($permission->permission_id);
			$permission->grant = $this->xss_clean($this->Employee->has_grant($permission->permission_id, $person_info->person_id));

			$permissions[] = $permission;
		}
		$data['all_subpermissions'] = $permissions;
		$special_module=$this->Module->get_all_modules_role(1)->result();
		$data['special_module'] = $special_module;
		
		$this->load->view('employees/form_assign_role', $data);
	}
	public function check_role($employee_id = -1)
	{
		$person_info = $this->Employee->get_info($employee_id);
		foreach(get_object_vars($person_info) as $property => $value)
		{
			$person_info->$property = $this->xss_clean($value);
		}
		
		$data['person_info'] = $person_info;
		$data['selected_role'] = $person_info->roles;
		/*$roles = array('' => $this->lang->line('employees_roles'),'admin_dash' => 'Admin','cashier' => 'Cashier','invent' => 'Inventory Manager','ceo' => 'CEO','lab_cashier' => 'Laboratory Cashier','lab_account' => 'Laboratory Accountant','lab_result' => 'Laboratory Scientist','custom' => 'Custom');
		foreach($suppliersd as $row => $value)
		{
			$roles[$row] = $value;
		}*/
		$roles = array('' => $this->lang->line('items_none'));
		foreach($this->Supplier->get_all_roles()->result_array() as $row)
		{
			$roles[$this->xss_clean($row['id'])] = $this->xss_clean($row['role']);
		}
	    $role_input=$this->input->post('role_input')==''? $person_info->role: $this->input->post('role_input');
		$modules = array();
		//$special_module=$this->sale_lib->get_modulecart();
		//$this->Module->get_all_modules()->result()
		foreach($this->Module->get_all_modules_role($role_input)->result() as $module)
		{
			$module->module_id = $this->xss_clean($module->module_id);
			$module->grant = $this->xss_clean($this->Employee->has_grant($module->module_id, $person_info->person_id));

			$modules[] = $module;
		}
		$newmodule = array();
		
		
		$data['all_modules'] = $modules;
		$data['roles'] = $roles;

		$permissions = array();
		foreach($this->Module->get_all_subpermissions()->result() as $permission)
		{
			$permission->module_id = $this->xss_clean($permission->module_id);
			$permission->permission_id = $this->xss_clean($permission->permission_id);
			$permission->grant = $this->xss_clean($this->Employee->has_grant($permission->permission_id, $person_info->person_id));

			$permissions[] = $permission;
		}
		$data['all_subpermissions'] = $permissions;

		$this->load->view('employees/form_assign_role', $data);
	}
	public function view_role($employee_id = -1)
	{
		$person_info = $this->Employee->get_info($employee_id);
		foreach(get_object_vars($person_info) as $property => $value)
		{
			$person_info->$property = $this->xss_clean($value);
		}
		
		$data['person_info'] = $person_info;
		$data['selected_role'] = $person_info->roles;
		//$roles = array('' => $this->lang->line('employees_roles'),'admin_dash' => 'Admin','cashier' => 'Cashier','invent' => 'Inventory Manager','ceo' => 'CEO','lab_cashier' => 'Laboratory Cashier','lab_account' => 'Laboratory Accountant','lab_result' => 'Laboratory Scientist','custom' => 'Custom');
		/*foreach($suppliersd as $row => $value)
		{
			$roles[$row] = $value;
		}*/
		$roles = array('' => $this->lang->line('items_none'));
		foreach($this->Supplier->get_all_roles()->result_array() as $row)
		{
			$roles[$this->xss_clean($row['id'])] = $this->xss_clean($row['role']);
		}

		$modules = array();
		foreach($this->Module->get_all_modules()->result() as $module)
		{
			$module->module_id = $this->xss_clean($module->module_id);
			$module->grant = $this->xss_clean($this->Employee->has_grant($module->module_id, $person_info->person_id));

			$modules[] = $module;
		}
		
		$data['adminmodules'] = $adminmodule;
		$data['labaccountmodules'] = $labaccountmodule;
		$data['lab_cashiermodules'] = $lab_cashiermodule;
		$data['ceomodules'] = $ceomodule;
		$data['cashiermodules'] = $cashiermodule;
		$data['anewmodule'] = $newmodule;
		$data['all_modules'] = $modules;
		$data['roles'] = $roles;

		$permissions = array();
		foreach($this->Module->get_all_subpermissions()->result() as $permission)
		{
			$permission->module_id = $this->xss_clean($permission->module_id);
			$permission->permission_id = $this->xss_clean($permission->permission_id);
			$permission->grant = $this->xss_clean($this->Employee->has_grant($permission->permission_id, $person_info->person_id));

			$permissions[] = $permission;
		}
		$data['all_subpermissions'] = $permissions;

		$this->load->view('employees/form_role', $data);
	}
	public function set_role()
	{
		$role=$this->input->post('role');
		$role_modules=$this->Module->get_all_modules_role($role);
		$this->sale_lib->set_modulecart($role_modules);
	}

	/*
	Inserts/updates an employee
	*/
	public function save($employee_id = -1)
	{
		if($this->input->post('current_password') != '')
		{
			if($this->Employee->check_password($this->input->post('username'), $this->input->post('current_password')))
			{
				$employee_data = array(
					'username' => $this->input->post('username'),
					'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'hash_version' => 2
				);

				if($this->Employee->change_password($employee_data, $employee_id))
				{
					echo json_encode(array('success' => TRUE, 'message' => $this->lang->line('employees_successful_change_password'), 'id' => $employee_id));
				}
				else//failure
				{
					echo json_encode(array('success' => FALSE, 'message' => $this->lang->line('employees_unsuccessful_change_password'), 'id' => -1));
				}
			}
			else
			{
				echo json_encode(array('success' => FALSE, 'message' => $this->lang->line('employees_current_password_invalid'), 'id' => -1));
			}
		}
		else
		{
			$first_name = $this->xss_clean($this->input->post('first_name'));
			$last_name = $this->xss_clean($this->input->post('last_name'));
			$email = $this->xss_clean(strtolower($this->input->post('email')));

			// format first and last name properly
			$first_name = $this->nameize($first_name);
			$last_name = $this->nameize($last_name);

			$person_data = array(
				'first_name' => $first_name,
				'last_name' => $last_name,
				'gender' => $this->input->post('gender'),
				'email' => $email,
				'phone_number' => $this->input->post('phone_number'),
				'address_1' => $this->input->post('address_1'),
				'address_2' => $this->input->post('address_2'),
				'city' => $this->input->post('city'),
				'state' => $this->input->post('state'),
				'zip' => $this->input->post('zip'),
				'country' => $this->input->post('country'),
				'comments' => $this->input->post('comments'),
			);
			$grants_data = $this->input->post('grants') != NULL ? $this->input->post('grants') : array();

			//Password has been changed OR first time password set
			if($this->input->post('password') != '')
			{
				$employee_data = array(
					'username' => $this->input->post('username'),
					'roles' => $this->input->post('roles'),
					'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
					'hash_version' => 2
				);
			}
			else //Password not changed
			{
				$employee_data = array('username' => $this->input->post('username'),
								'roles' => $this->input->post('roles'),
							);
			}

			if($this->Employee->save_employee($person_data, $employee_data, $grants_data, $employee_id))
			{
				// New employee
				if($employee_id == -1)
				{
					echo json_encode(array('success' => TRUE,
									'message' => $this->lang->line('employees_successful_adding') . ' ' . $first_name . ' ' . $last_name,
									'id' => $this->xss_clean($employee_data['person_id'])));
				}
				else // Existing employee
				{
					echo json_encode(array('success' => TRUE,
									'message' => $this->lang->line('employees_successful_updating') . ' ' . $first_name . ' ' . $last_name,
									'id' => $employee_id));
				}
			}
			else // Failure
			{
				echo json_encode(array('success' => FALSE,
								'message' => $this->lang->line('employees_error_adding_updating') . ' ' . $first_name . ' ' . $last_name,
								'id' => -1));
			}
		}
	}
	
	
	public function save_role($employee_id = -1)
	{
			$role_data = array(
				'role' => $this->input->post('role'),
		
			);
	
			$grants_data = $this->input->post('grants') != NULL ? $this->input->post('grants') : array();

			//Password has been changed OR first time password set
			

			if($this->Employee->save_role($grants_data, $role_data))
			{
				// New employee
				if($employee_id == -1)
				{
					echo json_encode(array('success' => TRUE,
									'message' => $this->lang->line('employees_successful_adding') . ' ' . $first_name . ' ' . $last_name,
									'id' => $this->xss_clean($employee_data['person_id'])));
				}
				else // Existing employee
				{
					echo json_encode(array('success' => TRUE,
									'message' => $this->lang->line('employees_successful_updating') . ' ' . $first_name . ' ' . $last_name,
									'id' => $employee_id));
				}
			}
			else // Failure
			{
				echo json_encode(array('success' => FALSE,
								'message' => $this->lang->line('employees_error_adding_updating') . ' ' . $first_name . ' ' . $last_name,
								'id' => -1));
			}
		
	}


	/*
	This deletes employees from the employees table
	*/
	public function delete()
	{
		$employees_to_delete = $this->xss_clean($this->input->post('ids'));

		if($this->Employee->delete_list($employees_to_delete))
		{
			echo json_encode(array('success' => TRUE,'message' => $this->lang->line('employees_successful_deleted') . ' ' .
							count($employees_to_delete) . ' ' . $this->lang->line('employees_one_or_multiple')));
		}
		else
		{
			echo json_encode(array('success' => FALSE, 'message' => $this->lang->line('employees_cannot_be_deleted')));
		}
	}

	/*
	Loads the change password form
	*/
	public function change_password($employee_id = -1)
	{
		$person_info = $this->Employee->get_info($employee_id);
		foreach(get_object_vars($person_info) as $property => $value)
		{
			$person_info->$property = $this->xss_clean($value);
		}
		$data['person_info'] = $person_info;

		$this->load->view('employees/form_change_password', $data);
	}
}
?>
