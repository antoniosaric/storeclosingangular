  angular.module('storeclosing').controller('postController', function($scope, $http, $q, $window, $rootScope) {

  var vm = this;
  $window.sessionStorage.userInfo ? vm.userInfo= JSON.parse($window.sessionStorage.userInfo) : vm.userInfo = {};

  vm.percentOffArray = ['5','10','15','20','25','30','35','40','45','50', '55','60','65','70','75','80','85','90','95']



});