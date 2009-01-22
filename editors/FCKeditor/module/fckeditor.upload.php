<?php 
/**
 * FCKeditor adapter for XOOPS
 *
 * @copyright	The XOOPS project http://www.xoops.org/
 * @license		http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author		Taiwen Jiang (phppp or D.J.) <php_pp@hotmail.com>
 * @since		4.00
 * @version		$Id: fckeditor.upload.php 4709 2008-09-06 21:07:58Z skenow $
 * @package		xoopseditor
 */
require "header.php";

define("FCKUPLOAD_DISABLED", 0);
define("XOOPS_FCK_FOLDER", $xoopsModule->getVar("dirname"));
include XOOPS_ROOT_PATH."/class/xoopseditor/FCKeditor/editor/filemanager/upload/php/upload.php";
?>