define(["jquery", "backbone"],
    function ($, Backbone) {
        // Creates a new Backbone Model class object
        var Model = Backbone.Model.extend({
        	url : function() {
        	      return "http://ajax.googleapis.com/ajax/services/search/web";
        	  },
        	  initialize : function(url) {
        	  },
        	  parse : function(resp) {
        		  console.log(resp.groupedItems);
        	    return {
        	    	items:resp.groupedItems
        	    };
        	  }
        });

        return Model;
    }
);