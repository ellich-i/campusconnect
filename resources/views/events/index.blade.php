
<x-app-layout>
    <div class="campus-events">
        <style>
            .campus-events {
                min-height: 100vh;
                background: #f5f8ff;
                color: #19263d;
                padding: 40px 0 65px;
                font-family: Arial, Helvetica, sans-serif;
            }

            .events-container {
                width: min(1120px, 92%);
                margin: auto;
            }

            .events-hero {
                padding: 36px;
                border-radius: 22px;
                background: linear-gradient(120deg, #1769e0, #104db0);
                color: white;
                margin-bottom: 32px;
            }

            .events-hero .eyebrow {
                display: inline-block;
                background: #ffffff26;
                border-radius: 20px;
                padding: 6px 12px;
                font-size: 12px;
                font-weight: bold;
                margin-bottom: 15px;
            }

            .events-hero h1 {
                font-size: clamp(30px, 4vw, 42px);
                line-height: 1.2;
                font-weight: 800;
                margin-bottom: 12px;
            }

            .events-hero p {
                color: #e4eeff;
                font-size: 15px;
            }

            .events-section-title {
                font-size: 23px;
                font-weight: 800;
                margin-bottom: 8px;
            }

            .events-subtitle {
                color: #718096;
                font-size: 14px;
                margin-bottom: 22px;
            }

            .events-filters {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                padding: 20px;
                border: 1px solid #e4ebf5;
                background: white;
                border-radius: 16px;
                margin-bottom: 28px;
            }

            .events-filters select,
            .events-filters input {
                min-width: 150px;
                flex: 1;
                border: 1px solid #dce4f0;
                border-radius: 9px;
                padding: 11px 13px;
                color: #25344d;
                background: white;
                font-size: 14px;
            }

            .events-filters button {
                padding: 11px 23px;
                border: none;
                border-radius: 9px;
                background: #1769e0;
                color: white;
                font-weight: bold;
                cursor: pointer;
            }

            .events-filters button:hover {
                background: #104db0;
            }

            .events-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 20px;
            }

            .event-card {
                background: white;
                border: 1px solid #e4ebf5;
                border-radius: 16px;
                padding: 23px;
                display: flex;
                flex-direction: column;
                min-width: 0;
                transition: transform .2s, box-shadow .2s;
            }

            .event-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 12px 30px #204d8d12;
            }

            .event-category {
                display: inline-block;
                align-self: flex-start;
                padding: 5px 10px;
                background: #e8f1ff;
                color: #1769e0;
                border-radius: 20px;
                font-size: 11px;
                font-weight: bold;
                margin-bottom: 15px;
            }

            .event-title {
                color: #19263d;
                font-size: 18px;
                font-weight: 800;
                line-height: 1.4;
                margin-bottom: 14px;
                overflow-wrap: anywhere;
            }

            .event-title:hover {
                color: #1769e0;
            }

            .event-info {
                color: #64748b;
                font-size: 13px;
                line-height: 1.9;
                margin-bottom: 17px;
            }

            .event-slots {
                border-top: 1px solid #edf0f5;
                padding-top: 14px;
                margin-top: auto;
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 10px;
                font-size: 12px;
                color: #64748b;
            }

            .event-view {
                color: #1769e0;
                font-weight: bold;
                white-space: nowrap;
            }

            .events-empty {
                grid-column: 1 / -1;
                background: white;
                border: 1px dashed #cbd8eb;
                border-radius: 16px;
                padding: 45px 20px;
                text-align: center;
            }

            .events-empty h3 {
                font-size: 19px;
                font-weight: bold;
                margin-bottom: 8px;
            }

            .events-empty p {
                color: #718096;
                font-size: 14px;
            }

            .events-pagination {
                margin-top: 28px;
                overflow-x: auto;
            }

            @media (max-width: 900px) {
                .events-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }

            @media (max-width: 600px) {
                .campus-events {
                    padding-top: 25px;
                }

                .events-hero {
                    padding: 27px 22px;
                }

                .events-filters {
                    flex-direction: column;
                }

                .events-filters select,
                .events-filters input,
                .events-filters button {
                    width: 100%;
                }

                .events-grid {
                    grid-template-columns: 1fr;
                }
            }
        </style>

        <div class="events-container">

            <section class="events-hero">
                <span class="eyebrow">CAMPUSCONNECT ACTIVITIES</span>
                <h1>Discover your next activity.</h1>
                <p>
                    Find activities, meet fellow students, and make your
                    vacant hours more meaningful.
                </p>
            </section>

            <section>
                <h2 class="events-section-title">Explore activities</h2>
                <p class="events-subtitle">
                    Browse available activities or use the filters to narrow
                    down your search.
                </p>

                <form method="GET"
                      action="{{ route('events.index') }}"
                      class="events-filters">

                    <select name="category_id" aria-label="Filter by category">
                        <option value="">All categories</option>
                        @foreach ($categories as $c)
                            <option
                                value="{{ $c->id }}"
                                @selected(request('category_id') == $c->id)
                            >
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="location_id" aria-label="Filter by location">
                        <option value="">All locations</option>
                        @foreach ($locations as $l)
                            <option
                                value="{{ $l->id }}"
                                @selected(request('location_id') == $l->id)
                            >
                                {{ $l->name }}
                            </option>
                        @endforeach
                    </select>

                    <input
                        type="date"
                        name="date"
                        aria-label="Filter by date"
                        value="{{ request('date') }}"
                    >

                    <button type="submit">Apply filters</button>
                </form>
            </section>

            <section class="events-grid">
                @forelse ($events as $event)
                    <article class="event-card">

                        <span class="event-category">
                            {{ $event->category->name ?? 'Campus Activity' }}
                        </span>

                        <a
                            href="{{ route('events.show', $event) }}"
                            class="event-title"
                        >
                            {{ $event->title }}
                        </a>

                        <div class="event-info">
                            <div>
                                📅
                                {{ $event->event_date
                                    ? $event->event_date->format('M d, Y')
                                    : 'Date not set' }}
                            </div>

                            <div>
                                📍
                                {{ $event->location->name ?? 'Location not set' }}
                            </div>
                        </div>

                        <div class="event-slots">
                            <span>
                                {{ $event->availableSlots() }} slots left
                            </span>

                            <a
                                href="{{ route('events.show', $event) }}"
                                class="event-view"
                            >
                                View details &rarr;
                            </a>
                        </div>

                    </article>
                @empty
                    <div class="events-empty">
                        <h3>No activities found</h3>
                        <p>
                            There are no activities matching your filters.
                            Try selecting different options.
                        </p>
                    </div>
                @endforelse
            </section>

            <div class="events-pagination">
                {{ $events->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
