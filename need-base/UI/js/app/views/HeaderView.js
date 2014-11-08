define([ 'marionette', 'handlebars', 'text!templates/header.html'],
    function (Marionette, Handlebars, template) {
        //ItemView provides some default rendering logic
        return Marionette.ItemView.extend({
            template:Handlebars.compile(template),
            events: {
            	'mouseenter .nav>li' : 'showFlyout',
            	'mouseleave .nav>li' : 'hideFlyout',
            },
            showFlyout :  function(e){
            	e.preventDefault();
            	var flyout = $(e.target).next('.flyout');
            	if(flyout.length){
            		flyout.addClass('show');            	
            	}
            },
            hideFlyout :  function(e){
            	e.preventDefault();
            	var flyout = $(e.target).closest('.flyout').length ? $(e.target).closest('.flyout') : $(e.target).next('.flyout');
            	if(flyout.length){
            		flyout.removeClass('show');            	
            	}
            }
          
        });
    });