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

var app = angular.module("RegisterApp", []);
app.controller("RegisterControllerApp", function ($scope, $http) {
  $scope.register = function () {
    var nama_perusahaan = $("#nama_perusahaan").val();
    var email = $("#email").val();
    var no_kontak = $("#no_kontak").val();
    var alamat_perusahaan = $("#alamat_perusahaan").val();
    var alamat_instalasi = $("#alamat_instalasi").val();

    if (
      nama_perusahaan == "" ||
      email == "" ||
      no_kontak == "" ||
      alamat_perusahaan == "" ||
      alamat_instalasi == ""
    ) {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Semua field harus diisi!",
      });
    } else {
      Swal.fire({
        title: "Memproses...",
        html: "Mohon tunggu sebentar",
        allowOutsideClick: false,
        didOpen: () => {
          Swal.showLoading();
        },
      });

      var formdata = {
        nama_perusahaan: nama_perusahaan,
        email: email,
        no_kontak: no_kontak,
        alamat_perusahaan: alamat_perusahaan,
        alamat_instalasi: alamat_instalasi,
      };

      $http
        .post(base_url("register/insert"), formdata)
        .then(function (response) {
          if (response.data.status === "success") {
            Swal.fire({
              icon: "success",
              title: "Berhasil",
              text: "Register berhasil. Silahkan cek email informasi pendaftaran",
              showConfirmButton: false,
              timer: 1500,
            }).then(() => {
              location.reload();
            });
          } else if (response.data.status === "company_already") {
            Swal.fire({
              icon: "error",
              title: "Gagal",
              text: "Perusahaan sudah terdaftar.",
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Gagal",
              text: response.data.message || "Aktivasi gagal.",
            });
          }
        })
        .catch(function (error) {
          console.error("Gagal mengaktifkan akun:", error);
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "Terjadi kesalahan sistem.",
          });
        });
    }
  };
});
