@extends('dashboard.layout')

@section('content')
    
<x-web.blog.post.Show :post='$post' />

@endsection