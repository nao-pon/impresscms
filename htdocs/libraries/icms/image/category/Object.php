<?php
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <http://www.xoops.org/>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author: Kazumi Ono (AKA onokazu)                                          //
// URL: http://www.myweb.ne.jp/, http://www.xoops.org/, http://jp.xoops.org/ //
// Project: The XOOPS Project                                                //
// ------------------------------------------------------------------------- //
/**
 * Image categories
 *
 * @copyright	http://www.impresscms.org/ The ImpressCMS Project
 * @license		LICENSE.txt
 * @category	ICMS
 * @package		Image
 * @subpackage	Category
 * @version		SVN: $Id$
 */

defined('ICMS_ROOT_PATH') or die("ImpressCMS root path not defined");

/**
 * An image category
 *
 * These categories are managed through a {@link icms_image_category_Handler} object

 * @category	ICMS
 * @package     Image
 * @subpackage	Category
 * @author	    Kazumi Ono	<onokazu@xoops.org>
 * @copyright	Copyright (c) 2000 XOOPS.org
 */
class icms_image_category_Object extends icms_core_Object {
	private $_imageCount;

	/**
	 * Constructor
	 *
	 */
	public function __construct() {
		parent::__construct();
		$this->initVar('imgcat_id', self::DTYPE_INTEGER, null, false);
		$this->initVar('imgcat_pid', self::DTYPE_INTEGER, null, false);
		$this->initVar('imgcat_name', self::DTYPE_STRING, null, true, 100);
		$this->initVar('imgcat_foldername', self::DTYPE_STRING, null, true, 100);
		$this->initVar('imgcat_display', self::DTYPE_INTEGER, 1, false);
		$this->initVar('imgcat_weight', self::DTYPE_INTEGER, 0, false);
		$this->initVar('imgcat_maxsize', self::DTYPE_INTEGER, 0, false);
		$this->initVar('imgcat_maxwidth', self::DTYPE_INTEGER, 0, false);
		$this->initVar('imgcat_maxheight', self::DTYPE_INTEGER, 0, false);
		$this->initVar('imgcat_type', self::DTYPE_STRING, null, false, 1);
		$this->initVar('imgcat_storetype', self::DTYPE_STRING, null, false, 5);
	}

	/**
	 * Set count of images in a category
	 * @param	int $value Value
	 */
	public function setImageCount($value) {
		$this->_imageCount = (int) $value;
	}

	/**
	 * Gets count of images in a category
	 * @return	int _imageCount number of images
	 */
	public function getImageCount() {
		return $this->_imageCount;
	}
}

