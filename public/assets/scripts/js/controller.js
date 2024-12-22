$(document).ready(function () {
    const base_url = window.location.host;
    const [host, port] = base_url.split(':');
    const $base_url = (IsValidVal(port) ? `http://${host}:${port}` : `https://${host}`);

    $.getScript(`${$base_url}/assets/scripts/js/functions.js`, function () {
        DisableRightClickOnMouse();
        JQueryOnLoad();
        AutoToIDR();
    });

    $("#loadingAjax").hide();
    $("#loadingContetLoader").hide();
});

function AjaxLoginRedirect($section_id, $base_url) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    $("#_csrf-token").val($('meta[name="csrf-token"]').attr('content'));
    $("#csrf-token").val($('meta[name="csrf-token"]').attr('content'));

    $.ajax({
        url: `${$base_url}/login`,
        type: "POST",
        data: $(`#${$section_id}`).serialize(),
        xhrFields: { withCredentials: true },
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function (callbackII) {
            console.log('success', callbackII);
            toastr.success('berhasil login!', "Success!");

            $("#loadingAjax").hide();
            setTimeout(() => {
                window.location.href = `${$base_url}/dashboard`;
            }, 1500);
        },
        error: function (callback) {
            const { responseJSON } = callback;
            const { errors, message, messages, datas } = responseJSON;
            let errorInfo, validator;
            if (datas) {
                const { errorInfo: errInfo, validator: validCallback } = datas
                errorInfo = errInfo;
                validator = validCallback;
            }
            console.log('error', callback);

            if (errors) {
                for (let key in errors) {
                    toastr.error(errors[key][0], "Kesalahan!");
                    $(`#err_${key}`).show();
                    $(`#err_${key} li`).html(errors[key][0]);
                }
            } else if (message || messages || errorInfo || validator) {
                const tmpMsg = (validator ? "input data tidak sesuai atau tidak boleh kosong" : (errorInfo ? errorInfo[2] : (messages ? messages : message)));
                toastr.error(tmpMsg, "Kesalahan!");
            }
            $("#loadingAjax").hide();
        },
    });
}

function ConvertToIDR($val) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 2 }).format($val);
}

function ContentLoader($url, $id_content) {
    $('#loadingContetLoader').show();

    $.ajax({
        url: `${$url}`,
        type: 'GET',
        success: function (data) {
            $(`${$id_content}`).html(data);
        },
        complete: function () {
            $('#loadingContetLoader').hide();
        },
        error: function () {
            toastr.error("Gagal mengambil data", "Kesalahan!");
        },
    });
}

function ContentLoaderDataTable($url, $id_content, $table_coloumn) {
    $('#loadingContetLoader').show();

    $.ajax({
        url: `${$url}`,
        type: 'GET',
        success: function (response) {
            $(`${$id_content}`).DataTable({
                dom: '<"top flex justify-between"Bfr>t<"bottom"lp><"clear">', // Custom DOM layout
                buttons: [
                    {
                        extend: 'excelHtml5', // Excel export button
                        text: '<span class="text-sm"><i class="fa-regular fa-file-excel"></i> Excel</span>',
                        className: 'm-0 p-0', // Customize button style
                        exportOptions: {
                            modifier: {
                                page: 'all' // Export all pages of the table, not just the current page
                            },
                            columns: ':visible' // Only export the visible columns
                        }
                    },
                    {
                        extend: 'colvis', // Excel export button
                        text: '<span class="text-sm"><i class="fa-solid fa-eye"></i> Show</span>',
                        className: 'm-0 p-0 w-fit', // Customize button style
                    },
                ],
                pageLength: 5, // Set initial page length (entries per page)
                lengthMenu: [5, 10, 25, 50, 75, 100], // Provide options for entries per page
                columnDefs: [
                    {
                        targets: -1, // Last column (Actions column)
                        visible: true // Ensure 'Actions' column is visible
                    }
                ],
                data: response.datas,
                columns: $table_coloumn
            })
            $('#loadingContetLoader').hide();
        },
    });
}

async function GetDataFromAPI($url) {
    try {
        $('#loadingContetLoader').show();

        const datas = await $.ajax({
            url: `${$url}`,
            method: 'GET'
        });

        $('#loadingContetLoader').hide();

        return datas;
    } catch (err) {
        throw err;
    }
}

function IDRToDecimal($val) {
    return parseFloat($val.replace("Rp", "").replace(" ", "").replace(".", "").replace(",", "."));
}

function isnull($val) {
    return $val === null || $val === "null";
}

function isundefined($val) {
    return $val === undefined || $val === "undefined";
}

function empty($val) {
    if (typeof $val === "undefined" && isundefined($val)) {
        return true;
    } else if (typeof $val === "object" && isnull($val)) {
        return true;
    } else if (typeof $val === "object" && $val.length === 0) {
        return true;
    } else if (typeof $val === "object" && Object.keys($val).length === 0) {
        return true;
    } else if (typeof $val === "boolean" && $val === "") {
        return true;
    } else if (typeof $val === "number" && $val === "") {
        return true;
    } else if (typeof $val === "string" && $val === "") {
        return true;
    }

    return false;
}

function isset($val) {
    if (typeof $val === "undefined" && isundefined($val)) {
        return true;
    } else if (typeof $val === "object" && isnull($val)) {
        return true;
    } else if (typeof $val === "object" && $val.length > 0) {
        return true;
    } else if (typeof $val === "object" && Object.values($val).length > 0) {
        return true;
    } else if (typeof $val === "boolean" && $val) {
        return true;
    } else if (typeof $val === "number" && $val) {
        return true;
    } else if (typeof $val === "string" && $val) {
        return true;
    }

    return false;
}

function IsValidVal($val, $get = ["bool", "value", "equal"], $other = null) {
    if (isset($other) && !empty($other) && $get == "value") {
        return isset($val) && !empty($val) ? $val : $other;
    } else if (isset($other) && !empty($other) && $get == "equal") {
        return isset($val) && !empty($val) && $val === $other;
    } else if (isset($val) && !empty($val) && $get == "value") {
        return $val;
    } else {
        return isset($val) && !empty($val);
    }
}
