
<x-app-layout>
    <div class="event-page">
        <style>
            .event-page {
                min-height: 100vh;
                padding: 38px 0 65px;
                background: #f5f8ff;
                color: #19263d;
                font-family: Arial, Helvetica, sans-serif;
            }

            .event-container {
                width: min(1000px, 92%);
                margin: auto;
            }

            .back-link {
                display: inline-block;
                color: #1769e0;
                font-size: 14px;
                font-weight: 700;
                margin-bottom: 24px;
            }

            .event-banner {
                background: linear-gradient(120deg, #1769e0, #104db0);
                color: white;
                border-radius: 22px;
                padding: 38px;
                margin-bottom: 24px;
            }

            .event-label {
                display: inline-block;
                padding: 6px 12px;
                background: #ffffff26;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 700;
                text-transform: uppercase;
                margin-bottom: 17px;
            }

            .event-banner h1 {
                font-size: clamp(28px, 4vw, 42px);
                line-height: 1.2;
                font-weight: 800;
                margin-bottom: 16px;
                overflow-wrap: anywhere;
            }

            .event-banner p {
                color: #e4eeff;
                font-size: 15px;
            }

            .event-layout {
                display: grid;
                grid-template-columns: minmax(0, 1.5fr) minmax(250px, 0.8fr);
                gap: 24px;
                align-items: start;
            }

            .event-card {
                padding: 27px;
                background: white;
                border: 1px solid #e4ebf5;
                border-radius: 17px;
                margin-bottom: 22px;
                min-width: 0;
            }

            .event-card h2 {
                font-size: 20px;
                font-weight: 800;
                margin-bottom: 19px;
            }

            .event-description {
                color: #52627a;
                font-size: 15px;
                line-height: 1.9;
                white-space: pre-line;
                overflow-wrap: anywhere;
            }

            .event-detail {
                display: flex;
                align-items: flex-start;
                gap: 13px;
                padding: 15px 0;
                border-bottom: 1px solid #edf0f5;
            }

            .event-detail:last-child {
                border-bottom: none;
                padding-bottom: 0;
            }

            .detail-icon {
                display: grid;
                place-items: center;
                flex-shrink: 0;
                width: 43px;
                height: 43px;
                border-radius: 12px;
                background: #eaf2ff;
                font-size: 20px;
            }

            .detail-label {
                color: #718096;
                font-size: 12px;
                margin-bottom: 3px;
            }

            .detail-value {
                color: #19263d;
                font-size: 14px;
                font-weight: 700;
                overflow-wrap: anywhere;
            }

            .event-status {
                display: inline-block;
                padding: 6px 11px;
                border-radius: 20px;
                background: #e8f1ff;
                color: #1769e0;
                font-size: 12px;
                font-weight: 800;
                text-transform: capitalize;
                margin-bottom: 17px;
            }

            .slot-number {
                font-size: 32px;
                font-weight: 800;
                color: #1769e0;
                margin-bottom: 2px;
            }

            .slot-caption {
                font-size: 13px;
                color: #718096;
                margin-bottom: 20px;
            }

            .event-button {
                display: block;
                width: 100%;
                padding: 12px 16px;
                border: 1px solid #1769e0;
                border-radius: 9px;
                background: #1769e0;
                color: white;
                font-size: 14px;
                font-weight: 700;
                text-align: center;
                cursor: pointer;
                margin-top: 10px;
                transition: 0.2s;
            }

            .event-button:hover {
                background: #104db0;
            }

            .event-button-outline {
                background: white;
                color: #1769e0;
            }

            .event-button-outline:hover {
                background: #edf5ff;
                color: #104db0;
            }

            .event-button-danger {
                background: #fff1f1;
                border-color: #ffd0d0;
                color: #c53030;
            }

            .event-button-danger:hover {
                background: #ffe0e0;
                color: #9b2525;
            }

            .event-message {
                padding: 13px 16px;
                border-radius: 10px;
                background: #e5f8ed;
                color: #17663b;
                font-size: 14px;
                margin-bottom: 18px;
                overflow-wrap: anywhere;
            }

            .event-error {
                background: #fff0f0;
                color: #b42323;
            }

            .participant-list {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .participant-list li {
                display: flex;
                align-items: center;
                gap: 12px;
                padding: 13px 0;
                border-bottom: 1px solid #edf0f5;
                font-size: 14px;
                overflow-wrap: anywhere;
            }

            .participant-list li:last-child {
                border-bottom: none;
                padding-bottom: 0;
            }

            .participant-avatar {
                display: grid;
                place-items: center;
                flex-shrink: 0;
                width: 38px;
                height: 38px;
                border-radius: 50%;
                background: #eaf2ff;
                color: #1769e0;
                font-weight: 800;
            }

            .participant-count {
                display: inline-block;
                padding: 4px 9px;
                background: #edf5ff;
                color: #1769e0;
                border-radius: 20px;
                font-size: 12px;
                margin-left: 5px;
            }

            .event-empty {
                color: #718096;
                font-size: 14px;
            }

            @media (max-width: 700px) {
                .event-page {
                    padding-top: 25px;
                }

                .event-banner {
                    padding: 27px 22px;
                }

                .event-layout {
                    grid-template-columns: 1fr;
                }

                .event-card {
                    padding: 22px;
                }
            }
        </style>

        <div class="event-container">

            <a href="{{ route('events.index') }}" class="back-link">
                &larr; Back to activities
            </a>

            @if (session('status'))
                <div class="event-message" role="status">
                    {{ session('status') }}
                </div>
            @endif

            @error('join')
                <div class="event-message event-error" role="alert">
                    {{ $message }}
                </div>
            @enderror

            <section class="event-banner">
                <span class="event-label">
                    CampusConnect Activity
                </span>

                <h1>{{ $event->title }}</h1>

                <p>
                    Organized by
                    {{ $event->organizer->name ?? 'CampusConnect member' }}
                </p>
            </section>

            <div class="event-layout">

                <div>
                    <section class="event-card">
                        <h2>About this activity</h2>

                        <p class="event-description">{{ $event->description ?: 'No description has been provided for this activity.' }}</p>
                    </section>

                    <section class="event-card">
                        <h2>Activity details</h2>

                        <div class="event-detail">
                            <div class="detail-icon">📅</div>
                            <div>
                                <p class="detail-label">Date</p>
                                <p class="detail-value">
                                    {{ $event->event_date->format('F d, Y') }}
                                </p>
                            </div>
                        </div>

                        <div class="event-detail">
                            <div class="detail-icon">🕒</div>
                            <div>
                                <p class="detail-label">Time</p>
                                <p class="detail-value">
                                    {{ substr($event->start_time, 0, 5) }}
                                    -
                                    {{ substr($event->end_time, 0, 5) }}
                                </p>
                            </div>
                        </div>

                        <div class="event-detail">
                            <div class="detail-icon">📍</div>
                            <div>
                                <p class="detail-label">Location</p>
                                <p class="detail-value">
                                    {{ $event->location->name ?? 'Location not set' }}
                                </p>
                            </div>
                        </div>

                        <div class="event-detail">
                            <div class="detail-icon">🏷️</div>
                            <div>
                                <p class="detail-label">Category</p>
                                <p class="detail-value">
                                    {{ $event->category->name ?? 'Uncategorized' }}
                                </p>
                            </div>
                        </div>
                    </section>

                    <section class="event-card">
                        <h2>
                            Participants
                            <span class="participant-count">
                                {{ $event->participants->count() }}
                            </span>
                        </h2>

                        @forelse ($event->participants as $p)
                            <ul class="participant-list">
                                <li>
                                    <span class="participant-avatar">
                                        {{ strtoupper(substr($p->name, 0, 1)) }}
                                    </span>

                                    <span>{{ $p->name }}</span>
                                </li>
                            </ul>
                        @empty
                            <p class="event-empty">
                                No participants yet. Be the first to join!
                            </p>
                        @endforelse
                    </section>
                </div>

                <aside>
                    <section class="event-card">
                        <h2>Join this activity</h2>

                        <span class="event-status">
                            {{ $event->status }}
                        </span>

                        <p class="slot-number">
                            {{ $event->availableSlots() }}
                        </p>

                        <p class="slot-caption">
                            Available slots out of {{ $event->capacity }}
                        </p>

                        @if ($hasJoined)
                            <p class="event-message">
                                You're already participating in this activity.
                            </p>

                            <form method="POST"
                                  action="{{ route('events.leave', $event) }}"
                                  onsubmit="return confirm('Are you sure you want to leave this activity?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="event-button event-button-danger">
                                    Leave activity
                                </button>
                            </form>
                        @else
                            <form method="POST"
                                  action="{{ route('events.join', $event) }}">
                                @csrf

                                <button type="submit" class="event-button">
                                    Join activity &rarr;
                                </button>
                            </form>
                        @endif

                        @can('update', $event)
                            <div style="border-top: 1px solid #edf0f5; margin-top: 22px; padding-top: 18px;">
                                <p class="detail-label">Organizer controls</p>

                                <a href="{{ route('events.edit', $event) }}"
                                   class="event-button event-button-outline">
                                    Edit activity
                                </a>

                                <form method="POST"
                                      action="{{ route('events.cancel', $event) }}"
                                      onsubmit="return confirm('Are you sure you want to cancel this event?')">
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit"
                                            class="event-button event-button-danger">
                                        Cancel event
                                    </button>
                                </form>
                            </div>
                        @endcan
                    </section>
                </aside>

            </div>
        </div>
    </div>
</x-app-layout>
