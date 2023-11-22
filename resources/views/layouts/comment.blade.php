<div class=" my-3">
    <h5>Comments</h5>

    <div class="">
        {{-- List of Comments --}}
        @foreach ($article->comments()->whereNull('parent_id')->latest('id')->get() as $comment)
            <div class=" card mb-2">
                <div class="card-body">
                    <div class=" d-flex justify-content-between align-items-center mb-2">

                        <p class=" mb-0 fs-5 fw-bolder">
                            <i class=" bi bi-person"></i> {{ $comment->user->name }}
                        </p>
                        <span class="  badge bg-dark">{{ $comment->created_at->diffforhumans() }}</span>
                    </div>
                    <div class="">
                        <p class=" fs-6">
                            <i class="bi bi-chat-right-text-fill"></i> {{ $comment->content }}
                        </p>
                    </div>

                    <div class="">
                        {{-- Deleting The Comment --}}
                        @can('delete', $comment)
                            <form action="{{ route('comment.destroy', $comment->id) }}" method="POST"
                                class=" d-inline-block">
                                @csrf
                                @method('delete')
                                <button class="badge bg-dark mb-3 ">
                                    <span class=" bi bi-trash3"></span> Delete
                                </button>
                            </form>
                        @endcan

                        {{-- For Comment Reply --}}
                        <button class="badge bg-dark mb-3 reply-btn">
                            <span class=" bi bi-reply"></span> Reply
                        </button>

                        <form action="{{ route('comment.store') }}" class=" d-none" method="POST">
                            @csrf
                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                            <textarea placeholder="Say Something about this comment..." class=" form-control" name="content" rows="5"></textarea>
                            <div class=" my-3 d-flex justify-content-between">
                                <span>Replying... as {{ Auth::user()->name }}</span>
                                <button class=" btn btn-dark">Comment</button>
                            </div>
                        </form>

                        {{-- Replying Comment List --}}

                        <div class=" m-2">
                            @foreach ($comment->replies()->latest("id")->get() as $reply)
                                <div class=" card  mb-2">
                                    <div class="card-body">
                                        <div class=" d-flex justify-content-between align-items-center mb-2">

                                            <p class=" mb-0 fs-5 fw-bolder">
                                                <i class=" bi bi-person"></i> {{ $reply->user->name }}
                                            </p>
                                            <span
                                                class="  badge bg-dark">{{ $reply->created_at->diffforhumans() }}</span>
                                        </div>
                                        <div class="">
                                            <p class=" fs-6">
                                                <i class="bi bi-reply"></i> {{ $reply->content }}
                                            </p>
                                        </div>

                                        <div class="">
                                            {{-- Deleting The Comment --}}
                                            @can('delete', $comment)
                                                <form action="{{ route('comment.destroy', $reply->id) }}" method="POST"
                                                    class=" d-inline-block">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="badge bg-dark mb-3 ">
                                                        <span class=" bi bi-trash3"></span> Delete
                                                    </button>
                                                </form>
                                            @endcan


                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- For Main or First Comment --}}
    @auth
        <div class="">
            <form action="{{ route('comment.store') }}" method="POST">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <textarea placeholder="Say Something about this article..." class=" form-control" name="content" rows="5"></textarea>
                <div class=" my-3 d-flex justify-content-between">
                    <span>Commenting... as {{ Auth::user()->name }}</span>
                    <button class=" btn btn-dark">Comment</button>
                </div>
            </form>
        </div>
    @endauth
</div>

@vite(['resources/js/reply.js'])
