//Success Alert
const success = $('.success-flash').data('success');
if (success) {
    Swal.fire({
        title: "Success!",
        text: success,
        type: "success",
    });
}

//error Alert
const error = $('.error-flash').data('error');
if (error) {
	Swal.fire({
        title: "Failed!",
        text: error,
        type: "error",
    });
}

//warning Alert
const warning = $('.warning-flash').data('warning');
if (warning) {
    Swal.fire({
        title: "Warning!",
        text: warning,
        type: "warning",
    });
}
