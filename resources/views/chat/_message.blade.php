<div class="chat-header clearfix">
    @include('chat._header')
</div>
<div class="chat-history">
    @include('chat._chat')
</div>
<div class="chat-message clearfix">
        <span id="getFileName"></span>
    <form action="" id="submit_message" method="post" class="input-group mb-0" enctype="multipart/form-data">
        <input type="hidden" value="{{ $getReceiver->id }}" name="receiver_id">
        {{ csrf_field() }}

        <!-- <div class="input-group-prepend">
            <button class="input-group-text" id="emojionearea"><i class="nav-icon fas fa-frown-open"></i></button>
        </div> -->

        <div class="input-group-prepend col-lg-12">
            <div class="input-group-prepend">
                <a href="javascript:void(0);" type="file" id="OpenFile" class="input-group-text"><i class="nav-icon fas fa-image"></i></a>
                <input type="file" style="display: none;" name="file_name" id="file_name">
            </div>

            <textarea style="height: 35px;" name="message" id="ClearMessage" required class="emojionearea form-control" placeholder="Enter text here..."></textarea>
            <div class="input-group-prepend">
                <button type="submit" class="input-group-text"><i class="nav-icon fas fa-paper-plane"></i></button>
            </div>
        </div>
    </form>
</div>