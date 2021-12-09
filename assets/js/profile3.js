$(function () {
	// Register Form
	$(".register-form").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/registerDB.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					window.location.assign("dashboard");
				} else {
					$(".register-text").css("display", "block");
					$(".register-text").html(data.text);
				}
			},
		});
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
				} else {
					$(".login-text").css("display", "block");
					$(".login-text").html(data.text);
				}
			},
		});
	});

	// Password Optional Form
	$("#password-optional").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/settings-optional.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertDashboard").removeClass("alert-danger");
					$("#alertDashboard").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else if (data.logout) {
					window.location.assign("index");
				} else {
					$("#alertDashboard").removeClass("alert-success");
					$("#alertDashboard").addClass("alert-danger");
				}

				$("#alertDashboard").css("display", "block");
				$("#alertDashboard").html(data.text);
			},
		});
	});

	// Password Change Form
	$("#password-change").on("submit", function (e) {
		e.preventDefault();

		$.ajax({
			url: "php/settings-password.php",
			type: "post",
			data: $(this).serialize(),
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertDashboard").removeClass("alert-danger");
					$("#alertDashboard").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 2000);
				} else if (data.logout) {
					window.location.assign("index");
				} else {
					$("#alertDashboard").removeClass("alert-success");
					$("#alertDashboard").addClass("alert-danger");
				}

				$("#alertDashboard").css("display", "block");
				$("#alertDashboard").html(data.text);
			},
		});
	});

	// activate elanlar
	$(".activate").click(function (e) {
		e.preventDefault();

		var getID = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: "php/activate.php",
			data: { getID: getID },
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertDashboard").removeClass("alert-danger");
					$("#alertDashboard").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 3000);
				} else {
					$("#alertDashboard").removeClass("alert-success");
					$("#alertDashboard").addClass("alert-danger");
				}

				$("#alertDashboard").css("display", "block");
				$("#alertDashboard").html(data.text);
			},
		});
	});

	// delete elanlar
	$(".delete").click(function (e) {
		e.preventDefault();

		var getID = $(this).attr("data-id");

		$.ajax({
			method: "POST",
			url: "php/delete-elanlar.php",
			data: { getID: getID },
			dataType: "json",
			success: function (data) {
				if (data.ok) {
					$("#alertDashboard").removeClass("alert-danger");
					$("#alertDashboard").addClass("alert-success");
					setTimeout(function () {
						location.reload();
					}, 3000);
				} else {
					$("#alertDashboard").removeClass("alert-success");
					$("#alertDashboard").addClass("alert-danger");
				}

				$("#alertDashboard").css("display", "block");
				$("#alertDashboard").html(data.text);
			},
		});
	});
});
