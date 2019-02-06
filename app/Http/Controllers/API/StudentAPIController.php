<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateStudentAPIRequest;
use App\Http\Requests\API\UpdateStudentAPIRequest;
use App\Models\Student;
use App\Models\UserRole;
use App\Repositories\StudentRepository;
use Illuminate\Http\Request;
use Response;

/**
 * Class StudentController
 * @package App\Http\Controllers\API
 */

class StudentAPIController extends AppBaseController
{
    /** @var  StudentRepository */
    private $studentRepository;

    private $userRole;

    public function __construct(StudentRepository $studentRepo, UserRole $userRole)
    {
        $this->studentRepository = $studentRepo;
        $this->userRole = $userRole;
    }

    /**
     * Display a listing of the Student.
     * GET|HEAD /students
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        // $this->studentRepository->pushCriteria(new RequestCriteria($request));
        // $this->studentRepository->pushCriteria(new LimitOffsetCriteria($request));
        // $students = $this->studentRepository->all();
        $data = $this->userRole->where('role_id', 3)->get();
        $data->load('user');

        $students = [];
        foreach ($data as $item) {
            $user = $item->user->toArray();
            array_push($students, $user);
        }

        return $this->sendResponse($students, 'Students retrieved successfully');
    }

    /**
     * Store a newly created Student in storage.
     * POST /students
     *
     * @param CreateStudentAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateStudentAPIRequest $request)
    {
        $input = $request->all();

        //$students = $this->studentRepository->create($input);

        return $this->sendResponse([], 'Student saved successfully');
    }

    /**
     * Display the specified Student.
     * GET|HEAD /students/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Student $student */
        $student = $this->studentRepository->with(['basicInformations', 'file'])->findWhere(['student_id' => $id])->first();

        if (empty($student)) {
            return $this->sendError('Student not found');
        }

        $files = $student->file;
        if (!empty($files)) {
            foreach ($files as $file) {
                $file->load('sequence');
            }
        }

        return $this->sendResponse($student->toArray(), 'Student retrieved successfully');
    }

    /**
     * Update the specified Student in storage.
     * PUT/PATCH /students/{id}
     *
     * @param  int $id
     * @param UpdateStudentAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStudentAPIRequest $request)
    {
        $input = $request->all();

        /** @var Student $student */
        $student = $this->studentRepository->findWithoutFail($id);

        if (empty($student)) {
            return $this->sendError('Student not found');
        }

        //$student = $this->studentRepository->update($input, $id);

        return $this->sendResponse($student->toArray(), 'Student updated successfully');
    }

    /**
     * Remove the specified Student from storage.
     * DELETE /students/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Student $student */
        $student = $this->studentRepository->findWithoutFail($id);

        if (empty($student)) {
            return $this->sendError('Student not found');
        }

        //$student->delete();

        return $this->sendResponse($id, 'Student deleted successfully');
    }
}
