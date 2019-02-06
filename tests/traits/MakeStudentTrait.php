<?php

use Faker\Factory as Faker;
use App\Models\Student;
use App\Repositories\StudentRepository;

trait MakeStudentTrait
{
    /**
     * Create fake instance of Student and save it in database
     *
     * @param array $studentFields
     * @return Student
     */
    public function makeStudent($studentFields = [])
    {
        /** @var StudentRepository $studentRepo */
        $studentRepo = App::make(StudentRepository::class);
        $theme = $this->fakeStudentData($studentFields);
        return $studentRepo->create($theme);
    }

    /**
     * Get fake instance of Student
     *
     * @param array $studentFields
     * @return Student
     */
    public function fakeStudent($studentFields = [])
    {
        return new Student($this->fakeStudentData($studentFields));
    }

    /**
     * Get fake data of Student
     *
     * @param array $postFields
     * @return array
     */
    public function fakeStudentData($studentFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'student_id' => $fake->word,
            'name_TH' => $fake->word,
            'surname_TH' => $fake->word,
            'name_EN' => $fake->word,
            'surname_EN' => $fake->word,
            'year' => $fake->word,
            'email' => $fake->word,
            'email_verified_at' => $fake->date('Y-m-d H:i:s'),
            'password' => $fake->word,
            'remember_token' => $fake->word,
            'user_role_id' => $fake->randomDigitNotNull,
            'field_id' => $fake->randomDigitNotNull,
            'created_at' => $fake->date('Y-m-d H:i:s'),
            'updated_at' => $fake->date('Y-m-d H:i:s'),
            'deleted_at' => $fake->date('Y-m-d H:i:s')
        ], $studentFields);
    }
}
