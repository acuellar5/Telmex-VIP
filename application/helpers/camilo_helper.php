<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


//Nos aseguramos de que no haya conflictos con otras funciones
if (!function_exists('comparationsNames')) {

    // Funcion que compara dos nombres por lo general de fuentes distintas que humanamente es facil
    // Pero computacional es mas complejo por temas de mayusculas y cambios ortograficos o segundo 
    // nombre omitido. Ejemplo comparar nombres de un excel con relacion con nombres de db
    // recibe 2 parametros, un array con los nombres deseados... por lo general de db y el nombre a comparar
    // Retorna "false" si no encontro similitud importante o retorna el nombre del array 
    // con el que hay mayor similitud
    // IMPORTANTE.. PASAR NOMBREBASE CON MINIMO DOS PALABRAS
    function comparationsNames($arrayNames, $nameBase) {
        // Declaracion de variables a usar
        $pLastname1 = 0;
        $pLastname2 = 0;
        $pLastname3 = 0;
        $nameResult = false;
        $contador = 0;
        $similares = [];
        // secciono en partes el nombre base para comparacion
        $name = explode(" ", $nameBase);
        // ciclo hasta la cantidad de nombres q existe en el array
        for ($i = 0; $i < count($arrayNames); $i++) {
            //comparo su nombre Base con el primer y segundo nombre del nombre del array
            similar_text(explode(" ", $arrayNames[$i])[0], $name[0], $percentName);
            similar_text(explode(" ", $arrayNames[$i])[1], $name[0], $percentSecontName);
            //si la similitud es mayor al 70%
            if ($percentName > 70 || $percentSecontName > 70) {
                //Si apellido del nombre de su array existe
                if (explode(" ", $arrayNames[$i])[2]) {
                    similar_text(explode(" ", $arrayNames[$i])[2], $name[1], $pLastname1);
                    similar_text(explode(" ", $arrayNames[$i])[2], $name[2], $pLastname2);
                    similar_text(explode(" ", $arrayNames[$i])[2], $name[3], $pLastname3);
                }
                // si segundo apellido existe
                if (explode(" ", $arrayNames[$i])[3]) {
                    similar_text(explode(" ", $arrayNames[$i])[3], $name[1], $pLastname1B);
                    similar_text(explode(" ", $arrayNames[$i])[3], $name[2], $pLastname2B);
                    similar_text(explode(" ", $arrayNames[$i])[3], $name[3], $pLastname3B);
                }
                // si en alguna de las comparaciones con respecto al nombrebase es mayor al 69%
                if ($pLastname1 > 69 || $pLastname2 > 69 || $pLastname3 > 69 || $pLastname1B > 69 || $pLastname2B > 69 || $pLastname3B > 69) {
                    //lo capturo en una variables y lo agrego a arreglo de similares	
                    $nameResult = $arrayNames[$i];
                    array_push($similares, $nameResult);
                    //uso el contador por si hay mas de un registro q cumple las condiciones
                    $contador++;
                }
            }
        }
        //si hay mas de 1 registro que cumple....
        if ($contador > 1) {
            // ciclo hasta la cantidad de registros que cumple...
            for ($j = 0; $j < count($similares); $j++) {
                // los comparo directamente con el nombre base completo sin seccionarlo y 
                // guardo la similitud en una variable
                $sim[$j] = similar_text($nameBase, $similares[$j]);
            }
            //retorno el nombre que tubo mayor similitud con respecto al nombre base
            return $similares[array_keys($sim, max($sim))[0]];
        }
        // si solo hay una similitud que cumple (contador = 1) retorno ese nombre
        // si no hay ninguna similitud que cumpla retorna "false"
        return $nameResult;
    }

}


if (!function_exists('sumarORestarDiasAFecha')) {

    //Funcion para sumar o restar dias a una fecha dada
    //recibe 3 parametros; la fecha, los dias a sumar o restar, y el operador "+" o "-"
    //Retorna la fecha exacta con los dias sumados o restados
    function sumarORestarDiasAFecha($fechaBase, $dias, $operador) {
        if ($operador == '+') {
            $operacion = 'add';
        } else {
            $operacion = 'sub';
        }
        $fecha = new DateTime($fechaBase);
        $fecha->$operacion(new DateInterval('P' . $dias . 'D'));
        return $fecha->format('Y-m-d');
    }

}


if (!function_exists('habilPostFinSemana')) {

    //Funcion q valida si una fecha dada es sabado o domingo para retornar sigte dia habil
    //recibe 1 parametro; la fecha a calcular
    //Retorna la fecha del lunes proximo si no es fincho retorna la misma fecha
    function habilPostFinSemana($fecha) {
        $fecha = new DateTime($fecha);
        //cambio formato para obtener el dia de la semana y compararlo
        switch ($fecha->format('D')) {
            // si es sabado le sumo dos dias
            case 'Sat':
                $fecha = sumarORestarDiasAFecha($fecha->format('Y-m-d'), 2, '+');
                $fecha = new DateTime($fecha);
                break;
            //si es domingo sumo un dia
            case 'Sun':
                $fecha = sumarORestarDiasAFecha($fecha->format('Y-m-d'), 1, '+');
                $fecha = new DateTime($fecha);
                break;
        }
        return $fecha->format('Y-m-d');
    }

}

