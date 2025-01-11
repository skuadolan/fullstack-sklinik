$(document).ready(function () {
    const base_url = window.location.host;
    const [host, port] = base_url.split(':');
    const $base_url = (IsValidVal(port) ? `http://${host}:${port}` : `https://${host}`);

    $.getScript(`${$base_url}/assets/scripts/js/functions.js`, function () {
        DisableRightClickOnMouse();
        // JQueryOnLoad();
        InputNumberOnly();
        AutoToIDR();
        InitAutocomplete();
    });

    $("#loadingAjax").hide();
    $("#loadingContetLoader").hide();
});

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
            $('#loadingContetLoader').hide();
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
        complete: function () {
            $('#loadingContetLoader').hide();
        },
        error: function () {
            $('#loadingContetLoader').hide();
            toastr.error("Gagal mengambil data", "Kesalahan!");
        },
    });
}

async function GetFromAPI($url) {
    try {
        $('#loadingContetLoader').show();
        return await fetch(`${$url}`).then(function ($list) {
            $('#loadingContetLoader').hide();
            console.dir($list);
            return $list;
        }).catch(function ($err) {
            $('#loadingContetLoader').hide();
            console.dir($err);
        });
    } catch (err) {
        throw err;
    }
}

function IDRToDecimal($val) {
    return parseFloat($val.replace(/[^0-9.-]/g, ''))
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

function LoadingInput($section, $elemnt) {
    if ($section == 'loading') {
        $(`#${$elemnt}_autocomplete_container div #search-icon`).hide();
        $(`#${$elemnt}_autocomplete_container div #loading-icon`).show();
    }

    if ($section == 'idle') {
        $(`#${$elemnt}_autocomplete_container div #search-icon`).show();
        $(`#${$elemnt}_autocomplete_container div #loading-icon`).hide();
    }
}

function LoginAjaxSection($postFormData, $token) {
    $("#_csrf-token").val($token);
    $("#csrf-token").val($token);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $token,
        },
    });

    $.ajax({
        url: `${$base_url}/login`,
        type: "POST",
        data: $postFormData,
        xhrFields: {
            withCredentials: true
        },
        headers: {
            'X-CSRF-TOKEN': $token
        },
        success: function (callback) {
            console.dir('success', callback);
            toastr.success('berhasil login!', "Success!");

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
            console.dir('error', callback);

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
            $(".hideBtnProcess").show();

            Swal.fire({
                title: "Kesalahan!",
                text: message || messages || errorInfo || validator,
                icon: "error"
            }).then(function () {
                window.location.reload();
            });
        },
    });
}

function OpenLink($link, $options = ["self", "new", "popup"]) {
    const base_url = window.location.host;
    const [host, port] = base_url.split(':');
    const $base_url = (IsValidVal(port) ? `http://${host}:${port}` : `https://${host}`);

    if ($options == "self") {
        window.location.href = `${$base_url}${$link}`;
    }

    if ($options == "new") {
        window.open(`${$base_url}${$link}`, "_blank");
    }

    if ($options == "popup") {
        window.open(`${$base_url}${$link}`, "_blank", "width=800,height=600,top=100,left=100,resizable=yes,scrollbars=yes");
    }
}

function CreatePopUpModal($idContainer, $valModal, $txtOpen, $formID, $formOnSubmit, $slot, $btn_submit = "Simpan", $btn_reset = "Reset", $btn_close = "Tutup", $head_name = null, $head_description = null, $footer_description = null) {
    const $htmlBtnOpen = (IsValidVal($txtOpen) ? `<button class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary focus:bg-primary active:bg-primary focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" @click="${$valModal} = true">${$txtOpen}</button>` : "");
    const $htmlTxtHead = (IsValidVal($head_name) ? `<h2 class="text-lg font-bold">${$head_name}</h2>` : "");
    const $htmlTxtDescription = (IsValidVal($head_description) ? `<div class="mt-6 flex justify-center"><p class="mt-4">${$head_description}</p></div>` : "");
    const $htmlTxtFoot = (IsValidVal($footer_description) ? `<div class="mt-6 flex justify-center"><p class="mt-4">${$footer_description}</p></div>` : "");
    const $htmlBtnClose = (IsValidVal($btn_close) ? `<span class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 cursor-pointer" @click="${$valModal} = false">${$btn_close}</span>` : "");
    const $htmlBtnReset = (IsValidVal($btn_reset) ? `<button type="reset" class="inline-flex items-center px-4 py-2 bg-danger border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-danger focus:bg-danger active:bg-danger focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 hideBtnProcess ms-3">${$btn_reset}</button>` : "");
    const $htmlBtnSubmit = (IsValidVal($btn_submit) ? `<button type="submit" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary focus:bg-primary active:bg-primary focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" @submit.prevent="${$formOnSubmit}">${$btn_submit}</button>` : "");
    const $htmlSlot = (IsValidVal($slot) ? $slot : "");

    const $htmlForm = (IsValidVal($formID) ? `
    <form id="${$formID}" @submit.prevent="${$formOnSubmit}">
        <div class="mt-4">
            ${$htmlSlot}
        </div>

        <div class="mt-6 flex justify-end space-x-2">
            ${$htmlTxtFoot}

            ${$htmlBtnClose}

            ${$htmlBtnReset}

            ${$htmlBtnSubmit}
        </div>
    </form>
    ` : "");

    const html = `
    ${$htmlBtnOpen}

    <div id="modal_section">
        <div x-show="${$valModal}" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">
            <div class="bg-white w-full max-w-md mx-auto rounded-lg shadow-lg p-6" @click.away="${$valModal} = false"
                @keydown.escape.window="${$valModal} = false">
                <div class="flex justify-between items-center border-b pb-3">
                    ${$htmlTxtHead}
                    <button @click="${$valModal} = false" class="text-gray-500 hover:text-gray-700">
                        &times;
                    </button>
                </div>

                ${$htmlTxtDescription}

                ${$htmlForm}
            </div>
        </div>
    </div>
    `;

    $(`${$idContainer}`).html(html);
}
