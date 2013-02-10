<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      Christian Giupponi STILOGO, Adam Fairholm and Dan Sullivan
 * @link        http://www.stilogo.it | http://parse19.com
 * @package     PyroCMS
 * @subpackage  Disqus
 * @category    Comments
 * @license     FREE
 */

class Plugin_Disqus extends Plugin{

	public $version = '1.2.0';

	/**
	 * Included Disqus script on Page already?
	 * @var bool
	 */
	public static $included = false;

	public $name = array(
		'it'	=> 'Disqus Plugin',
		'en'	=> 'Disqus Plugin',
	);

	public $description = array(
		'it'	=> 'Permette di aggiungere i commenti Disqus alle tue pagine.',
		'en'	=> 'Allows you to add Disqus comments on your pages'		
	);
	
	public function _self_doc()
	{
		$info = array(
			'show' => array(
				'description' => array(
					'en' => 'Allows you to add Disqus comments on your pages'
				),
				'single' => true,
				'double' => false,
				'variables' => 'shortname|dev|id|url|title|category_id|script_only',
				'attributes' => array(
					'shortname' => array(
						'type' => 'text',
						'flags' => '',
						'default' => '',
						'required' => true,
					),
					'dev' => array(
						'type' => 'text',
						'flags' => '1 or on',
						'default' => 'PYRO_ENV',
						'required' => false
					),
					'id' => array(
						'type' => 'number',
						'flags' => '',
						'default' => 'Page ID',
						'required' => false
					),
					'url' => array(
						'type' => 'text',
						'flags' => '',
						'default' => 'Page URI',
						'required' => false
					),
					'title' => array(
						'type' => 'text',
						'flags' => '',
						'default' => '',
						'required' => false
					),
					'category_id' => array(
						'type' => 'number',
						'flags' => '',
						'default' => '',
						'required' => false
					),
					'script_only' => array(
						'type' => 'bool',
						'flags' => '',
						'default' => 'false',
						'required' => false
					),
				),
			),
		);
	
		return $info;
	}

	
	/**
	 * Show Disqus Code
	 *
	 *	Basic Usage:
	 *		{{ disqus:show shortname="shortname" }}
	 *
	 *	See readme.md for documentation.
	 */
	public function show($script_only = false){
		
		// if we've already included the script, don't do it again
		if ($this->included) {
			return;
		}

		$shortname   = $this->attribute('shortname');
		$dev         = $this->attribute('dev');
		$id          = $this->attribute('id');
		$link        = $this->attribute('url');
		$title       = $this->attribute('title');
		$cat_id      = $this->attribute('category_id');
		$script_only = $this->attribute('script_only', $script_only);

		if (!$shortname){
			$settings = $this->settings_m->get('disqus_short_name');
			if ($settings->value){
				$shortname = $settings->value;
			} 
		}

		// Get the current page.
		$url_segments = $this->uri->segment_array();
		$page = ($url_segments)
			? $this->pyrocache->model('page_m', 'get_by_uri', array($url_segments, true))
			: $this->pyrocache->model('page_m', 'get_home');

		// If there is no ID, use the page ID
		if ( ! $id and isset($page->id))
		{
			$id = $page->id;
		}
		elseif ( ! $id ) {
			$id = $this->uri->uri_string();
		}

		// Disqus "highly recommends" defining the 
		// url variable, so let's do that.
		if ( ! $link and isset($page->uri))
		{
			$this->load->helper('url');
			$link = site_url($page->uri);
		}
		elseif ( ! $link ) {
			$this->load->helper('url');
			$link = site_url($this->uri->uri_string());
		}
		
		// output string
		$str = '';
		
		if ( ! $script_only) {
			$str .="<div id=\"disqus_thread\"></div>\n";
		}
		
		$str .= "<script type=\"text/javascript\">\n";

		// We always have a shortname.
		$str .= "\tvar disqus_shortname = '$shortname';\n";
		
		// Acceptable values for dev are 1 or on
		if ($dev == 1 or $dev == 'on' or (ENVIRONMENT == PYRO_DEVELOPMENT or ENVIRONMENT == PYRO_STAGING))
		{
			$str .= "\tvar disqus_developer = 1;\n";
		}

		if ($link)
		{
			$str .= "\tvar disqus_url = '$link';\n";
		}

		if ($id)
		{
			$str .= "\tvar disqus_identifier = '$id';\n";
		}

		if ($title)
		{
			$str .= "\tvar disqus_title = '$title';\n";
		}

		if ($cat_id)
		{
			$str .= "\tvar disqus_category_id = '$cat_id';\n";
		}

		$str .=("\t(function() {
		var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
		dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
		(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
	})();
	</script>");
		
		if ( ! $script_only) {
			$str .= ("\n\t<noscript>Please enable JavaScript to view the <a href=\"http://disqus.com/?ref_noscript\">Comments powered by Disqus.</a></noscript>
		<a href=\"http://disqus.com\" class=\"dsq-brlink\">Comments powered by <span class=\"logo-disqus\">Disqus</span></a>
			");
		}
		
		$this->included = true;
		
		return $str;
	}

	
	/**
	 * Include Disqus script without showing comments
	 *
	 *	Basic Usage:
	 *		{{ disqus:script shortname="shortname" }}
	 *
	 *	See readme.md for documentation.
	 */
	public function script()
	{
		return $this->show(true);
	}
}
