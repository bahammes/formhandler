<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43('formhandler', 'pi1/class.tx_formhandler_pi1.php', '_pi1', 'CType', 0);

//Hook in tslib_content->stdWrap
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['tslib/class.tslib_content.php']['stdWrap']['formhandler'] = 'Typoheads\Formhandler\Hooks\StdWrapHook';

// load default PageTS config from static file
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:formhandler/Configuration/TypoScript/pageTsConfig.ts">');

if (!isset($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['TYPO3\\CMS\\Scheduler\\Task\\TableGarbageCollectionTask']['options']['tables']['tx_formhandler_log'])) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['TYPO3\\CMS\\Scheduler\\Task\\TableGarbageCollectionTask']['options']['tables']['tx_formhandler_log'] = [
        'dateField' => 'tstamp',
        'expirePeriod' => 180,
    ];
}

$GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1647442618] = [
    'nodeName' => 'formhandlerLogParams',
    'priority' => 40,
    'class' => \Typoheads\Formhandler\Form\Element\FormhandlerLogParamsElement::class,
];

if (!isset($GLOBALS['TYPO3_CONF_VARS']['LOG']['Typoheads']['Formhandler']['writerConfiguration'])) {
    $GLOBALS['TYPO3_CONF_VARS']['LOG']['Typoheads']['Formhandler']['writerConfiguration'] = [
        \TYPO3\CMS\Core\Log\LogLevel::ERROR => [
            \TYPO3\CMS\Core\Log\Writer\SyslogWriter::class => [],
        ],
    ];
}
