/*----------------------------------------------
    Index Of Script
------------------------------------------------

    @version         : 1.0.0
    @Template Name   : initBill - invoice & Receipt HTML Template.
    @Template author : https://themeforest.net/user/inittheme
    

    :: Sticky And Scroll Up                      
    :: slick Nav                      
    :: WOW active                      
    :: Documentation sidebar                      
    :: html2canvas                      

------------------------------------------------
    End-of Script
------------------------------------------------*/

(function ($) {
	"use strict";

	/*----------------------------------------------
        Sticky And Scroll Up 
    ----------------------------------------------*/
	$(window).on("scroll", function () {
		var scroll = $(window).scrollTop();
		if (scroll < 400) {
			$(".header-sticky").removeClass("sticky-bar");
			$("#back-top").fadeOut(500);
		} else {
			$(".header-sticky").addClass("sticky-bar");
			$("#back-top").fadeIn(500);
		}
	});

	/*-----------------------------------
        slick Nav
    -----------------------------------*/
	var menu = $("ul#navigation");
	if (menu.length) {
		menu.slicknav({
			prependTo: ".mobile_menu",
			closedSymbol: "+",
			openedSymbol: "-",
		});
	}

	/*-----------------------------------
        WOW active
    -----------------------------------*/
	new WOW().init();

	/*----------------------------------------------
       Documentation sidebar
    ----------------------------------------------*/
	$(document).on("click", ".close-sidebar, .sidebar-body-overlay", function () {
		$(
			".panel-sidebar-close, .panel-sidebar, .sidebar-body-overlay"
		).removeClass("active");
	});
	$(document).on("click", ".sidebar-icon", function () {
		$(".panel-sidebar-close, .panel-sidebar, .sidebar-body-overlay").addClass(
			"active"
		);
	});

	/*----------------------------------------------
        Documentation Chick Menu
    ----------------------------------------------*/
	$(document).on("click", ".doc-list-wrapper .single-list .items", function () {
		$(".doc-list-wrapper .single-list .items").removeClass("selected");
	});
	$(document).on("click", ".doc-list-wrapper .single-list .items", function () {
		$(this).addClass("selected");
	});

	/*----------------------------------------------
        html2canvas
    ----------------------------------------------*/
	// $("#bill-download").on("click", function () {
	// 	var downloadSection = $("#download-section");
	// 	var nama_document = document.getElementById("no_invoice").innerHTML;
	// 	var cWidth = downloadSection.width();
	// 	var cHeight = downloadSection.height();
	// 	var topLeftMargin = 0;
	// 	var pdfWidth = cWidth + topLeftMargin * 2;
	// 	var pdfHeight = pdfWidth * 1.5 + topLeftMargin * 2;
	// 	var canvasImageWidth = cWidth;
	// 	var canvasImageHeight = cHeight;
	// 	var totalPDFPages = Math.ceil(cHeight / pdfHeight) - 1;
	// 	html2canvas(downloadSection[0], {
	// 		scale: 2,
	// 		useCORS: true,
	// 	}).then(function (canvas) {
	// 		var imgData = canvas.toDataURL("image/png");
	// 		var pdf = new jsPDF("p", "pt", "a4");

	// 		var pageWidth = pdf.internal.pageSize.width;
	// 		var pageHeight = pdf.internal.pageSize.height;

	// 		var canvasWidth = canvas.width;
	// 		var canvasHeight = canvas.height;

	// 		var ratio = canvasWidth / canvasHeight;
	// 		var imgHeight = pageWidth / ratio;

	// 		var position = 0;
	// 		pdf.addImage(imgData, "PNG", 0, position, pageWidth, imgHeight);

	// 		// Multi-page jika lebih dari satu halaman
	// 		while (imgHeight > pageHeight) {
	// 			position -= pageHeight;
	// 			pdf.addPage();
	// 			pdf.addImage(imgData, "PNG", 0, position, pageWidth, imgHeight);
	// 			imgHeight -= pageHeight;
	// 		}

	// 		pdf.save(nama_document + ".pdf");
	// 	});
	// });
	$("#bill-download").on("click", function () {
		var element = document.getElementById("download-section");

		var opt = {
			margin: [0.5, 0.5, 0.5, 0.5], // top, left, bottom, right (inch)
			filename: document.getElementById("no_invoice").innerText + ".pdf",
			image: { type: "jpeg", quality: 1 },
			html2canvas: { scale: 2, useCORS: true },
			jsPDF: { unit: "in", format: "a4", orientation: "portrait" },
		};

		html2pdf().from(element).set(opt).save();
	});
})(jQuery);
