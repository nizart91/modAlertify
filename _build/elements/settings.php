<?php

return [
	'minishop2' => [
        'xtype' => 'combo-boolean',
        'value' => true,
        'area' => 'modalertify_main',
		'name'	=> 'setting_modalertify_minishop2',
    ],
	'office' => [
        'xtype' => 'combo-boolean',
        'value' => true,
        'area' => 'modalertify_main',
		'name'	=> 'setting_modalertify_office',
    ],
	'ajaxform' => [
        'xtype' => 'combo-boolean',
        'value' => true,
        'area' => 'modalertify_main',
		'name'	=> 'setting_modalertify_ajaxform',
    ],
    'frontend_js' => [
        'xtype' => 'textfield',
        'value' => '[[+jsUrl]]web/default.js',
        'area' => 'modalertify_main',
        'name'  => 'setting_modalertify_frontend_js',
    ],
	'notice' => [
        'xtype' => 'textfield',
        'value' => 'alertifyjs',
        'area' => 'modalertify_main',
		'name'	=> 'setting_modalertify_notice',
        'description'=> 'setting_modalertify_notice_desc',
    ],
    //alertifyjs
    'options' => [
        'xtype' => 'textfield',
        'value' => json_encode(['delay' => 3, 'position' => 'top-right']),
        'area' => 'modalertify_alertifyjs',
        'name'  => 'setting_modalertify_options',
    ],
    'theme' => [
        'xtype' => 'textfield',
        'value' => 'default',
        'area' => 'modalertify_alertifyjs',
        'name'  => 'setting_modalertify_theme',
        'description'=> 'setting_modalertify_theme_desc',
    ],
    //bootstrapnotify
    'bnotify_options' => [
        'xtype' => 'textfield',
        'value' => json_encode([
            'element' => 'body',
            'position' => null,
            'type' => "info",
            'allow_dismiss' => true,
            'newest_on_top' => false,
            'showProgressbar' => false,
            'placement' => [
                'from' => 'top',
                'align' => 'right'
            ],
            'offset' => 20,
            'spacing' => 10,
            'z_index' => 1031,
            'delay' => 3000,
            'timer' => 1000,
            /*
            'animate' => [
                'enter' => 'animated fadeInDown',
                'exit' => 'animated fadeOutUp'
            ]*/
        ]),
        'area' => 'modalertify_bnotify',
        'name'  => 'setting_modalertify_bnotify_options',
        'description'=> 'setting_modalertify_bnotify_options_desc',
    ],
    //overhang
    'overhang_options' => [
        'xtype' => 'textfield',
        'value' => json_encode(['delay' => 3]),
        'area' => 'modalertify_overhang',
        'name'  => 'setting_modalertify_overhang_options',
        'description'=> 'setting_modalertify_overhang_options_desc',
    ],
    //toastr
    'toastr_options' => [
        'xtype' => 'textfield',
        'value' => json_encode(['timeOut' => 3000]),
        'area' => 'modalertify_toastr',
        'name'  => 'setting_modalertify_toastr_options',
        'description'=> 'setting_modalertify_toastr_options_desc',
    ],
    //noty
    'noty_options' => [
        'xtype' => 'textfield',
        'value' => json_encode([
            'layout' => 'topRight',
            'timeout' => 3000,
            'theme' => 'mint',
            'closeWith' => ['click', 'button'],/*
            'animation' => [
                'open' => 'animated fadeInRight',
                'close' => 'animated fadeOutRight'
            ]*/
        ]),
        'area' => 'modalertify_noty',
        'name'  => 'setting_modalertify_noty_options',
        'description'=> 'setting_modalertify_noty_options_desc',
    ],
];




