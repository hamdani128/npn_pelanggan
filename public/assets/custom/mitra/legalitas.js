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
  $scope.listDataEdit = [];
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
        harga_dasar: UnFormatNumber(cells3[2].querySelector("input").value),
        harga_jual: UnFormatNumber(cells3[3].querySelector("input").value),
        ppn: cells3[4].querySelector("select").value,
        subtotal: UnFormatNumber(cells3[5].querySelector("input").value),
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
      UnFormatNumber($("#harga_dasar_price_month").val())
    );
    formData.append(
      "harga_jual_price_month",
      UnFormatNumber($("#harga_jual_price_month").val())
    );
    formData.append(
      "ppn_text_price_month",
      UnFormatNumber($("#combo_ppn_price_month").val())
    );
    formData.append(
      "nominal_ppn_price_month",
      UnFormatNumber($("#nominal_ppn_price_month").val())
    );
    formData.append(
      "subtotal_price_month",
      UnFormatNumber($("#subtotal_price_month").val())
    );
    formData.append(
      "start_date_price_month",
      $("#start_date_price_month").val()
    );
    formData.append("end_date_price_month", $("#end_date_price_month").val());
    formData.append(
      "pembayaran_paling_lama_month",
      $("#pembayaran_paling_lama_month").val()
    );

    // OTC Data Table
    var tbody4 = document.getElementById("tbody-RefrencePeriode");
    var rows4 = tbody4.getElementsByTagName("tr");
    var refrencedata = [];

    for (var i = 0; i < rows4.length; i++) {
      var cell4 = rows4[i].getElementsByTagName("td");

      var rowData4 = {
        deskripsi: cell4[0].querySelector("label").textContent.trim(),
        harga_dasar: UnFormatNumber(cell4[1].querySelector("input").value),
        harga_jual: UnFormatNumber(cell4[2].querySelector("input").value),
        ppn_text: UnFormatNumber(cell4[3].querySelector("input").value) || 0, // ✅ FIX INI
        subtotal: UnFormatNumber(cell4[4].querySelector("input").value),
        periode: cell4[5].querySelector("input").value,
        payment_late_date: cell4[6].querySelector("input").value,
        denda: UnFormatNumber(cell4[7].querySelector("input").value),
      };

      refrencedata.push(rowData4);
    }

    formData.append("refrencedata", JSON.stringify(refrencedata));

    Swal.fire({
      title: "Apakah anda yakin ?",
      text: "Data yang diinputkan akan disimpan ?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Simpan!",
    }).then((result) => {
      if (result.isConfirmed) {
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
      }
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
          ppn_text_price_month_periode: ppn,
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
    $scope.GetMitraDataLayanan(dt.kode_mitra);
    $scope.GetMitraDataLayananTableRefrence(dt.kode_mitra);
    $scope.GetMitraDataLayananOTC(dt.kode_mitra);
    $("#My-Modal-Show-Profile").modal("show");
  };

  $scope.GetMitraDataLayanan = function (kode_mitra) {
    var formdata = {
      kode_mitra: kode_mitra,
    };

    $http
      .post(
        base_url("profile_pelanggan/kemitraan_reseller/getmitra_data_layanan"),
        formdata
      )
      .then(function (response) {
        $scope.jenis_layanan_priview = response.data.jenis_layanan;
        $scope.kapasitas_layanan_priview = response.data.kapasitas;
        $scope.satuan_priview = response.data.quantity;
        $scope.vendor_media_priview = response.data.vendor;
        $scope.deskripsi_price_month_priview = response.data.deskripsi_price;
        $scope.harga_dasar_price_month_priview = formatNumber(
          response.data.harga_dasar
        );
        $scope.harga_jual_price_month_priview = formatNumber(
          response.data.harga_jual
        );
        $scope.combo_ppn_price_month_priview = response.data.ppn_text;
        $scope.nominal_ppn_price_month_priview = formatNumber(
          response.data.ppn
        );
        $scope.subtotal_price_month_priview = formatNumber(
          response.data.subtotal
        );

        $scope.start_date_price_month_priview = response.data.period_start;
        $scope.end_date_price_month_priview = response.data.period_end;
      })
      .catch(function (error) {
        console.error("Terjadi kesalahan:", error);
      });
  };

  $scope.GetMitraDataLayananTableRefrence = function (kode_mitra) {
    var formdata = {
      kode_mitra: kode_mitra,
    };

    $http
      .post(
        base_url(
          "profile_pelanggan/kemitraan_reseller/getmitra_data_layanan_refrence_table"
        ),
        formdata
      )
      .then(function (response) {
        $scope.ListDataArrayRefrencePeriodePriview = response.data;
      })
      .catch(function (error) {
        console.error("Terjadi kesalahan:", error);
      });
  };

  $scope.GetMitraDataLayananOTC = function (kode_mitra) {
    var formdata = {
      kode_mitra: kode_mitra,
    };

    $http
      .post(
        base_url(
          "profile_pelanggan/kemitraan_reseller/getmitra_data_layanan_otc"
        ),
        formdata
      )
      .then(function (response) {
        $scope.listDataOtcPreview = response.data;
      })
      .catch(function (error) {
        console.error("Terjadi kesalahan:", error);
      });
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

  $scope.formatNumber = function (value) {
    if (value === null || value === undefined || value === "") return "0";
    var number = parseFloat(value);
    if (isNaN(number)) return value;

    return number
      .toFixed(0) // pakai dua desimal
      .replace(".", ",") // ganti titik jadi koma
      .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
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
    $scope.mitra_id_edit = dt.kode_mitra;
    $scope.nama_perusahaan_edit = dt.nama_perusahaan;
    $scope.no_kontak_edit = dt.no_hp;
    $scope.email_edit = dt.email;
    $scope.alamat_perusahaan_edit = dt.alamat;
    $scope.alamat_instalasi_edit = dt.alamat_instalasi;
    $scope.GetMitraDetailForEdit(dt.kode_mitra);
    $scope.GetMitraDataLayananForEdit(dt.kode_mitra);
    $scope.GetMitraDataLayananTableRefrenceForEdit(dt.kode_mitra);
    $scope.GetMitraDataLayananOTCForEdit(dt.kode_mitra);
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

  $scope.GetMitraDataLayananForEdit = function (kode_mitra) {
    var formdata = {
      kode_mitra: kode_mitra,
    };

    $http
      .post(
        base_url("profile_pelanggan/kemitraan_reseller/getmitra_data_layanan"),
        formdata
      )
      .then(function (response) {
        $scope.jenis_layanan_edit = response.data.jenis_layanan;
        $scope.kapasitas_layanan_edit = response.data.kapasitas;
        $scope.satuan_layanan_edit = response.data.quantity;
        $scope.vendor_media_edit = response.data.vendor;
        $scope.deskripsi_price_month_edit = response.data.deskripsi_price;
        $scope.harga_dasar_price_month_edit = formatNumber(
          response.data.harga_dasar
        );
        $scope.harga_jual_price_month_edit = formatNumber(
          response.data.harga_jual
        );
        $scope.combo_ppn_price_month_edit = response.data.ppn_text;
        $scope.nominal_ppn_price_month_edit = formatNumber(response.data.ppn);
        $scope.subtotal_price_month_edit = formatNumber(response.data.subtotal);

        $scope.start_date_price_month_edit = new Date(
          response.data.period_start
        );
        $scope.end_date_price_month_edit = new Date(response.data.period_end);
      })
      .catch(function (error) {
        console.error("Terjadi kesalahan:", error);
      });
  };

  $scope.GetMitraDataLayananTableRefrenceForEdit = function (kode_mitra) {
    var formdata = {
      kode_mitra: kode_mitra,
    };

    $http
      .post(
        base_url(
          "profile_pelanggan/kemitraan_reseller/getmitra_data_layanan_refrence_table"
        ),
        formdata
      )
      .then(function (response) {
        $scope.ListDataArrayRefrencePeriodeEdit = response.data;
      })
      .catch(function (error) {
        console.error("Terjadi kesalahan:", error);
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

  $scope.GetMitraDataLayananOTCForEdit = function (kode_mitra) {
    var formdata = {
      kode_mitra: kode_mitra,
    };

    $http
      .post(
        base_url(
          "profile_pelanggan/kemitraan_reseller/getmitra_data_layanan_otc"
        ),
        formdata
      )
      .then(function (response) {
        $scope.listDataOtcEdit = response.data;
      })
      .catch(function (error) {
        console.error("Terjadi kesalahan:", error);
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

  $scope.SetTableRefrencePeriodeEdit = function () {
    $scope.ListDataArrayRefrencePeriodeEdit = [];

    var start = $scope.start_date_price_month_edit;
    var End = $scope.end_date_price_month_edit;
    var Deskripsi = $scope.deskripsi_price_month_edit;
    var harga_dasar = $scope.harga_dasar_price_month_edit;
    var harga_jual = $scope.harga_jual_price_month_edit;
    var ppn = parseFloat($scope.combo_ppn_price_month_edit) || 0;
    var pembayaran_paling_lama =
      parseInt($("#pembayaran_paling_lama_month_edit").val()) || 0;

    // Ubah harga dasar dan jual dari format string ke number
    var harga_dasar_number = UnFormatNumber(harga_dasar);
    var harga_jual_number = UnFormatNumber(harga_jual);

    // alert(harga_dasar_number);
    // alert(harga_jual_number);

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

        $scope.ListDataArrayRefrencePeriodeEdit.push({
          deskripsi_price: Deskripsi,
          harga_dasar: harga_dasar_number,
          harga_jual: harga_jual_number,
          ppn_text: ppn,
          subtotal: subtotal,
          periode: periode,
          last_pay_periode: payment_late_date,
          payment_late_days: pembayaran_paling_lama - 1, // karena periode awal selalu tanggal 1
          denda: 0,
        });

        current.setMonth(current.getMonth() + 1);
      }
    }
  };

  $scope.Update = function () {
    var formData = new FormData();
    formData.append("mitra_id", $scope.mitra_id_edit);
    formData.append("perusahaan", $scope.nama_perusahaan_edit);
    formData.append("email", $scope.email_edit);
    formData.append("no_kontak", $scope.no_kontak_edit);
    formData.append("alamat_perusahaan", $scope.alamat_perusahaan_edit);
    formData.append("alamat_instalasi", $scope.alamat_instalasi_edit);

    // Handle struktural
    var tbody1 = document.getElementById("tbody-struktural-edit");
    var rows1 = tbody1.getElementsByTagName("tr");
    var detail_struktural_edit = [];

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

      detail_struktural_edit.push(rowData);

      var file = cells[7].querySelector("input").files[0];
      if (file) {
        formData.append("struktural_file_" + i, file);
      }
    }

    formData.append("struktural", JSON.stringify(detail_struktural_edit));

    // Handle tambahan
    var tbody2 = document.getElementById("tbody-tambahan-edit");
    var rows2 = tbody2.getElementsByTagName("tr");
    var tambahanDokumenEdit = [];

    for (var i = 0; i < rows2.length; i++) {
      var cells2 = rows2[i].getElementsByTagName("td");

      var rowData2 = {
        dokumen_id: cells2[1].querySelector("input").value,
        jenis_dokumen: cells2[2].querySelector("input").value,
      };

      tambahanDokumenEdit.push(rowData2);

      var file_dokumen = cells2[3].querySelector("input").files[0];
      if (file_dokumen) {
        formData.append("tambahan_file_" + i, file_dokumen);
      }
    }

    formData.append("tambahan_file_data", JSON.stringify(tambahanDokumenEdit));

    // OTC Data Table
    var tbody3 = document.getElementById("tbody-otc-edit");
    var rows3 = tbody3.getElementsByTagName("tr");
    var otdataEdit = [];

    for (var i = 0; i < rows3.length; i++) {
      var cells3 = rows3[i].getElementsByTagName("td");

      var rowData3 = {
        deskripsi: cells3[1].querySelector("label").textContent.trim(), // ambil isi label
        harga_dasar: UnFormatNumber(cells3[2].querySelector("input").value),
        harga_jual: UnFormatNumber(cells3[3].querySelector("input").value),
        ppn: cells3[4].querySelector("select").value,
        subtotal: UnFormatNumber(cells3[5].querySelector("input").value),
      };

      otdataEdit.push(rowData3);
    }

    formData.append("otc_data", JSON.stringify(otdataEdit));
    formData.append("jenis_layanan", $scope.jenis_layanan_edit);
    formData.append("satuan_layanan", $scope.satuan_layanan_edit);
    formData.append("kapasitas_layanan", $scope.kapasitas_layanan_edit);
    formData.append("vendor_media", $scope.vendor_media_edit);
    formData.append("deskripsi_price_month", $scope.deskripsi_price_month_edit);
    formData.append(
      "harga_dasar_price_month",
      UnFormatNumber($scope.harga_dasar_price_month_edit)
    );
    formData.append(
      "harga_jual_price_month",
      UnFormatNumber($scope.harga_jual_price_month_edit)
    );
    formData.append(
      "ppn_text_price_month",
      UnFormatNumber($scope.combo_ppn_price_month_edit)
    );
    formData.append(
      "nominal_ppn_price_month",
      UnFormatNumber($scope.nominal_ppn_price_month_edit)
    );
    formData.append(
      "subtotal_price_month",
      UnFormatNumber($scope.subtotal_price_month_edit)
    );
    formData.append(
      "start_date_price_month",
      $scope.start_date_price_month_edit
    );
    formData.append("end_date_price_month", $scope.end_date_price_month_edit);
    formData.append(
      "pembayaran_paling_lama_month",
      $scope.pembayaran_paling_lama_month_edit
    );
    // OTC Data Table
    var tbody4 = document.getElementById("tbody-RefrencePeriode-Edit");
    var rows4 = tbody4.getElementsByTagName("tr");
    var refrencedataEdit = [];

    for (var i = 0; i < rows4.length; i++) {
      var cell4 = rows4[i].getElementsByTagName("td");

      var rowData4 = {
        deskripsi: cell4[0].querySelector("label").textContent.trim(),
        harga_dasar: UnFormatNumber(cell4[1].querySelector("input").value),
        harga_jual: UnFormatNumber(cell4[2].querySelector("input").value),
        ppn_text: UnFormatNumber(cell4[3].querySelector("input").value) || 0, // ✅ FIX INI
        subtotal: UnFormatNumber(cell4[4].querySelector("input").value),
        periode: cell4[5].querySelector("input").value,
        payment_late_date: cell4[6].querySelector("input").value,
        denda: UnFormatNumber(cell4[7].querySelector("input").value),
      };

      refrencedataEdit.push(rowData4);
    }

    formData.append("refrencedata", JSON.stringify(refrencedataEdit));

    Swal.fire({
      title: "Apakah anda yakin Merubah Data ini ?",
      text: "Data yang diinputkan akan Dirubah secara permanen !",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Update!",
    }).then((result) => {
      if (result.isConfirmed) {
        fetch(base_url("profile_pelanggan/kemitraan_reseller/update"), {
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
                text: "Data berhasil Dirubah !",
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
      }
    });
  };

  $scope.Print = function (dt) {
    var kode_mitra = dt.kode_mitra;
    // Langsung arahkan ke URL yang sesuai dengan route
    var url = base_url(
      "profile_pelanggan/kemitraan_reseller/" + encodeURIComponent(kode_mitra)
    );
    // Buka di tab baru
    window.open(url, "_blank");
  };

  $scope.ActivateAccount = function (dt) {
    if (dt.status_account == "0") {
      Swal.fire({
        title: "Aktifkan Akun Mitra?",
        text: "Akun mitra akan diaktifkan secara otomatis setelah anda mengisi data diri.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Aktifkan !",
      }).then((result) => {
        if (result.isConfirmed) {
          // Tampilkan modal loading
          Swal.fire({
            title: "Memproses...",
            html: "Mohon tunggu sebentar",
            allowOutsideClick: false,
            didOpen: () => {
              Swal.showLoading();
            },
          });

          var formdata = {
            kode_mitra: dt.kode_mitra,
          };

          $http
            .post(
              base_url("profile_pelanggan/kemitraan_reseller/activate_account"),
              formdata
            )
            .then(function (response) {
              if (response.data.status === "success") {
                Swal.fire({
                  icon: "success",
                  title: "Berhasil",
                  text: "Akun mitra berhasil diaktifkan!",
                  showConfirmButton: false,
                  timer: 1500,
                }).then(() => {
                  location.reload();
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
      });
    }
  };

  $scope.NonActiveAccount = function (dt) {
    if (dt.status_account == "1") {
      Swal.fire({
        title: "Nonaktifkan Akun Mitra ?",
        text:
          "Akun mitra akan dinonaktifkan " +
          dt.nama_perusahaan +
          "  secara otomatis.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Nonaktifkan !",
      }).then((result) => {
        if (result.isConfirmed) {
          // Tampilkan modal loading
          Swal.fire({
            title: "Memproses...",
            html: "Mohon tunggu sebentar",
            allowOutsideClick: false,
            didOpen: () => {
              Swal.showLoading();
            },
          });

          var formdata = {
            kode_mitra: dt.kode_mitra,
          };
          $http
            .post(
              base_url(
                "profile_pelanggan/kemitraan_reseller/nonactive_account"
              ),
              formdata
            )
            .then(function (response) {
              if (response.data.status === "success") {
                Swal.fire({
                  icon: "success",
                  title: "Berhasil",
                  text: "Akun mitra berhasil dinonaktifkan!",
                  showConfirmButton: false,
                  timer: 1500,
                }).then(() => {
                  location.reload();
                });
              } else {
                Swal.fire({
                  icon: "error",
                  title: "Gagal",
                  text: response.data.message || "Nonaktifkan gagal.",
                });
              }
            })
            .catch(function (error) {
              console.error("Gagal menonaktifkan akun:", error);
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "Terjadi kesalahan sistem.",
              });
            });
        }
      });
    }
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
        title: "Hapus Akun Mitra ?",
        text:
          "Akun mitra " + dt.nama_perusahaan + " akan dihapus secara permanen.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Hapus !",
      }).then((result) => {
        if (result.isConfirmed) {
          // Tampilkan modal loading
          Swal.fire({
            title: "Memproses...",
            html: "Mohon tunggu sebentar",
            allowOutsideClick: false,
            didOpen: () => {
              Swal.showLoading();
            },
          });

          var formdata = {
            kode_mitra: dt.kode_mitra,
          };
          $http
            .post(
              base_url("profile_pelanggan/kemitraan_reseller/delete"),
              formdata
            )
            .then(function (response) {
              if (response.data.status === "success") {
                Swal.fire({
                  icon: "success",
                  title: "Berhasil",
                  text: "Akun mitra berhasil dihapus!",
                  showConfirmButton: false,
                  timer: 1500,
                }).then(() => {
                  location.reload();
                });
              } else {
                Swal.fire({
                  icon: "error",
                  title: "Gagal",
                  text: response.data.message || "Hapus gagal.",
                });
              }
            })
            .catch(function (error) {
              console.error("Gagal menghapus akun:", error);
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "Terjadi kesalahan sistem.",
              });
            });
        }
      });
    }
  };

  $scope.selectedRow = null;

  $scope.selectRow = function (row) {
    $scope.selectedRow = row;
    // Contoh log (opsional)
    document.location.href = base_url(
      "profile_pelanggan/kemitraan_reseller/detail/" + row.kode_mitra
    );
  };

  $scope.backToKemitraan = function () {
    document.location.href = base_url("profile_pelanggan/kemitraan_reseller");
  };
});

function UnFormatNumber(value) {
  if (typeof value === "number") return value;
  if (!value) return 0;
  return parseFloat(value.replace(/\./g, "").replace(/,/g, "."));
}

function formatNumber(value) {
  if (value == null || value == "" || isNaN(value)) return "0";
  value = parseFloat(value);
  return value
    .toFixed(0) // tanpa desimal
    .replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}
