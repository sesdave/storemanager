<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("Secure_Controller.php");

class Config extends Secure_Controller
{
	public function __construct()
	{
		parent::__construct('config');

		$this->load->library('barcode_lib');
		$this->load->library('sale_lib');
	}

	/*
	* This function loads all the licenses starting with the first one being OSPOS one
	*/
	private function _licenses()
	{
		$i = 0;
		$bower = FALSE;
		$composer = FALSE;
		$license = array();

		$license[$i]['title'] = 'Open Source Point Of Sale ' . $this->config->item('application_version');

		if(file_exists('license/LICENSE'))
		{
			$license[$i]['text'] = $this->xss_clean(file_get_contents('license/LICENSE', NULL, NULL, 0, 2000));
		}
		else
		{
			$license[$i]['text'] = 'LICENSE file must be in OSPOS license directory. You are not allowed to use OSPOS application until the distribution copy of LICENSE file is present.';
		}

		// read all the files in the dir license
		$dir = new DirectoryIterator('license');

		foreach($dir as $fileinfo)
		{
			// license files must be in couples: .version (name & version) & .license (license text)
			if($fileinfo->isFile())
			{
				if($fileinfo->getExtension() == 'version')
				{
					++$i;

					$basename = 'license/' . $fileinfo->getBasename('.version');

					$license[$i]['title'] = $this->xss_clean(file_get_contents($basename . '.version', NULL, NULL, 0, 100));

					$license_text_file = $basename . '.license';

					if(file_exists($license_text_file))
					{
						$license[$i]['text'] = $this->xss_clean(file_get_contents($license_text_file , NULL, NULL, 0, 2000));
					}
					else
					{
						$license[$i]['text'] = $license_text_file . ' file is missing';
					}
				}
				elseif($fileinfo->getBasename() == 'bower.LICENSES')
				{
					// set a flag to indicate that the JS Plugin bower.LICENSES file is available and needs to be attached at the end
					$bower = TRUE;
				}
				elseif($fileinfo->getBasename() == 'composer.LICENSES')
				{
					// set a flag to indicate that the composer.LICENSES file is available and needs to be attached at the end
					$composer = TRUE;
				}
			}
		}

		// attach the licenses from the LICENSES file generated by bower
		if($composer)
		{
			++$i;
			$license[$i]['title'] = 'Composer Libraries';
			$license[$i]['text'] = '';

			$file = file_get_contents('license/composer.LICENSES');
			$array = json_decode($file, TRUE);

			foreach($array as $key => $val)
			{
				if(is_array($val) && $key == 'dependencies')
				{
					foreach($val as $key1 => $val1)
					{
						if(is_array($val1))
						{
							$license[$i]['text'] .= 'component: ' . $key1 . "\n";

							foreach($val1 as $key2 => $val2)
							{
								if(is_array($val2))
								{
									$license[$i]['text'] .= $key2 . ': ';

									foreach($val2 as $key3 => $val3)
									{
										$license[$i]['text'] .= $val3 . ' ';
									}

									$license[$i]['text'] .= "\n";
								}
								else
								{
									$license[$i]['text'] .= $key2 . ': ' . $val2 . "\n";
								}
							}

							$license[$i]['text'] .= "\n";
						}
						else
						{
							$license[$i]['text'] .= $key1 . ': ' . $val1 . "\n";
						}
					}
				}
			}

			$license[$i]['text'] = $this->xss_clean($license[$i]['text']);
		}

		// attach the licenses from the LICENSES file generated by bower
		if($bower)
		{
			++$i;
			$license[$i]['title'] = 'JS Plugins';
			$license[$i]['text'] = '';

			$file = file_get_contents('license/bower.LICENSES');
			$array = json_decode($file, TRUE);

			foreach($array as $key => $val)
			{
				if(is_array($val))
				{
					$license[$i]['text'] .= 'component: ' . $key . "\n";

					foreach($val as $key1 => $val1)
					{
						if(is_array($val1))
						{
							$license[$i]['text'] .= $key1 . ': ';

							foreach($val1 as $key2 => $val2)
							{
								$license[$i]['text'] .= $val2 . ' ';
							}

							$license[$i]['text'] .= "\n";
						}
						else
						{
							$license[$i]['text'] .= $key1 . ': ' . $val1 . "\n";
						}
					}

					$license[$i]['text'] .= "\n";
				}
			}

			$license[$i]['text'] = $this->xss_clean($license[$i]['text']);
		}

		return $license;
	}

