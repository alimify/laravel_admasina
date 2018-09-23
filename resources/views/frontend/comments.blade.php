    @foreach($comments as $comment)
        <div class="comment">

            <div class="post-info">

                <div class="left-area">
                    <a class="avatar" href="#"><img src="{{asset('storage/profile/'.$comment->user->image)}}" alt="Profile Image"></a>
                </div>

                <div class="middle-area">
                    <a class="name" href="javascript:void(0)"><b>{{$comment->user->name}}</b></a>
                    <h6 class="date">{{$comment->created_at->diffForHumans()}}</h6>
                </div>

            </div><!-- post-info -->

            <p>{{$comment->comment_text}}</p>

        </div>
    @endforeach
