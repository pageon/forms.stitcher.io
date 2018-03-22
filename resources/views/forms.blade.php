<table class="table">
    <thead class="thead-dark">
        <tr>
            @foreach($table->getHeaders() as $header)
                <th>
                    {{ ucfirst($header) }}
                </th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($table->getData() as $row)
            <tr>
                @foreach($row as $item)
                    <td>
                        {{ $item }}
                    </td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

<div class="text-right">
    <a href="{{ route('forms.download', ['format' => 'xlsx']) }}"
       class="btn btn-outline-success"
       download>
        .xlsx
    </a>
    <a href="{{ route('forms.download', ['format' => 'csv']) }}"
       class="btn btn-outline-info"
       download>
        .csv
    </a>
</div>
