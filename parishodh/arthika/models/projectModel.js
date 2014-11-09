/**
 * Created by ankuyadav on 11/8/2014.
 */
'use strict';

var mongoose = require('mongoose');

var projectSchema = mongoose.Schema({

    name: {
        type:String,
        required: true,
        unique: true
    },
    chapterName :{
        type:String
    }
});

exports.projectModel = function(){
    return mongoose.model('project', projectSchema);
};
