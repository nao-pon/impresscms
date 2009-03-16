<?php
/**
* ImpressCMS Version Checker
*
* This page checks if the ImpressCMS install runs the latest released version
*
* @copyright	The ImpressCMS Project http://www.impresscms.org/
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @package		core
* @since		1.0
* @author		malanciault <marcan@impresscms.org)
* @version		$Id: error.php 429 2008-01-02 22:21:41Z malanciault $
*/

if ( !is_object($xoopsUser) || !is_object($xoopsModule) || !$xoopsUser->isAdmin() ) {
    exit("Access Denied");
}

/*
 * If an mid is defined in the GET params then this file is called by clicking on a module Info button in
 * System Admin > Modules, so we need to display the module information pop up
 * 
 * @todo this has nothing to do in the version checker system module, but it is there as a 
 * reminiscence of XOOPS. It needs tp be moved elsewhere in 1.1
 */
if (isset($_GET['mid'])) {
	include_once XOOPS_ROOT_PATH . '/modules/system/admin/version/module_info.php';
	exit;
}

/**
 * Now here is the version checker :-)
 */
global $icmsAdminTpl;
require_once XOOPS_ROOT_PATH.'/class/icmsversionchecker.php';
$icmsVersionChecker = IcmsVersionChecker::getInstance();

if ($icmsVersionChecker->check()) {
	$icmsAdminTpl->assign('update_available', true);
	$icmsAdminTpl->assign('latest_changelog', $icmsVersionChecker->latest_changelog);
	
	if (ICMS_VERSION_STATUS == 10 && $icmsVersionChecker->latest_status < 10) {
		// I'm runing a final release so make sure to notify the user that the update is not a final
		$icmsAdminTpl->assign('not_a_final_comment', true);
	}
	
}
else {
	$checkerErrors = $icmsVersionChecker->getErrors(true);
	if ($checkerErrors) {
		$icmsAdminTpl->assign('errors', $checkerErrors);
	}
}
xoops_cp_header();
$icmsAdminTpl->assign('latest_version', $icmsVersionChecker->latest_version_name);
$icmsAdminTpl->assign('your_version', $icmsVersionChecker->installed_version_name);
$icmsAdminTpl->assign('latest_url', $icmsVersionChecker->latest_url);	

$icmsAdminTpl->display(XOOPS_ROOT_PATH.'/modules/system/templates/admin/system_adm_version.html');
xoops_cp_footer();
?>