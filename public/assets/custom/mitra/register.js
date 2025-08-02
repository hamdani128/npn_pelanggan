function base_url(string_url) {
  var pathparts = location.pathname.split("/");
  if (
    location.host == "localhost:8081" ||
    location.host == "localhost" ||
    location.host == "192.168.191.100:8080"
  ) {
    var url = location.origin + "/" + pathparts[1].trim("/") + "/" + string_url; // http://localhost/myproject/
  } else {
    var url = location.origin + "/" + string_url; // http://stackoverflow.com
  }
  return url;
}

var app = angular.module("RegisterKemitraanApp", ["datatables"]);
app.controller("RegisterKemitraanAppController", function ($scope, $http) {
  $scope.LoadDataRegisterKemitraan = function () {
    $http
      .get(base_url("profile_pelanggan/register_getdata"))
      .then(function (response) {
        $scope.LoadData = response.data;
      })
      .catch(function (error) {
        console.log(error);
      });
  };

  $scope.LoadDataRegisterKemitraan();

  $scope.Approval = function (dt) {
    Swal.fire({
      title: "Apakah anda yakin?",
      text: "Anda akan menyetujui data ini!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Setuju!",
    }).then((result) => {
      if (result.isConfirmed) {
        $http
          .post(base_url("profile_pelanggan/register_approval"), {
            kode_register: dt.kode_register,
          })
          .then(function (response) {
            if (response.data.status == "success") {
              Swal.fire("Berhasil!", "Data berhasil disetujui.", "success");
              document.location.reload();
            }
          })
          .catch(function (error) {
            console.log(error);
          });
      }
    });
  };
});
