function base_url(string_url) {
  var pathparts = location.pathname.split("/");
  if (
    location.host == "localhost:8080" ||
    location.host == "localhost" ||
    location.host == "192.168.191.100:8080"
  ) {
    var url = location.origin + "/" + pathparts[1].trim("/") + "/" + string_url; // http://localhost/myproject/
  } else {
    var url = location.origin + "/" + string_url; // http://stackoverflow.com
  }
  return url;
}

var app = angular.module("InvoiceApp", ["datatables"]);
app.controller("InvoiceAppController", function ($scope, $http) {
  $scope.AddOtcInvoice = function () {
    $("#my-modal-add").modal("show");
  };

  // Ambil data dan isi select
  $scope.listKodeMitra = [];
  $scope.selectedKodeMitra = "";

  $scope.GetKodeMitra = function () {
    $http
      .get(base_url("profile_pelanggan/get_code_mitra"))
      .then(function (response) {
        $scope.listKodeMitra = response.data;
      })
      .catch(function (error) {
        console.log(error);
      });
  };

  $scope.getProfileMitra = function () {
    alert("Kode mitra terpilih: " + $scope.selectedKodeMitra);
  };

  $scope.GetKodeMitra();
});
