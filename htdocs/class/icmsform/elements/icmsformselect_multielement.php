<?php
/**
 * Form control creating a multi selectbox for an object derived from icms_ipf_Object
 *
 * @copyright	The ImpressCMS Project http://www.impresscms.org/
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @package		icms_ipf_Object
 * @since		1.1
 * @author		marcan <marcan@impresscms.org>
 * @version		$Id$
 */

defined('ICMS_ROOT_PATH') or die("ImpressCMS root path not defined");

class IcmsFormSelect_multiElement extends icms_ipf_form_elements_Selectmulti  {
	private $_deprecated;

	public function __construct($object, $key) {
		parent::__construct($object, $key);
		$this->_deprecated = icms_core_Debug::setDeprecated('icms_ipf_form_elements_Selectmulti (control type: selectmulti)', sprintf(_CORE_REMOVE_IN_VERSION, '2.0'));
	}
}