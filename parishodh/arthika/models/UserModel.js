'use strict';

var mongoose = require('mongoose');

var userSchema = mongoose.Schema({

    userName: {
        type:String,
        required: true,
        unique: true
    },
    password: {
        type:String,
        required: true
    },
    firstName: {
        type:String,
        required: true
    },
    lastName: {
        type:String
    },
    email: {
        type:String,
        required: true,
        unique: true
    },
    contact: {
        type:Number,
        required: true,
        unique: true
    },
    role: {
        type: String,
        enum: ['Volunteer', 'Chapter', 'Center' ],
        default: 'Volunteer'
    }
});

exports.userModel = function(){
    return mongoose.model('user', userSchema);
};