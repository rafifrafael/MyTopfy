<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SpotifyController extends Controller
{
    private $client_id = '65671885b2334ba3bf7dcab4a61e0905';
    private $client_secret = 'a442da16388a4aa3b369edef9e2381cf';
    private $redirect_uri = 'https://mytopfy.vercel.app/callback'; // Adjust as necessary

    public function redirect()
    {
        $scopes = 'user-read-private user-read-email user-top-read'; // Add required scopes here
        $authorizeUrl = 'https://accounts.spotify.com/authorize';
        $parameters = [
            'response_type' => 'code',
            'client_id' => $this->client_id,
            'scope' => $scopes,
            'redirect_uri' => $this->redirect_uri,
        ];

        return redirect()->away($authorizeUrl . '?' . http_build_query($parameters));
    }

    public function getSpotifyData(Request $request)
    {
        $token = $request->session()->get('spotify_token');

        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('https://api.spotify.com/v1/me'); // Gets user profile data

        if ($response->successful()) {
            return $response->json();
        }

        return response()->json(['message' => 'Failed to get data'], 400);
    }

    public function callback(Request $request)
    {
        $code = $request->get('code');

        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode($this->client_id . ':' . $this->client_secret)
        ])->asForm()->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $this->redirect_uri,
        ]);

        if ($response->successful()) {
            // Save both the access token and the refresh token in the session
            $request->session()->put('spotify_token', $response->json()['access_token']);
            $request->session()->put('spotify_refresh_token', $response->json()['refresh_token']);
            return redirect('/me'); // Redirect to your home page or wherever you'd like
        }

        return response()->json(['message' => 'Failed to get token'], 400);
    }

    public function myTop(Request $request)
    {
        $token = $request->session()->get('spotify_token');

        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $profileResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('https://api.spotify.com/v1/me');

        if ($profileResponse->successful()) {
            $profileData = $profileResponse->json();

            $displayName = $profileData['display_name'];
            $profileId = $profileData['id'];
            $profileImage = $profileData['images'][0]['url'] ?? null; // Set a default value in case the user doesn't have a profile picture
        }

        $artists = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('https://api.spotify.com/v1/me/top/artists');

        $genres = [];
        if ($artists->successful()) {
            $artist = $artists->json()['items'];
            foreach ($artist as $artist) {
                foreach ($artist['genres'] as $genre) {
                    if (!in_array($genre, $genres)) {
                        $genres[] = $genre;
                    }
                }
            }
        }


        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('https://api.spotify.com/v1/me/top/tracks');

        if ($response->status() === 401) {
            // The access token has expired, use the refresh token to get a new one
            $refreshToken = $request->session()->get('spotify_refresh_token');
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . base64_encode($this->client_id . ':' . $this->client_secret),
            ])->asForm()->post('https://accounts.spotify.com/api/token', [
                'grant_type' => 'refresh_token',
                'refresh_token' => $refreshToken,
            ]);

            if ($response->successful()) {
                // Save the new access token in the session and retry the request
                $request->session()->put('spotify_token', $response->json()['access_token']);
                return $this->getTopTracks($request);
            }

            return response()->json(['message' => 'Failed to refresh token'], 400);
        }

        if ($response->successful()) {
            return view('me', [
                'tracks' => $response->json()['items'],
                'artists' => $artists->json()['items'],
                'displayName' => $displayName,
                'profileImage' => $profileImage,
                'profileId' => $profileId,
                'genres' => $genres,
            ]);
        }

        return response()->json(['message' => 'Failed to get data'], 400);
    }
}
