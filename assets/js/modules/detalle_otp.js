$(function () {
    $('.select2_js_detalles').select2();
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



    $('#btn_observacion').on('click', function(){
            var algo = $(this);
            var tr = algo.parents('tr');
            var sel = tr.find('select').val();
            var txtArea = tr.find('textarea').val();
            var id_otp = tr.find('td').eq(0).html();
    
            $.post(baseurl + '/OtPadre/update_data',
                    {
                        // clave: 'valor' // parametros que se envian
                        id: id_otp,
                        lista: sel,
                        observacion: txtArea,
                    },
                    function (data) {
                        var res = JSON.parse(data);
                        if (res == 1) {
                            alert("Se actualizó correctamente");
                            location.reload();
                        } else {
                            console.log(res);
                            alert('error de actualización');
                        }
                    });


    //     swal({
    //           title: "Are you sure?",
    //           text: "Once deleted, you will not be able to recover this imaginary file!",
    //           icon: "warning",
    //           buttons: true,
    //           dangerMode: true,
    //         })
    //         .then((willDelete) => {
    //           if (willDelete) {
    //             swal("Poof! Your imaginary file has been deleted!", {
    //               icon: "success",
    //             });
    //           } else {
    //             swal("Your imaginary file is safe!");
    //           }
    //         });



    });