if (!function_exists('dia_espanol')) {

    //Funcion q validar una fecha dada para devolverdia en español
    //recibe 1 parametro; la fecha a calcular
    //Retorna el dia en español
    function dia_espanol($fecha) {
        $fecha = new DateTime($fecha);
        $dia = "";
        //cambio formato para obtener el dia de la semana y compararlo
        switch ($fecha->format('D')) {
            case 'Mon':
                $dia = 'Lun';
                break;

            case 'Tue':

                $dia = 'Mar';
                break;
            case 'Wed':
                $dia = 'Mie';
                break;

            case 'Thu':

                $dia = 'Jue';
                break;
            case 'Fri':
                $dia = 'Vie';
                break;

            case 'Sat':

                $dia = 'Sab';
                break;
            case 'Sun':

                $dia = 'Dom';
                break;
        }
        return $dia;
    }

}




if (!function_exists('validarFestivo')) {

    //Funcion para validar si una fecha es Festivo
    //recibe 1 parametro; la fecha a calcular FORMATO AAAA-MM-DD
    //Retorna '1' si es festivo o '0' si no lo es 
    // NOTA: tambien recibe fechas de distito formato ejemplo AAAA-M-D (2018-3-9)
    function validarFestivo($fecha) {
        $fecha = new DateTime($fecha);
        $festivos = array(
            '2018-01-01' => '2018-01-01', // Año Nuevo
            '2018-01-08' => '2018-01-08', // Reyes magos
            '2018-03-19' => '2018-03-19', // San jose
            '2018-03-29' => '2018-03-29', // Jueves santo(semana santa)
            '2018-03-30' => '2018-03-30', // Viernes santo(semana santa)
            '2018-05-01' => '2018-05-01', // Dia del trabajo
            '2018-05-14' => '2018-05-14', // Dia de la ascencion
            '2018-06-04' => '2018-06-04', // Corpus Christi
            '2018-06-11' => '2018-06-11', // Sagrado corazon
            '2018-07-02' => '2018-07-02', // San pedro y san Pablo
            '2018-07-20' => '2018-07-20', // Dia de la Independencia
            '2018-08-07' => '2018-08-07', // Batalla de Boyaca
            '2018-08-20' => '2018-08-20', // La Asuncion de la Virgen
            '2018-10-15' => '2018-10-15', // Dia de la Raza
            '2018-11-05' => '2018-11-05', // Dia de todos los santos
            '2018-11-12' => '2018-11-12', // Independencia de Cartagena
            '2018-12-08' => '2018-12-08', // Dia de la inmaculada concepcion
            '2018-12-25' => '2018-12-25', // Navidad
            //2019
            '2019-01-01' => '2019-01-01', // Año Nuevo
            '2019-01-07' => '2019-01-07', // Reyes magos
            '2019-03-25' => '2019-03-25', //
        );
        if ($festivos[$fecha->format('Y-m-d')]) {
            return 1;
        } else {
            return 0;
        }
    }

}

if (!function_exists('habilPostFestivo')) {

    //Funcion para dar proxima fecha habil si la fecha dada es festivo
    //recibe 1 parametro; la fecha a calcular
    //Retorna la proxima fecha habil proxima si es festivo
    function habilPostFestivo($fecha) {
        //valido si la fecha  es festivo, si lo es, retorna 1 sino 0
        $festivo = validarFestivo($fecha);
        //si retorno 1 (festivo) le sumo 1 y la vuelvo a comparar
        if ($festivo == 1) {
            return habilPostFestivo(sumarORestarDiasAFecha($fecha, 1, '+'));
            // si es 0 retorna la fecha
        } else {
            return $fecha;
        }
    }

}


