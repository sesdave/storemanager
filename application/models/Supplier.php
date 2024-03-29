<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Supplier class
 *
 * @link    github.com/jekkos/opensourcepos
 * @since   1.0
 * @author  N/A
 */

class Supplier extends Person
{	
	/*
	Determines if a given person_id is a customer
	*/
	public function exists($person_id)
	{
		$this->db->from('suppliers');	
		$this->db->join('people', 'people.person_id = suppliers.person_id');
		$this->db->where('suppliers.person_id', $person_id);
		
		return ($this->db->get()->num_rows() == 1);
	}

	/*
	Gets total of rows
	*/
	public function get_total_rows()
	{
		$this->db->from('suppliers');
		$this->db->where('deleted', 0);

		return $this->db->count_all_results();
	}
	
	/*
	Returns all the suppliers
	*/
	public function get_all_roles($limit_from = 0, $rows = 0)
	{
		$this->db->from('role_id');
		if($rows > 0)
		{
			$this->db->limit($rows, $limit_from);
		}

		return $this->db->get();		
	}
	public function get_all_pills($limit_from = 0, $rows = 0)
	{
		$this->db->from('pill_reminder');
		if($rows > 0)
		{
			$this->db->limit($rows, $limit_from);
		}

		return $this->db->get();		
	}
	public function get_all_locations($limit_from = 0, $rows = 0)
	{
		$this->db->from('stock_locations');
		if($rows > 0)
		{
			$this->db->limit($rows, $limit_from);
		}

		return $this->db->get();		
	}
	public function get_all($limit_from = 0, $rows = 0)
	{
		$this->db->from('suppliers');
		$this->db->join('people', 'suppliers.person_id = people.person_id');			
		$this->db->where('deleted', 0);
		$this->db->order_by('company_name', 'asc');
		if($rows > 0)
		{
			$this->db->limit($rows, $limit_from);
		}

		return $this->db->get();		
	}
	public function get_all_labcategories($limit_from = 0, $rows = 0)
	{
		$this->db->from('laboratory_category');			
		$this->db->where('deleted', 0);
		if($rows > 0)
		{
			$this->db->limit($rows, $limit_from);
		}

		return $this->db->get();		
	}
	public function get_all_categories($limit_from = 0, $rows = 0)
	{
		$this->db->from('categories');			
		$this->db->order_by('name', 'asc');
		if($rows > 0)
		{
			$this->db->limit($rows, $limit_from);
		}

		return $this->db->get();		
	}
	public function get_loc($item_location,$limit_from = 0, $rows = 0)
	{
		$this->db->from('stock_locations');			
		$this->db->where('location_id !=', $item_location);
		$this->db->where('deleted', 0);
		if($rows > 0)
		{
			$this->db->limit($rows, $limit_from);
		}

		return $this->db->get();		
	}
	
	/*
	Gets information about a particular supplier
	*/
	public function get_info($supplier_id)
	{
		$this->db->from('suppliers');	
		$this->db->join('people', 'people.person_id = suppliers.person_id');
		$this->db->where('suppliers.person_id', $supplier_id);
		$query = $this->db->get();
		
		if($query->num_rows() == 1)
		{
			return $query->row();
		}
		else
		{
			//Get empty base parent object, as $supplier_id is NOT an supplier
			$person_obj = parent::get_info(-1);
			
			//Get all the fields from supplier table		
			//append those fields to base parent object, we we have a complete empty object
			foreach($this->db->list_fields('suppliers') as $field)
			{
				$person_obj->$field = '';
			}
			
			return $person_obj;
		}
	}
	
	/*
	Gets information about multiple suppliers
	*/
	public function get_multiple_info($suppliers_ids)
	{
		$this->db->from('suppliers');
		$this->db->join('people', 'people.person_id = suppliers.person_id');		
		$this->db->where_in('suppliers.person_id', $suppliers_ids);
		$this->db->order_by('last_name', 'asc');

		return $this->db->get();
	}
	
