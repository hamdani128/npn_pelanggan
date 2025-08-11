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

var app = angular.module("MasterDocumentApp", ["datatables"]);
app.controller("MasterDocumentAppController", function ($scope, $http) {
  $scope.LoadDataDocument = function () {
    $http
      .get(base_url("master/supported_document/getdata"))
      .then(function (response) {
        $scope.LoadData = response.data;
      })
      .catch(function (error) {
        console.error("Terjadi kesalahan:", error);
      });
  };

  $scope.LoadDataDocument();

  $scope.Add = function () {
    $("#My-Modal-Add").modal("show");
  };

  $scope.Insert = function () {
    var nama = $("#nama").val();
    var squence = $("#combo_squence").val();
    if (nama == "") {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Nama tidak boleh kosong!",
      });
    } else {
      var data = {
        nama: nama,
        squence: squence,
      };

      $http
        .post(base_url("master/supported_document/insert"), data)
        .then(function (response) {
          if (response.data.status == "success") {
            Swal.fire({
              icon: "success",
              title: "Success",
              text: response.data.message,
            });
            $scope.LoadDataDocument();
            document.location.reload();
          } else {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: response.data.message,
            });
          }
        })
        .catch(function (error) {
          console.error("Terjadi kesalahan:", error);
        });
    }
  };

  $scope.EditShow = function (dt) {
    $("#id_update").val(dt.id);
    $("#nama_edit").val(dt.type_name);
    $("#combo_squence_edit").val(dt.squence);
    $("#My-Modal-Edit").modal("show");
  };

  $scope.Update = function () {
    var id = $("#id_update").val();
    var nama = $("#nama_edit").val();
    var squence = $("#combo_squence_edit").val();

    $http
      .post(base_url("master/supported_document/update"), {
        id: id,
        nama: nama,
        squence: squence,
      })
      .then(function (response) {
        if (response.data.status == "success") {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: response.data.message,
          });
          $scope.LoadDataDocument();
          document.location.reload();
        } else {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: response.data.message,
          });
        }
      })
      .catch(function (error) {
        console.error("Terjadi kesalahan:", error);
      });
  };

  $scope.Delete = function (dt) {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        $http
          .post(base_url("master/supported_document/delete"), {
            id: dt.id,
          })
          .then(function (response) {
            if (response.data.status == "success") {
              Swal.fire({
                icon: "success",
                title: "Success",
                text: response.data.message,
              });
              $scope.LoadDataDocument();
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
