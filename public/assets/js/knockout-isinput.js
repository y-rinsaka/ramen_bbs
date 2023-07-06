function ViewModel() {
  var self = this;

  self.inputUsername = ko.observable('');
  self.inputPassword = ko.observable('');
  self.inputEmail = ko.observable('');

  self.canSubmitLogin = ko.computed(function () {
    return (self.inputUsername().length > 0)&&(self.inputPassword().length > 0) ;
  });
  self.canSubmitRegister = ko.computed(function () {
    return (self.inputUsername().length > 0)&&(self.inputPassword().length > 0)&& (self.inputEmail().length > 0);
  });

}
ko.applyBindings(new ViewModel());
