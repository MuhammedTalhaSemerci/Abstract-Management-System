function toUpper(Kume) {
    var index = Kume.selectionStart;
    Kume.value = Kume.value.replace("ı", "I").replace("i", "İ").toUpperCase();
    Kume.selectionStart = index;
    Kume.selectionEnd = index;
}

function UyariBilgilendirme(Baslik, Icerik, Sonuc) {
    $(document).ready(function () {
        if (Sonuc === undefined) {
            $('#UyariHead').css('background-color', 'transparent');
            $('#UyariBaslik').css('color', '#000');
            $('#UyariKapatButon').css('display', 'none');
        }
        else {
            if (Sonuc) {
                $('#UyariHead').css('background-color', 'darkseagreen');
                $('#UyariBaslik').css('color', '#fff');
            }
            else {
                $('#UyariHead').css('background-color', '#f00');
                $('#UyariBaslik').css('color', '#fff');
            }
            $('#UyariKapatButon').css('display', 'inline-block');
        }


        $('#UyariBaslik').html(Baslik);
        $('#UyariIcerik').html(Icerik);
        $('#Uyari').modal('show');
    });
}

function AltSayfaUyariBilgilendirme(Baslik, Icerik, Sonuc) {

    $.howl({
        type: Sonuc ? 'success' : 'danger'
        , title: Baslik
        , content: Icerik
        , sticky: false
        , lifetime: 5000
        , iconCls: Sonuc ? 'fa fa-check' : 'fa fa-exclamation'
    });
}

function SponsorGorselKontrol(Kume) {
    var img;
    var _URL = window.URL || window.webkitURL;
    var fu = document.getElementById(Kume.id);
    if (typeof fu !== "undefined") {
        switch (fu.files[0].type) {
            case "image/png":
            case "image/jpeg":
                if (fu.files[0].size < 4096000) {
                    img = new Image();
                    img.onload = function () {
                        if (this.width === 1110 && this.height === 100) {
                            var FR = new FileReader();
                            FR.addEventListener("load", function (e) {
                                $(hfSponsorGorsel).val(e.target.result.replace(/^data:image.+;base64,/, ''));
                            });
                            FR.readAsDataURL(fu.files[0]);
                        }
                        else {
                            fu.value = '';
                            UyariBilgilendirme('', 'Görseliniz 1110 x 100 px olamlıdır. Göndermiş olduğunuz görsel ölçüleri, ' + this.width + ' x ' + this.height, false);
                        }
                    };
                    img.src = _URL.createObjectURL(fu.files[0]);
                }
                else {
                    fu.value = '';
                    UyariBilgilendirme('', 'Görseliniz en fazla 4mb olamlıdır.', false);
                }
                break


            default:
                fu.value = '';
                UyariBilgilendirme('', 'Görselinizin uzantısı "png" ya da "jpg" olmalıdır.', false);
                break;
        }
    }
}

function DataTableKurulum(isPartialLoad) {
    if ($.fn.dataTable) {
        $('[data-provide="datatable"]').each(function () {
            $(this).addClass('dataTable-helper');
            var defaultOptions = {
                paginate: false,
                search: false,
                info: false,
                lengthChange: false,
                displayRows: 10,
                saveState: true
            },
                dataOptions = $(this).data(),
                helperOptions = $.extend(defaultOptions, dataOptions),
                $thisTable,
                tableConfig = {};

            tableConfig.iDisplayLength = helperOptions.displayRows;
            tableConfig.bFilter = true;
            tableConfig.bSort = true;
            tableConfig.bPaginate = false;
            tableConfig.bLengthChange = false;
            tableConfig.bInfo = false;

            if (helperOptions.paginate) { tableConfig.bPaginate = true; }
            if (helperOptions.lengthChange) { tableConfig.bLengthChange = true; }
            if (helperOptions.info) { tableConfig.bInfo = true; }
            if (helperOptions.search) { $(this).parent().removeClass('datatable-hidesearch'); }

            tableConfig.aaSorting = [];
            tableConfig.aoColumns = [];

            $(this).find('thead tr th').each(function (index, value) {
                var sortable = ($(this).data('sortable') === true) ? true : false;
                tableConfig.aoColumns.push({ 'bSortable': sortable });

                if ($(this).data('direction')) {
                    tableConfig.aaSorting.push([index, $(this).data('direction')]);
                }
            });

            // Create the datatable
            $thisTable = $(this).dataTable(tableConfig);

            if (!helperOptions.search) {
                $thisTable.parent().find('.dataTables_filter').remove();
            }

            var filterableCols = $thisTable.find('thead th').filter('[data-filterable="true"]');

            if (filterableCols.length > 0) {
                var columns = $thisTable.fnSettings().aoColumns,
                    $row, th, $col, showFilter;

                $row = $('<tr>', { cls: 'dataTable-filter-row' }).appendTo($thisTable.find('thead'));

                for (var i = 0; i < columns.length; i++) {
                    $col = $(columns[i].nTh.outerHTML);
                    showFilter = ($col.data('filterable') === true) ? 'show' : 'hide';

                    th = '<th class="' + $col.prop('class') + '">';
                    th += '<input type="text" class="form-control input-sm ' + showFilter + '" placeholder="' + $col.text() + '">';
                    th += '</th>';
                    $row.append(th);
                }

                $row.find('th').removeClass('sorting sorting_disabled sorting_asc sorting_desc sorting_asc_disabled sorting_desc_disabled');

                $thisTable.find('thead input').keyup(function () {
                    $thisTable.fnFilter(this.value, $thisTable.oApi._fnVisibleToColumnIndex(
                        $thisTable.fnSettings(), $thisTable.find('thead input[type=text]').index(this)));
                });

                $thisTable.addClass('datatable-columnfilter');
            }

            if (isPartialLoad) {
                $thisTable.state.clear();
                $thisTable.page(0).draw('page');
            }
        });

        $('.dataTables_filter input').prop('placeholder', 'Ara...');
    }
}

function SliderKontrol(Kume) {
    var fu = document.getElementById(Kume.id);
    if (typeof fu !== "undefined") {

        switch (fu.files[0].type) {

            case "image/jpeg":
            case "image/png":

                if (fu.files[0].size < 2048000) {
                    var _URL = window.URL || window.webkitURL;
                    var img = new Image();
                    img.onload = function () {
                        if (this.width === 1602 && this.height === 750) {
                            var FR = new FileReader();
                            FR.addEventListener("load", function (e) {
                                $(hfSliderGorsel).val(e.target.result.replace(/^data:image.+;base64,/, ''));
                            });
                            FR.readAsDataURL(fu.files[0]);
                        }
                        else {
                            AltSayfaUyariBilgilendirme('Dikkat', "<p>Görsel boyutlarınız 1602px ile 750px olmalıdır.</p>");
                            $(hfSliderGorsel).val('');
                            fu.value = '';
                        }
                    };
                    img.src = _URL.createObjectURL(fu.files[0]);
                }
                else {
                    AltSayfaUyariBilgilendirme('Dikkat', '<p>Dosyanız en fazla 2MB olmalıdır.</p>');
                    $(hfSliderGorsel).val('');
                    fu.value = '';
                }

                break;

            default:
                AltSayfaUyariBilgilendirme('Dikkat', '<p>Dosyanız uygun resim formatında değildir.</p><p>Dosyanız PNG yada JPG olmalıdır.</p>');
                $(hfSliderGorsel).val('');
                fu.value = '';
                break;
        }
    }
}