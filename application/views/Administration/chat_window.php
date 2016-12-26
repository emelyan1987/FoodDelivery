<head>
    <title>Mataam Admin Chat Room</title>
    <link rel="stylesheet" href="/assets/common/bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="/assets/common/css/chat.css"/>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="/assets/common/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
    <script src="/assets/common/moment.js" type="text/javascript"></script>
    <script src="/assets/common/underscore.js" type="text/javascript"></script>
</head>

<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-md-4 bg-white" style="height:95vh; overflow-y:auto;">
            <div class="row border-bottom padding-sm" style="height: 40px;">
                Customer
            </div>

            <ul class="friend-list">
                <?php foreach($threads as $thread):?>
                    <li id="li-customer-<?php echo $thread->from_id;?>" class="<?php echo $thread->from_id==$from?"active":"";?> bounceInDown customer-li" onclick="selectCustomer(this, <?php echo $thread->from_id;?>)">
                        <a href="#" class="clearfix">
                            <img src="<?php echo getImageRealPath($thread->user_image, 'user');?>" alt="" class="img-circle">
                            <div class="friend-name"><strong><?php echo $thread->user_fullname;?>&nbsp;</strong></div>
                            <div class="last-message text-muted"><?php echo $thread->last_message;?></div>
                            <small class="time text-muted"><?php echo humanReadableTime(strtotime($thread->last_time));?></small>
                            <small class='unread-cnt chat-alert label label-danger'><?php echo $thread->unread_cnt>0?$thread->unread_cnt:"";?></small>
                        </a>
                    </li>
                    <?php endforeach?>              
            </ul>
        </div>

        <div class="col-md-8 bg-white " style="height:95vh;overflow-y:auto;">
            <div id="div-messages" class="chat-message" style="height:82%;overflow-y:auto;">
                <ul class="chat">

                </ul>
            </div> 
            <div class="chat-box bg-white">
                <div id="div-typing">&nbsp;</div>
                <textarea id="text-message" class="form-control" placeholder="type a message"></textarea>

                <div style="margin-top:10px;"><button id="btn-send-message" class="pull-right btn btn-success">Send</button></div> 
            </div>           
        </div>        
    </div>
</div>

