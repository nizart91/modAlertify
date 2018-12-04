<?php

abstract class noticeDefaultController
{
    /** @var modX $modx */
    public $modx;
    /** @var modAlertify $alertify */
    public $alertify;
    public $config;

    /**
     * @param modAlertify $alertify
     * @param array $config
     */
    public function __construct(modAlertify $alertify, array $config = array())
    {
        $this->modx = &$alertify->modx;
        $this->alertify = &$alertify;
        $this->config = $config;
    }

    public function process()
    {
        $minishop2 = $this->modx->getOption('modalertify_minishop2', null, false);
        $office = $this->modx->getOption('modalertify_office', null, false);
        $ajaxform = $this->modx->getOption('modalertify_minishop2', null, false);

        if (!($minishop2 || $office || $ajaxform)){
            return false;
        }

        $data = [
            'miniShop2' => (bool)$minishop2,
            'Office' => (bool)$office,
            'AjaxForm' => (bool)$ajaxform,
            'jsUrl' => $this->alertify->config['jsUrl'],
            'options' => [],
        ];

        $this->loadCssJs($data);

        /*
        $this->modx->regClientStartupScript(
            '<script type="text/javascript">modAlertifyConfig = ' . json_encode($data, true) . ';</script>', true
        );*/

        $js = $this->modx->getOption('modalertify_frontend_js');
        $js = trim(str_replace('[[+jsUrl]]', $this->config['jsUrl'], $js));
        if (!empty($js) && preg_match('/\.js/i', $js)) {
            if (preg_match('/\.js$/i', $js)) {
                $js .= '?v=' . substr(md5($this->alertify->version), 0, 11);
            }
            $this->modx->regClientScript($js);
            $this->modx->regClientScript(
                '<script type="text/javascript">
                    document.addEventListener("DOMContentLoaded", function(){
                        modAlertify.initialize("' . get_class($this) . '", ' . json_encode($data, true) . ');
                    });
                </script>', true
            );

        }
        return true;
    }


    public function loadCssJs(array & $config)
    {
        return true;
    }

}