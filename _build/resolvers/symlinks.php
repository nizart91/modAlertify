<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    $dev = MODX_BASE_PATH . 'Extras/modAlertify/';
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($dev) && $cache) {
        if (!is_link($dev . 'assets/components/modalertify')) {
            $cache->deleteTree(
                $dev . 'assets/components/modalertify/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_ASSETS_PATH . 'components/modalertify/', $dev . 'assets/components/modalertify');
        }
        if (!is_link($dev . 'core/components/modalertify')) {
            $cache->deleteTree(
                $dev . 'core/components/modalertify/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_CORE_PATH . 'components/modalertify/', $dev . 'core/components/modalertify');
        }
    }
}

return true;