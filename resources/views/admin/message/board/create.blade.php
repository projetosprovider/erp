@extends('layouts.layout')

@section('content')

      <div class="row wrapper border-bottom white-bg page-heading">
          <div class="col-lg-12">
              <h2>Mural de Recados</h2>
              <ol class="breadcrumb">
                  <li>
                      <a href="{{ route('home') }}">Painel Principal</a>
                  </li>
                  <li>
                      <a href="{{ route('message-board.index') }}">Mural de Recados</a>
                  </li>
                  <li class="active">
                      <strong>Novo</strong>
                  </li>
              </ol>
          </div>

      </div>

      <div class="wrapper wrapper-content animated fadeInUp">

      <div class="row">
          <div class="col-lg-3">
              <div class="ibox ">
                  <div class="ibox-content mailbox-content">
                      <div class="file-manager">
                          <h5>Folders</h5>
                          <ul class="folder-list m-b-md" style="padding: 0">
                            <li><a href="{{route('message-board.index')}}"> <i class="fa fa-inbox "></i> Entrada <span class="label label-warning float-right">16</span> </a></li>
                            <li><a href="#"> <i class="fa fa-envelope-o"></i> Enviados</a></li>
                            <li><a href="#"> <i class="fa fa-certificate"></i> Importantes</a></li>
                            <li><a href="#"> <i class="fa fa-trash-o"></i> Lixeira</a></li>
                          </ul>
                          <h5>Categories</h5>
                          <ul class="category-list" style="padding: 0">
                            @foreach($categories as $category)
                                <li><a href="?category={{$category->name}}"> <i class="fa fa-circle text-{{ array_random(['navy','danger','primary','info','warning']) }}"></i> {{ $category->name }} </a></li>
                            @endforeach
                          </ul>

                          <div class="clearfix"></div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-9 animated fadeInRight">
          <div class="mail-box-header">
              <h2>
                  Novo Recado
              </h2>
          </div>
          <div class="mail-box">

              <div class="mail-body">

                  <form method="post" action="{{ route('message-board.store') }}" enctype="multipart/form-data">
                      {{ csrf_field() }}

                      <div class="form-group row"><label class="col-sm-2 col-form-label">Departamento:</label>
                          <div class="col-sm-10">
                            <select class="selectpicker show-tick with-ajax" data-live-search="true" title="Selecione" data-style="btn-white" data-width="100%" id="select-department" data-route="{{ route('departments_users_search') }}" name="departments[]" multiple="multiple" required>
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
                            <select class="selectpicker show-tick" data-live-search="true" title="Selecione" data-style="btn-white" data-width="100%" id="select-user" name="to[]" multiple="multiple">
                              <option value="0">Todos Usuários</option>
                            </select>
                          </div>
                      </div>

                      <div class="form-group row"><label class="col-sm-2 col-form-label">Tipo:</label>
                          <div class="col-sm-10">
                            <select class="selectpicker show-tick" data-live-search="true" title="Selecione" data-style="btn-white" data-width="100%" name="type_id" required>
                              @foreach($types as $type)
                                  <option value="{{ $type->id }}">{{ $type->name }}</option>
                              @endforeach
                            </select>
                          </div>
                      </div>

                      <div class="form-group row"><label class="col-sm-2 col-form-label">Categorias:</label>
                          <div class="col-sm-10">
                            <select class="selectpicker show-tick" data-live-search="true" title="Selecione" data-style="btn-white" data-width="100%" name="categories[]" multiple="multiple" required>
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

                          <div class="col-sm-10"><input name="files[]" type="file"
                            accept="application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint, text/plain, application/pdf, image/*"
                            class="filestyle" multiple/>
                          </div>

                      </div>


                      <div class="form-group row"><label class="col-sm-2 col-form-label">Importante:</label>
                          <div class="col-sm-10"><input name="important" type="checkbox" class="js-switch" value=""></div>
                      </div>

                      <div class="hr-line-dashed"></div>

                      <div class="mail-text h-200">
                            <textarea class="form-control summernote" name="content"></textarea>
                              <div class="clearfix"></div>
                            <div class="mail-body text-right tooltip-demo">
                                <button type="submit" class="btn btn-primary">Enviar</button>
                                <a href="{{ route('message-board.index') }}" class="btn btn-white" data-toggle="tooltip" data-placement="top" title="" data-original-title="Discard email"><i class="fa fa-times"></i> Descartar</a>
                            </div>
                        <div class="clearfix"></div>
                      </div>

                  </form>

              </div>

          </div>
      </div>

      </div>

      </div>

@endsection
