<!DOCTYPE html>
<html>

<head>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {

            border: 1px solid #333;
            padding: 8px;

        }

        th {

            background: #ddd;

        }
    </style>

</head>


<body>


    <h2 align="center">
        Rekap Absensi Siswa
    </h2>


    <p>
        Periode :
        {{ $startDate }}
        s/d
        {{ $endDate }}
    </p>



    <table>


        <thead>

            <tr>

                <th>NIS</th>

                <th>Nama</th>

                <th>Hadir</th>

                <th>Izin</th>

                <th>Sakit</th>

                <th>Alfa</th>

            </tr>


        </thead>


        <tbody>


            @foreach ($students as $student)
                <tr>


                    <td>
                        {{ $student->nis }}
                    </td>


                    <td>
                        {{ $student->name }}
                    </td>


                    <td>
                        {{ $student->attendanceDetails->where('status', 'Hadir')->count() }}
                    </td>


                    <td>
                        {{ $student->attendanceDetails->where('status', 'Izin')->count() }}
                    </td>


                    <td>
                        {{ $student->attendanceDetails->where('status', 'Sakit')->count() }}
                    </td>


                    <td>
                        {{ $student->attendanceDetails->where('status', 'Alfa')->count() }}
                    </td>


                </tr>
            @endforeach


        </tbody>


    </table>


</body>

</html>
