class modAlertifySimple {
	constructor(config){
		this.config = config || {};
		return this;
    }
	show(method, message, options, callback){
		if (!message) return false;
		this.reset(options);
		alert(message);
		if (typeof callback === 'function') {
        	callback();
        }
        return true;
    }
	success (message, options, callback) {
		this.show('success', message, options, callback);
	}
	error (message, options, callback) {
		this.show('error', message, options, callback);
	}
	info (message, options, callback) {
		this.show('info', message, options, callback);
	}
	reset (options) {
		return true;
	}
	removeAll() {
		return true;
	}
	getScript(source, callback) {
	    var script = document.createElement('script');
	    var prior = document.getElementsByTagName('script')[0];
	    script.async = 1;

	    script.onload = script.onreadystatechange = function( _, isAbort ) {
	        if(isAbort || !script.readyState || /loaded|complete/.test(script.readyState) ) {
	            script.onload = script.onreadystatechange = null;
	            script = undefined;

	            if(!isAbort) { if(typeof callback === 'function') return callback(); }
	        }
	    };

	    script.src = source;
	    prior.parentNode.insertBefore(script, prior);
	    return true;
	}
}
class modAlertifyJS extends modAlertifySimple {
	constructor(config){
		super();
		this.config = config || {};
		if (typeof(alertify) === 'undefined') {
			console.error('alertify js not found');
			return new modAlertifySimple(config);
		}
		return this;
    }
    show (method, message, options, callback) {
		if (!message) return false;
		this.reset(options);
		switch (method){
			case 'success':
            	var msg = alertify.success(message);
				break;
			case 'error':
            	var msg = alertify.error(message);
				break;
			case 'info':
            	var msg = alertify.log(message);
				break;
			default:
				return false;
		}
		if (typeof callback === 'function')
			msg.callback = callback;
	}
	reset (options) {
		var defaults = this.config.options || {};
		var options = options || {};
		var settings = Object.assign({}, defaults, options);
		for (var key in settings) {
		    if (settings.hasOwnProperty(key)) {
		        alertify.set('notifier', key, settings[key]);
		    }
		}
		return true;
	}
	removeAll () {
		alertify.dismissAll();
	}
}
class modOverhang extends modAlertifySimple {
	constructor(config){
		super();
		this.config = config || {};
		if (!$.fn.overhang) {
			console.error('overhang js not found');
			return new modAlertifySimple(config);
		}
		this.initialize();
		return this;
    }
    initialize (){
    	if (!$.ui) {
            return this.loadJQUI(this.initialize);
        }
        return true;
    }
    loadJQUI(callback){
        return $.getScript(this.config.jsUrl + 'web/lib/jquery-ui.min.js', function () {
            if (typeof callback == 'function') {
                callback();
            }
        });
    }
    show (method, message, options, callback) {
		if (!message) return false;
		switch (method){
			case 'success':
			case 'error':
			case 'info':
			case 'warn':
			case 'prompt':
			case 'confirm':
				break;
			default:
				return false;
		}

		var defaults = this.config.options || {};
		var options = options || {};
		var settings = {
			type: method,
			message: message,
			callback: callback
		};

		if (typeof callback === 'function') {
        	settings.callback = callback;
        }
		var settings = Object.assign({}, defaults, options, settings);

		$("body").overhang(settings);
	}
}
class modNoty extends modAlertifySimple {
	constructor(config){
		super();
		this.config = config || {};
		if (typeof Noty === 'undefined') {
			console.error('noty js not found');
			return new modAlertifySimple(config);
		}
		return this;
    }
    show (method, message, options, callback) {
		if (!message) return false;
		switch (method){
			case 'alert':
			case 'success':
			case 'warning':
			case 'error':
			case 'info':
			case 'information':
				break;
			default:
				return false;
		}

		var options = options || {};
		var settings = {
			type: method,
			text: message,
		};

		if (typeof callback === 'function') {
        	settings.callback.onShow = callback;
        }
		var settings = Object.assign({}, options, settings);
	    
	    new Noty(settings).show()

	}
	reset (options) {
		var defaults = this.config.options || {};
		Noty.overrideDefaults(defaults);
	}
	removeAll () {
		Noty.closeAll();
	}
}
class modBootstrapNotify extends modAlertifySimple {
	constructor(config){
		super();
		this.config = config || {};
		if (!$.notify) {
			console.error('notify js not found');
			return new modAlertifySimple(config);
		}
		return this;
    }
    show (method, message, options, callback) {
		if (!message) return false;
		switch (method){
			case 'info':
			case 'success':
			case 'warning':
			case 'danger':
				break;
			case 'error':
				method = 'danger';
				break;
			default:
				return false;
		}

		var options = options || {};
		var settings = {
			type: method,
		};

		if (typeof callback === 'function') {
        	settings.callback.onShown = callback;
        }
		var settings = Object.assign({}, options, settings);
	    
	    $.notify({
			message: message,
		},settings);

	}
	reset (options) {
		var defaults = this.config.options || {};
		$.notifyDefaults(defaults);
		return true;
	}
	removeAll () {
		$.notifyClose();
	}
}
class modToastr extends modAlertifySimple {
	constructor(config){
		super();
		this.config = config || {};
		if (typeof(toastr) === 'undefined') {
			console.error('toastr not found');
			return new modAlertifySimple(config);
		}
		return this;
    }
    show (method, message, options, callback) {
		if (!message) return false;
		switch (method){
			case 'success':
			case 'error':
			case 'warning':
			case 'info':
				break;
			default:
				return false;
		}
		options = options || {};
		if (typeof callback === 'function')
			options.onShown = callback;

    	toastr[method](message, '', options);
	}
	reset (options) {
		var defaults = this.config.options || {};
		for (var key in defaults) {
		    if (defaults.hasOwnProperty(key)) {
		        toastr.options[key] = defaults[key];
		    }
		}
		return true;
	}
	removeAll () {
		toastr.clear();
	}
}
(function (window, document, $) {

    var modAlertify = modAlertify || {};

    modAlertify.initialized = false;

    modAlertify.initialize = function (element, config) {
    	if (this.initialized) {
            return true;
        }
    	if (!element) {
            return false;
        }
        this.config = config || {};

        this.Message = new (eval(element))(this.config);

        if (!(this.Message instanceof modAlertifySimple)){
        	return false;
        }

    	this.Message.reset();

    	this.miniShop2();
    	this.Office();
    	this.AjaxForm();

    	this.initialized = true;

        return true;
    }

    modAlertify.miniShop2 = function () {
    	if (this.miniShop2 && typeof(miniShop2) != 'undefined') {
	        miniShop2.Message = {
	            initialize: function() {
	                miniShop2.Message.close = modAlertify.Message.removeAll;
	                miniShop2.Message.show = function(message, options) {
	                    if (message != '') {
	                        modAlertify.Message.info(message, options);
	                    }
	                }
	            },
	            success: function(message) {
	            	modAlertify.Message.success(message);
	            },
	            error: function(message) {
	            	modAlertify.Message.error(message);
	            },
	            info: function(message) {
	            	modAlertify.Message.info(message);
	            }
	        };
	        miniShop2.Message.initialize();
		}
    }

    modAlertify.Office = function () {
	    if (this.Office && typeof(Office) != 'undefined') {
			Office.Message = {
			    success: function (message, sticky) {
			        modAlertify.Message.success(message);
			    },
			    error: function (message, sticky) {
	            	modAlertify.Message.error(message);
			    },
			    info: function (message, sticky) {
	            	modAlertify.Message.info(message);
			    },
			    close: function () {
                    modAlertify.Message.removeAll();
			    }
			};
		}
    }

    modAlertify.AjaxForm = function () {
	    if (this.AjaxForm && typeof(AjaxForm) != 'undefined') {
			AjaxForm.Message = {
			    success: function (message, sticky) {
			        modAlertify.Message.success(message);
			    },
			    error: function (message, sticky) {
			        modAlertify.Message.error(message);
			    },
			    info: function (message, sticky) {
			        modAlertify.Message.info(message);
			    },
			    close: function () {
			        modAlertify.Message.removeAll();
			    },
			};
		}
    }
	/*
    $(document).ready(function ($) {
        modAlertify.initialize();
    });
    document.addEventListener('DOMContentLoaded', function(){
		modAlertify.initialize();
	});*/

    window.modAlertify = modAlertify;
})(window, document, jQuery);