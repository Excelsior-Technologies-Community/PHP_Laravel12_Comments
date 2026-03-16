<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Comments</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom scrollbar for comment section */
        .comments-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .comments-scroll::-webkit-scrollbar-thumb {
            background-color: #9ca3af;
            border-radius: 3px;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-gray-100 font-sans">

    <div class="max-w-4xl mx-auto p-6">

        <!-- Page Header -->
        <header class="mb-8 text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold text-blue-700 dark:text-blue-500">Comments & Discussions</h1>
            <p class="mt-2 text-gray-500 dark:text-gray-400">Share your thoughts and reply to others.</p>
        </header>

        <!-- Success Message -->
        @if(session('success'))
        <div class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 p-4 rounded-md mb-6 shadow-md">
            {{ session('success') }}
        </div>
        @endif

        <!-- Comment Form -->
        <section class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-100">Post a Comment</h2>
            <form action="{{ route('comment.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="name" placeholder="Your Name" class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                <textarea name="comment" placeholder="Write your comment..." rows="4" class="w-full p-3 rounded-lg border border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                <input type="hidden" name="parent_id" value="">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-medium transition duration-200">Post Comment</button>
            </form>
        </section>

        <!-- Comments List -->
        <section class="comments-scroll space-y-6 max-h-[70vh] overflow-y-auto">
            @foreach($comments as $comment)
            <div class="bg-gray-50 dark:bg-gray-800 shadow-sm rounded-lg p-5 space-y-3 border border-gray-200 dark:border-gray-700">
                <!-- Comment Content -->
                <div>
                    <p class="font-semibold text-gray-800 dark:text-gray-100">{{ $comment->name }}</p>
                    <p class="text-gray-700 dark:text-gray-300">{{ $comment->comment }}</p>
                </div>

                <!-- Reply Form -->
                <form action="{{ route('comment.store') }}" method="POST" class="mt-3 space-y-2 bg-gray-100 dark:bg-gray-900 p-3 rounded-lg">
                    @csrf
                    <input type="text" name="name" placeholder="Your Name" class="w-full p-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 focus:ring-1 focus:ring-blue-500 focus:outline-none">
                    <input type="text" name="comment" placeholder="Reply..." class="w-full p-2 rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 focus:ring-1 focus:ring-blue-500 focus:outline-none">
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                    <button type="submit" class="bg-gray-700 hover:bg-gray-800 dark:bg-gray-600 dark:hover:bg-gray-500 text-white px-4 py-2 rounded-md text-sm transition duration-200">Reply</button>
                </form>

                <!-- Nested Replies -->
                @foreach($comment->replies as $reply)
                <div class="ml-8 mt-4 bg-gray-100 dark:bg-gray-900 rounded-lg p-4 border-l-4 border-blue-500">
                    <p class="font-semibold text-gray-800 dark:text-gray-100">{{ $reply->name }}</p>
                    <p class="text-gray-700 dark:text-gray-300">{{ $reply->comment }}</p>
                </div>
                @endforeach
            </div>
            @endforeach
        </section>

    </div>

</body>

</html>