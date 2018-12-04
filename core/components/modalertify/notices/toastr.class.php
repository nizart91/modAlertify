<?php

class modToastr extends noticeDefaultController
{
    public function loadCssJs(array & $config)
    {
        
        $options = $this->modx->getOption('modalertify_toastr_options', null, '{}');
        $options = json_decode($options, true);
        if (!is_array($options)){
            $options = [];
        }

        $config = array_merge($config, [
            'options' => $options,
        ]);

        $this->modx->regClientCSS($this->config['cssUrl'] . 'web/lib/toastr/toastr.min.css');
        $this->modx->regClientScript($this->config['jsUrl'] . 'web/lib/toastr/toastr.min.js');
    }
}

return 'modToastr';