	/*
	* This function loads all the available themes in the dist/bootswatch directory
	*/
	private function _themes()
	{
		$themes = array();

		// read all themes in the dist folder
		$dir = new DirectoryIterator('dist/bootswatch');

		foreach($dir as $dirinfo)
		{
			if($dirinfo->isDir() && !$dirinfo->isDot() && $dirinfo->getFileName() != 'fonts')
			{
				$file = $this->xss_clean($dirinfo->getFileName());
				$themes[$file] = $file;
			}
		}

		asort($themes);

		return $themes;
	}

	public function index()
	{
		$data['stock_locations'] = $this->Stock_location->get_all()->result_array();
		$data['dinner_tables'] = $this->Dinner_table->get_all()->result_array();
		$data['get_reminders'] = $this->Customer_rewards->get_all_reminders()->result_array();
		$data['customer_rewards'] = $this->Customer_rewards->get_all()->result_array();
		$data['support_barcode'] = $this->barcode_lib->get_list_barcodes();
		$data['logo_exists'] = $this->config->item('company_logo') != '';
		$data['line_sequence_options'] = $this->sale_lib->get_line_sequence_options();
		$data['register_mode_options'] = $this->sale_lib->get_register_mode_options();
		$data['rounding_options'] = Rounding_code::get_rounding_options();
		

		$data = $this->xss_clean($data);

		// load all the license statements, they are already XSS cleaned in the private function
		$data['licenses'] = $this->_licenses();
		// load all the themes, already XSS cleaned in the private function
		$data['themes'] = $this->_themes();

		$data['mailchimp'] = array();
		if($this->_check_encryption())
		{
			$data['mailchimp']['api_key'] = $this->encryption->decrypt($this->config->item('mailchimp_api_key'));
			$data['mailchimp']['list_id'] = $this->encryption->decrypt($this->config->item('mailchimp_list_id'));
		}
		else
		{
			$data['mailchimp']['api_key'] = '';
			$data['mailchimp']['list_id'] = '';
		}

		// load mailchimp lists associated to the given api key, already XSS cleaned in the private function
		$data['mailchimp']['lists'] = $this->_mailchimp();

		$this->load->view("configs/manage", $data);
	}
	public function edit_reminder($item_id)
	{
		$data = array();

		//$this->form_validation->set_rules('reminder_amount', 'lang:items_price', 'required|callback_numeric');
		
		$reminder_amount = parse_decimals($this->input->post('reminder_amount'));
		if($reminder_amount<0){

			$data['warning'] = "Value cannot be less than Zero ";
		}

			$this->sale_lib->edit_reminder($item_id, $reminder_amount);
		
		//$this->_reload($data);
		//$this->load->view(items/push);
	}


	public function save_info()
	{
		$upload_success = $this->_handle_logo_upload();
		$upload_data = $this->upload->data();

		$batch_save_data = array(
			'company' => $this->input->post('company'),
			'address' => $this->input->post('address'),
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'),
			'fax' => $this->input->post('fax'),
			'website' => $this->input->post('website'),
			'return_policy' => $this->input->post('return_policy')
		);

		if(!empty($upload_data['orig_name']))
		{
			// XSS file image sanity check
			if($this->xss_clean($upload_data['raw_name'], TRUE) === TRUE)
			{
				$batch_save_data['company_logo'] = $upload_data['raw_name'] . $upload_data['file_ext'];
			}
		}

		$result = $this->Appconfig->batch_save($batch_save_data);
		$success = $upload_success && $result ? TRUE : FALSE;
		$message = $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully');
		$message = $upload_success ? $message : strip_tags($this->upload->display_errors());

		echo json_encode(array(
			'success' => $success,
			'message' => $message
		));
	}

