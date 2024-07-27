<?php

namespace App\Enums\Users;

enum AdminSectionEnum: int
{
    case admins = 1;
    case roles = 2;
    case users = 3;
    case cities = 4;
    case courses = 5;
    case chapters = 6;
    case lessons = 7;
    case sections = 8;
    case answers = 9;
    case exams = 10;
    case questions = 11;
    case certificates = 12;
    case departments = 13;
    case cooperativeTrainings = 14;
    case nominations = 15;
    case trainingNeeds = 16;
    case trainingPlans = 17;
    case mandatoryLectures = 18;
    case externalTraining = 19;
    case settings = 20;
    case contactus = 21;

    public function label(): string
    {
        return match ($this) {
            self::roles => __('application.roles'),
            self::admins => __('application.admins'),
            self::users => __('application.users'),
            self::cities => __('application.cities'),
            self::courses => __('application.courses'),
            self::chapters => __('application.chapters'),
            self::lessons => __('application.lessons'),
            self::sections => __('application.sections'),
            self::exams => __('application.exams'),
            self::questions => __('application.questions'),
            self::answers => __('application.answers'),
            self::certificates => __('application.certificates'),
            self::departments => __('application.departments'),
            self::cooperativeTrainings => __('application.cooperative-trainings'),
            self::nominations => __('application.nominations'),
            self::trainingNeeds => __('application.training-needs'),
            self::trainingPlans => __('application.training-plans'),
            self::mandatoryLectures => __('application.mandatory-lectures'),
            self::externalTraining => __('application.external-training'),
            self::settings => __('application.settings'),
            self::contactus => __('application.contact-us'),
        };
    }
}
