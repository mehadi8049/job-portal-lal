<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>CV</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
            line-height: 1.5;
        }
        .heading {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .section-title {
            font-size: 18px;
            margin-top: 20px;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .border-box {
            padding: 10px;
            border: 1px solid #333;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="heading">{{ $data['name'] }}</div>
<p>Email: {{ $data['email'] }}</p>
<p>Phone: {{ $data['phone'] }}</p>

<div class="section-title">Skills</div>
<ul>
    @foreach ($data['skills'] as $skill)
        <li>{{ $skill }}</li>
    @endforeach
</ul>

<div class="section-title">Experience</div>
@foreach ($data['experience'] as $exp)
    <div class="border-box">
        <strong>{{ $exp['company'] }}</strong><br>
        Role: {{ $exp['role'] }}<br>
        Years: {{ $exp['years'] }}
    </div>
@endforeach

</body>
</html>