	public function save_general()
	{
		$batch_save_data = array(
			'theme' => $this->input->post('theme'),
			'default_tax_1_rate' => parse_decimals($this->input->post('default_tax_1_rate')),
			'default_tax_1_name' => $this->input->post('default_tax_1_name'),
			'default_tax_2_rate' => parse_decimals($this->input->post('default_tax_2_rate')),
			'default_tax_2_name' => $this->input->post('default_tax_2_name'),
			'tax_included' => $this->input->post('tax_included') != NULL,
			'customer_sales_tax_support' => $this->input->post('customer_sales_tax_support') != NULL,
			'default_origin_tax_code' => $this->input->post('default_origin_tax_code'),
			'receiving_calculate_average_price' => $this->input->post('receiving_calculate_average_price') != NULL,
			'lines_per_page' => $this->input->post('lines_per_page'),
			'default_sales_discount' => $this->input->post('default_sales_discount'),
			'notify_horizontal_position' => $this->input->post('notify_horizontal_position'),
			'notify_vertical_position' => $this->input->post('notify_vertical_position'),
			'custom1_name' => $this->input->post('custom1_name'),
			'custom2_name' => $this->input->post('custom2_name'),
			'custom3_name' => $this->input->post('custom3_name'),
			'custom4_name' => $this->input->post('custom4_name'),
			'custom5_name' => $this->input->post('custom5_name'),
			'custom6_name' => $this->input->post('custom6_name'),
			'custom7_name' => $this->input->post('custom7_name'),
			'custom8_name' => $this->input->post('custom8_name'),
			'custom9_name' => $this->input->post('custom9_name'),
			'custom10_name' => $this->input->post('custom10_name'),
			'statistics' => $this->input->post('statistics') != NULL,
			'giftcard_number' => $this->input->post('giftcard_number'),
		);

		$result = $this->Appconfig->batch_save($batch_save_data);
		$success = $result ? TRUE : FALSE;

		echo json_encode(array(
			'success' => $success,
			'message' => $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully')
		));
	}

	public function check_number_locale()
	{
		$number_locale = $this->input->post('number_locale');
		$fmt = new \NumberFormatter($number_locale, \NumberFormatter::CURRENCY);
		$currency_symbol = empty($this->input->post('currency_symbol')) ? $fmt->getSymbol(\NumberFormatter::CURRENCY_SYMBOL) : $this->input->post('currency_symbol');
		if($this->input->post('thousands_separator') == 'false')
		{
			$fmt->setAttribute(\NumberFormatter::GROUPING_SEPARATOR_SYMBOL, '');
		}
		$fmt->setSymbol(\NumberFormatter::CURRENCY_SYMBOL, $currency_symbol);
		$number_local_example = $fmt->format(1234567890.12300);
		echo json_encode(array(
			'success' => $number_local_example != FALSE,
			'number_locale_example' => $number_local_example,
			'currency_symbol' => $currency_symbol,
			'thousands_separator' => $fmt->getAttribute(\NumberFormatter::GROUPING_SEPARATOR_SYMBOL) != ''
		));
	}

	public function save_locale()
	{
		$exploded = explode(":", $this->input->post('language'));
		$batch_save_data = array(
			'currency_symbol' => $this->input->post('currency_symbol'),
			'language_code' => $exploded[0],
			'language' => $exploded[1],
			'timezone' => $this->input->post('timezone'),
			'dateformat' => $this->input->post('dateformat'),
			'timeformat' => $this->input->post('timeformat'),
			'thousands_separator' => $this->input->post('thousands_separator'),
			'number_locale' => $this->input->post('number_locale'),
			'currency_decimals' => $this->input->post('currency_decimals'),
			'tax_decimals' => $this->input->post('tax_decimals'),
			'quantity_decimals' => $this->input->post('quantity_decimals'),
			'country_codes' => $this->input->post('country_codes'),
			'payment_options_order' => $this->input->post('payment_options_order'),
			'date_or_time_format' => $this->input->post('date_or_time_format'),
			'cash_decimals' => $this->input->post('cash_decimals'),
			'cash_rounding_code' => $this->input->post('cash_rounding_code'),
			'financial_year' => $this->input->post('financial_year')
		);

		$result = $this->Appconfig->batch_save($batch_save_data);
		$success = $result ? TRUE : FALSE;

		echo json_encode(array(
			'success' => $success,
			'message' => $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully')
		));
	}

