define(['App', 'backbone', 'marionette', 'views/HeaderView','views/reportView'],
    function (App, Backbone, Marionette, HeaderView, reportView) {
    return Backbone.Marionette.Controller.extend({
        initialize : function (options) {
            App.headerRegion.show(new HeaderView());
           
        },
        //gets mapped to in AppRouter's appRoutes
        report : function () {
           App.mainRegion.show(new reportView());
        }
    });
});