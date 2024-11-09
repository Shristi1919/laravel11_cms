@extends("frontend.layouts.app")

@section("title")
    {{ app_name() }}
@endsection

@section("content")
    <section class="bg-white dark:bg-gray-800">
        <div class="mx-auto max-w-screen-xl px-4 py-24 text-center sm:px-12">
            <div class="m-6 flex justify-center">
                <img class="h-24 rounded" src="{{ asset("img/cms.jpg") }}" alt="{{ app_name() }}" />
            </div>
            <h1
                class="mb-6 text-4xl font-extrabold leading-none tracking-tight text-gray-900 dark:text-white sm:text-6xl"
            >
                {{ app_name() }}
            </h1>
            <p class="mb-10 text-lg font-normal text-gray-500 dark:text-gray-400 sm:px-16 sm:text-2xl xl:px-48">
                {!! setting("app_description") !!}
            </p>
            <div class="mb-8 flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-x-4 sm:space-y-0 lg:mb-16">

            </div>

            @include("frontend.includes.messages")
        </div>
    </section>


@endsection