	public function save_email()
	{
		$password = '';

		if($this->_check_encryption())
		{
			$password = $this->encryption->encrypt($this->input->post('smtp_pass'));
		}

		$batch_save_data = array(
			'protocol' => $this->input->post('protocol'),
			'mailpath' => $this->input->post('mailpath'),
			'smtp_host' => $this->input->post('smtp_host'),
			'smtp_user' => $this->input->post('smtp_user'),
			'smtp_pass' => $password,
			'smtp_port' => $this->input->post('smtp_port'),
			'smtp_timeout' => $this->input->post('smtp_timeout'),
			'smtp_crypto' => $this->input->post('smtp_crypto')
		);

		$result = $this->Appconfig->batch_save($batch_save_data);
		$success = $result ? TRUE : FALSE;

		echo json_encode(array(
			'success' => $success,
			'message' => $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully')
		));
	}

	public function save_message()
	{
		$password = '';

		if($this->_check_encryption())
		{
			$password = $this->encryption->encrypt($this->input->post('msg_pwd'));
		}

		$batch_save_data = array(
			'msg_msg' => $this->input->post('msg_msg'),
			'msg_uid' => $this->input->post('msg_uid'),
			'msg_pwd' => $password,
			'msg_src' => $this->input->post('msg_src')
		);

		$result = $this->Appconfig->batch_save($batch_save_data);
		$success = $result ? TRUE : FALSE;

		echo json_encode(array(
			'success' => $success,
			'message' => $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully')
		));
	}

	/*
	* This function fetches all the available lists from Mailchimp for the given API key
	*/
	private function _mailchimp($api_key = '')
	{
		$this->load->library('mailchimp_lib', array('api_key' => $api_key));

		$result = array();

		if(($lists = $this->mailchimp_lib->getLists()) !== FALSE)
		{
			if(is_array($lists) && !empty($lists['lists']) && is_array($lists['lists']))
			{
				foreach($lists['lists'] as $list)
				{
					$list = $this->xss_clean($list);
					$result[$list['id']] = $list['name'] . ' [' . $list['stats']['member_count'] . ']';
				}
			}
		}

		return $result;
	}

	/*
	AJAX call from mailchimp config form to fetch the Mailchimp lists when a valid API key is inserted
	*/
	public function ajax_check_mailchimp_api_key()
	{
		// load mailchimp lists associated to the given api key, already XSS cleaned in the private function
		$lists = $this->_mailchimp($this->input->post('mailchimp_api_key'));
		$success = count($lists) > 0 ? TRUE : FALSE;

		echo json_encode(array(
			'success' => $success,
			'message' => $this->lang->line('config_mailchimp_key_' . ($success ? '' : 'un') . 'successfully'),
			'mailchimp_lists' => $lists
		));
	}

	public function save_mailchimp()
	{
		$api_key = '';
		$list_id = '';

		if($this->_check_encryption())
		{
			$api_key = $this->encryption->encrypt($this->input->post('mailchimp_api_key'));
			$list_id = $this->encryption->encrypt($this->input->post('mailchimp_list_id'));
		}

		$batch_save_data = array(
			'mailchimp_api_key' => $api_key,
			'mailchimp_list_id' => $list_id
		);

		$result = $this->Appconfig->batch_save($batch_save_data);
		$success = $result ? TRUE : FALSE;

		echo json_encode(array(
			'success' => $success,
			'message' => $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully')
		));
	}

	public function stock_locations()
	{
		$stock_locations = $this->Stock_location->get_all()->result_array();

		$stock_locations = $this->xss_clean($stock_locations);

		$this->load->view('partial/stock_locations', array('stock_locations' => $stock_locations));
	}

	public function dinner_tables()
	{
		$dinner_tables = $this->Dinner_table->get_all()->result_array();

		$dinner_tables = $this->xss_clean($dinner_tables);

		$this->load->view('partial/dinner_tables', array('dinner_tables' => $dinner_tables));
	}

	public function customer_rewards()
	{
		$customer_rewards = $this->Customer_rewards->get_all()->result_array();

		$customer_rewards = $this->xss_clean($customer_rewards);

		$this->load->view('partial/customer_rewards', array('customer_rewards' => $customer_rewards));
	}

	private function _clear_session_state()
	{
		$this->sale_lib->clear_sale_location();
		$this->sale_lib->clear_table();
		$this->sale_lib->clear_all();
		$this->load->library('receiving_lib');
		$this->receiving_lib->clear_stock_source();
		$this->receiving_lib->clear_stock_destination();
		$this->receiving_lib->clear_all();
	}

