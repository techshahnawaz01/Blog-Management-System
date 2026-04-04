@extends('layouts.app')

@section('content')
<div class="relative py-12 mb-12 overflow-hidden">
    <div class="absolute top-0 left-1/4 w-64 h-64 bg-blue-100 dark:bg-blue-900/20 rounded-full blur-3xl -z-10 opacity-60"></div>
    <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-indigo-100 dark:bg-indigo-900/20 rounded-full blur-3xl -z-10 opacity-60"></div>

    <div class="max-w-4xl mx-auto text-center px-4">
        <h1 class="text-4xl md:text-5xl font-black text-gray-900 dark:text-white mb-4 tracking-tight">
            Explore the <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-500">Latest Stories</span>
        </h1>
        <p class="text-gray-600 dark:text-gray-400 text-lg max-w-2xl mx-auto leading-relaxed">
            Discover insightful articles, deep dives, and daily updates from our community of expert writers.
        </p>
    </div>
</div>

<div class="sticky top-20 z-30 mb-10 px-2">
    <div class="max-w-6xl mx-auto bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border border-gray-100 dark:border-gray-800 p-4 rounded-3xl shadow-xl shadow-gray-200/50 dark:shadow-none">
        <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
            
            <div class="flex flex-col md:flex-row gap-3 w-full lg:w-auto flex-1">
                <div class="relative group flex-1 md:max-w-xs">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-blue-500 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="text" id="search" value="{{ request('search') }}" placeholder="Search articles..." 
                        class="w-full pl-10 pr-4 py-2.5 bg-gray-50 dark:bg-gray-800/50 border-none rounded-2xl focus:ring-2 focus:ring-blue-500/50 text-sm text-gray-900 dark:text-white transition-all">
                </div>
                
                <div class="flex-1 min-w-0 border-none bg-gray-50 dark:bg-gray-800/50 rounded-2xl p-1.5 flex items-center gap-2 group focus-within:ring-2 focus-within:ring-blue-500/50 transition-all cursor-text" id="tag-wrapper">
                    <div id="tag-container" class="flex flex-wrap gap-1.5 ml-2"></div>
                    <input type="text" id="tag-input" placeholder="Add tags..." 
                        class="outline-none bg-transparent text-sm py-1 px-2 text-gray-900 dark:text-white placeholder-gray-400 w-full">
                </div>
            </div>

            @auth
            <a href="{{ route('blogs.create') }}" class="group flex items-center gap-2 bg-gray-900 dark:bg-blue-600 text-white px-6 py-2.5 rounded-2xl hover:bg-blue-600 dark:hover:bg-blue-700 transition-all duration-300 shadow-lg shadow-blue-500/20 active:scale-95">
                <span class="font-bold text-sm">+ New Post</span>
            </a>
            @endauth
        </div>
    </div>
</div>