if (!function_exists('dias_habiles_mes')) {

    //Funcion para calcular todos los dias habiles de un mes dado
    //recibe 1 parametro; el mes a calcular
    //Retorna los dias habiles del mes en un array con claves igual a se result
    function dias_habiles_mes($mes) {
        $dias_habiles = [];
        $hasta = ['', 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        $meses = ['', 'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];

        for ($i = 1; $i < $hasta[$mes] + 1; $i++) {
            if (is_sat_sun_or_fest('2018-' . $mes . '-' . $i) == false) {
                $fecha[$i] = new DateTime('2018-' . $mes . '-' . $i);
                // $dias_habiles[$fecha[$i]->format('Y-m-d')] = $fecha[$i]->format('Y-m-d');
                array_push($dias_habiles, $fecha[$i]->format('Y-m-d'));
            }
        }

        return $dias_habiles;
    }

}

if (!function_exists('is_sat_sun_or_fest')) {

    // funcion que valida si un dia es sab o domingo o festivo
    // Recibe la fecha a validar
    // Retorna true si se cumple y false si no
    function is_sat_sun_or_fest($fecha) {
        $response = false;
        $fecha_form = new DateTime($fecha);
        switch ($fecha_form->format('D')) {
            case 'Sat':
                $response = true;
                break;

            case 'Sun':
                $response = true;
                break;

            default:
                if (validarFestivo($fecha) === 1) {
                    $response = true;
                }
                break;
        }

        return $response;
    }

}

if (!function_exists('elimina_acentos')) {

    //Funcion para eliminar acentos
    //recibe 1 parametro; un string al que le vamos a eliminar los acentos 
    //Retorna el string sin acentos		  
    function elimina_acentos($text) {
        $text = htmlentities($text, ENT_QUOTES, 'UTF-8');
        $text = strtolower($text);
        $patron = array(
            // Espacios, puntos y comas por guion
            //'/[\., ]+/' => ' ',
            // Vocales
            '/\+/' => '',
            '/&agrave;/' => 'a',
            '/&egrave;/' => 'e',
            '/&igrave;/' => 'i',
            '/&ograve;/' => 'o',
            '/&ugrave;/' => 'u',
            '/&aacute;/' => 'a',
            '/&eacute;/' => 'e',
            '/&iacute;/' => 'i',
            '/&oacute;/' => 'o',
            '/&uacute;/' => 'u',
            '/&acirc;/' => 'a',
            '/&ecirc;/' => 'e',
            '/&icirc;/' => 'i',
            '/&ocirc;/' => 'o',
            '/&ucirc;/' => 'u',
            '/&atilde;/' => 'a',
            '/&etilde;/' => 'e',
            '/&itilde;/' => 'i',
            '/&otilde;/' => 'o',
            '/&utilde;/' => 'u',
            '/&auml;/' => 'a',
            '/&euml;/' => 'e',
            '/&iuml;/' => 'i',
            '/&ouml;/' => 'o',
            '/&uuml;/' => 'u',
            '/&auml;/' => 'a',
            '/&euml;/' => 'e',
            '/&iuml;/' => 'i',
            '/&ouml;/' => 'o',
            '/&uuml;/' => 'u',
            // Otras letras y caracteres especiales
            '/&aring;/' => 'a',
            '/&ntilde;/' => 'n',
                // Agregar aqui mas caracteres si es necesario
        );

        $text = preg_replace(array_keys($patron), array_values($patron), $text);
        return $text;
    }

}

if (!function_exists('validarEnProduccion')) {

    //Funcion para validar si el proyecto ya se encuentra en produccion, tomando como referencia la coneccion a DB
    //Retorna 1.1 si la DB esta apuntando a local de lo contrario retorna la funcion time()
    function validarEnProduccion() {
        $version = "";
        $CI = & get_instance();
        $CI->load->database();
        if ($CI->db->hostname == 'zte-coldb.cwtksnwikcx3.us-west-2.rds.amazonaws.com') {
            $version = '4.1';
        } else {
            $version = time();
        }

        return $version;
    }

}

if (!function_exists('h_enviarCorreo')) {

    //Funcion para enviar correos
    //recibe 4 parametros: el cuerpo del correo; el correo al cual sera enviado; si tiene copia, el asunto
    //Retorna un mensaje diciendo si el correo se pudo enviar o no
    function h_enviarCorreo($cuerpo, $dirigido, $asunto = 'Sin asunto', $mail_cc = null) {
        $return = array();
        $CI =& get_instance();
        $CI->load->library('parser');

        $config = Array(
            //'smtp_crypto' => 'ssl', //protocolo de encriptado
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'zolid.telmex.vip@gmail.com',
            'smtp_pass' => 'z0l1dTelmex',
            // 'smtp_timeout' => 5, //tiempo de conexion maxima 5 segundos
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'priority' => 1,
        );
        
        $CI->load->library('email', $config);
        $CI->email->set_newline("\r\n");
        $CI->email->from('zolid.telmex.vip@gmail.com', 'TELMEX VIP'); // change it to yours
        $CI->email->to($dirigido); // change it to yours
        if ($mail_cc) {
            $CI->email->cc($mail_cc);
        }
        $CI->email->subject($asunto);
        $CI->email->message($cuerpo);
        if ($CI->email->send()) {
            $return['success'] = true;
            $return['msg'] = 'El correo fue enviado correctamente.';
            return $return;
        } else {
            $return['success'] = false;
            $return['msg'] = 'Hubo un error al momento de enviar el correo, por favor inténtelo nuevamente.';
            show_error($CI->email->print_debugger());
        }
        
        
    }

}




 