@extends('welcome')

@section('content')
    <section class="content">

    <div class="card">

        <div class="card-header">
            @if(Session::has('msg'))
                <div class = "alert alert-success text-center mt-5">
                    {!! Session::get("msg") !!}
                </div>
            @endif
            <div class = "panel-heading">
                <div class = "row m-1">
                    <div class = "col-xs-4 align-left">
                        <a href = "{{ route('index.url') }}" role = "button" class = "btn btn-secondary" aria-expanded = "false">
                            <i class = "fas fa-arrow-left"></i> Voltar
                        </a>
                    </div>
                </div>
            </div>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
        </div>
        <div class="card-body p-0">
        <table class="table table-striped projects">
            <thead>
                <tr>
                    <th>
                        Response <i class="fas fa-helmet-battle    "></i>
                    </th>
                    <th>
                        Data de atualização
                    </th>
                    <th style="width: 8%" class="text-center">
                       Status Code
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($urls as $url)
                    <tr>
                        <td style = "width: 20%;">
                            <a>
                                {{ mb_substr($url->data, 0, 50) }}
                            </a>
                        </td>
                        <td style = "width: 10%;">
                            <a>
                                {{ $url->updated_at }}
                            </a>
                        </td>
                        <td style = "width: 10%;">
                            <a>
                                {{ $url->status_code }}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        </div>
    </div>

    </section>

    <script>
        $(".remove").click(function(e)
        {
            var id = $(this).attr('id')

            $(".delete").click(function(e)
            {
                e.preventDefault()

                $.ajax({
                    headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type 	: 'post',
                    url		: 'delete',
                    data 	: { id : id}
                }).done(function(response)
                {
                    if(response)
                    {
                        window.location.reload()
                    }
                }).fail(function(response)
                {
                    console.log(response)
                })
            })

            $(".close").click(function(e)
            {
                e.preventDefault()

                id = ""
            })
        })

    </script>
@endsection
