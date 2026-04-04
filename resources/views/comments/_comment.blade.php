<div class="comment-item group">
    <div class="flex gap-4 p-4 rounded-2xl transition-colors hover:bg-gray-50 dark:hover:bg-gray-800/50">
        <div class="flex-shrink-0">
            <div class="h-10 w-10 rounded-xl bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-gray-500 dark:text-gray-300 font-bold text-sm border border-gray-200 dark:border-gray-600">
                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
            </div>
        </div>

        <div class="flex-grow">
            <div class="flex items-center gap-2 mb-1">
                <span class="font-bold text-gray-900 dark:text-white text-sm">{{ $comment->user->name }}</span>
                <span class="text-[10px] text-gray-400 uppercase font-bold tracking-tighter">{{ $comment->created_at->diffForHumans() }}</span>
            </div>
            
            <p class="text-gray-700 dark:text-gray-300 text-sm leading-relaxed mb-3">
                {{ $comment->body }}
            </p>
            
            @auth
                <button onclick="$('#reply-form-{{ $comment->id }}').toggleClass('hidden')" 
                    class="inline-flex items-center gap-1.5 text-blue-600 dark:text-blue-400 text-xs font-bold hover:bg-blue-50 dark:hover:bg-blue-900/30 px-2.5 py-1 rounded-lg transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                    Reply
                </button>
                
                <form id="reply-form-{{ $comment->id }}" data-blog-id="{{ $comment->blog_id }}" class="ajax-reply-form hidden mt-4">
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    <div class="flex gap-2">
                        <textarea name="body" 
                            class="w-full bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl p-3 text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all resize-none" 
                            placeholder="Write a reply..." required rows="2"></textarea>
                        <button type="submit" class="self-end bg-gray-900 dark:bg-blue-600 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-blue-700 transition-all shadow-sm">
                            Submit
                        </button>
                    </div>
                </form>
            @endauth

            <div class="replies-container mt-4 space-y-4 border-l-2 border-gray-100 dark:border-gray-700 ml-2 pl-6">
                @if($comment->replies && $comment->replies->count() > 0)
                    @foreach($comment->replies->sortByDesc('created_at') as $reply)
                        @include('comments._comment', ['comment' => $reply])
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>