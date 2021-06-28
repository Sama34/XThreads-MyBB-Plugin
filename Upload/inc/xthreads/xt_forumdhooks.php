<?php
if(!defined('IN_MYBB'))
	die('This file cannot be accessed directly.');

function xthreads_forumdisplay() {
	global $db, $threadfield_cache, $fid, $mybb, $tf_filters, $xt_filters, $filters_set, $xthreads_forum_filter_form, $xthreads_forum_filter_args;
	// the position of the "forumdisplay_start" hook is kinda REALLY annoying...
	$fid = (int)$mybb->input['fid'];
	if($fid < 1 || !($forum = get_forum($fid))) return;
	
	// replicate some MyBB behaviour
	if(!isset($mybb->input['sortby']) && !empty($forum['defaultsortby']))
		$mybb->input['sortby'] = $forum['defaultsortby'];
	
	$threadfield_cache = xthreads_gettfcache($fid);
	
	// Quick Thread integration
	if(!empty($threadfield_cache) && function_exists('quickthread_run'))
		xthreads_forumdisplay_quickthread();
	
	$fpermissions = forum_permissions($fid);
	$show_threads = ($fpermissions['canview'] == 1 && $fpermissions['canviewthreads'] != 0);
	
	$tf_filters = array();
	$filters_set = array(
		'__search' => array('hiddencss' => '', 'visiblecss' => 'display: none;', 'selected' => array('' => ' selected="selected"'), 'checked' => array('' => ' checked="checked"'), 'active' => array('' => 'filtertf_active'), 'nullselected' => ' selected="selected"', 'nullchecked' => ' checked="checked"', 'nullactive' => 'filtertf_active'),
		'__all' => array('hiddencss' => '', 'visiblecss' => 'display: none;', 'nullselected' => ' selected="selected"', 'nullchecked' => ' checked="checked"', 'nullactive' => 'filtertf_active'),
	);
	$xthreads_forum_filter_form = $xthreads_forum_filter_args = '';
	$use_default_filter = true;
	if(!empty($threadfield_cache)) {
		if($show_threads) {
			function xthreads_forumdisplay_dbhook(&$s, &$db) {
				global $threadfield_cache, $fid, $plugins, $threadfields, $xthreads_forum_sort;
				//if(empty($threadfield_cache)) return;
				
				$fields = '';
				foreach($threadfield_cache as &$v)
					$fields .= ', tfd.`'.$v['field'].'` AS `xthreads_'.$v['field'].'`';
				
				$sortjoin = '';
				if(!empty($xthreads_forum_sort) && isset($xthreads_forum_sort['sortjoin']))
					$sortjoin = ' LEFT JOIN '.$db->table_prefix.$xthreads_forum_sort['sortjoin'];
				
				$s = strtr($s, array(
					'SELECT t.*, ' => 'SELECT t.*'.$fields.', ',
					'WHERE t.fid=' => 'LEFT JOIN `'.$db->table_prefix.'threadfields_data` tfd ON t.tid=tfd.tid'.$sortjoin.' WHERE t.fid=',
				));
				$plugins->add_hook('forumdisplay_thread', 'xthreads_forumdisplay_thread');
				$threadfields = array();
			}
			
			control_db('
				function query($string, $hide_errors=0, $write_query=0) {
					static $done=false;
					if(!$done && !$write_query && strpos($string, \'SELECT t.*, \') && strpos($string, \'t.username AS threadusername, u.username\') && strpos($string, \'FROM '.TABLE_PREFIX.'threads t\')) {
						$done = true;
						xthreads_forumdisplay_dbhook($string, $this);
					}
					return parent::query($string, $hide_errors, $write_query);
				}
			');
		}
		
		// also check for forumdisplay filters/sort
		// and generate form HTML
		foreach($threadfield_cache as $n => &$tf) {
			$filters_set[$n] = array('hiddencss' => '', 'visiblecss' => 'display: none;', 'nullselected' => ' selected="selected"', 'nullchecked' => ' checked="checked"', 'nullactive' => 'filtertf_active');
			if($tf['ignoreblankfilter']) {
				// will be overwritten if not blank
				$filters_set[$n]['selected'] = array('' => ' selected="selected"');
				$filters_set[$n]['checked'] = array('' => ' checked="checked"');
				$filters_set[$n]['active'] = array('' => 'filtertf_active');
			}
			
			if($tf['allowfilter'] && isset($mybb->input['filtertf_'.$n]) && xthreads_user_in_groups($tf['viewable_gids'])) {
				$tf_filters[$n] = $mybb->input['filtertf_'.$n];
				$use_default_filter = false;
				// ignore blank inputs
				if($tf['ignoreblankfilter'] && (
					(is_array($tf_filters[$n]) && (empty($tf_filters[$n]) || array_unique($tf_filters[$n]) == array(''))) ||
					($tf_filters[$n] === '')
				)) {
					unset($tf_filters[$n]);
				}
			}
		}
		
		// sorting by thread fields
		if($mybb->input['sortby'] && substr($mybb->input['sortby'], 0, 2) == 'tf') {
			global $xthreads_forum_sort;
			if(substr($mybb->input['sortby'], 0, 3) == 'tf_') {
				$n = substr($mybb->input['sortby'], 3);
				if(isset($threadfield_cache[$n]) && xthreads_empty($threadfield_cache[$n]['multival']) && $threadfield_cache[$n]['inputtype'] != XTHREADS_INPUT_FILE && xthreads_user_in_groups($threadfield_cache[$n]['viewable_gids'])) {
					if($threadfield_cache[$n]['inputtype'] != XTHREADS_INPUT_TEXTAREA) { // also disallow sorting by textarea inputs
						$xthreads_forum_sort = array(
							't' => 'tfd.',
							'sortby' => $mybb->input['sortby'],
							'sortfield' => '`'.$n.'`'
						);
					}
				}
			}
			// xtattachment sorting
			elseif(substr($mybb->input['sortby'], 0, 4) == 'tfa_') {
				$p = strpos($mybb->input['sortby'], '_', 5);
				if($p) {
					$field = strtolower(substr($mybb->input['sortby'], 4, $p-4));
					$n = substr($mybb->input['sortby'], $p+1);
					if(isset($threadfield_cache[$n]) && xthreads_empty($threadfield_cache[$n]['multival']) && $threadfield_cache[$n]['inputtype'] == XTHREADS_INPUT_FILE && xthreads_user_in_groups($threadfield_cache[$n]['viewable_gids']) && in_array($field, array('filename', 'filesize', 'uploadtime', 'updatetime', 'downloads'))) {
						$xthreads_forum_sort = array(
							't' => 'xta.',
							'sortby' => $mybb->input['sortby'],
							'sortfield' => '`'.$field.'`',
							'sortjoin' => 'xtattachments xta ON tfd.`'.$n.'`=xta.aid'
						);
					}
				}
			}
		}
	}
	if(!isset($xthreads_forum_sort) && $mybb->input['sortby'] && in_array($mybb->input['sortby'], array('prefix', 'icon', 'lastposter', 'numratings', 'attachmentcount'))) {
		global $xthreads_forum_sort;
		switch($mybb->input['sortby']) {
			case 'prefix': if($mybb->version_code >= 1500) {
				$xthreads_forum_sort = array(
					't' => ($mybb->version_code >= 1604 ? 't.':'p.'),
					'sortby' => $mybb->input['sortby'],
					'sortfield' => $mybb->input['sortby']
				);
			} break;
			case 'icon':
				$xthreads_forum_sort = array(
					't' => 't.',
					'sortby' => $mybb->input['sortby'],
					'sortfield' => $mybb->input['sortby'],
					// we can't use the sort join because that assumes that thread fields exist... :/
					//'sortfield' => 'name',
					//'sortjoin' => 'icons i ON t.icon=i.iid'
				);
				break;
			case 'lastposter':
			case 'numratings':
			case 'attachmentcount':
				$xthreads_forum_sort = array(
					't' => 't.',
					'sortby' => $mybb->input['sortby'],
					'sortfield' => $mybb->input['sortby']
				);
		}
	}
	$xt_filters = array();
	//$enabled_xtf = explode(',', $forum['xthreads_addfiltenable']);
	//if(!empty($enabled_xtf)) {
		//global $lang;
		//foreach($enabled_xtf as &$xtf) {
		$enabled_xtf = array('uid','icon','lastposteruid');
		if($mybb->version_code >= 1500) $enabled_xtf[] = 'prefix';
		foreach($enabled_xtf as &$xtf) {
			$filters_set['__xt_'.$xtf] = array('hiddencss' => '', 'visiblecss' => 'display: none;', 'nullselected' => ' selected="selected"', 'nullchecked' => ' checked="checked"', 'nullactive' => 'filtertf_active');
			if(isset($mybb->input['filterxt_'.$xtf]) && $mybb->input['filterxt_'.$xtf] !== '') {
				$xt_filters[$xtf] = $mybb->input['filterxt_'.$xtf];
				$use_default_filter = false;
			}
		}
		unset($enabled_xtf);
	//}
	
	if(function_exists('xthreads_evalcacheForumFilters')) {
		$xtforum = xthreads_evalcacheForumFilters($fid);
		if($use_default_filter && (!empty($xtforum['defaultfilter_tf']) || !empty($xtforum['defaultfilter_xt'])) && !$mybb->input['filterdisable']) {
			$tf_filters = $xtforum['defaultfilter_tf'];
			foreach($tf_filters as $n => &$filter) {
				if(!xthreads_user_in_groups($threadfield_cache[$n]['viewable_gids'])) {
					unset($tf_filters[$n]);
					continue;
				}
			}
			$xt_filters = $xtforum['defaultfilter_xt'];
		}
		//unset($enabled_xtf);
	}
	
	foreach($tf_filters as $n => &$filter) {
		xthreads_forumdisplay_filter_input('filtertf_'.$n, $filter, $filters_set[$n]);
	}
	foreach($xt_filters as $n => &$filter) {
		/*
		// sanitise input here as we may need to grab extra info
		if(is_array($filter))
			$filter = array_map('intval', $filter);
		else
			$filter = (int)$filter;
		*/
		
		xthreads_forumdisplay_filter_input('filterxt_'.$n, $filter, $filters_set['__xt_'.$n]);
		
		/*
		if(is_array($filter))
			$ids = implode(',', $filter);
		else
			$ids = $filter;
		
		// grab extra info for $filter_set array
		switch($n) {
			case 'uid': case 'lastposteruid':
				// perhaps might be nice if we could merge these two together...
				$info = xthreads_forumdisplay_xtfilter_extrainfo('users', array('username'), 'uid', $ids, 'guest');
				$filters_set['__xt_'.$n]['name'] = $info['username'];
				break;
			case 'prefix':
				// displaystyles?
				if(!$lang->xthreads_no_prefix) $lang->load('xthreads');
				$info = xthreads_forumdisplay_xtfilter_extrainfo('threadprefixes', array('prefix', 'displaystyle'), 'pid', $ids, 'xthreads_no_prefix');
				$filters_set['__xt_'.$n]['name'] = $info['prefix'];
				$filters_set['__xt_'.$n]['displayname'] = $info['displaystyle'];
				break;
			case 'icon':
				// we'll retrieve icons from the cache rather than query the DB
				$icons = $GLOBALS['cache']->read('posticons');
				if(is_array($filter))
					$ids =& $filter;
				else
					$ids = array($ids);
				
				$filters_set['__xt_'.$n]['name'] = '';
				$iconstr =& $filters_set['__xt_'.$n]['name'];
				foreach($ids as $id) {
					if($id && $icons[$id])
						$iconstr .= ($iconstr?', ':'') . htmlspecialchars_uni($icons[$id]['name']);
					elseif(!$id) {
						if(!$lang->xthreads_no_icon) $lang->load('xthreads');
						$iconstr .= ($iconstr?', ':'') . '<em>'.$lang->xthreads_no_icon.'</em>';
					}
				}
				unset($icons);
				break;
		}
		*/
	}
	unset($filter);
	
	if($xthreads_forum_filter_args) {
		$filters_set['__all']['urlarg'] = htmlspecialchars_uni(substr($xthreads_forum_filter_args, 1));
		$filters_set['__all']['urlarga'] = '&amp;'.$filters_set['__all']['urlarg'];
		$filters_set['__all']['urlargq'] = '?'.$filters_set['__all']['urlarg'];
		$filters_set['__all']['forminput'] = $xthreads_forum_filter_form;
		$filters_set['__all']['hiddencss'] = 'display: none;';
		$filters_set['__all']['visiblecss'] = '';
		unset($filters_set['__all']['nullselected'], $filters_set['__all']['nullchecked'], $filters_set['__all']['nullactive']);
	}
	
	if($forum['xthreads_inlinesearch'] && isset($mybb->input['search']) && $mybb->input['search'] !== '') {
		$urlarg = 'search='.rawurlencode($mybb->input['search']);
		$xthreads_forum_filter_args .= '&'.$urlarg;
		$GLOBALS['xthreads_forum_search_form'] = '<input type="hidden" name="search" value="'.htmlspecialchars_uni($mybb->input['search']).'" />';
		$filters_set['__search']['forminput'] =& $GLOBALS['xthreads_forum_search_form'];
		$filters_set['__search']['value'] = htmlspecialchars_uni($mybb->input['search']);
		$filters_set['__search']['urlarg'] = htmlspecialchars_uni($urlarg);
		$filters_set['__search']['urlarga'] = '&amp;'.$filters_set['__search']['urlarg'];
		$filters_set['__search']['urlargq'] = '?'.$filters_set['__search']['urlarg'];
		$filters_set['__search']['selected'] = array($mybb->input['search'] => ' selected="selected"');
		$filters_set['__search']['checked'] = array($mybb->input['search'] => ' checked="checked"');
		$filters_set['__search']['active'] = array($mybb->input['search'] => 'filtertf_active');
		$filters_set['__search']['hiddencss'] = 'display: none;';
		$filters_set['__search']['visiblecss'] = '';
		unset($filters_set['__search']['nullselected'], $filters_set['__search']['nullchecked'], $filters_set['__search']['nullactive']);
	}
	
	if($show_threads) {
		$using_filter = ($forum['xthreads_inlinesearch'] || !empty($tf_filters) || !empty($xt_filters));
		if($using_filter || isset($xthreads_forum_sort)) {
			// only nice way to do all of this is to gain control of $templates, so let's do it
			control_object($GLOBALS['templates'], '
				function get($title, $eslashes=1, $htmlcomments=1) {
					static $done=false;
					if(!$done && $title == \'forumdisplay_orderarrow\') {
						$done = true;
						'.($using_filter?'xthreads_forumdisplay_filter();':'').'
						'.(isset($xthreads_forum_sort)?'
							$orderbyhack = xthreads_forumdisplay_sorter();
							return $orderbyhack.parent::get($title, $eslashes, $htmlcomments);
						':'').'
					}
					return parent::get($title, $eslashes, $htmlcomments);
				}
			');
			
			/*
			if($forum['xthreads_inlinesearch']) {
				// give us a bit of a free speed up since this isn't really being used anyway...
				$templates->cache['forumdisplay_searchforum'] = '';
			}
			*/
			
			// generate stuff for pagination/sort-links and fields for forms (sort listboxes, inline search)
			
		}
	}
	
	if($forum['xthreads_fdcolspan_offset']) {
		control_object($GLOBALS['cache'], '
			function read($name, $hard=false) {
				static $done=false;
				if(!$done && $name == "posticons" && isset($GLOBALS["colspan"])) {
					$done = true;
					$GLOBALS["colspan"] += $GLOBALS["foruminfo"]["xthreads_fdcolspan_offset"];
				}
				return parent::read($name, $hard);
			}
		');
	}
}

// Quick Thread integration function
function xthreads_forumdisplay_quickthread() {
	$tpl =& $GLOBALS['templates']->cache['forumdisplay_quick_thread'];
	if(xthreads_empty($tpl)) return;
	
	// grab fields
	$edit_fields = $GLOBALS['threadfield_cache']; // will be set
	// filter out non required fields (don't need to filter out un-editable fields as editable by all implies this)
	foreach($edit_fields as $k => &$v) {
		if(!empty($v['editable_gids']) || $v['editable'] != XTHREADS_EDITABLE_REQ)
			unset($edit_fields[$k]);
	}
	if(empty($edit_fields)) return;
	
	require_once MYBB_ROOT.'inc/xthreads/xt_updatehooks.php';
	$blank = array();
	xthreads_input_generate($blank, $edit_fields, $GLOBALS['fid']);
	if(!strpos($tpl, 'enctype="multipart/form-data"'))
		$tpl = str_replace('<form method="post" ', '<form method="post" enctype="multipart/form-data" ', $tpl);
	//$tpl = preg_replace('~(\<tbody.*?\<tr\>.*?)(\<tr\>)~is', '$1'.strtr($GLOBALS['extra_threadfields'], array('\\' => '\\\\', '$' => '\\$')).'$2', $tpl, 1);
}

function xthreads_forumdisplay_sorter() {
	global $xthreads_forum_sort, $mybb;
	if(empty($xthreads_forum_sort)) return '';
	$GLOBALS['t'] = $xthreads_forum_sort['t'];
	$GLOBALS['sortby'] = $xthreads_forum_sort['sortby'];
	$GLOBALS['sortfield'] = $xthreads_forum_sort['sortfield'];
	$mybb->input['sortby'] = htmlspecialchars($xthreads_forum_sort['sortby']);
	$GLOBALS['sortsel'] = array($xthreads_forum_sort['sortby'] => 'selected="selected"');
	// apply paranoia filtering...
	return '"; $orderarrow[\''.strtr($xthreads_forum_sort['sortby'], array('\\' => '', '\'' => '', '"' => '')).'\'] = "';
}

function xthreads_forumdisplay_filter_input($arg, &$tffilter, &$filter_set) {
	global $xthreads_forum_filter_form, $xthreads_forum_filter_args;
	if(is_array($tffilter) && count($tffilter) == 1) // single element array -> remove array-ness
		$tffilter = reset($tffilter);
	if(is_array($tffilter)) {
		$filter_set = array(
			'value' => '',
			'urlarg' => '',
			'urlarga' => '&',
			'urlargq' => '?',
			'forminput' => '',
			'selected' => array(),
			'checked' => array(),
			'active' => array(),
			'hiddencss' => 'display: none;',
			'visiblecss' => '',
		);
		$filterurl = '';
		foreach($tffilter as &$val) {
			$filter_set['forminput'] .= '<input type="hidden" name="'.htmlspecialchars($arg).'[]" value="'.htmlspecialchars_uni($val).'" />';
			$filterurl .= ($filterurl ? '&':'').rawurlencode($arg).'[]='.rawurlencode($val);
			
			$filter_set['value'] .= ($filter_set['value'] ? ', ':'').htmlspecialchars_uni($val);
			$filter_set['selected'][$val] = ' selected="selected"';
			$filter_set['checked'][$val] = ' checked="checked"';
			$filter_set['active'][$val] = 'filtertf_active';
		}
		$filter_set['urlarg'] = htmlspecialchars_uni($filterurl);
		$filter_set['urlarga'] = '&amp;'.$filter_set['urlarg'];
		$filter_set['urlargq'] = '?'.$filter_set['urlarg'];
		$xthreads_forum_filter_form .= $filter_set['forminput'];
		$xthreads_forum_filter_args .= '&'.$filterurl;
	} else {
		$formarg = '<input type="hidden" name="'.htmlspecialchars($arg).'" value="'.htmlspecialchars_uni($tffilter).'" />';
		$xthreads_forum_filter_form .= $formarg;
		$urlarg = rawurlencode($arg).'='.rawurlencode($tffilter);
		$xthreads_forum_filter_args .= '&'.$urlarg;
		$filter_set = array(
			'value' => htmlspecialchars_uni($tffilter),
			'urlarg' => htmlspecialchars_uni($urlarg),
			'urlarga' => '&amp;'.htmlspecialchars_uni($urlarg),
			'urlargq' => '?'.htmlspecialchars_uni($urlarg),
			'forminput' => $formarg,
			'selected' => array($tffilter => ' selected="selected"'),
			'checked' => array($tffilter => ' checked="checked"'),
			'active' => array($tffilter => 'filtertf_active'),
			'hiddencss' => 'display: none;',
			'visiblecss' => '',
		);
	}
}

function &xthreads_forumdisplay_xtfilter_extrainfo($table, $fields, $idfield, &$ids, $blanklang) {
	global $db, $lang;
	$ret = array();
	$query = $db->simple_select($table, implode(',',$fields), $idfield.' IN ('.$ids.')');
	while($thing = $db->fetch_array($query)) {
		foreach($fields as $f) {
			$ret[$f] .= ($ret[$f]?', ':'') . htmlspecialchars_uni($thing[$f]);
		}
	}
	$db->free_result($query);
	if(strpos(','.$ids.',', ',0,') !== false)
		foreach($fields as &$f)
			$ret[$f] .= ($ret[$f]?', ':'') . '<em>'.$lang->$blanklang.'</em>';
	return $ret;
}

function xthreads_forumdisplay_filter() {
	global $mybb, $foruminfo, $tf_filters, $xt_filters, $threadfield_cache;
	global $visibleonly, $tvisibleonly, $__xt_visibleonly, $db;
	
	$q = '';
	$tvisibleonly_tmp = $tvisibleonly;
	$__xt_visibleonly = $visibleonly;
	
	if($foruminfo['xthreads_inlinesearch']) {
		global $templates, $lang, $gobutton, $fid, $sortby, $sortordernow, $datecut, $xthreads_forum_filter_form;
		$searchval = '';
		if(!xthreads_empty($mybb->input['search'])) {
			$qstr = 'subject LIKE "%'.$db->escape_string_like($mybb->input['search']).'%"';
			$visibleonly .= ' AND '.$qstr;
			$q .= ' AND t.'.$qstr;
			$tvisibleonly .= ' AND t.'.$qstr;
			$searchval = htmlspecialchars_uni($mybb->input['search']);
		}
		
		eval('$GLOBALS[\'searchforum\'] = "'.$templates->get('forumdisplay_searchforum_inline').'";');
	}
	if(!empty($tf_filters)) {
		foreach($tf_filters as $field => &$val) {
			// $threadfield_cache is guaranteed to be set here
			$val2 = (is_array($val) ? $val : array($val));
			$fieldname = 'tfd.`'.$db->escape_string($field).'`';
			$filtermode = $threadfield_cache[$field]['allowfilter'];
			if(!xthreads_empty($threadfield_cache[$field]['multival'])) {
				// ugly, but no other way to really do this...
				$qstr = '(';
				$qor = '';
				switch($filtermode) {
					case XTHREADS_FILTER_PREFIX:
						$cfield = xthreads_db_concat_sql(array("\"\n\"", $fieldname));
						$qlpre = "%\n";
						$qlpost = '';
						break;
					case XTHREADS_FILTER_ANYWHERE:
						$cfield = $fieldname;
						$qlpre = $qlpost = '';
						break;
					default:
						$cfield = xthreads_db_concat_sql(array("\"\n\"", $fieldname, "\"\n\""));
						$qlpre = "%\n";
						$qlpost = "\n%";
				}
				foreach($val2 as &$v) {
					$qstr .= $qor.$cfield.' LIKE "'.$qlpre.xthreads_forumdisplay_filter_parselike($v, $filtermode).$qlpost.'"';
					if(!$qor) $qor = ' OR ';
				}
				$qstr .= ')';
			}
			elseif($threadfield_cache[$field]['datatype'] == XTHREADS_DATATYPE_TEXT) {
				if($filtermode == XTHREADS_FILTER_EXACT)
					$qstr = $fieldname.' IN ("'.implode('","', array_map(array($db, 'escape_string'), $val2)).'")';
				else {
					$qstr = '';
					$qor = '';
					foreach($val2 as &$v) {
						$qstr .= $qor.$fieldname.' LIKE "'.xthreads_forumdisplay_filter_parselike($v, $filtermode).'"';
						if(!$qor) $qor = ' OR ';
					}
					$qstr = '('.$qstr.')';
				}
			}
			else {
				// numeric filtering
				$qstr = xthreads_forumdisplay_filter_numericq($val2, $fieldname, $threadfield_cache[$field]['datatype']);
			}
			$q .= ' AND '.$qstr;
			$tvisibleonly .= ' AND '.$qstr;
		}
	}
	if(!empty($xt_filters)) {
		foreach($xt_filters as $field => &$val) {
			$fieldname = '`'.$db->escape_string($field).'`';
			$qstr = xthreads_forumdisplay_filter_numericq(is_array($val)?$val:array($val), $fieldname, XTHREADS_DATATYPE_UINT);
			$q .= ' AND t.'.$qstr;
			$tvisibleonly .= ' AND '.str_replace($fieldname, 't.'.$fieldname, $qstr);
			$visibleonly .= ' AND '.$qstr;
		}
	}
	if($q) {
		if(!empty($tf_filters)) {
			global $__xt_tvisibleonly;
			$__xt_tvisibleonly = $tvisibleonly_tmp.$q;
		}
		// and now we have to patch the DB to get proper thread counts...
		$dbf = $dbt = $dbu = '';
		// TODO: the following conditional may change depending on the outcome of this bug: https://github.com/mybb/mybb/issues/1890
		if(($GLOBALS['datecut'] <= 0 || $GLOBALS['datecut'] == 9999) && !@$GLOBALS['fpermissions']['canonlyviewownthreads']) {
			if(!empty($tf_filters))
				$dbf_code = '
					$table = "threads t LEFT JOIN {$this->table_prefix}threadfields_data tfd ON t.tid=tfd.tid";
					$fields = "COUNT(t.tid) AS threads, 0 AS unapprovedthreads, 0 AS deletedthreads";
					$conditions .= " $GLOBALS[__xt_tvisibleonly] $GLOBALS[tuseronly] $GLOBALS[datecutsql2] $GLOBALS[prefixsql2]";
				';
			else
				$dbf_code = '
					$table = "threads";
					$fields = "COUNT(tid) AS threads, 0 AS unapprovedthreads, 0 AS deletedthreads";
					$conditions .= " $GLOBALS[visibleonly] $GLOBALS[useronly] $GLOBALS[datecutsql] $GLOBALS[prefixsql]";
				';
			$dbf = '
				static $done_f = false;
				if(!$done_f && $table == "forums" && ($fields == "threads, unapprovedthreads" || $fields == "threads, unapprovedthreads, deletedthreads")) {
					$done_f = true;
					'.$dbf_code.'
					
				}
			';
		}
		if(!empty($tf_filters)) {
			// if filtering by thread fields, we need to patch the counting query to include threadfield data and patch the query to reference the correct tables
			function xthreads_forumdisplay_filter_fixqcond($conditions) {
				$repl = array();
				foreach(array(
					'useronly' => 'tuseronly',
					'visibleonly' => '__xt_tvisibleonly',
					'datecutsql' => 'datecutsql2',
					'prefixsql' => 'prefixsql2'
				) as $from => $to) {
					if($GLOBALS[$from])
						$repl[$GLOBALS[$from]] = $GLOBALS[$to];
				}
				if(empty($repl))
					return $conditions;
				return strtr($conditions, $repl);
			}
			$dbt = '
				static $done_t = false;
				if(!$done_t && ($table == "threads" || $table == "threads t") && $fields == "COUNT(tid) AS threads") {
					$done_t = true;
					$table = "threads t LEFT JOIN {$this->table_prefix}threadfields_data tfd ON t.tid=tfd.tid";
					$fields = "COUNT(t.tid) AS threads";
					$conditions = xthreads_forumdisplay_filter_fixqcond($conditions);
					$options = array("limit" => 1);
				}
			';
		}
		
		if($__xt_visibleonly != $visibleonly && $mybb->user['uid'])
			// fix up posts query in MyBB 1.6.4
			$dbu = '
				static $done_u = false;
				if(!$done_u && $table == "posts" && ($fields == "tid,uid" || $fields == "DISTINCT tid,uid") && strpos($conditions, $GLOBALS[\'visibleonly\'])) {
					$done_u = true;
					$conditions = str_replace($GLOBALS[\'visibleonly\'], $GLOBALS[\'__xt_visibleonly\'], $conditions);
				}
			';
		
		if($dbf || $dbt || $dbu) {
			control_db('
				function simple_select($table, $fields="*", $conditions="", $options=array()) {
					'.$dbt.$dbf.$dbu.'
					return parent::simple_select($table, $fields, $conditions, $options);
				}
			');
		}
	}
	
	// if we have custom filters/inline search, patch the forumdisplay paged URLs + sorter links
	global $xthreads_forum_filter_args, $page_url_xt;
	if($xthreads_forum_filter_args) {
		// if Google SEO multipage is active, force our URL into that
		if(function_exists('google_seo_url_cache') && $mybb->settings['google_seo_url_multipage'] && $mybb->settings['google_seo_url_forums']) {
			// force cache load
			$gsurl = google_seo_url_cache(GOOGLE_SEO_FORUM, $foruminfo['fid']);
			$page_url_xt = $xthreads_forum_filter_args;
			if(strpos($gsurl, '?') === false)
				$page_url_xt = '?'.substr($page_url_xt, 1);
			// pollute Google SEO's cache with our param
			$GLOBALS['google_seo_url_cache'][GOOGLE_SEO_FORUM][$foruminfo['fid']] = $gsurl.$page_url_xt;
			$GLOBALS['sorturl'] .= htmlspecialchars_uni($xthreads_forum_filter_args);
		} else {
			// inject URL into multipage using template cache hack
			global $templates;
			$tpls = array('multipage_end', 'multipage_nextpage', 'multipage_page', 'multipage_prevpage', 'multipage_start');
			foreach($tpls as &$t) {
				if(!isset($templates->cache[$t])) {
					$templates->cache(implode(',', $tpls));
					break;
				}
				$templates->cache[$t] = str_replace('{$page_url}', '{$page_url}{$GLOBALS[\'page_url_xt\']}', $templates->cache[$t]);
			}
			
			$page_url_xt = htmlspecialchars_uni($xthreads_forum_filter_args);
			$GLOBALS['sorturl'] .= $page_url_xt;
			
			// may need to replace first &amp; with a ?
			if(($mybb->settings['seourls'] == 'yes' || ($mybb->settings['seourls'] == 'auto' && $_SERVER['SEO_SUPPORT'] == 1)) && $GLOBALS['sortby'] == 'lastpost' && $GLOBALS['sortordernow'] == 'desc' && ($GLOBALS['datecut'] <= 0 || $GLOBALS['datecut'] == 9999) && !@$GLOBALS['tprefix']) //  && (strpos(FORUM_URL_PAGED, '{page}') === false) - somewhat unsupported, since MyBB hard codes the page 1 elimination behaviour
				$page_url_xt = '?'.substr($page_url_xt, 5);
		}
		$templates->cache['forumdisplay_threadlist'] = str_replace('<select name="sortby">', '{$xthreads_forum_filter_form}{$xthreads_forum_search_form}<select name="sortby">', $templates->cache['forumdisplay_threadlist']);
	}
}
function xthreads_forumdisplay_filter_parselike($s, $mode) {
	global $db;
	switch($mode) {
		case XTHREADS_FILTER_EXACT:
			return $db->escape_string_like($s);
		case XTHREADS_FILTER_PREFIX:
			return $db->escape_string_like($s).'%';
		case XTHREADS_FILTER_ANYWHERE:
			return '%'.$db->escape_string_like($s).'%';
		case XTHREADS_FILTER_WILDCARD:
			return strtr($db->escape_string_like($s), array('*'=>'%', '?'=>'_'));
	}
	return ''; // wtf fallback
}
function xthreads_forumdisplay_filter_numericq($val, $fieldname, $datatype) {
	$sanitize_func = ($datatype == XTHREADS_DATATYPE_FLOAT ? 'floatval':'intval');
	$qstr = '';
	$qor = '';
	$using_complex = false;
	foreach($val as $v) {
		// supported patterns: > >= < <= <> (between)
		if(($p = strpos($v, '-')) || ($p = strpos($v, '_'))) { // note, excluding 0th position here is intentional
			// between syntax
			$qstr .= $qor.$fieldname.($v[$p]=='_'?' NOT':'').' BETWEEN '.$sanitize_func($v).' AND '.$sanitize_func(trim(substr($v, $p+1)));
			$using_complex = true;
		} elseif(strpos($v, ',')) {
			$not = '';
			if($v[0] == '~') {
				$v = substr($v, 1);
				$not = ' NOT';
			}
			$qstr .= $fieldname.$not.' IN ('.implode(',', array_map($sanitize_func, explode(',', $v))).')';
			$using_complex = true;
		} elseif(in_array($v[0], array('<','>','='))) {
			if(in_array($v[1], array('<','>','='))) {
				$op = $v[0].$v[1];
				$v = substr($v, 2);
					if($op == '>>') $op = '>';
				elseif($op == '<<') $op = '<';
				elseif($op == '><') $op = '<>';
				elseif($op == '=<') $op = '<=';
				elseif($op == '=>') $op = '>=';
				elseif($op == '==') $op = '=';
			} else {
				$op = $v[0];
				$v = substr($v, 1);
			}
			$qstr .= $qor.$fieldname.' '.$op.' '.$sanitize_func($v);
			$using_complex = true;
		} else
			$qstr .= $qor.$fieldname.' = '.$sanitize_func($v);
		if(!$qor) $qor = ' OR ';
	}
	if($using_complex)
		return '('.$qstr.')';
	else
		// optimisation if only simple terms
		return $fieldname.' IN ('.implode(',', array_map($sanitize_func, $val)).')';
}

function xthreads_forumdisplay_thread() {
	global $thread, $threadfields, $threadfield_cache, $foruminfo;
	
	// make threadfields array
	$threadfields = array();
	foreach($threadfield_cache as $k => &$v) {
		xthreads_get_xta_cache($v, $GLOBALS['tids']);
		
		$threadfields[$k] =& $thread['xthreads_'.$k];
		xthreads_sanitize_disp($threadfields[$k], $v, (!xthreads_empty($thread['username']) ? $thread['username'] : $thread['threadusername']));
	}
	// evaluate group separator
	if($foruminfo['xthreads_grouping']) {
		static $threadcount = 0;
		static $nulldone = false;
		global $templates;
		
		if($thread['sticky'] == 0 && !$nulldone) {
			$nulldone = true;
			$nulls = (count($GLOBALS['threadcache']) - $threadcount) % $foruminfo['xthreads_grouping'];
			if($nulls) {
				$excess = $nulls;
				$nulls = $foruminfo['xthreads_grouping'] - $nulls;
				$GLOBALS['nullthreads'] = '';
				while($nulls--) {
					$bgcolor = alt_trow(); // TODO: this may be problematic
					eval('$GLOBALS[\'nullthreads\'] .= "'.$templates->get('forumdisplay_thread_null').'";');
				}
			}
		}
		
		// reset counter on sticky/normal sep
		if($thread['sticky'] == 0 && $GLOBALS['shownormalsep']) {
			$nulls = $threadcount % $foruminfo['xthreads_grouping'];
			if($nulls) {
				$excess = $nulls;
				$nulls = $foruminfo['xthreads_grouping'] - $nulls;
				while($nulls--) {
					$bgcolor = alt_trow();
					eval('$GLOBALS[\'threads\'] .= "'.$templates->get('forumdisplay_thread_null').'";');
				}
			}
			
			$threadcount = 0;
		}
		if($threadcount && $threadcount % $foruminfo['xthreads_grouping'] == 0)
			eval('$GLOBALS[\'threads\'] .= "'.$templates->get('forumdisplay_group_sep').'";');
		++$threadcount;
		
	}
}

function xthreads_tpl_forumbits(&$forum) {
	static $done=false;
	global $templates;
	
	if(!$done) {
		$done = true;
		function xthreads_tpl_forumbits_tplget(&$obj, &$forum, $title, $eslashes, $htmlcomments) {
			if($forum['xthreads_hideforum']) {
				// alternate the bgcolor if applicable (so we get no net change)
				if($title == 'forumbit_depth1_cat' || $title == 'forumbit_depth2_cat' || $title == 'forumbit_depth2_forum')
					$GLOBALS['bgcolor'] = alt_trow();
				return 'return "";';
			}
			global $forum_tpl_prefixes;
			if(!empty($forum_tpl_prefixes[$forum['fid']]))
				foreach($forum_tpl_prefixes[$forum['fid']] as &$p)
					if(isset($obj->cache[$p.$title]) && !isset($obj->non_existant_templates[$p.$title])) {
						$title = $p.$title;
						break;
					}
			return 'return "'.$obj->xthreads_tpl_forumbits_get($title, $eslashes, $htmlcomments).'";';
		}
		control_object($templates, '
			function get($title, $eslashes=1, $htmlcomments=1) {
				if(substr($title, 0, 9) != \'forumbit_\')
					return parent::get($title, $eslashes, $htmlcomments);
				return \'".eval(xthreads_tpl_forumbits_tplget($templates, $forum, \\\'\'.strtr($title, array(\'\\\\\' => \'\\\\\\\\\', \'\\\'\' => \'\\\\\\\'\')).\'\\\', \'.$eslashes.\', \'.$htmlcomments.\'))."\';
			}
			function xthreads_tpl_forumbits_get($title, $eslashes, $htmlcomments){
				return parent::get($title, $eslashes, $htmlcomments);
			}
		');
	}
	
	xthreads_set_threadforum_urlvars('forum', $forum['fid']);
}

function xthreads_global_forumbits_tpl() {
	global $templatelist, $forum_tpl_prefixes;
	// see what custom prefixes we have and cache
	// I'm lazy, so just grab all the forum prefixes even if unneeded (in practice, difficult to filter out things properly anyway)
	// TODO: perhaps make this smarter??
	$forum_tpl_prefixes = xthreads_get_tplprefixes(false);
	if(!empty($forum_tpl_prefixes)) {
		$forumcache = $GLOBALS['cache']->read('forums');
		foreach($forum_tpl_prefixes as $fid => &$prefs) {
			if($forumcache[$fid]['xthreads_hideforum']) continue;
			foreach($prefs as $pre) {
				// essentially, we need to escape this to prevent SQL injection
				// however, if we've taken over control over the templates engine, it'll already do the escaping for us, so don't double-escape
				if(!isset($GLOBALS['templates']->xt_tpl_prefix))
					$pre = $GLOBALS['db']->escape_string($pre);
				$templatelist .= ','.
					$pre.'forumbit_depth1_cat,'.
					$pre.'forumbit_depth1_cat_subforum,'.
					$pre.'forumbit_depth1_forum_lastpost,'.
					$pre.'forumbit_depth2_cat,'.
					$pre.'forumbit_depth2_forum,'.
					$pre.'forumbit_depth2_forum_lastpost,'.
					$pre.'forumbit_depth3,'.
					$pre.'forumbit_depth3_statusicon,'.
					$pre.'forumbit_moderators,'.
					$pre.'forumbit_subforums';
			}
		}
	}
}

// MyBB should really have such a function like this...
function xthreads_db_concat_sql($a) {
	switch(xthreads_db_type()) {
		case 'sqlite':
		case 'pgsql':
			return implode('||', $a);
		default:
			return 'CONCAT('.implode(',', $a).')';
	}

}
