//Success Alert
const success = $('.success-flash').data('success');
if (success) {
    Swal.fire({
        title: "Success!",
        text: success,
        icon: "success",
    });
}

//error Alert
const error = $('.error-flash').data('error');
if (error) {
    Swal.fire({
        title: "Failed!",
        text: error,
        icon: "error",
    });
}

//warning Alert
const warning = $('.warning-flash').data('warning');
if (warning) {
    Swal.fire({
        title: "Warning!",
        text: warning,
        icon: "warning",
    });
}