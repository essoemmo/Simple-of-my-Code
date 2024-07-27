<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateStatusRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    use ResponseTrait;

    public function changeStatus(UpdateStatusRequest $request)
    {
        $request->validated();
        $modelName = ucfirst($request->validated()['model_name']);
        $modelMappings = [
            'User' => 'App\\Models\\Users\\User',
            'Admin' => 'App\\Models\\Users\\Admin',
            'Department' => 'App\\Models\\Departments\\Department',
            'Order' => 'App\\Models\\Web\\Order',
            'Product' => 'App\\Models\\Products\\Product',
            'Course' => 'App\\Models\\Courses\\Course',
            'Chapter' => 'App\\Models\\Courses\\Chapter',
            'Lesson' => 'App\\Models\\Courses\\Lesson',
            'Question' => 'App\\Models\\Questions\\Question',
            'Exam' => 'App\\Models\\Exams\\Exam',
            'Section' => 'App\\Models\\Courses\\Section',
        ];
        if (!isset($modelMappings[$modelName])) {
            return self::failResponse(400, __('application.not_found'));
        }

        $modelClass = $modelMappings[$modelName];

        if (!class_exists($modelClass)) {
            return self::failResponse(400, __('application.not_found'));
        }

        $model = $modelClass::findOrFail($request->validated()['model_id']);
        $model->status = $request->validated()['status'];
        $model->save();

        return self::successResponse(__('application.updated'));

    }
}
