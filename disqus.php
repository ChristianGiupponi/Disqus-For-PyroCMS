<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author      Christian Giupponi STILOGO
 * @link		http://www.stilogo.it
 * @package 	PyroCMS
 * @subpackage  Disqus
 * @category	Comments
 * @license     FREE
 */

class Plugin_Disqus extends Plugin{
	
	/**
	 * Show Disqus Code
	 *
	 *	Basic Usage:
	 *		{{ disqus:show shortname="shortname" }}
	 *
	 *	See readme.md for documentation.
	 */
	public function show(){
		
		$shortname 	= $this->attribute('shortname');
		$dev		= $this->attribute('dev');
		$id			= $this->attribute('id');
		$link		= $this->attribute('url');
		$title 		= $this->attribute('title');
		$cat_id 	= $this->attribute('category_id');

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

		// Disqus "highly recommends" defining the 
		// url variable, so let's do that.
		if ( ! $link and isset($page->uri))
		{
			$this->load->helper('url');
			$link = site_url($page->uri);
		}

		$str =("<div id=\"disqus_thread\"></div>
			<script type=\"text/javascript\">\n");

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
	</script>
	<noscript>Please enable JavaScript to view the <a href=\"http://disqus.com/?ref_noscript\">comments powered by Disqus.</a></noscript>
	<a href=\"http://disqus.com\" class=\"dsq-brlink\">blog comments powered by <span class=\"logo-disqus\">Disqus</span></a>
		");
		
		return $str;
	}
}