  angular.module('storeclosing').controller('postController', function($scope, $http, $q, $window, $rootScope) {

  var vm = this;
  $window.sessionStorage.userInfo ? vm.userInfo= JSON.parse($window.sessionStorage.userInfo) : vm.userInfo = {};





});