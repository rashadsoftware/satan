//swiper js
var swiper = new Swiper(".swiper-container", {
	effect: "coverflow",
	grabCursor: true,
	centeredSlides: true,
	slidesPerView: "auto",
	coverflowEffect: {
		rotate: 50,
		stretch: 0,
		depth: 250,
		modifier: 1,
		slideShadows: true,
	},
	autoplay: {
		delay: 2000,
	},
	loop: true,
});

// jquery
$(function () {
	// header area
	var headerHeight = $("header").height();
	$("#head-section").css("padding-top", headerHeight);

	$(window).scroll(function () {
		if ($(this).scrollTop() > 0) {
			$("header").addClass("active");
			$(".scrollUp").fadeIn();
		} else {
			$("header").removeClass("active");
			$(".scrollUp").fadeOut();
		}
	});

	// back to top
	$(".scrollUp").click(function () {
		$("html, body").animate({ scrollTop: 0 }, 800);
	});

	// summernote init
	$("#textareaAdd").summernote({
		callbacks: {
			onKeyup: function (e) {
				$("#counter").text($("#textareaAdd").val().length);
			},
		},
		placeholder:
			"Satdığınız məhsulu vəya göstərdiyiniz xidməti ətraflı şəkildə burada qeyd edin",
		tabsize: 2,
		height: 300,
		minHeight: null,
		maxHeight: null,
		toolbar: [
			["font", ["bold", "underline"]],
			["para", ["ul", "ol", "paragraph", "hr"]],
		],
	});

	// form add elan
	// data form
	var inputName = $("#inputName");
	var selectUser = $("#selectUser");
	var inputEmail = $("#inputEmail");
	var inputPhone = $("#inputPhone");
	var selectsubCategory = $("#selectsubCategory");
	var selectCity = $("#selectCity");
	var inputElanTitle = $("#inputElanTitle");
	var inputPrice = $("#inputPrice");
	var textareaAdd = $("#textareaAdd");

	// file data
	var fileInput = $("#files");
	var errMultiImg = $("#errMultiImg");

	// error data
	var errInputName = $("#errInputName");
	var errSelectUser = $("#errSelectUser");
	var emailHelp = $("#emailHelp");
	var errInputPhone = $("#errInputPhone");
	var errSelectsubCategory = $("#errSelectsubCategory");
	var errSelectCity = $("#errSelectCity");
	var errInputElanTitle = $("#errInputElanTitle");
	var errInputPrice = $("#errInputPrice");
	var errTextareaAdd = $("#errTextareaAdd");

	// regex
	var regexEmail =
		/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/; // email validate
	var regexPhone = /^0[0-9]{9}$/; // phone
	var regexNumber = /^[0-9]+$/; // price

	// check name
	inputName.on("keyup", function () {
		if (inputName.val() == "") {
			errInputName.text("Bu sahə boş saxlanmamalıdır");
			inputName.addClass("errClass");
		} else if (inputName.val().length < 2) {
			errInputName.text("Bu sahədə minimum 2 hərf istifadə olunmalıdır");
			inputName.addClass("errClass");
		} else {
			errInputName.text(" ");
			inputName.removeClass("errClass");
			$("#errorAdd").text("").css("display", "none");
		}
	});

	// check user
	selectUser.on("change", function () {
		if (selectUser.val() == "") {
			errSelectUser.text("Bu seçim sahəsi boş saxlanmamalıdır");
			selectUser.addClass("errClass");
		} else {
			errSelectUser.text(" ");
			selectUser.removeClass("errClass");
			$("#errorAdd").text("").css("display", "none");
		}
	});

	// check email
	inputEmail.on("keyup", function () {
		if (inputEmail.val() == "") {
			emailHelp.text("Bu email sahəsi boş saxlanmamalıdır");
			emailHelp.removeClass("text-muted");
			emailHelp.addClass("text-danger");
			inputEmail.addClass("errClass");
		} else if (!inputEmail.val().match(regexEmail)) {
			emailHelp.text("Yazılan email standartlara uyğun deyil");
			emailHelp.removeClass("text-muted");
			emailHelp.addClass("text-danger");
			inputEmail.addClass("errClass");
		} else {
			emailHelp.text("E-poçtunuzu heç vaxt başqası ilə bölüşməyəcəyik.");
			emailHelp.removeClass("text-danger");
			emailHelp.addClass("text-muted");
			inputEmail.removeClass("errClass");
			$("#errorAdd").text("").css("display", "none");
		}
	});

	// check phone
	inputPhone.on("keyup", function () {
		if (inputPhone.val() == "") {
			errInputPhone.text("Telefon sahəsi boş saxlanmamalıdır");
			inputPhone.addClass("errClass");
		} else if (inputPhone.val().length == 10) {
			if (!inputPhone.val().match(regexPhone)) {
				errInputPhone.text("Daxil edilən nömrə standartlara uyğun olmalıdır");
				inputPhone.addClass("errClass");
			} else {
				errInputPhone.text(" ");
				inputPhone.removeClass("errClass");
				$("#errorAdd").text("").css("display", "none");
			}
		} else {
			errInputPhone.text("Bu sahədə 10 rəqəm istifadə olunmalıdır");
			inputPhone.addClass("errClass");
		}
	});

	// check subcategory
	selectsubCategory.on("change", function () {
		if (selectsubCategory.val() == "") {
			errSelectsubCategory.text("Bu seçim sahəsi boş saxlanmamalıdır");
			selectsubCategory.addClass("errClass");
		} else {
			errSelectsubCategory.text(" ");
			selectsubCategory.removeClass("errClass");
			$("#errorAdd").text("").css("display", "none");
		}
	});

	// check city
	selectCity.on("change", function () {
		if (selectCity.val() == "") {
			errSelectCity.text("Bu seçim sahəsi boş saxlanmamalıdır");
			selectCity.addClass("errClass");
		} else {
			errSelectCity.text(" ");
			selectCity.removeClass("errClass");
			$("#errorAdd").text("").css("display", "none");
		}
	});

	// check title
	inputElanTitle.on("keyup", function () {
		if (inputElanTitle.val() == "") {
			errInputElanTitle.text("Bu sahə boş saxlanmamalıdır");
			inputElanTitle.addClass("errClass");
		} else if (inputElanTitle.val().length < 2) {
			errInputElanTitle.text("Bu sahədə minimum 2 hərf istifadə olunmalıdır");
			inputElanTitle.addClass("errClass");
		} else {
			errInputElanTitle.text(" ");
			inputElanTitle.removeClass("errClass");
			$("#errorAdd").text("").css("display", "none");
		}
	});

	// check price
	inputPrice.on("keyup", function () {
		if (inputPrice.val() == "") {
			errInputPrice.text("Bu sahəsi boş saxlanmamalıdır");
			inputPrice.addClass("errClass");
		} else {
			if (!inputPrice.val().match(regexNumber)) {
				errInputPrice.text("Bu sahədə ancaq rəqəmlər istifadə olunmalıdır");
				inputPrice.addClass("errClass");
			} else {
				errInputPrice.text(" ");
				inputPrice.removeClass("errClass");
				$("#errorAdd").text("").css("display", "none");
			}
		}
	});

	// check description
	textareaAdd.on("keyup", function () {
		if (textareaAdd.val() == "") {
			errTextareaAdd.text("Məzmun sahəsi boş saxlanmamalıdır");
			textareaAdd.addClass("errClass");
		} else {
			if (textareaAdd.val().length < 14) {
				errTextareaAdd.text("Məzmun sahəsində minimum 15 karakter olmalıdır");
				textareaAdd.addClass("errClass");
			} else {
				errTextareaAdd.text(" ");
				textareaAdd.removeClass("errClass");
				$("#errorAdd").text("").css("display", "none");
			}
		}
	});

	fileInput.on("change", function () {
		if (fileInput.get(0).files.length > 0) {
			// count of multi files
			for ($i = 0; $i < fileInput.get(0).files.length; $i++) {
				var file = fileInput.get(0).files[$i];
				var fileType = file.type;
				if (
					fileType == "image/png" ||
					fileType == "image/jpg" ||
					fileType == "image/jpeg" ||
					fileType == "image/gif"
				) {
					errMultiImg.text(" ");
				} else {
					errMultiImg.text("Şəkilin formatı standartlara uyğun deyil");
				}
			}
		} else {
			errMultiImg.text("Şəkil sahəsində ən azı bir şəkil olmalıdır");
			$(".pip").remove();
		}
	});

	$(function () {
		$("#formAdd").submit(function (e) {
			e.preventDefault();

			// check name
			if (inputName.val() == "") {
				errInputName.text("Bu sahə boş saxlanmamalıdır");
				$("#errorAdd")
					.text("İstifadəçi adı boş saxlanmamalıdır")
					.css("display", "block");
				inputName.addClass("errClass");
			} else if (inputName.val().length < 2) {
				errInputName.text("Bu sahədə minimum 2 hərf istifadə olunmalıdır");
				inputName.addClass("errClass");
				$("#errorAdd")
					.text("İstifadəçi adı minimum 2 hərf istifadə olunmalıdır")
					.css("display", "block");
			} else {
				errInputName.text(" ");
				inputName.removeClass("errClass");
				$("#errorAdd").text("").css("display", "none");

				// check user
				if (selectUser.val() == "") {
					errSelectUser.text("Bu seçim sahəsi boş saxlanmamalıdır");
					selectUser.addClass("errClass");
					$("#errorAdd")
						.text("Elan verən sahəsi boş saxlanmamalıdır")
						.css("display", "block");
				} else {
					errSelectUser.text(" ");
					selectUser.removeClass("errClass");
					$("#errorAdd").text("").css("display", "none");

					// check email
					if (inputEmail.val() == "") {
						emailHelp.text("Bu email sahəsi boş saxlanmamalıdır");
						emailHelp.removeClass("text-muted");
						emailHelp.addClass("text-danger");
						inputEmail.addClass("errClass");
						$("#errorAdd")
							.text("Email ünvan sahəsi boş saxlanmamalıdır")
							.css("display", "block");
					} else if (!inputEmail.val().match(regexEmail)) {
						emailHelp.text("Yazılan email standartlara uyğun deyil");
						emailHelp.removeClass("text-muted");
						emailHelp.addClass("text-danger");
						inputEmail.addClass("errClass");
						$("#errorAdd")
							.text("Yazılan email standartlara uyğun deyil")
							.css("display", "block");
					} else {
						emailHelp.text("E-poçtunuzu heç vaxt başqası ilə bölüşməyəcəyik.");
						emailHelp.removeClass("text-danger");
						emailHelp.addClass("text-muted");
						inputEmail.removeClass("errClass");
						$("#errorAdd").text("").css("display", "none");
						// check phone
						if (inputPhone.val() == "") {
							errInputPhone.text("Telefon sahəsi boş saxlanmamalıdır");
							inputPhone.addClass("errClass");
							$("#errorAdd")
								.text("Telefon sahəsi boş saxlanmamalıdır")
								.css("display", "block");
						} else if (inputPhone.val().length == 10) {
							if (!inputPhone.val().match(regexPhone)) {
								errInputPhone.text(
									"Daxil edilən nömrə standartlara uyğun olmalıdır"
								);
								inputPhone.addClass("errClass");
								$("#errorAdd")
									.text("Daxil edilən nömrə standartlara uyğun olmalıdır")
									.css("display", "block");
							} else {
								errInputPhone.text(" ");
								inputPhone.removeClass("errClass");
								$("#errorAdd").text("").css("display", "none");

								// check subcategory
								if (selectsubCategory.val() == "") {
									errSelectsubCategory.text(
										"Bu seçim sahəsi boş saxlanmamalıdır"
									);
									selectsubCategory.addClass("errClass");
									$("#errorAdd")
										.text("Kateqoriya seçim sahəsi boş saxlanmamalıdır")
										.css("display", "block");
								} else {
									errSelectsubCategory.text(" ");
									selectsubCategory.removeClass("errClass");
									$("#errorAdd").text("").css("display", "none");

									if (selectsubCategory.val() == 34) {
										var valuesArray = [];
										var fields = document.getElementsByName("optionsAdd[]");
										for (var i = 0; i < fields.length; i++) {
											valuesArray.push(fields[i].value);
										}

										var valuesDataAray = [];
										for (var g = 0; g < valuesArray.length; g++) {
											if (valuesArray[g] == "") {
												valuesDataAray.push("false");
											} else {
												valuesDataAray.push("true");
											}
										}

										// javascript array unique
										/* bu funksiyaya esasen bir dizide eyni adli 2 ve daha cox deyer varsa onlari birlesdirir ve bir deyer gosterir */
										function onlyUnique(value, index, self) {
											return self.indexOf(value) === index;
										}

										// console.log(valuesDataAray);
										var newArrayValue = valuesDataAray.filter(onlyUnique);

										if (newArrayValue == "true") {
											$('input[name="optionsAdd[]"]').css(
												"border",
												"1px solid #ced4da"
											);
											$('select[name="optionsAdd[]"]').css(
												"border",
												"1px solid #ced4da"
											);

											$('input[name="optionsAdd[]"]')
												.parent("div")
												.find(".text-danger")
												.text("");

											$('select[name="optionsAdd[]"]')
												.parent("div")
												.find(".text-danger")
												.text("");

											$("#errorAdd").text("").css("display", "none");

											// check title
											if (inputElanTitle.val() == "") {
												errInputElanTitle.text("Bu sahə boş saxlanmamalıdır");
												inputElanTitle.addClass("errClass");
												$("#errorAdd")
													.text("Elanın adı boş saxlanmamalıdır")
													.css("display", "block");
											} else if (inputElanTitle.val().length < 2) {
												errInputElanTitle.text(
													"Bu sahədə minimum 2 hərf istifadə olunmalıdır"
												);
												inputElanTitle.addClass("errClass");
												$("#errorAdd")
													.text(
														"Elanın adı minimum 2 hərf istifadə olunmalıdır"
													)
													.css("display", "block");
											} else {
												errInputElanTitle.text(" ");
												inputElanTitle.removeClass("errClass");
												$("#errorAdd").text("").css("display", "none");

												// check price
												if (inputPrice.val() == "") {
													errInputPrice.text("Bu sahəsi boş saxlanmamalıdır");
													inputPrice.addClass("errClass");
													$("#errorAdd")
														.text("Elanın qiyməti boş saxlanmamalıdır")
														.css("display", "block");
												} else {
													if (!inputPrice.val().match(regexNumber)) {
														errInputPrice.text(
															"Bu sahədə ancaq rəqəmlər istifadə olunmalıdır"
														);
														inputPrice.addClass("errClass");
														$("#errorAdd")
															.text(
																"Elanın qiyməti ancaq rəqəmlər istifadə olunmalıdır"
															)
															.css("display", "block");
													} else {
														errInputPrice.text(" ");
														inputPrice.removeClass("errClass");
														$("#errorAdd").text("").css("display", "none");

														// check description
														if (textareaAdd.val() == "") {
															errTextareaAdd.text(
																"Məzmun sahəsi boş saxlanmamalıdır"
															);
															textareaAdd.addClass("errClass");
															$("#errorAdd")
																.text("Məzmun sahəsi boş saxlanmamalıdır")
																.css("display", "block");
														} else {
															if (textareaAdd.val().length < 14) {
																errTextareaAdd.text(
																	"Məzmun sahəsində minimum 15 karakter olmalıdır"
																);
																textareaAdd.addClass("errClass");
																$("#errorAdd")
																	.text(
																		"Məzmun sahəsində minimum 15 karakter olmalıdır"
																	)
																	.css("display", "block");
															} else {
																errTextareaAdd.text(" ");
																textareaAdd.removeClass("errClass");
																$("#errorAdd").text("").css("display", "none");

																// check img
																if (fileInput.get(0).files.length > 0) {
																	$imgArray = [];
																	// count of multi files
																	for (
																		$i = 0;
																		$i < fileInput.get(0).files.length;
																		$i++
																	) {
																		var file = fileInput.get(0).files[$i];
																		var fileType = file.type;
																		if (
																			fileType == "image/png" ||
																			fileType == "image/jpg" ||
																			fileType == "image/jpeg" ||
																			fileType == "image/gif"
																		) {
																			errMultiImg.text(" ");
																			$imgArray.push(file);
																		} else {
																			errMultiImg.text(
																				"Şəkilin formatı standartlara uyğun deyil"
																			);
																			$("#errorAdd")
																				.text(
																					"Şəkilin formatı standartlara uyğun deyil"
																				)
																				.css("display", "block");
																		}
																	}
																} else {
																	errMultiImg.text(
																		"Şəkil sahəsində ən azı bir şəkil olmalıdır"
																	);
																	$("#errorAdd")
																		.text(
																			"Şəkil sahəsində ən azı bir şəkil olmalıdır"
																		)
																		.css("display", "block");
																	$(".pip").remove();
																}

																if ($imgArray.length > 0) {
																	$.ajax({
																		url: "php/formAdd.php",
																		type: "post",
																		data: new FormData(this),
																		contentType: false,
																		cache: false,
																		processData: false,
																		dataType: "json",
																		beforeSend: function () {
																			$(".preloader").css("display", "block");
																			$("body").addClass("overhidden ");
																		},
																		success: function (data) {
																			if (data.ok) {
																				window.location.assign(data.ok);
																				$(".form-control").val(" ");
																				$("input [type=file]").val(" ");
																				$(".pip").remove();
																				$("#errorAdd").css("display", "none");
																			} else {
																				$("#errorAdd").css("display", "block");
																				$("#errorAdd").html(data.text);
																			}
																			$(".preloader").css("display", "none");
																			$("body").removeClass("overhidden ");
																		},
																	});
																}
															}
														}
													}
												}
											}
										} else {
											// input
											$('input[name="optionsAdd[]"]').css(
												"border",
												"1px solid red"
											);
											$('input[name="optionsAdd[]"]')
												.parent("div")
												.find(".text-danger")
												.html("Zəhmət olmasa bu sahəni boş saxlamayın");

											// select
											$('select[name="optionsAdd[]"]').css(
												"border",
												"1px solid red"
											);
											$('select[name="optionsAdd[]"]')
												.parent("div")
												.find(".text-danger")
												.html("Zəhmət olmasa seçim alanından bir seçim edin");

											$("#errorAdd")
												.text("Bütün xanalar tam doldurulmalıdır")
												.css("display", "block");
										}
									} else if (
										selectsubCategory.val() == 67 ||
										selectsubCategory.val() == 90
									) {
										var valuesArray = [];
										var fields = document.getElementsByName("optionsAdd[]");
										for (var i = 0; i < fields.length; i++) {
											valuesArray.push(fields[i].value);
										}

										var valuesDataAray = [];
										for (var g = 0; g < valuesArray.length; g++) {
											if (valuesArray[g] == "") {
												valuesDataAray.push("false");
											} else {
												valuesDataAray.push("true");
											}
										}

										// javascript array unique
										/* bu funksiyaya esasen bir dizide eyni adli 2 ve daha cox deyer varsa onlari birlesdirir ve bir deyer gosterir */
										function onlyUnique(value, index, self) {
											return self.indexOf(value) === index;
										}

										// console.log(valuesDataAray);
										var newArrayValue = valuesDataAray.filter(onlyUnique);

										if (newArrayValue == "true") {
											$('input[name="optionsAdd[]"]').css(
												"border",
												"1px solid #ced4da"
											);
											$('select[name="optionsAdd[]"]').css(
												"border",
												"1px solid #ced4da"
											);

											$('input[name="optionsAdd[]"]')
												.parent("div")
												.find(".text-danger")
												.text("");

											$('select[name="optionsAdd[]"]')
												.parent("div")
												.find(".text-danger")
												.text("");

											$("#errorAdd").text("").css("display", "none");

											// check city
											if (selectCity.val() == "") {
												errSelectCity.text(
													"Bu seçim sahəsi boş saxlanmamalıdır"
												);
												selectCity.addClass("errClass");
												$("#errorAdd")
													.text("Şəhər seçim sahəsi boş saxlanmamalıdır")
													.css("display", "block");
											} else {
												errSelectCity.text(" ");
												selectCity.removeClass("errClass");
												$("#errorAdd").text("").css("display", "none");

												// check title
												if (inputElanTitle.val() == "") {
													errInputElanTitle.text("Bu sahə boş saxlanmamalıdır");
													inputElanTitle.addClass("errClass");
													$("#errorAdd")
														.text("Elanın adı sahəsi boş saxlanmamalıdır")
														.css("display", "block");
												} else if (inputElanTitle.val().length < 2) {
													errInputElanTitle.text(
														"Bu sahədə minimum 2 hərf istifadə olunmalıdır"
													);
													inputElanTitle.addClass("errClass");
													$("#errorAdd")
														.text(
															"Elanın adı sahəsi minimum 2 hərf istifadə olunmalıdır"
														)
														.css("display", "block");
												} else {
													errInputElanTitle.text(" ");
													inputElanTitle.removeClass("errClass");
													$("#errorAdd").text("").css("display", "none");

													// check description
													if (textareaAdd.val() == "") {
														errTextareaAdd.text(
															"Məzmun sahəsi boş saxlanmamalıdır"
														);
														textareaAdd.addClass("errClass");
														$("#errorAdd")
															.text("Məzmun sahəsi boş saxlanmamalıdır")
															.css("display", "block");
													} else {
														if (textareaAdd.val().length < 14) {
															errTextareaAdd.text(
																"Məzmun sahəsində minimum 15 karakter olmalıdır"
															);
															textareaAdd.addClass("errClass");
															$("#errorAdd")
																.text(
																	"Məzmun sahəsində minimum 15 karakter olmalıdır"
																)
																.css("display", "block");
														} else {
															errTextareaAdd.text(" ");
															textareaAdd.removeClass("errClass");
															$("#errorAdd").text("").css("display", "none");

															// check img
															if (fileInput.get(0).files.length > 0) {
																$imgArray = [];
																// count of multi files
																for (
																	$i = 0;
																	$i < fileInput.get(0).files.length;
																	$i++
																) {
																	var file = fileInput.get(0).files[$i];
																	var fileType = file.type;
																	if (
																		fileType == "image/png" ||
																		fileType == "image/jpg" ||
																		fileType == "image/jpeg" ||
																		fileType == "image/gif"
																	) {
																		errMultiImg.text(" ");
																		$imgArray.push(file);
																	} else {
																		errMultiImg.text(
																			"Şəkilin formatı standartlara uyğun deyil"
																		);
																		$("#errorAdd")
																			.text(
																				"Şəkilin formatı standartlara uyğun deyil"
																			)
																			.css("display", "block");
																	}
																}
															} else {
																errMultiImg.text(
																	"Şəkil sahəsində ən azı bir şəkil olmalıdır"
																);
																$("#errorAdd")
																	.text(
																		"Şəkil sahəsində ən azı bir şəkil olmalıdır"
																	)
																	.css("display", "block");
																$(".pip").remove();
															}

															if ($imgArray.length > 0) {
																$.ajax({
																	url: "php/formAdd.php",
																	type: "post",
																	data: new FormData(this),
																	contentType: false,
																	cache: false,
																	processData: false,
																	dataType: "json",
																	beforeSend: function () {
																		$(".preloader").css("display", "block");
																		$("body").addClass("overhidden ");
																	},
																	success: function (data) {
																		if (data.ok) {
																			window.location.assign(data.ok);
																			$(".form-control").val(" ");
																			$("input [type=file]").val(" ");
																			$(".pip").remove();
																			$("#errorAdd").css("display", "none");
																		} else {
																			$("#errorAdd").css("display", "block");
																			$("#errorAdd").html(data.text);
																		}
																		$(".preloader").css("display", "none");
																		$("body").removeClass("overhidden ");
																	},
																});
															}
														}
													}
												}
											}
										} else {
											// input
											$('input[name="optionsAdd[]"]').css(
												"border",
												"1px solid red"
											);
											$('input[name="optionsAdd[]"]')
												.parent("div")
												.find(".text-danger")
												.html("Zəhmət olmasa bu sahəni boş saxlamayın");

											// select
											$('select[name="optionsAdd[]"]').css(
												"border",
												"1px solid red"
											);
											$('select[name="optionsAdd[]"]')
												.parent("div")
												.find(".text-danger")
												.html("Zəhmət olmasa seçim alanından bir seçim edin");

											$("#errorAdd")
												.text("Bütün xanalar tam doldurulmalıdır")
												.css("display", "block");
										}
									} else if (
										selectsubCategory.val() == 80 ||
										selectsubCategory.val() == 81 ||
										selectsubCategory.val() == 82 ||
										selectsubCategory.val() == 96 ||
										selectsubCategory.val() == 114
									) {
										// check city
										if (selectCity.val() == "") {
											errSelectCity.text("Bu seçim sahəsi boş saxlanmamalıdır");
											selectCity.addClass("errClass");
											$("#errorAdd")
												.text("Şəhər sahəsi boş saxlanmamalıdır")
												.css("display", "block");
										} else {
											errSelectCity.text(" ");
											selectCity.removeClass("errClass");
											$("#errorAdd").text("").css("display", "none");

											// check title
											if (inputElanTitle.val() == "") {
												errInputElanTitle.text("Bu sahə boş saxlanmamalıdır");
												inputElanTitle.addClass("errClass");
												$("#errorAdd")
													.text("Elanın adı sahəsi boş saxlanmamalıdır")
													.css("display", "block");
											} else if (inputElanTitle.val().length < 2) {
												errInputElanTitle.text(
													"Bu sahədə minimum 2 hərf istifadə olunmalıdır"
												);
												inputElanTitle.addClass("errClass");
												$("#errorAdd")
													.text(
														"Elanın adı minimum 2 hərf istifadə olunmalıdır"
													)
													.css("display", "block");
											} else {
												errInputElanTitle.text(" ");
												inputElanTitle.removeClass("errClass");
												$("#errorAdd").text("").css("display", "none");

												// check price
												if (inputPrice.val() == "") {
													errInputPrice.text("Bu sahəsi boş saxlanmamalıdır");
													inputPrice.addClass("errClass");
													$("#errorAdd")
														.text("Qiymət sahəsi boş saxlanmamalıdır")
														.css("display", "block");
												} else {
													if (!inputPrice.val().match(regexNumber)) {
														errInputPrice.text(
															"Bu sahədə ancaq rəqəmlər istifadə olunmalıdır"
														);
														inputPrice.addClass("errClass");
														$("#errorAdd")
															.text(
																"Qiymət ancaq rəqəmlər istifadə olunmalıdır"
															)
															.css("display", "block");
													} else {
														errInputPrice.text(" ");
														inputPrice.removeClass("errClass");
														$("#errorAdd").text("").css("display", "none");

														// check description
														if (textareaAdd.val() == "") {
															errTextareaAdd.text(
																"Məzmun sahəsi boş saxlanmamalıdır"
															);
															textareaAdd.addClass("errClass");
															$("#errorAdd")
																.text("Məzmun sahəsi boş saxlanmamalıdır")
																.css("display", "block");
														} else {
															if (textareaAdd.val().length < 14) {
																errTextareaAdd.text(
																	"Məzmun sahəsində minimum 15 karakter olmalıdır"
																);
																textareaAdd.addClass("errClass");
																$("#errorAdd")
																	.text(
																		"Məzmun sahəsində minimum 15 karakter olmalıdır"
																	)
																	.css("display", "block");
															} else {
																errTextareaAdd.text(" ");
																textareaAdd.removeClass("errClass");
																$("#errorAdd").text("").css("display", "none");

																// check img
																if (fileInput.get(0).files.length > 0) {
																	$imgArray = [];
																	// count of multi files
																	for (
																		$i = 0;
																		$i < fileInput.get(0).files.length;
																		$i++
																	) {
																		var file = fileInput.get(0).files[$i];
																		var fileType = file.type;
																		if (
																			fileType == "image/png" ||
																			fileType == "image/jpg" ||
																			fileType == "image/jpeg" ||
																			fileType == "image/gif"
																		) {
																			errMultiImg.text(" ");
																			$imgArray.push(file);
																		} else {
																			errMultiImg.text(
																				"Şəkilin formatı standartlara uyğun deyil"
																			);
																			$("#errorAdd")
																				.text(
																					"Şəkilin formatı standartlara uyğun deyil"
																				)
																				.css("display", "block");
																		}
																	}
																} else {
																	errMultiImg.text(
																		"Şəkil sahəsində ən azı bir şəkil olmalıdır"
																	);
																	$(".pip").remove();
																	$("#errorAdd")
																		.text(
																			"Şəkil sahəsində ən azı bir şəkil olmalıdır"
																		)
																		.css("display", "block");
																}

																if ($imgArray.length > 0) {
																	$.ajax({
																		url: "php/formAdd.php",
																		type: "post",
																		data: new FormData(this),
																		contentType: false,
																		cache: false,
																		processData: false,
																		dataType: "json",
																		beforeSend: function () {
																			$(".preloader").css("display", "block");
																			$("body").addClass("overhidden ");
																		},
																		success: function (data) {
																			if (data.ok) {
																				window.location.assign(data.ok);
																				$(".form-control").val(" ");
																				$("input [type=file]").val(" ");
																				$(".pip").remove();
																				$("#errorAdd").css("display", "none");
																			} else {
																				$("#errorAdd").css("display", "block");
																				$("#errorAdd").html(data.text);
																			}
																			$(".preloader").css("display", "none");
																			$("body").removeClass("overhidden ");
																		},
																	});
																}
															}
														}
													}
												}
											}
										}
									} else {
										var valuesArray = [];
										var fields = document.getElementsByName("optionsAdd[]");
										for (var i = 0; i < fields.length; i++) {
											valuesArray.push(fields[i].value);
										}

										var valuesDataAray = [];
										for (var g = 0; g < valuesArray.length; g++) {
											if (valuesArray[g] == "") {
												valuesDataAray.push("false");
											} else {
												valuesDataAray.push("true");
											}
										}

										// javascript array unique
										/* bu funksiyaya esasen bir dizide eyni adli 2 ve daha cox deyer varsa onlari birlesdirir ve bir deyer gosterir */
										function onlyUnique(value, index, self) {
											return self.indexOf(value) === index;
										}

										// console.log(valuesDataAray);
										var newArrayValue = valuesDataAray.filter(onlyUnique);

										if (newArrayValue == "true") {
											$('input[name="optionsAdd[]"]').css(
												"border",
												"1px solid #ced4da"
											);
											$('select[name="optionsAdd[]"]').css(
												"border",
												"1px solid #ced4da"
											);

											$('input[name="optionsAdd[]"]')
												.parent("div")
												.find(".text-danger")
												.text("");

											$('select[name="optionsAdd[]"]')
												.parent("div")
												.find(".text-danger")
												.text("");

											$("#errorAdd").text("").css("display", "none");

											// check city
											if (selectCity.val() == "") {
												errSelectCity.text(
													"Bu seçim sahəsi boş saxlanmamalıdır"
												);
												selectCity.addClass("errClass");
												$("#errorAdd")
													.text("Şəhər sahəsi boş saxlanmamalıdır")
													.css("display", "block");
											} else {
												errSelectCity.text(" ");
												selectCity.removeClass("errClass");
												$("#errorAdd").text("").css("display", "none");

												// check title
												if (inputElanTitle.val() == "") {
													errInputElanTitle.text("Bu sahə boş saxlanmamalıdır");
													inputElanTitle.addClass("errClass");
													$("#errorAdd")
														.text("Elanın adı sahəsi boş saxlanmamalıdır")
														.css("display", "block");
												} else if (inputElanTitle.val().length < 2) {
													errInputElanTitle.text(
														"Bu sahədə minimum 2 hərf istifadə olunmalıdır"
													);
													inputElanTitle.addClass("errClass");
													$("#errorAdd")
														.text(
															"Elanın adı minimum 2 hərf istifadə olunmalıdır"
														)
														.css("display", "block");
												} else {
													errInputElanTitle.text(" ");
													inputElanTitle.removeClass("errClass");
													$("#errorAdd").text("").css("display", "none");

													// check price
													if (inputPrice.val() == "") {
														errInputPrice.text("Bu sahəsi boş saxlanmamalıdır");
														inputPrice.addClass("errClass");
														$("#errorAdd")
															.text("Qiymət sahəsi boş saxlanmamalıdır")
															.css("display", "block");
													} else {
														if (!inputPrice.val().match(regexNumber)) {
															errInputPrice.text(
																"Bu sahədə ancaq rəqəmlər istifadə olunmalıdır"
															);
															inputPrice.addClass("errClass");
															$("#errorAdd")
																.text(
																	"Qiymət ancaq rəqəmlər istifadə olunmalıdır"
																)
																.css("display", "block");
														} else {
															errInputPrice.text(" ");
															inputPrice.removeClass("errClass");
															$("#errorAdd").text("").css("display", "none");

															// check description
															if (textareaAdd.val() == "") {
																errTextareaAdd.text(
																	"Məzmun sahəsi boş saxlanmamalıdır"
																);
																textareaAdd.addClass("errClass");
																$("#errorAdd")
																	.text("Məzmun sahəsi boş saxlanmamalıdır")
																	.css("display", "block");
															} else {
																if (textareaAdd.val().length < 14) {
																	errTextareaAdd.text(
																		"Məzmun sahəsində minimum 15 karakter olmalıdır"
																	);
																	textareaAdd.addClass("errClass");
																	$("#errorAdd")
																		.text(
																			"Məzmun sahəsində minimum 15 karakter olmalıdır"
																		)
																		.css("display", "block");
																} else {
																	errTextareaAdd.text(" ");
																	textareaAdd.removeClass("errClass");
																	$("#errorAdd")
																		.text("")
																		.css("display", "none");

																	// check img
																	if (fileInput.get(0).files.length > 0) {
																		$imgArray = [];
																		// count of multi files
																		for (
																			$i = 0;
																			$i < fileInput.get(0).files.length;
																			$i++
																		) {
																			var file = fileInput.get(0).files[$i];
																			var fileType = file.type;
																			if (
																				fileType == "image/png" ||
																				fileType == "image/jpg" ||
																				fileType == "image/jpeg" ||
																				fileType == "image/gif"
																			) {
																				errMultiImg.text(" ");
																				$imgArray.push(file);
																			} else {
																				errMultiImg.text(
																					"Şəkilin formatı standartlara uyğun deyil"
																				);
																				$("#errorAdd")
																					.text(
																						"Şəkilin formatı standartlara uyğun deyil"
																					)
																					.css("display", "block");
																			}
																		}
																	} else {
																		errMultiImg.text(
																			"Şəkil sahəsində ən azı bir şəkil olmalıdır"
																		);
																		$(".pip").remove();
																		$("#errorAdd")
																			.text(
																				"Şəkil sahəsində ən azı bir şəkil olmalıdır"
																			)
																			.css("display", "block");
																	}

																	if ($imgArray.length > 0) {
																		$.ajax({
																			url: "php/formAdd.php",
																			type: "post",
																			data: new FormData(this),
																			contentType: false,
																			cache: false,
																			processData: false,
																			dataType: "json",
																			beforeSend: function () {
																				$(".preloader").css("display", "block");
																				$("body").addClass("overhidden ");
																			},
																			success: function (data) {
																				if (data.ok) {
																					window.location.assign(data.ok);
																					$(".form-control").val(" ");
																					$("input [type=file]").val(" ");
																					$(".pip").remove();
																					$("#errorAdd").css("display", "none");
																				} else {
																					$("#errorAdd").css(
																						"display",
																						"block"
																					);
																					$("#errorAdd").html(data.text);
																				}
																				$(".preloader").css("display", "none");
																				$("body").removeClass("overhidden ");
																			},
																		});
																	}
																}
															}
														}
													}
												}
											}
										} else {
											// input
											$('input[name="optionsAdd[]"]').css(
												"border",
												"1px solid red"
											);
											$('input[name="optionsAdd[]"]')
												.parent("div")
												.find(".text-danger")
												.html("Zəhmət olmasa bu sahəni boş saxlamayın");

											// select
											$('select[name="optionsAdd[]"]').css(
												"border",
												"1px solid red"
											);
											$('select[name="optionsAdd[]"]')
												.parent("div")
												.find(".text-danger")
												.html("Zəhmət olmasa seçim alanından bir seçim edin");

											$("#errorAdd")
												.text("Bütün xanalar tam doldurulmalıdır")
												.css("display", "block");
										}
									}
								}
							}
						} else {
							errInputPhone.text("Bu sahədə 10 rəqəm istifadə olunmalıdır");
							inputPhone.addClass("errClass");
							$("#errorAdd")
								.text("Telefon sahəsində 10 rəqəm istifadə olunmalıdır")
								.css("display", "block");
						}
					}
				}
			}
		});
	});

	// dependent select option with ajax
	$("#selectsubCategory").on("change", function () {
		var idsubCategory = $(this).val();

		if (idsubCategory != "") {
			$.ajax({
				type: "POST",
				url: "php/fetchCategory.php",
				data: { idsubCategory: idsubCategory },
				success: function (data) {
					$("#properties").html(data);
				},
			});
		}

		if (idsubCategory == 67 || idsubCategory == 90) {
			$("#priceInputArea").hide();

			$("#selectCityArea").show();
		} else if (idsubCategory == 34) {
			$("#priceInputArea").show();

			$("#selectCityArea").hide();
		} else {
			$("#priceInputArea").show();

			$("#selectCityArea").show();
		}
	});

	// image preview
	var all_image_array = [];
	if (window.File && window.FileList && window.FileReader) {
		$("#files").on("change", function (e) {
			// insert to array when change type file
			for (var i = 0; i < $(this).get(0).files.length; ++i) {
				all_image_array.push($(this).get(0).files[i].name);
			}

			$("#allImages").val(all_image_array);

			var files = e.target.files,
				filesLength = files.length;
			for (var i = 0; i < filesLength; i++) {
				var f = files[i];
				var fileReader = new FileReader();
				fileReader.onload = function (e) {
					var file = e.target;
					$(
						'<span class="pip">' +
							'<img class="imageThumb" src="' +
							e.target.result +
							'" title="' +
							file.name +
							'"/>' +
							'<br/><span class="remove"><i class="fa fa-times"></i></span>' +
							"</span>"
					).insertAfter("#files");
					$(".remove").click(function () {
						$(this).parent(".pip").remove();
					});
				};
				fileReader.readAsDataURL(f);
			}
		});
	} else {
		alert("Your browser doesn't support to File API");
	}

	// carousel2
	$(".owl-carousel").owlCarousel({
		margin: 10,
		nav: true,
		responsive: {
			0: {
				items: 2,
			},
			900: {
				items: 3,
			},
			1100: {
				items: 4,
			},
			1200: {
				items: 5,
			},
		},
	});

	// fancybox
	$('[data-fancybox="gallery"]').fancybox({
		transitionEffect: "circular",
	});

	// isotope js in user elan
	var $projects = $(".projects");

	$projects.isotope({
		itemSelector: ".item",
		layoutMode: "fitRows",
	});

	$("ul.filters > li").on("click", function (e) {
		e.preventDefault();

		var filter = $(this).attr("data-filter");

		$("ul.filters > li").removeClass("active");
		$(this).addClass("active");

		$projects.isotope({ filter: filter });
	});

	// pagination section
	load_data();
	function load_data(page) {
		$.ajax({
			method: "POST",
			url: "php/load_data.php",
			data: { page: page },
			dataType: "text",
			success: function (data) {
				$("#pagination_data").html(data);
			},
		});
	}

	$(document).on("click", ".next_link", function () {
		var page = $(this).attr("id");
		load_data(page);
	});
});
