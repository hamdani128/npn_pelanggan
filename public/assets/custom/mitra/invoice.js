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
  $scope.LoadDataTransactionOTC = function () {
    $http
      .get(base_url("profile_pelanggan/otc/get_data_transaction"))
      .then(function (response) {
        $scope.TransactionOTC = response.data;
      })
      .catch(function (error) {
        console.log(error);
      });
  };

  $scope.LoadDataTransactionOTC();

  $scope.AddOtcInvoice = function () {
    $scope.get_generate_invoice_otc();
    $("#my-modal-add-otc").modal("show");
  };

  $scope.get_generate_invoice_otc = function () {
    $http
      .get(base_url("profile_pelanggan/otc/get_number_invoice"))
      .then(function (response) {
        document.getElementById("no_invoice_otc").innerText =
          response.data.invoice;
      })
      .catch(function (error) {
        console.log(error);
      });
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
    if (!$scope.selectedKodeMitra) {
      Swal.fire({
        title: "Error",
        text: "Kode mitra tidak boleh kosong",
        icon: "error",
      });
      return;
    }

    $http
      .post(base_url("profile_pelanggan/get_profile_mitra"), {
        kode_mitra: $scope.selectedKodeMitra,
      })
      .then(function (response) {
        $scope.company_otc = response.data.nama_perusahaan;
        $scope.alamat_otc = response.data.alamat;
        $scope.npwp_otc = response.data.npwp;
        $scope.listDataOtcArray = [];
        $scope.get_profile_mitra_otc($scope.selectedKodeMitra);
      })
      .catch(function (error) {
        console.error(error);
      });
  };

  $scope.GetKodeMitra();

  $scope.get_profile_mitra_otc = function (kode_mitra) {
    $http
      .post(base_url("profile_pelanggan/get_profile_mitra_otc"), {
        kode_mitra: kode_mitra,
      })
      .then(function (response) {
        angular.forEach(response.data, function (layanan) {
          $scope.listDataOtcArray.push({
            deskripsi_otc_add: layanan.deskripsi_price,
            price_dasar: formatNumber(layanan.harga_dasar),
            price_jual: formatNumber(layanan.harga_jual),
            combo_ppn: layanan.ppn_text,
            subtotal: formatNumber(layanan.subtotal),
          });
          $scope.UpdateTotalOtc();
        });
      })
      .catch(function (error) {
        console.error(error);
      });
  };

  $scope.listDataOtcArray = [];
  $scope.AddBarisOTC = function () {
    $scope.listDataOtcArray.push({
      deskripsi_otc_add: "",
      price_dasar: "",
      price_jual: "",
      combo_ppn: "",
      subtotal: "",
    });
  };

  // $scope.FormatFieldNumber = function (row, field) {
  //   var value = UnFormatNumber(row[field]);
  //   row[field] = formatNumber(value);
  // };

  // $scope.UpdateSubtotalOtc = function (row) {
  //   $scope.FormatFieldNumber(row, "price_jual");
  //   var harga_jual = UnFormatNumber(row.price_jual);
  //   var ppn = parseFloat(row.combo_ppn) || 0;

  //   var subtotal = harga_jual + (harga_jual * ppn) / 100;
  //   row.subtotal = formatNumber(subtotal);
  // };

  $scope.DeleteOtc = function (index) {
    $scope.listDataOtcArray.splice(index, 1);
    $scope.UpdateSubtotalOtc();
  };

  // Fungsi update subtotal per baris
  $scope.UpdateSubtotalOtc = function (dt) {
    $scope.FormatFieldNumber(dt, "price_jual");
    var priceJual =
      parseInt((dt.price_jual || "0").toString().replace(/\./g, "")) || 0;
    var ppnPersen = parseInt(dt.combo_ppn) || 0;
    var ppnNominal = (priceJual * ppnPersen) / 100;

    dt.subtotal = formatRupiah(priceJual + ppnNominal);

    // setelah hitung per baris, update total semua
    $scope.UpdateTotalOtc();
  };

  // Fungsi update total semua baris
  $scope.UpdateTotalOtc = function () {
    var totalSubtotal = 0;
    var totalPpn = 0;

    $scope.listDataOtcArray.forEach(function (row) {
      var priceJual =
        parseInt((row.price_jual || "0").toString().replace(/\./g, "")) || 0;
      var ppnPersen = parseInt(row.combo_ppn) || 0;
      var ppnNominal = (priceJual * ppnPersen) / 100;

      totalSubtotal += priceJual;
      totalPpn += ppnNominal;
    });

    var grandTotal = totalSubtotal + totalPpn;

    document.getElementById("subtotal-value").innerText =
      formatRupiah(totalSubtotal);
    document.getElementById("ppn-value").innerText = formatRupiah(totalPpn);
    document.getElementById("grandtotal-value").innerText =
      formatRupiah(grandTotal);

    document.getElementById("lb_terbilang").innerText =
      terbilang(grandTotal) + " Rupiah";
  };

  // Fungsi format harga dasar (kalau mau angka tetap format)
  $scope.FormatFieldNumber = function (dt, field) {
    var val = dt[field] || "";
    val = val.toString().replace(/\D/g, "");
    if (val) {
      dt[field] = val.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    } else {
      dt[field] = "";
    }
  };

  $scope.insert_otc = function () {
    var invoice_otc = document.getElementById("no_invoice_otc").innerText;
    var tgl_faktur = $("#tgl_invoice_otc").val();
    var tgl_faktur_tempo = $("#tgl_tempo_otc").val();
    var amount = UnFormatNumber(
      document.getElementById("subtotal-value").innerText
    );
    var ppn = UnFormatNumber(document.getElementById("ppn-value").innerText);
    var grand_total = UnFormatNumber(
      document.getElementById("grandtotal-value").innerText
    );
    var kode_mitra = $scope.selectedKodeMitra;
    var lb_terbilang = document.getElementById("lb_terbilang").innerText;

    // 🔹 Validasi tanggal
    if (tgl_faktur === "" || tgl_faktur_tempo === "") {
      Swal.fire({
        title: "Error",
        text: "Tanggal faktur tidak boleh kosong",
        icon: "error",
      });
      return;
    }

    // 🔹 Validasi tabel tidak kosong
    if (!$scope.listDataOtcArray || $scope.listDataOtcArray.length === 0) {
      Swal.fire({
        title: "Error",
        text: "Data item OTC tidak boleh kosong",
        icon: "error",
      });
      return;
    }

    // alert(amount);
    // alert(ppn);
    // alert(grand_total);

    Swal.fire({
      title: "Apakah anda yakin?",
      text: "Data yang diinputkan akan disimpan?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, simpan",
    }).then((result) => {
      if (result.isConfirmed) {
        var formdata = {
          invoice_otc: invoice_otc,
          tgl_faktur: tgl_faktur,
          tgl_faktur_tempo: tgl_faktur_tempo,
          amount: amount,
          ppn: ppn,
          grand_total: grand_total,
          kode_mitra: kode_mitra,
          grand_total: grand_total,
          terbilang: lb_terbilang,
          detail: $scope.listDataOtcArray,
        };

        $http
          .post(base_url("profile_pelanggan/otc/insert_otc"), formdata)
          .then(function (response) {
            if (response.data.status == "success") {
              Swal.fire({
                title: "Success",
                text: "Data berhasil disimpan",
                icon: "success",
              }).then(function () {
                location.reload();
              });
            } else {
              Swal.fire({
                title: "Error",
                text: response.data.message,
                icon: "error",
              });
            }
          })
          .catch(function (error) {
            console.error(error);
          });
      }
    });
  };

  $scope.PrintOutInvoiceOTC = function (dt) {
    var invoice_otc = dt.invoice;

    // buka tab baru menuju URL backend
    window.open(base_url("print_invoice_otc/" + invoice_otc, "_blank"));
  };

  $scope.ShowEditOTC = function (dt) {
    document.getElementById("no_invoice_otc_edit").innerText = dt.invoice;
    document.getElementById("no_invoice_otc_edit_label").innerHTML = dt.invoice;
    $("#tgl_invoice_otc_edit").val(dt.inv_date);
    $("#tgl_tempo_otc_edit").val(dt.inv_date_tempo);
    $("#kode_mitra_edit").val(dt.kode_mitra);
    $("#company_otc_edit_label").val(dt.nama_perusahaan);
    $("#alamat_otc_edit_label").val(dt.alamat);
    $("#npwp_otc_edit_label").val(dt.npwp);
    $scope.ShowDisplayOTC(dt.kode_mitra);
    $("#my-modal-edit-otc").modal("show");
  };

  $scope.listDataOtcArrayEdit = [];
  $scope.ShowDisplayOTC = function (kode_mitra) {
    var formdata = {
      kode_mitra: kode_mitra,
    };

    $http
      .post(
        base_url("profile_pelanggan/otc/get_data_transaction_by_kode_mitra"),
        formdata
      )
      .then(function (response) {
        angular.forEach(response.data, function (row) {
          $scope.listDataOtcArrayEdit.push({
            deskripsi_otc_edit: row.deskripsi_price,
            price_dasar_edit: formatNumber(row.harga_dasar),
            price_jual_edit: formatNumber(row.harga_jual),
            combo_ppn_edit: row.ppn_text,
            subtotal_edit: formatNumber(row.subtotal),
          });
        });
        $scope.UpdateSubtotalOtcEdit();
      })
      .catch(function (error) {
        console.log(error);
      });
  };

  $scope.UpdateSubtotalOtcEdit = function (dt) {
    if (!dt) {
      // kalau tidak dikasih parameter, update semua
      $scope.listDataOtcArrayEdit.forEach(function (row) {
        $scope.UpdateSubtotalOtcEdit(row);
      });
      return;
    }

    $scope.FormatFieldNumber(dt, "price_jual_edit");
    var priceJual =
      parseInt((dt.price_jual_edit || "0").toString().replace(/\./g, "")) || 0;
    var ppnPersen = parseInt(dt.combo_ppn_edit) || 0;
    var ppnNominal = (priceJual * ppnPersen) / 100;

    dt.subtotal_edit = formatRupiah(priceJual + ppnNominal);

    $scope.UpdateTotalOtcEdit();
  };

  $scope.UpdateTotalOtcEdit = function () {
    var totalSubtotal = 0;
    var totalPpn = 0;

    $scope.listDataOtcArrayEdit.forEach(function (row) {
      var priceJual =
        parseInt((row.price_jual_edit || "0").toString().replace(/\./g, "")) ||
        0;
      var ppnPersen = parseInt(row.combo_ppn_edit) || 0; // pakai _edit
      var ppnNominal = (priceJual * ppnPersen) / 100;

      totalSubtotal += priceJual;
      totalPpn += ppnNominal;
    });

    var grandTotal = totalSubtotal + totalPpn;

    document.getElementById("subtotal-value-edit").innerText =
      formatRupiah(totalSubtotal);
    document.getElementById("ppn-value-edit").innerText =
      formatRupiah(totalPpn);
    document.getElementById("grandtotal-value-edit").innerText =
      formatRupiah(grandTotal);

    document.getElementById("lb_terbilang-edit").innerText =
      terbilang(grandTotal) + " Rupiah";
  };

  $scope.AddBarisOTCEdit = function () {
    $scope.listDataOtcArrayEdit.push({
      deskripsi_otc_edit: "",
      price_dasar_edit: "",
      price_jual_edit: "",
      combo_ppn_edit: "",
      subtotal_edit: "",
    });
  };

  $scope.DeleteOtcEdit = function (index) {
    $scope.listDataOtcArrayEdit.splice(index, 1);
    $scope.UpdateSubtotalOtcEdit();
  };

  $scope.update_otc = function () {
    var invoice_otc = document.getElementById(
      "no_invoice_otc_edit_label"
    ).innerText;
    var tgl_faktur = $("#tgl_invoice_otc_edit").val();
    var tgl_faktur_tempo = $("#tgl_tempo_otc_edit").val();
    var amount = UnFormatNumber(
      document.getElementById("subtotal-value-edit").innerText
    );
    var ppn = UnFormatNumber(
      document.getElementById("ppn-value-edit").innerText
    );
    var grand_total = UnFormatNumber(
      document.getElementById("grandtotal-value-edit").innerText
    );
    var kode_mitra = $("#kode_mitra_edit").val();
    var lb_terbilang = document.getElementById("lb_terbilang-edit").innerText;

    Swal.fire({
      title: "Apakah anda yakin mau update data ini ?",
      text: "Data yang diinputkan akan disimpan !",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, update",
    }).then((result) => {
      if (result.isConfirmed) {
        var formdata = {
          invoice_otc: invoice_otc,
          tgl_faktur: tgl_faktur,
          tgl_faktur_tempo: tgl_faktur_tempo,
          amount: amount,
          ppn: ppn,
          grand_total: grand_total,
          kode_mitra: kode_mitra,
          grand_total: grand_total,
          terbilang: lb_terbilang,
          detail: $scope.listDataOtcArrayEdit,
        };

        $http
          .post(base_url("profile_pelanggan/otc/update_otc"), formdata)
          .then(function (response) {
            if (response.data.status == "success") {
              Swal.fire({
                title: "Success",
                text: "Data berhasil diupdate",
                icon: "success",
              }).then(function () {
                location.reload();
              });
            } else {
              Swal.fire({
                title: "Error",
                text: response.data.message,
                icon: "error",
              });
            }
          })
          .catch(function (error) {
            console.error(error);
          });
      }
    });
  };
});

