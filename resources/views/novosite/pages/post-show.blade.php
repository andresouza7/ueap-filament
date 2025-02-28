@extends('novosite.template.main')

@section('title', 'Home')

@section('content')
    <main class="bg-neutral-200 dark:bg-gray-900 antialiased">


        <!-- Main Content Container -->
        <div class="p-4 sm:p-16 flex flex-col justify-between mx-auto max-w-4xl">

            <article
                class="pt-8 px-4 sm:px-16 pb-16 lg:pt-16 lg:pb-24 mx-auto w-full bg-white format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <header class="mb-6">
                    <!-- Author Section - Full Width -->
                    <div class="w-full pb-4 mb-4 border-b ">
                        <address class="flex items-center gap-4 max-w-4xl mx-auto">
                            <img class="w-16 h-16 rounded-full border-2 border-blue-500"
                                src="{{ $post->user_created->profile_photo_url }}" alt="Author Profile Photo">
                            <div class="flex flex-col">
                                <a href="#" rel="author"
                                    class="text-xl font-semibold text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">
                                    {{ $post->user_created->nickname }}
                                </a>
                                <span class="text-sm text-gray-600 dark:text-gray-400">
                                    {{ $post->user_created->group->description }}
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-500 italic mt-1">
                                    {{ $post->created_at->format('F j, Y') }}
                                </span>
                            </div>
                        </address>
                    </div>

                    <!-- Post Title -->
                    <h1 class="text-2xl font-extrabold leading-snug text-gray-900 dark:text-white lg:text-4xl">
                        {{ $post->title }}
                    </h1>
                </header>

                <!-- Post Image -->
                @if ($post->image_url)
                    <img class="w-full mb-4 lg:mb-6 rounded-sm shadow-sm" src="{{ $post->image_url }}" alt="Post Image">
                @endif

                <!-- Post Content -->
                <div
                    class="text-justify leading-loose text-neutral-600 first-line:uppercase first-line:tracking-widest first-letter:text-7xl first-letter:font-bold first-letter:text-gray-900 dark:first-letter:text-gray-100 first-letter:me-3 first-letter:float-start">
                    {!! clean_text($post->text) !!}
                </div>
            </article>
        </div>
    </main>


    <aside aria-label="Related articles" class="py-8 lg:py-24 bg-gray-50 dark:bg-gray-800">
        <div class="px-4 mx-auto max-w-screen-xl">
            <h2 class="mb-8 text-2xl font-bold text-gray-900 dark:text-white">Leia Também</h2>
            <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($extra_posts as $post)
                    <article class="max-w-xs">
                        <a href="{{ route('novosite.post.show', $post->slug) }}">
                            <img src="{{ $post->image_url }}" class="mb-5 rounded-lg h-48" alt="{{ $post->title }}">
                        </a>
                        <h2 class="mb-2 text-xl font-semibold leading-tight text-gray-900 dark:text-white">
                            <a href="{{ route('novosite.post.show', $post->slug) }}">{{ $post->title }}</a>
                        </h2>
                        <p class="mb-4 text-gray-500 dark:text-gray-400">{{ $post->created_at }}</p>
                        {{-- <a href="#"
                            class="inline-flex items-center font-medium underline underline-offset-4 text-primary-600 dark:text-primary-500 hover:no-underline">
                            minutes
                        </a> --}}
                    </article>
                @endforeach
            </div>
        </div>
    </aside>

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-md sm:text-center">
                <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl dark:text-white">Sign up
                    for our newsletter</h2>
                <p class="mx-auto mb-8 max-w-2xl text-gray-500 md:mb-12 sm:text-xl dark:text-gray-400">Stay up to date with
                    the roadmap progress, announcements and exclusive discounts feel free to sign up with your email.</p>
                <form action="#">
                    <div class="items-center mx-auto mb-3 space-y-4 max-w-screen-sm sm:flex sm:space-y-0">
                        <div class="relative w-full">
                            <label for="email"
                                class="hidden mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email
                                address</label>
                            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                    <path
                                        d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                    <path
                                        d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                                </svg>
                            </div>
                            <input
                                class="block p-3 pl-9 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 sm:rounded-none sm:rounded-l-lg focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Enter your email" type="email" id="email" required="">
                        </div>
                        <div>
                            <button type="submit"
                                class="py-3 px-5 w-full text-sm font-medium text-center text-white rounded-lg border cursor-pointer bg-primary-700 border-primary-600 sm:rounded-none sm:rounded-r-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Subscribe</button>
                        </div>
                    </div>
                    <div
                        class="mx-auto max-w-screen-sm text-sm text-left text-gray-500 newsletter-form-footer dark:text-gray-300">
                        We care about the protection of your data. <a href="#"
                            class="font-medium text-primary-600 dark:text-primary-500 hover:underline">Read our Privacy
                            Policy</a>.
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
