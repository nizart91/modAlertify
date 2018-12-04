<?php

class modAlertify
{
	public $version = '1.0.4';
    /** @var modX $modx */
    public $modx;

    public $config = [];


    /**
     * @param modX $modx
     * @param array $config
     */
    function __construct(modX &$modx, array $config = array())
    {
        $this->modx =& $modx;

        $corePath = $this->modx->getOption('modalertify_core_path', $config,
            $this->modx->getOption('core_path') . 'components/modalertify/'
        );
        $assetsUrl = $this->modx->getOption('modalertify_assets_url', $config,
            $this->modx->getOption('assets_url') . 'components/modalertify/'
        );
        $assetsPath = MODX_ASSETS_PATH;

        $this->config = array_merge(array(
            'cssUrl' => $assetsUrl . 'css/',
            'jsUrl' => $assetsUrl . 'js/',

            'noticesPath' => $corePath . 'notices/',

            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
        ), $config);

        $this->modx->addPackage('modalertify', $this->config['modelPath']);
    }

    public function loadNotice($name)
    {
        if (!class_exists('noticeDefaultController')) {
            require 'notice.class.php';
        }

        $file = $this->config['noticesPath'] . $name . '.class.php';

        if (file_exists($file)) {
            /** @noinspection PhpIncludeInspection */
            $class = include_once($file);
            if (!class_exists($class)) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, "[modAlertify] Wrong controller at \"{$file}\"");
            } else {
                /** @var noticeDefaultController $controller */
                $controller = new $class($this, $this->config);
                if ($controller instanceof noticeDefaultController) {
                	return $controller->process();
                } else {
                    $this->modx->log(modX::LOG_LEVEL_ERROR,
                        "[modAlertify] Controller \"{$class}\" in \"{$file}\" must be an instance of noticeDefaultController"
                    );
                }
            }
        } else {
            $this->modx->log(modX::LOG_LEVEL_ERROR, "[modAlertify] Could not find controller at \"{$file}\"");
        }

        return false;
    }
}