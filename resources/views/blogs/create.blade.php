@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-black text-gray-900 dark:text-white tracking-tight mb-3">
            Create a New <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-500">Masterpiece</span>
        </h1>
        <p class="text-gray-500 dark:text-gray-400 font-medium text-lg">Share your insights and inspire the community.</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-[2.5rem] shadow-2xl shadow-gray-200/50 dark:shadow-none border border-gray-100 dark:border-gray-700 p-8 md:p-12 transition-all duration-300">
        <form action="{{ route('blogs.store') }}" method="POST" class="space-y-8">
            @csrf

            <div class="group">
                <label class="block text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] ml-1 mb-2 group-focus-within:text-blue-600 transition-colors">
                    Blog Title <span class="text-red-500 ml-1">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title') }}" required
                    class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-2xl px-6 py-4 text-lg font-bold text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 transition-all placeholder-gray-400" 
                    placeholder="Enter an eye-catching title...">
                @error('title') 
                    <span class="text-red-500 text-xs mt-2 ml-1 font-bold flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </span> 
                @enderror
            </div>

            <div class="group">
                <label class="block text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] ml-1 mb-2 group-focus-within:text-blue-600 transition-colors">
                    Blog Content <span class="text-red-500 ml-1">*</span>
                </label>
                <div class="dark:text-gray-900">
                    <textarea name="content" rows="10" 
                        class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-2xl p-6 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all" 
                        placeholder="Start writing your amazing story here...">{{ old('content') }}</textarea>
                </div>
                @error('content') 
                    <span class="text-red-500 text-xs mt-2 ml-1 font-bold flex items-center gap-1">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                        {{ $message }}
                    </span> 
                @enderror
            </div>

            <div class="group">
                <label class="block text-xs font-black text-gray-400 dark:text-gray-500 uppercase tracking-[0.2em] ml-1 mb-2 group-focus-within:text-blue-600 transition-colors">
                    Tags (Optional)
                </label>
                <div class="relative">
                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                    </span>
                    <input type="text" name="tags" value="{{ old('tags') }}" 
                        class="w-full bg-gray-50 dark:bg-gray-900 border-none rounded-2xl pl-12 pr-6 py-4 text-sm font-medium text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 transition-all placeholder-gray-400" 
                        placeholder="e.g. Laravel, PHP, AI (comma separated)">
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-end gap-4 pt-8 border-t border-gray-50 dark:border-gray-700">
                <a href="{{ route('blogs.index') }}" 
                    class="w-full sm:w-auto text-center px-8 py-4 text-sm font-bold text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 rounded-2xl transition-all">
                    Cancel & Back
                </a>
                <button type="submit" 
                    class="w-full sm:w-auto px-10 py-4 bg-gray-900 dark:bg-blue-600 text-white font-black text-sm rounded-2xl shadow-xl shadow-blue-500/20 hover:bg-blue-700 active:scale-95 transition-all">
                    Publish Blog Post
                </button>
            </div>
        </form>
    </div>
</div>
@endsection