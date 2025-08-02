function base_url(string_url) {
  var pathparts = location.pathname.split("/");
  if (
    location.host == "localhost:8080" ||
    location.host == "localhost" ||
    location.host == "192.168.191.100"
  ) {
    var url = location.origin + "/" + pathparts[1].trim("/") + "/" + string_url; // http://localhost/myproject/
  } else {
    var url = location.origin + "/" + string_url; // http://stackoverflow.com
  }
  return url;
}

var app1 = angular.module("LandingCorporateApp", []);
app1.controller("LandingCorporateController1", function ($scope, $http) {
  $scope.LoadDataDocTambahan = function () {
    $http
      .get(base_url("landing/corporate/supported_document"))
      .then(function (response) {
        $scope.listDataDocTambahan = response.data;
      })
      .catch(function (error) {
        console.error("Terjadi kesalahan:", error);
      });
  };

  $scope.LoadDataDocTambahan();

  $scope.submitForm = function () {};
});
