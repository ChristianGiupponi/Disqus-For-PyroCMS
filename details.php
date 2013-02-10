<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Disqus Details File
 *
 * @package  	PyroCMS
 * @subpackage  Disqus
 * @category  	Comments
 * @author  	Dan Sullivan
 */ 
class Module_Disqus extends Module {

	public $version = '1.2.0';
	
	public $db_pre;

 	// --------------------------------------------------------------------------

	public function __construct()
	{	
		
	}

	// --------------------------------------------------------------------------
	
 	public function info()
	{
		return array(
		    'name' => array(
		        'en' => 'Disqus'
		    ),
		    'description' => array(
		        'en' => 'Manage disqus comments'
		    ),
		    'frontend' => false,
			'backend' => true,
			'menu' => 'content',
			'author' => 'Dan Sullivan',
			'roles' => array('admin_disqus'),
			'shortcuts' => array(
				array(
			 	   'name' => 'disqus.manage_shortname',
				   'uri' => 'admin/disqus/setup',
				   'class' => ''
				),
			),

		);
	}

	// --------------------------------------------------------------------------

	public function install()
	{
		$settings =  array(
			'slug' => 'disqus_short_name',
			'title' => 'Short Name',
			'description' => 'Your Disqus short name',
			'type' => 'text',
			'default' => '',
			'value' => '',
			'options' => '',
			'is_required' => 1,
			'is_gui' => 1,
			'module' => 'disqus',
			'order' => 0,
		);

		// Lets add the disqus short name setting
		if ( ! $this->db->insert('settings', $settings))
		{
			log_message('debug', '-- -- could not install Disqus Settings');
			return false;
		}

		return true;
	}

	// --------------------------------------------------------------------------

	public function uninstall()
	{
		// Get rid of the disqus short name setting
		return $this->db->delete('settings', array('slug' => 'disqus_short_name'));
	}

	// --------------------------------------------------------------------------

	public function upgrade($old_version)
	{
 	
		return true;
	}

	// --------------------------------------------------------------------------

	public function help()
	{
		return "No documentation has been added for this module.<br/>Contact the module developer for assistance.";
	}

}