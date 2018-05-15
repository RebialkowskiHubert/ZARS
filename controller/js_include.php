<script src="../js/jquery-2.2.4.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/datatables.min.js"></script>
<script src="../js/jquery.validate.min.js"></script>
<script src="../js/messages_pl.js"></script>
<script src="../js/jquery-ui.js"></script>
<script src="../js/global.js"></script>
<script>
    function dataTable(table) {
        tabela = $(table).DataTable({
            "language": {
                processing: "Przetwarzanie...",
                search: "Szukaj:",
                lengthMenu: "Pokaż _MENU_ pozycji",
                info: "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
                infoEmpty: "Pozycji 0 z 0 dostępnych",
                infoFiltered: "(filtrowanie spośród _MAX_ dostępnych pozycji)",
                infoPostFix: "",
                loadingRecords: "Wczytywanie...",
                zeroRecords: "Nie znaleziono pasujących pozycji",
                emptyTable: "Brak danych",
                paginate: {
                    first: "Pierwsza",
                    previous: "Poprzednia",
                    next: "Następna",
                    last: "Ostatnia"
                },
                aria: {
                    sortAscending: ": aktywuj, by posortować kolumnę rosnąco",
                    sortDescending: ": aktywuj, by posortować kolumnę malejąco"
                }
            },
            responsive: true,
            destroy: true
        });
        
        return tabela;
    }
</script>