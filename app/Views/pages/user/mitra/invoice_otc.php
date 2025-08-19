<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Laralink">
    <!-- Site Title -->
    <title>Invoice OTC - <?=$invoice?></title>
    <link rel="stylesheet" href="<?=base_url()?>invoice/assets/css/style.css">
    <link rel="shortcut icon" href="<?=base_url()?>assets/images/logo-npn.png">
</head>

<style>
.header-box {
    display: flex;
    justify-content: space-between;
    /* bikin logo kiri, teks kanan */
    align-items: center;
    padding: 20px;
    border: 1px solid #cce;
    background: #f0f7ff;
    /* sama kayak accent bg */
}

.header-box .logo img {
    max-width: 80px;
}

.header-box .company-info {
    text-align: right;
    /* teks rata kanan */
    font-size: 14px;
    line-height: 1.5;
}

.invoice-summary {
    width: 100%;
    border-collapse: collapse;
}

.invoice-summary td {
    padding: 2px 5px;
    border: none !important;
}

.invoice-summary .status-unpaid {
    background: #dc3545;
    color: white;
    padding: 8px 8px;
    border-radius: 10px;
}

.tm_footer_flex {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 10px;
    margin-top: 15px;
}

.tm_transfer_box {
    flex: 1;
    margin-left: -15px;
    border: 2px solid #ccc;
    border-radius: 8px;
    padding: 10px 10px;
    background: #f9f9f9;
    font-size: 14px;
    max-width: 85%;
}

.tm_transfer_box h4 {
    margin: 0 0 8px 0;
    font-size: 15px;
    font-weight: bold;
    color: #000;
}

.tm_transfer_box p {
    margin: 4px 0;
}

.tm_total_box {
    flex: 1;
    max-width: 45%;
}
</style>

