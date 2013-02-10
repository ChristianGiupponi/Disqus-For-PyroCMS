<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Disqus Admin Controller Class
 *
 * @package  	PyroCMS
 * @subpackage  Disqus
 * @category  	Controller
 * @author  	Dan Sullivan
 */ 
class Admin extends Admin_Controller {

	// --------------------------------------------------------------------------


	/**
	 * Construct
	 *
	 * @return	void
	 */
	public function __construct()
	{
		parent::__construct();
		
		$this->load->language('disqus');
	}

	/**
	 * Index
	 *
	 * @return	void
	 */
	public function index()
	{
		$settings = $this->settings_m->get('disqus_short_name');
		//Redirect to setup page if short name not set.
		if (!$settings->value){
			redirect('admin/disqus/setup');
		} 
		else
		{
			$this->template->short_name = $settings->value;
			$this->template->build('admin/index');
		}
		
	}

	/**
	 * Setup
	 *
	 * @return	void
	 */
	public function setup()
	{
		$section = 'setup';
		$this->template->settings = $this->settings_m->get('disqus_short_name');
		$this->template->build('admin/setup');
	}

	/**
	 * Edit
	 *
	 * @return	void
	 */
	public function edit()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('disqus_short_name', 'Disqus short name', 'required');

		// Got valid data?
		if ($this->form_validation->run())
		{
			$input_value = $this->input->post('disqus_short_name', FALSE);
			$this->settings->set('disqus_short_name', $input_value);

			// Success...
			$this->session->set_flashdata('success', $this->lang->line('settings_save_success'));
		}
		elseif (validation_errors())
		{
			$this->session->set_flashdata('error', validation_errors());
		}

		// Redirect user back to index page or the module/section settings they are editing
		redirect('admin/disqus');
	}

}