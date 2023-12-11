<table class="table table-striped-columns table-hover">
    <thead>
        <tr>
            <th>Monto</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        @forelse($row->pagos as $abono)
            <tr>
                <td>${{number_format($abono->monto, 2)}}</td>
                <td>{{$abono->fecha_pago->format('d-m-Y')}}</td>
            </tr>
        @empty
        @endforelse
    </tbody>
</table>
