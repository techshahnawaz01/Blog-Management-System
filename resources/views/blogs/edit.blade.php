@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-black text-gray-900 dark:text-white tracking-tight">Edit Your <span class="text-blue-600">Story</span></h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1 font-medium text-sm">Refine your thoughts and update your masterpiece.</p>
        </div>
        <a href="{{ route('blogs.show', $blog->id) }}" class="hidden sm:flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
            Preview Post
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-[2.5rem] shadow-xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700 p-8 md:p-12 transition-all duration-300">
        <form action="{{ route('blogs.update', $blog->id) }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <div class="group">
                <label class="block text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] ml-1 mb-2 group-focus-within:text-blue-600 transition-colors">Blog Title</label>
                <input type="text" name="title" value="{{ old('title', $blog->title) }}" 
                    class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-2xl px-6 py-4 text-lg font-bold text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 transition-all placeholder-gray-400" 
                    placeholder="Enter an eye-catching title..." required>
                @error('title') <span class="text-red-500 text-xs mt-2 ml-1 font-bold">{{ $message }}</span> @enderror
            </div>

            <div class="group">
                <label class="block text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] ml-1 mb-2 group-focus-within:text-blue-600 transition-colors">Content Body</label>
                <div class="dark:text-gray-900"> <textarea name="content" rows="12" class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-2xl p-6 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" 
                    placeholder="Share your story details here..." required>{{ old('content', $blog->content) }}</textarea>
                </div>
                @error('content') <span class="text-red-500 text-xs mt-2 ml-1 font-bold">{{ $message }}</span> @enderror
            </div>

            <div class="group">
                <label class="block text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] ml-1 mb-2 group-focus-within:text-blue-600 transition-colors">Tags</label>
                <div class="relative">
                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    </span>
                    <input type="text" name="tags" value="{{ old('tags', $blog->tags) }}" 
                        class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-2xl pl-12 pr-6 py-4 text-sm font-medium text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 transition-all placeholder-gray-400" 
                        placeholder="Laravel, PHP, Tech (separated by commas)">
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-end gap-4 pt-6 border-t border-gray-50 dark:border-gray-700">
                <a href="{{ route('blogs.show', $blog->id) }}" 
                    class="w-full sm:w-auto text-center px-8 py-4 text-sm font-bold text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 rounded-2xl transition-all">
                    Discard Changes
                </a>
                <button type="submit" 
                    class="w-full sm:w-auto px-10 py-4 bg-gray-900 dark:bg-blue-600 text-white font-black text-sm rounded-2xl shadow-xl shadow-blue-500/20 hover:bg-blue-700 active:scale-95 transition-all">
                    Update Masterpiece
                </button>
            </div>
        </form>
    </div>
</div>
@endsection