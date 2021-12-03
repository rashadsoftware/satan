$(function () {
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

	// close alert with setTimeout
	setTimeout(() => {
		$(".alert_hide").fadeOut();
	}, 3000);
});
