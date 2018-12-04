<?php

class modNoty extends noticeDefaultController
{
    public function loadCssJs(array & $config)
    {
        
        $options = $this->modx->getOption('modalertify_noty_options', null, '{}');
        $options = json_decode($options, true);
        if (!is_array($options)){
            $options = [];
        }

        $theme = $this->modx->getOption('theme', $options, 'mint', true);

        $config = array_merge($config, [
            'options' => $options,
        ]);

        $this->modx->regClientCSS($this->config['cssUrl'] . 'web/lib/noty/noty.css');
        $this->modx->regClientCSS($this->config['cssUrl'] . 'web/lib/noty/themes/'.$theme.'.css');
        $this->modx->regClientScript($this->config['jsUrl'] . 'web/lib/noty/noty.min.js');
    }
}

return 'modNoty';
