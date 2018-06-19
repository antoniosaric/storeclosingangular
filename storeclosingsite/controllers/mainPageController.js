  angular.module('storeclosing').controller('mainPageController', function($scope, $http, $q, $window, $rootScope) {

  var vm = this;
  $window.sessionStorage.userInfo ? vm.userInfo= JSON.parse($window.sessionStorage.userInfo) : vm.userInfo = {};
  vm.paramString = "";
  vm.paramArray = [];

  vm.athleteArray = [];  
  vm.getPosts = function($params) 
  {
    console.log("getPosts");
    var data = {
      paramString: $params
    }

    console.log(data)
    $http.post("../controllers/get_closingPosts.php")
    .then(
    function(response) {
    if ( response.status === 200 )
    {
      console.log(response)
      vm.totalArray = response.data;
      // vm.postArray = response.data.slice(x, y);
      // vm.tempArray = vm.athleteArray;
      $window.sessionStorage.totalArray = JSON.stringify(vm.totalArray);  
    }
    else
    {
      console.log("status not 200")
    }
    },
    function(response) { // Error callback
    return $q.reject(response);
    console.log("grapeyyyyy") // Use $q.reject
    });

  };

  vm.setParams = function($param)
  {
    console.log($param)


    paramString = "";
    if(vm.paramArray.length > 0)
    {
      for(i = 0; i < vm.paramArray.length; i++ )
      {
        if($param == vm.paramArray[i])
        {
          vm.paramArray.splice(vm.paramArray.indexOf(vm.paramArray[i]), 1);
          break;
        }
        else
        {
          vm.paramArray.push($param);
        }
      }
    }
    else
    {
      vm.paramArray.push($param);
    }

      vm.paramString += "WHERE ";
      for(j = 0; j < vm.paramArray.length; j++)
      {
        vm.paramString += ""+vm.paramArray[j];
        if(vm.paramArray[j+1])
        {
          vm.paramString += " AND ";
        }
      }
      console.log(vm.paramString)

      vm.getPosts(vm.paramString); 
    
  }

vm.setParams("storename='bob burgers'")


})

  //****************************              GOOGLE LOCATION            ****************************

.directive('googleplace', function() {

    var vm = this;
    var placeSearch, gPlace;
    var componentForm = {
      locality: "long_name",
      administrative_area_level_1: "long_name",
      country: "long_name",
    };          

    return {
      require: 'ngModel',

      link: function(scope, element, attrs, model) 
      {
        gPlace = new google.maps.places.Autocomplete((document.getElementById('location')), {types: ['(cities)']});

        google.maps.event.addListener(gPlace, 'place_changed', function() {
            scope.$apply(function() {
              model.$setViewValue(element.val()); 
              model.$render();          
            });
        });
        gPlace.addListener('place_changed', fillInAddress);
      }
    };

    function fillInAddress() {
      // Get the place details from the autocomplete object.
      var place = gPlace.getPlace();
      var locationString = "";

      // Get each component of the address from the place details
      // and fill the corresponding field on the form.

      for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
          var val = place.address_components[i][componentForm[addressType]];
        }
      }   
    }

});