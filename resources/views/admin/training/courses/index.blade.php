@extends('layouts.app')

@section('page-title', 'Cursos')

@section('content')

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Menu de opções</h6>

        @permission('create.clientes')
            <a href="{{ route('courses.create') }}" class="btn btn-custom">Novo Curso</a>
        @endpermission

    </div>

    <div class="card-box">
        <h6 class="font-13 m-t-0 m-b-30">Listagem</h6>

        @if($courses->isNotEmpty())

        <div class="table-responsive">
            <table class="table table-hover">

                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Descrição</th>
                    <th>Carga Horária</th>
                    <th>Adicionado em</th>
                    <th></th>
                  </tr>
                </thead>

                <tbody>
                    @foreach($courses as $course)
                        <tr>

                            <td class="project-title">
                                <a>{{$course->id}}</a>
                            </td>

                            <td class="project-title">
                                <a>{{$course->title}}</a>
                            </td>

                            <td class="project-title">
                                <a>{{strip_tags($course->description)}}</a>
                            </td>

                            <td class="project-title">
                                <a>{{$course->workload}} horas</a>
                            </td>

                            <td class="project-title">
                                <a>{{$course->created_at->format('d/m/Y H:i')}}</a>
                            </td>

                            <td class="project-actions">
                              @permission('edit.cursos')
                                <a href="{{route('courses.edit', ['id' => $course->uuid])}}" class="btn btn-default"><i class="fa fa-pencil"></i> Editar</a>
                              @endpermission

                              @permission('delete.cursos')
                                <a data-route="{{route('courses.destroy', ['id' => $course->uuid])}}" class="btn btn-danger btnRemoveItem"><i class="fa fa-close"></i> Remover</a>
                              @endpermission
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-center">
            {{ $courses->links() }}
            </div>

        </div>

        @else

            <div class="col-sm-12">

              <div class="widget white-bg no-padding m-t-30">
                  <div class="p-m text-center">
                      <h1 class="m-md"><i class="far fa-folder-open fa-3x"></i></h1>
                      <h4 class="font-bold no-margins">
                          Nenhum registro encontrado.
                      </h4>
                  </div>
              </div>

            </div>

        @endif

    </div>

@endsection
