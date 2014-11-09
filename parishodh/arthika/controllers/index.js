'use strict';


var IndexModel = require('../models/index');
var fs = require('fs');


module.exports = function (router) {

    var model = new IndexModel();


    router.get('/', function (req, res) {
        
        res.render('submitbill', model);
        
    });

    router.post('/submitbills', function (req, res) {

        fs.readFile(req.files.billfile.path, function (err, data) {
            var newPath = __dirname+ "/../uploads/" + req.param('BillNumber')+".jpg" ;
            fs.writeFile(newPath, data, function (err) {
                res.redirect("/");
            });
        });
    });


};
