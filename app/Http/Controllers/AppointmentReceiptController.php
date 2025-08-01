<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AppointmentReceiptController extends Controller
{
    public function download($appointment)
    {
        $appointment = Appointment::with(['doctor.user', 'patient', 'payment'])->findOrFail($appointment);

        $pdf = Pdf::loadView('livewire.public.appointment.receipt', compact('appointment'));

        return $pdf->download('appointment-receipt.pdf');
    }
}
