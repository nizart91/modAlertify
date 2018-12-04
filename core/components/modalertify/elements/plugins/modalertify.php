<?php
switch($modx->event->name) {
    case 'OnWebPageInit':
		$type = $modx->getOption('modalertify_notice', null, false, true);
		if ($type){
			$modx->loadClass('modAlertify', $modx->getOption('core_path', null, MODX_CORE_PATH) .  'components/modalertify/model/modalertify/', true, true);
			$modAlertify = new modAlertify($modx);
			$modAlertify->loadNotice($type);
		}
        break;
}