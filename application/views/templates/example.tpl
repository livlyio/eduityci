{include file="header.tpl" title="Example Smarty Page" name="$Name"}

<h1>
{if $bold}<b>{/if}
{* capitalize the first letters of each word of the title *}
Title: {$title|capitalize}
{if $bold}</b>{/if}
</h1>

<p>The current date and time is <em>{$smarty.now|date_format:"%Y-%m-%d %H:%M:%S"}</em></p>

<p>The value of global assigned variable $SCRIPT_NAME is <em>{$SCRIPT_NAME}</em></p>

<p>The value of server environment variable SERVER_NAME is <em>{$smarty.server.SERVER_NAME}</em></p>

<p>The value of your IP address is: <em>{$ip_address}</em></p>

<p>The value of {ldelim}$Name{rdelim} is <em>{$Name}</em></p>

<p>The value of {ldelim}$Name|upper{rdelim} is <em>{$Name|upper}</em></p>

<h2>An example of a section loop:</h2>
<ul>
{section name=outer loop=$FirstName}
{if $smarty.section.outer.index is odd by 2}
	<li>{$smarty.section.outer.rownum} . {$FirstName[outer]} {$LastName[outer]}</li>
{else}
	<li>{$smarty.section.outer.rownum} * {$FirstName[outer]} {$LastName[outer]}</li>
{/if}
{sectionelse}
	<li>none</li>
{/section}
</ul>

<h2>An example of section looped key values:</h2>
{section name=sec1 loop=$contacts}</li>
<ul>
	<li>phone: {$contacts[sec1].phone}</li>
	<li>fax: {$contacts[sec1].fax}</li>
	<li>cell: {$contacts[sec1].cell}</li>
</ul>
{/section}

<h2>An example testing strip tags:</h2>
{strip}
<table border=0>
	<tr>
		<td>
			<a HREF="{$SCRIPT_NAME}">
			<font color="red">This is a  test     </font>
			</a>
		</td>
	</tr>
</table>
{/strip}


<h2>An example of the html_select_date function:</h2>

<form>
{html_select_date start_year=1998 end_year=2010}
</form>

<h2>An example of the html_select_time function:</h2>

<form>
{html_select_time use_24_hours=false}
</form>



{include file="footer.tpl"}
