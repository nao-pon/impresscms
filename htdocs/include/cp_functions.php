<?php
/**
* All control panel functions and forming goes from here.
* Be careful while editing this file!
*
* @copyright	XOOPS_copyrights.txt
* @copyright	The XOOPS Project <http://www.xoops.org/>
* @copyright	The ImpressCMS Project <http://www.impresscms.org/>
* 
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* 
* @package		core
* @since		XOOPS
* @author		Gustavo Pilla (aka nekro) <nekro@impresscms.org>
* @version		$Id: $
* 
* @author		The XOOPS Project <http://www.xoops.org>
* @author		Sina Asghari (aka stranger) <pesian_stranger@users.sourceforge.net>
* @author 		Gustavo Pilla (aka nekro) <nekro@impresscms.org>
*/
define ( 'XOOPS_CPFUNC_LOADED', 1 );

include_once ICMS_ROOT_PATH . '/class/template.php';

/**
 * Function icms_cp_header
 * 
 * @since ImpressCMS 1.2
 * @version $Id$
 * 
 * @author rowd (from the XOOPS Community)
 * @author nekro (aka Gustavo Pilla)<nekro@impresscms.org>
 */
function icms_cp_header(){
    global $xoopsConfig, $xoopsModule, $xoopsUser, $xoopsOption, $xoTheme, $im_multilanguageConfig, $xoopsLogger, $icmsAdminTpl, $icmsPreloadHandler;
	$xoopsLogger->stopTime( 'Module init' );
	$xoopsLogger->startTime( 'ImpressCMS CP Output Init' );
	
	if (!headers_sent()) {
		header('Content-Type:text/html; charset='._CHARSET);
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header('Cache-Control: no-store, no-cache, must-revalidate');
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
    }
	
    require_once ICMS_ROOT_PATH . '/class/template.php';
    require_once ICMS_ROOT_PATH . '/class/theme.php';
    require_once ICMS_ROOT_PATH . '/class/theme_blocks.php';
	
    
	$icmsAdminTpl = new XoopsTpl();
	
	$icmsAdminTpl->assign('xoops_url',ICMS_URL);
	$icmsAdminTpl->assign('xoops_sitename',$xoopsConfig['sitename']);
	
	if ( @$xoopsOption['template_main'] ) {
		if ( false === strpos( $xoopsOption['template_main'], ':' ) ) {
			$xoopsOption['template_main'] = 'db:' . $xoopsOption['template_main'];
		}
	}
	$xoopsThemeFactory = new xos_opal_ThemeFactory();
	$xoopsThemeFactory->allowedThemes = $xoopsConfig['theme_set_allowed'];
	
	// The next 2 lines are for compatibility only... to implement the admin theme ;)
	// TODO: Remove all this after a few versions!!
	if(isset($xoopsConfig['theme_admin_set']))
		$xoopsThemeFactory->defaultTheme = $xoopsConfig['theme_admin_set'];
    $xoTheme =& $xoopsThemeFactory->createInstance( array(
    	'contentTemplate'	=> @$xoopsOption['template_main'],
    	'canvasTemplate'	=> 'theme'.(( file_exists(ICMS_THEME_PATH.'/'.$xoopsConfig['theme_admin_set'].'/theme_admin.html')) ?'_admin':'').'.html',
    	'plugins' 			=> array('xos_logos_PageBuilder')
    ) );
    $icmsAdminTpl = $xoTheme->template;
    
	$xoTheme->addScript( ICMS_URL.'/include/xoops.js', array( 'type' => 'text/javascript' ) );
	$xoTheme->addScript( '' ,array( 'type' => 'text/javascript' ) , 'startList = function() {
	if (document.all&&document.getElementById) {
		navRoot = document.getElementById("nav");
		for (i=0; i<navRoot.childNodes.length; i++) {
			node = navRoot.childNodes[i];
			if (node.nodeName=="LI") {
				node.onmouseover=function() {
					this.className+=" over";
				}
				node.onmouseout=function() {
					this.className=this.className.replace(" over", "");
				}
			}
		}
	}
}
window.onload=startList;');
    $xoTheme->addStylesheet(ICMS_URL.'/icms'.(( defined('_ADM_USE_RTL') && _ADM_USE_RTL )?'_rtl':'').'.css', array('media' => 'screen'));
//	$xoTheme->addStylesheet( '/modules/system/style.css' );
	
			$config_handler =& xoops_gethandler('config');
			$icmsConfigPlugins =& $config_handler->getConfigsByCat(ICMS_CONF_PLUGINS);
 			$jscript = '';
 		        foreach ($icmsConfigPlugins['sanitizer_plugins'] as $key) {
 		        	if(empty($key)) continue;
 		        	if(file_exists(ICMS_ROOT_PATH.'/plugins/textsanitizer/'.$key.'/'.$key.'.js')){
 		        		$xoTheme->addScript(ICMS_URL.'/plugins/textsanitizer/'.$key.'/'.$key.'.js', array('type' => 'text/javascript'));
 		        	}else{
 		        		$extension = include_once ICMS_ROOT_PATH.'/plugins/textsanitizer/'.$key.'/'.$key.'.php';
 		        		$func = 'javascript_'.$key;
 		        		if ( function_exists($func) ) {
 		        			@list($encode, $jscript) = $func($ele_name);
 		        		 	if (!empty($jscript)) {
 		        		 		if(!file_exists(ICMS_ROOT_PATH.'/'.$jscript)){
 		        					$xoTheme->addScript('', array('type' => 'text/javascript'), $jscript);
 		        				}else{
 		        					$xoTheme->addScript($jscript, array('type' => 'text/javascript'));
 		        				}
 		        			}
 		        		}
 		        	}
 		        }

 			$style_info = '';
 		        foreach ($icmsConfigPlugins['sanitizer_plugins'] as $key) {
 		        	if(empty($key)) continue;
 		        	if(file_exists(ICMS_ROOT_PATH.'/plugins/textsanitizer/'.$key.'/'.$key.'.css')){
 		        		$xoTheme->addStylesheet(ICMS_URL.'/plugins/textsanitizer/'.$key.'/'.$key.'.css', array('media' => 'screen'));
 		        	}else{
 		        		$extension = include_once ICMS_ROOT_PATH.'/plugins/textsanitizer/'.$key.'/'.$key.'.php';
 		        		$func = 'style_'.$key;
 		        		if ( function_exists($func) ) {
 		        			$style_info = $func();
 		        		 	if (!empty($style_info)) {
 		        		 		if(!file_exists(ICMS_ROOT_PATH.'/'.$style_info)){
 		        					$xoTheme->addStylesheet('', array('media' => 'screen'), $style_info);
 		        				}else{
 		        					$xoTheme->addStylesheet($style_info, array('media' => 'screen'));
 		        				}
 		        			}
 		        		}
 		        	}
 		        }

	/**
	 * Loading admin dropdown menus
	 */
	if (! file_exists ( XOOPS_CACHE_PATH . '/adminmenu_' . $xoopsConfig ['language'] . '.php' )) {
		xoops_confirm ( array ('op' => 2 ), XOOPS_URL . '/admin.php', _RECREATE_ADMINMENU_FILE );
		exit ();
	}
	$file = file_get_contents ( XOOPS_CACHE_PATH . "/adminmenu_" . $xoopsConfig ['language'] . ".php" );
	$admin_menu = eval ( 'return ' . $file . ';' );
	
	$moduleperm_handler = & xoops_gethandler ( 'groupperm' );
	$module_handler = & xoops_gethandler ( 'module' );
	foreach ( $admin_menu as $k => $navitem ) {
		if ($navitem ['id'] == 'modules') { //Getting array of allowed modules to use in admin home
			$perm_itens = array ( );
			foreach ( $navitem ['menu'] as $item ) {
				$module = $module_handler->getByDirname ( $item ['dir'] );
				$admin_perm = $moduleperm_handler->checkRight ( 'module_admin', $module->mid (), $xoopsUser->getGroups () );
				if ($admin_perm) {
					if ($item ['dir'] != 'system') {
						$perm_itens [] = $item;
					}
				}
			}
			$navitem ['menu'] = $mods = $perm_itens;
		} //end
		if ($navitem ['id'] == 'opsystem') {
			$groups = $xoopsUser->getGroups ();
			$all_ok = false;
			if (! in_array ( XOOPS_GROUP_ADMIN, $groups )) {
				$sysperm_handler = & xoops_gethandler ( 'groupperm' );
				$ok_syscats = & $sysperm_handler->getItemIds ( 'system_admin', $groups );
			} else {
				$all_ok = true;
			}
			$perm_itens = array ( );
			
			/**
			 * Allow easely change the order of system dropdown menu.
			 * $adminmenuorder = 1; Alphabetically order;
			 * $adminmenuorder = 0; Indice key order;
			 * To change the order when using Indice key order just change the order of the array in the file modules/system/menu.php and after update the system module
			 * 
			 * @todo: Create a preference option to set this value and improve the way to change the order.
			 */
			$adminmenuorder = 1;
			$adminsubmenuorder = 1;
			if ($adminmenuorder == 1) {
				foreach ( $navitem ['menu'] as $k => $sortarray ) {
					$column [] = $sortarray ['title'];
					if (isset ( $sortarray ['subs'] ) && count ( $sortarray ['subs'] ) > 0 && $adminsubmenuorder) {
						asort ( $navitem ['menu'] [$k] ['subs'] ); //Sorting submenus of preferences
					}
				}
				//sort arrays after loop
				array_multisort ( $column, SORT_ASC, $navitem ['menu'] );
			}
			foreach ( $navitem ['menu'] as $item ) {
				if (false != $all_ok || in_array ( $item ['id'], $ok_syscats )) {
					$perm_itens [] = $item;
				}
			}
			$navitem ['menu'] = $sysprefs = $perm_itens; //Getting array of allowed system prefs
		}
		$icmsAdminTpl->append ( 'navitems', $navitem );
	}
	//icms_debug_vardump($sysprefs);
	if (count ( $sysprefs ) > 0) {
		$icmsAdminTpl->assign ( 'systemadm', 1 );
	} else {
		$icmsAdminTpl->assign ( 'systemadm', 0 );
	}
	if (count ( $mods ) > 0) {
		$icmsAdminTpl->assign ( 'modulesadm', 1 );
	} else {
		$icmsAdminTpl->assign ( 'modulesadm', 0 );
	}
	
	/**
	 * Loading options of the current module.
	 */
	if ($xoopsModule) {
		if ($xoopsModule->dirname () == 'system') {
			if (isset ( $sysprefs ) && count ( $sysprefs ) > 0) {
				for($i = count ( $sysprefs ) - 1; $i >= 0; $i = $i - 1) {
					if (isset ( $sysprefs [$i] )) {
						$reversed_sysprefs [] = $sysprefs [$i];
					}
				}
				foreach ( $reversed_sysprefs as $k ) {
					$icmsAdminTpl->append ( 'mod_options', array ('title' => $k ['title'], 'link' => $k ['link'], 'icon' => (isset ( $k ['icon'] ) && $k ['icon'] != '' ? $k ['icon'] : '') ) );
				}
			}
		} else {
			foreach ( $mods as $mod ) {
				if ($mod ['dir'] == $xoopsModule->dirname ()) {
					$m = $mod; //Getting info of the current module
					break;
				}
			}
			if (isset ( $m ['subs'] ) && count ( $m ['subs'] ) > 0) {
				for($i = count ( $m ['subs'] ) - 1; $i >= 0; $i = $i - 1) {
					if (isset ( $m ['subs'] [$i] )) {
						$reversed_module_admin_menu [] = $m ['subs'] [$i];
					}
				}
				foreach ( $reversed_module_admin_menu as $k ) {
					$icmsAdminTpl->append ( 'mod_options', array ('title' => $k ['title'], 'link' => $k ['link'], 'icon' => (isset ( $k ['icon'] ) && $k ['icon'] != '' ? $k ['icon'] : '') ) );
				}
			}
		}
		$icmsAdminTpl->assign ( 'modpath', XOOPS_URL . '/modules/' . $xoopsModule->dirname () );
		$icmsAdminTpl->assign ( 'modname', $xoopsModule->name () );
		$icmsAdminTpl->assign ( 'modid', $xoopsModule->mid () );
		$icmsAdminTpl->assign ( 'moddir', $xoopsModule->dirname () );
		$icmsAdminTpl->assign ( 'lang_prefs', _PREFERENCES );
	}
	
	if ( @is_object( $xoTheme->plugins['xos_logos_PageBuilder'] ) ) {
		$aggreg =& $xoTheme->plugins['xos_logos_PageBuilder'];

	    $icmsAdminTpl->assign_by_ref( 'xoAdminBlocks', $aggreg->blocks );

	    // Backward compatibility code for pre 2.0.14 themes
		$icmsAdminTpl->assign_by_ref( 'xoops_lblocks', $aggreg->blocks['canvas_left'] );
		$icmsAdminTpl->assign_by_ref( 'xoops_rblocks', $aggreg->blocks['canvas_right'] );
		$icmsAdminTpl->assign_by_ref( 'xoops_ccblocks', $aggreg->blocks['page_topcenter'] );
		$icmsAdminTpl->assign_by_ref( 'xoops_clblocks', $aggreg->blocks['page_topleft'] );
		$icmsAdminTpl->assign_by_ref( 'xoops_crblocks', $aggreg->blocks['page_topright'] );

		$icmsAdminTpl->assign( 'xoops_showlblock', !empty($aggreg->blocks['canvas_left']) );
		$icmsAdminTpl->assign( 'xoops_showrblock', !empty($aggreg->blocks['canvas_right']) );
		$icmsAdminTpl->assign( 'xoops_showcblock', !empty($aggreg->blocks['page_topcenter']) || !empty($aggreg->blocks['page_topleft']) || !empty($aggreg->blocks['page_topright']) );
		
		/**
		 * Send to template some ml infos
		 */
		$icmsAdminTpl->assign ( 'lang_prefs', _IMPRESSCMS_PREFS );
		$icmsAdminTpl->assign ( 'ml_is_enabled', $im_multilanguageConfig ['ml_enable'] );
		$config_handler = & xoops_gethandler ( 'config' );
		$xoopsConfigPersona = & $config_handler->getConfigsByCat( XOOPS_CONF_PERSONA );
		$icmsAdminTpl->assign( 'adm_left_logo', $xoopsConfigPersona['adm_left_logo'] );		
		$icmsAdminTpl->assign( 'adm_left_logo_url', $xoopsConfigPersona['adm_left_logo_url'] );
		$icmsAdminTpl->assign( 'adm_left_logo_alt', $xoopsConfigPersona['adm_left_logo_alt'] );
		$icmsAdminTpl->assign( 'adm_right_logo', $xoopsConfigPersona['adm_right_logo'] );
		$icmsAdminTpl->assign( 'adm_right_logo_url', $xoopsConfigPersona['adm_right_logo_url'] );
		$icmsAdminTpl->assign( 'adm_right_logo_alt', $xoopsConfigPersona['adm_right_logo_alt'] );
		$icmsAdminTpl->assign( 'show_impresscms_menu', $xoopsConfigPersona['show_impresscms_menu']);
		
	}
}

