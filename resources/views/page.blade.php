<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>chat app - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('cms/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
</head>
<body>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<div class="container">
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card chat-app">
                <div id="plist" class="people-list">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                    <ul class="list-unstyled chat-list mt-2 mb-0">
                        @foreach($users as $user)
                            @if($user->id == \Illuminate\Support\Facades\Auth::user()->id)
                                @continue
                            @endif
                            <li class="clearfix" onclick="getMessages({!! $user->id !!}, '{!! $user->name !!}')">
                                <img src="/storage/{{ $user->image }}" alt="avatar">
                                <div class="about">
                                    <div class="name">{{ $user->name }}</div>
                                    @if($user->isConnected)
                                        <div class="status"> <i class="fa fa-circle online"></i>{{ $user->last_conn }}</div>
                                    @else
                                        <div class="status"> <i class="fa fa-circle offline"></i>{{ $user->last_conn }}</div>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="chat">
                    <div class="chat-header clearfix">
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                    <img id="chat_image" src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                </a>
                                <div class="chat-about">
                                    <h6 class="m-b-0" id="chat_name">Aiden Chavez</h6>
                                    <small id="chat_last_conn">Last seen: 2 hours ago</small>
                                </div>
                            </div>
                            <div class="col-lg-6 hidden-sm text-right">
{{--                                <a href="javascript:void(0);" class="btn btn-outline-secondary"><i class="fa fa-camera"></i></a>--}}
{{--                                <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>--}}
{{--                                <a href="javascript:void(0);" class="btn btn-outline-info"><i class="fa fa-cogs"></i></a>--}}
{{--                                <a href="javascript:void(0);" class="btn btn-outline-warning"><i class="fa fa-question"></i></a>--}}
                            </div>
                        </div>
                    </div>
                    <div class="chat-history">
                        <ul class="m-b-0" id="chat_history">

                        </ul>
                    </div>
                    <div class="chat-message clearfix">
                        <div class="input-group mb-0">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-send"></i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Enter text here..." id="message_input">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    body{
        background-color: #f4f7f6;
        margin-top:20px;
    }
    .card {
        background: #fff;
        transition: .5s;
        border: 0;
        margin-bottom: 30px;
        border-radius: .55rem;
        position: relative;
        width: 100%;
        box-shadow: 0 1px 2px 0 rgb(0 0 0 / 10%);
    }
    .chat-app .people-list {
        width: 280px;
        position: absolute;
        left: 0;
        top: 0;
        padding: 20px;
        z-index: 7
    }

    .chat-app .chat {
        margin-left: 280px;
        border-left: 1px solid #eaeaea
    }

    .people-list {
        -moz-transition: .5s;
        -o-transition: .5s;
        -webkit-transition: .5s;
        transition: .5s
    }

    .people-list .chat-list li {
        padding: 10px 15px;
        list-style: none;
        border-radius: 3px
    }

    .people-list .chat-list li:hover {
        background: #efefef;
        cursor: pointer
    }

    .people-list .chat-list li.active {
        background: #efefef
    }

    .people-list .chat-list li .name {
        font-size: 15px
    }

    .people-list .chat-list img {
        width: 45px;
        border-radius: 50%
    }

    .people-list img {
        float: left;
        border-radius: 50%
    }

    .people-list .about {
        float: left;
        padding-left: 8px
    }

    .people-list .status {
        color: #999;
        font-size: 13px
    }

    .chat .chat-header {
        padding: 15px 20px;
        border-bottom: 2px solid #f4f7f6
    }

    .chat .chat-header img {
        float: left;
        border-radius: 40px;
        width: 40px
    }

    .chat .chat-header .chat-about {
        float: left;
        padding-left: 10px
    }

    .chat .chat-history {
        padding: 20px;
        border-bottom: 2px solid #fff
    }

    .chat .chat-history ul {
        padding: 0;
        list-style: none;
    }

    .chat .chat-history ul li {
        list-style: none;
        margin-bottom: 30px
    }

    .chat .chat-history ul li:last-child {
        margin-bottom: 0px
    }

    .chat .chat-history .message-data {
        margin-bottom: 15px
    }

    .chat .chat-history .message-data img {
        border-radius: 40px;
        width: 40px
    }

    .chat .chat-history .message-data-time {
        color: #434651;
        padding-left: 6px
    }

    .chat .chat-history .message {
        color: #444;
        padding: 18px 20px;
        line-height: 26px;
        font-size: 16px;
        border-radius: 7px;
        display: inline-block;
        position: relative
    }

    .chat .chat-history .message:after {
        bottom: 100%;
        left: 7%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-bottom-color: #fff;
        border-width: 10px;
        margin-left: -10px
    }

    .chat .chat-history .my-message {
        background: #efefef
    }

    .chat .chat-history .my-message:after {
        bottom: 100%;
        left: 30px;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
        border-bottom-color: #efefef;
        border-width: 10px;
        margin-left: -10px
    }

    .chat .chat-history .other-message {
        background: #e8f1f3;
        text-align: right
    }

    .chat .chat-history .other-message:after {
        border-bottom-color: #e8f1f3;
        left: 93%
    }

    .chat .chat-message {
        padding: 20px
    }

    .online,
    .offline,
    .me {
        margin-right: 2px;
        font-size: 8px;
        vertical-align: middle
    }

    .online {
        color: #86c541
    }

    .offline {
        color: #e47297
    }

    .me {
        color: #1d8ecd
    }

    .float-right {
        float: right
    }

    .clearfix:after {
        visibility: hidden;
        display: block;
        font-size: 0;
        content: " ";
        clear: both;
        height: 0
    }

    @media only screen and (max-width: 767px) {
        .chat-app .people-list {
            height: 465px;
            width: 100%;
            overflow-x: auto;
            background: #fff;
            left: -400px;
            display: none
        }
        .chat-app .people-list.open {
            left: 0
        }
        .chat-app .chat {
            margin: 0
        }
        .chat-app .chat .chat-header {
            border-radius: 0.55rem 0.55rem 0 0
        }
        .chat-app .chat-history {
            height: 300px;
            overflow-x: auto
        }
    }

    @media only screen and (min-width: 768px) and (max-width: 992px) {
        .chat-app .chat-list {
            height: 650px;
            overflow-x: auto
        }
        .chat-app .chat-history {
            height: 600px;
            overflow-x: auto
        }
    }

    @media only screen and (min-device-width: 768px) and (max-device-width: 1024px) and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 1) {
        .chat-app .chat-list {
            height: 480px;
            overflow-x: auto
        }
        .chat-app .chat-history {
            height: calc(100vh - 350px);
            overflow-x: auto
        }
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/5.10.1/firebase.js"></script>
<script type="text/javascript">
    const firebaseConfig = {
        apiKey: "AIzaSyBcj0xxB8-JQRUl5pdJH1lt2AfKpQUc9Jc",
        authDomain: "chatapp-155c8.firebaseapp.com",
        databaseURL:"https://chatapp-155c8-default-rtdb.firebaseio.com",
        projectId: "chatapp-155c8",
        storageBucket: "chatapp-155c8.appspot.com",
        messagingSenderId: "499344192049",
        appId: "1:499344192049:web:7ea703aa3d2098a5c91b10"
    };
    firebase.initializeApp(firebaseConfig);
    var database = firebase.database();
    var reciver_id = 0;
    function getMessages(userId, name){
        document.getElementById('chat_name').innerHTML =name;
        reciver_id = userId;
        firebase.database().ref('chats/user_'+{!! \Illuminate\Support\Facades\Auth::user()->id !!}).on('value', function (snapshot) {
            document.getElementById('chat_history').innerHTML ="";
            var value = snapshot.val();
            // console.log(value);
            $.each(value, function (index, value) {
                if (value.reciver_id === userId){
                    $('#chat_history').append(getMessageHtml('left', index, value.message, value.created_at));
                }else if(value.sender_id === userId){
                    $('#chat_history').append(getMessageHtml('right', index, value.message, value.created_at, "https://bootdey.com/img/Content/avatar/avatar2.png"));
                }
            });
        });
    }

    $("#message_input").keyup(function (e) {
        if (e.keyCode === 13){
            var message = $("#message_input").val();
            var sender_id = {!! \Illuminate\Support\Facades\Auth::user()->id !!};
            var created_at = '{!! now() !!}';

            firebase.database().ref('chats/user_'+sender_id).push().set({
                message: message,
                sender_id: sender_id,
                reciver_id: reciver_id,
                created_at:created_at,
                reciverIsRead:0,
                reciver_read_at:'',
                deleted_at:''
            });
            firebase.database().ref('chats/user_'+reciver_id).push().set({
                message: message,
                sender_id: sender_id,
                reciver_id: reciver_id,
                created_at:created_at,
                reciverIsRead:0,
                reciver_read_at:'',
                deleted_at:''
            });
            document.getElementById('message_input').value = "";
        }
    });

    function deleteMessage(index) {
        Swal.fire({
            title: 'Do you want to Delete Message',
            // showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Delete For Me',
            // denyButtonText: `Delete for every one`,
            cancelButtonText: "Chancel",
        }).then((result) => {
            if (result.isConfirmed) {
                console.log('isConfirmed');
                firebase.database().ref('chats/user_' + {!! \Illuminate\Support\Facades\Auth::user()->id !!}+"/"+index).update({
                    deleted_at:'{!! now() !!}'
                });
            } else if (result.isDenied) {
                if (!document.getElementById(index).classList.contains('right')){
                    firebase.database().ref('chats/user_' + {!! \Illuminate\Support\Facades\Auth::user()->id !!}+"/"+index).upadte({deleted_at:'{!! now() !!}'});
                    firebase.database().ref('chats/user_' + resiver_id +"/"+index).update({deleted_at:'{!! now() !!}'});
                }else
                    Swal.fire('Failed to delete message', '', 'info');
            }
        });
    }

    function getMessageHtml(dir, index, message, created_at, image=null) {
        var html = "";
        switch (dir) {
            case 'right':
                html += "<li class='clearfix' onclick='deleteMessage("+index+")'>"+
                        "<div class='message-data text-right'>"+
                        "<span class='message-data-time'>"+(new Date(created_at).toDateString())+"</span>"+
                        "<img src='https://bootdey.com/img/Content/avatar/avatar7.png' alt='avatar'></div>"+
                        "<div class='message other-message float-right'>"+message+"</div></li>";
                break;
            case 'left':
                html += "<li class='clearfix' onclick='deleteMessage("+index+")'>"+
                        "<div class='message-data'>"+
                        "<span class='message-data-time'>"+(new Date(created_at).toDateString())+"</span></div>"+
                        "<div class='message my-message'>"+message+"</div></li>";
                break;
        }
        return html;
    }
</script>
</body>
</html>
