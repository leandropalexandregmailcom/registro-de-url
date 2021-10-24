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
            <a href = "{{ route('show.url') }}" class = "btn btn-success">Cadastrar Url</a>

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
                        URL
                    </th>
                    <th>
                        Descrição
                    </th>
                    <th style="width: 8%" class="text-center">
                       Status Code
                    </th>
                    <th style="width: 20%; text-align: center;">
                        Opções
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($urls as $url)
                    <tr>
                        <td style = "width: 10%;">
                            <a>
                                {{ $url->url }}
                            </a>
                        </td>
                        <td style = "width: 10%;">
                            <a>
                                {{ $url->descricao }}
                            </a>
                        </td>
                        <td style = "width: 10%;">
                            <a>
                                {{ $url->status_code }}
                            </a>
                        </td>
                        <td class="project-actions text-right">
                            <a class="btn btn-info btn-sm" href="{{ route('index.log_url', [$url->id_url]) }}">
                                <i class="fas fa-eyes">
                                </i>
                                Detalhes
                            </a>
                            <button class="btn btn-danger btn-sm remove" id = "{{ $url->id_url }}" data-toggle="modal" data-target="#exampleModal">
                                <i class="fas fa-trash">
                                </i>
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h4>Tem certeza que deseja excluir essa url?</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary close" data-dismiss="modal">fechar</button>
          <button type="button" class="btn btn-danger delete">Deletar</button>
        </div>
      </div>
    </div>
  </div>
        </div>
        <!-- /.card-body -->
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
