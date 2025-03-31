<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\StudentApplianceStatus;
use App\Models\TuitionInvoice;
use App\Models\TuitionInvoiceDetail;
use App\Models\User;
use App\Models\UserAccessInformation;

class TuitionController extends Controller
{
    public function show(int $student_id)
    {
        $limitedAcademicYear = false;
        $academicYears = [];
        if (auth()->user()->hasRole('Super Admin')) {

        } elseif ((auth()->user()->hasRole('Principal') or auth()->user()->hasRole('Financial Manager')) and !auth()->user()->hasRole('Super Admin')) {
            $myAllAccesses = UserAccessInformation::whereUserId(auth()->user()->id)->first();
            $filteredArray = $this->getFilteredAccessesPF($myAllAccesses);

            // Finding academic years with status 1 in the specified schools
            $academicYears = AcademicYear::whereIn('school_id', $filteredArray)->get();
            $limitedAcademicYear = true;
        } else {
            return response()->json(['message' => 'Access Denied!'], 403);
        }

        $student = User::where('status', 1)->find($student_id);
        if (empty($student)) {
            return response()->json(['message' => 'Student not found'], 404);
        }
        $studentApplianceStatus = StudentApplianceStatus::where('student_id', $student_id)
            ->when($limitedAcademicYear, function ($query) use ($academicYears) {
                return $query->whereIn('academic_year', $academicYears->pluck('id')->toArray());
            })
            ->where('approval_status', 1)
            ->get();
        if ($studentApplianceStatus->isEmpty()) {
            return response()->json(['message' => 'Student appliance not found'], 404);
        }

        $applianceStatusIds = $studentApplianceStatus->pluck('id')->toArray();

        $tuitionInvoices = TuitionInvoice::whereIn('appliance_id', $applianceStatusIds)->get()->pluck('id')->toArray();

        $tuitionInvoiceDetails = TuitionInvoiceDetail::whereIn('tuition_invoice_id', $tuitionInvoices)
            ->where('is_paid', 0)
            ->get();

        return response()->json(data: [
            'student_info' => [
                'first_name' => $student->generalInformation->first_name_en,
                'last_name' => $student->generalInformation->last_name_en,
            ],
            'guardian_info' => [
                'first_name' => $student->studentInfo->guardianInfo->generalInformation->first_name_en,
                'last_name' => $student->studentInfo->guardianInfo->generalInformation->last_name_en,
            ],
            'invoices' => $tuitionInvoiceDetails
        ]);
    }
}
