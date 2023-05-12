<div class="card">
    <div class="card-header">
        <h1 class="card-title">Activos Asignados</h1>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th></th>
                    <th>COD</th>
                    <th>Articulo</th>
                    <th>Atributos</th>
                    <th>Observación</th>
                    <th></th>
                </tr>
                @foreach ($assignations as $assignation)
                    <tr>
                        <td>
                            <input type="checkbox" name="aprobado" value=1>
                        </td>
                        <td> {{ $assignation->activo->codigo }} </td>
                        <td> {{ $assignation->activo->articulo }} </td>
                        <td>
                            <ul>
                                @foreach (json_decode($assignation->activo->atributos) as $key => $atributo)
                                    @if ($key != 'id_articulo')
                                        <li><strong>{{ $key }}: </strong> {{ $atributo }}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </td>
                        <td> {{ $assignation->observacion }} </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ url('/inventories/bajas') }}"
                                    class="btn btn-success btn-sm" role="button" aria-pressed="true">Baja</a>
                                <form action="{{ url('/inventories/bajas/' . $assignation->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-warning btn-sm" onclick="return confirm('Borrar?');"
                                        type="submit" aria-pressed="true">Borrar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
