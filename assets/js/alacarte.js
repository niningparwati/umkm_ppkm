// BOX FULLSCREEN
$(document).ready(function () {
    $(".toggle-expand-btn").click(function (e) {
      $(this).closest('.box.box-success').toggleClass('box-fullscreen');
    });

    $('.summernote').summernote({
        height: 200, // set editor height
        minHeight: null, // set minimum height of editor
        maxHeight: null, // set maximum height of editor
        focus: true                  // set focus to editable area after initializing summernote
    });

    $(".select2").select2({
      	placeholder: "Pilih",
  	});
});

//Date picker
$('.datepicker').datepicker({
    autoclose: true,
});


$(function() {
    $('.photo-input').fileinput({
        browseLabel: 'Select Photo',
        browseClass: 'btn btn-info',
        browseIcon: '<i class="fa fa-picture-o"></i>',
        removeLabel: 'Cancel',
        removeClass: 'btn btn-danger',
        removeIcon: '<i class="fa fa-times-circle"></i>',
        layoutTemplates: {
            icon: '<i class="fa fa-file-image-o"></i>'
        },
        showUpload: false,
        showClose: false,
        maxFilesNum: 10,
        allowedFileExtensions: ["jpg", "png", "jpeg","gif"],
        maxFileSize: 3072,
        overwriteInitial: true,
    });
});

$(function() {
    $('.file-input').fileinput({
        browseLabel: 'Select File',
        browseClass: 'btn btn-info',
        browseIcon: '<i class="fa fa-file-o"></i>',
        removeLabel: 'Cancel',
        removeClass: 'btn btn-danger',
        removeIcon: '<i class="fa fa-times-circle"></i>',
        layoutTemplates: {
            icon: '<i class="fa fa-file-image-o"></i>'
        },
        showUpload: false,
        showClose: false,
        maxFilesNum: 10,
        allowedFileExtensions: ["jpg", "png", "jpeg","gif","txt", "pdf", "docx", "xlsx", "pptx", "rtf", "rar", "zip", "doc", "xls", "ppt"],
        maxFileSize: 3072,
        overwriteInitial: true,
        
    });
});

$('.uang').priceFormat({
    prefix: 'Rp  ',
    thousandsSeparator: '.',
    centsLimit: 0
});

$(function () {
    $('.datetimepicker').bootstrapMaterialDatePicker({ format : 'YYYY-MM-DD HH:mm', lang: 'id' });
});