/**
 * Backwards compatibility function.
 * 
 * @since XOOPS
 * @version $Id$
 * @deprecated 
 *
 * @author The Xoops Project <http://www.xoops.org>
 * @author Gustavo Pilla (aka nekro) <nekro@impresscms.org> 
 */
function xoops_cp_header(){
	icms_cp_header();
}

/**
 * Function icms_cp_footer
 * 
 * @since ImpressCMS 1.2
 * @version $Id$
 * @author rowd (from XOOPS Community)
 * @author Gustavo Pilla (aka nekro) <nekro@impresscms.org>
 */
function icms_cp_footer(){
	global $xoopsConfig, $xoopsOption, $xoopsLogger, $xoopsUser, $xoTheme, $icmsTpl ,$im_multilanguageConfig, $icmsLibrariesHandler, $xoopsModule;
	$xoopsLogger->stopTime( 'Module display' );

	if (!headers_sent()) {
			header('Content-Type:text/html; charset='._CHARSET);
			header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
			header('Cache-Control: private, no-cache');
			header('Pragma: no-cache');
	}
	if ( isset( $xoopsOption['template_main'] ) && $xoopsOption['template_main'] != $xoTheme->contentTemplate ) {
		trigger_error( "xoopsOption[template_main] should be defined before including header.php", E_USER_WARNING );
		if ( false === strpos( $xoopsOption['template_main'], ':' ) ) {
			$xoTheme->contentTemplate = 'db:' . $xoopsOption['template_main'];
		} else {
			$xoTheme->contentTemplate = $xoopsOption['template_main'];
		}
	}
		
	$xoopsLogger->stopTime( 'XOOPS output init' );
	$xoopsLogger->startTime( 'Module display' );
	
	$xoTheme->render();

	$xoopsLogger->stopTime();
	return;
}

