(function($, Dropzone) {
    "use strict";

    $(document).ready(function() {
        // Copy URL for the first button
        $("body").on("click", "#copy", function(e) {
            e.preventDefault();
            var id = $(this).data("id");
            var copyText = document.getElementById(id);
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices
            document.execCommand("copy");
        });

    });

    window.copyText = function() {
        var inputFields = document.querySelectorAll(".input-view-copy");
            var inputField = inputFields[0];
            inputField.select();
            document.execCommand("copy");
            inputField.setSelectionRange(0, 99999);
            console.log("Text copied successfully!");
    };




    $('#modal-full-width').on('shown.bs.modal', function(e) {
        $('.rodiondevfiles-uploader-out').addClass('rodiondevfiles-modal-open');
    });
    $('#modal-full-width').on('hidden.bs.modal', function() {
        $('.rodiondevfiles-uploader-out').removeClass('rodiondevfiles-modal-open');
    });

    $(document).ready(function() {
        const url = SITE_URL + "/upload";
        const file_route = '/download/';
        const file_route_view = '/rodiondevfiles/uploads/storage/';
        const file_route_view_player = '/open/';
        const block = $('#rodiondevfiles-drag-zone > .rodiondevfiles-drag-zone-place');
        const dropbox = $('.rodiondevfiles-uploader-box');
        const buttonreset = $('.rodiondevfiles-reset-button');

        function dragOverBlock(e) { block.addClass('onDrag'); }

        function dragLeaveBlock(e) { block.removeClass('onDrag'); }

        function onFileAdd(file) {
            $('#modal-full-width').modal('show');
            $(file.previewElement).removeClass('d-none');
            dropbox.addClass('d-none');
            buttonreset.removeClass('d-none');
            $('.uploaded-success').removeClass('d-none');
            if (dropzone.files.length > MAX_FILES) {
                this.removeFile(file);
            }
            if (dropzone.files.length >= MAX_FILES) {
                buttonreset.addClass('d-none');
            }

        }

        function onFileError(file, message = null) {
            const preview = $(file.previewElement);
            const anchor = preview.find('.alert-error');
            const progress = preview.find('.upload-progress');
            const erroricon = preview.find('.error-icon-box');
            const upboxerror = preview.find('.rodiondevfiles-card');

            anchor.html(message ? message : BIG_FILES_DETECTED);
            anchor.removeClass('d-none');
            progress.addClass('d-none');
            erroricon.removeClass('d-none');
            upboxerror.addClass('box-is-error');
        }


        function onUploadComplete(file) {
            const preview = $(file.previewElement);
            const img = preview.find('.rodiondevfiles-upload-icon');
            const ext = getFileExt(file.name);
            var types = ['jpeg', 'png', 'jpg', 'gif', 'pdf', 'doc', 'docx', 'xlx', 'xlsx', 'csv', 'txt', 'mp4', 'm4v', 'wmv', 'mp3', 'm4a', 'wav', 'apk', 'zip', 'rar'];
            if (types.includes(ext)) {
                img.attr('src', SITE_URL + '/images/icons/' + ext + '.png');
            } else {
                img.attr('src', SITE_URL + '/images/icons/unknown.png');
            }
            if (file.status == "success") {
                const response = JSON.parse(file.xhr.response);
                if (response.type == 'success') {
                    const id = response.data.id;
                    const anchor = preview.find('.success-input');
                    const anchor1 = preview.find('.anchor1');
                    const anchor2 = preview.find('.anchor2');
                    const label = preview.find('.link-label');
                    const viewbtn = preview.find('.view-btn');
                    const buttonLink = preview.find('.success-button');
                    const downloadbtn = preview.find('.btn-download');
                    const progress = preview.find('.upload-progress');
                    const sucessicon = preview.find('.success-icon-box');
                    const upbox = preview.find('.rodiondevfiles-card');

                    anchor1.html('input', SITE_URL + file_route + id);
                    if (ext === 'mp4' || ext === 'm4v' || ext === 'wmv') {
                        anchor2.html('input', SITE_URL + file_route_view_player + id);
                        anchor2.attr('value', SITE_URL + file_route_view_player + id);
                        viewbtn.attr('href', SITE_URL + file_route_view_player + id);
                    } else {
                        anchor2.html('input', SITE_URL + file_route_view + id + '.' + ext);
                        anchor2.attr('value', SITE_URL + file_route_view + id + '.' + ext);
                        viewbtn.attr('href', SITE_URL + file_route_view + id + '.' + ext);
                    }


                    viewbtn.removeClass('d-none');
                    label.removeClass('d-none');

                    anchor.attr('id', id);
                    buttonLink.attr('data-id', id);
                    downloadbtn.attr('href', SITE_URL + file_route + id);
                    anchor1.attr('value', SITE_URL + file_route + id);
                    anchor.removeClass('d-none');
                    buttonLink.removeClass('d-none');
                    downloadbtn.removeClass('d-none');
                    progress.addClass('d-none');
                    sucessicon.removeClass('d-none');
                    upbox.addClass('box-is-success');
                } else
                    onFileError(file, response.errors);
            }
        }

        function getFileExt(fileName) {
            fileName = fileName.toLowerCase();
            return fileName.split('.').pop();
        }


        let previewNode = document.querySelector("#rodiondevfiles-drop-template");
        previewNode.id = "";
        let previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);


        const dropzone = new Dropzone(
            'div#rodiondevfiles-drag-zone', {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                method: 'post',
                paramName: 'uploads',
                maxFiles: MAX_FILES,
                maxFilesize: MAX_SIZE,
                previewTemplate: previewTemplate,
                previewsContainer: "#rodiondevfiles-preview-uploads",
                clickable: "div#rodiondevfiles-upload-clickable",
                acceptedFiles: "image/png,.jpg,.gif,.jpeg,application/pdf,.doc,.docx,.xlx,.xlsx,.csv,.txt,.mp4,.m4v,.wmv,.mp3,.m4a,.wav,.apk,.zip,.rar",
                timeout: 0,
                init: function() {
                    this.on("removedfile", function(file) {
                        if (dropzone.files.length == 0) { dropbox.removeClass('d-none'); }
                        if (dropzone.files.length <= MAX_FILES) { buttonreset.removeClass('d-none'); };
                        if (dropzone.files.length == 0) { buttonreset.addClass('d-none'); }
                    });
                }
            },
        );

        dropzone.on('dragover', dragOverBlock);
        dropzone.on('dragleave', dragLeaveBlock);
        dropzone.on('addedfile', onFileAdd);
        dropzone.on('error', onFileError);
        dropzone.on('complete', onUploadComplete);

        $(".modal").on("hidden.bs.modal", function() {
            buttonreset.addClass('d-none');
            dropbox.removeClass('d-none');
            dropzone.removeAllFiles(true);
        });

    })
})(jQuery, Dropzone);