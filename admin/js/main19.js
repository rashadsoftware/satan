// delete with ajax
function deleteAjax(id, postURL, alertNotification) {
	var action = "delete";

	if (confirm("Silmək istədiyinizdən əminsinizmi?")) {
		$.ajax({
			url: postURL,
			method: "POST",
			data: { category_id: id, action: action },
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					document
						.getElementById(alertNotification)
						.classList.remove("alert-danger");
					document
						.getElementById(alertNotification)
						.classList.add("alert-success");
					document.getElementById(alertNotification).innerHTML = data.text;
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					document
						.getElementById(alertNotification)
						.classList.remove("alert-success");
					document
						.getElementById(alertNotification)
						.classList.add("alert-danger");
					document.getElementById(alertNotification).innerHTML = data.text;
				}

				document.getElementById(alertNotification).style.display = "block";
			},
		});
	}
}

// go with ajax
function goAjax(id, postURL, alertNotification) {
	var action = "update";

	$.ajax({
		url: postURL,
		method: "POST",
		data: { category_id: id, action: action },
		dataType: "json",
		success: function (data) {
			if (data.ok) {
				document
					.getElementById(alertNotification)
					.classList.remove("alert-danger");
				document
					.getElementById(alertNotification)
					.classList.add("alert-success");
				document.getElementById(alertNotification).innerHTML = data.text;
				setTimeout(function () {
					location.reload();
				}, 2000);
			} else {
				document
					.getElementById(alertNotification)
					.classList.remove("alert-success");
				document
					.getElementById(alertNotification)
					.classList.add("alert-danger");
				document.getElementById(alertNotification).innerHTML = data.text;
			}

			document.getElementById(alertNotification).style.display = "block";
		},
	});
}