<div class="max-w-6xl mx-auto px-4">
    <div id="blog-list" class="grid grid-cols-1 md:grid-cols-2 gap-8">
        @foreach($blogs as $blog)
            <x-blog-card :blog="$blog" /> 
        @endforeach
    </div>

    <div id="infinite-scroll-loader" class="text-center py-12 hidden">
        <div class="relative inline-flex">
            <div class="w-10 h-10 border-4 border-blue-200 dark:border-gray-800 rounded-full"></div>
            <div class="w-10 h-10 border-4 border-blue-600 border-t-transparent rounded-full animate-spin absolute top-0 left-0"></div>
        </div>
        <p class="text-gray-400 dark:text-gray-500 mt-4 text-sm font-medium animate-pulse">Fetching more magic...</p>
    </div>

    <div id="api-error-fallback" class="max-w-md mx-auto text-center py-8 hidden bg-red-50/50 dark:bg-red-900/10 border border-red-100 dark:border-red-900/30 rounded-3xl my-6 backdrop-blur-sm">
        <p class="text-red-600 dark:text-red-400 font-semibold mb-3">Connection Interrupted</p>
        <button onclick="retryLoad()" class="inline-flex items-center gap-2 text-sm bg-white dark:bg-gray-800 text-red-600 dark:text-red-400 px-5 py-2 rounded-xl border border-red-200 dark:border-red-800/50 hover:bg-red-50 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
            Try Again
        </button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    // --- 1. Search & Tag Filter ---
    const searchInput = document.getElementById('search'),
          tagInput = document.getElementById('tag-input'),
          tagContainer = document.getElementById('tag-container'),
          tagWrapper = document.getElementById('tag-wrapper');
          
    let searchTimeout;
    let currentTags = new URLSearchParams(window.location.search).get('tag')?.split(',').filter(t => t !== "") || [];

    if(searchInput) searchInput.addEventListener('input', () => {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(updateURL, 500);
    });

    if(tagWrapper) tagWrapper.addEventListener('click', () => tagInput.focus());

    function renderTags() {
        if(!tagContainer) return;
        tagContainer.innerHTML = currentTags.map((tag, i) => 
            `<span class="bg-blue-100 dark:bg-blue-900/50 text-blue-700 dark:text-blue-300 px-2 py-1 rounded text-sm flex items-center gap-1">
                #${tag} 
                <button onclick="removeTag(${i})" class="text-blue-500 dark:text-blue-400 hover:text-red-500">✕</button>
            </span>`
        ).join('');
    }

    window.removeTag = (i) => { currentTags.splice(i, 1); updateURL(); };

    if(tagInput) {
        tagInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                let val = tagInput.value.trim().toLowerCase();
                if (val && !currentTags.includes(val)) { currentTags.push(val); updateURL(); }
            }
        });
        tagInput.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !tagInput.value && currentTags.length) { 
                currentTags.pop(); 
                updateURL(); 
            }
        });
    }

    function updateURL() {
        let url = new URL(window.location.href);
        // Reset page to 1 when searching/filtering
        url.searchParams.delete('page'); 
        
        searchInput?.value ? url.searchParams.set('search', searchInput.value) : url.searchParams.delete('search');
        currentTags.length ? url.searchParams.set('tag', currentTags.join(',')) : url.searchParams.delete('tag');
        window.location.href = url.toString();
    }
    renderTags();

    // --- 2. Infinite Scroll API ---
    let isLoading = false, 
        nextPageUrl = '{!! $blogs->appends(request()->query())->nextPageUrl() !!}';
    
    const loader = document.getElementById('infinite-scroll-loader'),
          errorFallback = document.getElementById('api-error-fallback'),
          blogList = document.getElementById('blog-list');

    if (nextPageUrl && loader) {
        loader.classList.remove('hidden'); 
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting && !isLoading && nextPageUrl) loadMoreBlogs();
        }, { threshold: 0.1 });
        observer.observe(loader);

        function loadMoreBlogs() {
            isLoading = true;
            loader.classList.remove('hidden');
            errorFallback.classList.add('hidden');

            fetch(nextPageUrl)
                .then(res => { if (!res.ok) throw new Error(); return res.text(); })
                .then(html => {
                    const doc = new DOMParser().parseFromString(html, 'text/html');
                    // Blog items append karein
                    doc.querySelectorAll('.blog-item').forEach(b => blogList.appendChild(b));
                    
                    const nextLink = doc.querySelector('[rel="next"]');
                    if (nextLink) {
                        nextPageUrl = nextLink.href;
                    } else {
                        nextPageUrl = null;
                        loader.classList.add('hidden');
                        observer.disconnect();
                    }
                    isLoading = false;
                })
                .catch(() => {
                    isLoading = false; 
                    loader.classList.add('hidden'); 
                    errorFallback.classList.remove('hidden');
                });
        }
        window.retryLoad = () => nextPageUrl && loadMoreBlogs();
    }

    // --- 3. Like Toggle ---
    window.toggleLike = (event, blogId, btn) => {
        event.preventDefault();
        const $btn = $(btn); 
        const $countSpan = $btn.find('.likes-count');
        const $icon = $btn.find('.like-icon');
        const token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: `/blogs/${blogId}/like`,
            type: 'POST',
            headers: { 'X-CSRF-TOKEN': token, 'Accept': 'application/json' },
            success: function(data) {
                if (data.success) {
                    $countSpan.text(data.likesCount);
                    $btn.attr('class', `flex items-center space-x-1 focus:outline-none transition-colors duration-200 ${data.isLiked ? 'text-red-500' : 'text-gray-500 dark:text-gray-400 hover:text-red-500'}`);
                    $icon.attr('fill', data.isLiked ? 'currentColor' : 'none');
                }
            }
        });
    };
</script>
@endsection