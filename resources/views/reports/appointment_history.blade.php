<!DOCTYPE html>
<html>
<head>
    <title>Appointment History Report</title>
    <style>
        body { font-family: 'Arial', sans-serif; }
        h1, h3 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Espineli-Paradeza Dental Clinic <span></span></h1>
    <h3>Appointment History Report</h3>
    <table>
        <thead>
            <tr>
                <th>Appointment Number</th>
                <th>Treatment</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Medical History</th>
                <th>Medical Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
            <tr>
                <td>{{$appointment->appointment_number}}</td>
                <td>{{$appointment->treatment_choice}}</td>
                <td>{{ \Carbon\Carbon::parse($appointment->date)->format('F j, Y') }}</td>
                <td>{{$appointment->time_range}}</td>
                <td>{{$appointment->reservation_status}}</td>
                <td>{{$appointment->medical_history}}</td>
                 <td>{{$appointment->description ?? 'N/A'}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>