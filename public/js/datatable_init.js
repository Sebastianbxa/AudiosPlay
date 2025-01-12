$(document).ready(function() {
    $('#table_info').DataTable({
        "order": [],
        destroy: true,
        "lengthMenu": [[50,100,200, -1], [50,100,200, "Todos"]],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        responsive: true,
    });
});