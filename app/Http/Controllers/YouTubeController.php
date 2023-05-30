<?php

namespace App\Http\Controllers;

use App\Services\YouTubeDownloaderService;
use Illuminate\Http\Request;
use YouTube\YouTubeStreamer;

class YouTubeController extends Controller
{

    private $youTubeDownloaderService;

    public function __construct(YouTubeDownloaderService $youTubeDownloaderService, YouTubeStreamer $youTubeStreamer)
    {
        $this->youTubeDownloaderService = $youTubeDownloaderService;
        $this->youTubeStreamer          = $youTubeStreamer;
    }

    public function index() 
    {
        return view('youtube.index');
    }

    public function download(Request $request) 
    {
        $downloadOptions = $this->youTubeDownloaderService->getDownloadLinks($request->url);
        $error = '';
        if (!$downloadOptions->getAllFormats()) {
            $error = 'No links found';
        }
        return response()->json([
            'error' => $error,
            'links' => last($downloadOptions->getCombinedFormats())->url ?? '',
        ]);
    }

    public function stream(Request $request) 
    {
        return $this->youTubeStreamer->stream($request->url);
    }
}
