<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>MyTopfy</title>
</head>

<body class=" bg-gray-200">
    <div class="flex flex-col justify-center items-center mt-6 mb-6 space-y-6">

        <div
            class="flex flex-col items-center justify-center w-full max-w-sm mt-4 bg-white text-white p-4 rounded-lg shadow dark:bg-blue-700">
            <img class="w-24 h-24 mb-3 rounded-full shadow-lg mt-3" src="{{ $profileImage }}" alt="Bonnie image" />
            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $displayName }}</h5>
            <div class="flex mt-4 space-x-3 md:mt-6">
                <a href="https://open.spotify.com/user/{{ $profileId }}" target="_blank"
                class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    <i class="fa-brands fa-spotify fa-xl"></i> &nbsp;Profile</a>
            </div>
        </div>

        <div class="flex justify-center space-x-6 w-full items-start">
            <!-- Top Artists -->
            <div
                class="flex flex-col justify-center w-full max-w-sm p-4 rounded-lg shadow bg-red-400">
                <div id="accordion-open" data-accordion="open">
                    <h2 id="accordion-open-heading-1">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 font-medium text-left rounded-t-xl dark:text-gray-400 hover:bg-gray-100"
                            data-accordion-target="#topArtists" aria-expanded="true"
                            aria-controls="accordion-open-body-1">
                            <span class="flex items-center">
                                <i class="fa-solid fa-music"></i>&nbsp;Top Artists &nbsp;
                            </span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="topArtists" class="hidden">
                        <div class="p-5 border border-b-0">
                            <ul>
                                @foreach ($artists as $artist)
                                    <li>
                                        <div class="flex items-center space-x-2">
                                            <img class="w-5 h-5 object-cover" src="{{ $artist['images'][0]['url'] }}"
                                                alt="Image for {{ $artist['name'] }}">
                                            <a href="http://open.spotify.com/artist/{{ $artist['id'] }}"
                                                target="_blank"><strong>{{ $artist['name'] }}</strong></a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Top Tracks -->
            <div
                class="flex flex-col justify-center w-full max-w-sm p-4 rounded-lg shadow bg-green-400">
                <div id="accordion-open" data-accordion="open">
                    <h2 id="accordion-open-heading-1">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 font-medium text-left rounded-t-xl hover:bg-gray-100 dark:hover:bg-gray-800"
                            data-accordion-target="#topTracks" aria-expanded="true"
                            aria-controls="accordion-open-body-1">
                            <span class="flex items-center">
                                <i class="fa-solid fa-play"></i>&nbsp;Top Tracks &nbsp;
                            </span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="topTracks" class="hidden">
                        <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                            <ul>
                                @foreach ($tracks as $track)
                                    <li>
                                        <div class="flex items-center space-x-2">
                                            <img class="w-5 h-5 object-cover"
                                                src="{{ $track['album']['images'][0]['url'] }}"
                                                alt="Album cover for {{ $track['name'] }}">
                                            <div>
                                                <a href="http://open.spotify.com/track/{{ $track['id'] }}"
                                                    target="_blank">
                                                    <strong>{{ $track['name'] }}</strong> by
                                                    @foreach ($track['artists'] as $artist)
                                                        {{ $artist['name'] }}
                                                    @endforeach
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Genres -->
            <div
                class="flex flex-col justify-center w-full max-w-sm p-4 rounded-lg shadow bg-blue-400">
                <div id="accordion-open" data-accordion="open">
                    <h2 id="accordion-open-heading-1">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 font-medium text-left rounded-t-xl  hover:bg-gray-100 dark:hover:bg-gray-800"
                            data-accordion-target="#topGenres" aria-expanded="true"
                            aria-controls="accordion-open-body-1">
                            <span class="flex items-center">
                                <i class="fa-solid fa-guitar"></i>&nbsp;Top Genres &nbsp;
                            </span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="topGenres" class="hidden">
                        <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                            <ul>
                                @foreach ($genres as $genre)
                                    <li><strong>{{ $genre }}</strong></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/237c69a9d4.js" crossorigin="anonymous"></script>
</body>

</html>
