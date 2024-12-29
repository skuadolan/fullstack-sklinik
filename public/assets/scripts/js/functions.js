function DisableRightClickOnMouse() {
    function disabledSelection(e) {
        return false;
    }

    function reEnable() {
        return true;
    }

    document.onselectstart = new Function("return false");

    if (window.sidebar) {
        document.onmousedown = disabledSelection;
        document.onclick = reEnable;
    }
}

function JQueryOnLoad() {
    // AJAX SECTION START
    // Tampilkan loading overlay saat form dikirim
    // $(document).on("submit", "form", function () {
    //     $("#loadingAjax").removeClass("hidden");
    // });

    // Tampilkan loading overlay untuk Ajax request
    // $(document).ajaxStart(function () {
    //     $("#loadingAjax").removeClass("hidden");
    // });

    // Sembunyikan loading overlay setelah Ajax selesai
    // $(document).ajaxStop(function () {
    //     $("#loadingAjax").addClass("hidden");
    // });
    // AJAX SECTION END
}

function AutoToIDR() {
    $(".convert_to_idr").on("input", function () {
        let value = $(this).val().replace(/[^0-9]/g, "");
        let formatted = new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", minimumFractionDigits: 2}).format(value);
        $(this).val(formatted);
    });
}

function InputNumberOnly() {
    $(".input_number_only").on("input", function () {
        let value = $(this).val().replace(/[^0-9]/g, "");
        $(this).val(value);
    });
}

function InitAutocomplete() {
    $(document).ready(function () {
        $("#provinsi").autocomplete({
            source: function (request, response) {
                if (request.term.length >= 1) {
                    LoadingInput('loading', 'provinsi');

                    $.ajax({
                        url: `/api/search?get_data=provinsi`,
                        data: { q: request.term },
                        success: function (callback) {
                            LoadingInput('idle', 'provinsi');
                            console.dir("success", callback);

                            if ((callback.datas).length || (callback.datas).length > 0) {
                                response(callback.datas);
                            } else {
                                response([{ name: 'Data tidak ditemukan', id: '' }]);
                            }
                        },
                        error: function (callback) {
                            console.dir("error", callback);
                            LoadingInput('idle', 'provinsi');
                            response([{ name: 'Data tidak ditemukan', id: '' }]);
                        },
                    });
                }
            },
            minLength: 1,
            focus: function (event, ui) {
                if (ui.item.id) {
                    $("#provinsi").val(ui.item.name);
                    $("#id_provinsi").val(ui.item.id);
                }
                return false;
            },
            select: function (event, ui) {
                if (ui.item.id) {
                    $("#provinsi").val(ui.item.name);
                    $("#id_provinsi").val(ui.item.id);
                }
                return false;
            }
        }).autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>").append(`<div>Provinsi: <strong>${item.name}</strong></div>`).appendTo(ul);
        };

        $("#kabupaten").autocomplete({
            source: function (request, response) {
                if (request.term.length >= 1) {
                    LoadingInput('loading', 'kabupaten');

                    $.ajax({
                        url: `/api/search?get_data=kabupaten`,
                        data: { q: request.term, id_provinsi: (IsValidVal($("#provinsi").val()) ? $("#id_provinsi").val() : null) },
                        success: function (callback) {
                            LoadingInput('idle', 'kabupaten');
                            console.dir("success", callback);

                            if ((callback.datas).length || (callback.datas).length > 0) {
                                response(callback.datas);
                            } else {
                                response([{ name: 'Data tidak ditemukan', id: '' }]);
                            }
                        },
                        error: function (callback) {
                            console.dir("error", callback);
                            LoadingInput('idle', 'kabupaten');
                            response([{ name: 'Data tidak ditemukan', id: '' }]);
                        },
                    });
                }
            },
            minLength: 1,
            focus: function (event, ui) {
                if (ui.item.id) {
                    $("#kabupaten").val(ui.item.name);
                    $("#id_kabupaten").val(ui.item.id);
                }
                return false;
            },
            select: function (event, ui) {
                if (ui.item.id) {
                    $("#kabupaten").val(ui.item.name);
                    $("#id_kabupaten").val(ui.item.id);
                }
                return false;
            }
        }).autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>").append(`<div><strong>${item.name}</strong></div>`).appendTo(ul);
        };

        $("#kecamatan").autocomplete({
            source: function (request, response) {
                if (request.term.length >= 1) {
                    LoadingInput('loading', 'kecamatan');

                    $.ajax({
                        url: `/api/search?get_data=kecamatan`,
                        data: { q: request.term, id_kabupaten: (IsValidVal($("#kabupaten").val()) ? $("#id_kabupaten").val() : null) },
                        success: function (callback) {
                            LoadingInput('idle', 'kecamatan');
                            console.dir("success", callback);

                            if ((callback.datas).length || (callback.datas).length > 0) {
                                response(callback.datas);
                            } else {
                                response([{ name: 'Data tidak ditemukan', id: '' }]);
                            }
                        },
                        error: function (callback) {
                            console.dir("error", callback);
                            LoadingInput('idle', 'kecamatan');
                            response([{ name: 'Data tidak ditemukan', id: '' }]);
                        },
                    });
                }
            },
            minLength: 1,
            focus: function (event, ui) {
                if (ui.item.id) {
                    $("#kecamatan").val(ui.item.name);
                    $("#id_kecamatan").val(ui.item.id);
                }
                return false;
            },
            select: function (event, ui) {
                if (ui.item.id) {
                    $("#kecamatan").val(ui.item.name);
                    $("#id_kecamatan").val(ui.item.id);
                }
                return false;
            }
        }).autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>").append(`<div>Kecamatan: <strong>${item.name}</strong></div>`).appendTo(ul);
        };

        $("#kelurahan").autocomplete({
            source: function (request, response) {
                if (request.term.length >= 1) {
                    LoadingInput('loading', 'kelurahan');

                    $.ajax({
                        url: `/api/search?get_data=kelurahan`,
                        data: { q: request.term, id_kecamatan: (IsValidVal($("#kecamatan").val()) ? $("#id_kecamatan").val() : null) },
                        success: function (callback) {
                            LoadingInput('idle', 'kelurahan');
                            console.dir("success", callback);

                            if ((callback.datas).length || (callback.datas).length > 0) {
                                response(callback.datas);
                            } else {
                                response([{ name: 'Data tidak ditemukan', id: '' }]);
                            }
                        },
                        error: function (callback) {
                            console.dir("error", callback);
                            LoadingInput('idle', 'kelurahan');
                            response([{ name: 'Data tidak ditemukan', id: '' }]);
                        },
                    });
                }
            },
            minLength: 1,
            focus: function (event, ui) {
                if (ui.item.id) {
                    $("#kelurahan").val(ui.item.name);
                    $("#id_kelurahan").val(ui.item.id);
                }
                return false;
            },
            select: function (event, ui) {
                if (ui.item.id) {
                    $("#kelurahan").val(ui.item.name);
                    $("#id_kelurahan").val(ui.item.id);
                }
                return false;
            }
        }).autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>").append(`<div>Kelurahan: <strong>${item.name}</strong></div>`).appendTo(ul);
        };
    });
}
