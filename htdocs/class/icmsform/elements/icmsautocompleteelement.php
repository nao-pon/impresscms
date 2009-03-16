<?php
/**
* Form control creating an autocomplete select box powered by Scriptaculous
*
* @copyright	The ImpressCMS Project http://www.impresscms.org/
* @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
* @package		IcmsPersistableObject
* @since		1.1
* @author		marcan <marcan@impresscms.org>
* @version		$Id: icmsautocompleteelement.php 1889 2008-04-30 15:54:09Z malanciault $
*/

if (!defined('ICMS_ROOT_PATH')) die("ImpressCMS root path not defined");

class IcmsAutocompleteElement extends XoopsFormText {

	var $_include_file;

    function IcmsAutocompleteElement($caption, $name, $include_file, $size, $maxlength, $value="") {
		$this->_include_file = $include_file;
		$this->XoopsFormText($caption, $name, $size, $maxlength, $value);
    }

	/**
	 * Prepare HTML for output
	 *
     * @return	string  HTML
	 */
	function render(){
		$ret = "<input type='text' name='".$this->getName()."' id='".$this->getName()."' size='".$this->getSize()."' maxlength='".$this->getMaxlength()."' value='".$this->getValue()."'".$this->getExtra()." />";

		$ret .= '	<div class="icms_autocomplete_hint" id="icms_autocomplete_hint' . $this->getName() . '"></div>

	<script type="text/javascript">
		new Ajax.Autocompleter("' .$this->getName(). '","icms_autocomplete_hint' .$this->getName(). '","' . $this->_include_file . '?key=' . $this->getName() . '");
	</script>';

		return $ret;
	}
}
?>