<?php

namespace App\Services;

use App\Models\Training\MandatoryLectureTime;

class TrainingService
{
    public function createLectureTimes(array $data,$mandatoryLecture) :void
    {
        foreach ($data['lectures'] as $lecture) {
            MandatoryLectureTime::create([
                'mandatory_lecture_id' => $mandatoryLecture->id,
                'date' => $lecture['date'],
                'time' => $lecture['time'],
            ]);
        }
    }
}
