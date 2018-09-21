$(function () {
    helper = {
        init: function () {
            helper.events();            
        },

        //Eventos de la ventana.
        events: function () {
        
        },

        // Muestra un pequeño mensaje (alert) en la parte superior derecha comunicando que se canceló la accion
        miniAlert: function(title='Acción Cancelada', tipo = 'error'){
            const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                toast({
                    type: tipo,
                    title: title
                });
        },

        // Función que permite pintar la tabla con los campos de busqueda 
        // Los parametros son: Data que recibe los datos, columns: los números de columns en la tabla, IdTabke: Es el id de la tabla a pintar
        // ordenColumn:posicion para organizar las columnas y el ordenBy: la informacion se va a organizar de forma ascendente
        configTableSearchColumn: function (data, columns, idTable, ordenColumn, ordenBy ="asc" , numeric = 0) {
            
            return {
                initComplete: function () {
                    $('#'+idTable+' tfoot th').each(function () {
                        $(this).html('<input type="text" placeholder="Buscar" />');
                    });
                    var r = $('#'+idTable+' tfoot tr');
                    r.find('th').each(function () {
                        $(this).css('padding', 8);
                    });
                    $('#'+idTable+' thead').append(r);
                    $('#search_0').css('text-align', 'center');

                    // DataTable
                    var table = $('#'+idTable).DataTable();

                    // Apply the search
                    table.columns().every(function () {
                        var that = this;

                        $('input', this.footer()).on('keyup change', function () {
                            if (that.search() !== this.value) {
                                that.search(this.value).draw();
                            }
                        });
                    });
                },
                data: data,
                columns: columns,
                "language": {
                    "url": baseurl + "/assets/plugins/datatables/lang/es.json"
                },
                dom: 'Blfrtip',
                buttons: [
                    {
                        text: 'Excel <span class="fa fa-file-excel-o"></span>',
                        className: 'btn-cami_cool',
                        extend: 'excel',
                        title: 'ZOLID EXCEL',
                        filename: 'zolid ' + fecha_actual
                    },
                    {
                        text: 'Imprimir <span class="fa fa-print"></span>',
                        className: 'btn-cami_cool',
                        extend: 'print',
                        title: 'Reporte Zolid',
                    }
                ],
                select: true,
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                ordering: true,
                columnDefs: [{
                        // targets: -1,
                        // visible: false,
                        defaultContent: "",
                        // targets: -1,
                        orderable: false,
                    }],
                order: [[ordenColumn, ordenBy]],
                "aoColumnDefs": [
                  { "sType": "numeric", "aTargets": [ numeric ] }
                ],
                
            }
        },


        // funcion para clonar una seccion 
        // recibe que quiere clonar y que quiere añadirlo
        // al clonarlo adiciona un boton menos, por si se quiere usar para remover
        duplicar_seccion: function(que, donde){
            const seccion = que.clone().appendTo(donde);
            seccion.prepend(`<hr>
                    <span class="btn btn-danger f-r remover_seccion" style="margin-top:-40px"><i class="fa fa-minus"></i></span>`);
        },

        // funcion para remover una seccion
        // el elemento q dispara la funcion debe estar contenida en el div a remover
        remover_seccion: function(){
            const padre = $(this).parent('div');
            padre.remove();
        },

        // funcion que retona los datos del usuario que está en session
        // recibe el atributo de la session que se desea retornar
        // si no se le envia un argumento retorna todos los valores
        inSession: function(clave = false){
            let retornar;
            $.post(baseurl + '/User/getSessionValues', 
                {
                    clave: clave
                }
                , 
                function(data) {
                    const res = JSON.parse(data);
                    retornar = res;
            });
            return retornar;
        },

        //llenar automaticamente un formulario
        // se le debe pasar el id del formulario a llenar
        llenar_form: function(id_form){
                let day;
                let mes;

                let select_length;
                let id_select;
                let seleccionar;

            const frases = ['No more war','Lately these days','I get so paranoid','Theres so many stories of families broken','Fathers being deployed','All for this war that no one really wants','Too many dog tags','Too many headstones','Too many dying to count','And if we could today wed bring them all back home','But theyll never listen these politicians','Their hearts have turned to stone','And if we had a voice then by God wed be heard','But were so divided','And were undecided','So we never say a word','And we all go to sleep','Like good little sheet','Never make a peep','So Im taking a stand','And Im making demands','And Ill stand even if','I have to stand alone','And say bring the troops back home','With all of the beauty to behould in this world','Why would you want to feed the destruction','With all of the wonders to witness in this world','Why would you want to see armageddon','With all of the things that you could be in this world','Why would you go and be a soldier man','Oh I, oh I','I think I know why','Cause when you were three years old','They put a toy gun in your hand','And they showed you shows of g. I. Joes','How could you overstand','The difference between fiction and reality','Oh, if your parents knew how it impacted you','They would have burned the tv','But they were too busy','Working for the man','Yeah, they were too busy','Just fitting into the plans','So when you were six years old','They put you in the boy scouts','So harmless, it seemed to be marching','Waving the flag about','But they already got you wearing','That uniform on your back','Using weapons, earning medals','Gaining rank in your pack','Yeah, its the symbolism','That keeps you coming back','Exoteric symbolism','Into your subconscious they tap','Why its the symbolism','Keep you slipping through the cracks','Yeah, its the symbolism','Got your mind under attack','But youth put on your thinking cap','Dont get caught up in their trap, no','With all of the creativity in this world','Why would you create nuclear weapons','With all of the wonders to witness in this world','Why would you want to see armageddon','With all of the billion things to be in this world','Oh, why would you go and be a soldier man','Oh, I, oh, Im starting to see why','Cause when you were thirteen years old','You joined the rotc','The high school version of your immersion in the military','They got you dreaming of that m16 in your hand','Heroically killing enemies for democracy in a foreign land','Why its the mind control','That keeps you killing blindly','Government mind control','Been going on for centuries','So when you were eighteen years old','The recruiters came to your school','With fancy dress and propaganda','Trying to make you their fool','Telling you youre never gonna amount to anything','But look at all the rewards and benefits','Uncle sam can bring','Just sign on the dotted line','The officer says with a grin','Sign your name on the dotted line','Trust in us, well take you in','Just pick up the pen and sign','Well take care of everything','Sign your name on the dotted line','And your bright future can begin','But can you hear the bugle play','As you sign your life away','Give me one good reason','Give me one good outcome','From all of this killing','It dont make no sense','So many are dying','Orphaned babies crying','In the name of freedom','What a false pretense','But all the money','All the power','All the souls that you devour','Mister politician man','Could never equal','To the power of jah love','That I hold in the fingers','Of my pure clean hands','So mister soldier man','Im begging you to come back home','Oh, military man','Leave them war machines alone','Cause them politicians sit in their mansion','Reaping all the benefits','While you lay dying in the trenches','And they dont give a shit, no','Oh, lord theres got to be','A better way to communicate','I dont believe that killing men','Makes us more safe','Lord, I know the opposite is true','How bout you','Do you buy into the news','Have they got you so confused','When I feel the pressure in the air','I get so scared','Will we live to see another day','Another month, another year','How can I protect my family','From these crazy leaders addicted to war','Tell them we dont need no more of these','Broken dreams and fantasies','All fallen down the well','Oh, daddys gone','And left his family','A living hell','So many dies','Lifeless they lie','In graves with names unknown','Oh, mommy cries','Waits for her son','Who aint never coming home','Oh, no, so we dont need','Oh, no, no, we dont need','Oh, no, we dont need no more war','Oh, no, our wounds wont mend','By hurting them','So what are we fighting for','Oh, no, no, we dont need','Oh, no, no, we dont need','Oh, no, we dont need no more war','Not in iraq!','Not in afghanistan, no!','Not in Lybia!','Not in Israel!','Palestine, no!','We dont wanna see','No, no more of our brothers','Coming home in body bags','Wrapped up in american flags','Blood in American flags','We dont wanna see, no more','Villages burned to the ground','We dont wanna see, no more','Innocent victims dying','No more orphaned babies crying','We dont want no more, no more','No more war!','Oh, no, no, we dont need','Oh, no, no, we dont need','Oh, no, we dont need no more war'];

            const i_text = document.querySelectorAll(`#${id_form} input[type=text]`);
            const i_date = document.querySelectorAll(`#${id_form} input[type=date]`);
            const i_number = document.querySelectorAll(`#${id_form} input[type=number]`);
            const i_email = document.querySelectorAll(`#${id_form} input[type=email]`);
            const i_text_area = document.querySelectorAll(`#${id_form} textarea`);
            const i_select = document.querySelectorAll(`#${id_form} select`);

            // llenar input tipo text
            i_text.forEach(
                input_text => input_text.value = frases[parseInt(Math.random() * 172)]
            );

            // llenar input tipo date
            i_date.forEach(  input_date => {
                day = '0' + parseInt( (Math.random() * 27) + 1)
                mes = '0' + parseInt( (Math.random() * 11) + 1)
                input_date.value = `2018-${mes.slice(-2)}-${day.slice(-2)}`
            });

            // llenar input tipo number
            i_number.forEach(
                input_number => input_number.value = parseInt(Math.random() * 9999999)
            );

            // llenar input tipo email
            i_email.forEach(
                input_email => input_email.value = 'correo@' + frases[parseInt(Math.random() * 172)].replace(/\s/g,"_") + '.com'
            );

            // llenar input tipo textarea
            i_text_area.forEach(
                input_textarea => input_textarea.innerHTML = frases[parseInt(Math.random() * 172)]
            );

            // llenar select
            i_select.forEach(input_select =>{
                    id_select = input_select.getAttribute('id');
                    select_length = document.querySelectorAll(`#${id_select} option`).length;
                    seleccionar = parseInt(Math.random() * (select_length - 1)) + 1;
                    document.querySelectorAll(`#${id_select} option`)[seleccionar].setAttribute('selected',true)
                
                }
            );


        },


    };
    helper.init();
});