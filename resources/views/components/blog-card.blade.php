@props(['blog']) 

<div class="blog-item group relative bg-white dark:bg-gray-800 rounded-3xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden flex flex-col h-full">
    
    <div class="h-2 w-full bg-gradient-to-r from-blue-500 to-indigo-600"></div>

    <div class="p-6 flex flex-col flex-grow">
        <div class="flex items-center justify-between mb-4">
            <span class="px-3 py-1 rounded-full bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-[10px] font-bold uppercase tracking-widest">
                Technology
            </span>
            <span class="text-xs text-gray-400 dark:text-gray-500 font-medium">
                {{ $blog->created_at->format('M d, Y') }}
            </span>
        </div>

        <h2 class="text-xl font-extrabold text-gray-900 dark:text-white leading-tight mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
            <a href="{{ route('blogs.show', $blog->id) }}">
                {{ Str::limit($blog->title, 60) }}
            </a>
        </h2>

        <div class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-6 flex-grow line-clamp-3">
            {!! $blog->content !!}
        </div>

        <div class="flex items-center justify-between pt-5 border-t border-gray-50 dark:border-gray-700/50">
            <div class="flex items-center gap-3">
                <div class="h-9 w-9 rounded-xl bg-gradient-to-br from-blue-400 to-indigo-600 flex items-center justify-center text-white shadow-lg shadow-blue-200 dark:shadow-none">
                    <span class="text-sm font-bold">{{ strtoupper(substr($blog->user->name, 0, 1)) }}</span>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-800 dark:text-gray-100 leading-none">{{ $blog->user->name }}</p>
                    <p class="text-[10px] text-gray-400 dark:text-gray-500 mt-1">Author</p>
                </div>
            </div>

            @auth
            @php $hasLiked = $blog->likes->where('user_id', auth()->id())->count() > 0; @endphp
            <button onclick="toggleLike(event, {{ $blog->id }}, this)" 
                class="flex flex-col items-center group/like transition-transform active:scale-125">
                <svg class="w-6 h-6 transition-colors {{ $hasLiked ? 'text-red-500 fill-current' : 'text-gray-300 dark:text-gray-600 group-hover/like:text-red-400' }}" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
                <span class="text-[10px] font-bold mt-0.5 {{ $hasLiked ? 'text-red-500' : 'text-gray-400' }} likes-count">{{ $blog->likes->count() }}</span>
            </button>
            @endauth
        </div>

        @if($blog->tags)
        <div class="mt-4 flex flex-wrap gap-2">
            @foreach(explode(',', $blog->tags) as $t)
                <span class="text-[9px] font-black text-gray-400 dark:text-gray-500 hover:text-blue-500 cursor-pointer transition-colors">
                    #{{ strtoupper(trim($t)) }}
                </span>
            @endforeach
        </div>
        @endif
    </div>

    @auth
    @can('update', $blog)
    <div class="absolute top-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        <a href="{{ route('blogs.edit', $blog->id) }}" class="p-2 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-full shadow-sm text-yellow-500 hover:scale-110 transition-transform border border-gray-100 dark:border-gray-700">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
        </a>
        <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST">
            @csrf @method('DELETE')
            <button type="submit" onclick="return confirm('Delete?')" class="p-2 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm rounded-full shadow-sm text-red-500 hover:scale-110 transition-transform border border-gray-100 dark:border-gray-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </button>
        </form>
    </div>
    @endcan
    @endauth
</div>