<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class AttendanceReportController extends Controller
{

    public function download(Request $request)
    {

        $students = Student::with([
            'attendanceDetails'
        ])

            ->when(
                $request->classId,
                function ($query) use ($request) {

                    $query->where(
                        'class_id',
                        $request->classId
                    );
                }
            )

            ->get();



        $pdf = Pdf::loadView(
            'pdf.attendance-report',
            [
                'students' => $students,
                'startDate' => $request->startDate,
                'endDate' => $request->endDate,
            ]
        );


        return $pdf->download(
            'rekap-absensi.pdf'
        );
    }
}
