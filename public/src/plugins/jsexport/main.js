// codigo para mostrar titulo en tilde
$(function () { $('[data-toggle="tooltip"]').tooltip() })

// codigo para menu vertical
$("#menu-toggle").click(function(e) { e.preventDefault(); $("#wrapper").toggleClass("toggled"); });

//codigo para datatblejs
$(document).ready(function() { 

	$('#tabla').DataTable({
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
    language: {
        "search": "",
        "searchPlaceholder": "Buscar",
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_",
        "infoEmpty": "Mostrando 0 a 0 de 0",
        "infoFiltered": "(Filtrado de _MAX_)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "zeroRecords": "Sin resultados",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    }}); 
	
	$('#tabla2').DataTable({
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
    language: {
        "search": "",
        "searchPlaceholder": "Buscar",
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_",
        "infoEmpty": "Mostrando 0 a 0 de 0",
        "infoFiltered": "(Filtrado de _MAX_)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "zeroRecords": "Sin resultados",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    }}); 
	
	
});

$(document).ready(function(){
	$('#boton_excel').hide();
});

window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 4000);