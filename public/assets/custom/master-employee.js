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

var app = angular.module("EmployeeApp", ["datatables"]);
app.controller("EmployeeController", function ($scope, $http) {
  $scope.LoadDataEmployee = function () {
    $http
      .get(base_url("master/employee_master/getdata"))
      .then(function (response) {
        $scope.LoadData = response.data;
      })
      .catch(function (error) {
        console.log(error);
      });
  };

  $scope.LoadDataEmployee();

  $scope.Add = function () {
    $("#My-Modal-Add").modal("show");
  };

  $scope.Insert = function () {
    var nama_lengkap = $("#nama").val();
    var email = $("#email").val();
    var jabatan = $("#jabatan").val();
    var no_kontak = $("#no_kontak").val();

    if (nama_lengkap == "" || email == "" || jabatan == "" || no_kontak == "") {
      Swal.fire({
        title: "Error!",
        text: "Data tidak boleh kosong!",
        icon: "error",
        confirmButtonText: "Tutup",
      });
    } else {
      var formdata = {
        nama_lengkap: nama_lengkap,
        email: email,
        jabatan: jabatan,
        no_kontak: no_kontak,
      };

      $http
        .post(base_url("master/employee_master/insert"), formdata)
        .then(function (response) {
          if (response.data.status == "success") {
            Swal.fire({
              title: "Success!",
              text: response.data.message,
              icon: "success",
              confirmButtonText: "Tutup",
            });
            document.location.reload();
          } else {
            Swal.fire({
              title: "Error!",
              text: response.data.message,
              icon: "error",
              confirmButtonText: "Tutup",
            });
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  };
});
