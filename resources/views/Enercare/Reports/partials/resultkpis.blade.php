

<div class="row mt-4">
    @if (count($query) > 0)

    <style>
        .tablekpis th {text-align: center;white-space: nowrap;padding: 10px;}
        .tablekpis td {white-space: nowrap;}
    </style>
    
    <div class="table-responsive">
        <table class="table table-sm table-bordered table-hover tablekpis">
            <thead class="thead-dark">
                <tr>
                @foreach (array_keys((array) $query->toArray()[0]) as $column)
                    <th>{{ $column}}</th>
                @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($query as $row)
                    <tr>
                        @foreach ($row as $key=>$value)
                        <td>
                            {{$value}}
                        </td>
                        @endforeach
                    
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    {{'No Results Found'}}
    @endif
</div>