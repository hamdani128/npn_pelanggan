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

    // OTC Data Table
    var tbody3 = document.getElementById("tbody-otc");
    var rows3 = tbody3.getElementsByTagName("tr");
    var otdata = [];

    for (var i = 0; i < rows3.length; i++) {
      var cells3 = rows3[i].getElementsByTagName("td");

      var rowData3 = {
        deskripsi: cells3[1].querySelector("label").textContent.trim(), // ambil isi label
        harga_dasar: cells3[2].querySelector("input").value,
        harga_jual: cells3[3].querySelector("input").value,
        ppn: cells3[4].querySelector("select").value,
        subtotal: cells3[5].querySelector("input").value,
      };

      otdata.push(rowData3);
    }

    formData.append("otc_data", JSON.stringify(otdata));
    formData.append("jenis_layanan", $("#jenis_layanan").val());
    formData.append("satuan_layanan", $("#satuan_layanan").val());
    formData.append("kapasitas_layanan", $("#kapasitas_layanan").val());
    formData.append("vendor_media", $("#vendor_media").val());

    formData.append("deskripsi_price_month", $("#deskripsi_price_month").val());
    formData.append(
      "harga_dasar_price_month",
      $("#harga_dasar_price_month").val()
    );
    formData.append(
      "harga_jual_price_month",
      $("#harga_jual_price_month").val()
    );
    formData.append("ppn_text_price_month", $("#combo_ppn_price_month").val());
    formData.append(
      "nominal_ppn_price_month",
      $("#nominal_ppn_price_month").val()
    );
    formData.append("subtotal_price_month", $("#subtotal_price_month").val());
    formData.append("subtotal_price_month", $("#subtotal_price_month").val());
    formData.append(
      "start_date_price_month",
      $("#start_date_price_month").val()
    );
    formData.append("end_date_price_month", $("#end_date_price_month").val());
    formData.append(
      "pembayaran_paling_lama_month",
      $("#pembayaran_paling_lama_month").val()
    );

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

  $scope.SetTableRefrencePeriode = function () {
    $scope.ListDataArrayRefrencePeriode = [];

    var start = $("#start_date_price_month").val();
    var End = $("#end_date_price_month").val();
    var Deskripsi = $("#deskripsi_price_month").val();
    var harga_dasar = $("#harga_dasar_price_month").val();
    var harga_jual = $("#harga_jual_price_month").val();
    var ppn = parseFloat($("#combo_ppn_price_month").val()) || 0;
    var pembayaran_paling_lama =
      parseInt($("#pembayaran_paling_lama_month").val()) || 0;

    // Ubah harga dasar dan jual dari format string ke number
    var harga_dasar_number = UnFormatNumber(harga_dasar);
    var harga_jual_number = UnFormatNumber(harga_jual);

    if (start && End) {
      var start_date = new Date(start);
      var end_date = new Date(End);

      // Normalisasi ke tanggal 1
      var current = new Date(
        start_date.getFullYear(),
        start_date.getMonth(),
        1
      );
      var end = new Date(end_date.getFullYear(), end_date.getMonth(), 1);

      while (current <= end) {
        var periode =
          current.getFullYear() +
          "-" +
          (current.getMonth() + 1).toString().padStart(2, "0") +
          "-01";

        var payment_late_date =
          current.getFullYear() +
          "-" +
          (current.getMonth() + 1).toString().padStart(2, "0") +
          "-" +
          pembayaran_paling_lama.toString().padStart(2, "0");

        var subtotal = Math.round(
          harga_jual_number + harga_jual_number * (ppn / 100)
        );

        $scope.ListDataArrayRefrencePeriode.push({
          deskripsi_label_price_month: Deskripsi,
          price_dasar_price_month: formatNumber(harga_dasar_number),
          price_jual_price_month: formatNumber(harga_jual_number),
          combo_ppn: ppn,
          subtotal: formatNumber(subtotal),
          periode: periode,
          payment_late_date: payment_late_date,
          payment_late_days: pembayaran_paling_lama - 1, // karena periode awal selalu tanggal 1
          denda: 0,
        });

        current.setMonth(current.getMonth() + 1);
      }
    }
  };

  $scope.EditShow = function (dt) {};

  $scope.showProfile = function (dt) {
    $("#mitra_id_profile").val(dt.kode_mitra);
    $("#nama_perusahaan_profile").val(dt.nama_perusahaan);
    $("#no_kontak_profile").val(dt.no_hp);
    $("#email_profile").val(dt.email);
    $("#alamat_perusahaan_profile").val(dt.alamat);
    $("#alamat_instalasi_profile").val(dt.alamat_instalasi);
    $scope.GetMitraDetail(dt.kode_mitra);
    $scope.GetMitraDetailDokumen(dt.kode_mitra);
    $("#My-Modal-Show-Profile").modal("show");
  };

  $scope.GetMitraDetail = function (kode_mitra) {
    var formdata = {
      kode_mitra: kode_mitra,
    };
    $http
      .post(
        base_url("profile_pelanggan/kemitraan_reseller/getmitra_detail"),
        formdata
      )
      .then(function (response) {
        $scope.mitra_detail = response.data;
      })
      .catch(function (error) {
        console.error("Terjadi kesalahan:", error);
      });
  };

  $scope.GetMitraDetailDokumen = function (kode_mitra) {
    var formdata = {
      kode_mitra: kode_mitra,
    };

    $http
      .post(
        base_url(
          "profile_pelanggan/kemitraan_reseller/getmitra_detail_document"
        ),
        formdata
      )
      .then(function (response) {
        $scope.mitra_detail_dokumen = response.data;
      })
      .catch(function (error) {
        console.error("Terjadi kesalahan:", error);
      });
  };

  $scope.listDataEdit = [];
  $scope.listDataDocTambahanEdit = [];

  $scope.AddBarisEdit = function () {
    $scope.listDataEdit.push({
      nik: "",
      nama: "",
      no_wa: "",
      email: "",
      npwp: "",
      filename: "",
      posisi: "",
    });
  };

  $scope.HapusBarisEdit = function (index) {
    $scope.listDataEdit.splice(index, 1);
  };

  $scope.EditShow = function (dt) {
    $scope.GetMitraDetailForEdit(dt.kode_mitra);
    $scope.GetMitraDocumentForEdit(dt.kode_mitra);
    $("#My-Modal-Edit").modal("show");
  };

  $scope.setFileName = function (element, item) {
    $scope.$apply(function () {
      const file = element.files[0];
      if (file) {
        item.filename = file.name;
        item.fileObject = file; // optional: simpan file untuk upload
      } else {
        item.filename = "";
        item.fileObject = null;
      }
    });
  };

  $scope.GetMitraDetailForEdit = function (kode_mitra) {
    $scope.listDataEdit = [];
    var formdata = {
      kode_mitra: kode_mitra,
    };

    $http
      .post(
        base_url("profile_pelanggan/kemitraan_reseller/getmitra_detail"),
        formdata
      )
      .then(function (response) {
        var dataList = response.data;

        // Loop jika datanya array
        if (Array.isArray(dataList)) {
          dataList.forEach(function (item) {
            $scope.listDataEdit.push({
              kode_mitra: item.kode_mitra,
              nik: item.nik,
              nama: item.nama,
              no_wa: item.no_wa,
              email: item.email,
              npwp: item.npwp,
              filename: item.filename,
              posisi: item.posisi,
              fileObject: null, // untuk handle file upload jika dibutuhkan
            });
          });
        }
      })
      .catch(function (error) {
        console.error("Gagal mengambil data:", error);
      });
  };

  $scope.GetMitraDocumentForEdit = function (kode_mitra) {
    var formdata = {
      kode_mitra: kode_mitra,
    };

    $http
      .post(
        base_url(
          "profile_pelanggan/kemitraan_reseller/getmitra_detail_document"
        ),
        formdata
      )
      .then(function (response) {
        $scope.listDataDocTambahanEdit = response.data;
      })
      .catch(function (error) {
        console.error("Gagal mengambil data:", error);
      });
  };

  $scope.GetrefCode = function () {
    $http
      .get(base_url("profile_pelanggan/kemitraan_reseller/getrefcode"))
      .then(function (response) {
        $scope.listDataOtc = response.data;
      })
      .catch(function (error) {
        console.error("Gagal mengambil data:", error);
      });
  };

  $scope.GetrefCode();

  $scope.CalculateHargaMonth = function () {
    var harga_dasar =
      parseFloat($("#harga_dasar_price_month").val().replace(/\./g, "")) || 0;
    var harga_jual =
      parseFloat($("#harga_jual_price_month").val().replace(/\./g, "")) || 0;
    var ppn_persen = parseFloat($("#combo_ppn_price_month").val()) || 0;

    // Hitung nominal PPN
    var nominal_ppn = Math.round(harga_jual * (ppn_persen / 100));

    // Hitung subtotal
    var subtotal = harga_jual + nominal_ppn;

    // Tampilkan hasil ke form (dengan format angka Indonesia)
    $("#harga_dasar_price_month").val(formatNumber(harga_dasar));
    $("#harga_jual_price_month").val(formatNumber(harga_jual));
    $("#nominal_ppn_price_month").val(formatNumber(nominal_ppn));
    $("#subtotal_price_month").val(formatNumber(subtotal));
  };

  $(
    "#harga_dasar_price_month, #harga_jual_price_month, #combo_ppn_price_month"
  ).on("input change", function () {
    $scope.CalculateHargaMonth();
  });

  $scope.UpdateSubtotalOtc = function (row) {
    $scope.FormatFieldNumber(row, "price_jual");
    var harga_jual = UnFormatNumber(row.price_jual);
    var ppn = parseFloat(row.combo_ppn) || 0;

    var subtotal = harga_jual + (harga_jual * ppn) / 100;
    row.subtotal = formatNumber(subtotal);
  };

  $scope.FormatFieldNumber = function (row, field) {
    var value = UnFormatNumber(row[field]);
    row[field] = formatNumber(value);
  };
});

function UnFormatNumber(value) {
  if (typeof value === "number") return value;
  if (!value) return 0;
  return parseFloat(value.replace(/\./g, "").replace(/,/g, "."));
}

function formatNumber(value) {
  return value.toLocaleString("id-ID", { minimumFractionDigits: 0 });
}
