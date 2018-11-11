@extends('layouts.layout_main')

@section('contenido_css')
    @foreach ($hojas_css as $hoja_nombre)
        <link href="/css/{{ $hoja_nombre }}.css" rel="stylesheet" type="text/css">
    @endforeach
@endsection

@section('contenido_central')
                <div class="title m-b-md">
                    {{ $title_head }}
                </div>

                {{--<div class="row flex-center">
                    <div class="col-xs|sm|md|lg|xl-1-12">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>--}}

                <div class="container">
                    <div class="row">

                        {{-- Habiendo Errores o NO :: INI --}}
                        @if (count($errors))
                            <!--//-->
                        <div class="col-md-12">
                            <h1>¡¡ATENCIÓN!!</h1>
                            <div class="row flex-center">
                                <div class="col-xs|sm|md|lg|xl-1-12">
                                    @if (count($errors))
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('mastermind_index') }}" class="btn btn-primary" title="Reconfigurar partida">Reconfigurar partida</a>
                                </div>
                            </div>
                        </div>

                        {{-- Habiendo Errores o NO :: SINO --}}
                        @else

                        <div class="col-md-5">
                            <fieldset>
                                <legend class="text-left font-weight-bold">Datos de la Partida</legend>
                                <div class="row text-left">
                                    <div class="col-md-6">
                                        Jugador@:
                                    </div>
                                    <div class="col-md-6 font-weight-bold">
                                        {{ $jugador }}
                                    </div>
                                </div>
                                <div class="row text-left">
                                    <div class="col-md-6">
                                        Longitud elegida:
                                    </div>
                                    <div class="col-md-6 font-weight-bold">
                                        {{ $longitud_eleccion }}
                                    </div>
                                </div>
                                <div class="row text-left">
                                    <div class="col-md-6">
                                        Nº colores posibles:
                                    </div>
                                    <div class="col-md-6 font-weight-bold">
                                        {{ $num_col_pos_eleccion }}
                                    </div>
                                </div>
                                <div class="row text-left">
                                    <div class="col-md-6">
                                        Permitir repetidos:
                                    </div>
                                    <div class="col-md-6 font-weight-bold">
                                        {{ $repes_eleccion }}
                                    </div>
                                </div>
                                <div class="row text-left">
                                    <div class="col-md-6">
                                        Nº intentos:
                                    </div>
                                    <div class="col-md-6 font-weight-bold">
                                        {{ $num_intentos_eleccion }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col"><hr></div>
                                </div>
                                <div class="row text-left">
                                    <div class="col-md-6">
                                        Puntuación:
                                    </div>
                                    <div class="col-md-6 font-weight-bold">
                                        {{ $puntuacion }}
                                    </div>
                                </div>
                                <div class="row text-left">
                                    <div class="col-md-6">
                                        Intentos efectuados:
                                    </div>
                                    <div class="col-md-6 font-weight-bold">
                                        {{ $num_intentos_efectuados_txt }}
                                    </div>
                                </div>

                                {{-- PRUEBAS-Varias::Mostrar-Datos-Internos :: INI --}}
                                {{--
                                <div class="row">
                                    <div class="col"><hr></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Pruebas</h4>
                                        <h5>Jugada</h5>
                                        @isset($_arr_jugada)
                                        {{ var_dump($_arr_jugada) }}
                                        @endisset
                                        @empty($_arr_jugada)
                                        {{ ':: Ninguna jugada efectuada aún ::' }}
                                        @endempty
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col"><hr></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4>Pruebas</h4>
                                        <h5>Bolas_Partida</h5>
                                        {{ var_dump($_arr_bolas_partida) }}
                                        <h5>Clave_Secreta</h5>
                                        {{ var_dump($_arr_clave_secreta) }}
                                    </div>
                                </div>--}}
                                {{-- PRUEBAS-Varias::Mostrar-Datos-Internos :: FIN --}}
                                <div class="row">
                                    <div class="col"><hr></div>
                                </div>
                                <div class="row">
                                    @if (!$game_over && !$hay_acierto)
                                    <div class="col-md-12">
                                        <a href="{{ route('mastermind_index') }}" class="btn btn-primary" title="Reconfigurar partida">Reconfigurar partida</a>
                                    </div>
                                    @else
                                    <div class="col-md-6">
                                        <a href="{{ route('mastermind_index') }}" class="btn btn-primary" title="Reconfigurar partida">Reconfigurar partida</a>
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('mastermind_otra_partida') }}" class="btn btn-primary" title="Volver a jugar">Volver a jugar</a>
                                    </div>
                                    @endif
                                </div>

                                @isset($accion)
                                {{-- Habiendo mensajes de acción :: INI --}}
                                <div class="row">
                                    <div class="col"><hr></div>
                                </div>
                                <div class="row" id="row_partida_accion">
                                        @php
                                            switch ($accion) {
                                                case 'partida-perdida':
                                                    $modal_tit = 'Partida Perdida';
                                                    $modal_msg = 'Lo sentimos. No lograste descifrar la Clave Secreta.';
                                                    $modal_bg_color = 'bg-danger';
                                                    break;

                                                case 'partida-ganada':
                                                    $modal_tit = 'Partida Ganada';
                                                    $modal_msg = '¡¡Enhorabuena!! ... Has logrado descifrar la Clave Secreta.';
                                                    $modal_bg_color = 'bg-success';
                                                    break;
                                            }
                                        @endphp
                                    <!-- Modal -->
                                    <div id="accion-modal" tabindex="-1" role="dialog" aria-labelledby="accion-modalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content {{ $modal_bg_color }} text-white">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="accion-modalLabel">{{ $modal_tit }}</h5>
                                                </div>
                                                <div class="modal-body">
                                                    {{ $modal_msg }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Habiendo mensajes de acción :: INI --}}
                                @endisset
                            </fieldset>
                        </div>
                        <div class="col-md-7">
                            <h1>Jugando...</h1>
                            <table class="table tablero">
                                <tr>
                                    <td colspan="2" class="tablero-cabecera">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tablero-fila-nums-sup">
                                    </td>
                                    <td rowspan="2" class="tablero-fila-logo">
                                    </td>
                                </tr>
                                <tr>
                                    {{-- Viendo si se muestra o no la clave secreta
                                    @if ($num_intentos_efectuados < $num_intentos_eleccion) --}}
                                    @if (!$game_over && !$hay_acierto)
                                    <td class="tablero-fila-clave-oculta">
                                    </td>
                                    @else
                                    <td class="tablero-fila-clave-visible">
                                        <div>
                                            <div></div>
                                        @foreach ($_arr_clave_secreta as $clave_bola) {
                                            <div>
                                                <img src="/imags/bolas/bola_{{ $clave_bola }}.png" title="Bola {{ $_arr_bolas_posibles[$clave_bola]['bola'] }}">
                                            </div>
                                        @endforeach
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                <tr>
                                    <td colspan="2" class="tablero-fila-menus-opciones">
                                        <form action="{{ route('mastermind_jugar') }}" method="post">
                                            @csrf
                                            {{-- Desactivando elems si terminó la partida --}}
                                            @php $elem_estado = ''; @endphp
                                            @if ($game_over || $hay_acierto)
                                                @php $elem_estado = ' disabled'; @endphp
                                            @endif
                                            @for ($i = 0; $i < $longitud_eleccion; $i++)
                                            <select name="bola_{{ $i }}"{{ $elem_estado }}>
                                                @foreach ($_arr_bolas_partida as $bola_partida)
                                                <option value="{{ $bola_partida['valor'] }}" id="{{ $bola_partida['css'] }}">{{ $bola_partida['color'] }}</option>
                                                @endforeach
                                            </select>
                                            @endfor
                                            <input type="submit" name="comprobar" value="Comprobar" class="btn btn-primary"{{ $elem_estado }}>
                                        </form>
                                    </td>
                                </tr>
                            {{-- Viendo si se inicia la partida o no :: INI --}}
                            @if ($num_intentos_efectuados == 0)
                                {{--ORDEN::ASCENDENTE--}}
                                @for ($i = 1; $i <= $num_intentos_eleccion; $i++)
                                    @if ($i == 1)
                                {{--ORDEN::DESCENDENTE
                                @for ($i = $num_intentos_eleccion; $i >= 1; $i--)
                                    @if ($i == $num_intentos_eleccion)--}}
                                <tr>
                                    <td colspan="2" class="tablero-fila-ini">
                                        <div>
                                            <div></div>
                                            @for ($j = 0; $j < $longitud_eleccion; $j++)
                                            <div></div>
                                            @endfor
                                            <div></div>
                                            @for ($k = 0; $k < $longitud_eleccion; $k++)
                                            <div></div>
                                            @endfor
                                            <div>
                                                <img src="/imags/num-intento-{{ $i }}.png">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                    {{--ORDEN::ASCENDENTE--}}
                                    @elseif($i==$num_intentos_eleccion)
                                    {{--ORDEN::DESCENDENTE
                                    @elseif ($i == 1)--}}
                                <tr>
                                    <td colspan="2" class="tablero-fila-fin">
                                        <div>
                                            <div></div>
                                            @for ($j = 0; $j < $longitud_eleccion; $j++)
                                            <div></div>
                                            @endfor
                                            <div></div>
                                            @for ($k = 0; $k < $longitud_eleccion; $k++)
                                            <div></div>
                                            @endfor
                                            <div>
                                                <img src="/imags/num-intento-{{ $i }}.png">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                    @else
                                <tr>
                                    <td colspan="2" class="tablero-fila-interm">
                                        <div>
                                            <div></div>
                                            @for ($j = 0; $j < $longitud_eleccion; $j++)
                                            <div></div>
                                            @endfor
                                            <div></div>
                                            @for ($k = 0; $k < $longitud_eleccion; $k++)
                                            <div></div>
                                            @endfor
                                            <div>
                                                <img src="/imags/num-intento-{{ $i }}.png">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                    @endif
                                @endfor
                            {{-- Viendo si se inicia la partida o no --}}
                            @else
                                @php $contador_intentos = 0; @endphp
                                {{-- Recorriendo cada fila de _arr_jugadas :: INI --}}
                                @foreach($_arr_jugadas as $_arr_jugadas_fila)
                                    @php $contador_intentos++; @endphp
                                    @if ($loop->first)
                                        @php $tablero_fila_css = 'tablero-fila-ini'; @endphp
                                    @else
                                        @php $tablero_fila_css = 'tablero-fila-interm'; @endphp
                                    @endif
                                <tr>
                                    <td colspan="2" class="{{ $tablero_fila_css }}">
                                        <div>
                                    {{-- Recorriendo Jugada/Resultados de _arr_jugadas_fila --}}
                                    @php $fila_elem = ''; @endphp
                                    @foreach($_arr_jugadas_fila as $_arr_jugadas_fila_elem)
                                        @if ($loop->first)
                                            @php $fila_elem = 'jugada'; @endphp
                                        @else
                                            @php $fila_elem = 'resultados'; @endphp
                                        @endif
                                        {{-- Recorriendo cada elemento de Jugada/Resultados --}}
                                        @foreach($_arr_jugadas_fila_elem as $k=>$v)
                                            @if ($loop->first)
                                            <div></div>
                                            @endif
                                            <div>
                                            @if ($fila_elem == 'jugada')
                                                <img src="/imags/bolas/bola_{{ $v }}.png">
                                            @elseif ($fila_elem == 'resultados')
                                                @if ($v != '')
                                                <img src="/imags/bolas/clavija_{{ $v }}.png">
                                                @endif
                                            @endif
                                            </div>
                                        @endforeach
                                    @endforeach
                                            <div>
                                                <img src="/imags/num-intento-{{ $contador_intentos }}.png">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                {{-- Recorriendo cada fila de _arr_jugadas :: FIN --}}
                                {{-- Ver si hubiera que construir filas vacías :: INI --}}
                                @if ($contador_intentos < $num_intentos_eleccion)
                                    @php
                                    $x_filas_vacias = $num_intentos_eleccion - $contador_intentos;
                                    @endphp
                                    @for ($i = 1; $i <= $x_filas_vacias; $i++)
                                        @php $contador_intentos++; @endphp
                                        @if ($i == $x_filas_vacias)
                                            @php $tablero_fila_css = 'tablero-fila-fin'; @endphp
                                        @else
                                            @php $tablero_fila_css = 'tablero-fila-interm'; @endphp
                                        @endif
                                <tr>
                                    <td colspan="2" class="{{ $tablero_fila_css }}">
                                        <div>
                                            <div></div>
                                            @for ($j = 0; $j < $longitud_eleccion; $j++)
                                            <div></div>
                                            @endfor
                                            <div></div>
                                            @for ($k = 0; $k < $longitud_eleccion; $k++)
                                            <div></div>
                                            @endfor
                                            <div>
                                                <img src="/imags/num-intento-{{ $contador_intentos }}.png">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                    @endfor
                                @endif
                                {{-- Ver si hubiera que construir filas vacías :: FIN --}}
                            @endif
                            {{-- Viendo si se inicia la partida o no :: FIN --}}
                                <tr>
                                    <td colspan="2" class="tablero-fila-nums-inf">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="tablero-pie">
                                    </td>
                                </tr>
                            </table>
                        </div>

                        @endif
                        {{-- Habiendo Errores o NO :: FIN --}}
                    </div>
                </div>
@endsection