function formatRupiah(angka) {
  if (!angka) return "Rp.0";
  return "Rp." + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// Fungsi terbilang sederhana (Indonesian)
function terbilang(n) {
  var satuan = [
    "",
    "Satu",
    "Dua",
    "Tiga",
    "Empat",
    "Lima",
    "Enam",
    "Tujuh",
    "Delapan",
    "Sembilan",
    "Sepuluh",
    "Sebelas",
  ];
  n = Math.floor(n);
  if (n < 12) return satuan[n];
  else if (n < 20) return terbilang(n - 10) + " Belas";
  else if (n < 100)
    return terbilang(Math.floor(n / 10)) + " Puluh " + terbilang(n % 10);
  else if (n < 200) return "Seratus " + terbilang(n - 100);
  else if (n < 1000)
    return terbilang(Math.floor(n / 100)) + " Ratus " + terbilang(n % 100);
  else if (n < 2000) return "Seribu " + terbilang(n - 1000);
  else if (n < 1000000)
    return terbilang(Math.floor(n / 1000)) + " Ribu " + terbilang(n % 1000);
  else if (n < 1000000000)
    return (
      terbilang(Math.floor(n / 1000000)) + " Juta " + terbilang(n % 1000000)
    );
  else return "";
}

function formatNumber(value) {
  const number = parseFloat(value);
  if (isNaN(number)) return "";
  return number.toLocaleString("id-ID");
}

function UnFormatNumber(value) {
  if (typeof value === "number") return value; // Kalau sudah number, langsung return
  if (!value) return 0; // Kalau null/undefined/empty, return 0

  return (
    parseFloat(
      value
        .toString()
        .replace(/Rp/gi, "") // hilangkan Rp / rp
        .replace(/\s+/g, "") // hilangkan spasi
        .replace(/\./g, "") // hilangkan titik ribuan
        .replace(/,/g, ".") // ganti koma jadi titik desimal
    ) || 0
  ); // kalau parsing gagal, kembalikan 0
}