/**
 * Backwars compatibility function
 * 
 * @version $Id$
 * @deprecated
 * 
 * @author The XOOPS Project <http://www.xoops.org>
 * @author Gustavo Pilla (aka nekro) <nekro@impresscms.org> 
 */
function xoops_cp_footer(){
	icms_cp_footer();	
}

// We need these because theme files will not be included
function OpenTable() {
	echo "<table width='100%' border='0' cellspacing='1' cellpadding='8' style='border: 2px solid #2F5376;'><tr class='bg4'><td valign='top'>\n";
}

function CloseTable() {
	echo '</td></tr></table>';
}

function themecenterposts($title, $content) {
	echo '<table cellpadding="4" cellspacing="1" width="98%" class="outer"><tr><td class="head">' . $title . '</td></tr><tr><td><br />' . $content . '<br /></td></tr></table>';
}

function myTextForm($url, $value) {
	return '<form action="' . $url . '" method="post"><input type="submit" value="' . $value . '" /></form>';
}

function xoopsfwrite() {
	if ($_SERVER ['REQUEST_METHOD'] != 'POST') {
		return false;
	} else {
	
	}
	if (! xoops_refcheck ()) {
		return false;
	} else {
	
	}
	return true;
}

/**
 * Creates a multidimensional array with items of the dropdown menus of the admin panel.
 * This array will be saved, by the function xoops_module_write_admin_menu, in a cache file 
 * to preserve resources of the server and to maintain compatibility with some modules Xoops.
 * 
 * @since ImpressCMS 1.1
 * @version $Id$
 * 
 * @author TheRplima
 * 
 * @return array (content of admin panel dropdown menus)
 */
