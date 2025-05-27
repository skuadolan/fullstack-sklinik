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

function InitAutocomplete() {
    $(document).ready(function () {
        if ($("#provinsi").length) {
            $("#provinsi").autocomplete({
                source: async function (request, response) {
                    if (request.term.length < 1) return;

                    LoadingInput('loading', 'provinsi');

                    try {
                        const { datas } = await $.ajax({
                            url: `/api/search?get_data=provinsi`,
                            data: { q: request.term },
                        });

                        LoadingInput('idle', 'provinsi');

                        response(datas.length ? datas : [{ name: 'Data tidak ditemukan', id: '' }]);
                    } catch (error) {
                        console.dir("error", error);
                        LoadingInput('idle', 'provinsi');
                        response([{ name: 'Data tidak ditemukan', id: '' }]);
                    }
                },
                minLength: 1,
                focus: function (_, ui) {
                    if (ui.item.id) {
                        $("#provinsi").val(ui.item.name);
                        $("#id_provinsi").val(ui.item.id);
                    }
                    return false;
                },
                select: function (_, ui) {
                    if (ui.item.id) {
                        $("#provinsi").val(ui.item.name);
                        $("#id_provinsi").val(ui.item.id);
                    }
                    return false;
                }
            }).autocomplete("instance")._renderItem = function (ul, item) {
                return $("<li>").append(`<div>Provinsi: <strong>${item.name}</strong></div>`).appendTo(ul);
            };
        }

        if ($("#kabupaten").length) {
            $("#kabupaten").autocomplete({
                source: async function (request, response) {
                    if (request.term.length < 1) return;

                    LoadingInput('loading', 'kabupaten');

                    try {
                        const { datas } = await $.ajax({
                            url: `/api/search?get_data=kabupaten`,
                            data: { q: request.term, id_provinsi: (IsValidVal($("#provinsi").val()) ? $("#id_provinsi").val() : null) },
                        });

                        LoadingInput('idle', 'kabupaten');
                        response(datas.length ? datas : [{ name: 'Data tidak ditemukan', id: '' }]);
                    } catch (error) {
                        console.dir("error", error);
                        LoadingInput('idle', 'kabupaten');
                        response([{ name: 'Data tidak ditemukan', id: '' }]);
                    }
                },
                minLength: 1,
                focus: function (_, ui) {
                    if (ui.item.id) {
                        $("#kabupaten").val(ui.item.name);
                        $("#id_kabupaten").val(ui.item.id);
                    }
                    return false;
                },
                select: function (_, ui) {
                    if (ui.item.id) {
                        $("#kabupaten").val(ui.item.name);
                        $("#id_kabupaten").val(ui.item.id);
                    }
                    return false;
                }
            }).autocomplete("instance")._renderItem = function (ul, item) {
                return $("<li>").append(`<div><strong>${item.name}</strong></div>`).appendTo(ul);
            };
        }

        if ($("#kecamatan").length) {
            $("#kecamatan").autocomplete({
                source: async function (request, response) {
                    if (request.term.length < 1) return;

                    LoadingInput('loading', 'kecamatan');

                    try {
                        const { datas } = await $.ajax({
                            url: `/api/search?get_data=kecamatan`,
                            data: { q: request.term, id_kabupaten: IsValidVal($("#kabupaten").val()) ? $("#id_kabupaten").val() : null },
                        });

                        LoadingInput('idle', 'kecamatan');
                        response(datas.length ? datas : [{ name: 'Data tidak ditemukan', id: '' }]);
                    } catch (error) {
                        console.dir("error", error);
                        LoadingInput('idle', 'kecamatan');
                        response([{ name: 'Data tidak ditemukan', id: '' }]);
                    }
                },
                minLength: 1,
                focus: function (_, ui) {
                    if (ui.item.id) {
                        $("#kecamatan").val(ui.item.name);
                        $("#id_kecamatan").val(ui.item.id);
                    }
                    return false;
                },
                select: function (_, ui) {
                    if (ui.item.id) {
                        $("#kecamatan").val(ui.item.name);
                        $("#id_kecamatan").val(ui.item.id);
                    }
                    return false;
                }
            }).autocomplete("instance")._renderItem = function (ul, item) {
                return $("<li>").append(`<div>Kecamatan: <strong>${item.name}</strong></div>`).appendTo(ul);
            };
        }

        if ($("#kelurahan").length) {
            $("#kelurahan").autocomplete({
                source: async function (request, response) {
                    if (request.term.length < 1) return;

                    LoadingInput('loading', 'kelurahan');

                    try {
                        const { datas } = await $.ajax({
                            url: `/api/search?get_data=kelurahan`,
                            data: { q: request.term, id_kecamatan: (IsValidVal($("#kecamatan").val()) ? $("#id_kecamatan").val() : null) },
                        });

                        LoadingInput('idle', 'kelurahan');
                        response(datas.length ? datas : [{ name: 'Data tidak ditemukan', id: '' }]);
                    } catch (error) {
                        console.dir("error", error);
                        LoadingInput('idle', 'kelurahan');
                        response([{ name: 'Data tidak ditemukan', id: '' }]);
                    }
                },
                minLength: 1,
                focus: function (_, ui) {
                    if (ui.item.id) {
                        $("#kelurahan").val(ui.item.name);
                        $("#id_kelurahan").val(ui.item.id);
                    }
                    return false;
                },
                select: function (_, ui) {
                    if (ui.item.id) {
                        $("#kelurahan").val(ui.item.name);
                        $("#id_kelurahan").val(ui.item.id);
                    }
                    return false;
                }
            }).autocomplete("instance")._renderItem = function (ul, item) {
                return $("<li>").append(`<div>Kelurahan: <strong>${item.name}</strong></div>`).appendTo(ul);
            };
        }

        if ($("#goldar").length) {
            $("#goldar").autocomplete({
                source: async function (request, response) {
                    if (request.term.length < 1) return;

                    LoadingInput('loading', 'goldar');

                    try {
                        const { datas } = await $.ajax({
                            url: `/api/search?get_data=goldar`,
                            data: { q: request.term },
                        });

                        LoadingInput('idle', 'goldar');
                        response(datas.length ? datas : [{ name: 'Data tidak ditemukan', id: '' }]);
                    } catch (error) {
                        console.dir("error", error);
                        LoadingInput('idle', 'goldar');
                        response([{ name: 'Data tidak ditemukan', id: '' }]);
                    }
                },
                minLength: 1,
                focus: function (_, ui) {
                    if (ui.item.id) {
                        $("#goldar").val(ui.item.name);
                        $("#id_goldar").val(ui.item.id);
                    }
                    return false;
                },
                select: function (_, ui) {
                    if (ui.item.id) {
                        $("#goldar").val(ui.item.name);
                        $("#id_goldar").val(ui.item.id);
                    }
                    return false;
                }
            }).autocomplete("instance")._renderItem = function (ul, item) {
                return $("<li>").append(`<div>Golongan Darah: <strong>${item.name}</strong></div>`).appendTo(ul);
            };
        }
    });
}