	/*
	Inserts or updates a suppliers
	*/
	public function save_supplier(&$person_data, &$supplier_data, $supplier_id = FALSE)
	{
		$success = FALSE;

		//Run these queries as a transaction, we want to make sure we do all or nothing
		$this->db->trans_start();
		
		if(parent::save($person_data,$supplier_id))
		{
			if(!$supplier_id || !$this->exists($supplier_id))
			{
				$supplier_data['person_id'] = $person_data['person_id'];
				$success = $this->db->insert('suppliers', $supplier_data);
			}
			else
			{
				$this->db->where('person_id', $supplier_id);
				$success = $this->db->update('suppliers', $supplier_data);
			}
		}
		
		$this->db->trans_complete();
		
		$success &= $this->db->trans_status();

		return $success;
	}
	
	/*
	Deletes one supplier
	*/
	public function delete($supplier_id)
	{
		$this->db->where('person_id', $supplier_id);

		return $this->db->update('suppliers', array('deleted' => 1));
	}
	
	/*
	Deletes a list of suppliers
	*/
	public function delete_list($supplier_ids)
	{
		$this->db->where_in('person_id', $supplier_ids);

		return $this->db->update('suppliers', array('deleted' => 1));
 	}
	public function delete_test_list($supplier_ids)
	{
		$this->db->where('item_id', $supplier_ids);

		return $this->db->update('laboratory_test', array('deleted' => 1));
 	}
 	
 	/*
	Get search suggestions to find suppliers
	*/
	public function get_search_suggestions($search, $unique = FALSE, $limit = 25)
	{
		$suggestions = array();

		$this->db->from('suppliers');
		$this->db->join('people', 'suppliers.person_id = people.person_id');
		$this->db->where('deleted', 0);
		$this->db->like('company_name', $search);
		$this->db->order_by('company_name', 'asc');
		foreach($this->db->get()->result() as $row)
		{
			$suggestions[] = array('value' => $row->person_id, 'label' => $row->company_name);
		}

		$this->db->from('suppliers');
		$this->db->join('people', 'suppliers.person_id = people.person_id');
		$this->db->where('deleted', 0);
		$this->db->distinct();
		$this->db->like('agency_name', $search);
		$this->db->where('agency_name IS NOT NULL');
		$this->db->order_by('agency_name', 'asc');
		foreach($this->db->get()->result() as $row)
		{
			$suggestions[] = array('value' => $row->person_id, 'label' => $row->agency_name);
		}

		$this->db->from('suppliers');
		$this->db->join('people', 'suppliers.person_id = people.person_id');
		$this->db->group_start();
			$this->db->like('first_name', $search);
			$this->db->or_like('last_name', $search); 
			$this->db->or_like('CONCAT(first_name, " ", last_name)', $search);
		$this->db->group_end();
		$this->db->where('deleted', 0);
		$this->db->order_by('last_name', 'asc');
		foreach($this->db->get()->result() as $row)
		{
			$suggestions[] = array('value' => $row->person_id, 'label' => $row->first_name . ' ' . $row->last_name);
		}

		if(!$unique)
		{
			$this->db->from('suppliers');
			$this->db->join('people', 'suppliers.person_id = people.person_id');
			$this->db->where('deleted', 0);
			$this->db->like('email', $search);
			$this->db->order_by('email', 'asc');
			foreach($this->db->get()->result() as $row)
			{
				$suggestions[] = array('value' => $row->person_id, 'label' => $row->email);
			}

			$this->db->from('suppliers');
			$this->db->join('people', 'suppliers.person_id = people.person_id');
			$this->db->where('deleted', 0);
			$this->db->like('phone_number', $search);
			$this->db->order_by('phone_number', 'asc');
			foreach($this->db->get()->result() as $row)
			{
				$suggestions[] = array('value' => $row->person_id, 'label' => $row->phone_number);
			}

			$this->db->from('suppliers');
			$this->db->join('people', 'suppliers.person_id = people.person_id');
			$this->db->where('deleted', 0);
			$this->db->like('account_number', $search);
			$this->db->order_by('account_number', 'asc');
			foreach($this->db->get()->result() as $row)
			{
				$suggestions[] = array('value' => $row->person_id, 'label' => $row->account_number);
			}
		}

		//only return $limit suggestions
		if(count($suggestions > $limit))
		{
			$suggestions = array_slice($suggestions, 0, $limit);
		}

		return $suggestions;
	}

