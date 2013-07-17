<?php
/**
 * icms_view_theme_Object component class file
 *
 * @license      http://www.fsf.org/copyleft/gpl.html GNU public license
 * @author       Skalpa Keo <skalpa@xoops.org>
 * @version		$Id: Object.php 11719 2012-05-22 00:40:10Z skenow $
 * @category	ICMS
 * @package		View
 * @subpackage 	Theme
 */

/**
 *
 * Builds the theme components
 * @category	ICMS
 * @package		View
 * @subpackage	Theme
 *
 */
class icms_view_theme_Object {
	/**
	 * The name of this theme
	 * @public string
	 */
	public $folderName = '';
	/**
	 * Physical path of this theme folder
	 * @public string
	 */
	public $path = '';
	public $url = '';

	/**
	 * Whether or not the theme engine should include the output generated by php
	 * @public string
	 */
	public $bufferOutput = TRUE;
	/**
	 * Canvas-level template to use
	 * @public string
	 */
	public $canvasTemplate = 'theme.html';
	/**
	 * Content-level template to use
	 * @public string
	 */
	public $contentTemplate = '';

	public $contentCacheLifetime = 0;
	public $contentCacheId = NULL;

	/**
	 * Text content to display right after the contentTemplate output
	 * @public string
	 */
	public $content = '';
	/**
	 * Page construction plug-ins to use
	 * @public array
	 */
	public $plugins = array('icms_view_PageBuilder');

	public $renderCount = 0;
	/**
	 * Pointer to the theme template engine
	 * @public icms_view_Tpl
	 */
	public $template = FALSE;

	/**
	 * Array containing the document meta-information
	 */
	public $metas = array(
		'head' => array(),
		'module' => array(),
		'foot' => array(),
	);
	/**
	 * Array of meta types - their order in the array determines their rendering sequence
	 */
	public $types = array('http', 'meta', 'link', 'stylesheet', 'script');

	/**
	 * Array of strings to be inserted in the head tag of HTML documents
	 * @public array
	 */
	public $htmlHeadStrings = array();
	/**
	 * Custom publiciables that will always be assigned to the template
	 * @public array
	 */
	public $templateVars = array();

	/**
	 * User extra information for cache id, like language, user groups
	 *
	 * @public boolean
	 */
	public $use_extra_cache_id = TRUE;

	/**#@-*/

	/**#@+ @tasktype 10 Initialization*/
	/**
	 * Initializes this theme
	 *
	 * Upon initialization, the theme creates its template engine and instanciates the
	 * plug-ins from the specified {@link $plugins} list. If the theme is a 2.0 theme, that does not
	 * display redirection messages, the HTTP redirections system is disabled to ensure users will
	 * see the redirection screen.
	 *
	 * @param array $options
	 * @return bool
	 */
	public function xoInit($options = array()) {
		global $xoops;

		$this->path = (is_dir(ICMS_MODULES_PATH . '/system/themes/' . $this->folderName))
			? ICMS_MODULES_PATH . '/system/themes/' . $this->folderName
			: ICMS_THEME_PATH . '/' . $this->folderName;
		$this->url = (is_dir(ICMS_MODULES_PATH . '/system/themes/' . $this->folderName))
			? ICMS_MODULES_URL . '/system/themes/' . $this->folderName
			: ICMS_THEME_URL . '/' . $this->folderName;

		$this->template = new icms_view_Tpl();
		$this->template->currentTheme =& $this;
		$this->template->assign_by_ref('xoTheme', $this);

		global $icmsConfig, $icmsConfigMetaFooter, $icmsModule, $xoopsModule, $icmsConfigMultilang;
		$this->template->assign(
			array(
				'ml_is_enabled' => $icmsConfigMultilang['ml_enable'],
				'icms_secure_url' => preg_replace('/http:/','https:',ICMS_URL),
				'icms_style' => ICMS_URL . '/icms' . ((defined('_ADM_USE_RTL') && _ADM_USE_RTL) ? '_rtl' : '') . '.css',
				'icms_theme' => $this->folderName,
				'icms_imageurl' => (is_dir(ICMS_MODULES_PATH . '/system/themes/' . $this->folderName . '/'))
					? ICMS_MODULES_URL . '/system/themes/' . $this->folderName . '/'
					: ICMS_THEME_URL . '/' . $this->folderName . '/',
				'icms_themecss'=> xoops_getcss($this->folderName),
				'icms_requesturi' => htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES),
				'icms_sitename' => htmlspecialchars($icmsConfig['sitename'], ENT_QUOTES),
				'icms_slogan' => htmlspecialchars($icmsConfig['slogan'], ENT_QUOTES),
				'icms_dirname' => @$icmsModule ? $icmsModule->getVar('dirname') : 'system',
				'icms_pagetitle' => isset($icmsModule) && is_object($icmsModule)
						? $icmsModule->getVar('name')
						: htmlspecialchars($icmsConfig['slogan'], ENT_QUOTES)
			)
		);

