<script type="text/javascript">
    $(document).ready(function () {
        $('#classe').on('change', function () {
            var classeId = this.value;
            $('#user').html('');
            $.ajax({
                url: '{{ route('get_apprenant') }}?classe_id='+classeId,
                type: 'get',
                success: function (res) {
                    $('#user').html('');
                    $.each(res, function (key, value) {
                        $('#user').append(['<tr>','<th scope="row">'+ value.numero_matricule +'</th>',
                        '<th scope="row">'+ value.nomuser +'</th>',
                        '<th scope="row">'+ value.prenomuser +'</th>',
                        '<th scope="row">'+ value.id +'</th>',
                        '<th scope="row"> <a href="{{ route('observation_create', ['user' =>'+value.id+']) }}" class="btn btn-warning"> <i class="fas fa-comments"></i><span> </span> </a></th>',
                        '</tr>']);
                    });
                }
            });
        });
    });
</script>
