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
	
	/*
	 *	Usage:
	 *		{{ disqus:show shortname="shortname" [dev="1"] [page_id:page:id] [page_url:slug]}}
	 *
	 *	dev="1" => Allow comments on localhost for test
	 *	If dev is not set it will be set to 0 by default
	 *
	 *	If page_id is set it will use the id of the page to associate the comments to the page,
	 *	in this way you can canghe your url but i will not lose the comments.
	 *
	 */
	function show(){
		
		$shortname 	= $this->attribute('shortname');
		$dev	= $this->attribute('dev');
		$id		= $this->attribute('page_id');
		$link	= $this->attribute('page_url');
		
		$str =("
			<div id=\"disqus_thread\"></div>
			<script type=\"text/javascript\">
			    var disqus_shortname = '$shortname';  
			");
			
			if($dev==1)
				$str .=(" var disqus_developer=1;");
			
			if(trim($id)!="")
				$str .=(" var disqus_identifier='$id'; ");
			
			if(trim($link)!="")
				$str .=(" var disqus_url='$link'; ");
				
			$str .=("
			    /* * * DON'T EDIT BELOW THIS LINE * * */
			    (function() {
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