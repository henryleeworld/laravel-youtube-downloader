<?php

namespace App\Services;

use YouTube\Models\YouTubeConfigData;
use YouTube\Responses\PlayerApiResponse;
use YouTube\YouTubeDownloader;

class YouTubeDownloaderService extends YouTubeDownloader
{
    protected function getPlayerApiResponse($video_id, YouTubeConfigData $configData)
    {
        $response = $this->client->post("https://www.youtube.com/youtubei/v1/player?key=" . $configData->getApiKey(), json_encode([
            "context" => [
                "client" => [
                    "clientName" => "ANDROID_EMBEDDED_PLAYER",
                    "clientVersion" => "16.20",
                    "hl" => "en"
                ]
            ],
            "videoId" => $video_id,
            "playbackContext" => [
                "contentPlaybackContext" => [
                    "html5Preference" => "HTML5_PREF_WANTS"
                ]
            ],
            "contentCheckOk" => true,
            "racyCheckOk" => true
        ]), [
            'Content-Type' => 'application/json',
            'X-Goog-Visitor-Id' => $configData->getGoogleVisitorId(),
            'X-Youtube-Client-Name' => $configData->getClientName(),
            'X-Youtube-Client-Version' => $configData->getClientVersion()
        ]);

        return new PlayerApiResponse($response);
    }
}
