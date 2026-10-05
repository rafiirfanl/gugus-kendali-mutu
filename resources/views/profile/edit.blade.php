@extends('layouts.admin.app')

@section('title', 'Profile')

@section('content')
<div class="content" style="padding: 20px 28px;">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="crud-card">
                    <div class="crud-card-header">
                        <h5><i class="fas fa-user"></i> Profile Information</h5>
                    </div>
                    <div class="crud-card-body" style="padding: 24px;">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="crud-card">
                    <div class="crud-card-header">
                        <h5><i class="fas fa-lock"></i> Update Password</h5>
                    </div>
                    <div class="crud-card-body" style="padding: 24px;">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="crud-card">
                    <div class="crud-card-header">
                        <h5><i class="fas fa-trash"></i> Delete Account</h5>
                    </div>
                    <div class="crud-card-body" style="padding: 24px;">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection