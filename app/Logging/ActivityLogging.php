<?php

namespace App\Logging;

use Illuminate\Support\Facades\File;
use ZipArchive;

class ActivityLogging
{
    protected string $filePath;

    public function __construct()
    {
        $this->filePath = storage_path('logs/activity_log.json');
    }

    public function log($type, $description = null): void
    {
        $user =  'guest';
        $logEntry = [
            'timestamp' => now()->toDateTimeString(),
            'user_agent' => request()->userAgent(),
            'ip_address' => request()->ip(),
            'request_headers' => json_encode(request()->header()),
            'request_body' => json_encode(request()->all()),
            'user_id' => $user,
            'activity_type' => $type,
            'description' => $description,
            'model' => get_class($this),
        ];

        $this->writeLog($logEntry);

        // Check if we need to compress the previous year's logs
        //$this->compressYearlyLogs();
    }

    protected function writeLog($logEntry): void
    {
        $date = now();
        $monthFolder = $date->format('Y-m');
        $dayFile = $date->format('Y-m-d') . '.log';
        $filePath = storage_path("logs/activity/{$monthFolder}/{$dayFile}");

        if (!File::exists(dirname($filePath))) {
            File::makeDirectory(dirname($filePath), 0755, true);
        }

        $logEntryString = $this->formatLogEntry($logEntry);

        File::append($filePath, $logEntryString . PHP_EOL);

        // Move logs to the yearly folder if necessary
        $this->moveToYearlyFolder($date);
    }

    protected function formatLogEntry($logEntry): string
    {
        return sprintf(
            "[%s] user_id:%s ip_address:%s user_agent:%s headers:%s body:%s activity:%s description:%s",
            $logEntry['timestamp'],
            $logEntry['user_id'] ?? 'N/A',
            $logEntry['ip_address'] ?? 'N/A',
            $logEntry['user_agent'] ?? 'N/A',
            $logEntry['request_headers'] ?? 'N/A',
            $logEntry['request_body'] ?? 'N/A',
            $logEntry['activity_type'] ?? 'N/A',
            $logEntry['description'] ?? 'N/A',
        );
    }


    protected function moveToYearlyFolder($date): void
    {
        $currentYear = $date->format('Y');
        $currentMonth = $date->format('m');
        $yearFolder = storage_path("logs/activity/{$currentYear}");

        // Check if the current month is December (month 12)
        if ($currentMonth == 12) {
            $currentMonthFolder = storage_path("logs/activity/{$currentYear}/{$currentYear}-{$currentMonth}");
            $newYearFolder = storage_path("logs/activity/{$currentYear}");

            if (File::exists($currentMonthFolder) && !File::exists($newYearFolder)) {
                File::move($currentMonthFolder, $newYearFolder);
            }
        }
    }

    public function getLogs($date = null): array
    {
        $date = $date ?? now()->format('Y-m-d');
        $monthFolder = substr($date, 0, 7);
        $dayFile = "{$date}.log";
        $filePath = storage_path("logs/activity/{$monthFolder}/{$dayFile}");

        if (File::exists($filePath)) {
            $fileContent = File::get($filePath);
            $logLines = explode(PHP_EOL, $fileContent);

            return array_map(function ($line) {
                return json_decode($line, true);
            }, array_filter($logLines));
        }

        return [];
    }

    protected function compressYearlyLogs(): void
    {
        $currentYear = now()->format('Y');
        $yearFolder = storage_path("logs/activity/{$currentYear}");

        // Check if the year folder exists and is not empty
        if (File::exists($yearFolder) && File::isDirectory($yearFolder)) {
            $zipFileName = storage_path("logs/activity/{$currentYear}.zip");

            // Create a new zip archive
            $zip = new ZipArchive();
            if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
                // Add all files in the year folder to the zip archive
                $files = File::allFiles($yearFolder);
                foreach ($files as $file) {
                    $zip->addFile($file->getPathname(), $file->getRelativePathname());
                }
                $zip->close();

                // Optionally, delete the original year folder after compression
                File::deleteDirectory($yearFolder);
            }
        }
    }

}
