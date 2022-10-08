@extends('backend.layouts.app')
@section('title','Dashboard')
@section('content')
<x-alert/>
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Hello {{auth()->user()->name}}, Welcome back!!</h4>
            </div>
        </div>
    </div>
</section>
@endsection
