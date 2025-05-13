@extends('admin.layout')

@section('title', 'Appointments | Admin Panel')

@section('content')
<main class="main-content">
    <!-- Header -->
    <div class="welcome-card">
        <h1>Appointments</h1>
        <p class="text-muted">Manage patient appointments and track their status</p>
    </div>

    <!-- Summary Cards -->
    <div class="dashboard-cards">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Total</h3>
                <div class="card-icon"><i class="fas fa-calendar"></i></div>
            </div>
            <div class="card-content">
               
                <div class="card-label">All Appointments</div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Confirmed</h3>
                <div class="card-icon"><i class="fas fa-check-circle"></i></div>
            </div>
            <div class="card-content">
               
                <div class="card-label">Confirmed Appointments</div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cancelled</h3>
                <div class="card-icon"><i class="fas fa-times-circle"></i></div>
            </div>
            <div class="card-content">
          
                <div class="card-label">Cancelled Appointments</div>
            </div>
        </div>
    </div>

    <!-- Appointment List -->
    <div class="appointments-list">
        
    </div>
</main>
@endsection
