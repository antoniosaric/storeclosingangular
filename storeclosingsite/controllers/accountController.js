angular.module('storeclosing').controller('accountControl', function($scope, $rootScope, $http, $q, $window) {
  
//****************************              SET VARIABLES              ****************************

  var vm = this;

//****************************              SET SESSION STORAGE            ****************************
 
  $window.sessionStorage.userInfo ? vm.userInfo= JSON.parse($window.sessionStorage.userInfo) : vm.userInfo = {};
  $window.sessionStorage.userPosts ? vm.userPosts= JSON.parse($window.sessionStorage.userPosts) : vm.userPosts = [];

  console.log(vm.userInfo)
  
//****************************              CREATE USER ACCOUNT            ****************************

//begin create  
  vm.createAccount = function() 
  {
  console.log("CREATE ACCOUNT");
    vm.loginError = false;
    if($scope.email)
    {
      $window.sessionStorage.clear();
      var password = $scope.password; 
      vm.email = $scope.email;
    }

    if ( vm.email && vm.email.length > 3 )
      // && password && password.length > 0 && firstname && firstname.length > 0 && lastname && lastname.length > 0
    {
      if ( password && password.length > 1)
      {
        if($scope.passwordrepeat == $scope.password)
        {
          var data = {
                email: vm.email,
                password: password
              };

          $http.post("../controllers/do_editAccount.php", data)
          .then(
          function(response) { 

            console.log(response)
            if ( response.data[0].status == 200 )
            {
              vm.userInfo['userId'] = response.data[0].userId;
              vm.userInfo['userEmail'] = vm.email;
              vm.userInfo['userJWT'] = response.data[0].JWT;
              $window.sessionStorage.userInfo = JSON.stringify(vm.userInfo);

              console.log('pickles')

              window.location.href = "profile.html";
            }
            else
            {
              vm.message = response.data[0].message;
              vm.loginError = true;
            }
          },
          function(response) { // Error callback
          console.log("ERROR");
            vm.loginError = true;
            return $q.reject(response); // Use $q.reject
          });
        }
        else
        {
          console.log("NO DATA");
          vm.message = "Enter an email address";
        }

      }
      else
      {
      }
    }
  };

  vm.login = function()
  {
    var i = sessionStorage.length;
    while(i--) {
      var key = sessionStorage.key(i);
      if(/foo/.test(key)) {
        sessionStorage.removeItem(key);
      }  
    }
    localStorage.clear();
    sessionStorage.clear();

    vm.currentPage = window.location.pathname.split("/").pop();

    vm.loginError = false;

    var email = $scope.email;
    var password = $scope.password;

    if ( email && email.length > 0 && password && password.length > 0 ) 
    {
      var data = {
            email: email,
            password: password
          };
      $http.post("../controllers/do_login.php", data)
      .then(
      function(response) {  
          console.log(response)
        if ( response.status === 200 )
        {

          console.log(response)

              response.data[0].JWT ? vm.userInfo['userJWT'] = response.data[0].JWT : null;
              response.data[0].email ? vm.userInfo['userEmail'] = response.data[0].email : null;
              response.data[0].userId ? vm.userInfo['userId'] = response.data[0].userId : null;
              $window.sessionStorage.userInfo = JSON.stringify(vm.userInfo);


              window.location.href = 'profile.html';


//****************************              END USER GET INFO         ****************************

        }
        else
        {
          vm.loginError = true;
        }
      },
      function(response) { // Error callback
        vm.loginError = true;
        return $q.reject(response); // Use $q.reject
      });
    } 
  };





})



