<table>
    @foreach($details as $detail)
        <tr>
            <td><input {{ $detail->value ? 'checked' : null }} data-id="{{ $detail->id }}" type="checkbox" class="detail-enable"></td>
            <td>{{ $detail->title }}</td>
            <td><input value="{{ $detail->value ?? null }}" {{ $detail->value ? null : 'disabled' }} data-id="{{ $detail->id }}" name="details[{{ $detail->id }}]" type="text" class="detail-value form-control" placeholder="Value"></td>
        </tr>
    @endforeach
</table>

@section('scripts')
    @parent
    <script>
        $('document').ready(function () {
            $('.detail-enable').on('click', function () {
                let id = $(this).attr('data-id')
                let enabled = $(this).is(":checked")
                $('.detail-value[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.detail-value[data-id="' + id + '"]').val(null)
            })
        });
    </script>
@endsection