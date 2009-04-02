<?php
/**
 * ImpressCMS Block Persistable Class for Configure
 * 
 *
 * @copyright 	The ImpressCMS Project <http://www.impresscms.org>
 * @license		GNU General Public License (GPL) <http://www.gnu.org/licenses/old-licenses/gpl-2.0.html>
 * @since 		ImpressCMS 1.2
 * @version		$Id: $
 * @author		Gustavo Pilla (aka nekro) <nekro@impresscms.org>
 */

defined('ICMS_ROOT_PATH') or die('ImpressCMS root path not defined');

include_once ICMS_ROOT_PATH . '/kernel/block.php';


/**
 * System Block Configuration Object Class
 * 
 * @since ImpressCMS 1.2 
 * @author Gustavo Pilla (aka nekro) <nekro@impresscms.org>
 */
class SystemBlocksadmin extends IcmsBlock {
	
	/**
	 * Constructor
	 *
	 * @param SystemBlocksadminHandler $handler
	 */
	public function __construct(& $handler) {
		
		parent::__construct( $handler );
				
		$this->initNonPersistableVar('visiblein', XOBJ_DTYPE_OTHER, 'visiblein', false, false, false, true);
		
		$this->hideFieldFromForm('last_modified');
		$this->hideFieldFromForm('func_file');
		$this->hideFieldFromForm('show_func');
		$this->hideFieldFromForm('edit_func');
		$this->hideFieldFromForm('template');
		$this->hideFieldFromForm('dirname');
		$this->hideFieldFromForm('options');
		$this->hideFieldFromForm('bid');
		$this->hideFieldFromForm('mid');
		$this->hideFieldFromForm('func_num');
		$this->hideFieldFromForm('block_type');
		$this->hideFieldFromForm('isactive');
		
		$this->setControl('name', 'label');
		$this->setControl('visible', 'yesno');
		$this->setControl('bcachetime', array (
			'itemHandler' => 'blocksadmin',
			'method' => 'getBlockCacheTimeArray',
			'module' => 'system'
		));
		$this->setControl('side', array (
			'itemHandler' => 'blocksadmin',
			'method' => 'getBlockPositionArray',
			'module' => 'system'
		));
		$this->setControl('c_type', array (
			'itemHandler' => 'blocksadmin',
			'method' => 'getContentTypeArray',
			'module' => 'system'
		));
		
		$this->setControl('visiblein','page');
		
	}
	
	public function getVar($key, $format = 's') {
		if ($format == 's' && in_array($key, array ( 'visible', 'mid','side'))) {
			return call_user_func(array ($this,	$key));
		}
		return parent :: getVar($key, $format);
	}
	
	private function weight(){
		$rtn = $this->getVar('weight','n');
		return $rtn;
	}
	
	private function visible(){
		if($this->getVar('visible','n') == 1)
			$rtn = '<a href="'.ICMS_URL.'/modules/system/admin.php?fct=blocksadmin&op=visible&bid='.$this->getVar('bid').'" title="'._VISIBLE.'" ><img src="'.ICMS_URL.'/images/crystal/actions/button_ok.png" alt="'._VISIBLE.'"/></a>';
		else
			$rtn = '<a href="'.ICMS_URL.'/modules/system/admin.php?fct=blocksadmin&op=visible&bid='.$this->getVar('bid').'" title="'._VISIBLE.'" ><img src="'.ICMS_URL.'/images/crystal/actions/button_cancel.png" alt="'._VISIBLE.'"/></a>';
		return $rtn;
	}
	
	private function mid(){
		$rtn = $this->handler->getModuleName( $this->getVar('mid','n') );
		return $rtn;
	}
	
