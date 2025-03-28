@extends('admin.layout')
@section('title', 'Manage Classes')
@section('content')

@section('content')
    <h2>Chapters for {{ $classroom->class_name }}</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Date</th>
                <th>Time</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classroom->chapters as $chapter)
            <tr>
                <td>{{ $chapter->id }}</td>
                <td>{{ $chapter->title }}</td>
                <td>{{ $chapter->date }}</td>
                <td>{{ $chapter->time }}</td>
                <td>{{ $chapter->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
