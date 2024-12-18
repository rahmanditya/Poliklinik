@extends('layouts.admin')

@section('title', 'Dokter Dashboard')

@section('content')
<main>
    <!-- Main Dashboard Content -->
    <div class="container mx-auto px-4 py-8">
        <!-- Welcome Section -->
        <div class="content bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 mb-8 text-white">
            <h1 class="text-3xl font-bold mb-2">Welcome to Poliklinik Dashboard</h1>
            <p class="opacity-90">Manage your clinic operations efficiently and effectively</p>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

            <a href="{{ route('admin.pasien.index') }}" class="dashboard-card group block">
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Total Pasien</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $pasiens->count() }}</h3>
                        </div>
                        <div class="bg-blue-100 rounded-full p-3">
                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.dokter.index') }}" class="dashboard-card group block">
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Dokter Aktif</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $dokters->count() }}</h3>
                        </div>
                        <div class="bg-green-100 rounded-full p-3">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.poli.index') }}" class="dashboard-card group block">
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Poli Aktif</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $polis->count() }}</h3>
                        </div>
                        <div class="bg-purple-100 rounded-full p-3">
                            <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.obat.index') }}" class="dashboard-card group block">
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500 hover:shadow-lg transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Stok Obat</p>
                            <h3 class="text-2xl font-bold text-gray-800">{{ $obats->count() }}</h3>
                        </div>
                        <div class="bg-yellow-100 rounded-full p-3">
                            <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Management Cards -->
        <div class="content grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Doctors Management -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-gray-800">Doctors Management</h2>
                        <button onclick="showModal('doctorModal')" class="bg-blue-500 text-white rounded-full p-2 hover:bg-blue-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="space-y-3">
                        <button class="w-full text-left px-4 py-2 bg-gray-50 rounded hover:bg-gray-100 transition-colors flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>View All Doctors</span>
                        </button>
                        <button class="w-full text-left px-4 py-2 bg-gray-50 rounded hover:bg-gray-100 transition-colors flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Manage Schedules</span>
                        </button>
                        <button class="w-full text-left px-4 py-2 bg-gray-50 rounded hover:bg-gray-100 transition-colors flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <span>Performance Reports</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Patients Management -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-gray-800">Patients Management</h2>
                        <button onclick="showModal('patientModal')" class="bg-green-500 text-white rounded-full p-2 hover:bg-green-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="space-y-3">
                        <button class="w-full text-left px-4 py-2 bg-gray-50 rounded hover:bg-gray-100 transition-colors flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span>View All Patients</span>
                        </button>
                        <button onclick="showModal('appointmentModal')" class="w-full text-left px-4 py-2 bg-gray-50 rounded hover:bg-gray-100 transition-colors flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Schedule Appointment</span>
                        </button>
                        <button class="w-full text-left px-4 py-2 bg-gray-50 rounded hover:bg-gray-100 transition-colors flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>Medical Records</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Clinic Management -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-gray-800">Clinic Management</h2>
                        <button onclick="showModal('clinicModal')" class="bg-purple-500 text-white rounded-full p-2 hover:bg-purple-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="space-y-3">
                        <button class="w-full text-left px-4 py-2 bg-gray-50 rounded hover:bg-gray-100 transition-colors flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                            <span>View All Clinics</span>
                        </button>
                        <button class="w-full text-left px-4 py-2 bg-gray-50 rounded hover:bg-gray-100 transition-colors flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span>Operating Hours</span>
                        </button>
                        <button class="w-full text-left px-4 py-2 bg-gray-50 rounded hover:bg-gray-100 transition-colors flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <span>Clinic Statistics</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Medicine Inventory -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-gray-800">Medicine Inventory</h2>
                        <button onclick="showModal('medicineModal')" class="bg-yellow-500 text-white rounded-full p-2 hover:bg-yellow-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="space-y-3">
                        <button class="w-full text-left px-4 py-2 bg-gray-50 rounded hover:bg-gray-100 transition-colors flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                            <span>View Inventory</span>
                        </button>
                        <button class="w-full text-left px-4 py-2 bg-gray-50 rounded hover:bg-gray-100 transition-colors flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            <span>Stock Management</span>
                        </button>
                        <button class="w-full text-left px-4 py-2 bg-gray-50 rounded hover:bg-gray-100 transition-colors flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>Expiry Tracking</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Reports & Analytics -->
            <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-gray-800">Reports & Analytics</h2>
                        <button onclick="showModal('reportsModal')" class="bg-indigo-500 text-white rounded-full p-2 hover:bg-indigo-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="space-y-3">
                        <button class="w-full text-left px-4 py-2 bg-gray-50 rounded hover:bg-gray-100 transition-colors flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                            <span>Financial Reports</span>
                        </button>
                        <button class="w-full text-left px-4 py-2 bg-gray-50 rounded hover:bg-gray-100 transition-colors flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                            </svg>
                            <span>Patient Analytics</span>
                        </button>
                        <button class="w-full text-left px-4 py-2 bg-gray-50 rounded hover:bg-gray-100 transition-colors flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>Custom Reports</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 id="modalTitle" class="text-lg font-medium leading-6 text-gray-900 mb-4"></h3>
                <div id="modalContent"></div>
                <div class="mt-4 flex justify-end space-x-3">
                    <button onclick="hideModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition-colors">
                        Cancel
                    </button>
                    <button id="modalAction" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition-colors">
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* Smooth transitions */
    .transition-all {
        transition: all 0.3s ease-in-out;
    }

    /* Card hover effects */
    .hover\:shadow-lg:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        transform: translateY(-2px);
    }

    /* Button hover animations */
    button {
        transition: all 0.2s ease-in-out;
    }

    button:hover {
        transform: scale(1.05);
    }

    /* Modal animation */
    .modal-enter {
        opacity: 0;
        transform: scale(0.9);
    }

    .modal-enter-active {
        opacity: 1;
        transform: scale(1);
        transition: opacity 300ms, transform 300ms;
    }

    .modal-exit {
        opacity: 1;
        transform: scale(1);
    }

    .modal-exit-active {
        opacity: 0;
        transform: scale(0.9);
        transition: opacity 300ms, transform 300ms;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animate cards on page load
        const cards = document.querySelectorAll('.dashboard-card');
        const contentItems = document.querySelectorAll('.content');

        // Add fade-in animation to cards
        cards.forEach((card, index) => {
            card.style.opacity = '0'; // Ensure it's hidden initially
            setTimeout(() => {
                card.classList.add('animate-fade-in');
            }, index * 100); // Stagger the animation
        });

        // Add fade-in animation to content items
        contentItems.forEach((content, index) => {
            content.style.opacity = '0'; // Ensure it's hidden initially
            setTimeout(() => {
                content.classList.add('animate-fade-in');
            }, index * 100); // Stagger the animation
        });

    });

    // Modal functionality
    function hideModal() {
        const modal = document.getElementById('modal');
        modal.classList.add('hidden');
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('modal');
        if (event.target == modal) {
            hideModal();
        }
    }

    // Extend the showModal function with additional modal types
    function showModal(type) {
        const modal = document.getElementById('modal');
        const modalTitle = document.getElementById('modalTitle');
        const modalContent = document.getElementById('modalContent');
        const modalAction = document.getElementById('modalAction');

        // Configure modal based on type
        switch (type) {
            case 'doctorModal':
                modalTitle.textContent = 'Add New Doctor';
                modalContent.innerHTML = `
                    <form class="space-y-4" method="POST" action="{{ route('admin.dokter.store') }}">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Specialization</label>
                        <select name="specialization_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                            @foreach($specializations as $specialization)
                                <option value="{{ $specialization->id }}">{{ $specialization->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                        <input type="tel" name="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Working Hours</label>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="time" name="start_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <input type="time" name="end_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>
                </form>
                `;
                modalAction.textContent = 'Add Doctor';
                break;

            case 'patientModal':
                modalTitle.textContent = 'Register New Patient';
                modalContent.innerHTML = `
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Date of Birth</label>
                            <input type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Contact Number</label>
                            <input type="tel" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Address</label>
                            <textarea class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" rows="3"></textarea>
                        </div>
                    </form>
                `;
                modalAction.textContent = 'Register Patient';
                break;

            case 'clinicModal':
                modalTitle.textContent = 'Add New Clinic';
                modalContent.innerHTML = `
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Clinic Name</label>
                            <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Specialization</label>
                            <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option>General Medicine</option>
                                <option>Pediatrics</option>
                                <option>Cardiology</option>
                                <option>Dermatology</option>
                                <option>Orthopedics</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Operating Hours</label>
                            <div class="grid grid-cols-2 gap-4">
                                <input type="time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <input type="time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>
                    </form>
                `;
                modalAction.textContent = 'Add Clinic';
                break;

            case 'medicineModal':
                modalTitle.textContent = 'Add New Medicine';
                modalContent.innerHTML = `
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Medicine Name</label>
                            <input type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Category</label>
                            <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option>Antibiotics</option>
                                <option>Painkillers</option>
                                <option>Antiviral</option>
                                <option>Vaccines</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Stock Quantity</label>
                            <input type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Expiry Date</label>
                            <input type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </form>
                `;
                modalAction.textContent = 'Add Medicine';
                break;

            case 'reportsModal':
                modalTitle.textContent = 'Generate Report';
                modalContent.innerHTML = `
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Report Type</label>
                            <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option>Financial Summary</option>
                                <option>Patient Statistics</option>
                                <option>Inventory Status</option>
                                <option>Staff Performance</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Date Range</label>
                            <div class="grid grid-cols-2 gap-4">
                                <input type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <input type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Format</label>
                            <select class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option>PDF</option>
                                <option>Excel</option>
                                <option>CSV</option>
                            </select>
                        </div>
                    </form>
                `;
                modalAction.textContent = 'Generate';
                break;
        }

        modal.classList.remove('hidden');
    }

    // Form validation function
    function validateForm(formData) {
        // Add your validation logic here
        return true;
    }

    // Handle form submission
    document.getElementById('modalAction').addEventListener('click', function() {
        const form = document.querySelector('#modal form');
        if (form) {
            const formData = new FormData(form);
            if (validateForm(formData)) {
                // Handle form submission
                console.log('Form submitted:', Object.fromEntries(formData));
                hideModal();
            }
        }
    });
</script>

@endsection