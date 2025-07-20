function base_url(string_url) {
  var pathparts = location.pathname.split("/");
  if (location.host == "localhost:8080" || location.host == "10.20.5.104") {
    var url = location.origin + "/" + pathparts[1].trim("/") + "/" + string_url; // http://localhost/myproject/
  } else {
    var url = location.origin + "/" + string_url; // http://stackoverflow.com
  }
  return url;
}

async function login_administrator() {
  var username = $("#username").val();
  var password = $("#password").val();
  var browser = getBrowserName(); // Ambil nama browser

  //   alert(ip_address);
  if (username == "" || password == "") {
    Swal.fire({
      icon: "warning",
      title: "Alert !",
      text: "Wajib Mengisi Username dan Password !",
    });
  } else {
    $.ajax({
      url: base_url("auth/login/check_login"),
      method: "POST",
      data: {
        username: username,
        password: password,
        lokasi: "-", // Bisa diisi dengan koordinat lokasi jika diperlukan
        browser: browser, // Kirim nama browser
      },
      dataType: "JSON",
      success: function (data) {
        if (data.status === "success") {
          Swal.fire({
            icon: "success",
            title: "Berhasil",
            text: "Anda Berhasil Login !",
          });
          document.location.href = base_url("admin");
        } else if (data.status === "user not found") {
          Swal.fire({
            icon: "warning",
            title: "Error",
            text: data.message,
          });
        }
      },
    });
  }
}

function getBrowserName() {
  var userAgent = navigator.userAgent;
  var browserName;

  if (userAgent.indexOf("Edg") > -1) {
    browserName = "Microsoft Edge";
  } else if (userAgent.indexOf("Firefox") > -1) {
    browserName = "Mozilla Firefox";
  } else if (userAgent.indexOf("Opera") > -1 || userAgent.indexOf("OPR") > -1) {
    browserName = "Opera";
  } else if (userAgent.indexOf("Chrome") > -1) {
    browserName = "Google Chrome";
  } else if (userAgent.indexOf("Safari") > -1) {
    browserName = "Safari";
  } else if (
    userAgent.indexOf("MSIE") > -1 ||
    userAgent.indexOf("Trident") > -1
  ) {
    browserName = "Internet Explorer";
  } else {
    browserName = "Unknown";
  }

  return browserName;
}
