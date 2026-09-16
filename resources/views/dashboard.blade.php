<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - {{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/sass/dashboard.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <h1>System Dashboard</h1>
            <p>Real-time overview of NASA, GitHub, and Open Weather metrics</p>
        </header>

        <main class="widget-grid">
            <div class="widget-card nasa">
                <div class="widget-header">
                    <div class="widget-icon">
                        <svg viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M256 500C121.2 500 12 390.8 12 256C12 121.2 121.2 12 256 12C390.8 12 500 121.2 500 256C500 390.8 390.8 500 256 500Z" fill="#0b3d91"/>
                            <path d="M466 215C466 215 450 162 422 136C408 123 371 106 371 106C371 106 319 79 256 79C193 79 141 106 141 106C141 106 104 123 90 136C62 162 46 215 46 215C46 215 37 253 46 295C55 337 90 380 90 380C90 380 127 416 141 426C155 436 211 454 256 454C301 454 357 436 371 426C385 416 422 380 422 380C422 380 457 337 466 295C475 253 466 215 466 215Z" fill="#fc3d21"/>
                            <text x="50%" y="55%" dominant-baseline="middle" text-anchor="middle" fill="#fff" font-size="120" font-weight="900" font-family="Arial">NASA</text>
                        </svg>
                    </div>
                    <div class="widget-title">Space Topics</div>
                </div>
                
                <div class="widget-content">
                    @if($nasa)
                        <div class="data-row">
                            <span class="data-label">Active Query</span>
                            <span class="data-value">{{ $nasa->query_text ?? 'N/A' }}</span>
                        </div>
                        @if($nasa->nasaImages->isNotEmpty())
                            @php $latestImage = $nasa->nasaImages->first(); @endphp
                            <div class="data-row">
                                <span class="data-label">Latest Image Title</span>
                                <span class="data-value" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 150px;">
                                    {{ $latestImage->title ?? 'N/A' }}
                                </span>
                            </div>
                            <div class="data-row">
                                <span class="data-label">Date Captured</span>
                                <span class="data-value">{{ $latestImage->date_created ? \Carbon\Carbon::parse($latestImage->date_created)->format('M d, Y') : 'N/A' }}</span>
                            </div>
                        @else
                            <div class="empty-state">No images found for this topic</div>
                        @endif
                    @else
                        <div class="empty-state">No active NASA topics</div>
                    @endif
                </div>
            </div>

            <div class="widget-card github">
                <div class="widget-header">
                    <div class="widget-icon">
                        <svg viewBox="0 0 24 24" fill="#ffffff" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12C2 16.42 4.868 20.166 8.847 21.464C9.347 21.554 9.53 21.246 9.53 20.985C9.53 20.751 9.52 20.116 9.516 19.278C6.734 19.882 6.147 17.935 6.147 17.935C5.693 16.783 5.037 16.475 5.037 16.475C4.131 15.856 5.105 15.869 5.105 15.869C6.108 15.939 6.635 16.901 6.635 16.901C7.527 18.428 8.971 17.986 9.549 17.728C9.64 17.07 9.905 16.63 10.2 16.381C7.98 16.128 5.648 15.269 5.648 11.472C5.648 10.392 6.033 9.508 6.657 8.814C6.557 8.562 6.216 7.555 6.753 6.195C6.753 6.195 7.575 5.931 9.508 7.241C10.288 7.023 11.135 6.914 11.977 6.91C12.818 6.914 13.665 7.023 14.446 7.241C16.377 5.931 17.2 6.195 17.2 6.195C17.738 7.555 17.397 8.562 17.297 8.814C17.922 9.508 18.305 10.392 18.305 11.472C18.305 15.28 15.969 16.125 13.743 16.371C14.113 16.69 14.441 17.317 14.441 18.283C14.441 19.67 14.428 20.785 14.428 21.121C14.428 21.385 14.61 21.696 15.114 21.603C19.123 20.301 22 16.42 22 12C22 6.477 17.523 2 12 2Z" />
                        </svg>
                    </div>
                    <div class="widget-title">GitHub Stats</div>
                </div>
                
                <div class="widget-content">
                    @if($github)
                        <div class="data-row">
                            <span class="data-label">Repository</span>
                            <span class="data-value">{{ $github->owner }}/{{ $github->repo }}</span>
                        </div>
                        <div class="data-row">
                            <span class="data-label">Language</span>
                            <span class="data-value">{{ $github->primary_language ?? 'N/A' }}</span>
                        </div>
                        @if($github->githubRepoStatuses->isNotEmpty())
                            @php $latestStatus = $github->githubRepoStatuses->first(); @endphp
                            <div class="data-row">
                                <span class="data-label">Stars</span>
                                <span class="data-value">{{ number_format($latestStatus->stars_count) }}</span>
                            </div>
                            <div class="data-row">
                                <span class="data-label">Forks</span>
                                <span class="data-value">{{ number_format($latestStatus->forks_count) }}</span>
                            </div>
                            <div class="data-row">
                                <span class="data-label">Open Issues</span>
                                <span class="data-value">{{ number_format($latestStatus->open_issues_count) }}</span>
                            </div>
                        @else
                            <div class="empty-state">No stats available for this repository</div>
                        @endif
                    @else
                        <div class="empty-state">No active GitHub repositories</div>
                    @endif
                </div>
            </div>

            <div class="widget-card weather">
                <div class="widget-header">
                    <div class="widget-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#0ea5e9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17.5 19C19.985 19 22 16.985 22 14.5C22 12.015 19.985 10 17.5 10C17.157 10 16.824 10.038 16.505 10.11C15.82 7.23 13.25 5 10 5C6.134 5 3 8.134 3 12C3 15.866 6.134 19 10 19H17.5Z"/>
                            <path d="M12 11V15"/>
                            <path d="M9 14L12 11L15 14"/>
                        </svg>
                    </div>
                    <div class="widget-title">Open Weather</div>
                </div>
                
                <div class="widget-content">
                    @if($weather)
                        <div class="data-row">
                            <span class="data-label">City</span>
                            <span class="data-value">{{ $weather->city }}</span>
                        </div>
                        @if($weather->weatherRecords->isNotEmpty())
                            @php $latestWeather = $weather->weatherRecords->first(); @endphp
                            <div class="weather-temp">
                                {{ round($latestWeather->temp) }}&deg;C
                            </div>
                            <div class="data-row">
                                <span class="data-label">Conditions</span>
                                <span class="data-value" style="text-transform: capitalize;">{{ $latestWeather->description }}</span>
                            </div>
                            <div class="data-row">
                                <span class="data-label">Feels Like</span>
                                <span class="data-value">{{ round($latestWeather->feels_like) }}&deg;C</span>
                            </div>
                            <div class="data-row">
                                <span class="data-label">Humidity</span>
                                <span class="data-value">{{ $latestWeather->humidity }}%</span>
                            </div>
                        @else
                            <div class="empty-state">No weather records available</div>
                        @endif
                    @else
                        <div class="empty-state">No active locations for weather</div>
                    @endif
                </div>
            </div>
        </main>
    </div>
</body>
</html>
