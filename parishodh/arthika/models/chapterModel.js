/**
 * Created by ankuyadav on 11/8/2014.
 */
'use strict';

var mongoose = require('mongoose');

var chapterSchema = mongoose.Schema({

    name: {
        type:String,
        required: true,
        unique: true
    },
    location: {
        type:String,
        required: true
    },
    userName :{
        type:String
    }
});

exports.chapterModel = function(){
    return mongoose.model('chapter', chapterSchema);
};
