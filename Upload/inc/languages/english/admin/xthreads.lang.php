<?php

$l['xthreads_name'] = 'XThreads';
$l['xthreads_desc'] = 'eXtends Thread capabilities.';
$l['xthreads_fun_desc'] = 'now taking up less space in your ACP plugins list.';
$l['xthreads_install_and_activate'] = 'Install &amp; activate this bad boy';

$l['xthreads_rebuildxtathumbs'] = 'Rebuild XThreads Attachment Thumbnails';
$l['xthreads_rebuildxtathumbs_desc'] = 'This will rebuild thumbnails for images uploaded using the XThreads attachment system (custom thread fields with image uploads).';
$l['xthreads_rebuildxtathumbs_done'] = 'Successfully rebuilt all XThreads attachment thumbnails.';
$l['xthreads_rebuildxtathumbs_nofields'] = 'There are no thread fields which generate thumbnails.';
$l['xthreads_rebuildxtathumbs_nothumbs'] = 'There are no thumbnails to rebuild.';

$l['custom_threadfields'] = 'Custom Thread Fields';
$l['can_manage_threadfields'] = 'Can manage custom thread fields';
$l['custom_threadfields_desc'] = 'You can add/edit/remove custom thread fields here.';
$l['threadfields_name'] = 'Key';
$l['threadfields_name_desc'] = 'The key through which this field is accessed through.  Should be kept to alphanumeric characters and underscores (_) only.  Note that only inputs for this field on newthread/editpost are automatically added for you; forumdisplay/showthread etc templates aren\'t affected, so you will need to make changes to the relevant templates for this to be useful.  Use <code>{$GLOBALS[\'threadfields\'][\'<em style="color: #00A000;">key</em>\']}</code> in templates to reference this field (this is slightly different for file inputs - more info given below if you choose to make a file input).';
$l['threadfields_file_name_info'] = 'Variables are referenced with <code>{$GLOBALS[\'threadfields\'][\'<em style="color: #00A000;">key</em>\'][\'<em style="color: #0000A0;">item</em>\']}</code>, where <em style="color: #0000A0;">item</em> can be one of the following:
<ul style="margin-top: 0.2em;">
	<li><em>downloads</em> - number of times the file has been downloaded</li>
	<li><em>downloads_friendly</em> - as above, but number is formatted (eg 1,234 vs 1234)</li>
	<li><em>filename</em> - original name of the uploaded file</li>
	<li><em>uploadmime</em> - MIME type sent by uploader\'s browser</li>
	<li><em>url</em> - URL of the file</li>
	<li><em>filesize</em> - size of file, in bytes</li>
	<li><em>filesize_friendly</em> - as above, but formatted (eg 1.5MB vs 1572864)</li>
	<li><em>md5hash</em> - MD5 hash of file (note: not guaranteed to be set for larger files)</li>
	<li><em>upload_time</em> - time when file was initially uploaded</li>
	<li><em>upload_date</em> - date when file was initially uploaded</li>
	<li><em>update_time</em> - time when file was last updated (will be upload_time if never updated)</li>
	<li><em>update_date</em> - date when file was last updated (will be upload_date if never updated)</li>
	<li><em>value</em> - if no file is uploaded, will be Blank Value (see below), otherwise, will be Display Format</li>
	<li><em>dims</em> - an array containing width/height of uploaded image if the option to require image uploads is chosen.  For example <code>{$GLOBALS[\'threadfields\'][\'myimage\'][\'dims\'][\'w\']}</code> would get the width of the uploaded image.</li>
	<li><em>thumbs</em> - an array containing width/height/URL of thumbnails (if used).  For example <code>{$GLOBALS[\'threadfields\'][\'myimage\'][\'thumbs\'][\'320x240\'][\'w\']}</code> would get the real image width of the 320x240 thumbnail.</li>
</ul>
For file inputs accepting multiple values, the above only exists in an array as <code>{$GLOBALS[\'threadfields_x\'][\'<em style="color: #00A000;">key</em>\'][\'items\'][<em>index</em>][\'<em style="color: #0000A0;">item</em>\']}</code>, where <em>index</em> is 0 for the 1st attachment, 1 for the 2nd etc.  The <code><em style="color: #0000A0;">value</em></code> can also be accessed through <code>{$GLOBALS[\'threadfields_x\'][\'<em style="color: #00A000;">key</em>\'][\'value\'][<em>index</em>]}</code>. For <code>{$GLOBALS[\'threadfields\'][\'<em style="color: #00A000;">key</em>\'][\'<em style="color: #0000A0;">item</em>\']}</code>, <em style="color: #0000A0;">item</em> can be one of the following:
<ul style="margin-top: 0.2em;">
	<li><em>num_files</em> - number of files uploaded</li>
	<li><em>num_files_friendly</em> - as above, but number is formatted (eg 1,234 vs 1234)</li>
	<li><em>total_downloads</em> - sum of download counts</li>
	<li><em>total_downloads_friendly</em> - as above, but number is formatted (eg 1,234 vs 1234)</li>
	<li><em>total_filesize</em> - sum of file sizes, in bytes</li>
	<li><em>total_filesize_friendly</em> - as above, but formatted (eg 1.5MB vs 1572864)</li>
	<li><em>upload_time</em> - time when latest file was uploaded</li>
	<li><em>upload_date</em> - date when latest file was uploaded</li>
	<li><em>value</em> - if no file is uploaded, will be Blank Value (see below), otherwise, will be Display Item Format, joined together with Multiple Value Delimiter, then formatted by Display Format</li>
</ul>';
$l['threadfields_file_upload_disabled_warning'] = 'It appears that file uploading has been disabled on this server.  XThreads assumes that it is enabled, so if a user tries to upload something, it will fail unless you enable file uploads (URL fetching will still work if enabled).  Please set the <em>file_uploads</em> php.ini value to \'1\'.';
$l['threadfields_title'] = 'Title';
$l['threadfields_title_desc'] = 'Name of this custom thread field.';
$l['threadfields_desc'] = 'Description';
$l['threadfields_desc_desc'] = 'A short description of this field which is placed under the name in the input field for newthread/editpost pages.';
$l['threadfields_inputtype'] = 'Input Field Type';
$l['threadfields_inputtype_desc'] = 'What the user is presented with when they wish to edit the data of this custom field.  Tip: you may be able to use more exotic input arragements via template edits.';
$l['threadfields_editable'] = 'Editable by / Required Field?';
$l['threadfields_editable_desc'] = 'Specify who is allowed to modify the value of this field.  Can also be used to set whether this field is required to be filled out or not.  Note that a required field implies that everyone can edit this field.  Also note that it is possible to not have a required field filled in, for example, a moderator moving a thread from a forum which doesn\'t have the field.';
$l['threadfields_editable_gids'] = 'Editable by Usergroups';
$l['threadfields_editable_gids_desc'] = 'Specify which usergroups are allowed to edit this field.';
$l['threadfields_editable_values'] = 'Settable Value Permissions';
$l['threadfields_editable_values_desc'] = 'Here, you can restrict values particular usergroups can set for this field.<noscript>  Put separate values on separate lines, and separate values and usergroups with the three characters <code>{|}</code>.  Separate multiple groups with commas.  Example: <code>special value{|}1,2,3</code> - the value <em>special value</em> can only be set by users in groups (ID) 1, 2 or 3.</noscript>
<br />Note that when editing a thread, if a thread has a value already set to a value the editing user cannot set, the user will not be forced to change the value.';
$l['threadfields_viewable_gids'] = 'Viewable by Usergroups';
$l['threadfields_viewable_gids_desc'] = 'You can specify usergroups which can view the value of this field.  Selecting none means it is viewable to all usergroups.  Note that filtering and sorting by this thread field is affected by this setting.';
$l['threadfields_unviewableval'] = 'Unviewable Value';
$l['threadfields_unviewableval_desc'] = 'What to display to usergroups who cannot view the value of this field.  This works exactly the same as the <em>Display Format</em> above (even <code>{VALUE}</code> works, so this could also be used to display something different to select usergroups).  Note that, because of this, the <em>Blank Value</em> will always take precedence over this if the value is blank!';
$l['threadfields_forums'] = 'Applicable Forums';
$l['threadfields_forums_desc'] = 'Select the forums where this custom thread field will be used.  Leave blank (select none) to make this field apply to all forums.';
$l['threadfields_sanitize'] = 'Display Parsing';
$l['threadfields_sanitize_desc'] = 'How the value is parsed when displayed, eg allow MyCode, HTML or just plain text.';
$l['threadfields_sanitize_parser'] = 'MyBB Parser Options';
$l['threadfields_sanitize_parser_desc'] = 'These options only apply if you have selected to parse this field with the MyBB parser.';
$l['threadfields_disporder'] = 'Display Order';
$l['threadfields_disporder_desc'] = 'The order in which this field is displayed amongst other thread fields.';
$l['threadfields_tabstop'] = 'Capture Tab Key';
$l['threadfields_tabstop_desc'] = 'If Yes, this field will intercept and respond to the user pressing the Tab key, when cycling through form elements.  Tab index will depend on the order specified above; it will always be placed between the subject and message field\'s tab index.  Note that setting this to No won\'t stop this field from responding to the Tab key - it simply won\'t set a <code>tabindex</code> property for this field.';
$l['threadfields_hidefield'] = 'Hide Thread Field';
$l['threadfields_hidefield_input'] = 'Hide input field on New/edit thread';
$l['threadfields_hidefield_input_desc'] = 'Hides the input field on newthread/editpost pages through the <code>{$extra_threadfields}</code> variable.  This is useful if you want to place it in a different location.  You can access the HTML for this field by using <code>{$tfinputrow[\'<em>key</em>\']}</code>, which includes all the table markup (see <em>post_threadfields_inputrow</em> template).  Or, you can use <code>{$tfinput[\'<em>key</em>\']}</code> which gives the input field HTML without table markup (it\'s equivalent to the <code>{$inputfield}</code> variable in the <em>post_threadfields_inputrow</em> template).';
$l['threadfields_hidefield_thread'] = 'Hide on Show thread';
$l['threadfields_hidefield_thread_desc'] = 'Hides the value of this field from the thread display page (via the <code>{$threadfields_display}</code> variable in the <em>showthread_threadfields</em> template).  You can display the variable via the <code>{$GLOBALS[\'threadfields\'][\'<em>key</em>\']}</code> variable (file fields are slightly different, see below if this is a file field).';
$l['threadfields_hidefield_forum_sort'] = 'Forum display sorter list';
$l['threadfields_hidefield_forum_sort_desc'] = 'Hide this thread field from the \'Sort by\' combo box in forum display';
$l['threadfields_hidefield_desc'] = 'Hide this thread field in certain places.  This is mainly useful if you wish to customise the display of the thread field through template editing - usually the field can still be displayed through a template variable.';
$l['threadfields_allowfilter'] = 'Filtering Mode';
$l['threadfields_allowfilter_desc'] = 'Allows users to filter threads using this thread field in forumdisplay.  The URL is based on the <code>filtertf_<em>key</em></code> variable.  For example, if set to <em>Exact match</em>, <code>forumdisplay.php?fid=2&amp;filtertf_status=Resolved</code> will only show threads with the thread field &quot;status&quot; having a value of &quot;Resolved&quot;.
<br />Note that:
<ul>
	<li>Multiple filters (amongst different thread fields) act as an AND - that is, only threads that meet both specified requirements will be shown.</li>
	<li>Multiple values can be specified for one thread field - this will act as an OR operation.  Using the above example, <code>forumdisplay.php?fid=2&amp;filtertf_status[]=Resolved&amp;filtertf_status[]=Rejected&amp;filtertf_cat=Technical</code> will display threads with the thread field &quot;cat&quot; equalling &quot;Technical&quot; <em>and</em> &quot;status&quot; being either &quot;Resolved&quot; <em>or</em> &quot;Rejected&quot;.</li>
	<li>This setting does not affect templates, so you may need to make appropriate template changes for this option to be useful.</li>
	<li>Setting this to <em>Contains</em> or <em>Wildcard</em>, or, if this field allows multiple values (or checkbox input), filtering can be rather slow and increase server load by a fair bit.</li>
	<li>Matching is usually case insensitive (this depends on your database setup), so &quot;derp&quot; exactly matches &quot;DeRP&quot;, at least, in typical MySQL setups</li>
	<li>For <em>Wildcard</em> filtering, <code>?</code> refers to any single character, whilst <code>*</code> refers to any sequence of characters (including the 0-character sequence); be aware that these two characters may need URL encoding</li>
	<li>If the data type for this field is numeric (integer/float), all options other than <em>Disabled</em> act like <em>Exact match</em>.  However, filters accept some extended operands:<ul>
		<li><code>&gt;</code> - greater-than operator, example use: <code>&gt;5</code> will only display threads where the value of this field is greater than 5</li>
		<li><code>&lt;</code>, <code>&lt;=</code>, <code>&gt;=</code>, <code>&lt;&gt;</code> - less-than, less-than-or-equal, greater-than-or-equal, not-equal-to operators</li>
		<li><code>-</code> - between operator, example use: <code>2-5</code> will only display threads where the value of this field is between 2 and 5 inclusive</li>
		<li><code>_</code> - exclusion operator, example use: <code>2_5</code> will only display threads where the value of this field is NOT between 2 and 5 inclusive</li>
		<li><code>,</code> - list delimeter, example use: <code>1,2,5</code> will only display threads where the value of this field is either 1, 2 or 5</li>
		<li><code>~</code> - exclusion list indicator, example use: <code>~3,4</code> will only display threads where the value of this field is neither 3 nor 4</li>
	</ul>Remember that some of these characters may need URL encoding.  Example: <code>forumdisplay.php?fid=2&amp;filtertf_price=%3C%3D100&amp;filtertf_speed[]=1-4&amp;filtertf_speed[]=8</code> will display threads with <em>price</em> less-than-or-equal to 100, AND <em>speed</em> either between 1 and 4 (inclusive) or equals 8</li>
</ul>';
$l['threadfields_blankval'] = 'Blank Replacement Value';
$l['threadfields_blankval_desc'] = 'You can specify a custom value to be displayed if the user leaves this field blank (does not enter anything).  This field is not sanitised, so you can enter HTML etc here.  Some variables will work like <code>{$fid}</code>, as well as <a href="http://mybbhacks.zingaburga.com/showthread.php?tid=464">conditionals</a>.  Note, for file inputs, this is stored in <code>{$GLOBALS[\'threadfields\'][\'<em>key</em>\'][\'value\']}</code>';
$l['threadfields_defaultval'] = 'Default Value';
$l['threadfields_defaultval_desc'] = 'The default value for this field for new threads.  For example, if the type is a textbox, this value will fill the textbox by default, or if a selection list, this will be the default item which is selected.  You can select multiple options by default for multiple-select boxes and check boxes by separating selected items with a new line.  Variables and conditionals supported here - note that these are applied before the separation for multiple values are done (if necessary).';
$l['threadfields_dispformat'] = 'Display Format';
$l['threadfields_dispformat_desc'] = 'Custom formatting applied to value.  Use {VALUE} to represet the value of this field (non-file fields only).  This is only displayed if this field has a value (otherwise the above Blank Value is used).  Like above, this field is not parsed.  For file inputs, use {FILENAME}, {FILESIZE_FRIENDLY}, {UPLOAD_DATE} etc instead.<br /><em>Display Parsing</em> has no effect on <em>Display Format</em>, so you should enter HTML here.  This can also accept some variables, eg <code>{$fid}</code>, as well as <a href="http://mybbhacks.zingaburga.com/showthread.php?tid=464">conditionals</a> (&lt;template ...&gt; calls not supported).';
$l['threadfields_dispitemformat'] = 'Display Item Format';
$l['threadfields_dispitemformat_desc'] = 'Like the &quot;Display Format&quot; field, but this one will be applied to every single value for this field as opposed to being applied to the concatenated list of values.';
$l['threadfields_datatype'] = 'Underlying Data Type';
$l['threadfields_datatype_desc'] = 'The underlying storage data format for this field.  This should be left as the default value, <em>Text</em>, unless you have a particular reason not to do so.  Non-<em>Text</em> datatypes cannot accept multiple values.
<br /><span style="color: red;">Warning: changing this option may cause data loss to existing data stored in this thread field!</span>';
$l['threadfields_datatype_text'] = 'Text';
$l['threadfields_datatype_int'] = 'Integer (signed, usually 32-bit)';
$l['threadfields_datatype_uint'] = 'Integer (unsigned, usually 32-bit)';
$l['threadfields_datatype_bigint'] = 'Big Integer (signed, usually 64-bit)';
$l['threadfields_datatype_biguint'] = 'Big Integer (unsigned, usually 64-bit)';
$l['threadfields_datatype_float'] = 'Float (double precision)';
$l['threadfields_multival_enable'] = 'Allow multiple values for this field';
$l['threadfields_multival_enable_desc'] = 'Allow the user to specify multiple input values for this field? (eg multiple tags for a single thread)  Note, for textbox inputs, the comma (,) will be used as a delimiter, whereas for textarea, newlines will be considered as a delimiter.<br /><span style="color: red;">Warning for file inputs only: changing a multi-value file input to single-value can cause data loss and (XThreads\') attachment orphaning!</span> (though in general, you probably shouldn\'t change multi-valued inputs to single-value regardless of input type, since it can cause some unexpected results)';
$l['threadfields_multival'] = 'Multiple Value Delimiter';
$l['threadfields_multival_desc'] = 'The delimiter used to separate multiple values when displayed.  This value is not parsed (i.e. you can use HTML etc here).';
$l['threadfields_multival_limit'] = 'Maximum Number of Values';
$l['threadfields_multival_limit_desc'] = 'If not 0 (unlimited), limits the number of values that can be specified in this multi-value field.  Note that, even if set to 0, there will be some internal limit that will get enforced.';
$l['threadfields_textmask'] = 'Text Mask Filter';
$l['threadfields_textmask_desc'] = 'Enter a regular expression which entered text must match (evaluated with <a href="http://php.net/manual/en/function.preg-match.php" target="_blank">preg_match</a>, using <em>s</em> and <em>i</em> flags) for it to be valid.  Captured patterns can be used in Display Format and similar fields through <code>{VALUE$1}</code> etc';
$l['threadfields_inputformat'] = 'Input Formatter';
$l['threadfields_inputformat_desc'] = 'Similar to the <em>Display Format</em> option, however this is applied before saving the value to the database (as opposed to formatting on page view).  This means that customisations here will be reflected in the value shown when a user edits the thread (you can use <em>Custom Input HTML</em> to change this behaviour if desired).  In general, you should use <em>Display Format</em> over this - this is aimed at providing advanced functionality.  Note that this is always applied on newthread, but only applied on edit if the user supplies a value; if the user does not supply a value for newthread, <code>{VALUE}</code> will be null.  Also note that if you\'ve enabled multiple values for this field, this is applied after the multiple values have been joined together.';
$l['threadfields_inputvalidate'] = 'Custom Modify Error';
$l['threadfields_inputvalidate_desc'] = 'If evaluates to a non-empty value, displays it as an error whenever the user submits a new thread or edits a thread.  Example:
<code style="display: block; margin-left: 2em;">
&lt;if intval({VALUE}) < 1 or intval({VALUE}) > 5 then&gt;
<br />&nbsp;&nbsp;You must enter a value between 1 and 5.
<br />&lt;/if&gt;
</code>
Like the <em>Input Formatter</em> option, this is not evaluated when editing a thread and the user has sent no value, and is evaluated after multiple values are joined together (except with file inputs).  <code>{VALUE}</code> is not available for file inputs, instead use <code>{FILENAME}</code>, <code>{FILESIZE}</code> and <code>{NUM_FILES}</code>.';
$l['threadfields_maxlen'] = 'Maximum Text Length';
$l['threadfields_maxlen_desc'] = 'The maximum valid length for the entered value.  0 means no maximum, however, note that the database engine will probably enforce a maximum length.  You should assume this length does not exceed 255 characters (or 65535 characters for the multiline textbox).';
$l['threadfields_fieldwidth'] = 'Field Input Width';
$l['threadfields_fieldwidth_desc'] = 'Width of the textbox/selectbox/whatever.';
$l['threadfields_fieldheight'] = 'Field Input Height';
$l['threadfields_fieldheight_desc'] = 'Height of the selectbox/textarea etc.';
$l['threadfields_filemagic'] = 'Valid File Magic';
$l['threadfields_filemagic_desc'] = 'A list of valid <a href="http://en.wikipedia.org/wiki/Magic_number_(programming)#Magic_numbers_in_files" target="_blank">file magic numbers</a> for this upload.  Use the pipe (|) character to separate values.  You can use URL encoding notation to represent binary characters (eg %00).';
$l['threadfields_fileexts'] = 'Valid File Extensions';
$l['threadfields_fileexts_desc'] = 'A pipe (|) separated list of valid file extensions accepted for this upload field.';
$l['threadfields_filemaxsize'] = 'Maximum File Size';
$l['threadfields_filemaxsize_desc'] = 'The maximum allowable file size, in <strong>bytes</strong>, for files accepted in this thread field.  0 = no maximum.';
$l['threadfields_filemaxsize_desc_2gbwarn'] = '  Note, you are running a 32-bit version of PHP, which may have issues with handling files larger than 2GB in size.  A 64-bit build of PHP does not have this issue.';
$l['threadfields_filemaxsize_desc_phplimit'] = 'File uploads will be constrained by the following PHP limitations (these <a href="http://www.cyberciti.biz/faq/linux-unix-apache-increase-php-upload-limit/">upload limits can be changed</a> in <a href="http://www.php.net/manual/en/ini.core.php#ini.upload-max-filesize">php.ini</a>):';
$l['threadfields_filereqimg'] = 'Only Accept Image Files';
$l['threadfields_filereqimg_desc'] = 'If yes, will require the uploaded (or URL fetched) file for this field to be an image.  If it isn\'t deemed to be a valid image (according to GD) the file will be rejected - only GIF, JPEG and PNG image types are currently supported.  Note that you must enable this option to use features like thumbnail generation.';
$l['threadfields_filereqimg_desc_nogd'] = '<br /><span style="color: red;">You do not appear to have the PHP GD extension installed and activated, which this feature requires.  Enabling this option may cause problems.</span>';
$l['threadfields_fileimage_mindim'] = 'Minimum Image Dimensions';
$l['threadfields_fileimage_mindim_desc'] = 'Smallest acceptable image dimensions, in <em>w</em>x<em>h</em> format, eg <em>60x30</em>.';
$l['threadfields_fileimage_maxdim'] = 'Maximum Image Dimensions';
$l['threadfields_fileimage_maxdim_desc'] = 'Largest acceptable image dimensions, in <em>w</em>x<em>h</em> format, eg <em>1920x1080</em>.';
$l['threadfields_fileimgthumbs'] = 'Image Thumbnail Generation';
$l['threadfields_fileimgthumbs_desc'] = 'This field only applies if this field only accepts images.  This is a pipe (|) separated list of thumbnail dimensions which will be generated.  For example, if <em>160x120|320x240</em> is entered here, a 160x120 and a 320x240 thumbnail will be generated from the uploaded image.  These thumbnails can be accessed using something like <code>{$GLOBALS[\'threadfields\'][\'<em>key</em>\'][\'thumbs\'][\'160x120\'][\'url\']}</code>.
<br />Instead of specifying dimensions, you may also specify a filter chain.  These are in the format <code>name=chain</code> where <em>name</em> is alphanumeric (and accepts the underscore character) and <em>chain</em> represents a list of filters.  Example: <code>mythumb=scale_min(160, 120)-&gt;crop(160,120)|320x240</code> will generate two thumbnails - the first being an image which is exactly 160x120 in dimension (and is accessible through <code>{$GLOBALS[\'threadfields\'][\'<em>key</em>\'][\'thumbs\'][\'mythumb\'][\'<em>item</em>\']}</code>), whilst the second would be scaled so that it is less than or equal to 320x240 in size.  See Documentation/undoc.html (in the XThreads package) for the full list of available filters.
<br />Note, if this field is changed whilst there are already images uploaded for this field, you may need to <a href="'.xthreads_admin_url('tools', 'recount_rebuild').'#rebuild_xtathumbs" target="_blank">rebuild thumbnails</a>.';
$l['threadfields_vallist'] = 'Values List';
$l['threadfields_vallist_desc'] = 'A list of valid values which can be entered for this field.  Separate values with newlines.  HTML can be used with checkbox/radio button input.  It is recommended that you do not exceed 255 characters for each value.';
$l['threadfields_formatmap'] = 'Formatting Map List';
$l['threadfields_formatmap_desc'] = 'A list of formatting definitions.  The format map will \'translate\' defined inputs to the defined outputs.  <noscript>Separate items with newlines, and input/output pairs with the 3 characters, <em>{|}</em>.  For example, if you specify, for this field, <em>Resolved{|}&lt;span style=&quot;color: green;&quot;&gt;Resolved&lt;/span&gt;</em>, then if the user enters/selects &quot;Resolved&quot; for this field, it will be outputted in green wherever {$GLOBALS[\'threadfields\'][...]} is used.  </noscript>Some variables will work like <code>{$fid}</code>.';
$l['threadfields_use_formhtml'] = 'Use Custom Input HTML';
$l['threadfields_use_formhtml_desc'] = 'If yes, you can use custom HTML to display the field\'s input.';
$l['threadfields_formhtml'] = 'Input Field HTML';
$l['threadfields_formhtml_desc'] = 'Enter custom HTML code for this input field.  Variables and conditionals accepted.
<div id="formhtml_desc_js" style="display: none;">The following additional variables are available: <ul id="formhtml_desc_ul_js"></ul></div>';
$l['threadfields_order'] = 'Order';
$l['threadfields_del'] = 'Del';
$l['threadfields_delete_field'] = 'Delete thread field';
$l['threadfields_delete_field_confirm'] = 'Are you sure you wish to delete the selected custom thread fields?';
$l['no_threadfields'] = 'There are no custom thread fields set at this time.';
$l['threadfields_inputtype_text'] = 'Textbox';
$l['threadfields_inputtype_textarea'] = 'Multiline Textbox';
$l['threadfields_inputtype_select'] = 'Listbox';
$l['threadfields_inputtype_radio'] = 'Option Buttons';
$l['threadfields_inputtype_checkbox'] = 'Checkboxes';
$l['threadfields_inputtype_file'] = 'File';
$l['threadfields_inputtype_file_url'] = 'File/URL';
$l['threadfields_editable_everyone'] = 'Everyone';
$l['threadfields_editable_requied'] = 'Everyone (required)';
$l['threadfields_editable_mod'] = 'Moderators';
$l['threadfields_editable_admin'] = 'Administrators';
$l['threadfields_editable_none'] = 'Not editable';
$l['threadfields_editable_bygroup'] = 'Custom (specify usergroups)';
$l['threadfields_sanitize_plain'] = 'Plain text';
$l['threadfields_sanitize_plain_nl'] = 'Plain text with newlines';
$l['threadfields_sanitize_mycode'] = 'Use MyBB Parser (MyCode)';
$l['threadfields_sanitize_none'] = 'No parsing (dangerous!!)';
$l['threadfields_sanitize_parser_nl2br'] = 'Allow newlines';
$l['threadfields_sanitize_parser_nobadw'] = 'Filter Badwords';
$l['threadfields_sanitize_parser_html'] = 'Allow HTML';
$l['threadfields_sanitize_parser_mycode'] = 'Allow MyCode';
$l['threadfields_sanitize_parser_mycodeimg'] = 'Allow [img] MyCode';
$l['threadfields_sanitize_parser_mycodevid'] = 'Allow [video] MyCode';
$l['threadfields_sanitize_parser_smilies'] = 'Parse Smilies';
$l['threadfields_textmask_anything'] = 'Anything';
$l['threadfields_textmask_anything_desc'] = 'Allow any text - equivalent to no filtering';
$l['threadfields_textmask_digit'] = 'Digits';
$l['threadfields_textmask_digit_desc'] = 'Only accept digit (0-9) characters';
$l['threadfields_textmask_alphadigit'] = 'Alphanumeric';
$l['threadfields_textmask_alphadigit_desc'] = 'Only accept alphanumeric (0-9 and A-Z) characters';
$l['threadfields_textmask_number'] = 'Number (real)';
$l['threadfields_textmask_number_desc'] = 'Only accept a number string, including decimals, optional negative sign, and exponent (eg 1e10).  Examples of valid numbers: 4, 2.01, -5.020e5.  Negative sign can be captured through <code>{VALUE$1}</code>, numbers to the left of the decimal point through <code>{VALUE$2}</code>, numbers right of the decimal: <code>{VALUE$3}</code> and the exponent through <code>{VALUE$4}</code>';
$l['threadfields_textmask_date'] = 'Date (dd/mm/yyyy)';
$l['threadfields_textmask_date_desc'] = 'Date in non-US form (<span style="color: red;">01</span>/<span style="color: #008000;">01</span>/<span style="color: blue;">1900</span> - <span style="color: red;">31</span>/<span style="color: #008000;">12</span>/<span style="color: blue;">2099</span>).  This doesn\'t ensure an entirely valid date, however it does perform some checks.  Day can be displayed through <code style="color: red;">{VALUE$1}</code>, month through <code style="color: #008000;">{VALUE$2}</code> and year through <code style="color: blue;">{VALUE$3}</code>.';
$l['threadfields_textmask_date_us'] = 'Date (mm/dd/yyyy)';
$l['threadfields_textmask_date_us_desc'] = 'Date in US form (<span style="color: red;">01</span>/<span style="color: #008000;">01</span>/<span style="color: blue;">1900</span> - <span style="color: red;">12</span>/<span style="color: #008000;">31</span>/<span style="color: blue;">2099</span>).  This doesn\'t ensure an entirely valid date, however it does perform some checks.  Month can be displayed through <code style="color: red;">{VALUE$1}</code>, day through <code style="color: #008000;">{VALUE$2}</code> and year through <code style="color: blue;">{VALUE$3}</code>.';
$l['threadfields_textmask_uri'] = 'URI (generic)';
$l['threadfields_textmask_uri_desc'] = 'Any URI.  URI scheme can be displayed through <code style="color: red;">{VALUE$1}</code>, and anything after the colon through <code style="color: #008000;">{VALUE$2}</code>.  Example: <code><span style="color: red;">magnet</span>:<span style="color: #008000;">?xt=urn:btih:00000000000000000000000000000000</span></code><br /><strong>Warning!!!</strong>: avoid placing this in values of a HTML tag property (e.g. <em>&lt;a href=&quot;{VALUE}&quot;&gt;</em>) as this may be used to perform an XSS attack';
$l['threadfields_textmask_url'] = 'URL';
$l['threadfields_textmask_url_desc'] = 'Typical URI.  URI scheme can be displayed through <code style="color: red;">{VALUE$1}</code>, URI host through <code style="color: #008000;">{VALUE$2}</code> and URI path, with preceeding forward slash, through <code style="color: blue;">{VALUE$3}</code>.  Example: <code><span style="color: red;">gopher</span>://<span style="color: #008000;">example.com</span><span style="color: blue;">/path</span></code>';
$l['threadfields_textmask_httpurl'] = 'URL (HTTP/S)';
$l['threadfields_textmask_httpurl_desc'] = 'Any http:// or https:// style URL.  URI scheme can be displayed through <code style="color: red;">{VALUE$1}</code>, URI host through <code style="color: #008000;">{VALUE$2}</code> and URI path, with preceeding forward slash, through <code style="color: blue;">{VALUE$3}</code>.  Example: <code><span style="color: red;">http</span>://<span style="color: #008000;">example.com</span><span style="color: blue;">/path</span></code>';
$l['threadfields_textmask_email'] = 'Email address';
$l['threadfields_textmask_email_desc'] = 'Any valid email address (does allow some invalid structures).  Username can be displayed via <code style="color: red;">{VALUE$1}</code>, host through <code style="color: #008000;">{VALUE$2}</code>.  Example: <code><span style="color: red;">someone</span>@<span style="color: #008000;">example.com</span></code>';
$l['threadfields_textmask_emailr'] = 'Email address (restricted)';
$l['threadfields_textmask_emailr_desc'] = 'An email address not containing certain rarely used &quot;restricted&quot; (but still valid) characters.  Excluding these characters may make this field a little easier to handle.  Username can be displayed via <code style="color: red;">{VALUE$1}</code>, host through <code style="color: #008000;">{VALUE$2}</code>.  Example: <code><span style="color: red;">someone</span>@<span style="color: #008000;">example.com</span></code>';
$l['threadfields_textmask_css'] = 'CSS Value';
$l['threadfields_textmask_css_desc'] = 'Value appropriate for placing as a CSS value, for example <code>style=&quot;font-family: {VALUE};&quot;</code>.  Note brackets and quotes are not allowed, so values such as <code>url(...)</code> are not allowed.';
$l['threadfields_textmask_color'] = 'Color Value';
$l['threadfields_textmask_color_desc'] = 'Color name (eg <code>red</code>) or hexadecimal representation (eg <code>#FF0000</code>)';
$l['threadfields_textmask_custom'] = 'Custom (regex)';
$l['threadfields_filter_none'] = 'Disabled';
$l['threadfields_filter_exact'] = 'Exact match';
$l['threadfields_filter_prefix'] = 'Beginning with';
$l['threadfields_filter_anywhere'] = 'Contains';
$l['threadfields_filter_wildcard'] = 'Wildcard (* and ?) match';
$l['threadfields_formhtml_desc_key'] = 'The <em>Key</em> for this field';
$l['threadfields_formhtml_desc_name_prop'] = 'The <em>name</em> property for this field.  Shortcut for <code>&nbsp;name=&quot;xthreads_{KEY}&quot;</code>';
$l['threadfields_formhtml_desc_value'] = 'Current value of this field, or, if a select, option or checkbox input, value for current item';
$l['threadfields_formhtml_desc_tabindex'] = 'Tab index offset for this field (only available if capturing tab key).  You should generally not use this.';
$l['threadfields_formhtml_desc_tabindex_prop'] = 'If capturing tab key, will be set to the appropriate <em>tabindex</em> property';
$l['threadfields_formhtml_desc_width'] = 'Defined field width';
$l['threadfields_formhtml_desc_width_prop_size'] = 'Shortcut for <code>&lt;if {WIDTH} then&gt; size=&quot;{WIDTH}&quot;&lt;/if&gt;</code>';
$l['threadfields_formhtml_desc_width_css'] = 'Shortcut for <code>&lt;if {WIDTH} then&gt;width: &lt;?={WIDTH}/2?&gt;em;&lt;/if&gt;</code>';
$l['threadfields_formhtml_desc_width_prop_cols'] = 'Shortcut for <code>&lt;if {WIDTH} then&gt; cols=&quot;{WIDTH}&quot;&lt;/if&gt;</code>';
$l['threadfields_formhtml_desc_height'] = 'Defined field height';
$l['threadfields_formhtml_desc_height_prop_size'] = 'Shortcut for <code>&lt;if {HEIGHT} then&gt; size=&quot;{HEIGHT}&quot;&lt;/if&gt;</code>';
$l['threadfields_formhtml_desc_height_css'] = 'Shortcut for <code>&lt;if {HEIGHT} then&gt;height: &lt;?={HEIGHT}/2?&gt;em;&lt;/if&gt;</code>';
$l['threadfields_formhtml_desc_height_prop_rows'] = 'Shortcut for <code>&lt;if {HEIGHT} then&gt; rows=&quot;{HEIGHT}&quot;&lt;/if&gt;</code>';
$l['threadfields_formhtml_desc_maxlen'] = 'Defined field maximum length';
$l['threadfields_formhtml_desc_maxlen_prop'] = 'Shortcut for <code>&lt;if {MAXLEN} then&gt; maxlength=&quot;{MAXLEN}&quot;&lt;/if&gt;</code>';
$l['threadfields_formhtml_desc_multiple'] = 'True if accepting multiple values';
$l['threadfields_formhtml_desc_multiple_prop'] = 'If accepting multiple values, set to <code>&nbsp;multiple=&quot;multiple&quot;</code>';
$l['threadfields_formhtml_desc_multiple_limit'] = 'Maximum number of accepted values. 0 or blank for no limit.';
$l['threadfields_formhtml_desc_style'] = 'Custom CSS for the item, including <em>style</em> attribute';
$l['threadfields_formhtml_desc_stylecss'] = 'Custom CSS for the item, without <em>style</em> attribute';
$l['threadfields_formhtml_desc_label'] = 'Item label text';
$l['threadfields_formhtml_desc_selected'] = 'If selected, set to <code>&nbsp;selected=&quot;selected&quot;</code>';
$l['threadfields_formhtml_desc_checked'] = 'If selected, set to <code>&nbsp;checked=&quot;checked&quot;</code>';
$l['threadfields_formhtml_desc_attach'] = 'If there\'s an attachment, is an array with its details';
$l['threadfields_formhtml_desc_attach_md5_title'] = 'If there\'s an attachment, shortcut to put the MD5 into a <em>title</em> attribute';
$l['threadfields_formhtml_desc_required'] = 'True if field is a required field';
$l['threadfields_formhtml_desc_required_prop'] = 'If field is required, set to <code>&nbsp;required=&quot;required&quot;</code>';
$l['threadfields_formhtml_desc_restrict_type'] = 'Set to <code>image</code> if only accepting images, blank string otherwise.';
$l['threadfields_formhtml_desc_accept_prop'] = 'If accepting images only, set to <code>&nbsp;accept=&quot;image/*&quot;</code>';
$l['threadfields_formhtml_desc_remove_checked'] = 'If the <em>Remove</em> checkbox is ticked, set to <code>&nbsp;checked=&quot;checked&quot;</code>';
$l['threadfields_formhtml_desc_checked_upload'] = 'If <em>Upload</em> option button is selected, set to <code>&nbsp;checked=&quot;checked&quot;</code>';
$l['threadfields_formhtml_desc_selected_upload'] = 'If <em>Upload</em> option button is selected, set to <code>&nbsp;selected=&quot;selected&quot;</code>';
$l['threadfields_formhtml_desc_checked_url'] = 'If <em>URL</em> option button is selected, set to <code>&nbsp;checked=&quot;checked&quot;</code>';
$l['threadfields_formhtml_desc_selected_url'] = 'If <em>URL</em> option button is selected, set to <code>&nbsp;selected=&quot;selected&quot;</code>';
$l['threadfields_formhtml_desc_maxsize'] = 'Specified maximum filesize';
$l['threadfields_formhtml_desc_value_url'] = 'URL sent by the user';
$l['threadfields_formhtml_js_reset_warning'] = 'You have changed the field type.  Do you want to reset the custom input HTML you have entered?';
$l['threadfields_for_forums'] = 'For forum(s): {1}';
$l['threadfields_for_all_forums'] = 'For all forum(s)';
$l['threadfields_deleted_forum_id'] = 'Deleted Forum #{1}';
$l['error_invalid_field'] = 'Nonexistent thread field';
$l['add_threadfield'] = 'Add Thread Field';
$l['edit_threadfield'] = 'Edit Thread Field';
$l['update_threadfield'] = 'Update Thread Field';
$l['threadfields_cat_input'] = 'Input Options';
$l['threadfields_cat_inputfield'] = 'Input Field Options';
$l['threadfields_cat_output'] = 'Output Options';
$l['threadfields_cat_misc'] = 'Misc Options';
$l['success_updated_threadfield'] = 'Custom thread field updated successfully';
$l['success_added_threadfield'] = 'Custom thread field added successfully';
$l['success_threadfield_inline'] = 'Changes committed successfully';
$l['failed_threadfield_inline'] = 'No changes were performed';

$l['error_missing_title'] = 'Missing field title.';
$l['error_missing_field'] = 'Missing field key.';
$l['error_bad_old_field'] = 'Non-existent previous field key specified.';
$l['error_invalid_inputtype'] = 'Invalid input type specified.';
$l['error_dup_formatmap'] = 'Duplicate formatting definition for value <em>{1}</em> found.';
$l['error_dup_editable_value'] = 'Duplicate value permission definition for value <em>{1}</em> found.';
$l['error_bad_textmask'] = 'Bad regular expression used for Text Mask. PHP returned <em>{1}</em>';
$l['error_bad_conditional'] = 'Bad conditional syntax detected for {1}.';
$l['error_require_valllist'] = 'Select/checkbox/radiobutton input types must have a defined (non-empty) Value List.';
$l['error_require_multival_delimiter'] = 'No multiple value delimiter defined (tip, you can set this to be a space).';
$l['error_require_formhtml'] = 'No Input Form HTML entered (tip, you can set this to be a space).';
$l['error_invalid_min_dims'] = 'Invalid minimum dimensions specified.';
$l['error_invalid_max_dims'] = 'Invalid maximum dimensions specified.';
$l['error_invalid_thumb_dims'] = 'Invalid thumbnail dimensions specified.';
$l['error_field_name_in_use'] = 'The field key you have chosen is already in use for another field.  Please choose an unused unique key.';
$l['error_field_name_tid'] = 'Key name cannot be &quot;tid&quot; - please choose a different name.';
$l['error_field_name_invalid'] = 'Key names must contain only underscores or alphanumeric characters.';
$l['error_field_name_reserved'] = 'Sorry, key names cannot start with two underscore characters (__) because this is a reserved construct.';
$l['error_field_name_too_long'] = 'Key names must be 50 characters long or less.';

$l['threadfields_enable_js'] = 'It appears that you have JavaScript disabled.  To make things easier for you, it is strongly recommended to enable JavaScript for this page.';
$l['commit_changes'] = 'Commit Changes';

$l['xthreads_desc_more'] = 'Show full description...';
$l['xthreads_opts'] = 'XThreads Options <span style="font-size: smaller;">(note that these settings do not cascade down into child forums)</span>';
$l['xthreads_tplprefix'] = 'Template Prefix';
$l['xthreads_tplprefix_desc'] = 'A template prefix allows you to use different templates for this forum.  For example, if you choose a prefix of <em>myforum_</em>, you could make a template named <em>myforum_header</em> and it will replace the <em>header</em> template for this forum.
<br /><!-- more -->
This field supports variables and conditionals - do note that these are evaluated quite early in the script (for caching reasons) before many variables get set.  Multiple prefixes can be defined, separated by commas - XThreads will attempt to find a template using one of the prefixes in the order defined, <em>after</em> variables and conditionals are evaluated.
<br />This effect also applies to the <em>search_results_posts_post</em> and <em>search_results_threads_thread</em> templates, as well as the various <em>forumbit_</em>* and <em>portal_announcement</em>* templates.  Note that, for these special cases (excluding <em>forumbit_*</em> templates), multiple template prefixes will not be searched - only the first prefix will be used.';
$l['xthreads_langprefix'] = 'Language File Prefix';
$l['xthreads_langprefix_desc'] = 'This option will load additional language files based on the prefixes supplied (comma delimited if you wish to supply more than one prefix).
<br /><!-- more -->This field supports variables and conditionals, similar to how the template prefix field above works.  For example, if you specify <em>lp1_,lp2_</em> here, when MyBB tries to load, say, <em>forumdisplay.lang.php</em>, XThreads will then load (if possible) <em>lp1_forumdisplay.lang.php</em> followed by <em>lp2_forumdisplay.lang.php</em>, adding to and overwriting any language definitions defined in previously loaded files.';
$l['xthreads_grouping'] = 'Thread Grouping';
$l['xthreads_grouping_desc'] = 'How many threads to group together.  A value of 0 disables grouping.  If grouping is enabled, the <em>forumdisplay_group_sep</em> template is inserted every <em>X</em> threads on the forumdisplay.
<br /><!-- more -->This is mainly useful if you wish to display multiple threads in a single table row.  If the number of threads does not fully fill a group, the template <em>forumdisplay_thread_null</em> is appended as many times needed to completely fill the thread group.  Internal counter is reset between sticky/normal thread separators.';
$l['xthreads_firstpostattop'] = 'Show first post on every showthread page';
$l['xthreads_firstpostattop_desc'] = 'Shows the first post at the top of every page in showthread, as opposed to just the first page.
<br /><!-- more -->Tip: you can use the <em>postbit_first*</em> templates as opposed to the <em>postbit*</em> templates to get a different look for the first post.  On the <em>showthread</em> template, the first post is separated into the <code>{$first_post}</code> variable.  Also, the template <em>showthread_noreplies</em> is used in the <code>{$posts}</code> variable if there are no replies to the thread.';
$l['xthreads_inlinesearch'] = 'Enable XThreads\' Inline Forum Search';
$l['xthreads_inlinesearch_desc'] = 'Replaces the search box on the forumdisplay page with XThreads\' inline search system, ignoring the search permission set for this forum.  This allows the search to display threads the same way as forumdisplay does.  The downside is that this may cause additional server load.';
$l['xthreads_fdcolspan_offset'] = 'Offset forumdisplay {$colspan}';
$l['xthreads_fdcolspan_offset_desc'] = 'If non-zero, will increase the value of the <code>{$colspan}</code> variable in the <em>forumdisplay_threadlist</em> template by specified amount (negative values accepted).  May be useful for adding additional columns on the forumdisplay page.';
$l['xthreads_settingoverrides'] = 'Settings Overrides';
$l['xthreads_settingoverrides_desc'] = 'Override MyBB settings specifically for this forum.  USE CAUTION! - overriding some settings may cause undesirable effects.
<br /><!-- more -->Separate entries with newlines; variables/conditionals supported (in filter value only).  Format of each line is <code><em>settingkey</em>=<em>value</em></code>.  Note that URI encoding is not supported.
<br />Example value for this field:
<code style="display: block; margin-left: 2em;">bbname=New forum name<br />postmaxavatarsize=&lt;if $mybb-&gt;user[\'uid\'] then&gt;{$mybb-&gt;settings[\'postmaxavatarsize\']}&lt;else&gt;50x50&lt;/if&gt;</code>';
$l['xthreads_postsperpage'] = 'Override Posts Per Page';
$l['xthreads_postsperpage_desc'] = 'If non-zero, overrides the default and user chosen posts per page setting for showthread.';
$l['xthreads_hideforum'] = 'Hide Forum';
$l['xthreads_hideforum_desc'] = 'If yes, will hide this forum on your index and forumdisplay pages.
<br /><!-- more -->This is slightly different to disabling the Can View Forum permission in that this does not affect permissions, it just merely hides it from display (so, for example, you could put a link to it in your main menu).';
$l['xthreads_hidebreadcrumb'] = 'Hide Forum in Breadcrumb Trail';
$l['xthreads_hidebreadcrumb_desc'] = 'If yes, will hide <u>this</u> forum in the forum breadcrumb <strong>trail</strong> (it will still appear in the breadcrumb if it\'s the active forum).';
$l['xthreads_allow_blankmsg'] = 'Allow Blank Post Message';
$l['xthreads_allow_blankmsg_desc'] = 'If yes, new threads in this forum will not require a message to be entered.';
$l['xthreads_nostatcount'] = 'Don\'t include this forum\'s threads/posts in global forum statistics';
$l['xthreads_nostatcount_desc'] = 'If yes, threads and posts made in this forum will not increase the forum\'s statistics on the number of threads and posts across all forums (eg at the bottom of the forum home, or stats.php).';
$l['xthreads_defaultfilter'] = 'Default Thread Filter';
$l['xthreads_defaultfilter_desc'] = 'This filter is applied to forumdisplay if no filter has been specified in the URL.
<br /><!-- more -->Separate entries with newlines; variables/conditionals supported (in filter value only).  Note that URI encoding is not supported.
<br />The default filter can also be disabled with no additional filter in use, by specifying <em>filterdisable</em> in the URL, eg <em>forumdisplay.php?fid=2&amp;filterdisable=1</em>
<br />Example value for this field:
<code style="display: block; margin-left: 2em;">myfield=something<br />__xt_uid=1<br />field2[]=value1<br />field2[]={$mybb-&gt;user[\'username\']}</code>';
/* $l['xthreads_addfiltenable'] = 'Enable Thread Filters';
$l['xthreads_addfiltenable_desc'] = 'Enable users to filter forumdisplay by certain thread attributes (eg thread starter).
<br /><!-- more -->This feature works similar to filtering forumdisplay threads by custom thread fields.  This does not affect templates, so you need to make appropriate changes to make this option useful.  If you tick any of the options below, users can filter threads displayed on forumdisplay by the relevant fields by appending the URL parameter <code>filterxt_<em>fieldname</em></code>, for example <em>forumdisplay.php?fid=2&amp;filterxt_uid=2</em> will only display threads created by the user with UID of 2.  Note, multiple filters are allowed, and you can also specify an array of values for a single field.'; */
$l['xthreads_cust_wolstr'] = 'Custom WOL Text';
$l['xthreads_cust_wolstr_desc'] = 'You can have custom text for this forum on the Who\'s Online List.
<br /><!-- more -->If you enter text in the following textboxes, it will replace the default WOL language text.  As this replaces language strings, it will accept variables in the same way.  Go to <a href="'.xthreads_admin_url('config', 'languages').'">Languages section</a> -&gt; Edit Language Variables (under Options for your selected language) -&gt; edit <em>online.lang.php</em> to see the defaults.';
$l['xthreads_afe_uid'] = 'Thread starter\'s User ID';
$l['xthreads_afe_lastposteruid'] = 'Last poster\'s User ID';
$l['xthreads_afe_prefix'] = 'Thread Prefix ID; <em>check URL (look for <strong>pid</strong>) when editing thread prefix in ACP</em>';
$l['xthreads_afe_icon'] = 'Thread Icon ID; <em>check URL (look for <strong>iid</strong>) when editing thread icon in ACP</em>';
$l['xthreads_wol_announcements'] = 'Announcements';
$l['xthreads_wol_forumdisplay'] = 'Forum Display';
$l['xthreads_wol_newthread'] = 'New Thread';
$l['xthreads_wol_attachment'] = 'Attachment Download';
$l['xthreads_wol_newreply'] = 'New Reply';
$l['xthreads_wol_showthread'] = 'Show Thread';

$l['xthreads_sort_threadfield_prefix'] = 'Thread Field: ';
$l['xthreads_sort_filename'] = 'file name';
$l['xthreads_sort_filesize'] = 'file size';
$l['xthreads_sort_uploadtime'] = 'upload time';
$l['xthreads_sort_updatetime'] = 'update time';
$l['xthreads_sort_downloads'] = 'no. downloads';
$l['xthreads_sort_ext_prefix'] = 'Thread Prefix (prefix ID)';
$l['xthreads_sort_ext_icon'] = 'Thread Icon (icon ID)';
$l['xthreads_sort_ext_lastposter'] = 'Last Poster (username)';
$l['xthreads_sort_ext_numratings'] = 'Number of Ratings';
$l['xthreads_sort_ext_attachmentcount'] = 'Number of Attachments in Thread';

$l['xthreads_filter_uid'] = 'Thread Starter (user ID)';
$l['xthreads_filter_lastposteruid'] = 'Last Poster (user ID)';

$l['xthreads_modtool_edit_threadfields'] = 'Modify Custom Thread Field(s)';
$l['xthreads_modtool_edit_threadfields_desc'] = 'You can use this option to modify XThreads\' custom thread fields when this tool is executed.  <noscript>Specify each thread field you wish to edit on a separate line and assign to the thread field\'s key using = (equals sign).  </noscript>The current value (before setting) of the field can be denoted by <code>{VALUE}</code>.  Variables/conditionals supported.  NOTE: values here are NOT validated, and permissions are NOT checked!  Example:
<code style="display: block; margin-left: 2em;">myfield=something<br />anotherfield={VALUE},something else</code>';

$l['xthreads_js_confirm_form_submit'] = 'You have an editor window open - are you sure you wish to submit these changes without closing this window?';
$l['xthreads_js_edit_value'] = 'Edit Value';
$l['xthreads_js_save_changes'] = 'Save Changes';
$l['xthreads_js_close_save_changes'] = 'Do you wish to save changes before closing this window?';

$l['xthreads_js_formatmap_from'] = 'Value'; // also used for editable values
$l['xthreads_js_formatmap_to'] = 'Displayed Output';
$l['xthreads_js_editable_values_groups'] = 'Editable by Groups';
$l['xthreads_js_defaultfilter_field'] = 'Field';
$l['xthreads_js_defaultfilter_value'] = 'Value';
$l['xthreads_js_settingoverrides_setting'] = 'Setting';
$l['xthreads_js_settingoverrides_value'] = 'Value';

$l['xthreads_confirm_uninstall'] = 'Are you sure you wish to uninstall XThreads?  Uninstalling will cause all XThreads related modifications (excluding template modifications you have performed on those not added by XThreads) will be removed.<br />Well, obviously you\'re sure, cause you clicked on the link... this is just for those (like me) who accidentally click on the wrong things...';


$l['xthreads_orphancleanup_name'] = 'Prune XThreads Orphaned Attachments';
$l['xthreads_orphancleanup_desc'] = 'Removes orphaned XThreads attachments more than one day old.  Orphaned attachments usually arise when users upload an attachment but decide not to post the thread.  Note that this does not affect MyBB\'s attachment system in any way.';

$l['xthreads_uploads_dir'] = 'XThreads\' Uploads Directory';

$l['admin_log_config_threadfields_add'] = 'Added thread field <em>{1}</em> ({2})';
$l['admin_log_config_threadfields_edit'] = 'Modified thread field <em>{1}</em> ({2})';
$l['admin_log_config_threadfields_inline'] = 'Deleted or changed orderings of selected thread field(s)'; // legacy note
$l['admin_log_config_threadfields_inline_del'] = 'Deleted thread field(s): {1}';
$l['admin_log_config_threadfields_inline_order'] = 'Updated display order of thread field(s): {1}';
$l['admin_log_config_threadfields_inline_delim'] = '; ';

$l['xthreads_do_upgrade'] = 'You have uploaded a newer version of XThreads, v{1}, however the version currently installed is v{2}.  You may need to perform an upgrade for your board to be functional - to perform an upgrade, please <a href="{3}">click here</a>.';
$l['xthreads_upgrade_done'] = 'XThreads successfully upgraded.';
$l['xthreads_upgrade_failed'] = 'XThreads upgraded failed.';
$l['xthreads_cachefile_not_writable'] = ' Please make sure that cache/xthreads.php is writable';
$l['xthreads_cachefile_rewritten'] = 'XThreads settings file successfully rewritten - version set to v{1}';
$l['xthreads_cachefile_missing'] = 'The XThreads settings file (cache/xthreads.php) is missing or corrupted!  If you have modified this file, please revert the changes and try again, or if you have a backup copy of this file, please upload it.  Otherwise, it is possible to try to regenerate the file if the version installed is v{1} - if this is the case, please <a href="{2}">click here</a> to try to regenerate the file.';
