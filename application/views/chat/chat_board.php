<?php $this->load->view('admin/header'); ?>

<link href="<?php echo base_url() ?>asset/lib/css/chat.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url() ?>asset/lib/css/emoji.css" rel="stylesheet" type="text/css"/>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

<div class="container" style="border-top: 1px solid #D14B54; background: #f5f5f5f5; height: 85vh;">
    <div class="row">
        <div class="col-md-2 col-sm-2 col-xs-2">
            <?php $this->load->view('admin/sidebar'); ?>
        </div>
        <div class="col-md-10 col-sm-10 col-xs-10">
            <h1 class="text-center text-uppercase">Activities</h1>
            <hr/>
            <div class="row">
                <div class="col-xs-12">
                    <!-- Tab panes -->
                    <a href="javascript:history.go(-1);"><h3 class="red-title">Go Back</h1></a>
                    <div class="tab-content">
                        <div class="tab-pane active" id="OD">
                                <div class="chat">
                                  <div class="chat-header clearfix">
                                      <div style="margin-left: 40%;">
                                          <div style="float:left; width: 50px;height: 50px;osition: relative;overflow: hidden;border-radius: 50%; padding: 0px;">
                                          <?php
                                            if($photo == '')
                                                echo '<img style="display: inline;margin: 0 auto;margin-left: 0%; height: 100%;width: auto;" src="https://rpsbet.com/asset/images/account.png" alt="avatar" />';
                                            else
                                                echo '<img style="display: inline;margin: 0 auto; height: 100%;width: auto;" src="https://rpsbet.com/uploads/photo/'.$photo.'" alt="avatar" />';
                                          ?>
                                          </div>
                                        <div class="chat-about">
                                          <div class="chat-with">
                                                <?php echo $name; ?>
                                          </div>
                                          <!--<div class="chat-num-messages">already 1 902 messages</div>-->
                                        </div>
                                    </div>
                                    <input type="hidden" value="<?php echo $email; ?>" id="emailAddr" />
                                  </div> <!-- end chat-header -->
                                  
                                  <div class="chat-history">
                                    <ul style="list-style: none;">
                                      <?php 
                                            $email = $this->session->userdata['user_email'];
                                            
                                            foreach($histories as $history) {
                                                if (strpos($history->message_content, '\\') != false )
                                                    $history->message_content = json_decode($history->message_content);
                                                if($history->sender_email == $email) {
                                                    echo '<li class="clearfix">
                                                            <div class="message-data align-right">
                                                              <span class="message-data-time" >'.$history->created_at.'</span> &nbsp; &nbsp;
                                                              <span class="message-data-name" >'.$history->sendname.'</span>
                                                            </div>
                                                            <div class="message other-message float-right">
                                                              '.$history->message_content.'
                                                            </div>
                                                          </li>';
                                                } else {
                                                    echo '<li>
                                                            <div class="message-data">
                                                              <span class="message-data-name"><i class="fa fa-circle online"></i> '.$history->sendname.'</span>
                                                              <span class="message-data-time">'.$history->created_at.'</span>
                                                            </div>
                                                            <div class="message my-message">
                                                              '.$history->message_content.'
                                                            </div>
                                                          </li>';
                                                }
                                            }
                                      ?>
                                    </ul>
                                  </div>
                                  
                                  <div class="chat-message clearfix">
                                      <p style="font-size:36px;float:left;cursor: pointer;" onclick="javascript:addEmoji('&#128545;');">&#128545;</p>
                                      <p style="font-size:36px;float:left;cursor: pointer;" onclick="javascript:addEmoji('&#129316;');">&#129316;</p>
                                      <p style="font-size:36px;float:left;cursor: pointer;" onclick="javascript:addEmoji('&#128557;');">&#128557;</p>
                                      <p style="font-size:36px;float:left;cursor: pointer;" onclick="javascript:addEmoji('&#129297;');">&#129297;</p>
                                      <p style="font-size:36px;float:left;cursor: pointer;" onclick="javascript:addEmoji('&#129315;');">&#129315;</p>
                                      <textarea class="form-control textarea-control" style="float:left;margin-left:30px;" name="message_to_send" id="message_to_send" rows="1" placeholder="Textarea with emoji image input" ></textarea>
                                      <button>Send</button>
                                  </div>
                                  
                                </div>
                                
                                <script id="message-template" type="text/x-handlebars-template">
                                    <li class="clearfix">
                                        <div class="message-data align-right">
                                          <span class="message-data-time" >{{time}}, Today</span> &nbsp; &nbsp;
                                          <span class="message-data-name" ><?php echo $this->session->userdata["user_name"];?></span> <i class="fa fa-circle me"></i>
                                        </div>
                                        <div class="message other-message float-right">
                                          {{messageOutput}}
                                        </div>
                                    </li>
                                </script>
                                
                                <script id="message-response-template" type="text/x-handlebars-template">
                                    <li>
                                    <div class="message-data">
                                      <span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
                                      <span class="message-data-time">{{time}}, Today</span>
                                    </div>
                                    <div class="message my-message">
                                      {{response}}
                                    </div>
                                    </li>
                                </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="https://twitter.github.io/typeahead.js/js/handlebars.js"></script>
