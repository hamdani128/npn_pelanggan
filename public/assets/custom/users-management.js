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

  $scope.EditShow = function (dt) {
    if (dt.status_account == "1") {
      Swal.fire({
        title: "Error",
        text: "This account is already activated, you can't edit it",
        icon: "error",
      });
    } else {
      $("#id_update").val(dt.id);
      $("#fullname-edit").val(dt.name);
      $("#email-edit").val(dt.email);
      $("#username-edit").val(dt.username);
      $("#combo_users-edit").val(dt.level);
      $("#My-Modal-Edit").modal("show");
    }
  };

  $scope.Update = function () {
    var formdata = {
      id: $("#id_update").val(),
      nama: $("#fullname-edit").val(),
      email: $("#email-edit").val(),
      username: $("#username-edit").val(),
      level: $("#combo_users-edit").val(),
    };

    $http
      .post(base_url("users_management/update"), formdata)
      .then(function (response) {
        if (response.data.status == "success") {
          Swal.fire({
            title: "Success",
            text: "Data has been updated successfully",
            icon: "success",
          });
          document.location.reload();
        }
      })
      .catch(function (error) {
        console.error("Terjadi kesalahan:", error);
      });
  };

  $scope.Delete = function (dt) {
    if (dt.status_account == "1") {
      Swal.fire({
        title: "Error",
        text: "This account is already activated, you can't delete it",
        icon: "error",
      });
    } else {
      Swal.fire({
        title: "Are you sure ?",
        text: "Do you want to delete this account ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          var formdata = {
            id: dt.id,
          };
          $http
            .post(base_url("users_management/delete"), formdata)
            .then(function (response) {
              if (response.data.status == "success") {
                Swal.fire({
                  title: "Success",
                  text: "Account has been deleted successfully",
                  icon: "success",
                });
                document.location.reload();
              }
            })
            .catch(function (error) {
              console.error("Terjadi kesalahan:", error);
            });
        }
      });
    }
  };

  $scope.ActivateAccount = function (dt) {
    Swal.fire({
      title: "Are you sure ?",
      text: "Do you want to activate this account ?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, activate it!",
    }).then((result) => {
      if (result.isConfirmed) {
        var formdata = {
          id: dt.id,
          status: "1",
        };
        $http
          .post(base_url("users_management/activate"), formdata)
          .then(function (response) {
            if (response.data.status == "success") {
              Swal.fire({
                title: "Success",
                text: "Account has been activated successfully",
                icon: "success",
              });
              document.location.reload();
            }
          })
          .catch(function (error) {
            console.error("Terjadi kesalahan:", error);
          });
      }
    });
  };

  $scope.DisableAccount = function (dt) {
    Swal.fire({
      title: "Are you sure ?",
      text: "Do you want to deactivate this account ?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, deactivate it!",
    }).then((result) => {
      if (result.isConfirmed) {
        var formdata = {
          id: dt.id,
          status: "0",
        };
        $http
          .post(base_url("users_management/deactivate"), formdata)
          .then(function (response) {
            if (response.data.status == "success") {
              Swal.fire({
                title: "Success",
                text: "Account has been deactivated successfully",
                icon: "success",
              });
              document.location.reload();
            }
          })
          .catch(function (error) {
            console.error("Terjadi kesalahan:", error);
          });
      }
    });
  };
});
