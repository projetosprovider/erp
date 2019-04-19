@extends('layouts.app')

@section('page-title', 'Conversa com ' . $user->person->name)

@section('css')
    <style>
    .container{max-width:1170px; margin:auto;}
      img{ max-width:100%;}
      .inbox_people {
      background: #f8f8f8 none repeat scroll 0 0;
      float: left;
      overflow: hidden;
      width: 40%; border-right:1px solid #c4c4c4;
      }
      .inbox_msg {
      border: 1px solid #c4c4c4;
      clear: both;
      overflow: hidden;
      }
      .top_spac{ margin: 20px 0 0;}


      .recent_heading {float: left; width:40%;}
      .srch_bar {
      display: inline-block;
      text-align: right;
      width: 60%; padding:
      }
      .headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

      .recent_heading h4 {
      color: #05728f;
      font-size: 21px;
      margin: auto;
      }
      .srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
      .srch_bar .input-group-addon button {
      background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
      border: medium none;
      padding: 0;
      color: #707070;
      font-size: 18px;
      }
      .srch_bar .input-group-addon { margin: 0 0 0 -27px;}

      .chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
      .chat_ib h5 span{ font-size:13px; float:right;}
      .chat_ib p{ font-size:14px; color:#989898; margin:auto}
      .chat_img {
      float: left;
      width: 11%;
      }
      .chat_ib {
      float: left;
      padding: 0 0 0 15px;
      width: 88%;
      }

      .chat_people{ overflow:hidden; clear:both;}
      .chat_list {
      border-bottom: 1px solid #c4c4c4;
      margin: 0;
      padding: 18px 16px 10px;
      }
      .inbox_chat { height: 550px; overflow-y: scroll;}

      .active_chat{ background:#ebebeb;}

      .incoming_msg_img {
      display: inline-block;
      width: 6%;
      }
      .received_msg {
      display: inline-block;
      padding: 0 0 0 0;
      vertical-align: top;
      /*width: 92%;*/
      }
      .received_withd_msg p {
      background: #ebebeb none repeat scroll 0 0;
      border-radius: 3px;
      color: #646464;
      font-size: 14px;
      margin: 0;
      padding: 5px 10px 5px 12px;
      width: 100%;
      }
      .time_date {
      color: #747474;
      display: block;
      font-size: 12px;
      margin: 8px 0 0;
      }
      .received_withd_msg { width: 100%;}
      .mesgs {
      float: left;
      padding: 30px 15px 0 15px;
      width: 100%;
      }

      .sent_msg p {
      background: #05728f none repeat scroll 0 0;
      border-radius: 3px;
      font-size: 14px;
      margin: 0; color:#fff;
      padding: 5px 10px 5px 12px;
      width:100%;
      }
      .incoming_msg, .outgoing_msg{
        overflow:hidden;
        margin:5px 10px 5px;
      }
      .sent_msg {
      float: right;
      /*width: 46%;*/
      }
      .input_msg_write input {
      background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
      border: medium none;
      color: #4c4c4c;
      font-size: 15px;
      min-height: 48px;
      width: 100%;
      }

      .type_msg {border-top: 1px solid #c4c4c4;position: relative;}
      .msg_send_btn {
        background: #05728f none repeat scroll 0 0;
        border: medium none;
        border-radius: 50%;
        color: #fff;
        cursor: pointer;
        font-size: 17px;
        height: 33px;
        position: absolute;
        right: 0;
        top: 11px;
        width: 33px;
      }
      .messaging { padding: 0 0 0 0;}
      .messages-container {
        display: flex;
        flex-direction: column;
        overflow-y: auto;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 100%;
      }

      .message {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        flex-shrink: 1;
        box-sizing: border-box;
        overflow-x: hidden;
        position: relative;
        width: 100%;
      }

      .msg-box {
        margin: 5px;
        /*padding: 20px;*/
        background-color: #fff;
        border-radius: 8px;
      }
    </style>
@stop

@section('content')

  <input type="hidden" id="currentUser" value="{{ Auth::user()->uuid }}"/>
  <input type="hidden" id="receiver" value="{{ $user->uuid }}"/>

  <input type="hidden" id="route-messages" value="{{ route('chat_messages', $user->id) }}"/>
  <input type="hidden" id="route-post-message" value="{{ route('chat_messages', $user->id) }}"/>

  <div id="app" :user="{{ $user->id }}">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><img width="32" src="{{ $user->avatar }}" class="rounded-circle user_img_msg"/> {{ $user->person->name }}
                  <receiverstatus :user="{{ Auth::user() }}" :receiver="{{ $user }}"></receiverstatus>
                </div>

                <div class="panel-body" style="background-color:smoke;position:relative;min-height:400px">
                    <chat-messages :messages="messages" :user="{{ Auth::user() }}" :receiver="{{ $user }}"></chat-messages>
                </div>
                <div class="panel-footer">
                    <chat-form
                        v-on:messagesent="addMessage"
                        :user="{{ Auth::user() }}"
                        :receiver="{{ $user }}"
                    ></chat-form>
                </div>
            </div>
        </div>
    </div>
  </div>

@endsection