 	/*
	Gets rows
	*/
	public function get_found_rows($search)
	{
		$this->db->from('suppliers');
		$this->db->join('people', 'suppliers.person_id = people.person_id');
		$this->db->group_start();
			$this->db->like('first_name', $search);
			$this->db->or_like('last_name', $search);
			$this->db->or_like('company_name', $search);
			$this->db->or_like('agency_name', $search);
			$this->db->or_like('email', $search);
			$this->db->or_like('phone_number', $search);
			$this->db->or_like('account_number', $search);
			$this->db->or_like('CONCAT(first_name, " ", last_name)', $search);
		$this->db->group_end();
		$this->db->where('deleted', 0);

		return $this->db->get()->num_rows();
	}
	
	/*
	Perform a search on suppliers
	*/
	public function search($search, $rows = 0, $limit_from = 0, $sort = 'last_name', $order = 'asc')
	{
		$this->db->from('suppliers');
		$this->db->join('people', 'suppliers.person_id = people.person_id');
		$this->db->group_start();
			$this->db->like('first_name', $search);
			$this->db->or_like('last_name', $search);
			$this->db->or_like('company_name', $search);
			$this->db->or_like('agency_name', $search);
			$this->db->or_like('email', $search);
			$this->db->or_like('phone_number', $search);
			$this->db->or_like('account_number', $search);
			$this->db->or_like('CONCAT(first_name, " ", last_name)', $search);
		$this->db->group_end();
		$this->db->where('deleted', 0);
		
		$this->db->order_by($sort, $order);

		if($rows > 0)
		{
			$this->db->limit($rows, $limit_from);
		}

		return $this->db->get();
	}
	public function search_Lab($search, $rows = 0, $limit_from = 0, $sort = 'test_name', $order = 'asc')
	{
		$this->db->from('laboratory_test');
		$this->db->group_start();
			$this->db->like('test_name', $search);
			$this->db->or_like('test_code', $search);
			$this->db->or_like('test_amount', $search);
			$this->db->or_like('test_type', $search);
			$this->db->or_like('test_subgroup', $search);
			$this->db->or_like('test_unit', $search);
			
		$this->db->group_end();
		
		
		$this->db->order_by($sort, $order);

		if($rows > 0)
		{
			$this->db->limit($rows, $limit_from);
		}

		return $this->db->get();
	}
	public function get_found_rows_lab($search)
	{
		$this->db->from('laboratory_test');
		$this->db->group_start();
			$this->db->like('test_name', $search);
			$this->db->or_like('test_code', $search);
			$this->db->or_like('test_amount', $search);
			$this->db->or_like('test_type', $search);
			$this->db->or_like('test_subgroup', $search);
			$this->db->or_like('test_unit', $search);
		$this->db->group_end();
		

		return $this->db->get()->num_rows();
	}

	public function search_Account($search, $rows = 0, $limit_from = 0, $sort = 'invoice_id', $order = 'asc')
	{
		$this->db->from('ospos_laboratory_invoice');
		$this->db->group_start();
			$this->db->like('invoice_id', $search);
			$this->db->or_like('person_id', $search);
			$this->db->or_like('doctor_name', $search);
			$this->db->or_like('status', $search);
			
		$this->db->group_end();
		
		
		$this->db->order_by($sort, $order);

		if($rows > 0)
		{
			$this->db->limit($rows, $limit_from);
		}

		return $this->db->get();
	}
	public function get_found_rows_account($search)
	{
		$this->db->from('ospos_laboratory_invoice');
		$this->db->group_start();
			$this->db->like('invoice_id', $search);
			$this->db->or_like('person_id', $search);
			$this->db->or_like('doctor_name', $search);
			$this->db->or_like('status', $search);
		$this->db->group_end();
		

		return $this->db->get()->num_rows();
	}
}
?>
