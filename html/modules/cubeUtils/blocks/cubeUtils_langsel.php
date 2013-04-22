<?php
/**
 *
 * @package CubeUtils
 * @version $Id: xoops_version.php 1294 2008-01-31 05:32:20Z nobunobu $
 * @copyright Copyright 2006-2008 NobuNobuXOOPS Project <http://sourceforge.net/projects/nobunobuxoops/>
 * @author NobuNobu <nobunobu@nobunobu.com>
 * @license http://www.gnu.org/licenses/gpl.txt GNU GENERAL PUBLIC LICENSE Version 2
 *
 */
include_once(XOOPS_ROOT_PATH.'/class/xoopslists.php');
if (file_exists(XOOPS_ROOT_PATH.'/modules/cubeUtils/include/conf_ml.php')) {
    require_once XOOPS_ROOT_PATH.'/modules/cubeUtils/include/conf_ml.php';
} else {
    require_once XOOPS_ROOT_PATH.'/modules/cubeUtils/include/conf_ml.dist.php';
}
function b_cubeUtils_langsel_show($options) {
    if (empty($_SERVER['QUERY_STRING'])) {
        $pagenquery = $_SERVER['PHP_SELF'].'?'.CUBE_UTILS_ML_PARAM_NAME.'=';
    } elseif (isset($_SERVER['QUERY_STRING'])) {

        $query = explode("&",$_SERVER['QUERY_STRING']);
        $langquery = $_SERVER['QUERY_STRING'];

        // If the last parameter of the QUERY_STRING is sel_lang, delete it so we don't have repeating sel_lang=...
        If (strpos($query[count($query) - 1], CUBE_UTILS_ML_PARAM_NAME.'=')  === 0 ) {
            $langquery = str_replace('&' . $query[count($query) - 1], '', $langquery);
        }

        $pagenquery = $_SERVER['PHP_SELF'].'?'.$langquery.'&'.CUBE_UTILS_ML_PARAM_NAME.'=';
        $pagenquery = str_replace('?&','?',$pagenquery);
    }
    //show a drop down list to select language
	$block['pagenquery'] = $pagenquery;
    $block['select_name'] = CUBE_UTILS_ML_PARAM_NAME;
    $langnames = explode(',',CUBE_UTILS_ML_LANGDESCS);
    $langs = explode(',',CUBE_UTILS_ML_LANGS);
	$block['select_langs'] = array();
    for ($i=0; $i < count($langs); $i++) {
	    $block['select_langs'][] = array(
		    'value' => $langs[$i],
		    'name' => $langnames[$i],
		    'selected' => $langs[$i] == _LANGCODE ? true : false,
	    );
    }
    return $block;
}