	private function side(){		
		$block_positions = $this->handler->getBlockPositions( true );
//		$form_object = new XoopsFormSelect( '', "side[".$this->getVar('bid','n')."]", $this->getVar('side','n'));
//		foreach ( array_keys( $block_positions ) as $j ) {
//			$form_object->addOption( $j, $block_positions[$j]);
//		}
//		$rtn = $form_object->render();
		$rtn = (defined($block_positions[$this->getVar('side','n')]['title'])) ? constant($block_positions[$this->getVar('side','n')]['title']) : $block_positions[$this->getVar('side','n')]['title'];
		return $rtn;
	}
	
	// Render Methods for Action Buttons
	
	public function getUpActionLink(){
		$rtn = '<a href="'.ICMS_URL.'/modules/system/admin.php?fct=blocksadmin&op=up&bid='.$this->getVar('bid').'" title="'._UP.'" ><img src="'.ICMS_URL.'/images/crystal/actions/up.png" alt="'._UP.'"/></a>';
		return $rtn;
	}
	
	public function getDownActionLink(){
		$rtn = '<a href="'.ICMS_URL.'/modules/system/admin.php?fct=blocksadmin&op=down&bid='.$this->getVar('bid').'" title="'._DOWN.'" ><img src="'.ICMS_URL.'/images/crystal/actions/down.png" alt="'._DOWN.'"/></a>';
		return $rtn;
	}
	
	public function getConfigureActionLink(){
		if($this->getVar('edit_func') == "")
			return "";
		$rtn = '<a href="'.ICMS_URL.'/modules/system/admin.php?fct=blocksadmin&op=config&bid='.$this->getVar('bid').'" title="'._CONFIGURE.'" ><img src="'.ICMS_URL.'/images/crystal/actions/configure.png" alt="'._CONFIGURE.'"/></a>';
		return $rtn;
	}
	
	public function getCloneActionLink(){
		$rtn = '<a href="'.ICMS_URL.'/modules/system/admin.php?fct=blocksadmin&op=clone&bid='.$this->getVar('bid').'" title="'._CLONE.'" ><img src="'.ICMS_URL.'/images/crystal/actions/editcopy.png" alt="'._CLONE.'"/></a>';
		return $rtn;
	}
	
	public function getEditActionLink(){
		$rtn = '<a href="'.ICMS_URL.'/modules/system/admin.php?fct=blocksadmin&op=mod&bid='.$this->getVar('bid').'" title="'._EDIT.'" ><img src="'.ICMS_URL.'/images/crystal/actions/edit.png" alt="'._EDIT.'"/></a>';
		return $rtn;
	}
	
    /**
     * getDeleteItemLink
     * 
     * Overwrited Method
     *
     * @param string $onlyUrl
     * @param boolean $withimage
     * @param boolean $userSide
     * @return string
     */
    public function getDeleteItemLink($onlyUrl=false, $withimage=true, $userSide=false){ 
	  	if($this->getVar('block_type') != 'C')
	  		return "";
    	$ret = ICMS_URL. "/modules/system/admin.php?fct=blocksadmin&op=del&" . $this->handler->keyName . "=" . $this->getVar($this->handler->keyName);
		if ($onlyUrl) {
			return $ret;
		}
		elseif($withimage) {
			return "<a href='" . $ret . "'><img src='" . ICMS_IMAGES_SET_URL . "/actions/editdelete.png' style='vertical-align: middle;' alt='" . _CO_ICMS_DELETE . "'  title='" . _CO_ICMS_DELETE . "'/></a>";
		}

    	return "<a href='" . $ret . "'>" . $this->getVar($this->handler->identifierName) . "</a>";
    }
    
	/**
     * Create the form for this object
     *
     * @return a {@link SmartobjectForm} object for this object
     *
     * @see IcmsPersistableObjectForm::IcmsPersistableObjectForm()
     */
    function getForm($form_caption, $form_name, $form_action=false, $submit_button_caption = _CO_ICMS_SUBMIT, $cancel_js_action=false, $captcha=false){
    	if(!$this->isNew())
    		$this->hideFieldFromForm('c_type');
    	if( !$this->isNew() && $this->getVar('block_type') != 'C' )
    		$this->hideFieldFromForm('content');
        include_once ICMS_ROOT_PATH . "/class/icmsform/icmsform.php";
        $form = new IcmsForm($this, $form_name, $form_caption, $form_action, null, $submit_button_caption, $cancel_js_action, $captcha);
        return $form;
    }
    
}