<body>
    <div class="tm_container">
        <div class="tm_invoice_wrap">
            <div class="tm_invoice tm_style1 tm_radius_0" id="tm_download_section">
                <div class="tm_invoice_in">
                    <div
                        class="tm_flex tm_flex_column_sm tm_justify_between tm_align_center tm_align_start_sm tm_f14 tm_white_color tm_accent_bg tm_medium tm_padd_8_20 tm_mb25">
                        <p class="tm_m0">Faktur : <?=$invoice_data->inv_date?></p>
                        <p class="tm_m0 tm_f18 tm_bold">Invoice OTC</p>
                        <p class="tm_m0">No Faktur : <?=$invoice_data->invoice?></p>
                    </div>
                    <div class="header-box">
                        <!-- Logo -->
                        <div class="logo">
                            <img src="<?=base_url()?>assets/images/logo-npn.png" alt="Logo">
                        </div>

                        <!-- Company Info -->
                        <div class="company-info">
                            <strong>PT. NETINDO PERSADA NUSANTARA</strong><br>
                            Jl. Cucakrawa I No. 81, Kenangan Baru, Percut Sei Tuan, <br> Deli Serdang, 20371 <br>
                            +62 852 75000 675 <br>
                            <a href="https://npn.net.id">www.npn.net.id</a> <br>
                        </div>
                    </div>

                    <div class="tm_padd_20 tm_border tm_accent_border_20 tm_mb25">
                        <p class="tm_primary_color tm_mb2 tm_f16 tm_bold">Pembeli / Penerima Jasa : </p>
                        <div style="display: flex; justify-content: space-between;">
                            <!-- Kolom Kiri -->
                            <div style="flex: 1; padding-right: 15px; border-right: 1px solid #ddd;">
                                <b class="tm_primary_color"><?=$mitra->nama_perusahaan?></b><br>
                                <?=$mitra->alamat?><br>
                                <?=$mitra->no_hp?>
                            </div>

                            <!-- Kolom Kanan -->
                            <div style="flex: 1; padding-left: 15px;">
                                <table class="invoice-summary">
                                    <tr>
                                        <td style="padding:2px 5px;">Tanggal Faktur Tempo</td>
                                        <td style="padding:2px 5px;">:</td>
                                        <td style="padding:2px 5px;"><?=$invoice_data->inv_date_tempo?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:2px 5px;">Total</td>
                                        <td style="padding:2px 5px;">:</td>
                                        <td style="padding:2px 5px; font-weight:bold; color:blue;">Rp.
                                            <?=number_format($invoice_data->amount_total, 0, ",", ".");?></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:2px 5px;">Payment Method</td>
                                        <td style="padding:2px 5px;">:</td>
                                        <td style="padding:2px 5px;">
                                            <span class="status-unpaid">Unpaid</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tm_table tm_style1 tm_mb40">
                        <div class="tm_round_border tm_accent_border_20 tm_radius_0">
                            <div class="tm_table_responsive">
                                <table>
                                    <thead>
                                        <tr class="tm_accent_bg">
                                            <th class="tm_width_1 tm_semi_bold tm_white_color">No.</th>
                                            <th class="tm_width_6 tm_semi_bold tm_white_color">Description</th>
                                            <th class="tm_width_2 tm_semi_bold tm_white_color">Price</th>
                                            <th class="tm_width_1 tm_semi_bold tm_white_color">PPN (%)</th>
                                            <th class="tm_width_2 tm_semi_bold tm_white_color tm_text_right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($otc as $row): ?>
                                        <tr>
                                            <td class="tm_width_1 tm_accent_border_20">
                                                <?=$no;?>
                                            </td>
                                            <td class="tm_width_6 tm_accent_border_20">
                                                <?=$row->deskripsi_price;?>
                                            </td>
                                            <td class="tm_width_2 tm_accent_border_20 tm_text_right">
                                                <?=number_format($row->harga_jual, 0, ",", ".");?>
                                            </td>
                                            <td class="tm_width_1 tm_accent_border_20 tm_text_center">
                                                <?=number_format($row->ppn_text, 0, ",", ".")?>%
                                            </td>
                                            <td class="tm_width_2 tm_accent_border_20 tm_text_right">
                                                <?=number_format($row->subtotal, 0, ",", ".")?>
                                            </td>
                                        </tr>
                                        <?php $no++; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tm_invoice_footer">
                            <div class="tm_left_footer tm_mobile_hide">
                                <!-- Kotak Transfer -->
                                <div class="tm_transfer_box">
                                    <h4>Mohon ditransfer ke :</h4>
                                    <p><b>Bank:</b> BANK RAKYAT INDONESIA (BRI)</p>
                                    <p><b>Account No:</b> 036701002596566</p>
                                    <p><b>Account Name:</b> An. Netindo Persada Nusantara</p>
                                </div>
                            </div>
                            <div class="tm_right_footer">
                                <table>
                                    <tbody>
                                        <tr class="tm_border_left tm_border_right tm_accent_border_20">
                                            <td
                                                class="tm_width_3 tm_primary_color tm_accent_border_20 tm_border_none tm_bold">
                                                Subtotal</td>
                                            <td
                                                class="tm_width_3 tm_primary_color tm_accent_border_20 tm_text_right tm_border_none tm_bold">
                                                <?=number_format($invoice_data->amount, 0, ",", ".");?>
                                            </td>
                                        </tr>
                                        <tr class="tm_border_left tm_border_right tm_accent_border_20">
                                            <td class="tm_width_3 tm_primary_color tm_accent_border_20">
                                                Tax <span class="tm_ternary_color">(11%)</span>
                                            </td>
                                            <td class="tm_width_3 tm_primary_color tm_accent_border_20 tm_text_right">
                                                <?=number_format($invoice_data->ppn, 0, ",", ".");?>
                                            </td>
                                        </tr>
                                        <tr
                                            class="tm_border_bottom tm_border_left tm_border_right tm_accent_border_20 tm_accent_bg">
                                            <td class="tm_width_3 tm_bold tm_f16 tm_white_color tm_accent_border_20">
                                                Grand Total </td>
                                            <td
                                                class="tm_width_3 tm_bold tm_f16 tm_white_color tm_accent_border_20 tm_text_right">
                                                <?=number_format($invoice_data->amount_total, 0, ",", ".");?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <p class="tm_bold tm_primary_color tm_m0">Terms and conditions</p>
                    <p class="tm_m0">Delivery dates are not guaranteed and Seller has no liability for damages that may
                        be incurred due to any delay in shipment of goods hereunder. Taxes are excluded unless otherwise
                        stated.</p>
                </div>
            </div>
            <div class="tm_invoice_btns tm_hide_print">
                <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
                    <span class="tm_btn_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                            <path
                                d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24"
                                fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                            <rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none"
                                stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                            <path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none"
                                stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
                            <circle cx="392" cy="184" r="24" fill='currentColor' />
                        </svg>
                    </span>
                    <span class="tm_btn_text">Print</span>
                </a>
                <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
                    <span class="tm_btn_icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                            <path
                                d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="32" />
                        </svg>
                    </span>
                    <span class="tm_btn_text">Download</span>
                </button>
            </div>
        </div>
    </div>
    <script data-cfasync="false"
        src="<?=base_url()?>invoice/assets/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="<?=base_url()?>invoice/assets/js/jquery.min.js"></script>
    <script src="<?=base_url()?>invoice/assets/js/jspdf.min.js"></script>
    <script src="<?=base_url()?>invoice/assets/js/html2canvas.min.js"></script>
    <script src="<?=base_url()?>invoice/assets/js/main.js"></script>
    <script>
    (function() {
        function c() {
            var b = a.contentDocument || a.contentWindow.document;
            if (b) {
                var d = b.createElement('script');
                d.innerHTML =
                    "window.__CF$cv$params={r:'96fec3749dee44a3',t:'MTc1NTMyNDU3Mg=='};var a=document.createElement('script');a.src='../cdn-cgi/challenge-platform/h/b/scripts/jsd/4710d66e8fda/maind41d.js';document.getElementsByTagName('head')[0].appendChild(a);";
                b.getElementsByTagName('head')[0].appendChild(d)
            }
        }
        if (document.body) {
            var a = document.createElement('iframe');
            a.height = 1;
            a.width = 1;
            a.style.position = 'absolute';
            a.style.top = 0;
            a.style.left = 0;
            a.style.border = 'none';
            a.style.visibility = 'hidden';
            document.body.appendChild(a);
            if ('loading' !== document.readyState) c();
            else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c);
            else {
                var e = document.onreadystatechange || function() {};
                document.onreadystatechange = function(b) {
                    e(b);
                    'loading' !== document.readyState && (document.onreadystatechange = e, c())
                }
            }
        }
    })();
    </script>
    <script defer
        src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
        integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
        data-cf-beacon='{"version":"2024.11.0","token":"6f756f02820545e3be40ddc6eb6154c3","r":1,"server_timing":{"name":{"cfCacheStatus":true,"cfEdge":true,"cfExtPri":true,"cfL4":true,"cfOrigin":true,"cfSpeedBrain":true},"location_startswith":null}}'
        crossorigin="anonymous"></script>
</body>

<!-- Mirrored from html.laralink.com/invoma/general_8.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 16 Aug 2025 06:09:35 GMT -->

</html>