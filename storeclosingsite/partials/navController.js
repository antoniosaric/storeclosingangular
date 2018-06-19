  angular.module('storeclosing').controller('navController', function($scope, $http, $q, $window, $rootScope) {

  var vm = this;
  $window.sessionStorage.userInfo ? vm.userInfo= JSON.parse($window.sessionStorage.userInfo) : vm.userInfo = {};





  vm.logout = function()
  {
    console.log('inside')
    var i = sessionStorage.length;
    while(i--) {
      var key = sessionStorage.key(i);
      if(/foo/.test(key)) {
        sessionStorage.removeItem(key);
      }  
    }
    localStorage.clear();
    sessionStorage.clear();

    window.location.href = 'index.html';
  }  

});