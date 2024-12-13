@extends('layouts.admin')

@section('title', 'Dokter Dashboard')

@section('content')
<main>
    <div class="grid grid-cols-1 gap-4 px-4 mt-8 sm:grid-cols-4 sm:px-8">

        <!-- Welcome Section -->
        <div class="content mb-8 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div class="text-white">
                    <h1 class="text-3xl font-bold">Selamat Datang, Admin!</h1>
                    <p class="mt-1 text-purple-100">Pantau aktivitas hari ini.</p>
                </div>
                <div class="hidden md:block">
                    <img src="https://images.unsplash.com/photo-1531297484001-80022131f5a1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2560&q=80"
                        alt="Dashboard"
                        class="h-24 w-auto rounded-lg shadow-md transform -rotate-3 transition-transform hover:rotate-0">
                </div>
            </div>
        </div>

        <!-- Members Card -->
        <a href="#" class="dashboard-card group block">
            <div class="bg-white rounded-xl shadow-sm hover:shadow-xl overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="icon-wrapper p-4 bg-gradient-to-r from-green-400 to-green-500 rounded-lg">
                            <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Total Dokter</h3>
                            <p class="mt-1 text-3xl font-semibold text-gray-900">12,768</p>
                            <p class="mt-1 text-sm text-green-600">↑ 12% from last month</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full progress-bar" style="width: 70%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Posts Card -->
        <a href="#" class="dashboard-card group block">
            <div class="bg-white rounded-xl shadow-sm hover:shadow-xl overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="icon-wrapper p-4 bg-gradient-to-r from-blue-400 to-blue-500 rounded-lg">
                            <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Total Pasien</h3>
                            <p class="mt-1 text-3xl font-semibold text-gray-900">39,265</p>
                            <p class="mt-1 text-sm text-blue-600">↑ 8% from last month</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full progress-bar" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Comments Card -->
        <a href="#" class="dashboard-card group block">
            <div class="bg-white rounded-xl shadow-sm hover:shadow-xl overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="icon-wrapper p-4 bg-gradient-to-r from-indigo-400 to-indigo-500 rounded-lg">
                            <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Total Poli</h3>
                            <p class="mt-1 text-3xl font-semibold text-gray-900">142,334</p>
                            <p class="mt-1 text-sm text-indigo-600">↑ 24% from last month</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-indigo-500 h-2 rounded-full progress-bar" style="width: 92%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Server Load Card -->
        <a href="#" class="dashboard-card group block">
            <div class="bg-white rounded-xl shadow-sm hover:shadow-xl overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="icon-wrapper p-4 bg-gradient-to-r from-red-400 to-red-500 rounded-lg">
                            <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Obat</h3>
                            <p class="mt-1 text-3xl font-semibold text-gray-900">34.12%</p>
                            <p class="mt-1 text-sm text-red-600">↓ 5% from last hour</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-red-500 h-2 rounded-full progress-bar" style="width: 34%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </a>

        <!-- Main Content Grid -->
        <!-- Chart Section -->
        <div class="content bg-white rounded-2xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-900">Platform Analytics</h2>
                <div class="flex space-x-2">
                </div>
            </div>
            <div class="h-64 relative" id="analytics-chart">
                <!-- Chart will be initialized here via JavaScript -->
            </div>
        </div>

        <!-- Activity Timeline -->
        <div class="content bg-white rounded-2xl shadow-sm p-6">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h2>
            <div class="relative">
                <div class="activity-line"></div>
                <div class="space-y-6">
                    @foreach([
                    ['time' => '2 min ago', 'title' => 'New user registration', 'desc' => 'John Doe has registered', 'color' => 'bg-green-500'],
                    ['time' => '1 hour ago', 'title' => 'Server update completed', 'desc' => 'Version 2.1.0 deployed', 'color' => 'bg-blue-500'],
                    ['time' => '3 hours ago', 'title' => 'Database backup', 'desc' => 'Backup completed successfully', 'color' => 'bg-purple-500'],
                    ['time' => '1 day ago', 'title' => 'New feature launched', 'desc' => 'User messaging system', 'color' => 'bg-yellow-500']
                    ] as $activity)
                    <div class="relative pl-10">
                        <div class="activity-dot {{ $activity['color'] }}"></div>
                        <div class="flex flex-col">
                            <span class="text-sm text-gray-500">{{ $activity['time'] }}</span>
                            <span class="font-medium text-gray-900">{{ $activity['title'] }}</span>
                            <span class="text-sm text-gray-600">{{ $activity['desc'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Recent Transactions Table -->
        <div class="content recent-table bg-white rounded-2xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Recent Transactions</h2>
                    <a href="#" class="text-sm text-indigo-600 hover:text-indigo-700 font-medium">View All</a>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left bg-gray-50">
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach([
                        ['id' => '#TR-123', 'amount' => '$1,200', 'status' => 'Completed', 'status_color' => 'green', 'date' => '2024-03-15'],
                        ['id' => '#TR-124', 'amount' => '$850', 'status' => 'Pending', 'status_color' => 'yellow', 'date' => '2024-03-14'],
                        ['id' => '#TR-125', 'amount' => '$2,000', 'status' => 'Failed', 'status_color' => 'red', 'date' => '2024-03-14'],
                        ['id' => '#TR-126', 'amount' => '$1,500', 'status' => 'Completed', 'status_color' => 'green', 'date' => '2024-03-13']
                        ] as $transaction)
                        <tr class="table-row">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $transaction['id'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $transaction['amount'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $transaction['status_color'] }}-100 text-{{ $transaction['status_color'] }}-800">
                                    {{ $transaction['status'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $transaction['date'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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


        // Animate progress bars
        const progressBars = document.querySelectorAll('.progress-bar');
        progressBars.forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0';
            setTimeout(() => {
                bar.style.width = width;
            }, 300);
        });

        // Initialize Chart
        const ctx = document.getElementById('analytics-chart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'User Growth',
                    data: [65, 59, 80, 81, 56, 85],
                    borderColor: 'rgb(99, 102, 241)',
                    tension: 0.4,
                    fill: true,
                    backgroundColor: 'rgba(99, 102, 241, 0.1)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
@endsection