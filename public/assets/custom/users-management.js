function base_url(string_url) {
  var pathparts = location.pathname.split("/");
  if (
    location.host == "localhost:8080" ||
    location.host == "localhost" ||
    location.host == "10.32.18.206"
  ) {
    var url = location.origin + "/" + pathparts[1].trim("/") + "/" + string_url; // http://localhost/myproject/
  } else {
    var url = location.origin + "/" + string_url; // http://stackoverflow.com
  }
  return url;
}

var app = angular.module("UserAccountApp", ["datatables"]);
app.controller("UserAccountController", function ($scope, $http) {
  $scope.LoadDataUserManagement = function () {
    $http
      .get(base_url("users_management/getdata"))
      .then(function (response) {
        $scope.LoadData = response.data;
      })
      .catch(function (error) {
        console.error("Terjadi kesalahan:", error);
      });
  };

  $scope.LoadDataUserManagement();

  $scope.Add = function () {
    $("#My-Modal-Add").modal("show");
  };

  $scope.Insert = function () {
    var fullname = $("#fullname").val();
    var email = $("#email").val();
    var username = $("#username").val();
    var Level = $("#combo_users").val();

    if (fullname == "" || email == "" || username == "" || Level == "") {
      Swal.fire({
        title: "Error",
        text: "Please fill all required fields",
        icon: "error",
      });
    } else {
      var formdata = {
        nama: fullname,
        email: email,
        username: username,
        level: Level,
      };

      $http
        .post(base_url("users_management/insert"), formdata)
        .then(function (response) {
          if (response.data.status == "success") {
            Swal.fire({
              title: "Success",
              text: "Data has been added successfully",
              icon: "success",
            });
            document.location.reload();
          }
        })
        .catch(function (error) {
          console.error("Terjadi kesalahan:", error);
        });
    }
  };
});
