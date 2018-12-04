<?php

class modBootstrapNotify extends noticeDefaultController
{
    public function loadCssJs(array & $config)
    {
        $options = $this->modx->getOption('modalertify_bnotify_options', null, '{}');
        $options = json_decode($options, true);
        if (!is_array($options)){
            $options = [];
        }

        $config = array_merge($config, [
            'options' => $options,
        ]);

        //$this->modx->regClientCSS($this->config['cssUrl'] . 'web/lib/overhang/overhang.min.css');
        $this->modx->regClientScript($this->config['jsUrl'] . 'web/lib/bootstrapnotify/bootstrap-notify.min.js');
    }
}

return 'modBootstrapNotify';
