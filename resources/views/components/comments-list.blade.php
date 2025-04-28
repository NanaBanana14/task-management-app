\
<div class="space-y-6">
    @foreach ($comments as $comment)
        <div class="p-4 border rounded-lg bg-gray-50">
            <strong>{{ $comment->user->name ?? 'Unknown' }}</strong>: 
            <p>{!! nl2br(e($comment->comments)) !!}</p>

            {{-- Form Reply --}}
            <form method="POST" action="{{ route('comment.reply', $comment->id) }}" class="mt-3 space-y-2">
                @csrf
                <textarea name="comments" class="w-full border rounded p-2" placeholder="Write a reply..." required></textarea>
                <button type="submit" class="px-4 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">Reply</button>
            </form>

            {{-- Replies --}}
            @if ($comment->replies->isNotEmpty())
                <div class="mt-4 ml-4 border-l-2 pl-4">
                    @foreach ($comment->replies as $reply)
                        <div class="mb-2">
                            <strong>{{ $reply->user->name ?? 'Unknown' }}</strong> replied: 
                            <p>{!! nl2br(e($reply->comments)) !!}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endforeach
</div>
