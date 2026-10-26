 <x-app-layout>
    <div class="event-details-page">
        <style>
            .event-details-page {
                min-height: 100vh;
                background: #f5f8ff;
                color: #19263d;
                padding: 40px 0 65px;
                font-family: Arial, Helvetica, sans-serif;
            }

            .details-container {
                width: min(900px, 92%);
                margin: auto;
            }

            .details-back {
                display: inline-block;
                color: #1769e0;
                font-size: 14px;
                font-weight: bold;
                text-decoration: none;
                margin-bottom: 22px;
            }

            .details-back:hover {
                text-decoration: underline;
            }

            .details-card {
                background: white;
                border: 1px solid #e4ebf5;
                border-radius: 20px;
                padding: 35px;
                box-shadow: 0 10px 35px #204d8d0a;
            }

            .details-category {
                display: inline-block;
                padding: 6px 12px;
                background: #e8f1ff;
                color: #1769e0;
                border-radius: 20px;
                font-size: 12px;
                font-weight: bold;
                margin-bottom: 16px;
            }

            .details-title {
                font-size: clamp(26px, 4vw, 36px);
                line-height: 1.25;
                font-weight: 800;
                overflow-wrap: anywhere;
                margin-bottom: 14px;
            }

            .details-description {
                color: #64748b;
                line-height: 1.8;
                white-space: pre-line;
                margin-bottom: 28px;
            }

            .details-info-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 15px;
                margin-bottom: 28px;
            }

            .details-info {
                background: #f7f9fd;
                border: 1px solid #e8edf5;
                border-radius: 12px;
                padding: 17px;
                min-width: 0;
            }

            .details-info-label {
                color: #718096;
                font-size: 12px;
                margin-bottom: 7px;
            }

            .details-info-value {
                color: #19263d;
                font-size: 14px;
                font-weight: bold;
                overflow-wrap: anywhere;
            }

            .details-status {
                display: inline-block;
                background: #e8f1ff;
                color: #1769e0;
                border-radius: 20px;
                padding: 5px 10px;
                font-size: 12px;
                font-weight: bold;
                text-transform: capitalize;
            }

            .details-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
                padding-top: 22px;
                border-top: 1px solid #edf0f5;
            }

            .details-button {
                display: inline-block;
                padding: 11px 18px;
                border: none;
                border-radius: 9px;
                background: #1769e0;
                color: white;
                font-size: 14px;
                font-weight: bold;
                text-decoration: none;
                cursor: pointer;
            }

            .details-button:hover {
                background: #104db0;
            }

            .details-button.secondary {
                background: #edf3fc;
                color: #24518c;
            }

            .details-button.secondary:hover {
                background: #dce9fb;
            }

            .details-button.danger {
                background: #dc3545;
            }

            .details-button.danger:hover {
                background: #b42332;
            }

            .details-alert {
                padding: 13px 16px;
                border-radius: 10px;
                margin-bottom: 18px;
                font-size: 14px;
            }

            .details-alert.success {
                background: #e9f9ef;
                color: #187443;
            }

            .details-alert.error {
                background: #fff0f0;
                color: #b42332;
            }

            .participants-section {
                margin-top: 25px;
                background: white;
                border: 1px solid #e4ebf5;
                border-radius: 16px;
                padding: 25px;
            }

            .participants-title {
                font-size: 20px;
                font-weight: 800;
                margin-bottom: 15px;
            }

            .participant-item {
                padding: 12px 0;
                border-bottom: 1px solid #edf0f5;
                font-size: 14px;
            }

            .participant-item:last-child {
                border-bottom: none;
            }

            .participants-empty {
                color: #718096;
                font-size: 14px;
            }

            @media (max-width: 600px) {
                .event-details-page {
                    padding-top: 25px;
                }

                .details-card {
                    padding: 23px 19px;
                }

                .details-info-grid {
                    grid-template-columns: 1fr;
                }

                .details-actions {
                    flex-direction: column;
                }

                .details-button {
                    text-align: center;
                }
            }
        </style>

        <div class="details-container">
            <a href="{{ route('events.index') }}" class="details-back">
                &larr; Back to activities
            </a>

            @if (session('status'))
                <div class="details-alert success">
                    {{ session('status') }}
                </div>
            @endif

            @error('join')
                <div class="details-alert error">
                    {{ $message }}
                </div>
            @enderror

            <section class="details-card">
                <span class="details-category">
                    {{ $event->category->name ?? 'Campus Activity' }}
                </span>

                <h1 class="details-title">{{ $event->title }}</h1>

                <p class="details-description">{{ $event->description ?: 'No description has been provided for this activity.' }}</p>

                <div class="details-info-grid">
                    <div class="details-info">
                        <div class="details-info-label">DATE</div>
                        <div class="details-info-value">
                            {{ $event->event_date ? $event->event_date->format('F d, Y') : 'Not set' }}
                        </div>
                    </div>

                    <div class="details-info">
                        <div class="details-info-label">TIME</div>
                        <div class="details-info-value">
                            {{ $event->start_time ? substr($event->start_time, 0, 5) : 'Not set' }}
                            -
                            {{ $event->end_time ? substr($event->end_time, 0, 5) : 'Not set' }}
                        </div>
                    </div>

                    <div class="details-info">
                        <div class="details-info-label">LOCATION</div>
                        <div class="details-info-value">
                            {{ $event->location->name ?? 'Location not set' }}
                        </div>
                    </div>

                    <div class="details-info">
                        <div class="details-info-label">ORGANIZER</div>
                        <div class="details-info-value">
                            {{ $event->organizer->name ?? 'Not available' }}
                        </div>
                    </div>

                    <div class="details-info">
                        <div class="details-info-label">AVAILABLE SLOTS</div>
                        <div class="details-info-value">
                            {{ $event->availableSlots() }} slots left out of {{ $event->capacity }}
                        </div>
                    </div>

                    <div class="details-info">
                        <div class="details-info-label">EVENT STATUS</div>
                        <div class="details-info-value">
                            <span class="details-status">{{ $event->status }}</span>
                        </div>
                    </div>
                </div>

                <div class="details-actions">
                    @if ($event->status === 'approved' && $event->availableSlots() > 0)
                        @if ($hasJoined)
                            <form method="POST" action="{{ route('events.leave', $event) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="details-button secondary">
                                    Leave Activity
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('events.join', $event) }}">
                                @csrf
                                <button type="submit" class="details-button">
                                    Join Activity
                                </button>
                            </form>
                        @endif
                    @elseif ($hasJoined)
                        <form method="POST" action="{{ route('events.leave', $event) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="details-button secondary">
                                Leave Activity
                            </button>
                        </form>
                    @else
                        <span class="details-button secondary" style="cursor: default;">
                            Joining is unavailable
                        </span>
                    @endif

                    @can('update', $event)
                        <a href="{{ route('events.edit', $event) }}" class="details-button secondary">
                            Edit Activity
                        </a>

                        @if ($event->status !== 'cancelled')
                            <form method="POST" action="{{ route('events.cancel', $event) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="details-button danger">
                                    Cancel Activity
                                </button>
                            </form>
                        @endif
                    @endcan
                </div>
            </section>

            <section class="participants-section">
                <h2 class="participants-title">
                    Participants ({{ $event->participants->count() }})
                </h2>

                @forelse ($event->participants as $participant)
                    <div class="participant-item">
                        {{ $participant->name }}
                    </div>
                @empty
                    <p class="participants-empty">
                        No students have joined this activity yet.
                    </p>
                @endforelse
            </section>
        </div>
    </div>
</x-app-layout>