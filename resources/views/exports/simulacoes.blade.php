<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Vendedor</th>
        <th>Modalidade</th>
        <th>Crédito</th>
        <th>Lance</th>
        <th>Parcela</th>
        <th>Pressa</th>
        <th>Criada em</th>
        <th>Favorita?</th>
    </tr>
    </thead>
    <tbody>
    @foreach($simulacoes as $s)
        <tr>
            <td>{{ $s->id }}</td>
            <td>{{ $s->cliente->name }}</td>
            <td>{{ @$s->vendedor->conta->name }}</td>
            <td>{{ $s->modalidade_id }}</td>
            <td>{{ $s->getFormattedCurrency('credito') }}</td>
            <td>{{ $s->getFormattedCurrency('lance') }}</td>
            <td>{{ $s->getFormattedCurrency('parcela') }}</td>
            <td>{{ $s->pressa }}</td>
            <td>{{ $s->created_at }}</td>
            <td>{{ $s->favorite }}</td>
        </tr>
    @endforeach
    </tbody>
</table>