<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Reward Regional</li>
        <li class="breadcrumb-item active">Uploader</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Data Table</h6>
                <div class="table-responsive mt-3">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th class="w-25">Upload</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Prognosa Revenue</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#uploaderModal" data-category="1|Prognosa Reveneu">
                                        Upload Data
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="uploaderModal" tabindex="-1" role="dialog" aria-labelledby="uploaderModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploaderModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="displayAlert" style="display: none;"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <h6 class="card-title">Bulan</h6>
                            <div class="input-group date datepicker" id="monthPickerExample">
                                <input type="text" name="date" class="form-control" id="month">
                                <span class="input-group-addon"><i data-feather="calendar"
                                        class=" text-primary"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="file" accept=".xls,.xlsx" id="excelDropify" class="border" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="button" id="uploadExcel" class="btn btn-primary">
                    Upload
                </button>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" type="text/javascript"></script>
<script src="https://unpkg.com/read-excel-file@5.x/bundle/read-excel-file.min.js"></script>
<script>
function buttonLoading(isLoading) {
    const buttonSubmit = $('#uploadExcel');
    if (isLoading) {
        buttonSubmit[0].innerText = null;
        buttonSubmit.prop('disabled', true);
        buttonSubmit.append(
            `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`);
    } else {
        buttonSubmit.prop('disabled', false);
        buttonSubmit[0].innerHTML = 'Upload';
    }
}

function alert(message, type) {
    alertElement = `<div class="alert alert-icon-${type == 'success' ? 'success' : 'danger'}" role="alert">
                    <i data-feather="alert-circle"></i>
                    ${message}
                </div>`;

    const alert = $('#displayAlert');
    alert.children("div.alert").remove();
    alert.append(alertElement);
    alert.show();
}

$(document).ready(() => {
    const baseUrl = "<?= base_url(); ?>index.php/financial/consumer/prognosa_rev/uploader/";
    let categoryId, categoryName;
    let selectedFile;
    let isLoading = false;
    const dropify = $('#excelDropify').dropify();
    const submitButton = $("#uploadExcel");

    $("#uploaderModal").on("show.bs.modal", (event) => {
        const button = $(event.relatedTarget);
        [categoryId, categoryName] = button.data("category").split("|");

        $("#uploaderModalLabel").text("UPLOAD DATA " + categoryName);
    });

    dropify.on('change', (event, element) => {
        selectedFile = event.target.files[0];
    })

    submitButton.on("click", () => {
        if (selectedFile) {
            const result = [];
            const bodyTranspose = [];
            buttonLoading(true);
            readXlsxFile(selectedFile).then((rows) => {
                // console.log(rows);
                const date = rows.shift()[0];

                const headerColumns = rows.shift();
                const bodyColumns = rows;
                // console.log(rows);

                transposeBodyColumns = bodyColumns[0].map((_, colIndex) => bodyColumns.map(
                    row => row[
                        colIndex]));

                for (let i = 0; i < transposeBodyColumns.length; i++) {
                    result.push([headerColumns[i], transposeBodyColumns[i]]);
                };

                const headerTranspose = [result[0][0].replace("KOMPONEN BILLING", "WITEL")]
                    .concat(result[0][1]);

                for (let index = 1; index < result.length; index++) {
                    index0 = [result[index][0]];
                    index1 = result[index][1];
                    bodyTranspose.push(index0.concat(index1));
                    // console.log(bodyTranspose);
                }

                console.log(headerTranspose);
                console.log(bodyTranspose);

                buttonLoading(false);

                // const xhr = $.ajax({
                //     url: baseUrl + 'ajax_upload_post_request',
                //     type: 'POST',
                //     data: {
                //         category_id: categoryId,
                //         date: date,
                //         header_columns: headerColumns,
                //         body_columns: bodyColumns,
                //     },
                //     error: (error) => {
                //         console.log(error.status);
                //         buttonLoading(false);

                //         if (error.status == 500) {
                //             alert("Sorry! something wen't wrong, please try again later", 'error');
                //         } else {
                //             alert(error.responseJSON.message, 'error');
                //         }
                //     },
                //     success: (data) => {
                //         buttonLoading(false);
                //         alert("Record added successfully", 'success');

                //         console.log("Record added successfully");
                //     },
                // });

            });
        }
    });
});
</script>