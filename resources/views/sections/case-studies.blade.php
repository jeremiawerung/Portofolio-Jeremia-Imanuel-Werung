{{-- ===== CASE STUDIES SECTION ===== --}}
<section id="case-studies" class="relative py-20 lg:py-28 overflow-hidden">

    {{-- Background Decoration --}}
    <div class="bg-decoration w-[500px] h-[500px] bg-violet-600 -right-48 top-20 absolute"></div>
    <div class="bg-decoration w-[300px] h-[300px] bg-indigo-600 -left-32 bottom-40 absolute"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Section Header --}}
        <div class="text-center mb-16 reveal">
            <span class="tag mb-4 inline-flex">
                <i data-lucide="microscope" class="w-3 h-3 mr-1.5"></i>
                Case Studies
            </span>
            <h2 class="section-title text-slate-100 mt-3">
                QA <span class="gradient-text">Case Studies</span>
            </h2>
            <p class="text-slate-400 mt-4 max-w-2xl mx-auto">
                In-depth analysis of testing strategies applied to real-world project scenarios
            </p>
        </div>

        {{-- Case Study Card --}}
        <div class="max-w-5xl mx-auto space-y-10">

            {{-- ===== CASE STUDY: Sistem Reservasi Aurora Beauty Salon ===== --}}
            <div class="glass-card p-6 sm:p-8 reveal">

                {{-- Case Study Header --}}
                <div class="flex flex-col sm:flex-row items-start gap-5 mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-pink-500 via-rose-500 to-purple-600 flex items-center justify-center shadow-lg shadow-pink-500/20 shrink-0">
                        <i data-lucide="scissors" class="w-7 h-7 text-white"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-2">
                            <span class="tag" style="background: rgba(236, 72, 153, 0.1); color: #f472b6; border-color: rgba(236, 72, 153, 0.2);">
                                Academic Project
                            </span>
                            <span class="tag">
                                <i data-lucide="calendar" class="w-3 h-3 mr-1"></i>
                                2025 – 2026
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-slate-100 mb-2">
                            Sistem Reservasi Aurora Beauty Salon
                        </h3>
                        <p class="text-sm text-slate-400 leading-relaxed">
                            Web-based reservation information system with a two-stage transaction flow: 
                            <span class="text-indigo-400 font-medium">50% down payment (DP)</span> upon booking, 
                            and <span class="text-indigo-400 font-medium">final payment</span> after the service is completed. 
                            Each payment stage undergoes admin verification, and customers must check-in upon arrival 
                            at the salon before the service begins.
                        </p>
                    </div>
                </div>

                {{-- QA Role & Technical Insight --}}
                <div class="glass-card p-5 mb-8 reveal" style="background: rgba(99, 102, 241, 0.05);">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-indigo-500/10 flex items-center justify-center shrink-0 mt-0.5">
                            <i data-lucide="info" class="w-4 h-4 text-indigo-400"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 leading-relaxed">
                                <i data-lucide="cpu" class="w-3 h-3 inline mr-1"></i>
                                <span class="text-slate-400 font-medium">Technical Insight:</span>
                                Based on the <code class="text-xs bg-slate-800 px-1.5 py-0.5 rounded font-mono text-cyan-400">users</code> 
                                table structure (columns <code class="text-xs bg-slate-800 px-1.5 py-0.5 rounded font-mono text-cyan-400">two_factor_secret</code>, 
                                <code class="text-xs bg-slate-800 px-1.5 py-0.5 rounded font-mono text-cyan-400">remember_token</code>), 
                                this system is built on Laravel with Jetstream/Fortify auth scaffolding — highly relevant for testing cookie-based sessions and 2FA features.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- ===== USER STORIES ===== --}}
                <div class="mb-8 reveal">
                    <h4 class="text-lg font-bold text-slate-100 mb-4 flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-indigo-500/10 flex items-center justify-center">
                            <i data-lucide="user-check" class="w-4 h-4 text-indigo-400"></i>
                        </div>
                        User Stories
                    </h4>

                    {{-- Pelanggan --}}
                    <h5 class="text-sm font-semibold text-slate-300 mb-3 flex items-center gap-2">
                        <i data-lucide="user" class="w-3.5 h-3.5 text-pink-400"></i>
                        As a Customer
                    </h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-5">
                        <div class="glass-card p-4">
                            <span class="tag text-xs mb-2 inline-flex">US-P01</span>
                            <p class="text-sm text-slate-300 leading-relaxed">
                                <span class="text-indigo-400 font-medium">As a</span> customer,
                                I want to <span class="text-cyan-400 font-medium">register and login</span> 
                                so that I can access the reservation services.
                            </p>
                        </div>
                        <div class="glass-card p-4">
                            <span class="tag text-xs mb-2 inline-flex">US-P02</span>
                            <p class="text-sm text-slate-300 leading-relaxed">
                                <span class="text-indigo-400 font-medium">As a</span> customer,
                                I want to <span class="text-cyan-400 font-medium">view the service list</span> 
                                so that I can choose the desired treatment.
                            </p>
                        </div>
                        <div class="glass-card p-4">
                            <span class="tag text-xs mb-2 inline-flex">US-P03</span>
                            <p class="text-sm text-slate-300 leading-relaxed">
                                <span class="text-indigo-400 font-medium">As a</span> customer,
                                I want to <span class="text-cyan-400 font-medium">check my reservation history</span> 
                                so that I know my past bookings status.
                            </p>
                        </div>
                        <div class="glass-card p-4">
                            <span class="tag text-xs mb-2 inline-flex">US-P04</span>
                            <p class="text-sm text-slate-300 leading-relaxed">
                                <span class="text-indigo-400 font-medium">As a</span> customer,
                                I want to <span class="text-cyan-400 font-medium">select a service and time slot</span> 
                                so that my reservation fits my schedule.
                            </p>
                        </div>
                        <div class="glass-card p-4">
                            <span class="tag text-xs mb-2 inline-flex">US-P05</span>
                            <p class="text-sm text-slate-300 leading-relaxed">
                                <span class="text-indigo-400 font-medium">As a</span> customer,
                                I want to <span class="text-cyan-400 font-medium">pay a 50% down payment</span> 
                                so that my reservation is confirmed without full upfront payment.
                            </p>
                        </div>
                        <div class="glass-card p-4">
                            <span class="tag text-xs mb-2 inline-flex">US-P06</span>
                            <p class="text-sm text-slate-300 leading-relaxed">
                                <span class="text-indigo-400 font-medium">As a</span> customer,
                                I want to <span class="text-cyan-400 font-medium">check-in upon arrival at the salon</span> 
                                so that the admin knows I've arrived on time.
                            </p>
                        </div>
                        <div class="glass-card p-4 md:col-span-2">
                            <span class="tag text-xs mb-2 inline-flex">US-P07</span>
                            <p class="text-sm text-slate-300 leading-relaxed">
                                <span class="text-indigo-400 font-medium">As a</span> customer,
                                I want to <span class="text-cyan-400 font-medium">complete the final payment after the service is done</span> 
                                so that my transaction is settled.
                            </p>
                        </div>
                    </div>

                    {{-- Admin --}}
                    <h5 class="text-sm font-semibold text-slate-300 mb-3 flex items-center gap-2">
                        <i data-lucide="shield" class="w-3.5 h-3.5 text-violet-400"></i>
                        As an Admin
                    </h5>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div class="glass-card p-4">
                            <span class="tag text-xs mb-2 inline-flex" style="background: rgba(139, 92, 246, 0.1); color: #a78bfa; border-color: rgba(139, 92, 246, 0.2);">US-A01</span>
                            <p class="text-sm text-slate-300 leading-relaxed">
                                <span class="text-violet-400 font-medium">As an</span> admin,
                                I want to <span class="text-cyan-400 font-medium">verify down payments and final payments</span> 
                                so that no fraudulent transactions pass through.
                            </p>
                        </div>
                        <div class="glass-card p-4">
                            <span class="tag text-xs mb-2 inline-flex" style="background: rgba(139, 92, 246, 0.1); color: #a78bfa; border-color: rgba(139, 92, 246, 0.2);">US-A02</span>
                            <p class="text-sm text-slate-300 leading-relaxed">
                                <span class="text-violet-400 font-medium">As an</span> admin,
                                I want to <span class="text-cyan-400 font-medium">confirm customer arrivals</span> 
                                so that services are only provided to legitimate customers.
                            </p>
                        </div>
                        <div class="glass-card p-4">
                            <span class="tag text-xs mb-2 inline-flex" style="background: rgba(139, 92, 246, 0.1); color: #a78bfa; border-color: rgba(139, 92, 246, 0.2);">US-A03</span>
                            <p class="text-sm text-slate-300 leading-relaxed">
                                <span class="text-violet-400 font-medium">As an</span> admin,
                                I want to <span class="text-cyan-400 font-medium">view transaction reports</span> 
                                to monitor business performance.
                            </p>
                        </div>
                        <div class="glass-card p-4">
                            <span class="tag text-xs mb-2 inline-flex" style="background: rgba(139, 92, 246, 0.1); color: #a78bfa; border-color: rgba(139, 92, 246, 0.2);">US-A04</span>
                            <p class="text-sm text-slate-300 leading-relaxed">
                                <span class="text-violet-400 font-medium">As an</span> admin,
                                I want to <span class="text-cyan-400 font-medium">manage service data, time slots, and customer accounts</span> 
                                so that system information is always accurate.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- ===== USE CASE DIAGRAM ===== --}}
                <div class="mb-8 reveal">
                    <h4 class="text-lg font-bold text-slate-100 mb-4 flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-cyan-500/10 flex items-center justify-center">
                            <i data-lucide="git-branch" class="w-4 h-4 text-cyan-400"></i>
                        </div>
                        Use Case Diagram
                    </h4>
                    <div class="glass-card p-6 flex justify-center bg-slate-900/50">
                        <img src="{{ asset('images/usecase-diagram-aurora-beauty-salon.png') }}" alt="Use Case Diagram Aurora Beauty Salon" class="max-w-full rounded-lg shadow-lg border border-slate-700/50">
                    </div>
                </div>

                {{-- ===== ACTIVITY DIAGRAM ===== --}}
                <div class="mb-8 reveal">
                    <h4 class="text-lg font-bold text-slate-100 mb-4 flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-violet-500/10 flex items-center justify-center">
                            <i data-lucide="workflow" class="w-4 h-4 text-violet-400"></i>
                        </div>
                        Activity Diagram — Main Business Flow
                    </h4>
                    <div class="glass-card p-6 flex justify-center bg-slate-900/50">
                        <img src="{{ asset('images/activity-diagram-aurora-beauty-salon.png') }}" alt="Activity Diagram Aurora Beauty Salon" class="max-w-full rounded-lg shadow-lg border border-slate-700/50">
                    </div>
                    
                    <div class="glass-card p-4 mt-4" style="background: rgba(99, 102, 241, 0.05);">
                        <p class="text-xs text-slate-400 leading-relaxed">
                            <span class="text-indigo-400 font-medium">Employee Role Note:</span>
                            Employees do not appear as system actors in the Use Case Diagram (likely not accessing the system directly), 
                            but they play a crucial role in the real business process — preparing tools/materials and executing services. 
                            This is important for QA: validating that the "service provided" status in the system truly synchronizes with actual conditions on the ground.
                        </p>
                    </div>
                </div>

                {{-- ===== TEST CASES ===== --}}
                <div class="reveal">
                    <h4 class="text-lg font-bold text-slate-100 mb-4 flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-emerald-500/10 flex items-center justify-center">
                            <i data-lucide="list-checks" class="w-4 h-4 text-emerald-400"></i>
                        </div>
                        Test Cases
                    </h4>
                    <div class="glass-card overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="test-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Module</th>
                                        <th>Scenario</th>
                                        <th>Test Steps</th>
                                        <th>Expected Result</th>
                                        <th>Priority</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="font-mono text-indigo-400 whitespace-nowrap">TC-01</td>
                                        <td class="whitespace-nowrap">Registration</td>
                                        <td>Registration with valid data</td>
                                        <td>Fill valid registration form → submit</td>
                                        <td>Account successfully created, customer redirected to login</td>
                                        <td><span class="status-pass font-mono text-xs">High</span></td>
                                    </tr>
                                    <tr>
                                        <td class="font-mono text-indigo-400 whitespace-nowrap">TC-02</td>
                                        <td class="whitespace-nowrap">Registration</td>
                                        <td>Registration with incomplete data</td>
                                        <td>Leave mandatory field empty → submit</td>
                                        <td>Error message appears, data is not saved</td>
                                        <td><span class="status-pass font-mono text-xs">High</span></td>
                                    </tr>
                                    <tr>
                                        <td class="font-mono text-indigo-400 whitespace-nowrap">TC-03</td>
                                        <td class="whitespace-nowrap">Login</td>
                                        <td>Login with valid credentials</td>
                                        <td>Input valid email & password → click "Login"</td>
                                        <td>Redirected to customer dashboard</td>
                                        <td><span class="status-pass font-mono text-xs">High</span></td>
                                    </tr>
                                    <tr>
                                        <td class="font-mono text-indigo-400 whitespace-nowrap">TC-04</td>
                                        <td class="whitespace-nowrap">Login</td>
                                        <td>Login with invalid credentials</td>
                                        <td>Input invalid password → click "Login"</td>
                                        <td>Error message appears, stays on login page</td>
                                        <td><span class="status-pass font-mono text-xs">High</span></td>
                                    </tr>
                                    <tr>
                                        <td class="font-mono text-indigo-400 whitespace-nowrap">TC-05</td>
                                        <td class="whitespace-nowrap">Reservation</td>
                                        <td>Select available service & slot</td>
                                        <td>Select service → select empty slot → submit reservation</td>
                                        <td>Reservation recorded, confirmation notification sent</td>
                                        <td><span class="status-pass font-mono text-xs">High</span></td>
                                    </tr>
                                    <tr>
                                        <td class="font-mono text-indigo-400 whitespace-nowrap">TC-06</td>
                                        <td class="whitespace-nowrap">Reservation</td>
                                        <td>Select filled slot</td>
                                        <td>Attempt to select a full slot</td>
                                        <td>Slot unselectable / system rejects double booking</td>
                                        <td><span class="status-pass font-mono text-xs">High</span></td>
                                    </tr>
                                    <tr>
                                        <td class="font-mono text-indigo-400 whitespace-nowrap">TC-07</td>
                                        <td class="whitespace-nowrap">DP Payment</td>
                                        <td>Successful 50% DP payment</td>
                                        <td>Fill confirmation form → pay 50% DP</td>
                                        <td>System records payment, auto-confirmation sent</td>
                                        <td><span class="status-pass font-mono text-xs">High</span></td>
                                    </tr>
                                    <tr>
                                        <td class="font-mono text-indigo-400 whitespace-nowrap">TC-08</td>
                                        <td class="whitespace-nowrap">Verification</td>
                                        <td>Admin verifies DP</td>
                                        <td>Admin checks reservation & payment → validates transaction</td>
                                        <td>DP payment status changes to validated</td>
                                        <td><span class="status-pass font-mono text-xs">High</span></td>
                                    </tr>
                                    <tr>
                                        <td class="font-mono text-indigo-400 whitespace-nowrap">TC-09</td>
                                        <td class="whitespace-nowrap">Check-in</td>
                                        <td>Check-in & arrival confirmation</td>
                                        <td>Customer checks in → admin confirms arrival</td>
                                        <td>Reservation status updated, service allowed to begin</td>
                                        <td><span class="status-pending font-mono text-xs">Medium</span></td>
                                    </tr>
                                    <tr>
                                        <td class="font-mono text-indigo-400 whitespace-nowrap">TC-10</td>
                                        <td class="whitespace-nowrap">Final Payment</td>
                                        <td>Final payment after service completion</td>
                                        <td>Customer completes final payment</td>
                                        <td>System records final transaction, slot updated</td>
                                        <td><span class="status-pass font-mono text-xs">High</span></td>
                                    </tr>
                                    <tr>
                                        <td class="font-mono text-indigo-400 whitespace-nowrap">TC-11</td>
                                        <td class="whitespace-nowrap">Verification</td>
                                        <td>Admin verifies final payment</td>
                                        <td>Admin validates final payment transaction</td>
                                        <td>Final payment recorded as completed transaction</td>
                                        <td><span class="status-pass font-mono text-xs">High</span></td>
                                    </tr>
                                    <tr>
                                        <td class="font-mono text-indigo-400 whitespace-nowrap">TC-12</td>
                                        <td class="whitespace-nowrap">Reports</td>
                                        <td>Admin views transaction report</td>
                                        <td>Admin opens report menu → filters date</td>
                                        <td>Transaction table displays selected date range</td>
                                        <td><span class="status-pending font-mono text-xs">Medium</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- ===== PEMBELAJARAN & CATATAN QA ===== --}}
                <div class="mt-8 pt-6 border-t border-slate-700/50 reveal">
                    <h4 class="text-lg font-bold text-slate-100 mb-4 flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-amber-500/10 flex items-center justify-center">
                            <i data-lucide="lightbulb" class="w-4 h-4 text-amber-400"></i>
                        </div>
                        QA Learnings & Notes
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="glass-card p-5">
                            <div class="flex items-center gap-2 mb-3">
                                <i data-lucide="credit-card" class="w-4 h-4 text-cyan-400"></i>
                                <h5 class="text-sm font-bold text-slate-200">State Inconsistency</h5>
                            </div>
                            <p class="text-xs text-slate-400 leading-relaxed">
                                The two-stage payment flow (DP → Final) is prone to state inconsistency if admin verification is missed 
                                — crucial to ensure reservation status cannot "skip" to the next phase.
                            </p>
                        </div>
                        <div class="glass-card p-5">
                            <div class="flex items-center gap-2 mb-3">
                                <i data-lucide="users" class="w-4 h-4 text-violet-400"></i>
                                <h5 class="text-sm font-bold text-slate-200">Employee Involvement</h5>
                            </div>
                            <p class="text-xs text-slate-400 leading-relaxed">
                                Employees are not system actors, so validating "service provided" relies on manual admin/system input 
                                — a critical point worth testing with negative scenarios.
                            </p>
                        </div>
                        <div class="glass-card p-5">
                            <div class="flex items-center gap-2 mb-3">
                                <i data-lucide="git-pull-request" class="w-4 h-4 text-emerald-400"></i>
                                <h5 class="text-sm font-bold text-slate-200">Double Booking</h5>
                            </div>
                            <p class="text-xs text-slate-400 leading-relaxed">
                                Double booking prevention on time slots is a critical area, especially for concurrent request 
                                scenarios (two customers booking the same slot simultaneously).
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            {{-- End Case Study: Aurora Beauty Salon --}}

        </div>
    </div>
</section>
