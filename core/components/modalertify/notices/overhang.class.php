<?php

class modOverhang extends noticeDefaultController
{
    public function loadCssJs(array & $config)
    {
        
        $options = $this->modx->getOption('modalertify_overhang_options', null, '{}');
        $options = json_decode($options, true);
        if (!is_array($options)){
            $options = [];
        }

        $config = array_merge($config, [
            'options' => $options,
        ]);

        $this->modx->regClientCSS($this->config['cssUrl'] . 'web/lib/overhang/overhang.min.css');
        $this->modx->regClientScript($this->config['jsUrl'] . 'web/lib/overhang/overhang.min.js');
    }
}

return 'modOverhang';