// Jquery
$(function () {
	/* [ Login page ] 
	======================================================================>  */
	// Show Hide Password
	$("#password_show_hide").click(function () {
		$(this).toggleClass("fa-eye-slash");
		var input_password = $("#password");

		if (input_password.attr("type") == "password") {
			input_password.attr("type", "text");
		} else {
			input_password.attr("type", "password");
		}
	});

	// Login Form
	$(".login-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/loginDB.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					window.location.assign("dashboard");
				}
				if (data.err) {
					window.location.assign("closeAdmin");
				} else {
					$("#alertLogin").css("display", "block");
					$("#alertLogin").html(data.text);
				}
			},
		});
	});

	/* [ Legv etme sayfasi ] 
	================================================================>  */
	// get ID in modal
	$(".cancelBtn").on("click", function () {
		// Get id
		var idElan = $(this).attr("data-id");

		$.ajax({
			url: "php/dataCancelElan.php",
			type: "post",
			data: { idElan: idElan },
			success: function (data) {
				$("#modal-default").modal("show");
				$("#hiddenCancel").val(data);
			},
		});
	});

	// Legv Etme Formu elanlar sayfasinda
	$(".legv-etme-form").on("submit", function (e) {
		e.preventDefault();

		$("#modal-default").modal("hide");

		$.ajax({
			url: "php/addCreateOtmenit.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertElanlar").removeClass("alert-danger");
					$("#alertElanlar").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertElanlar").removeClass("alert-success");
					$("#alertElanlar").addClass("alert-danger");
				}

				$("#alertElanlar").css("display", "block");
				$("#alertElanlar").html(data.text);
			},
		});
	});

	// Legv Etme Formu elan detay gorunum sayfasinda
	$(".legv-etme-form2").on("submit", function (e) {
		e.preventDefault();

		$("#modal-default").modal("hide");

		$.ajax({
			url: "php/addCreateOtmenit.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertElanDetaylar").removeClass("alert-danger");
					$("#alertElanDetaylar").addClass("alert-success");
					setTimeout(function () {
						location.href = "elanlar";
					}, 2000);
				} else {
					$("#alertElanDetaylar").removeClass("alert-success");
					$("#alertElanDetaylar").addClass("alert-danger");
				}

				$("#alertElanDetaylar").css("display", "block");
				$("#alertElanDetaylar").html(data.text);
			},
		});
	});

	// Advert Image Form
	$("#itemImage").change(function () {
		$("#upload_form_image").submit();
	});
	$("#upload_form_image").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/insertImageToDatabaseForAdd.php",
			type: "post",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertElanDetaylar").removeClass("alert-danger");
					$("#alertElanDetaylar").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertElanDetaylar").removeClass("alert-success");
					$("#alertElanDetaylar").addClass("alert-danger");
				}

				$("#alertElanDetaylar").css("display", "block");
				$("#alertElanDetaylar").html(data.text);
			},
		});
	});

	// Advert Image Remove
	$(".delImage").on("click", function (e) {
		var getId = $(this).attr("id");
		var action = "removeImage";

		$.ajax({
			url: "php/removeImageInAddDetail.php",
			type: "post",
			data: { getId: getId, action: action },
			dataType: "json",
			beforeSend: function () {
				$(".preloader").css("display", "block");
				$("body").addClass("overhidden ");
			},
			success: function (data) {
				if (data.ok) {
					$("#alertElanDetaylar").removeClass("alert-danger");
					$("#alertElanDetaylar").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertElanDetaylar").removeClass("alert-success");
					$("#alertElanDetaylar").addClass("alert-danger");
				}

				$("#alertElanDetaylar").css("display", "block");
				$("#alertElanDetaylar").html(data.text);

				$(".preloader").css("display", "none");
				$("body").removeClass("overhidden ");
			},
		});
	});

	/* [ Update Elan page ] 
	================================================================>  */
	// Update Optional Information Form
	$(".update-optInfor-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/addUpdateOptionalInformation.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertElanYenileme").removeClass("alert-danger");
					$("#alertElanYenileme").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertElanYenileme").removeClass("alert-success");
					$("#alertElanYenileme").addClass("alert-danger");
				}

				$("#alertElanYenileme").css("display", "block");
				$("#alertElanYenileme").html(data.text);
			},
		});
	});
	// Update Elan Detail Form
	$(".update-elanDetail-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/addUpdateElanDeatoil.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertElanYenileme").removeClass("alert-danger");
					$("#alertElanYenileme").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertElanYenileme").removeClass("alert-success");
					$("#alertElanYenileme").addClass("alert-danger");
				}

				$("#alertElanYenileme").css("display", "block");
				$("#alertElanYenileme").html(data.text);
			},
		});
	});
	// Update Elan Istifadeci Form
	$(".update-elanIstifad-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/addUpdateElanIstifadeci.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertElanYenileme").removeClass("alert-danger");
					$("#alertElanYenileme").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertElanYenileme").removeClass("alert-success");
					$("#alertElanYenileme").addClass("alert-danger");
				}

				$("#alertElanYenileme").css("display", "block");
				$("#alertElanYenileme").html(data.text);
			},
		});
	});
	// remove icon in add edit page
	$(".jsCloseIcon").on("click", function (e) {
		var getId = $(this).attr("id");
		var action = "remove";

		$.ajax({
			url: "php/removeImageInAddDetail.php",
			type: "post",
			data: { getId: getId, action: action },
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertElanYenileme").removeClass("alert-danger");
					$("#alertElanYenileme").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertElanYenileme").removeClass("alert-success");
					$("#alertElanYenileme").addClass("alert-danger");
				}

				$("#alertElanYenileme").css("display", "block");
				$("#alertElanYenileme").html(data.text);
			},
		});
	});

	/* [ Merge page ] 
	================================================================>  */
	// Create Merge Form
	$(".merge-suboptions-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/addCreateMerges.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertListMergeSubOptions").removeClass("alert-danger");
					$("#alertListMergeSubOptions").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertListMergeSubOptions").removeClass("alert-success");
					$("#alertListMergeSubOptions").addClass("alert-danger");
				}

				$("#alertListMergeSubOptions").css("display", "block");
				$("#alertListMergeSubOptions").html(data.text);
			},
		});
	});

	/* [ Rules page ] 
	================================================================>  */
	// Create Rules Form
	$(".create-rules-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/addCreateRules.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertListRules").removeClass("alert-danger");
					$("#alertListRules").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertListRules").removeClass("alert-success");
					$("#alertListRules").addClass("alert-danger");
				}

				$("#alertListRules").css("display", "block");
				$("#alertListRules").html(data.text);
			},
		});
	});

	// Update Rules Form
	$(".update-rules-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/updateRules.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertListRules").removeClass("alert-danger");
					$("#alertListRules").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertListRules").removeClass("alert-success");
					$("#alertListRules").addClass("alert-danger");
				}

				$("#alertListRules").css("display", "block");
				$("#alertListRules").html(data.text);
			},
		});
	});

	// Update Social Networks Form
	$(".update-social-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/updateSocial.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertCompanySettings").removeClass("alert-danger");
					$("#alertCompanySettings").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertCompanySettings").removeClass("alert-success");
					$("#alertCompanySettings").addClass("alert-danger");
				}

				$("#alertCompanySettings").css("display", "block");
				$("#alertCompanySettings").html(data.text);
			},
		});
	});

	/* [ City page ] 
	================================================================>  */
	// Create City Form
	$(".create-city-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/addCreateCity.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertListCities").removeClass("alert-danger");
					$("#alertListCities").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertListCities").removeClass("alert-success");
					$("#alertListCities").addClass("alert-danger");
				}

				$("#alertListCities").css("display", "block");
				$("#alertListCities").html(data.text);
			},
		});
	});

	// Update City Form
	$(".update-city-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/updateCity.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertListCities").removeClass("alert-danger");
					$("#alertListCities").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertListCities").removeClass("alert-success");
					$("#alertListCities").addClass("alert-danger");
				}

				$("#alertListCities").css("display", "block");
				$("#alertListCities").html(data.text);
			},
		});
	});

	/* [ Category page ] 
	================================================================>  */
	// Create Category Form
	$(".create-category-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/addCreateCategory.php",
			type: "post",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertListCategories").removeClass("alert-danger");
					$("#alertListCategories").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertListCategories").removeClass("alert-success");
					$("#alertListCategories").addClass("alert-danger");
				}

				$("#alertListCategories").css("display", "block");
				$("#alertListCategories").html(data.text);
			},
		});
	});

	// Update Category Form
	$(".update-category-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/updateCategory.php",
			type: "post",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertListCategories").removeClass("alert-danger");
					$("#alertListCategories").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertListCategories").removeClass("alert-success");
					$("#alertListCategories").addClass("alert-danger");
				}

				$("#alertListCategories").css("display", "block");
				$("#alertListCategories").html(data.text);
			},
		});
	});

	/* [ SubCategory page ] 
	================================================================>  */
	// Create SubCategory Form
	$(".create-subcategories-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/addCreateSubCategory.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertListSubCategory").removeClass("alert-danger");
					$("#alertListSubCategory").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertListSubCategory").removeClass("alert-success");
					$("#alertListSubCategory").addClass("alert-danger");
				}

				$("#alertListSubCategory").css("display", "block");
				$("#alertListSubCategory").html(data.text);
			},
		});
	});

	// Update SubCategory Form
	$(".update-subcategory-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/updateSubCategory.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertListSubCategory").removeClass("alert-danger");
					$("#alertListSubCategory").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertListSubCategory").removeClass("alert-success");
					$("#alertListSubCategory").addClass("alert-danger");
				}

				$("#alertListSubCategory").css("display", "block");
				$("#alertListSubCategory").html(data.text);
			},
		});
	});

	/* [ Options page ] 
	================================================================>  */
	// Create Options Form
	$(".create-options-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/addCreateOptions.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertListOptions").removeClass("alert-danger");
					$("#alertListOptions").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertListOptions").removeClass("alert-success");
					$("#alertListOptions").addClass("alert-danger");
				}

				$("#alertListOptions").css("display", "block");
				$("#alertListOptions").html(data.text);
			},
		});
	});

	// Update Options Form
	$(".update-options-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/updateOptions.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertListOptions").removeClass("alert-danger");
					$("#alertListOptions").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertListOptions").removeClass("alert-success");
					$("#alertListOptions").addClass("alert-danger");
				}

				$("#alertListOptions").css("display", "block");
				$("#alertListOptions").html(data.text);
			},
		});
	});

	/* [ SubOptions page ] 
	================================================================>  */
	// Create SubOptions Form
	$(".create-suboptions-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/addCreateSubOptions.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertListSubOptions").removeClass("alert-danger");
					$("#alertListSubOptions").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertListSubOptions").removeClass("alert-success");
					$("#alertListSubOptions").addClass("alert-danger");
				}

				$("#alertListSubOptions").css("display", "block");
				$("#alertListSubOptions").html(data.text);
			},
		});
	});

	// Update SubOptions Form
	$(".update-suboptions-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/updateSubOptions.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertListSubOptions").removeClass("alert-danger");
					$("#alertListSubOptions").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertListSubOptions").removeClass("alert-success");
					$("#alertListSubOptions").addClass("alert-danger");
				}

				$("#alertListSubOptions").css("display", "block");
				$("#alertListSubOptions").html(data.text);
			},
		});
	});

	// js DataTable
	for ($m = 1; $m < 10; $m++) {
		$("#example" + $m).DataTable({
			responsive: true,
			lengthChange: false,
			autoWidth: false,
			buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
		});
	}

	/* [ Settings page ] 
	======================================================================>  */
	// General Settings Form
	$(".general-settings-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/updateSettingsGeneral.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertSettings").removeClass("alert-danger");
					$("#alertSettings").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertSettings").removeClass("alert-success");
					$("#alertSettings").addClass("alert-danger");
				}

				$("#alertSettings").css("display", "block");
				$("#alertSettings").html(data.text);
			},
		});
	});

	// User Image Settings Form
	$(".image-settings-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/updateSettingsImage.php",
			type: "post",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertSettings").removeClass("alert-danger");
					$("#alertSettings").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertSettings").removeClass("alert-success");
					$("#alertSettings").addClass("alert-danger");
				}

				$("#alertSettings").css("display", "block");
				$("#alertSettings").html(data.text);
			},
		});
	});

	// Password Settings Form
	$(".password-settings-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/updateSettingsPassword.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertSettings").removeClass("alert-danger");
					$("#alertSettings").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertSettings").removeClass("alert-success");
					$("#alertSettings").addClass("alert-danger");
				}

				$("#alertSettings").css("display", "block");
				$("#alertSettings").html(data.text);
			},
		});
	});

	/* [ Company Settings page ] 
	==============================================================>  */
	// General Settings Form
	$(".general-company-settings-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/updateCompanySettingsGeneral.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertCompanySettings").removeClass("alert-danger");
					$("#alertCompanySettings").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertCompanySettings").removeClass("alert-success");
					$("#alertCompanySettings").addClass("alert-danger");
				}

				$("#alertCompanySettings").css("display", "block");
				$("#alertCompanySettings").html(data.text);
			},
		});
	});

	// Update color site settings Form
	$(".color-site-settings-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/updateColorSettings.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertSiteSettings").removeClass("alert-danger");
					$("#alertSiteSettings").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertSiteSettings").removeClass("alert-success");
					$("#alertSiteSettings").addClass("alert-danger");
				}

				$("#alertSiteSettings").css("display", "block");
				$("#alertSiteSettings").html(data.text);
			},
		});
	});

	// Company Image Settings Form
	$(".company-logo-settings-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/updateCompanySettingsLogo.php",
			type: "post",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertCompanySettings").removeClass("alert-danger");
					$("#alertCompanySettings").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertCompanySettings").removeClass("alert-success");
					$("#alertCompanySettings").addClass("alert-danger");
				}

				$("#alertCompanySettings").css("display", "block");
				$("#alertCompanySettings").html(data.text);
			},
		});
	});

	// Company Icon Settings Form
	$(".company-icon-settings-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/updateCompanySettingsIcon.php",
			type: "post",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertCompanySettings").removeClass("alert-danger");
					$("#alertCompanySettings").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else {
					$("#alertCompanySettings").removeClass("alert-success");
					$("#alertCompanySettings").addClass("alert-danger");
				}

				$("#alertCompanySettings").css("display", "block");
				$("#alertCompanySettings").html(data.text);
			},
		});
	});

	$("#selectOptionsType").on("change", function () {
		if ($(this).val() == "text") {
			$("#areaSecurity").css("display", "block");
		} else {
			$("#areaSecurity").css("display", "none");
		}
	});
});
