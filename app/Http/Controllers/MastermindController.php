<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MastermindController extends Controller
{
    //protected $_arr_bolas_posibles = [0, 1, 2, 3, 4, 5, 6, 7];
    protected $_arr_bolas_posibles = [
        [
            'valor' => 0,
            'bola' => 'Marina',
            'color' => 'Marino',
            'css' => 'opt_marino',
        ],
        [
            'valor' => 1,
            'bola' => 'Roja',
            'color' => 'Rojo',
            'css' => 'opt_rojo',
        ],
        [
            'valor' => 2,
            'bola' => 'Verde',
            'color' => 'Verde',
            'css' => 'opt_verde',
        ],
        [
            'valor' => 3,
            'bola' => 'Azul',
            'color' => 'Azul',
            'css' => 'opt_azul',
        ],
        [
            'valor' => 4,
            'bola' => 'Morada',
            'color' => 'Morado',
            'css' => 'opt_morado',
        ],
        [
            'valor' => 5,
            'bola' => 'Naranja',
            'color' => 'Naranja',
            'css' => 'opt_naranja',
        ],
        [
            'valor' => 6,
            'bola' => 'Rosa',
            'color' => 'Rosa',
            'css' => 'opt_rosa',
        ],
        [
            'valor' => 7,
            'bola' => 'Amarilla',
            'color' => 'Amarillo',
            'css' => 'opt_amarillo',
        ],
    ];
    protected $_arr_tot_colores_posibles = [4, 5, 6, 7, 8];

    public function index()
    {
        $title = 'Bienvenid@';
        $title_head = 'Aloha!! ... ¡¡Bienvenid@ a ...!!';

        return view('index')->with([
            'title' => $title,
            'title_head' => $title_head,
            'hojas_css' => ['estilos'],
            '_arr_bolas_posibles' => $this->_arr_bolas_posibles,
            '_arr_tot_colores_posibles' => $this->_arr_tot_colores_posibles,
        ]);
    }

    public function nuevaPartida(Request $request)
    {
        //Estableciendo reglas de validación
        $reglas = [
            'nombre' => 'required|max:255',
            'num_intentos' => 'required|not_in:0',
        ];
        //Validando petición
        $request->validate($reglas);

        //Otro(s) posible(s) ERROR(es) :: INI
        //==============================================
        //A considerar, únicamente al iniciar la partida
        if($request->partida_nueva) {
            $errors = [];
            if(!$request->repes && ($request->longitud > $request->num_col_pos)) {
                $errors[] = 'Si no se permiten las repeticiones, no se puede elegir una longitud de clave MAYOR que el número de colores posibles.';
            }
        }

        if(count($errors) > 0) {
            //**************************************************************

            //Formateo de datos para la vista
            $title = 'Errores de configuración';
            $title_head = 'Mastermind :: Partida cancelada';

            return view('partida')->with([
                'title' => $title,
                'title_head' => $title_head,
                'hojas_css' => ['estilos'],
                'errors' => $errors,
            ]);

        } else {
            //**************************************************************

            //Almacenando datos en Session
            $this->cargarSesion($request);
            $this->iniciarPartida($request->partida_nueva);
            //Prueba de borrado de datos de Session
            ////$this->borrarSesion($request, 'all');

            //Formateo de datos para la vista
            $title = 'Jugando';
            $title_head = 'Mastermind :: Partida iniciada';
            $hoja_estilos_tablero = 'estilos-tablero-clave-' . session('longitud', 4);
            if(session('repes', 0)) {
                $repes_eleccion_txt = 'Si';
            } else {
                $repes_eleccion_txt = 'No';
            }
            $num_intentos_efectuados_txt = session('num_intentos_efectuados', 0) . ' de ' . session('num_intentos', 0);

            return view('partida')->with([
                'title' => $title,
                'title_head' => $title_head,
                'hojas_css' => ['estilos', $hoja_estilos_tablero],
                'jugador' => session('jugador', 'Anónimo'),
                'longitud_eleccion' => session('longitud', 4),
                'num_col_pos_eleccion' => session('num_col_pos', 4),
                'repes_eleccion' => $repes_eleccion_txt,
                'num_intentos_eleccion' => session('num_intentos', 1),

                'puntuacion' => session('puntuacion', 0),
                'num_intentos_efectuados' => session('num_intentos_efectuados', 0),
                'num_intentos_efectuados_txt' => $num_intentos_efectuados_txt,

                '_arr_bolas_partida' => session('_arr_bolas_partida'),
                '_arr_clave_secreta' => session('_arr_clave_secreta'),

                'hay_acierto' => session('hay_acierto'),
                'game_over' => session('game_over'),
            ]);

            //**************************************************************
        }   //Habiendo o no otros errores de validación extra
    }

    public function otraPartida()
    {
        //Borrar/Reiniciar datos de la partida anterior
        //--------------------------------
        $this->iniciarPartida();
        //Prueba de borrado de datos de Session
        ////$this->borrarSesion($request, 'all');

        //Formateo de datos para la vista
        $title = 'Jugando';
        $title_head = 'Mastermind :: Partida iniciada';
        $hoja_estilos_tablero = 'estilos-tablero-clave-' . session('longitud', 4);
        if(session('repes', 0)) {
            $repes_eleccion_txt = 'Si';
        } else {
            $repes_eleccion_txt = 'No';
        }
        $num_intentos_efectuados_txt = session('num_intentos_efectuados', 0) . ' de ' . session('num_intentos', 0);

        return view('partida')->with([
            'title' => $title,
            'title_head' => $title_head,
            'hojas_css' => ['estilos', $hoja_estilos_tablero],
            'jugador' => session('jugador', 'Anónimo'),
            'longitud_eleccion' => session('longitud', 4),
            'num_col_pos_eleccion' => session('num_col_pos', 4),
            'repes_eleccion' => $repes_eleccion_txt,
            'num_intentos_eleccion' => session('num_intentos', 1),

            'puntuacion' => session('puntuacion', 0),
            'num_intentos_efectuados' => session('num_intentos_efectuados', 0),
            'num_intentos_efectuados_txt' => $num_intentos_efectuados_txt,

            '_arr_bolas_partida' => session('_arr_bolas_partida'),
            '_arr_clave_secreta' => session('_arr_clave_secreta'),

            'hay_acierto' => session('hay_acierto'),
            'game_over' => session('game_over'),
        ]);
    }

    public function jugar(Request $request, $accion = null)
    {
        //Comprobando jugada y resultados
        $this->comprobarJugada($request);

        //Formateo de datos para la vista
        $title = 'Jugando';
        $title_head = 'Mastermind :: Partida iniciada';
        $hoja_estilos_tablero = 'estilos-tablero-clave-' . session('longitud', 4);
        if(session('repes', 0)) {
            $repes_eleccion_txt = 'Si';
        } else {
            $repes_eleccion_txt = 'No';
        }
        $num_intentos_efectuados_txt = session('num_intentos_efectuados', 0) . ' de ' . session('num_intentos', 0);

        return view('partida')->with([
            'title' => $title,
            'title_head' => $title_head,
            'hojas_css' => ['estilos', $hoja_estilos_tablero],
            'jugador' => session('jugador', 'Anónimo'),
            'longitud_eleccion' => session('longitud', 4),
            'num_col_pos_eleccion' => session('num_col_pos', 4),
            'repes_eleccion' => $repes_eleccion_txt,
            'num_intentos_eleccion' => session('num_intentos', 1),

            'puntuacion' => session('puntuacion', 0),
            'num_intentos_efectuados' => session('num_intentos_efectuados', 0),
            'num_intentos_efectuados_txt' => $num_intentos_efectuados_txt,

            '_arr_bolas_partida' => session('_arr_bolas_partida'),
            '_arr_clave_secreta' => session('_arr_clave_secreta'),

            'hay_acierto' => session('hay_acierto'),
            'game_over' => session('game_over'),
            '_arr_jugadas' => session('_arr_jugadas', null),
            '_arr_bolas_posibles' => $this->_arr_bolas_posibles,
            //Indicando Partida_Ganada/Partida_Perdida si hace falta
            'accion' => session('accion'),
        ]);
    }

    public function iniciarPartida($partida_nueva_config = null) {
        //Eligiendo un número de Bolas según el "Número de Colores" elegido por el usuario
        //Prueba
        //$array = [0, 1, 2, 3, 4, 5, 6, 7];
        //$_arr_bolas_partida = array_random($array, session('num_col_pos', 4));
        $_arr_bolas_partida = array_random($this->_arr_bolas_posibles, session('num_col_pos', 4));

        //Crear Clave
        /*if(session('repes')) {
            //
            $clave_min = 0;
            $clave_max = 0;
            //Randomizar valores con posibilidad de repetidos
        } else {
            $_arr_clave_secreta = array_random($_arr_bolas_partida, session('longitud', 4));
        }
        session(['_arr_clave_secreta' => $_arr_clave_secreta]);*/

        $_arr_clave_secreta = [];
        $r_min = 0;
        $r_max = count($_arr_bolas_partida) - 1;
        $_arr_3_max_elems = 20;

        for($i = 0; $i < session('longitud', 4); $i++) {

            if(session('repes')) {
                //Recogiendo todo el elemento recorrido
                ////$_arr_clave_secreta[$i] = $_arr_bolas_partida[mt_rand($r_min, $r_max)];
                //Recogiendo, solamente, la clave 'valor' del elemento recorrido
                $_arr_clave_secreta[$i] = $_arr_bolas_partida[mt_rand($r_min, $r_max)]['valor'];

            } else {
                $es_elem_nuevo = false;
                while(!$es_elem_nuevo) {
                    //Recogiendo todo el elemento recorrido
                    ////$elem_nuevo = $_arr_bolas_partida[mt_rand($r_min, $r_max)];
                    //Recogiendo, solamente, la clave 'valor' del elemento recorrido
                    $elem_nuevo = $_arr_bolas_partida[mt_rand($r_min, $r_max)]['valor'];
                    if(!in_array($elem_nuevo, $_arr_clave_secreta))
                        $es_elem_nuevo = true;
                }

                $_arr_clave_secreta[$i] = $elem_nuevo;
            }
        }
        //Registrando datos en la Session
        session([
            //Bolas con las que jugar y Clave Secreta
            '_arr_bolas_partida' => $_arr_bolas_partida,
            '_arr_clave_secreta' => $_arr_clave_secreta,

            //Datos partida
            'game_over' => 0,
            '_arr_jugadas' => [],
            'hay_acierto' => 0,
            'num_intentos_efectuados' => 0,
            //Para indicar Partida_Ganada/Partida_Perdida si hace falta
            'accion' => null,
        ]);
        //Solamente para casos de nueva configuración de partida
        if($partida_nueva_config) {
            session([
                //Datos partida :: puntos
                'puntuacion' => 0,
            ]);
        }
    }

    public function cargarSesion(Request $request)
    {
        $ptos_por_partida_ganada = 5;

        session([
            //Config partida
            'jugador' => $request->nombre,
            'longitud' => $request->longitud,
            'num_col_pos' => $request->num_col_pos,
            'repes' => $request->repes,
            'num_intentos' => $request->num_intentos,

            //Datos partida
            'ptos_por_partida_ganada' => $ptos_por_partida_ganada,
        ]);
    }

    public function borrarSesion(Request $request, $nombre_session = null)
    {
        if($nombre_session == 'all') {
            $request->session()->flush();
        } else {
            $request->session()->forget($nombre_session);
        }
    }

    public function comprobarJugada(Request $request)
    {
        //Recogiendo la jugada realizada
        $_arr_jugada = [];
        for ($i = 0; $i < session('longitud', 4); $i++) {
            /**
             * Así NO
             *      $request->bola_.$i
             * Así SI
             *      $request->input('bola_'.$i)
             */
            ////array_push($_arr_jugada, $request->input('bola_'.$i));
            $_arr_jugada = array_add($_arr_jugada, $i, $request->input('bola_'.$i));
        }
        //------------------------------------------------------------
        //Verificando jugada
        $tot_coincidencias_parciales = 0;
        $tot_coincidencias_completas = 0;
        $tot_coincidencias_fallidas = 0;
        for($i=0; $i < count($_arr_jugada); $i++) {
            if( in_array($_arr_jugada[$i], session('_arr_clave_secreta')) ) {
                $tot_coincidencias_parciales++;
                if( $_arr_jugada[$i] ==  session('_arr_clave_secreta')[$i] ) {
                    $tot_coincidencias_parciales--;
                    $tot_coincidencias_completas++;
                }
            } else {
                $tot_coincidencias_fallidas++;
            }
        }
        //------------------------------------------------------------
        //Resultados de la jugada
        $_arr_resultados = [];
        for($i=0; $i < $tot_coincidencias_completas; $i++) {
            array_push($_arr_resultados, '1');
        }
        for($i=0; $i < $tot_coincidencias_parciales; $i++) {
            array_push($_arr_resultados, '0');
        }
        for($i=0; $i < $tot_coincidencias_fallidas; $i++) {
            array_push($_arr_resultados, '');
        }
        //Descontando cantidad de intentos
        session(['num_intentos_efectuados' => (session('num_intentos_efectuados') + 1)]);
        //Hay_Acierto o NO
        if($tot_coincidencias_completas == session('longitud', 4)) {
            session(['hay_acierto' => 1]);
            $puntuacion_nueva = session('puntuacion') + session('ptos_por_partida_ganada');
            session([
                //Datos partida :: puntos
                'puntuacion' => $puntuacion_nueva,
            ]);
            session([
                //Indicando Partida_Ganada
                ////'accion' => 1,
                'accion' => 'partida-ganada',
            ]);
        } else {
            if(session('num_intentos_efectuados') == session('num_intentos')) {
                session(['game_over' => 1]);
                session([
                    //Indicando Partida_Perdida
                    ////'accion' => 0,
                    'accion' => 'partida-perdida',
                ]);
            }
        }
        //------------------------------------------------------------
        //Ingresando jugada y resultados en el historial de jugadas
        $_arr_jugadas = session('_arr_jugadas');
        array_push($_arr_jugadas, [$_arr_jugada, $_arr_resultados]);
        session(['_arr_jugadas' => $_arr_jugadas]);
        /*
        //Recorriendo Jugadas
        //-------------------------------------------------------
        $_arr_jugadas = [];
        array_push($_arr_jugadas, $_arr_jugada, $_arr_resultados);
        echo '<br>[';
        for($i=0; $i < count($_arr_jugadas); $i++) {
            for($j=0; $j < count($_arr_jugadas[$i]); $j++) {
                if($j == 0) {
                    echo $_arr_jugadas[$i][$j];
                } else {
                    echo '-'.$_arr_jugadas[$i][$j];
                }
            }
        }
        echo ']';
        */
    }

}