	public function save_locations()
	{
		//$data['supew']=$this->input->post();
		$this->db->trans_start();

		$deleted_locations = $this->Stock_location->get_allowed_locations();
		$not_to_delete = array();
		$array_save = array();
		foreach($this->input->post() as $key => $value)
		{
			if(strstr($key, 'stock_name'))
			{
				$customer_reward_id = preg_replace("/.*?_(\d+)$/", "$1", $key);
				$not_to_delete[] = $customer_reward_id;
				$array_save[$customer_reward_id]['location_name'] = $value;
			}

			if(strstr($key, 'stock_address'))
			{
				$customer_reward_id = preg_replace("/.*?_(\d+)$/", "$1", $key);
				$not_to_delete[] = $customer_reward_id;
				$array_save[$customer_reward_id]['location_address'] = $value;
			}
			if(strstr($key, 'stock_number'))
			{
				$customer_reward_id = preg_replace("/.*?_(\d+)$/", "$1", $key);
				$not_to_delete[] = $customer_reward_id;
				$array_save[$customer_reward_id]['location_number'] = $value;
			}
		}

		if(!empty($array_save))
		{
			foreach($array_save as $key => $value)
			{
				// save or update
				$location_data = array('location_name' => $value['location_name'], 'location_address' => $value['location_address'], 'location_number' => $value['location_number']);
				
				if($this->Stock_location->save($location_data, $key))
				{
					$this->_clear_session_state();
				}
			}
		}

		// all locations not available in post will be deleted now
		foreach($deleted_packages as $customer_reward)
		{
			if(!in_array($customer_reward['customer_reward_id'], $not_to_delete))
			{
				//$this->Customer_rewards->delete($customer_reward['customer_reward_id']);
				$this->Stock_location->delete($customer_reward['customer_reward_id']);
			}
		}

		$this->db->trans_complete();

		$success = $this->db->trans_status();

		echo json_encode(array(
			'success' => $success,
			'message' => $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully')
		));
	}
	
		
	
	

	public function save_tables()
	{
		$this->db->trans_start();

		$this->Appconfig->save('dinner_table_enable',$this->input->post('dinner_table_enable'));

		$deleted_tables = $this->Dinner_table->get_all()->result_array();
		$not_to_delete = array();
		foreach($this->input->post() as $key => $value)
		{
			if(strstr($key, 'dinner_table') && $key != 'dinner_table_enable')
			{

				$dinner_table_id = preg_replace("/.*?_(\d+)$/", "$1", $key);
				$not_to_delete[] = $dinner_table_id;

				// save or update
				$table_data = array('name' => $value);
				if($this->Dinner_table->save($table_data, $dinner_table_id))
				{
					$this->_clear_session_state();
				}
			}
		}

		// all locations not available in post will be deleted now
		foreach($deleted_tables as $dinner_table)
		{
			if(!in_array($dinner_table['dinner_table_id'],$not_to_delete))
			{
				$this->Dinner_table->delete($dinner_table['dinner_table_id']);
			}
		}

		$this->db->trans_complete();

		$success = $this->db->trans_status();

		echo json_encode(array(
			'success' => $success,
			'message' => $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully')
		));
	}

	public function save_rewards()
	{
		$this->db->trans_start();

		$this->Appconfig->save('customer_reward_enable', $this->input->post('customer_reward_enable'));

		$deleted_packages = $this->Customer_rewards->get_all()->result_array();
		$not_to_delete = array();
		$array_save = array();
		foreach($this->input->post() as $key => $value)
		{
			if(strstr($key, 'reward_points') && $key != 'customer_reward_enable')
			{
				$customer_reward_id = preg_replace("/.*?_(\d+)$/", "$1", $key);
				$not_to_delete[] = $customer_reward_id;
				$array_save[$customer_reward_id]['points_percent'] = $value;
			}

			if(strstr($key, 'customer_reward') && $key != 'customer_reward_enable')
			{
				$customer_reward_id = preg_replace("/.*?_(\d+)$/", "$1", $key);
				$not_to_delete[] = $customer_reward_id;
				$array_save[$customer_reward_id]['package_name'] = $value;
			}
		}

		if(!empty($array_save))
		{
			foreach($array_save as $key => $value)
			{
				// save or update
				$table_data = array('package_name' => $value['package_name'], 'points_percent' => $value['points_percent']);
				if($this->Customer_rewards->save($table_data, $key))
				{
					$this->_clear_session_state();
				}
			}
		}

		// all locations not available in post will be deleted now
		foreach($deleted_packages as $customer_reward)
		{
			if(!in_array($customer_reward['customer_reward_id'], $not_to_delete))
			{
				$this->Customer_rewards->delete($customer_reward['customer_reward_id']);
			}
		}

		$this->db->trans_complete();

		$success = $this->db->trans_status();

		echo json_encode(array(
			'success' => $success,
			'message' => $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully')
		));
	}
	
