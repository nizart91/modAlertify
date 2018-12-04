<?php

class modAlertifyJS extends noticeDefaultController
{
    public function loadCssJs(array & $config)
    {
        $options = $this->modx->getOption('modalertify_options', null, '{}');
        $options = json_decode($options, true);
        if (!is_array($options)){
            $options = [];
        }

        $config = array_merge($config, [
            'options' => $options,
        ]);

        $this->modx->regClientCSS($this->config['cssUrl'] . 'web/lib/alertify/alertify.min.css');
        $theme = $this->modx->getOption('modalertify_theme', null, 'default', true);
        $this->modx->regClientCSS($this->config['cssUrl'] . 'web/lib/alertify/themes/'.$theme.'.css');
        $this->modx->regClientScript($this->config['jsUrl'] . 'web/lib/alertify/alertify.min.js');
    }
}

return 'modAlertifyJS';
