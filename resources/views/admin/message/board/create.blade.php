@extends('layouts.app')

@section('page-title', 'Mural de Recados')

@section('content')

      <div class="card-box">
          <h6 class="font-13 m-t-0 m-b-30">Novo Recado</h6>

          <form method="post" action="{{ route('message-board.store') }}" enctype="multipart/form-data">

              {{ csrf_field() }}

              <div class="form-group row"><label class="col-sm-2 col-form-label">Departamento:</label>
                  <div class="col-sm-10">
                    <select class="select2" data-live-search="true" title="Selecione" data-style="btn-white" data-width="100%" id="select-department" data-route="{{ route('departments_users_search') }}" name="departments[]" multiple="multiple" required>
                      <option value="0">Todos Departamentos</option>
                      @foreach($departments as $department)
                          <option value="{{ $department->id }}">{{ $department->name }}</option>
                      @endforeach
                    </select>
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Para:</label>
                  <div class="col-sm-10">
                    <select class="select2" data-live-search="true" title="Selecione" data-style="btn-white" data-width="100%" id="select-user" name="to[]" multiple="multiple">
                      <option value="0">Todos Usuários</option>
                    </select>
                  </div>
              </div>

              <div class="form-group row"><label class="col-sm-2 col-form-label">Tipo:</label>
                  <div class="col-sm-10">
                    <select class="select2" data-live-search="true" title="Selecione" data-style="btn-white" data-width="100%" name="type_id" required>
                      @foreach($types as $type)
                          <option value="{{ $type->id }}">{{ $type->name }}</option>
                      @endforeach
                    </select>
                  </div>
              </div>

              <div class="form-group row"><label class="col-sm-2 col-form-label">Categorias:</label>
                  <div class="col-sm-10">
                    <select class="select2" data-live-search="true" title="Selecione" data-style="btn-white" data-width="100%" name="categories[]" multiple="multiple" required>
                      @foreach($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                      @endforeach
                    </select>
                  </div>
              </div>

              <div class="form-group row"><label class="col-sm-2 col-form-label">Assunto:</label>
                  <div class="col-sm-10"><input required name="subject" type="text" class="form-control" value=""></div>
              </div>

              <div class="form-group row"><label class="col-sm-2 col-form-label">Anexos:</label>

                  <div class="col-sm-10">
                    <input name="files[]" type="file" data-input="true" accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf, image/*" class="filestyle" multiple/>
                  </div>

              </div>

              <div class="form-group row"><label class="col-sm-2 col-form-label">Importante:</label>
                  <div class="col-sm-10"><input name="important" type="checkbox" data-plugin="switchery" value=""></div>
              </div>

              <div class="form-group row">
                  <div class="col-sm-12">
                    <textarea class="form-control summernote" name="content"></textarea>
                  </div>
              </div>

              <div class="text-right">
                  <button type="submit" class="btn btn-custom">Enviar</button>
                  <a href="{{ route('message-board.index') }}" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="" data-original-title="Discard email"><i class="fa fa-times"></i> Descartar</a>
              </div>

          </form>

      </div>

@endsection