	public function save_reminders()
	{
		$this->db->trans_start();


		$deleted_packages = $this->Customer_rewards->get_all_reminders()->result_array();
		$not_to_delete = array();
		$array_save = array();
		foreach($this->input->post() as $key => $value)
		{
			if(strstr($key, 'reminder_name'))
			{
				$customer_reward_id = preg_replace("/.*?_(\d+)$/", "$1", $key);
				$not_to_delete[] = $customer_reward_id;
				$array_save[$customer_reward_id]['reminder_name'] = $value;
			}

			if(strstr($key, 'reminder_amount'))
			{
				$customer_reward_id = preg_replace("/.*?_(\d+)$/", "$1", $key);
				$not_to_delete[] = $customer_reward_id;
				$array_save[$customer_reward_id]['reminder_amount'] = $value;
			}
			if(strstr($key, 'reminder_value'))
			{
				$customer_reward_id = preg_replace("/.*?_(\d+)$/", "$1", $key);
				$not_to_delete[] = $customer_reward_id;
				$array_save[$customer_reward_id]['reminder_value'] = $value;
			}
		}

		if(!empty($array_save))
		{
			foreach($array_save as $key => $value)
			{
				// save or update
				$table_data = array('reminder_name' => $value['reminder_name'], 'reminder_amount' => $value['reminder_amount'], 'reminder_value' => $value['reminder_value']);
				if($this->Customer_rewards->save_reminder($table_data, $key))
				{
					$this->_clear_session_state();
				}
			}
		}

		// all locations not available in post will be deleted now
		
		$this->db->trans_complete();

		$success = $this->db->trans_status();

		echo json_encode(array(
			'success' => $success,
			'message' => $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully')
		));
	}


	public function save_barcode()
	{
		$batch_save_data = array(
			'barcode_type' => $this->input->post('barcode_type'),
			'barcode_quality' => $this->input->post('barcode_quality'),
			'barcode_width' => $this->input->post('barcode_width'),
			'barcode_height' => $this->input->post('barcode_height'),
			'barcode_font' => $this->input->post('barcode_font'),
			'barcode_font_size' => $this->input->post('barcode_font_size'),
			'barcode_first_row' => $this->input->post('barcode_first_row'),
			'barcode_second_row' => $this->input->post('barcode_second_row'),
			'barcode_third_row' => $this->input->post('barcode_third_row'),
			'barcode_num_in_row' => $this->input->post('barcode_num_in_row'),
			'barcode_page_width' => $this->input->post('barcode_page_width'),
			'barcode_page_cellspacing' => $this->input->post('barcode_page_cellspacing'),
			'barcode_generate_if_empty' => $this->input->post('barcode_generate_if_empty') != NULL,
			'barcode_content' => $this->input->post('barcode_content')
		);

		$result = $this->Appconfig->batch_save($batch_save_data);
		$success = $result ? TRUE : FALSE;

		echo json_encode(array(
			'success' => $success,
			'message' => $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully')
		));
	}

	public function save_receipt()
	{
		$batch_save_data = array (
			'receipt_template' => $this->input->post('receipt_template'),
			'receipt_show_company_name' => $this->input->post('receipt_show_company_name') != NULL,
			'receipt_show_taxes' => $this->input->post('receipt_show_taxes') != NULL,
			'receipt_show_total_discount' => $this->input->post('receipt_show_total_discount') != NULL,
			'receipt_show_description' => $this->input->post('receipt_show_description') != NULL,
			'receipt_show_serialnumber' => $this->input->post('receipt_show_serialnumber') != NULL,
			'print_silently' => $this->input->post('print_silently') != NULL,
			'print_header' => $this->input->post('print_header') != NULL,
			'print_footer' => $this->input->post('print_footer') != NULL,
			'print_top_margin' => $this->input->post('print_top_margin'),
			'print_left_margin' => $this->input->post('print_left_margin'),
			'print_bottom_margin' => $this->input->post('print_bottom_margin'),
			'print_right_margin' => $this->input->post('print_right_margin')
		);

		$result = $this->Appconfig->batch_save($batch_save_data);
		$success = $result ? TRUE : FALSE;

		echo json_encode(array(
			'success' => $success,
			'message' => $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully')
		));
	}

