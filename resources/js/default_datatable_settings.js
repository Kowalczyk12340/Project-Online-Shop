var defaultDatatableSettings = {
    pageLength: 10,
    lengthMenu: [[10, 50, 100, 200], [10, 50, 100, 200]],
    stateSave: true,    //zapamiętuje stan ustawień, m. in. widoczność kolumn
    stateDuration: 604800, //czas zapamiętywania ustawień - 1 tydzień (60 * 60 * 24 * 7)
    // wyszukiwanie po poszczególnych kolumnach
    initComplete: function (settings, json) {
        // odtworzenie zapisanego stanu
        let api = new $.fn.dataTable.Api(settings);
        let state = api.state.loaded();

        this.api().columns().every(function (colIdx) {
            var column = this;
            //szukana wartość kolumny w odtworzonym stanie
            let  colSearch = undefined;
            if(state) {
                colSearch = state.columns[colIdx].search;
            }
            //aby dało się przeszukiwać po danej kolumnie musi ona posiadać klasę searchable
            if($(this.footer()).hasClass('searchable')) {
                // // szukanie za pomocą pola select
                if($(this.footer()).hasClass('searchable-selectable')) {
                    let select = $(this.footer()).find('select')[0];
                    if(select !== undefined) {
                        if(colSearch != undefined) {
                            $(select).val(colSearch.search);
                            $(select).on('change', function () {
                                column.search(
                                    $(this).val()
                                ).draw();
                            });
                        }

                    }
                } else if($(this.footer()).hasClass('searchable-select2')) {
                    let select = $(this.footer()).find('select')[0];
                    if(select !== undefined) {
                        if(colSearch != undefined) {
                            $(select).val(colSearch.search);
                            $(select).select2({
                                theme: 'bootstrap5',
                                placeholder: $(select).data('placeholder'),
                                width: '100%',
                                allowClear: true
                            });
                            $(select).on('select2:select', function (e) {
                                let selectedOption = $(e.currentTarget).val();
                                if(selectedOption == undefined || selectedOption == null) {
                                    return;
                                }
                                column.search(
                                    selectedOption
                                ).draw();
                            }).on('select2:clear', function (e) {
                                column.search('').draw();
                            });
                        }
                    }                    
                } else {
                    // wyszukiwanie za pomocą pola input
                    let input = $(this.footer()).find('input')[0];
                    if(input !== undefined) {
                        if(colSearch != undefined) {
                            $(input).val(colSearch.search);
                        }
                        $(input).on('keyup change', function () {
                            if(column.search() !== this.value) {
                                column.search(this.value).draw();
                            }
                        });
                    }
                }
            }
        });
     }
}
