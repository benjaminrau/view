<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['view']['setup'] = unserialize($_EXTCONF);

$script = t3lib_div::getIndpEnv('SCRIPT_FILENAME');
$version = TYPO3_version;
if ('sysext/install/Start/Install.php' !== substr($script, -32)) {
	if ($version{0} >= 6) {
		if (TRUE === (boolean) $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['view']['setup']['overlays'] || FALSE === isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['view']['setup']['overlays'])) {
			$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['Tx_Fluid_View_TemplateView'] =
				array('className' => 'Tx_View_Override_View_ExtendedTemplateView');
			$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Fluid\\View\\TemplateView'] =
				array('className' => 'FluidTYPO3\\View\\Override\\View\\ExtendedTemplateView');
		}
		if (TRUE === (boolean) $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['view']['setup']['viewhelperarguments']  || FALSE === isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['view']['setup']['viewhelperarguments'])) {
			$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['Tx_Fluid_Core_Parser_SyntaxTree_ViewHelperNode'] =
				array('className' => 'Tx_View_Override_Parser_SyntaxTree_ExtendedViewHelperNode');
			$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Fluid\\Core\\Parser\\SyntaxTree\\ViewHelperNode'] =
				array('className' => 'FluidTYPO3\\View\\Override\\Parser\\SyntaxTree\\ExtendedViewHelperNode');
		}
	} else {
		if (TRUE === (boolean) $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['view']['setup']['overlays']  || FALSE === isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['view']['setup']['overlays'])) {
			class_alias('Tx_View_Override_View_ExtendedTemplateView', 'ux_Tx_Fluid_View_TemplateView');
		}
		if (TRUE === (boolean) $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['view']['setup']['viewhelperarguments']  || FALSE === isset($GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['view']['setup']['viewhelperarguments'])) {
			class_alias('Tx_View_Override_Parser_SyntaxTree_ExtendedViewHelperNode', 'ux_Tx_Fluid_Core_Parser_SyntaxTree_ViewHelperNode');
		}
	}
}
unset($version, $script);
