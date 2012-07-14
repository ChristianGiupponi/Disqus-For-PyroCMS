# PyroCMS Disqus Plugin

Simple plugin that allows you to add Disqus code anywhere on your site.

## Installation

If you don't have a Disqus account, you can get one at [Disqus.com](http://www.disqus.com/) Drop the disqus.php file into your addons/default/plugins or addons/share\_addons/plugins folder.

## Usage

To work, all you need to do is specify your Disqus shortname:

	{{ disqus:show shortname="shortname" }}

For further customization, here is a list of all available parameters:

<table>

	<tr>
		<td>shortname</td>
		<td>Your official Disqus shortname. This is the only required parameter.</td>
	</tr>

	<tr>
		<td>dev</td>
		<td>Set this to '1' or 'on' to turn on Disqus developer mode. This is automatically set for your local and staging environment using the ENVIRONMENT constant.</td>
	</tr>

	<tr>
		<td>id</td>
		<td>An ID for the comment thread. If this is not specified, this plugin will use the ID of the current page.</td>
	</tr>

	<tr>
		<td>url</td>
		<td>A URL for the comment thread. If this is not specified, this plugin will use the page URL for the current page.</td>
	</tr>

	<tr>
		<td>title</td>
		<td>Title for the comment thread. If this is not specific, this plugin will leave the value blank, which will cause Disqus to use the current page's title meta attribute.</td>
	</tr>

	<tr>
		<td>category_id</td>
		<td>A category ID for the comment thread. See the [Disqus developer documentation](http://help.disqus.com/customer/portal/articles/472098-javascript-configuration-variables) for more information.</td>
	</tr>

</table>