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
});
