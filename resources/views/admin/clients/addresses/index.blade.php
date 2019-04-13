@extends('layouts.app')

@push('stylesheets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.3/chosen.min.css">
@endpush

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Endereços: {{ $client->name }}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}">Painel Principal</a>
                </li>

                <li class="active">
                    <strong>Endereços</strong>
                </li>
            </ol>
        </div>

        <div class="col-lg-2">
            @permission('create.clientes')
                <a href="{{route('client_addresses_create', $client->uuid)}}" class="btn btn-primary btn-block dim m-t-lg">Novo Endereço</a>
            @endpermission
        </div>

    </div>


    <div class="row">
        <div class="wrapper wrapper-content animated fadeInUp">

            <div class="col-lg-12">

                <div class="ibox">
                <div class="ibox-title">
                    <h5>Listagem</h5>
                </div>
                <div class="ibox-content">

                    <div class="project-list">
                        @if($client->addresses->isNotEmpty())
                            <table class="table table-hover">
                                <tbody>
                                    @foreach($client->addresses as $address)
                                        <tr>

                                            <td class="project-title">
                                                <p>ID:</p>
                                                <a>{{$address->id}}</a>
                                            </td>

                                            <td class="project-title">
                                                <p>Descrição:</p>
                                                <a>{{$address->description}}</a>
                                            </td>

                                            <td class="project-title">
                                                <p>Logradouro:</p>
                                                <a>{{$address->street}}, {{$address->number}} - {{$address->district}}</a>
                                            </td>

                                            <td class="project-title">
                                                <p>Cidade:</p>
                                                <a>{{$address->city}} - {{$address->zip}}</a>
                                            </td>

                                            <td class="project-title">
                                                <p>Adicionado em:</p>
                                                <a>{{$address->created_at->format('d/m/Y H:i')}}</a>
                                            </td>

                                            <td class="project-actions">
                                              @permission('edit.clientes')
                                                <a href="{{route('client_addresses_edit', [$client->uuid, $address->uuid])}}" class="btn btn-white"><i class="fa fa-pencil"></i> Editar</a>
                                              @endpermission

                                              @permission('delete.clientes')
                                                <a data-route="{{route('client_address_destroy', ['id' => $address->uuid])}}" class="btn btn-danger btnRemoveItem"><i class="fa fa-close"></i> Remover</a>
                                              @endpermission
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        @else
                            <div class="alert alert-warning text-center">Nenhum cliente registrado até o momento.</div>
                        @endif
                    </div>

                </div>

            </div>

        </div>
    </div>

        <div class="modal inmodal" id="add-client-address-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Novo Endereço</h4>
                    </div>
                    <form action="{{route('client_addresses_store', $client->uuid)}}" method="post">
                        {{csrf_field()}}
                        <div class="modal-body">

                        <div class="row">

                        <input type="hidden" value="{{$client->id}}" name="client_id">

                        <div class="form-group col-md-12"><label class="control-label">Descrição</label>
                            <input type="text" name="description" required class="form-control" id="description" placeholder="Ex: Matriz">
                        </div>

                        <div class="form-group col-md-3"><label class="control-label">CEP</label>
                            <input type="text" data-cep="{{ route('cep') }}" name="zip" required class="form-control inputCep">
                        </div>

                        <div class="form-group col-md-6"><label class="control-label">Rua</label>
                            <input type="text" name="street" required class="form-control" id="street">
                        </div>

                        <div class="form-group col-md-3"><label class="control-label">Numero</label>
                            <input type="text" name="number" class="form-control" id="number">
                        </div>

                        <div class="form-group col-md-4"><label class="control-label">Bairro</label>
                            <input type="text" name="district" required class="form-control" id="district">
                        </div>

                        <div class="form-group col-md-6"><label class="control-label">Cidade</label>
                            <input type="text" name="city" required class="form-control" id="city">
                        </div>

                        <div class="form-group col-md-2"><label class="control-label">Estado</label>
                            <input type="text" name="state" required class="form-control" id="state">
                        </div>

                        <div class="form-group col-md-6"><label class="control-label">Complemento</label>
                            <input type="text" name="complement" class="form-control" id="complement">
                        </div>

                        <div class="form-group col-md-6"><label class="control-label">Referência</label>
                            <input type="text" name="reference" class="form-control" id="reference">
                        </div>

                        <div class="form-group col-md-6"><label class="control-label">Longitude</label>
                            <input type="text" name="long" class="form-control" id="long">
                        </div>

                        <div class="form-group col-md-6"><label class="control-label">Latitude</label>
                            <input type="text" name="lat" class="form-control" id="lat">
                        </div>

                        <div class="form-group col-md-6">
                            <input type="checkbox" name="is_default" id="is_default" value="1"/>
                            <label class="control-label">Endereço Principal</label>
                        </div>

                        </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection

@push('scripts')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.3/chosen.jquery.min.js"></script>

  <script>

    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });

  </script>

@endpush
