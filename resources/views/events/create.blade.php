
<x-app-layout>
    <div class="create-event-page">
        <style>
            .create-event-page {
                min-height: 100vh;
                padding: 40px 0 65px;
                background: #f5f8ff;
                color: #19263d;
                font-family: Arial, Helvetica, sans-serif;
            }

            .create-container {
                width: min(1120px, 92%);
                margin: auto;
            }

            /* Back to Dashboard */
            .back-dashboard {
                display: inline-flex;
                align-items: center;
                gap: 9px;
                padding: 11px 20px;
                margin-bottom: 26px;
                border: 1px solid #d7e3f5;
                border-radius: 12px;
                background: #ffffff;
                color: #1769e0;
                font-size: 14px;
                font-weight: 700;
                text-decoration: none;
                transition: background .2s, transform .2s;
            }

            .back-dashboard:hover {
                background: #eaf2ff;
                transform: translateX(-3px);
            }

            /* Hero */
            .create-hero {
                padding: 36px;
                margin-bottom: 32px;
                border-radius: 22px;
                background: linear-gradient(120deg, #1769e0, #104db0);
                color: #ffffff;
            }

            .create-eyebrow {
                display: inline-block;
                padding: 6px 12px;
                margin-bottom: 15px;
                border-radius: 20px;
                background: #ffffff26;
                font-size: 12px;
                font-weight: 700;
                letter-spacing: .4px;
            }

            .create-hero h1 {
                margin-bottom: 12px;
                font-size: clamp(30px, 4vw, 42px);
                line-height: 1.2;
                font-weight: 800;
            }

            .create-hero p {
                color: #e4eeff;
                font-size: 15px;
                line-height: 1.7;
            }

            /* Form Card */
            .create-form-card {
                padding: 32px;
                border: 1px solid #e0e8f5;
                border-radius: 20px;
                background: #ffffff;
                box-shadow: 0 8px 25px #204d8d08;
            }

            .form-heading {
                margin-bottom: 8px;
                color: #19263d;
                font-size: 23px;
                font-weight: 800;
            }

            .form-subtitle {
                margin-bottom: 28px;
                color: #718096;
                font-size: 14px;
                line-height: 1.7;
            }

            .form-section {
                padding-bottom: 26px;
                margin-bottom: 26px;
                border-bottom: 1px solid #e8eef7;
            }

            .form-section:last-of-type {
                padding-bottom: 0;
                margin-bottom: 0;
                border-bottom: none;
            }

            .section-heading {
                margin-bottom: 6px;
                color: #19263d;
                font-size: 17px;
                font-weight: 800;
            }

            .section-description {
                margin-bottom: 22px;
                color: #718096;
                font-size: 13px;
                line-height: 1.6;
            }

            .form-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 22px;
            }

            .form-group {
                min-width: 0;
            }

            .form-group.full-width {
                grid-column: 1 / -1;
            }

            .form-label {
                display: block;
                margin-bottom: 9px;
                color: #25344d;
                font-size: 14px;
                font-weight: 700;
            }

            .required-mark {
                color: #e05252;
            }

            .form-control {
                display: block;
                width: 100%;
                min-height: 48px;
                padding: 12px 14px;
                border: 1px solid #dce4f0;
                border-radius: 12px;
                background: #f8fafd;
                color: #25344d;
                font-family: inherit;
                font-size: 14px;
                transition: border-color .2s, box-shadow .2s,
                    background .2s;
            }

            .form-control:focus {
                outline: none;
                border-color: #1769e0;
                background: #ffffff;
                box-shadow: 0 0 0 3px #1769e01a;
            }

            .form-control::placeholder {
                color: #8996aa;
            }

            textarea.form-control {
                min-height: 125px;
                resize: vertical;
                line-height: 1.7;
            }

            .form-error {
                margin-top: 7px;
                color: #dc2626;
                font-size: 13px;
                line-height: 1.5;
            }

            .validation-box {
                padding: 16px 20px;
                margin-bottom: 24px;
                border: 1px solid #fecaca;
                border-radius: 12px;
                background: #fef2f2;
                color: #b91c1c;
            }

            .validation-box ul {
                padding-left: 20px;
                margin-top: 8px;
                list-style: disc;
            }

            .validation-box li {
                margin-top: 4px;
                font-size: 13px;
            }

            /* Buttons */
            .form-actions {
                display: flex;
                justify-content: flex-end;
                flex-wrap: wrap;
                gap: 12px;
                padding-top: 28px;
                margin-top: 28px;
                border-top: 1px solid #e8eef7;
            }

            .btn {
                display: inline-flex;
                justify-content: center;
                align-items: center;
                gap: 9px;
                min-height: 46px;
                padding: 12px 23px;
                border: 1px solid transparent;
                border-radius: 10px;
                font-family: inherit;
                font-size: 14px;
                font-weight: 700;
                text-decoration: none;
                cursor: pointer;
                transition: background .2s, transform .2s;
            }

            .btn-cancel {
                border-color: #dce4f0;
                background: #f8fafd;
                color: #53657e;
            }

            .btn-cancel:hover {
                background: #edf2f9;
            }

            .btn-submit {
                background: #1769e0;
                color: #ffffff;
            }

            .btn-submit:hover {
                background: #104db0;
                transform: translateY(-1px);
            }

            @media (max-width: 700px) {
                .create-event-page {
                    padding-top: 25px;
                }

                .create-hero {
                    padding: 27px 22px;
                    border-radius: 17px;
                }

                .create-form-card {
                    padding: 23px 18px;
                    border-radius: 16px;
                }

                .form-grid {
                    grid-template-columns: 1fr;
                    gap: 18px;
                }

                .form-group.full-width {
                    grid-column: auto;
                }

                .form-actions {
                    flex-direction: column-reverse;
                }

                .form-actions .btn {
                    width: 100%;
                }
            }
        </style>

        <div class="create-container">

            {{-- Back to Dashboard --}}
            <a href="{{ route('dashboard') }}" class="back-dashboard">
                <span aria-hidden="true">&larr;</span>
                Back to Dashboard
            </a>

            {{-- Page Header --}}
            <section class="create-hero">
                <span class="create-eyebrow">
                    CAMPUSCONNECT · STUDENT ACTIVITIES
                </span>

                <h1>Create an Event</h1>

                <p>
                    Bring students together! Create an activity and share it
                    with your campus community.
                </p>
            </section>

            {{-- Event Form --}}
            <section class="create-form-card">
                <h2 class="form-heading">Event Information</h2>

                <p class="form-subtitle">
                    Complete the details below. Fields marked with
                    <span class="required-mark">*</span> are required.
                </p>

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="validation-box">
                        <strong>Please check the following fields:</strong>

                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('events.store') }}" method="POST">
                    @csrf

                    {{-- Basic Information --}}
                    <div class="form-section">
                        <h3 class="section-heading">Basic Information</h3>

                        <p class="section-description">
                            Tell students what your activity is about.
                        </p>

                        <div class="form-grid">
                            <div class="form-group full-width">
                                <label for="title" class="form-label">
                                    Event Title
                                    <span class="required-mark">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="title"
                                    name="title"
                                    class="form-control"
                                    value="{{ old('title') }}"
                                    placeholder="e.g. Campus Chess Meetup"
                                    maxlength="255"
                                    required
                                >

                                @error('title')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group full-width">
                                <label for="description" class="form-label">
                                    Event Description
                                    <span class="required-mark">*</span>
                                </label>

                                <textarea
                                    id="description"
                                    name="description"
                                    class="form-control"
                                    placeholder="Describe your activity and what participants can expect..."
                                    required
                                >{{ old('description') }}</textarea>

                                @error('description')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Category and Location --}}
                    <div class="form-section">
                        <h3 class="section-heading">
                            Category and Location
                        </h3>

                        <p class="section-description">
                            Choose the category and location for your activity.
                        </p>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="category_id" class="form-label">
                                    Category
                                    <span class="required-mark">*</span>
                                </label>

                                <select
                                    id="category_id"
                                    name="category_id"
                                    class="form-control"
                                    required
                                >
                                    <option value="">Select a category</option>

                                    @foreach ($categories as $category)
                                        <option
                                            value="{{ $category->id }}"
                                            @selected(old('category_id') == $category->id)
                                        >
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('category_id')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="location_id" class="form-label">
                                    Location
                                    <span class="required-mark">*</span>
                                </label>

                                <select
                                    id="location_id"
                                    name="location_id"
                                    class="form-control"
                                    required
                                >
                                    <option value="">Select a location</option>

                                    @foreach ($locations as $location)
                                        <option
                                            value="{{ $location->id }}"
                                            @selected(old('location_id') == $location->id)
                                        >
                                            {{ $location->name }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('location_id')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Schedule and Capacity --}}
                    <div class="form-section">
                        <h3 class="section-heading">
                            Schedule and Capacity
                        </h3>

                        <p class="section-description">
                            Set the date, times, and maximum number of
                            participants.
                        </p>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="event_date" class="form-label">
                                    Event Date
                                    <span class="required-mark">*</span>
                                </label>

                                <input
                                    type="date"
                                    id="event_date"
                                    name="event_date"
                                    class="form-control"
                                    value="{{ old('event_date') }}"
                                    min="{{ today()->format('Y-m-d') }}"
                                    required
                                >

                                @error('event_date')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="capacity" class="form-label">
                                    Maximum Participants
                                    <span class="required-mark">*</span>
                                </label>

                                <input
                                    type="number"
                                    id="capacity"
                                    name="capacity"
                                    class="form-control"
                                    value="{{ old('capacity', 10) }}"
                                    placeholder="e.g. 50"
                                    min="1"
                                    required
                                >

                                @error('capacity')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="start_time" class="form-label">
                                    Start Time
                                    <span class="required-mark">*</span>
                                </label>

                                <input
                                    type="time"
                                    id="start_time"
                                    name="start_time"
                                    class="form-control"
                                    value="{{ old('start_time') }}"
                                    required
                                >

                                @error('start_time')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="end_time" class="form-label">
                                    End Time
                                    <span class="required-mark">*</span>
                                </label>

                                <input
                                    type="time"
                                    id="end_time"
                                    name="end_time"
                                    class="form-control"
                                    value="{{ old('end_time') }}"
                                    required
                                >

                                @error('end_time')
                                    <p class="form-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="form-actions">
                        <a
                            href="{{ route('events.index') }}"
                            class="btn btn-cancel"
                        >
                            Cancel
                        </a>

                        <button type="submit" class="btn btn-submit">
                            Create Event
                            <span aria-hidden="true">&rarr;</span>
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</x-app-layout>
