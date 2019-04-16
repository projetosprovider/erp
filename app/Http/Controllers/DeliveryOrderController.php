<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryOrder;
use App\Models\{Documents,Client, People};
use App\Models\Department\Occupation;
use App\Models\DeliveryOrder\Documents as DeliveryOrderDocuments;
use App\Helpers\Constants;
use App\Notifications\DeliveryOrder as DeliveryOrderNotification;
use App\Mail\DeliveryOrder as DeliveryOrderMail;
use App\Jobs\DeliveryOrder as DeliveryOrderJob;
use Notification;
use Auth;
use PDF;
use Mail;

class DeliveryOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermission('view.ordem.entrega')) {
            return abort(403, 'Unauthorized action.');
        }

        $orders = DeliveryOrder::all();
        return view('admin.delivery-order.index', compact('orders'));
    }

    public function printTags($id, Request $request)
    {
        $delivery = DeliveryOrder::uuid($id);

        $user = $request->user();

        echo route('start_delivery', $delivery->uuid);

        $titulo = "etiquetas-".str_random();

        $file = \Storage::disk('local')->path($user->avatar);

        return view('pdf.tags', compact('delivery', 'file'));

        $pdf = PDF::loadView('pdf.tags', compact('delivery', 'file'));
        return $pdf->stream($titulo. ".pdf");
    }

    public function start($id, Request $request)
    {
        $delivery = DeliveryOrder::uuid($id);

        //dd($delivery->status_id);

        if($delivery->status_id == Constants::STATUS_DELIVERY_PENDENTE) {

            $delivery->status_id = Constants::STATUS_DELIVERY_EM_TRANSITO;
            //$delivery->save();

            $message = 'Ordem de Entrega nº: '. str_pad($delivery->id, 6, "0", STR_PAD_LEFT) .' está em Transito.';

            $job = dispatch(new DeliveryOrderJob($delivery, 'Ordem de Entrega', $message));

            dd($job);

            return response($message, 200);

        } elseif($delivery->status_id == Constants::STATUS_DELIVERY_EM_TRANSITO) {

            $delivery->status_id = Constants::STATUS_DELIVERY_ENTREGUE;
            //$delivery->save();

            return response('A Ordem de Entrega nº: '. str_pad($delivery->id, 6, "0", STR_PAD_LEFT) .' foi entregue.', 200);
        }

        try {

            DeliveryOrderJob::dispatch($delivery, 'Ordem de Entrega')->onQueue('emails');

        } catch(\Exception $e) {

        }

        return abort(403);
    }

    public function status($id, Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.delivery-order.create');
    }

    public function conference(Request $request)
    {
        if(!$request->has('document')) {

          notify()->flash('Documento não informado!', 'error', [
            'text' => 'Um documento deve ser informado para a geração da Ordem de entrega.'
          ]);

          return back();
        }

        $data = $request->request->all();

        if(count($data) == 1) {

          $document = Documents::uuid(current($data['document']));
          $hasDocument = DeliveryOrderDocuments::where('document_id', $document->id)->get();

          if($hasDocument->isNotEmpty()) {

            $string = 'O documento ' . $document->description . ' já está vinculado à Ordem de Entrega n. '. $hasDocument->first()->id ?? '';

            notify()->flash('Falha ao adicionar documento!', 'error', [
              'text' => $string,
            ]);

            return back();

          }

        }

        $occupation = Occupation::where('name', 'Entregador')->get();

        if($occupation->isEmpty()) {
          notify()->flash('Cargo de Entregador não existe.', 'warning', [
            'text' => 'Para que a entrega possa ser realizada é necessário criar o cargo Entregador.'
          ]);

          return back();
        }

        $occupation = $occupation->first();

        $delivers = People::where('occupation_id', $occupation->id)->get();

        if($delivers->isEmpty()) {
          notify()->flash('Nenhum usuário com o cargo de Entregador.', 'warning', [
            'text' => 'Para que a entrega possa ser realizada é necessário ao menos um usuário com o cargo de Entregador.'
          ]);

          return back();
        }

        $documents = Documents::whereIn('uuid', $data['document'])->get();

        foreach ($documents as $key => $document) {
            if(!$document->address) {
              notify()->flash('Endereço não informado!', 'error', [
                'text' => 'O documento ' . $document->description . ' não possui endereço de entrega, e é obrigatória essa informação.'
              ]);

              return back();
            }
        }

        return view('admin.delivery-order.conference', compact('documents', 'delivers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->request->all();

        $deliverUuid = $data['delivered_by'];

        $deliver = People::uuid($deliverUuid);
        $data['delivered_by'] = $deliver->id;

        $documents = Documents::whereIn('uuid', $data['documents'])->get();

        $documentsGroupedByClients = [];

        $deliveryDate = $data['delivery_date'] ? \DateTime::createFromFormat('d/m/Y', $data['delivery_date']) : null;

        foreach ($documents as $key => $document) {

            $hasDocument = DeliveryOrderDocuments::where('document_id', $document->id)->get();

            if($hasDocument->isNotEmpty()) {

              $string = 'O documento ' . $document->description . ' já está vinculado à Ordem de Entrega n. '. $hasDocument->first()->id ?? '';

              notify()->flash('Falha ao adicionar documento!', 'error', [
                'text' => $string,
              ]);

              return back();

            }

            $documentsGroupedByClients[$document->client->id][] = $document;
        }

        foreach ($documentsGroupedByClients as $keyClient => $documentsGroupedByClient) {

            $deliveryOrder = DeliveryOrder::create([
              'client_id' => $keyClient,
              'status_id' => 1,
              'delivered_by' => $data['delivered_by']
            ]);

            foreach ($documentsGroupedByClient as $key => $document) {
                DeliveryOrderDocuments::create([
                  'document_id' => $document->id,
                  'delivery_order_id' => $deliveryOrder->id,
                  'delivery_date' => $deliveryDate,
                  'annotations' => $data['annotations'],
                  'user_id' => $request->user()->id
                ]);
                $document->status_id = 2;
                $document->save();
            }

        }

        notify()->flash('Sucesso!', 'success', [
          'text' => 'Nova Ordem de Entrega Gerada com sucesso.'
        ]);

        return redirect()->route('delivery-order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $data = $request->request->all();

        $occupation = Occupation::where('name', 'Entregador')->get();

        if($occupation->isEmpty()) {
          notify()->flash('Cargo de Entregador não existe.', 'warning', [
            'text' => 'Para que a entrega possa ser realizada é necessário criar o cargo Entregador.'
          ]);

          return back();
        }

        $occupation = $occupation->first();

        $delivers = People::where('occupation_id', $occupation->id)->get();

        if($delivers->isEmpty()) {
          notify()->flash('Nenhum usuário com o cargo de Entregador.', 'warning', [
            'text' => 'Para que a entrega possa ser realizada é necessário ao menos um usuário com o cargo de Entregador.'
          ]);

          return back();
        }

        $delivery = DeliveryOrder::uuid($id);
        $documents = $delivery->documents;
        $resultado = [];

        foreach ($delivery->documents as $key => $document) {
            $resultado[] = $document->document;
        }

        $documents = $resultado;

        return view('admin.delivery-order.edit', compact('documents', 'delivers', 'delivery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->request->all();

        $deliverUuid = $data['delivered_by'];

        $deliver = People::uuid($deliverUuid);
        $data['delivered_by'] = $deliver->id;

        $documents = Documents::whereIn('uuid', $data['documents'])->get();

        $deliveryOrder = DeliveryOrder::uuid($id);

        $deliveryDate = $data['delivery_date'] ? \DateTime::createFromFormat('d/m/Y', $data['delivery_date']) : null;

        $deliveryOrder->update([
          'delivered_by' => $data['delivered_by'],
          'delivery_date' => $deliveryDate,
          'annotations' => $data['annotations']
        ]);

        notify()->flash('Sucesso!', 'success', [
          'text' => 'Ordem de Entrega Atualizada com sucesso.'
        ]);

        return redirect()->route('delivery-order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
