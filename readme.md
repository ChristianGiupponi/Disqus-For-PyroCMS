# PyroCMS Disqus Plugin

Simple plugin that allows you to add Disqus code anywhere on your site.

## Installation

If you don't have a Disqus account, you can get one at [Disqus.com](http://www.disqus.com/) Drop the __disqus.php__ file into your _addons/default/plugins_ or _addons/share\_addons/plugins_ folder.

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
		<td>An ID for the comment thread. If this is not specified, this plugin will use the ID of the current page or current URI String.</td>
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

Additionally, if you need to put out the script on a page without rendering the comment box (like you would on pages that render the comment count on specific posts) you can use the following code:

	{{ disqus:script shortname="shortname" }}

As long as you use this plugin to output the script, it will check to make sure the script does not get output twice.