<script>
    /*function h(e) {
    $(e).css({'height':'auto','overflow-y':'hidden'}).height(e.scrollHeight);
    }
    $('textarea#text-message').each(function () {
    h(this);
    }).on('input', function () {
    h(this);
    });*/


    /*$('textarea#text-message').keydown(function (e) {
    if (e.keyCode === 13 && e.ctrlKey) {
    console.log("enterKeyDown+ctrl");
    $(this).val(function(i,val){
    return val + "\n";
    });
    }
    }).keypress(function(e){
    if (e.keyCode === 13 && !e.ctrlKey) {
    alert('submit');
    return false;  
    } 
    });*/

    var selectedCustomerId = '<?php echo $from;?>';
    function selectCustomer(li, customer_id) {
        $('.customer-li').each(function(){
            $(this).removeClass('active') ;
        });

        $(li).addClass('active');

        $.ajax({
            url: "/chat_messages_ajax",
            type: "get",
            data: {
                from: customer_id
            },
            success: function (response) {
                response = JSON.parse(response);

                if(response.messages) {
                    $('#div-messages>ul').html('')
                    messages = response.messages; 
                    dates = [];
                    messages.forEach(function(msg){
                        appendMessage(msg);
                    }); 
                    $("#div-messages").animate({scrollTop: $('#div-messages').prop("scrollHeight")}, 500); 
                }
            }
        });

        selectedCustomerId = customer_id;
    }

    var dates = [];
    function appendMessage(message) {
        var date = moment(message.created_time).format('MMMM Do, YYYY'); 

        if(dates.indexOf(date)==-1) {
            dates.push(date);

            var dateLineHTML = '<li class="date-line">'+date+'</li>';
            $("#div-messages>ul").append(dateLineHTML);
        } 
        var html = '<li id="li-message-'+message.id+'" class="'+message.arrow+' clearfix" onmouseover="onMouseOverMessageLi(this,\''+message.id+'\')" onmouseout="onMouseOutMessageLi(this)">'+
        '<span class="chat-img pull-'+message.arrow+'">'+
        '<img src="'+message.user_image+'" alt="User Avatar">'+
        '</span>'+
        '<div class="chat-body clearfix">'+
        '<div class="header">'+
        '<strong class="primary-font">'+message.user_fullname+'&nbsp;</strong>'+
        '<small class="pull-right text-muted"><i class="fa fa-clock-o"></i> '+moment(message.created_time).format('h:mm A')+'</small>'+
        '</div>'+
        '<div>'+
        '<span class="span-message">'+(message.is_deleted=='1'?'<i class="fa fa-trash"></i>':(message.is_updated=='1'?'<i class="fa fa-edit"></i>&nbsp;':'')+message.message)+'</span>'+
        '<div class="pull-right btn-group btn-action" style="display:none;"><a class="btn btn-default btn-sm" onclick="onClickEditMessage(\''+message.id+'\')"><i class="fa fa-edit"></i></a><a class="btn btn-default btn-sm" onclick="onClickDeleteMessage('+message.id+')"><i class="fa fa-remove"></i></a></div>'+
        '</div>'+
        '</div>'+
        '</li>';

        $("#div-messages>ul").append(html);

        // mark as read
        if(conn!=undefined && message.from_id == selectedCustomerId && message.is_read=='0') {
            conn.send(JSON.stringify({
                event: 'read message',
                data: {
                    message_id: message.id
                }
            }))
        }
    }

    var threads = eval('<?php echo addslashes(json_encode($threads));?>'); 
    var messages = eval('<?php echo addslashes(json_encode($messages));?>'); 

    $('#btn-send-message').on({
        click: function(e){
            var text = $('#text-message').val();
            if(text!=null && text != "") {
                sendMessage(text);
                $('#text-message').val('');
                selectedMessageId = undefined;
            }
        }
    });

    $('textarea#text-message').on({
        keypress: function(e){
            conn.send(JSON.stringify({
                event: 'typing',
                data: {
                    to: 'user_'+selectedCustomerId
                }
            }));
        }
    })
    function onMouseOverMessageLi(li, message_id) { 
        var message = _.findWhere(messages, {id:message_id}); //console.log(message);
        if(message.arrow == 'right' && message.is_deleted=="0") {
            $(li).find('div.btn-action').css('display','inline-block');
        }
    }

    function onMouseOutMessageLi(li) { 

        $(li).find('div.btn-action').css('display','none');
    }

    var selectedMessageId = undefined;
    function onClickEditMessage(message_id) { 
        selectedMessageId = message_id;

        var message = _.findWhere(messages, {id:message_id});console.log('onClickEditMessage', message_id, message);
        $('#text-message').val(message.message);
    }

    function onClickDeleteMessage(message_id) {

        conn.send(JSON.stringify({
            event: 'delete message',
            data: {
                message_id: message_id
            }
        }));    
    }

    var conn = new WebSocket('ws://'+document.domain+':8080');
    conn.onopen = function(e) {
        console.log("Connection established!");

        var loginData = {
            event: 'admin login',
            data: {
                access_token: '<?php echo $_SESSION['access_token'];?>'
            }
        }
        conn.send(JSON.stringify(loginData), function(res){console.log("login",res)});

    };

    conn.onmessage = function(e) {
        var msg = JSON.parse(e.data);
        console.log(msg);

        if(msg && msg.event) {
            if(msg.event === 'login') {
                handleLoginUser(msg.data);
            } else if(msg.event === 'create message') {
                handleCreateMessage(msg.data);
            } else if(msg.event === 'update message') {
                handleUpdateMessage(msg.data);
            } else if(msg.event === 'delete message') {
                handleDeleteMessage(msg.data);
            } else if(msg.event === 'read message') {
                handleReadMessage(msg.data);
            } else if(msg.event === 'typing') {
                handleTypingMessage(msg.data);
            }
        }
    };

    function sendMessage(text) {
        var message;
        if(selectedMessageId == undefined) {
            message = {
                event: 'create message',
                data: {
                    message: text,
                    to: 'user_'+selectedCustomerId
                }
            };    
        } else {
            message = {
                event: 'update message',
                data: {
                    message_id: selectedMessageId,
                    message: text
                }
            };
        }

        conn.send(JSON.stringify(message));
    }

    function handleLoginUser(data) { console.log(data);
        if(data.userid == '<?php echo $this->session->userdata('user_id');?>') {
            messages.forEach(function(msg){
                appendMessage(msg);
            });
            $("#div-messages").animate({scrollTop: $('#div-messages').prop("scrollHeight")}, 500);
        }
    }
    function handleCreateMessage(data) {console.log(data);

        var message = data.message;
        if(message) {

            $('#li-customer-'+message.from_id).find('div.last-message').text(message.message);
            $('#li-customer-'+message.from_id).find('small.time').text(moment().fromNow());

            if(message.from_id==selectedCustomerId || message.from_id=='<?php echo $this->session->userdata('user_id');?>') {
                appendMessage(data.message);
                $("#div-messages").animate({scrollTop: $('#div-messages').prop("scrollHeight")}, 500);
                
                messages.push(message);
            } else {
                var thread = _.findWhere(threads, {from_id:message.from_id}),
                unread_cnt = parseInt(thread.unread_cnt); console.log(thread, unread_cnt);
                unread_cnt++;
                thread.unread_cnt = unread_cnt;
                $('#li-customer-'+message.from_id).find('small.unread-cnt').text(unread_cnt);
            }   
        }
    }
    function handleUpdateMessage(data) {console.log(data);        
        var message = data.message;
        $('#li-message-'+message.id).find('span.span-message').fadeOut("slow", function(){
            var span = $("<span class='span-message'><i class='fa fa-edit'></i>&nbsp;"+message.message+"</span>").hide();
            $(this).replaceWith(span);
            $('#li-message-'+message.id).find('span.span-message').fadeIn("slow");
        });
    }
    function handleDeleteMessage(data) {console.log(data);
        $('#li-message-'+data.message_id).find('span.span-message').fadeOut("slow", function(){
            var span = $("<span class='span-message'><i class='fa fa-trash'></i></span>").hide();
            $(this).replaceWith(span);
            $('#li-message-'+data.message_id).find('span.span-message').fadeIn("slow");
        });
    }
    function handleReadMessage(data) {console.log("read",data);
        var message = data.message;
        $('#li-customer-'+message.from_id).find('small.unread-cnt').text(data.unread_cnt=='0'?'':data.unread_cnt);
        var thread = _.findWhere(threads, {from_id:message.from_id});
        thread.unread_cnt = data.unread_cnt;
    }
    function handleTypingMessage(data) {console.log(data);
        if(data.userid && data.userid==selectedCustomerId) {
            $('#div-typing').html(data.username+' is typing...');
            setTimeout(function(){
                $('#div-typing').html('&nbsp;');
                }, 1000);            
        }
    }
</script>