	public function save_invoice()
	{
		$batch_save_data = array (
			'invoice_enable' => $this->input->post('invoice_enable') != NULL,
			'default_register_mode' => $this->input->post('default_register_mode'),
			'sales_invoice_format' => $this->input->post('sales_invoice_format'),
			'sales_quote_format' => $this->input->post('sales_quote_format'),
			'recv_invoice_format' => $this->input->post('recv_invoice_format'),
			'invoice_default_comments' => $this->input->post('invoice_default_comments'),
			'invoice_email_message' => $this->input->post('invoice_email_message'),
			'line_sequence' => $this->input->post('line_sequence'),
			'last_used_invoice_number' =>$this->input->post('last_used_invoice_number'),
			'last_used_quote_number' =>$this->input->post('last_used_quote_number')
		);

		$result = $this->Appconfig->batch_save($batch_save_data);
		$success = $result ? TRUE : FALSE;

		// Update the register mode with the latest change so that if the user
		// switches immediately back to the register the mode reflects the change
		if($success == TRUE)
		{
			if($this->config->item('invoice_enable') == '1')
			{
				$this->sale_lib->set_mode($batch_save_data['default_register_mode']);
			}
			else
			{
				$this->sale_lib->set_mode('sale');
			}
		}

		echo json_encode(array(
			'success' => $success,
			'message' => $this->lang->line('config_saved_' . ($success ? '' : 'un') . 'successfully')
		));
	}

	public function remove_logo()
	{
		$result = $this->Appconfig->batch_save(array('company_logo' => ''));

		echo json_encode(array('success' => $result));
	}

	private function _handle_logo_upload()
	{
		$this->load->helper('directory');

		// load upload library
		$config = array('upload_path' => './uploads/',
				'allowed_types' => 'gif|jpg|png',
				'max_size' => '1024',
				'max_width' => '800',
				'max_height' => '680',
				'file_name' => 'company_logo');
		$this->load->library('upload', $config);
		$this->upload->do_upload('company_logo');

		return strlen($this->upload->display_errors()) == 0 || !strcmp($this->upload->display_errors(), '<p>'.$this->lang->line('upload_no_file_selected').'</p>');
	}

	private function _check_encryption()
	{
		$encryption_key = $this->config->item('encryption_key');

		// check if the encryption_key config item is the default one
		if($encryption_key == '' || $encryption_key == 'YOUR KEY')
		{
			// Config path
			$config_path = APPPATH . 'config/config.php';

			// Open the file
			$config = file_get_contents($config_path);

			// $key will be assigned a 32-byte (256-bit) hex-encoded random key
			$key = bin2hex($this->encryption->create_key(32));

			// set the encryption key in the config item
			$this->config->set_item('encryption_key', $key);

			// replace the empty placeholder with a real randomly generated encryption key
			$config = preg_replace("/(.*encryption_key.*)('');/", "$1'$key';", $config);

			$result = FALSE;

			// Chmod the file
			@chmod($config_path, 0777);

			// Write the new config.php file
			$handle = fopen($config_path, 'w+');

			// Verify file permissions
			if(is_writable($config_path))
			{
				// Write the file
				$result = (fwrite($handle, $config) === FALSE) ? FALSE : TRUE;
			}

			fclose($handle);

			// Chmod the file
			@chmod($config_path, 0444);

			return $result;
		}

		return TRUE;
	}

	public function backup_db()
	{
		$employee_id = $this->Employee->get_logged_in_employee_info()->person_id;
		if($this->Employee->has_module_grant('config', $employee_id))
		{
			$this->load->dbutil();

			$prefs = array(
				'format' => 'zip',
				'filename' => 'ospos.sql'
			);

			$backup = $this->dbutil->backup($prefs);

			$file_name = 'ospos-' . date("Y-m-d-H-i-s") .'.zip';
			$save = 'uploads/' . $file_name;
			$this->load->helper('download');
			while(ob_get_level())
			{
				ob_end_clean();
			}

			force_download($file_name, $backup);
		}
		else
		{
			redirect('no_access/config');
		}
	}
}
?>