function TxtCheckInputSymbol($this) {
    const $invalidChars = /[<>\/'";`\\!@#$%^&*]/g;
    let $newVal = $($this).val();

    if ($invalidChars.test($newVal)) {
        AllNotify(`Simbol <i><strong>${$newVal}</strong></i></br> Tidak diperbolehkan!`, "error");
        $($this).val($newVal.replace($invalidChars, ""));
    }
}

function HiddenAddressDropdown() {
    if ($(".address_hidden").length) {
        $(".address_hidden").each(function() {
            $(this).hide();
        });

        // On Address Changes START
        const $id_provinsi = document.getElementById("id_provinsi");
        const $obsIDProv = new MutationObserver(() => {
            if ($id_provinsi.value) {
                $("#container_kabupaten").show();
            }
        });
        $obsIDProv.observe($id_provinsi, { attributes: true, attributeFilter: ["value"] });

        const $id_kabupaten = document.getElementById("id_kabupaten");
        const $obsIDKab = new MutationObserver(() => {
            if ($id_kabupaten.value) {
                $("#container_kecamatan").show();
            }
        });
        $obsIDKab.observe($id_kabupaten, { attributes: true, attributeFilter: ["value"] });

        const $id_kecamatan = document.getElementById("id_kecamatan");
        const $obsIDKec = new MutationObserver(() => {
            if ($id_kecamatan.value) {
                $("#container_kelurahan").show();
            }
        });
        $obsIDKec.observe($id_kecamatan, { attributes: true, attributeFilter: ["value"] });
        // On Address Changes END
    }
}

function AllNotify($msg, $section) {
    if ($section == "success") {
        Swal.fire({
            title: "Berhasil!",
            html: $msg,
            icon: "success",
            confirmButtonColor: "#3085d6",
        })
        toastr.success($msg, "Berhasil!");
    }

    if ($section == "error") {
        Swal.fire({
            title: "Kesalahan!",
            html: $msg,
            icon: "error",
            confirmButtonColor: "#3085d6",
        })
        toastr.error($msg, "Kesalahan!");
    }

    if ($section == "warning") {
        Swal.fire({
            title: "Peringatan!",
            html: $msg,
            icon: "warning",
            confirmButtonColor: "#3085d6",
        })
        toastr.warning($msg, "Peringatan!");
    }

    if ($section == "info") {
        Swal.fire({
            title: "Sekilas Info!",
            html: $msg,
            icon: "info",
            confirmButtonColor: "#3085d6",
        })
        toastr.info($msg, "Sekilas Info!");
    }
}

function LoadingNotify($msg, $section, $isElmentShow, $isContentLoader) {
    if ($section == "success") {
        toastr.success($msg, "Berhasil!");
    }

    if ($section == "error") {
        toastr.error($msg, "Kesalahan!");
    }

    if ($section == "warning") {
        toastr.warning($msg, "Peringatan!");
    }

    if ($section == "info") {
        toastr.info($msg, "Informasi!");
    }

    if ($isContentLoader) {
        if ($isElmentShow) {
            $('#loadingContetLoader').show();
        } else {
            $('#loadingContetLoader').hide();
        }
    } else {
        if ($isElmentShow) {
            $('#loadingAjax').show();
        } else {
            $('#loadingAjax').hide();
        }
    }
}

function ClassDOMInputStrict() {
    const $inputs = $(".convert_to_idr, .input_number_only, .capitalize, .text-capitalize-input, .text-check-input-symbol, .text-number-input");

    $inputs.on("input", function(e) {
        const $this = $(this);
        const value = $this.val();

        if ($this.hasClass("convert_to_idr")) {
            $this.val(new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", minimumFractionDigits: 2}).format(value.replace(/[^0-9]/g, "")));
        } else if ($this.hasClass("input_number_only")) {
            $this.val(value.replace(/[^0-9]/g, ""));
        } else if ($this.hasClass("capitalize")) {
            $this.val(value.toLowerCase().replace(/\b\w/g, char => char.toUpperCase()));
        } else if ($this.hasClass("text-capitalize-input")) {
            TxtCheckInputSymbol(this);
            $this.val(value.toLowerCase().replace(/\b\w/g, char => char.toUpperCase()));
        } else if ($this.hasClass("text-check-input-symbol")) {
            TxtCheckInputSymbol(this);
        } else if ($this.hasClass("text-number-input")) {
            TxtCheckInputSymbol(this);
            $this.val(value.replace(/\D/g, ""));
        }
    });
}

function ClearLocalStorage() {
    localStorage.removeItem("search_params");
}