function impresscms_get_adminmenu() {
	global $xoopsUser;
	
	$admin_menu = array ( );
	$modules_menu = array ( );
	$systemadm = false;
	$cont = 0;
	
	#########################################################################
	# Control Panel Home menu
	#########################################################################
	$i = 0;
	$menu [$i] ['link'] = ICMS_URL . "/admin.php";
	$menu [$i] ['title'] = _CPHOME;
	$menu [$i] ['absolute'] = 1;
	$menu [$i] ['small'] = ICMS_URL . "/modules/system/images/mini_cp.png";
	$i ++;
	
	$menu [$i] ['link'] = ICMS_URL;
	$menu [$i] ['title'] = _YOURHOME;
	$menu [$i] ['absolute'] = 1;
	$menu [$i] ['small'] = ICMS_URL . "/modules/system/images/home.png";
	$i ++;
	
	$menu [$i] ['link'] = ICMS_URL . "/user.php?op=logout";
	$menu [$i] ['title'] = _LOGOUT;
	$menu [$i] ['absolute'] = 1;
	$menu [$i] ['small'] = ICMS_URL . '/images/logout.png';
	
	$admin_menu [$cont] ['id'] = 'cphome';
	$admin_menu [$cont] ['text'] = _CPHOME;
	$admin_menu [$cont] ['link'] = '#';
	$admin_menu [$cont] ['menu'] = $menu;
	$cont ++;
	#########################################################################
	# end
	#########################################################################
	

	#########################################################################
	# System Preferences menu
	#########################################################################
	$module_handler = xoops_gethandler ( 'module' );
	$mod = & $module_handler->getByDirname ( 'system' );
	$menu = array ( );
	foreach ( $mod->getAdminMenu () as $lkn ) {
		$lkn ['dir'] = 'system';
		$menu [] = $lkn;
	}
	
	$admin_menu [$cont] ['id'] = 'opsystem';
	$admin_menu [$cont] ['text'] = _SYSTEM;
	$admin_menu [$cont] ['link'] = '';
	$admin_menu [$cont] ['menu'] = $menu;
	$cont ++;
	#########################################################################
	# end
	#########################################################################
	
	$admin_menu [$cont] ['id'] = 'modules';
	$admin_menu [$cont] ['text'] = _MODULES;
	$admin_menu [$cont] ['link'] = ICMS_URL . '/modules/system/admin.php?fct=modulesadmin';
	$admin_menu [$cont] ['menu'] = $modules_menu;
	$cont ++;
	#########################################################################
	# end
	#########################################################################
	

	#########################################################################
	# ImpressCMS News Feed menu
	#########################################################################
	$i = 0;
	$menu = array ( );
	
	$menu [$i] ['link'] = 'http://www.impresscms.org';
	$menu [$i] ['title'] = _IMPRESSCMS_HOME;
	$menu [$i] ['absolute'] = 1;
	//$menu[$i]['small'] = ICMS_URL.'/images/impresscms.png';
	$i ++;
	
	if ( _LANGCODE != 'en' ){
	$menu [$i] ['link'] = _IMPRESSCMS_LOCAL_SUPPORT;
	$menu [$i] ['title'] = _IMPRESSCMS_LOCAL_SUPPORT_TITLE;
	$menu [$i] ['absolute'] = 1;
	//$menu[$i]['small'] = ICMS_URL.'/images/impresscms.png';
	$i ++;
    }

	$menu [$i] ['link'] = 'http://community.impresscms.org';
	$menu [$i] ['title'] = _IMPRESSCMS_COMMUNITY;
	$menu [$i] ['absolute'] = 1;
	//$menu[$i]['small'] = ICMS_URL.'/images/impresscms.png';
	$i ++;
	
	$menu [$i] ['link'] = 'http://addons.impresscms.org';
	$menu [$i] ['title'] = _IMPRESSCMS_ADDONS;
	$menu [$i] ['absolute'] = 1;
	//$menu[$i]['small'] = ICMS_URL.'/images/impresscms.png';
	$i ++;
	
	$menu [$i] ['link'] = 'http://wiki.impresscms.org';
	$menu [$i] ['title'] = _IMPRESSCMS_WIKI;
	$menu [$i] ['absolute'] = 1;
	//$menu[$i]['small'] = ICMS_URL.'/images/impresscms.png';
	$i ++;
	
	$menu [$i] ['link'] = 'http://blog.impresscms.org';
	$menu [$i] ['title'] = _IMPRESSCMS_BLOG;
	$menu [$i] ['absolute'] = 1;
	//$menu[$i]['small'] = ICMS_URL.'/images/impresscms.png';
	$i ++;
	
	$menu [$i] ['link'] = 'http://sourceforge.net/projects/impresscms/';
	$menu [$i] ['title'] = _IMPRESSCMS_SOURCEFORGE;
	$menu [$i] ['absolute'] = 1;
	//$menu[$i]['small'] = ICMS_URL.'/images/impresscms.png';
	$i ++;
	
	$menu [$i] ['link'] = 'http://www.impresscms.org/donations/';
	$menu [$i] ['title'] = _IMPRESSCMS_DONATE;
	$menu [$i] ['absolute'] = 1;
	//$menu[$i]['small'] = ICMS_URL.'/images/impresscms.png';
	$i ++;
	
	$menu [$i] ['link'] = ICMS_URL . "/admin.php?rssnews=1";
	$menu [$i] ['title'] = _IMPRESSCMS_NEWS;
	$menu [$i] ['absolute'] = 1;
	//$menu[$i]['small'] = ICMS_URL.'/images/impresscms.png';
	$i ++;
	
	$admin_menu [$cont] ['id'] = 'news';
	$admin_menu [$cont] ['text'] = _ABOUT;
	$admin_menu [$cont] ['link'] = '#';
	$admin_menu [$cont] ['menu'] = $menu;
	$cont ++;
	#########################################################################
	# end
	#########################################################################
	

	return $admin_menu;
}

