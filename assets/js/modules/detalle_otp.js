$(function () {
    $('#detalles_otp').DataTable();
    $('#detalles_oth').DataTable({
        initComplete: function () {
            $('#detalles_oth tfoot th').each(function () {
                $(this).html('<input type="text" placeholder="Buscar" />');
            });
            var r = $('#detalles_oth tfoot tr');
            r.find('th').each(function () {
                $(this).css('padding', 8);
            });
            $('#detalles_oth thead').append(r);
            $('#search_0').css('text-align', 'center');

            // DataTable
            var table = $('#detalles_oth').DataTable();

            // Apply the search
            table.columns().every(function () {
                var that = this;

                $('input', this.footer()).on('keyup change', function () {
                    if (that.search() !== this.value) {
                        that.search(this.value).draw();
                    }
                });
            });
        }
    });
});

function showModalDetalles(idOth) {
    document.getElementById("formModal_detalle").reset();
    $('#title_modal').html('');
    $.post(baseurl + '/OtHija/c_fillmodals',
            {
                idOth: idOth // parametros que se envian
            },
            function (data) {
                $.each(data, function (i, item) {
                    $('#mdl_' + i).val(item);
                });
            });
    $('#title_modal').html('<b>Detalle de la orden  ' + idOth + '</b>');
    $('#Modal_detalle').modal('show');
}