		// this is for backward compatibility only!
		$this->template->assign(array(
			'xoops_theme' => $this->template->get_template_vars('icms_theme'),
			'xoops_imageurl' => $this->template->get_template_vars('icms_imageurl'),
			'xoops_themecss' => $this->template->get_template_vars('icms_themecss'),
			'xoops_requesturi' => $this->template->get_template_vars('icms_requesturi'),
			'xoops_sitename' => $this->template->get_template_vars('icms_sitename'),
			'xoops_slogan' => $this->template->get_template_vars('icms_slogan'),
			'xoops_dirname' => $this->template->get_template_vars('icms_dirname'),
			'xoops_pagetitle' => $this->template->get_template_vars('icms_pagetitle')
		));
		if (isset(icms::$user) && is_object(icms::$user)) {
			$this->template->assign(array(
	        	'icms_isuser' => TRUE,
	        	'icms_userid' => icms::$user->getVar('uid'),
	        	'icms_uname' => icms::$user->getVar('uname'),
	        	'icms_isadmin' => icms::$user->isAdmin(),
	        	'xoops_isuser' => TRUE,
	        	'xoops_userid' => icms::$user->getVar('uid'),
	        	'xoops_uname' => icms::$user->getVar('uname'),
	        	'xoops_isadmin' => icms::$user->isAdmin(),
				)
			);
		} else {
			$this->template->assign(
				array('icms_isuser' => FALSE,
					'icms_isadmin' => FALSE,
					'xoops_isuser' => FALSE,
					'xoops_isadmin' => FALSE
				)
			);
		}
		// Meta tags
		foreach ($icmsConfigMetaFooter as $name => $value) {
			if (substr($name, 0, 5) == 'meta_') {
				$this->addMeta('meta', substr($name, 5), $value);
			} elseif (substr($name, 0, 6) == 'footer') {
				$values = $value;
							if ($icmsConfigMetaFooter['use_google_analytics'] == TRUE && isset($icmsConfigMetaFooter['google_analytics']) && $icmsConfigMetaFooter['google_analytics'] != '') {
					$values = $value . '<script type="text/javascript">
                      var _gaq = _gaq || [];  _gaq.push(["_setAccount", "UA-' . $icmsConfigMetaFooter['google_analytics'] . '"]);  _gaq.push(["_trackPageview"]);
                      (function() {var ga = document.createElement("script"); ga.type = "text/javascript"; ga.async = true;
                      ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";
                      var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ga, s);})();
                    </script>';
				}
				$this->template->assign("xoops_$name", $values);
				$this->template->assign("icms_$name", $values);
			} else {
				// prefix each tag with 'xoops_'
				$this->template->assign("xoops_$name", $value);
				$this->template->assign("icms_$name", $value);
			}
		}

		if ($this->bufferOutput) {
			ob_start();
		}
		$GLOBALS['xoTheme'] =& $this;
		$GLOBALS['xoopsTpl'] =& $this->template;
		// Instanciate and initialize all the theme plugins
		foreach ($this->plugins as $k => $bundleId) {
			if (!is_object($bundleId)) {
				$this->plugins[$bundleId] = new $bundleId();
				$this->plugins[$bundleId]->theme =& $this;
				$this->plugins[$bundleId]->xoInit();
				unset($this->plugins[$k]);
			}
		}
		return TRUE;
	}
	/**#@-*/

	/**
	 * Generate cache id based on extra information of language and user groups
	 *
	 * User groups other than anonymous should be detected to avoid disclosing group sensitive contents
	 *
	 * @param string	$cache_id		raw cache id
	 * @param string	$extraString	extra string
	 *
	 * @return string	complete cache id
	 */
	public function generateCacheId($cache_id, $extraString = '') {
		static $extra_string;

		if (!$this->use_extra_cache_id) {
			return $cache_id;
		}

		if (empty($extraString)) {
			if (empty($extra_string)) {
				global $icmsConfig;

				// Generate language section
				$extra_string = $icmsConfig['language'];

				// Generate group section
				if (!@is_object(icms::$user)) {
					$extra_string .= '|' . ICMS_GROUP_ANONYMOUS;
				} else {
					$groups = icms::$user->getGroups();
					sort($groups);
					// Generate group string for non-anonymous groups,
					// XOOPS_DB_PASS and XOOPS_DB_NAME (before we find better variables) are used to protect group sensitive contents
					$extra_string .= '|' . implode(",", $groups)
						. substr(md5(XOOPS_DB_PASS . XOOPS_DB_NAME), 0, strlen(XOOPS_DB_USER) * 2);
				}
			}
			$extraString = $extra_string;
		}
		$cache_id .= '|' . $extraString;

		return $cache_id;
	}

	/**
	 * Checks cache for a changed version of the template and renders template
	 * @return  bool
	 */
	public function checkCache() {
		global $xoopsModule, $icmsModule;

		if ($_SERVER['REQUEST_METHOD'] != 'POST' && $this->contentCacheLifetime) {
			$template = $this->contentTemplate ? $this->contentTemplate : 'db:system_dummy.html';
			$dirname = $icmsModule->getVar('dirname', 'n');

			$this->template->caching = 2;
			$this->template->cache_lifetime = $this->contentCacheLifetime;
			$uri = str_replace(ICMS_URL, '', $_SERVER['REQUEST_URI']);
			// Clean uri by removing session id
			if (defined('SID') && SID && strpos($uri, SID)) {
				$uri = preg_replace("/([\?&])(" . SID . "$|" . SID . "&)/", "\\1", $uri);
			}
			$this->contentCacheId = $this->generateCacheId($dirname . '|' . $uri);

			if ($this->template->is_cached($template, $this->contentCacheId)) {
				icms::$logger->addExtra($template, sprintf(_REGENERATES, $this->contentCacheLifetime));
				$this->render(NULL, NULL, $template);
				return TRUE;
			}
		}
		return FALSE;
	}

	/**
	 * Render the page
	 *
	 * The theme engine builds pages from 2 templates: canvas and content.
	 *
	 * A module can call this method directly and specify what templates the theme engine must use.
	 * If render() hasn't been called before, the theme defaults will be used for the canvas and
	 * page template (and xoopsOption['template_main'] for the content).
	 *
	 * @param string $canvasTpl		The canvas template, if different from the theme default
	 * @param string $pageTpl		The page template, if different from the theme default (unsupported, 2.3+ only)
	 * @param string $contentTpl	The content template
	 * @param array	 $vars			Template variables to send to the template engine
	 */
	public function render($canvasTpl = NULL, $pageTpl = NULL, $contentTpl = NULL, $vars = array()) {
		global $xoops, $xoopsOption;

		if ($this->renderCount) {
			return FALSE;
		}
		icms::$logger->startTime('Page rendering');

		// @internal: Lame fix to ensure the metas specified in the xoops config page don't appear twice
		$old = array('robots', 'keywords', 'description', 'rating', 'author', 'copyright');
		foreach ($this->metas['module']['meta'] as $name => $value) {
			if (in_array($name, $old)) {
				$this->template->assign("xoops_meta_$name", htmlspecialchars($value['value'], ENT_QUOTES));
				$this->template->assign("icms_meta_$name", htmlspecialchars($value['value'], ENT_QUOTES));
				unset($this->metas['module']['meta'][$name]);
			}
		}

		if ($canvasTpl)	$this->canvasTemplate	= $canvasTpl;
		if ($contentTpl) $this->contentTemplate	= $contentTpl;

		if (!empty($vars)) {
			$this->template->assign($vars);
		}
		if ($this->contentTemplate) {
			$this->content = $this->template->fetch($this->contentTemplate, $this->contentCacheId);
		}
		if ($this->bufferOutput) {
			$this->content .= ob_get_contents();
			ob_end_clean();
		}
		$this->template->assign_by_ref('xoops_contents', $this->content);
		$this->template->assign_by_ref('icms_contents', $this->content);

		$header = empty($xoopsOption['icms_module_header'])
			? $this->template->get_template_vars('icms_module_header')
			: $xoopsOption['icms_module_header'];
		/** @todo	Remove xoops_module_header in 2.0 */
		$xheader = empty($xoopsOption['xoops_module_header'])
			? $this->template->get_template_vars('xoops_module_header')
			: $xoopsOption['xoops_module_header'];
		if ($xheader != "") icms_core_Debug::setDeprecated('icms_module_header', sprintf(_CORE_REMOVE_IN_VERSION, "2.0"));
		$header = ($header != "") ? $header : $xheader;
		$this->template->assign('xoops_module_header', $header . "\n" . $this->renderOldMetas(NULL, TRUE));
		$this->template->assign('icms_module_header', $header . "\n" . $this->renderOldMetas(NULL, TRUE));

		/* create template vars for the new meta zones */
		foreach ($this->metas as $zone => $value) {
			$this->template->assign($zone, "<!-- " . ucfirst($zone) . " section-->\n" . $this->renderMetas(NULL, TRUE, $zone));
		}

		$pagetitle = empty($xoopsOption['icms_pagetitle'])
			? $this->template->get_template_vars('icms_pagetitle')
			: $xoopsOption['icms_pagetitle'];
		/** @todo	Remove xoops_pagetitle in 2.0 */
		$xpagetitle = empty($xoopsOption['xoops_pagetitle'])
			? $this->template->get_template_vars('xoops_pagetitle')
			: $xoopsOption['xoops_pagetitle'];
		if ($xpagetitle != "") icms_core_Debug::setDeprecated('icms_pagetitle', sprintf(_CORE_REMOVE_IN_VERSION, "2.0"));
		$pagetitle = ($pagetitle != "") ? $pagetitle : $xpagetitle;
		$this->template->assign('xoops_pagetitle', $pagetitle);
		$this->template->assign('icms_pagetitle', $pagetitle);

		// Do not cache the main (theme.html) template output
		$this->template->caching = 0;
		$this->template->display($this->path . '/' . $this->canvasTemplate);

		$this->renderCount++;
		icms::$logger->stopTime('Page rendering');
	}

	/**#@+ @tasktype 20 Manipulating page meta-information*/
	/**
	 * Adds script code to the document head
	 *
	 * This methods allows the insertion of an external script file (if $src is provided), or
	 * of a script snippet. The file URI is parsed to take benefit of the theme resource
	 * overloading system.
	 *
	 * The $attributes parameter allows you to specify the attributes that will be added to the
	 * inserted <script> tag. If unspecified, the <var>type</var> attribute value will default to
	 * 'text/javascript'.
	 *
	 * <code>
	 * // Add an external script using a physical path
	 * $theme->addScript('www/script.js', NULL, '');
	 * $theme->addScript('modules/newbb/script.js', NULL, '');
	 * // Specify attributes for the <script> tag
	 * $theme->addScript('mod_xoops_SiteManager#common.js', array('type' => 'application/x-javascript'), '');
	 * // Insert a code snippet
	 * $theme->addScript(NULL, array('type' => 'application/x-javascript'), 'window.open("Hello world");');
	 * </code>
	 *
	 * @param string $src path to an external script file
	 * @param array $attributes hash of attributes to add to the <script> tag
	 * @param string $content Code snippet to output within the <script> tag
	 * @param	str	$zone	Area of the HTML page to place the script
	 * @param 	int	$weight	Sort factor - lower weights are loaded first
	 *
	 * @return void
	 **/
	public function addScript($src = '', $attributes = array(), $content = '', $zone = 'module', $weight = 0) {
		global $xoops;
		if (empty($attributes))	{
			$attributes = array();
		}
		if (!empty($src)) {
			$attributes['src'] = $xoops->url($this->resourcePath($src));
		}
		if (!empty($content)) {
			$attributes['_'] = $content;
		}
		if (!isset($attributes['type'])) {
			$attributes['type'] = 'text/javascript';
		}
		$this->addMeta('script', $src, $attributes, $zone, $weight);
	}

	/**
	 * Add StyleSheet or CSS code to the document head
	 * @param string $src path to .css file
	 * @param array $attributes name => value paired array of attributes such as title
	 * @param string $content CSS code to output between the <style> tags (in case $src is empty)
	 * @param	str	$zone	Area of the HTML page to place the stylesheet
	 * @param 	int	$weight	Sort factor - lower weights are loaded first
	 *
	 * @return void
	 **/
	public function addStylesheet($src = '', $attributes = array(), $content = '', $zone = 'module', $weight = 0) {
		global $xoops;
		if (empty($attributes)) {
			$attributes = array();
		}
		if (!empty($src)) {
			$attributes['href'] = $xoops->url($this->resourcePath($src));
		}
		if (!isset($attributes['type'])) {
			$attributes['type'] = 'text/css';
		}
		if (!empty($content)) {
			$attributes['_'] = $content;
		}
		$this->addMeta('stylesheet', $src, $attributes, $zone, $weight);
	}

	/**
	 * Add a <link> to the header
	 * @param string	$rel		Relationship from the current doc to the anchored one
	 * @param string	$href		URI of the anchored document
	 * @param array		$attributes	Additional attributes to add to the <link> element
	 * @param	str	$zone	Area of the HTML page to place the link
	 * @param 	int	$weight	Sort factor - lower weights are loaded first
	 */
	public function addLink($rel, $href = '', $attributes = array(), $zone = 'module', $weight = 0) {
		global $xoops;

		if (empty($attributes)) {
			$attributes = array();
		}
		if (!empty($href)) {
			$attributes['href'] = $href;
		}
		$this->addMeta('link', $rel, $attributes, $zone, $weight);
	}

	/**
	 * Set a meta http-equiv value
	 * @param	str	$zone	Area of the HTML page to place the http meta
	 * @param 	int	$weight	Sort factor - lower weights are loaded first
	 */
	public function addHttpMeta($name, $value = NULL, $zone = 'module', $weight = 0) {
		if (isset($value)) {
			return $this->addMeta('http', $name, $value, $zone, $weight);
		}
		unset($this->metas[$zone]['http'][$name]);
	}

	/**
	 * Change output page meta-information
	 *
	 * @param	str	$type	Type of meta tag: script, link, stylesheet, http
	 * @param	str	$name	Name
	 * @param	str	$value
	 * @param	str	$zone	Area of the HTML page to place the meta
	 * @param 	int	$weight	Sort factor - lower weights are loaded first
	 */
	function addMeta($type = 'meta', $name = '', $value = '', $zone = 'module', $weight = 0) {
		!empty($zone) || $zone = 'module';
		if (!isset($this->metas[$zone][$type])) {
			$this->metas[$zone][$type] = array();
		}
		if (!empty($name)) {
			$this->metas[$zone][$type][$name] = array('value' => $value, 'weight' => $weight);
		} else {
			$this->metas[$zone][$type][] = array('value' => $value, 'weight' => $weight);
		}

		return $value;
	}

	/**
	 * Puts $content into the htmlheadstrings array
	 *
	 * @param   string  $params
	 * @param   string  $content    content to put in the htmlheadstrings array
	 * @param   string  &$smarty
	 * @param   string  &$repeat
	 */
	public function headContent($params, $content, &$smarty, &$repeat) {
		if (!$repeat) {
			$this->htmlHeadStrings[] = $content;
		}
	}

	/**
	 * Render the meta content in the metas array (carefull Recursive!)
	 *
	 * @param   string  $type     what type of metacontent is it
	 * @param   string  $return   will we return to the calling function (just default setting)
	 * @return  bool
	 */
	public function renderMetas($type = NULL, $return = FALSE, $zone = 'module') {
		$str = '';
		if (!isset($type)) {
			if (!is_array($this->metas[$zone])) return;
			$types = $this->types;
			$usedTypes = array_keys($this->metas[$zone]);
			foreach (array_intersect($types, $usedTypes) as $type) {
				$str .= $this->renderMetas($type, TRUE, $zone);
			}
			$str .= implode("\n", $this->htmlHeadStrings);
		} else {
			$sort = array();
			$types = array('http', 'meta', 'link', 'stylesheet', 'script');
			foreach($this->metas[$zone][$type] as $name => $item) {
				$sort[] = $item['weight'];
			}
			array_multisort(array_values($sort), array_keys($sort), $this->metas[$zone][$type]);
			switch($type) {
				case 'script':
					/* new js refactoring will change how we do this */
					foreach ($this->metas[$zone][$type] as $attrs) {
						$str .= '<script' . $this->renderAttributes($attrs['value']) . ">";
						if (@$attrs['value']['_']) {
							$str .= "\n" . $attrs['value']['_'] . "\n";
						}
						$str .= "</script>\n";
					}
					break;

				case 'link':
					foreach ($this->metas[$zone][$type] as $rel => $attrs) {
						$str .= '<link rel="' . $rel . '"' . $this->renderAttributes($attrs['value']) . " />\n";
					}
					break;

				case 'stylesheet':
					/* @todo use a preference option to determine whether to combine the files, or not, and 1 for compressing the file */
					$combine = TRUE;
					if ($combine) {
						/* all local files will be a path, all remote files will have scheme:// */
						$filepath = array_flip(str_replace(ICMS_URL, "", array_keys($this->metas[$zone][$type])));
						/* combineFiles($filearray, $filetype, $minimize, $replace, $maxage, $location) */
						$filesrc = icms_core_Filesystem::combineFiles($filepath, "css", TRUE);
						/* only render a link if the result is not FALSE */
						if ($filepath !== FALSE) {
							$str .= '<link href="' . str_replace(ICMS_ROOT_PATH, ICMS_URL, $filesrc) . '" rel="stylesheet" type="text/css">';
						}
					}

					foreach ($this->metas[$zone][$type] as $attrs) {
						if (@$attrs['value']['_']) {
							$str .= '<style' . $this->renderAttributes($attrs['value']) . ">\n" . $attrs['value']['_'] . "\n</style>";
						} elseif (!$combine) {
							$str .= '<link rel="stylesheet"' . $this->renderAttributes($attrs['value']) . " />\n";
						}
					}
					break;

				case 'http':
					foreach ($this->metas[$zone][$type] as $name => $content) {
						$str .= '<meta http-equiv="' . htmlspecialchars($name, ENT_QUOTES) . '" content="' . htmlspecialchars($content, ENT_QUOTES) . "\" />\n";
					}
					break;

				default:
					foreach ($this->metas[$zone][$type] as $name => $content) {
						$str .= '<meta name="' . htmlspecialchars($name, ENT_QUOTES) . '" content="' . htmlspecialchars($content['value'], ENT_QUOTES) . "\" />\n";
					}
					break;
			}
		}
		if ($return) {
			return $str;
		}
		echo $str;
		return TRUE;
	}
	/**
	 * Legacy method to render all the zones as a single zone
	 *
	 * @param	str		$type
	 * @param	bool	$return
	 * @return	str		string of the old metas
	 */
	public function renderOldMetas($type = NULL, $return = TRUE) {
		$str = '';
		// loop through and render all the zones
		foreach ($this->metas as $z => $values) {
			$str .= $this->renderMetas($type, TRUE, $z);
		}
		return $str;
	}

	/**
	 * Generates a unique element ID
	 * @param string $tagName
	 * @return string
	 */
	public function genElementId($tagName = 'xos') {
		static $cache = array();
		if (!isset($cache[$tagName])) {
			$cache[$tagName] = 1;
		}
		return $tagName . '-' . $cache[$tagName]++;
	}

	/**
	 * Transform an attributes collection to an XML string
	 * @param array $coll
	 * @return string
	 */
	public function renderAttributes($coll) {
		$str = '';
		foreach ($coll as $name => $val) {
			if ($name != '_') {
				$str .= ' ' . $name . '="' . htmlspecialchars($val, ENT_QUOTES) . '"';
			}
		}
		return $str;
	}

	/**
	 * Return a themable file resource path
	 *
	 * @param string $path
	 * @return string
	 */
	public function resourcePath($path) {
		global $xoops;
		if (substr($path, 0, 1) == '/') {
			$path = substr($path, 1);
		}
		if (file_exists("$this->path/$path")) {
			return "themes/$this->folderName/$path";
		}
		return $path;
	}
}