/**
 * Function maintained only for compatibility
 *
 * @todo Search all places that this function is called
 *       and rename it to impresscms_get_adminmenu.
 *       After this function can be removed.
 *
 */
function xoops_module_get_admin_menu() {
	return impresscms_get_adminmenu ();
}

function xoops_module_write_admin_menu($content) {
	global $xoopsConfig;
	if (! xoopsfwrite ()) {
		return false;
	}
	
	$filename = ICMS_CACHE_PATH . '/adminmenu_' . $xoopsConfig ['language'] . '.php';
	if (! $file = fopen ( $filename, "w" )) {
		echo 'failed open file';
		return false;
	}
	if (fwrite ( $file, var_export ( $content, true ) ) == - 1) {
		echo 'failed write file';
		return false;
	}
	fclose ( $file );
	
	// write index.html file in cache folder
	// file is delete after clear_cache (smarty)
	xoops_write_index_file ( ICMS_CACHE_PATH );
	return true;
}

function xoops_write_index_file($path = '') {
	if (empty ( $path )) {
		return false;
	}
	if (! xoopsfwrite ()) {
		return false;
	}
	
	$path = substr ( $path, - 1 ) == "/" ? substr ( $path, 0, - 1 ) : $path;
	$filename = $path . '/index.html';
	if (file_exists ( $filename )) {
		return true;
	}
	if (! $file = fopen ( $filename, "w" )) {
		echo 'failed open file';
		return false;
	}
	if (fwrite ( $file, "<script>history.go(-1);</script>" ) == - 1) {
		echo 'failed write file';
		return false;
	}
	fclose ( $file );
	return true;
}
?>