/**
 * System Block Configuration Object Handler Class
 * 
 * @since ImpressCMS 1.2
 * @author Gustavo Pilla (aka nekro) <nekro@impresscms.org>
 */
class SystemBlocksadminHandler extends IcmsBlockHandler {
	
	private $block_positions;
	private $modules_name;
	
	public function __construct(& $db) {
		$this->IcmsPersistableObjectHandler($db, 'blocksadmin', 'bid', 'title', 'content', 'system');
		$this->table = $this->db->prefix('newblocks');
	}
    
    public function getVisibleStatusArray(){
    	$rtn = array();
    	$rtn[1] = _VISIBLE;
    	$rtn[0] = _UNVISIBLE;
    	return $rtn;
    }
    
	public function getVisibleInArray(){
    	$rtn = array();
    	$rtn[1] = _VISIBLE;
    	$rtn[0] = _UNVISIBLE;
    	return $rtn;
    }
    
    public function getBlockPositionArray(){
    	$block_positions = $this->getBlockPositions(true);
    	$rtn = array();
    	foreach ($block_positions as $k=>$v){
  			$rtn[$k] = (defined($block_positions[$k]['title'])) ? constant($block_positions[$k]['title']) : $block_positions[$k]['title'];
    	}
    	return $rtn;
    }
    
    public function getContentTypeArray(){
    	return array('H' => _AM_HTML, 'P' => _AM_PHP, 'S' => _AM_AFWSMILE, 'T' => _AM_AFNOSMILE);
    }
    public function getBlockCacheTimeArray(){
    	$rtn = array('0' => _NOCACHE, '30' => sprintf(_SECONDS, 30), '60' => _MINUTE, '300' => sprintf(_MINUTES, 5), '1800' => sprintf(_MINUTES, 30), '3600' => _HOUR, '18000' => sprintf(_HOURS, 5), '86400' => _DAY, '259200' => sprintf(_DAYS, 3), '604800' => _WEEK, '2592000' => _MONTH);
    	return $rtn;
    }
    
	public function getModulesArray(){
    	if( !count($this->modules_name) ){
			$icms_module_handler = xoops_gethandler('module');
			$installed_modules =& $icms_module_handler->getObjects();
			foreach( $installed_modules as $module ){
				$this->modules_name[$module->getVar('mid')]['name'] = $module->getVar('name');
				$this->modules_name[$module->getVar('mid')]['dirname'] = $module->getVar('dirname');
			}	
		}
    	return $this->modules_name;
    }
    
    public function getModuleName($mid){
    	if($mid == 0)
    		return '';
    	$modules = $this->getModulesArray();	
		$rtn = $modules[$mid]['name'];
		return $rtn;	
    }

	public function getModuleDirname($mid){
    	$modules = $this->getModulesArray();	
		$rtn = $modules[$mid]['dirname'];
		return $rtn;	
    }
    
    public function upWeight( $bid ){
    	$blockObj = $this->get($bid);
    	$weight = $blockObj->getVar('weight','n') - 1;
  		$blockObj->setVar('weight', $weight);
  		$this->insert($blockObj, true);
    }
    
	public function downWeight( $bid ){
    	$blockObj = $this->get($bid);
    	$weight = $blockObj->getVar('weight' ,'n') + 1;
  		$blockObj->setVar('weight', $weight);  
  		$this->insert($blockObj, true);
    }	

	public function changeVisible( $bid ){
    	$blockObj = $this->get($bid);
    	if($blockObj->getVar('visible' ,'n'))
  			$blockObj->setVar('visible', 0);  
  		else
  			$blockObj->setVar('visible', 1);
  		$this->insert($blockObj, true);
    }
}
?>