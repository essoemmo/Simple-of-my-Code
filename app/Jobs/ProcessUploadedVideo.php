<?php

namespace App\Jobs;

use AllowDynamicProperties;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\UploadedFile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

#[AllowDynamicProperties] class ProcessUploadedVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected UploadedFile $file;

    protected string $path;

    protected string $fileName;

    public function __construct(UploadedFile $file, $fileName, $path)
    {
        $this->file = $file;
        $this->path = $path;
        $this->fileName = $fileName;
    }

    public function handle(): void
    {
        $this->file->move($this->path, $this->fileName);
    }
}
