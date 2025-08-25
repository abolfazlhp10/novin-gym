<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@100;500;700&display=swap" rel="stylesheet">
    <title>برنامه تمرینی</title>
    <style>
        body {
            font-family: 'Vazirmatn', sans-serif;
            font-size: 12px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .title-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .title-section h1 {
            font-weight: 800;
            font-size: 1.6rem;
            text-align: center;
        }

        .logo-link {
            width: 140px;
            height: auto;
        }

        .logo-link img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .header-section {
            margin: 3rem 0;
        }

        .header-section h2 {
            font-size: 1.125rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .info-block {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
        }

        .info-block div {
            font-size: 0.75rem;
        }

        .info-block span {
            font-weight: 500;
            font-size: 0.875rem;
        }

        .description-section {
            text-align: right;
        }

        .description-section h3 {
            font-size: 1.125rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .description-section p {
            font-weight: 500;
            font-size: 0.875rem;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #d1d5db;
            border-radius: 1rem;
            margin-bottom: 2.5rem;
            overflow: hidden;
        }

        .table thead {
            background-color: #5e59ff;
            color: white;
        }

        .table thead th {
            padding: 0.5rem 0.75rem;
            text-align: center;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .table tbody tr {
            border-top: 1px solid #d1d5db;
        }

        .table tbody td {
            padding: 0.5rem 0.75rem;
            text-align: center;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .superset-cell {
            color: #5e59ff;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.25rem;
        }

        .table tbody td:nth-child(7),
        .table thead th:nth-child(7) {
            max-width: 300px;
            word-wrap: break-word;
            word-break: break-word;
            overflow-wrap: break-word;
            white-space: normal;
        }

        .session-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Title -->
        <div class="title-section">
            <h1>برنامه تمرینی</h1>
            <a href="/" class="logo-link">
                <img src="{{ public_path('logo/novingym.png') }}" alt="Logo" />
            </a>
        </div>

        <!-- Header -->
        <div class="header-section">
            <!-- Athlete Info -->
            <div class="info-block">
                <div>نام ورزشکار: <span>{{ $program['user_name'] }}</span></div>
                <div>شماره همراه: <span>{{ $program['phone_number'] }}</span></div>
            </div>

            <!-- Description -->
            @if (!empty($program['description']))
                <div class="description-section">
                    <h3>توضیحات کلی برنامه</h3>
                    <p>{{ $program['description'] }}</p>
                </div>
            @endif
        </div>

        @foreach ($program['meta_data'] as $sessionKey => $session)
            @php
                $sessionNumber = str_replace('session', '', $sessionKey);
            @endphp

            <div class="session-title">جلسه {{ $sessionNumber }}</div>

            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>نام حرکت</th>
                        <th>نوع تمرین</th>
                        <th>ست</th>
                        <th>تکرار</th>
                        <th>استراحت (ثانیه)</th>
                        <th>توضیحات</th>
                        <th>سوپرست</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $exerciseIndex = 1;
                        $supersetData = isset($session['super-sets']) ? $session['super-sets'] : [];
                    @endphp

                    @foreach ($session['exercises'] as $exerciseName => $exercise)
                        @php
                            // Check if this exercise is part of a superset
                            $supersetInfo = '';
                            foreach ($supersetData as $supersetIndex => $superset) {
                                if (in_array($exerciseIndex, $superset)) {
                                    $supersetInfo =
                                        'با حرکت ' .
                                        implode(
                                            ' و ',
                                            array_filter($superset, function ($item) use ($exerciseIndex) {
                                                return $item != $exerciseIndex;
                                            }),
                                        );
                                    break;
                                }
                            }
                        @endphp

                        <tr>
                            <td>{{ $exerciseIndex }}</td>
                            <td>{{ $exerciseName }}</td>
                            <td>{{ $exercise['type'] ?? '-' }}</td>
                            <td>{{ $exercise['sets'] ?? '-' }}</td>
                            <td>{{ $exercise['reps'] ?? '-' }}</td>
                            <td>{{ $exercise['rest'] ?? '-' }}</td>
                            <td>{{ $exercise['desc'] ?? '-' }}</td>
                            <td class="superset-cell">
                                @if (!empty($supersetInfo))
                                    {{ $supersetInfo }}
                                @else
                                    -
                                @endif
                            </td>
                        </tr>

                        @php $exerciseIndex++; @endphp
                    @endforeach
                </tbody>
            </table>
            <br>
        @endforeach
    </div>
</body>

</html>
