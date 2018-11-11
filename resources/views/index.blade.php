@extends('layouts.layout_main')

@section('contenido_css')
    @foreach ($hojas_css as $hoja_nombre)
        <link href="/css/{{ $hoja_nombre }}.css" rel="stylesheet" type="text/css">
    @endforeach
@endsection

@section('contenido_central')
                <div class="title m-b-md">
                    {{ $title_head }}
                    <img src="/imags/logo-marca-index.png" title="Logo - Super Master Mind">
                </div>

                <div class="row flex-center">
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
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col"><hr></div>
                    </div>
                    <div class="row flex-center">
                        @foreach ($_arr_bolas_posibles as $v)
                            @if (!$loop->first) <span class="colorBlanco">-</span> @endif
                            <img src="/imags/bolas/bola_{{ $v['valor'] }}.png" title="Bola {{ $v['bola'] }}">
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col"><hr></div>
                    </div>
                    <form action="{{ route('mastermind_nueva_partida') }}" method="post" role="form">
                        @csrf
                        <div class="form-group row flex-center">
                            <label for="nombre" class="col-sm-2 col-form-label">Jugador@:</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Teclea tu nombre" value="{{ old('nombre') }}">
                            </div>
                        </div>
                        <fieldset class="form-group">
                            <div class="row flex-center">
                                <legend class="col-form-label col-sm-2 pt-0">Longitud de la clave:</legend>
                                <div class="col-sm-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="longitud" id="long_4" value="4" checked>
                                        <label class="form-check-label" for="long_4">
                                            4
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="longitud" id="long_5" value="5">
                                        <label class="form-check-label" for="long_5">
                                            5
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="form-group">
                            <div class="row flex-center">
                                <legend class="col-form-label col-sm-2 pt-0">Número de colores posibles:</legend>
                                <div class="col-sm-4">
                                    @foreach ($_arr_tot_colores_posibles as $tot_colores_posible)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="num_col_pos" id="num_col_pos_{{ $tot_colores_posible }}" value="{{ $tot_colores_posible }}"@if ($loop->first) checked @endif{{ old('num_col_pos') == $tot_colores_posible ? ' checked' : '' }}>
                                        <label class="form-check-label" for="num_col_pos_{{ $tot_colores_posible }}">
                                            {{ $tot_colores_posible }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="form-group">
                            <div class="row flex-center">
                                <legend class="col-form-label col-sm-2 pt-0">Permitir repetidos:</legend>
                                <div class="col-sm-4">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="repes" id="repe_si" value="1"@empty('repes') checked @endempty{{ old('repes') == 1 ? ' checked' : '' }}>
                                        <label class="form-check-label" for="repe_si">
                                            Si
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="repes" id="repe_no" value="0"{{ old('repes') == 0 ? ' checked' : '' }}>
                                        <label class="form-check-label" for="repe_no">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="form-group">
                            <div class="row flex-center">
                                <legend class="col-form-label col-sm-2">Número de intentos:</legend>
                                <select name="num_intentos" class="col-sm-4">
                                    <option value="0" selected>Elige una cantidad</option>
                                    <option value="1"{{ old('num_intentos') == 1 ? ' selected' : '' }}>1</option>
                                    <option value="2"{{ old('num_intentos') == 2 ? ' selected' : '' }}>2</option>
                                    <option value="3"{{ old('num_intentos') == 3 ? ' selected' : '' }}>3</option>
                                    <option value="4"{{ old('num_intentos') == 4 ? ' selected' : '' }}>4</option>
                                    <option value="5"{{ old('num_intentos') == 5 ? ' selected' : '' }}>5</option>
                                    <option value="6"{{ old('num_intentos') == 6 ? ' selected' : '' }}>6</option>
                                    <option value="7"{{ old('num_intentos') == 7 ? ' selected' : '' }}>7</option>
                                    <option value="8"{{ old('num_intentos') == 8 ? ' selected' : '' }}>8</option>
                                </select>
                            </div>
                        </fieldset>
                        <div class="form-group row flex-center">
                            <div class="col-sm-4">
                                <input type="hidden" name="partida_nueva" value="1">
                                <button type="submit" class="btn btn-primary">Iniciar partida</button>
                            </div>
                        </div>
                    </form>
                </div>
@endsection
