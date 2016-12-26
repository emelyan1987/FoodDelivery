<?php foreach($messages as $message):?>
    <?php $image_arrow = ($message->from_id==$this->session->userdata('user_id'))?"right":"left";?>
    <li class="<?php echo $image_arrow;?> clearfix">
        <span class="chat-img pull-<?php echo $image_arrow;?>">
            <img src="<?php echo getImageRealPath($message->user_image, 'user');?>" alt="User Avatar">
        </span>
        <div class="chat-body clearfix">
            <div class="header">
                <strong class="primary-font"><?php echo $message->user_fullname;?>&nbsp;</strong>
                <small class="pull-right text-muted"><i class="fa fa-clock-o"></i> <?php echo humanReadableTime(strtotime($message->created_time));?></small>
            </div>
            <span>
                <?php echo $message->message;?>
            </span>
        </div>
    </li>
<?php endforeach?>