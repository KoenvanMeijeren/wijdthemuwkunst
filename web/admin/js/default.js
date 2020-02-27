$('#datepicker').datepicker({
    uiLibrary: 'bootstrap4',
    format: "dd-mm-yyyy",
    maxViewMode: 1,
    todayBtn: "linked",
    language: "nl",
    calendarWeeks: true,
    autoclose: true,
    todayHighlight: true
});

$('#time').clockpicker({
    placement: 'bottom',
    align: 'left',
    autoclose: true,
    'default': 'now'
});

$(document).ready(function () {
    $("#searchLog").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".list-group a").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

function makeRandomString(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

window.addEventListener('DOMContentLoaded', function () {
    // visible image after uploading a image
    var thumbnailOutput = document.getElementById('thumbnailOutput');
    // the path of the uploaded image to be stored in the db
    var thumbnailInputOutput = document.getElementById('thumbnailInputOutput');
    // show the image in the modal to crop the image
    var thumbnailImage = document.getElementById('thumbnailImage');
    // the file upload input field
    var thumbnailInput = document.getElementById('inputThumbnail');

    var $progress = $('.thumbnailProgress');
    var $progressBar = $('.thumbnail-progress-bar');
    var $alert = $('.thumbnailAlert');
    var $modal = $('.thumbnailModal');
    var cropper;

    thumbnailInput.addEventListener('change', function (e) {
        var files = e.target.files;
        var done = function (url) {
            thumbnailInput.value = '';
            thumbnailImage.src = url;
            $alert.hide();
            $modal.modal('show');
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(thumbnailImage, {
            aspectRatio: 37 / 30,
            viewMode: 1,
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });

    document.getElementById('cropThumbnail').addEventListener('click', function () {
        var canvas;

        $modal.modal('hide');

        if (cropper) {
            canvas = cropper.getCroppedCanvas({
                width: 370,
                height: 300,
            });
            thumbnailOutput.src = canvas.toDataURL();
            $progress.show();
            $alert.removeClass('alert-success alert-warning');
            var fileName = makeRandomString(30);
            canvas.toBlob(function (fileName) {
                var formData = new FormData();

                formData.append('thumbnailOutput', fileName);
                $.ajax('/admin/upload/thumbnail', {
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,

                    xhr: function () {
                        var xhr = new XMLHttpRequest();

                        xhr.upload.onprogress = function (e) {
                            var percent = '0';
                            var percentage = '0%';

                            if (e.lengthComputable) {
                                percent = Math.round((e.loaded / e.total) * 100);
                                percentage = percent + '%';
                                $progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage);
                            }
                        };

                        return xhr;
                    },

                    success: function (data) {
                        thumbnailInputOutput.value = data;
                        $alert.show().addClass('alert-success').text('Succesvol geüpload');
                    },

                    error: function () {
                        $alert.show().addClass('alert-warning').text('Uploaden is mislukt');
                    },

                    complete: function () {
                        $progress.hide();
                    },
                });
            });
        }
    });
});

window.addEventListener('DOMContentLoaded', function () {
    // visible image after uploading a image
    var bannerOutput = document.getElementById('bannerOutput');
    // the path of the uploaded image to be stored in the db
    var bannerInputOutput = document.getElementById('bannerInputOutput');
    // show the image in the modal to crop the image
    var bannerImage = document.getElementById('bannerImage');
    // the file upload input field
    var bannerInput = document.getElementById('inputBanner');

    var $progress = $('.bannerProgress');
    var $progressBar = $('.banner-progress-bar');
    var $alert = $('.bannerAlert');
    var $modal = $('.bannerModal');
    var cropper;

    bannerInput.addEventListener('change', function (e) {
        var files = e.target.files;
        var done = function (url) {
            bannerInput.value = '';
            bannerImage.src = url;
            $alert.hide();
            $modal.modal('show');
        };
        var reader;
        var file;
        var url;

        if (files && files.length > 0) {
            file = files[0];

            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $modal.on('shown.bs.modal', function () {
        cropper = new Cropper(bannerImage, {
            aspectRatio: 15 / 4,
            viewMode: 1,
        });
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    });

    document.getElementById('cropBanner').addEventListener('click', function () {
        var initialAvatarURL;
        var canvas;

        $modal.modal('hide');

        if (cropper) {
            canvas = cropper.getCroppedCanvas({
                width: 1500,
                height: 400,
            });
            initialAvatarURL = bannerOutput.src;
            bannerOutput.src = canvas.toDataURL();
            $progress.show();
            $alert.removeClass('alert-success alert-warning');
            var fileName = makeRandomString(30);
            canvas.toBlob(function (fileName) {
                var formData = new FormData();

                formData.append('bannerOutput', fileName);
                $.ajax('/admin/upload/banner', {
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,

                    xhr: function () {
                        var xhr = new XMLHttpRequest();

                        xhr.upload.onprogress = function (e) {
                            var percent = '0';
                            var percentage = '0%';

                            if (e.lengthComputable) {
                                percent = Math.round((e.loaded / e.total) * 100);
                                percentage = percent + '%';
                                $progressBar.width(percentage).attr('aria-valuenow', percent).text(percentage);
                            }
                        };

                        return xhr;
                    },

                    success: function (data) {
                        bannerInputOutput.value = data;
                        $alert.show().addClass('alert-success').text('Succesvol geüpload');
                    },

                    error: function () {
                        bannerOutput.src = initialAvatarURL;
                        $alert.show().addClass('alert-warning').text('Uploaden is mislukt');
                    },

                    complete: function () {
                        $progress.hide();
                    },
                });
            });
        }
    });
});