<script src="https://rpsbet.com/asset/lib/js/config.js"></script>
<script src="https://rpsbet.com/asset/lib/js/util.js"></script>
<script src="https://rpsbet.com/asset/lib/js/jquery.emojiarea.js"></script>
<script src="https://rpsbet.com/asset/lib/js/emoji-picker.js"></script>
<script>

    (function(){
      var uname = '<?php echo $this->session->userdata["user_name"];?>';
      
      var chat = {
        messageToSend: '',
        messageResponses: [
          'Why did the web developer leave the restaurant? Because of the table layout.',
          'How do you comfort a JavaScript bug? You console it.',
          'An SQL query enters a bar, approaches two tables and asks: "May I join you?"',
          'What is the most used language in programming? Profanity.',
          'What is the object-oriented way to become wealthy? Inheritance.',
          'An SEO expert walks into a bar, bars, pub, tavern, public house, Irish pub, drinks, beer, alcohol'
        ],
        init: function() {
          this.cacheDOM();
          this.bindEvents();
          this.render();
        },
        cacheDOM: function() {
          this.$chatHistory = $('.chat-history');
          this.$button = $('button');
          this.$textarea = $('#message_to_send');
          this.$textarea2 = $('.emoji-wysiwyg-editor');
          this.$chatHistoryList =  this.$chatHistory.find('ul');
        },
        bindEvents: function() {
          this.$button.on('click', this.addMessage.bind(this));
          this.$textarea.on('keyup', this.addMessageEnter.bind(this));
        },
        render: function() {
          this.scrollToBottom();
          if (this.messageToSend.trim() !== '') {
            var template = Handlebars.compile( $("#message-template").html());
            var context = { 
              messageOutput: this.messageToSend,
              time: this.getCurrentTime()
            };
    
            this.$chatHistoryList.append(template(context));
            this.scrollToBottom();
            this.$textarea.val('');
            
            /*// responses
            var templateResponse = Handlebars.compile( $("#message-response-template").html());
            var contextResponse = { 
              response: this.getRandomItem(this.messageResponses),
              time: this.getCurrentTime()
            };
            
            setTimeout(function() {
              this.$chatHistoryList.append(templateResponse(contextResponse));
              this.scrollToBottom();
            }.bind(this), 1500);*/
            
          }
          
        },
        addMessage: function() {
            var receiver = $('#emailAddr').val();
            
            var message = this.$textarea.val();
            
            $.ajax({
                type:'GET',
                url:'<?php echo base_url()?>chat/sendMessage?receiver='+receiver+'&message=' + this.$textarea.val()
            }).done(function (data){
                //alert(data)       
            });
            this.messageToSend = message;
            this.render();
            
        },
        addMessageEnter: function(event) {
            // enter was pressed
            if (event.keyCode === 13) {
              this.addMessage();
            }
        },
        scrollToBottom: function() {
           this.$chatHistory.scrollTop(this.$chatHistory[0].scrollHeight);
        },
        getCurrentTime: function() {
          return new Date().toLocaleTimeString().
                  replace(/([\d]+:[\d]{2})(:[\d]{2})(.*)/, "$1$3");
        },
        getRandomItem: function(arr) {
          return arr[Math.floor(Math.random()*arr.length)];
        }
        
      };
      
      chat.init();
      
    })();
    
    isCheckMessage();
    
    message_to_send.oninput = function () {
        var message = message_to_send.value;
        
        if(message == '(angry)')
            message_to_send.value = '😡';//&#128545;
        else if(message == ':p')
            message_to_send.value = '🤤';//&#129316;
        else if(message == '(cry)')
            message_to_send.value = '😭';//&#129316;
        else if(message == '(money)')
            message_to_send.value = '🤑';//&#129316;
        else if(message == 'lol')
            message_to_send.value = '🤣';//&#129316;
        
        //alert("="+message+"=");    
    }
    
    function isCheckMessage() {
        setTimeout(function () {
          //do something once
          getNewMessage();
        }, 500);
    }
    
    function getNewMessage() {
        var receiver = $('#emailAddr').val();
        
        $.ajax({
            type:'GET',
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            url:'<?php echo base_url()?>chat/getNewMessage?receiver='+receiver
        }).done(function (data) {
            if (typeof data.name !== 'undefined') {
                var html = '<li><div class="message-data"><span class="message-data-name">';
                html+= '<i class="fa fa-circle online"></i> '+data.name+'</span><span class="message-data-time">'+data.created_at+'</span></div><div class="message my-message">'+data.message_content+'</div></li>';
                              
                $('.chat-history').find('ul').append(html);
                $('.chat-history').scrollTop($('.chat-history')[0].scrollHeight);
            }
                
            //alert('ppp');
            isCheckMessage();
        });
    }
    
    function addEmoji(emoji) {
        var html = $('#message_to_send').val();
        html = html + emoji;
        $('#message_to_send').val(html);
    }
    
    $(function() {
        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
          emojiable_selector: '[data-emojiable=true]',
          assetsPath: '../asset/images',
          popupButtonClasses: 'fa fa-smile-o'
        });
        // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // It can be called as many times as necessary; previously converted input fields will not be converted again
        window.emojiPicker.discover();
    });
    
</script>
<?php
$this->load->view('admin/footer');
