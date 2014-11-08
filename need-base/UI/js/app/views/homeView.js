define( [ 'App', 'marionette', 'handlebars', 'models/Model', 'text!templates/home.html'],
    function( App, Marionette, Handlebars, Model, template) {
        //ItemView provides some default rendering logic
        return Marionette.ItemView.extend( {
            //Template HTML string
            template: Handlebars.compile(template),
            model: new Model(),
            // View Event Handlers
            events: {
            	'click .other-cat-item.child .other-cat-title' : 'toggleClass',
            	'click .seo-content'		  : 'toggleSEO'
            },
            initialize : function() {
            	var _this =  this;
            	App.vent.on('toggle-seo', function(itemId) {
            		_this.toggleSEO();
            	});
            },
            toggleSEO : function(e){
            	$('.seo .seo-content').toggleClass('active');
            },
            toggleClass :  function(e){
            	var $catEle = $(e.target).closest('.other-cat-item.child');
            	if($catEle.hasClass('active')){
            		$catEle.removeClass('active');
            	}else{
            		$('.other-cat-item.child').removeClass('active');
            		$catEle.addClass('active');
            	}
            },
            onBeforeRender: function(){
                // set up final bits just before rendering the view's `el`
             },
            onRender: function(){
                // manipulate the `el` here. it's already
                // been rendered, and is full of the view's
                // HTML, ready to go.
            	$('.fashion-logo').removeClass('back');
            },
            onClose : function(){
            	$('.fashion-logo').addClass('back');
            }
        });
    });