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

var app = angular.module("KemitraanApp", ["datatables"]);
app.controller("KemitraanAppController", function ($scope, $http) {
  $scope.LoadDataLegalitas = function () {
    $http
      .get(base_url("profile_pelanggan/kemitraan_reseller/getdata"))
      .then(function (response) {
        $scope.RowLegalitas = response.data;
      })
      .catch(function (error) {
        console.error("Terjadi kesalahan:", error);
      });
  };

  $scope.LoadDataLegalitas();

  $scope.Add = function () {
    $("#My-Modal-Add").modal("show");
    $scope.GETIDMitra();
  };

  $scope.GETIDMitra = function () {
    $http
      .get(base_url("profile_pelanggan/kemitraan_reseller/getmitra_id"))
      .then(function (response) {
        $("#mitra_id").val(response.data.kode_mitra);
      })
      .catch(function (error) {
        console.error("Terjadi kesalahan:", error);
      });
  };

  $scope.listData = [];
  $scope.listDataDocTambahan = [];

  $scope.AddBaris = function () {
    $scope.listData.push({
      nik: "",
      nama: "",
      no_wa: "",
      email: "",
      npwp: "",
      npwp2: "",
      filename: "",
      posisi: "",
    });
  };

  $scope.LoadDataDocTambahan = function () {
    $http
      .get(base_url("master/supported_document/getdata"))
      .then(function (response) {
        $scope.listDataDocTambahan = response.data;
      })
      .catch(function (error) {
        console.error("Terjadi kesalahan:", error);
      });
  };

  $scope.LoadDataDocTambahan();

  $scope.HapusBaris = function (index) {
    $scope.listData.splice(index, 1);
  };

  $scope.Insert = function () {
    var mitra_id = $("#mitra_id").val();
    var perusahaan = $("#nama_perusahaan").val();
    var email = $("#email").val();
    var no_kontak = $("#no_kontak").val();
    var alamat_perusahaan = $("#alamat_perusahaan").val();
    var alamat_instalasi = $("#alamat_instalasi").val();

    var formData = new FormData();

    formData.append("mitra_id", mitra_id);
    formData.append("perusahaan", perusahaan);
    formData.append("email", email);
    formData.append("no_kontak", no_kontak);
    formData.append("alamat_perusahaan", alamat_perusahaan);
    formData.append("alamat_instalasi", alamat_instalasi);

    // Handle struktural
    var tbody1 = document.getElementById("tbody-struktural");
    var rows1 = tbody1.getElementsByTagName("tr");
    var detail_struktural = [];

    for (var i = 0; i < rows1.length; i++) {
      var cells = rows1[i].getElementsByTagName("td");

      var rowData = {
        nik: cells[2].querySelector("input").value,
        nama: cells[3].querySelector("input").value,
        no_wa: cells[4].querySelector("input").value,
        email: cells[5].querySelector("input").value,
        npwp: cells[6].querySelector("input").value,
        posisi: cells[8].querySelector("input").value,
      };

      detail_struktural.push(rowData);

      var file = cells[7].querySelector("input").files[0];
      if (file) {
        formData.append("struktural_file_" + i, file);
      }
    }

    formData.append("struktural", JSON.stringify(detail_struktural));

    // Handle tambahan
    var tbody2 = document.getElementById("tbody-tambahan");
    var rows2 = tbody2.getElementsByTagName("tr");
    var tambahanDokumen = [];

    for (var i = 0; i < rows2.length; i++) {
      var cells2 = rows2[i].getElementsByTagName("td");

      var rowData2 = {
        dokumen_id: cells2[1].querySelector("input").value,
        jenis_dokumen: cells2[2].querySelector("input").value,
      };

      tambahanDokumen.push(rowData2);

      var file_dokumen = cells2[3].querySelector("input").files[0];
      if (file_dokumen) {
        formData.append("tambahan_file_" + i, file_dokumen);
      }
    }

    formData.append("tambahan_file_data", JSON.stringify(tambahanDokumen));

    fetch(base_url("profile_pelanggan/kemitraan_reseller/insert"), {
      method: "POST",
      body: formData,
    })
      .then((res) => res.json())
      .then((data) => {
        console.log(data);
        if (data.status === "success") {
          Swal.fire({
            icon: "success",
            title: "Berhasil",
            text: "Data berhasil disimpan",
            showConfirmButton: false,
            timer: 2000,
          });
          document.location.reload();
        }
      })
      .catch((err) => {
        console.error(err);
        alert("Terjadi kesalahan saat mengirim data.");
      });
  };

  $scope.EditShow = function (dt) {};

  $scope.showProfile = function () {
    $("#My-Modal-Show-Profile").modal("show");
  };
});
