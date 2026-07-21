<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Apply - UCA Nexus</title>
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-100 min-h-screen">
    <div class="min-h-screen">
        <header class="bg-white border-b border-slate-200 shadow-sm">
            <div class="max-w-5xl mx-auto px-4 py-4 flex items-center justify-between">
                <a href="{{ route('index') }}" class="text-xl font-bold tracking-tight">
                    <span class="text-primary-600">UCA</span>
                    <span class="text-slate-700">Nexus</span>
                </a>
                <p class="text-sm text-slate-500">Enrollment Application</p>
            </div>
        </header>

        <div class="max-w-5xl mx-auto px-4 py-8">
            @if(session('success'))
                <div class="mb-6 alert alert-success shadow-sm text-sm">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-6 alert alert-error shadow-sm text-sm">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="mb-6 alert alert-error shadow-sm text-sm">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="bg-linear-to-r from-primary-600 to-primary-700 px-6 py-5">
                    <h1 class="text-xl font-bold text-white">Application for Enrollment</h1>
                    <p class="text-primary-100 text-sm mt-1">Fill out the form below to apply. All fields marked with <span class="text-red-300">*</span> are required.</p>
                </div>

                <form method="POST" action="{{ route('application.store') }}" class="p-6 space-y-8">
                    @csrf

                    {{-- Section: Program Information --}}
                    <fieldset>
                        <legend class="text-base font-semibold text-slate-800 mb-4 pb-2 border-b border-slate-200">Program Information</legend>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            {{-- Field 1: School Year --}}
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">School Year <span class="text-red-500">*</span></span>
                                </label>
                                <select name="school_year" class="select select-bordered w-full" required>
                                    <option value="">Select school year</option>
                                    @foreach($schoolYears as $sy)
                                        <option value="{{ $sy->id }}" @selected(old('school_year') == $sy->id)>{{ $sy->description }}</option>
                                    @endforeach
                                </select>
                                @error('school_year') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            {{-- Field 2: Student Type --}}
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Student Type <span class="text-red-500">*</span></span>
                                </label>
                                <select name="student_type" class="select select-bordered w-full" required>
                                    <option value="">Select type</option>
                                    @foreach(App\Enums\EnrollmentType::cases() as $t)
                                        <option value="{{ $t->value }}" @selected(old('student_type') === $t->value)>{{ $t->label() }}</option>
                                    @endforeach
                                </select>
                                @error('student_type') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            {{-- Field 3: Education Level --}}
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Education Level <span class="text-red-500">*</span></span>
                                </label>
                                <select name="level" id="education-level" class="select select-bordered w-full" required>
                                    <option value="">Select education level</option>
                                    @foreach(App\Enums\EducationLevel::cases() as $l)
                                        <option value="{{ $l->value }}" @selected(old('level') === $l->value)>{{ $l->label() }}</option>
                                    @endforeach
                                </select>
                                @error('level') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            {{-- Hidden by default: Year Level --}}
                            <div id="year-level-field" class="form-control hidden">
                                <label class="label">
                                    <span class="label-text">Year Level <span class="text-red-500">*</span></span>
                                </label>
                                <select name="year_level" id="year-level-select" class="select select-bordered w-full">
                                    <option value="">Select year level</option>
                                </select>
                                @error('year_level') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            {{-- Hidden by default: Strand (K-12) --}}
                            <div id="strand-field" class="form-control hidden">
                                <label class="label">
                                    <span class="label-text">Strand <span class="text-red-500">*</span></span>
                                </label>
                                <select name="strand" id="strand-select" class="select select-bordered w-full">
                                    <option value="">Select strand</option>
                                </select>
                                @error('strand') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            {{-- Hidden by default: Program Choices (College) --}}
                            <div id="program-choices" class="hidden md:col-span-2">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text">First Program Choice <span class="text-red-500">*</span></span>
                                        </label>
                                        <select name="first_program_choice" id="first-choice-select" class="select select-bordered w-full">
                                            <option value="">Select program</option>
                                        </select>
                                        @error('first_program_choice') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text">Second Program Choice</span>
                                        </label>
                                        <select name="second_program_choice" id="second-choice-select" class="select select-bordered w-full">
                                            <option value="">Select program</option>
                                        </select>
                                        @error('second_program_choice') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="form-control">
                                        <label class="label">
                                            <span class="label-text">Third Program Choice</span>
                                        </label>
                                        <select name="third_program_choice" id="third-choice-select" class="select select-bordered w-full">
                                            <option value="">Select program</option>
                                        </select>
                                        @error('third_program_choice') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                    </fieldset>

                    {{-- Section: Personal Information --}}
                    <fieldset>
                        <legend class="text-base font-semibold text-slate-800 mb-4 pb-2 border-b border-slate-200">Personal Information</legend>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Last Name <span class="text-red-500">*</span></span>
                                </label>
                                <input type="text" name="last_name" value="{{ old('last_name') }}" class="input input-bordered w-full" required>
                                @error('last_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">First Name <span class="text-red-500">*</span></span>
                                </label>
                                <input type="text" name="first_name" value="{{ old('first_name') }}" class="input input-bordered w-full" required>
                                @error('first_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Middle Name <span class="text-red-500">*</span></span>
                                </label>
                                <input type="text" name="middle_name" value="{{ old('middle_name') }}" class="input input-bordered w-full" required>
                                @error('middle_name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Sex <span class="text-red-500">*</span></span>
                                </label>
                                <select name="sex" class="select select-bordered w-full" required>
                                    <option value="">Select sex</option>
                                    <option value="male" @selected(old('sex') === 'male')>Male</option>
                                    <option value="female" @selected(old('sex') === 'female')>Female</option>
                                </select>
                                @error('sex') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Civil Status <span class="text-red-500">*</span></span>
                                </label>
                                <select name="civil_status" class="select select-bordered w-full" required>
                                    <option value="">Select status</option>
                                    @foreach(App\Enums\CivilStatus::cases() as $cs)
                                        <option value="{{ $cs->value }}" @selected(old('civil_status') === $cs->value)>{{ $cs->label() }}</option>
                                    @endforeach
                                </select>
                                @error('civil_status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Citizenship <span class="text-red-500">*</span></span>
                                </label>
                                <input type="text" name="citizenship" value="{{ old('citizenship') }}" class="input input-bordered w-full" required>
                                @error('citizenship') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Religion <span class="text-red-500">*</span></span>
                                </label>
                                <input type="text" name="religion" value="{{ old('religion') }}" class="input input-bordered w-full" required>
                                @error('religion') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Birthdate <span class="text-red-500">*</span></span>
                                </label>
                                <input type="date" name="birthdate" value="{{ old('birthdate') }}" class="input input-bordered w-full" required>
                                @error('birthdate') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Place of Birth <span class="text-red-500">*</span></span>
                                </label>
                                <input type="text" name="place_of_birth" value="{{ old('place_of_birth') }}" class="input input-bordered w-full" required>
                                @error('place_of_birth') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </fieldset>

                    {{-- Section: Contact Information --}}
                    <fieldset>
                        <legend class="text-base font-semibold text-slate-800 mb-4 pb-2 border-b border-slate-200">Contact Information</legend>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="form-control md:col-span-2">
                                <label class="label">
                                    <span class="label-text">Present Address <span class="text-red-500">*</span></span>
                                </label>
                                <input type="text" name="contact[present_address]" value="{{ old('contact.present_address') }}" class="input input-bordered w-full" required>
                                @error('contact.present_address') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control md:col-span-2">
                                <label class="label">
                                    <span class="label-text">Permanent Address <span class="text-red-500">*</span></span>
                                </label>
                                <input type="text" name="contact[permanent_address]" value="{{ old('contact.permanent_address') }}" class="input input-bordered w-full" required>
                                @error('contact.permanent_address') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Zip Code <span class="text-red-500">*</span></span>
                                </label>
                                <input type="text" name="contact[zip_code]" value="{{ old('contact.zip_code') }}" class="input input-bordered w-full" required>
                                @error('contact.zip_code') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Mobile Number <span class="text-red-500">*</span></span>
                                </label>
                                <input type="text" name="contact[mobile_number]" value="{{ old('contact.mobile_number') }}" class="input input-bordered w-full" required>
                                @error('contact.mobile_number') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Telephone Number</span>
                                </label>
                                <input type="text" name="contact[telephone_number]" value="{{ old('contact.telephone_number') }}" class="input input-bordered w-full">
                                @error('contact.telephone_number') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text">Email <span class="text-red-500">*</span></span>
                                </label>
                                <input type="email" name="contact[email]" value="{{ old('contact.email') }}" class="input input-bordered w-full" required>
                                @error('contact.email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </fieldset>

                    {{-- Section: Guardian Information --}}
                    <fieldset>
                        <legend class="text-base font-semibold text-slate-800 mb-4 pb-2 border-b border-slate-200">Guardian Information</legend>
                        <div id="guardians-wrapper">
                            <div class="guardian-row relative grid grid-cols-1 md:grid-cols-5 gap-4 p-4 bg-slate-50 rounded-lg mb-4">
                                <button type="button" class="remove-guardian-btn absolute top-2 right-2 text-red-400 hover:text-red-600 text-lg leading-none hidden">&times;</button>
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Type <span class="text-red-500">*</span></span>
                                    </label>
                                    <select name="guardians[0][type]" class="select select-bordered w-full" required>
                                        <option value="">Select type</option>
                                        @foreach(App\Enums\GuardianType::cases() as $gt)
                                            <option value="{{ $gt->value }}" @selected(old('guardians.0.type') === $gt->value)>{{ $gt->label() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Name <span class="text-red-500">*</span></span>
                                    </label>
                                    <input type="text" name="guardians[0][name]" value="{{ old('guardians.0.name') }}" class="input input-bordered w-full" required>
                                </div>
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Occupation</span>
                                    </label>
                                    <input type="text" name="guardians[0][occupation]" value="{{ old('guardians.0.occupation') }}" class="input input-bordered w-full">
                                </div>
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Contact No.</span>
                                    </label>
                                    <input type="text" name="guardians[0][contact_number]" value="{{ old('guardians.0.contact_number') }}" class="input input-bordered w-full">
                                </div>
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Monthly Income</span>
                                    </label>
                                    <input type="number" step="0.01" min="0" name="guardians[0][monthly_income]" value="{{ old('guardians.0.monthly_income') }}" class="input input-bordered w-full">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="add-guardian-btn text-sm text-primary-600 hover:text-primary-700 font-medium">+ Add another guardian</button>
                    </fieldset>

                    {{-- Section: Educational Background --}}
                    <fieldset>
                        <legend class="text-base font-semibold text-slate-800 mb-4 pb-2 border-b border-slate-200">Educational Background</legend>
                        <div id="education-wrapper">
                            <div class="education-row relative grid grid-cols-1 md:grid-cols-4 gap-4 p-4 bg-slate-50 rounded-lg mb-4">
                                <button type="button" class="remove-education-btn absolute top-2 right-2 text-red-400 hover:text-red-600 text-lg leading-none hidden">&times;</button>
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Level <span class="text-red-500">*</span></span>
                                    </label>
                                    <select name="education[0][level]" class="select select-bordered w-full" required>
                                        <option value="">Select level</option>
                                        <option value="elementary" @selected(old('education.0.level') === 'elementary')>Elementary</option>
                                        <option value="junior_high" @selected(old('education.0.level') === 'junior_high')>Junior High School</option>
                                        <option value="senior_high" @selected(old('education.0.level') === 'senior_high')>Senior High School</option>
                                        <option value="college" @selected(old('education.0.level') === 'college')>College</option>
                                    </select>
                                </div>
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">School Name <span class="text-red-500">*</span></span>
                                    </label>
                                    <input type="text" name="education[0][school_name]" value="{{ old('education.0.school_name') }}" class="input input-bordered w-full" required>
                                </div>
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">School Address <span class="text-red-500">*</span></span>
                                    </label>
                                    <input type="text" name="education[0][school_address]" value="{{ old('education.0.school_address') }}" class="input input-bordered w-full" required>
                                </div>
                                <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Inclusive Years <span class="text-red-500">*</span></span>
                                    </label>
                                    <input type="text" name="education[0][inclusive_years]" value="{{ old('education.0.inclusive_years') }}" class="input input-bordered w-full" placeholder="e.g. 2018-2022" required>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="add-education-btn text-sm text-primary-600 hover:text-primary-700 font-medium">+ Add another educational background</button>
                    </fieldset>

                    {{-- Data Privacy & Submit --}}
                    <div class="pt-4 border-t border-slate-200 space-y-4">
                        <div class="flex items-start gap-3">
                            <input type="checkbox" id="data-privacy-check" class="checkbox checkbox-primary mt-1">
                            <label for="data-privacy-check" class="text-sm text-slate-600">
                                I have read and agree to the
                                <a href="#" id="privacy-link" class="text-primary-600 underline font-medium">Data Privacy Policy</a>.
                            </label>
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('index') }}" class="text-sm text-slate-500 hover:text-slate-700">Back to Home</a>
                            <button type="submit" id="submit-btn" class="btn btn-primary px-8" disabled>Submit Application</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Data Privacy Modal --}}
    <dialog id="privacy-modal" class="modal">
        <div class="modal-box max-w-2xl">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Data Privacy Consent</h3>
            <div class="text-sm text-slate-600 space-y-3 max-h-96 overflow-y-auto">
                <p>In compliance with the <strong>Data Privacy Act of 2012 (Republic Act No. 10173)</strong> and its Implementing Rules and Regulations, this institution is committed to protecting and respecting your privacy.</p>

                <p class="font-semibold text-slate-700 pt-2">Collection of Personal Information</p>
                <p>By submitting this application form, you consent to the collection of your personal information, including but not limited to:</p>
                <ul class="list-disc list-inside space-y-1">
                    <li>Full name, date of birth, and contact details</li>
                    <li>Educational background and academic records</li>
                    <li>Parent/Guardian information</li>
                    <li>Other information necessary for enrollment processing</li>
                </ul>

                <p class="font-semibold text-slate-700 pt-2">Purpose of Data Collection</p>
                <p>Your personal data will be used for the following purposes:</p>
                <ul class="list-disc list-inside space-y-1">
                    <li>Processing and evaluation of your application</li>
                    <li>Enrollment and registration procedures</li>
                    <li>Academic records management</li>
                    <li>Communication regarding your application status</li>
                    <li>Compliance with government and regulatory requirements</li>
                </ul>

                <p class="font-semibold text-slate-700 pt-2">Data Protection</p>
                <p>We implement appropriate security measures to protect your personal information against unauthorized access, alteration, disclosure, or destruction. Your data will only be accessed by authorized personnel for legitimate purposes.</p>

                <p class="font-semibold text-slate-700 pt-2">Your Rights</p>
                <p>Under the Data Privacy Act, you have the right to:</p>
                <ul class="list-disc list-inside space-y-1">
                    <li>Be informed of how your data is being processed</li>
                    <li>Access your personal data</li>
                    <li>Object to processing of your personal data</li>
                    <li>Request correction or erasure of your data</li>
                    <li>Lodge a complaint with the National Privacy Commission</li>
                </ul>

                <p class="font-semibold text-slate-700 pt-2">Retention Period</p>
                <p>Your personal data will be retained for as long as necessary to fulfill the purposes for which it was collected, or as required by applicable laws and regulations.</p>
            </div>
            <div class="modal-action">
                <button id="close-privacy-modal" class="btn btn-sm btn-primary">I Understand</button>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop">
            <button>close</button>
        </form>
    </dialog>

    <script>
        const levelsData = @json($levels);
        const programsData = @json($programs);

        const educationLevelSelect = document.getElementById('education-level');
        const yearLevelField = document.getElementById('year-level-field');
        const yearLevelSelect = document.getElementById('year-level-select');
        const strandField = document.getElementById('strand-field');
        const strandSelect = document.getElementById('strand-select');
        const programChoices = document.getElementById('program-choices');
        const firstChoice = document.getElementById('first-choice-select');
        const secondChoice = document.getElementById('second-choice-select');
        const thirdChoice = document.getElementById('third-choice-select');

        function resetField(container) {
            container.querySelectorAll('select').forEach(s => s.value = '');
            container.querySelectorAll('input').forEach(i => i.value = '');
        }

        function getLevelsByEducation(eduLevel) {
            return levelsData.filter(l => l.program && l.program.department && l.program.department.education_level === eduLevel);
        }

        function populateSelect(selectEl, items, labelFn, valueFn) {
            selectEl.innerHTML = '<option value="">Select</option>';
            items.forEach(item => {
                const opt = document.createElement('option');
                opt.value = valueFn ? valueFn(item) : item.id;
                opt.textContent = labelFn(item);
                selectEl.appendChild(opt);
            });
        }

        function getDistinctLevels(levels) {
            const seen = new Set();
            return levels.filter(l => {
                if (seen.has(l.description)) return false;
                seen.add(l.description);
                return true;
            });
        }

        function getProgramsByDepartmentEduLevel(eduLevel) {
            return programsData.filter(p => p.department && p.department.education_level === eduLevel);
        }

        function isSeniorHighLevel(level) {
            const desc = level.description ? level.description.toLowerCase() : '';
            return desc === 'grade 11' || desc === 'grade 12';
        }

        educationLevelSelect.addEventListener('change', function() {
            const value = this.value;

            resetField(yearLevelField);
            resetField(strandField);
            resetField(programChoices);

            yearLevelField.classList.add('hidden');
            strandField.classList.add('hidden');
            programChoices.classList.add('hidden');

            if (!value) return;

            const filteredLevels = getLevelsByEducation(value);
            const distinctLevels = getDistinctLevels(filteredLevels);

            if (distinctLevels.length > 0) {
                yearLevelField.classList.remove('hidden');
                populateSelect(yearLevelSelect, distinctLevels, l => l.description, l => l.description);
            }

            if (value === 'college') {
                const collegePrograms = getProgramsByDepartmentEduLevel('college');
                populateSelect(firstChoice, collegePrograms, p => p.code + ' - ' + p.description);
                populateSelect(secondChoice, collegePrograms, p => p.code + ' - ' + p.description);
                populateSelect(thirdChoice, collegePrograms, p => p.code + ' - ' + p.description);
                programChoices.classList.remove('hidden');
            }
        });

        yearLevelSelect.addEventListener('change', function() {
            const eduLevel = educationLevelSelect.value;

            resetField(strandField);
            strandField.classList.add('hidden');

            if (!this.value || eduLevel !== 'K12') return;

            const matchingLevels = levelsData.filter(l => l.description === this.value);
            if (!matchingLevels.length) return;

            const isSH = matchingLevels.some(l => isSeniorHighLevel(l));
            if (!isSH) return;

            const deptIds = new Set(
                matchingLevels.map(l => l.program?.department?.id).filter(Boolean)
            );
            if (!deptIds.size) return;

            const strandPrograms = programsData.filter(p => deptIds.has(p.department?.id));
            populateSelect(strandSelect, strandPrograms, p => p.code + ' - ' + p.description);
            strandField.classList.remove('hidden');
        });

        // Data Privacy
        const privacyCheck = document.getElementById('data-privacy-check');
        const submitBtn = document.getElementById('submit-btn');
        const privacyLink = document.getElementById('privacy-link');
        const privacyModal = document.getElementById('privacy-modal');
        const closePrivacyModal = document.getElementById('close-privacy-modal');

        privacyCheck.addEventListener('change', function() {
            submitBtn.disabled = !this.checked;
        });

        privacyLink.addEventListener('click', function(e) {
            e.preventDefault();
            privacyModal.showModal();
        });

        closePrivacyModal.addEventListener('click', function() {
            privacyModal.close();
        });

        // Guardian add / remove
        let guardianIndex = {{ old('guardians') ? count(old('guardians')) : 1 }};
        document.querySelector('.add-guardian-btn').addEventListener('click', function() {
            const wrapper = document.getElementById('guardians-wrapper');
            const template = wrapper.querySelector('.guardian-row').cloneNode(true);
            template.querySelectorAll('select, input').forEach(el => {
                const name = el.getAttribute('name');
                if (name) {
                    el.setAttribute('name', name.replace(/\[\d+\]/, '[' + guardianIndex + ']'));
                    el.value = '';
                }
            });
            const btn = template.querySelector('.remove-guardian-btn');
            btn.classList.remove('hidden');
            btn.addEventListener('click', function() {
                template.remove();
            });
            wrapper.appendChild(template);
            guardianIndex++;
        });

        // Education add / remove
        let educationIndex = {{ old('education') ? count(old('education')) : 1 }};
        document.querySelector('.add-education-btn').addEventListener('click', function() {
            const wrapper = document.getElementById('education-wrapper');
            const template = wrapper.querySelector('.education-row').cloneNode(true);
            template.querySelectorAll('select, input').forEach(el => {
                const name = el.getAttribute('name');
                if (name) {
                    el.setAttribute('name', name.replace(/\[\d+\]/, '[' + educationIndex + ']'));
                    el.value = '';
                }
            });
            const btn = template.querySelector('.remove-education-btn');
            btn.classList.remove('hidden');
            btn.addEventListener('click', function() {
                template.remove();
            });
            wrapper.appendChild(template);
            educationIndex++;
        });
    </script>
</body>
</html>
