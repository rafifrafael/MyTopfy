<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MyTopfy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <style>
        li {
            list-style-type: none;
        }

        a {
            color: inherit;
            /* changes link color to match the text color */
            text-decoration: none;
            /* removes underline */
        }

        a:hover,
        a:focus {
            color: inherit;
            /* changes hover color to match the text color */
            text-decoration: none;
            /* removes underline on hover/focus */
        }
    </style>
</head>

<body>
    <div class="container mt-6 mb-6">
        <div class="card text-center mx-auto shadow-lg mt-3" style="width: 18rem;">
            <div class="card-body">
                <img class="rounded-circle" width="100" height="100" src="{{ $profileImage }}" />
                <br>
                <h5>{{ $displayName }}</h5>
                <a href="https://open.spotify.com/user/{{ $profileId }}" target="_blank" class="btn btn-success">
                    <i class="fa-brands fa-spotify fa-xl"></i> &nbsp;Profile
                </a>
            </div>
        </div>

        <br><br><br>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-4">
                    <div class="accordion shadow-lg" id="accordionExample1">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#topArtists" aria-expanded="true" aria-controls="collapseOne1">
                                    <i class="fa-solid fa-music"></i>&nbsp;Top Artists &nbsp;
                                </button>
                            </h2>
                            <div id="topArtists" class="accordion-collapse collapse show" aria-labelledby="headingOne1"
                                data-bs-parent="#accordionExample1">
                                <div class="accordion-body">
                                    <ul>
                                        @foreach ($artists as $artist)
                                            <li>
                                                <div class="d-flex align-items-center gap-2">
                                                    <img class="img-fluid"
                                                        style="width: 2rem; height: 2rem; object-fit: cover;"
                                                        src="{{ $artist['images'][0]['url'] }}"
                                                        alt="Image for {{ $artist['name'] }}">
                                                    <a href="http://open.spotify.com/artist/{{ $artist['id'] }}"
                                                        target="_blank"><strong>{{ $artist['name'] }}</strong>
                                                    </a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="accordion shadow-lg" id="accordionExample2">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#topTracks" aria-expanded="true" aria-controls="collapseOne1">
                                    <i class="fa-solid fa-play"></i>&nbsp;Top Tracks &nbsp;
                                </button>
                            </h2>
                            <div id="topTracks" class="accordion-collapse collapse show" aria-labelledby="headingOne1"
                                data-bs-parent="#accordionExample2">
                                <div class="accordion-body">
                                    <ul>
                                        @foreach ($tracks as $track)
                                            <li>
                                                <div class="d-flex align-items-center gap-2">
                                                    <img class="img-fluid"
                                                        style="width: 2rem; height: 2rem; object-fit: cover;"
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
                </div>
                <div class="col-4">
                    <div class="accordion shadow-lg" id="accordionExample3">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#topGenres" aria-expanded="true" aria-controls="collapseOne1">
                                    <i class="fa-solid fa-guitar"></i>&nbsp;Top Genres &nbsp;
                                </button>
                            </h2>
                            <div id="topGenres" class="accordion-collapse collapse show" aria-labelledby="headingOne1"
                                data-bs-parent="#accordionExample3">
                                <div class="accordion-body">
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
        </div>
    </div>

    <br><br><br>

    <script src="https://kit.fontawesome.com/237c69a9d4.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
    </script>
</body>

</html>
