@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4">
    <div class="mb-8">
        <a href="{{ route('blogs.index') }}" class="group inline-flex items-center text-sm font-bold text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
            <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Feed
        </a>
    </div>

    <article class="bg-white dark:bg-gray-800 rounded-3xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all">
        <div class="h-3 w-full bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"></div>
        
        <div class="p-8 md:p-12">
            <header class="mb-8">
                <h1 class="text-3xl md:text-5xl font-black text-gray-900 dark:text-white leading-tight mb-6">
                    {{ $blog->title }}
                </h1>
                
                <div class="flex items-center gap-4 border-b border-gray-50 dark:border-gray-700 pb-8">
                    <div class="h-12 w-12 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                        {{ strtoupper(substr($blog->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-base font-bold text-gray-900 dark:text-white">{{ $blog->user->name }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-widest font-semibold">Published on {{ $blog->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </header>

            <div class="content prose prose-lg dark:prose-invert max-w-none text-gray-800 dark:text-gray-200 leading-relaxed tracking-tight">
                {!! $blog->content !!}
            </div>
        </div>
    </article>

    <section class="mt-12 mb-20">
        <div class="flex items-center gap-3 mb-8">
            <h3 class="text-2xl font-black text-gray-900 dark:text-white">Discussion</h3>
            <span class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-3 py-1 rounded-full text-xs font-bold">
                {{ $blog->comments->count() }}
            </span>
        </div>

        @auth
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-sm mb-10">
            <form id="main-comment-form" data-blog-id="{{ $blog->id }}">
                <textarea name="body" 
                    class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-xl p-4 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all resize-none" 
                    rows="3" placeholder="Share your thoughts..." required></textarea>
                <div class="flex justify-end mt-3">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl font-bold text-sm shadow-lg shadow-blue-500/20 transition-all active:scale-95">
                        Post Comment
                    </button>
                </div>
            </form>
        </div>
        @else
        <div class="bg-blue-50 dark:bg-blue-900/20 rounded-2xl p-6 text-center mb-10 border border-blue-100 dark:border-blue-800">
            <p class="text-blue-700 dark:text-blue-300 font-medium text-sm">Please <a href="/login" class="underline font-bold">login</a> to participate in the conversation.</p>
        </div>
        @endauth

        <div id="comments-list" class="space-y-6">
            @foreach($blog->comments->where('parent_id', null)->sortByDesc('created_at') as $comment)
                @include('comments._comment', ['comment' => $comment])
            @endforeach
        </div>
    </section>
</div>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function() {
        // Master AJAX Function: Main Comment aur Replies dono isi se chalenge
        $(document).on('submit', '#main-comment-form, .ajax-reply-form', function(e) {
            e.preventDefault();

            let $form = $(this);
            let $btn = $form.find('button[type="submit"]');
            let bodyText = $form.find('textarea[name="body"]').val();

            // Parent ID check (agar reply hoga toh ID milegi, warna null)
            let parentId = $form.find('input[name="parent_id"]').val() || null;

            // Main form aur reply form dono par humne data-blog-id lagaya hai
            let blogId = $form.data('blog-id') || $('#main-comment-form').data('blog-id');
            let token = $('meta[name="csrf-token"]').attr('content');

            // Button State Change
            let originalBtnText = $btn.text();
            $btn.text('Posting...').prop('disabled', true).addClass('opacity-50 cursor-not-allowed');

            $.ajax({
                url: `/blog/${blogId}/comments`,
                type: 'POST',
                data: {
                    _token: token,
                    body: bodyText,
                    parent_id: parentId // Backend ko parent_id bhejna zaroori hai
                },
                success: function(response) {
                    if (response.success) {
                        if (parentId) {
                            // Agar Reply hai toh child container mein append karein
                            $form.siblings('.replies-container').prepend(response.html);
                            $form.addClass('hidden'); // Reply form chupa dein
                        } else {
                            // Agar Main Comment hai toh top list mein append karein
                            $('#comments-list').prepend(response.html);
                        }
                        $form.find('textarea').val(''); // Textarea saaf karein
                    }
                },
                error: function() {
                    alert('Something went wrong. Please try again.');
                },
                complete: function() {
                    // Button ko wapas theek karein
                    $btn.text(originalBtnText).prop('disabled', false).removeClass('opacity-50 cursor-not-allowed');
                }
            });
        });
    });
</script>
@endsection