
'use strict';

var mongoose = require('mongoose');

var billingSchema = mongoose.Schema({

    userId: {
        type:String,
        required: true
    },
    chapterId :{
        type:String,
        required: true
    },
    projectId :{
        type:String,
        required: true
    },
    billingDate :{
        type:String,
        required: true
    },
    shopName :{
        type:String
    },
    amount :{
        type:String,
        required: true
    },
    billNo : {
        type:Number
    },
    location : {
        type:String
    },
    imageURI : {
        type:String
    },
    timeCreated : {
        type:Date,
        default: new Date()


    },
    status : {
        type:String,
        enum: ['Pending', 'Approved'],
        default: 'Pending'
    }
});

exports.projectModel = function(){
    return mongoose.model('billing', billingSchema);
};


