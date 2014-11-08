Template.login.events({
  'click .my-button': function (event, template) {
    alert("My button was clicked!");
  },

  'submit form': function (event, template) {
    console.log('hello world');
    var user = event.currentTarget[0].value;
    var password = event.currentTarget[1].value;
    Meteor.loginWithPassword(user, password, function(err, data) {
      console.log(err, data);
    });
  }
});