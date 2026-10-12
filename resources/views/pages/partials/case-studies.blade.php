<div class="max-w-5xl mx-auto space-y-10">

    {{-- =====================================================================
         CASE STUDY 1: Aurora Beauty Salon
         ===================================================================== --}}
    <div class="glass-card p-6 sm:p-8 reveal">

        {{-- Case Study Header --}}
        <div class="flex flex-col sm:flex-row items-start gap-5 mb-6">
            <div class="flex-1">
                <div class="flex flex-wrap items-center gap-3 mb-2">
                    <span class="tag">
                        Academic Project
                    </span>
                    <span class="tag">
                        2025 - 2026
                    </span>
                </div>
                <h3 class="text-xl font-bold text-ink mb-2">
                    Sistem Reservasi Aurora Beauty Salon
                </h3>
                <p class="text-sm text-ink-2 leading-relaxed">
                    Web-based reservation information system with a two-stage transaction flow: 
                    <span class="font-semibold text-ink">50% down payment (DP)</span> upon booking, 
                    and <span class="font-semibold text-ink">final payment</span> after the service is completed. 
                    Each payment stage undergoes admin verification, and customers must check-in upon arrival 
                    at the salon before the service begins.
                </p>
            </div>
        </div>

        {{-- Technical Insight --}}
        <div class="glass-card p-5 mb-8 reveal">
            <div class="flex items-start gap-3">
                <div>
                    <p class="text-xs text-muted leading-relaxed">
                        <i data-lucide="cpu" class="w-3 h-3 inline mr-1"></i>
                        <span class="text-ink-2 font-medium">Technical Insight:</span>
                        Based on the <code class="text-xs bg-surface-2 px-1.5 py-0.5 rounded font-mono text-ink">users</code> 
                        table structure (columns <code class="text-xs bg-surface-2 px-1.5 py-0.5 rounded font-mono text-ink">two_factor_secret</code>, 
                        <code class="text-xs bg-surface-2 px-1.5 py-0.5 rounded font-mono text-ink">remember_token</code>), 
                        this system is built on Laravel with Jetstream/Fortify auth scaffolding, which is highly relevant for testing cookie-based sessions and 2FA features.
                    </p>
                </div>
            </div>
        </div>

        {{-- ===== USER STORIES ===== --}}
        <div class="mb-8 reveal">
            <h4 class="text-lg font-bold text-ink mb-4 flex items-center gap-2">
                User Stories
            </h4>

            <h5 class="text-sm font-semibold text-ink-2 mb-3 flex items-center gap-2">As a Customer
            </h5>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-5">
                <div class="glass-card p-4">
                    <span class="tag text-xs mb-2 inline-flex">US-P01</span>
                    <p class="text-sm text-ink-2 leading-relaxed">
                        <span class="font-semibold text-ink">As a</span> customer,
                        I want to <span class="font-semibold text-ink">register and login</span> 
                        so that I can access the reservation services.
                    </p>
                </div>
                <div class="glass-card p-4">
                    <span class="tag text-xs mb-2 inline-flex">US-P02</span>
                    <p class="text-sm text-ink-2 leading-relaxed">
                        <span class="font-semibold text-ink">As a</span> customer,
                        I want to <span class="font-semibold text-ink">view the service list</span> 
                        so that I can choose the desired treatment.
                    </p>
                </div>
                <div class="glass-card p-4">
                    <span class="tag text-xs mb-2 inline-flex">US-P03</span>
                    <p class="text-sm text-ink-2 leading-relaxed">
                        <span class="font-semibold text-ink">As a</span> customer,
                        I want to <span class="font-semibold text-ink">check my reservation history</span> 
                        so that I know my past bookings status.
                    </p>
                </div>
                <div class="glass-card p-4">
                    <span class="tag text-xs mb-2 inline-flex">US-P04</span>
                    <p class="text-sm text-ink-2 leading-relaxed">
                        <span class="font-semibold text-ink">As a</span> customer,
                        I want to <span class="font-semibold text-ink">select a service and time slot</span> 
                        so that my reservation fits my schedule.
                    </p>
                </div>
                <div class="glass-card p-4">
                    <span class="tag text-xs mb-2 inline-flex">US-P05</span>
                    <p class="text-sm text-ink-2 leading-relaxed">
                        <span class="font-semibold text-ink">As a</span> customer,
                        I want to <span class="font-semibold text-ink">pay a 50% down payment</span> 
                        so that my reservation is confirmed without full upfront payment.
                    </p>
                </div>
                <div class="glass-card p-4">
                    <span class="tag text-xs mb-2 inline-flex">US-P06</span>
                    <p class="text-sm text-ink-2 leading-relaxed">
                        <span class="font-semibold text-ink">As a</span> customer,
                        I want to <span class="font-semibold text-ink">check-in upon arrival at the salon</span> 
                        so that the admin knows I've arrived on time.
                    </p>
                </div>
                <div class="glass-card p-4 md:col-span-2">
                    <span class="tag text-xs mb-2 inline-flex">US-P07</span>
                    <p class="text-sm text-ink-2 leading-relaxed">
                        <span class="font-semibold text-ink">As a</span> customer,
                        I want to <span class="font-semibold text-ink">complete the final payment after the service is done</span> 
                        so that my transaction is settled.
                    </p>
                </div>
            </div>

            <h5 class="text-sm font-semibold text-ink-2 mb-3 flex items-center gap-2">As an Admin
            </h5>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div class="glass-card p-4">
                    <span class="tag text-xs mb-2 inline-flex">US-A01</span>
                    <p class="text-sm text-ink-2 leading-relaxed">
                        <span class="font-semibold text-ink">As an</span> admin,
                        I want to <span class="font-semibold text-ink">verify down payments and final payments</span> 
                        so that no fraudulent transactions pass through.
                    </p>
                </div>
                <div class="glass-card p-4">
                    <span class="tag text-xs mb-2 inline-flex">US-A02</span>
                    <p class="text-sm text-ink-2 leading-relaxed">
                        <span class="font-semibold text-ink">As an</span> admin,
                        I want to <span class="font-semibold text-ink">confirm customer arrivals</span> 
                        so that services are only provided to legitimate customers.
                    </p>
                </div>
                <div class="glass-card p-4">
                    <span class="tag text-xs mb-2 inline-flex">US-A03</span>
                    <p class="text-sm text-ink-2 leading-relaxed">
                        <span class="font-semibold text-ink">As an</span> admin,
                        I want to <span class="font-semibold text-ink">view transaction reports</span> 
                        to monitor business performance.
                    </p>
                </div>
                <div class="glass-card p-4">
                    <span class="tag text-xs mb-2 inline-flex">US-A04</span>
                    <p class="text-sm text-ink-2 leading-relaxed">
                        <span class="font-semibold text-ink">As an</span> admin,
                        I want to <span class="font-semibold text-ink">manage service data, time slots, and customer accounts</span> 
                        so that system information is always accurate.
                    </p>
                </div>
            </div>
        </div>

        {{-- ===== DIAGRAMS ===== --}}
        <div class="mb-8 reveal">
            <h4 class="text-lg font-bold text-ink mb-4 flex items-center gap-2">
                Use Case Diagram
            </h4>
            <div class="glass-card p-6 flex justify-center bg-surface-2">
                <img src="{{ asset('images/usecase-diagram-aurora-beauty-salon.png') }}" alt="Use Case Diagram Aurora Beauty Salon" loading="lazy" decoding="async" class="max-w-full rounded-lg border border-line">
            </div>
        </div>

        <div class="mb-8 reveal">
            <h4 class="text-lg font-bold text-ink mb-4 flex items-center gap-2">
                Activity Diagram: Main Business Flow
            </h4>
            <div class="glass-card p-6 flex justify-center bg-surface-2">
                <img src="{{ asset('images/activity-diagram-aurora-beauty-salon.png') }}" alt="Activity Diagram Aurora Beauty Salon" loading="lazy" decoding="async" class="max-w-full rounded-lg border border-line">
            </div>
            <div class="glass-card p-4 mt-4">
                <p class="text-xs text-ink-2 leading-relaxed">
                    <span class="font-semibold text-ink">Employee Role Note:</span>
                    Employees do not appear as system actors in the Use Case Diagram (likely not accessing the system directly), 
                    but they play a crucial role in the real business process: preparing tools/materials and executing services. 
                    This is important for QA: validating that the "service provided" status in the system truly synchronizes with actual conditions on the ground.
                </p>
            </div>
        </div>

        {{-- ===== MANUAL TESTING: AURORA ===== --}}
        <div class="mb-8 reveal">
            <h4 class="text-lg font-bold text-ink mb-4 flex items-center gap-2">
                Manual Testing: Black Box Testing
            </h4>

            {{-- Stats --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-6">
                <div class="glass-card p-4 text-center">
                    <div class="text-2xl font-bold text-accent">49</div>
                    <div class="text-xs text-ink-2 mt-1">Test Cases</div>
                </div>
                <div class="glass-card p-4 text-center">
                    <div class="text-2xl font-bold text-good">100%</div>
                    <div class="text-xs text-ink-2 mt-1">Pass Rate</div>
                </div>
                <div class="glass-card p-4 text-center">
                    <div class="text-2xl font-bold text-accent">3</div>
                    <div class="text-xs text-ink-2 mt-1">Modules</div>
                </div>
                <div class="glass-card p-4 text-center">
                    <div class="text-2xl font-bold text-accent">5</div>
                    <div class="text-xs text-ink-2 mt-1">Testers</div>
                </div>
            </div>

            {{-- Tester Response Recap --}}
            <div class="glass-card overflow-hidden mb-4">
                <div class="overflow-x-auto">
                    <table class="test-table">
                        <thead>
                            <tr>
                                <th>Module</th>
                                <th>Scenarios</th>
                                <th>Match (Sesuai)</th>
                                <th>Not Match</th>
                                <th>Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-medium text-ink">A. Authentication & Security</td>
                                <td class="text-center">13</td>
                                <td class="text-center text-good">13 × 5 = 65</td>
                                <td class="text-center">0</td>
                                <td class="text-center"><span class="status-pass font-mono text-xs">100%</span></td>
                            </tr>
                            <tr>
                                <td class="font-medium text-ink">B. Admin</td>
                                <td class="text-center">18</td>
                                <td class="text-center text-good">18 × 5 = 90</td>
                                <td class="text-center">0</td>
                                <td class="text-center"><span class="status-pass font-mono text-xs">100%</span></td>
                            </tr>
                            <tr>
                                <td class="font-medium text-ink">C. Customer</td>
                                <td class="text-center">18</td>
                                <td class="text-center text-good">18 × 5 = 90</td>
                                <td class="text-center">0</td>
                                <td class="text-center"><span class="status-pass font-mono text-xs">100%</span></td>
                            </tr>
                            <tr class="border-t-2 border-line">
                                <td class="font-bold text-ink">TOTAL</td>
                                <td class="text-center font-bold text-ink">49</td>
                                <td class="text-center font-bold text-good">245</td>
                                <td class="text-center font-bold">0</td>
                                <td class="text-center"><span class="status-pass font-mono text-xs font-bold">100%</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="glass-card p-3 mb-6">
                <p class="text-xs text-ink-2 text-center">
                    <i data-lucide="check-circle" class="w-3 h-3 inline mr-1 text-good"></i>
                    System declared <span class="text-good font-bold">Valid for Implementation</span>: 100% scenarios matched across all modules
                </p>
            </div>

            {{-- Sample Test Cases --}}
            <h5 class="text-sm font-semibold text-ink-2 mb-3 flex items-center gap-2">Sample Test Cases (Authentication Module)
            </h5>
            <div class="glass-card overflow-hidden mb-4">
                <div class="overflow-x-auto">
                    <table class="test-table">
                        <thead>
                            <tr>
                                <th>Ref</th>
                                <th>Step by Step</th>
                                <th>Expected Result</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-mono text-accent whitespace-nowrap">1</td>
                                <td>Customer Registration (Valid & Verified): Fill complete form > Submit</td>
                                <td>"Email Verifikasi Terkirim" notification appears & user receives verification email</td>
                                <td><span class="status-pass font-mono text-xs">PASS</span></td>
                            </tr>
                            <tr>
                                <td class="font-mono text-accent whitespace-nowrap">2</td>
                                <td>Customer Registration (Duplicate Email): Register with an already-used email</td>
                                <td>System rejects registration and shows "Email sudah terdaftar" message</td>
                                <td><span class="status-pass font-mono text-xs">PASS</span></td>
                            </tr>
                            <tr>
                                <td class="font-mono text-accent whitespace-nowrap">3</td>
                                <td>Customer Login (Valid Credentials): Enter valid email & password > Click login</td>
                                <td>Redirected to customer dashboard</td>
                                <td><span class="status-pass font-mono text-xs">PASS</span></td>
                            </tr>
                            <tr>
                                <td class="font-mono text-accent whitespace-nowrap">4</td>
                                <td>Customer Login (Invalid Password): Enter valid email with wrong password</td>
                                <td>Error message displayed, stays on login page</td>
                                <td><span class="status-pass font-mono text-xs">PASS</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <a href="{{ asset('docs/Test_Case-Aurora_Beauty_Salon_System.xlsx') }}" download class="btn-primary text-xs py-2.5 px-4 inline-flex">
                <i data-lucide="download" class="w-3.5 h-3.5"></i>
                Download Full Test Case (XLSX)
            </a>
        </div>

        {{-- ===== AUTOMATION TESTING: AURORA ===== --}}
        <div class="mb-8 reveal">
            <h4 class="text-lg font-bold text-ink mb-4 flex items-center gap-2">
                Automation Testing: Playwright + Page Object Model
            </h4>
            <p class="text-sm text-ink-2 leading-relaxed mb-4">
                E2E automation covering the <span class="font-semibold text-ink">Main Menu flow</span>
                (guest/customer navigation, language switcher, profile sidebar panel, AJAX-driven Home page)
                plus <span class="font-semibold text-ink">Registration, Login, and a full
                Booking > Payment flow</span> against a real Midtrans Sandbox integration. Built with
                Playwright using the Page Object Model pattern and a dedicated, idempotent test account
                so runs never touch real customer data.
            </p>

            {{-- Stats --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-6">
                <div class="glass-card p-4 text-center">
                    <div class="text-2xl font-bold text-accent">51</div>
                    <div class="text-xs text-ink-2 mt-1">Test Cases</div>
                </div>
                <div class="glass-card p-4 text-center">
                    <div class="text-2xl font-bold text-good">11</div>
                    <div class="text-xs text-ink-2 mt-1">Scenario Groups</div>
                </div>
                <div class="glass-card p-4 text-center">
                    <div class="text-2xl font-bold text-accent">3</div>
                    <div class="text-xs text-ink-2 mt-1">New Flows: Register, Login, Booking+Pay</div>
                </div>
                <div class="glass-card p-4 text-center">
                    <div class="text-2xl font-bold text-accent">Real</div>
                    <div class="text-xs text-ink-2 mt-1">Midtrans Sandbox Integration</div>
                </div>
            </div>

            {{-- Coverage by group --}}
            <div class="glass-card overflow-hidden mb-6">
                <div class="overflow-x-auto">
                    <table class="test-table">
                        <thead>
                            <tr>
                                <th>Group</th>
                                <th>Focus</th>
                                <th>Tests</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-mono text-accent">A</td>
                                <td>Main menu navigation (guest)</td>
                                <td class="text-center">5</td>
                            </tr>
                            <tr>
                                <td class="font-mono text-accent">B</td>
                                <td>Language switcher (ID/EN)</td>
                                <td class="text-center">6</td>
                            </tr>
                            <tr>
                                <td class="font-mono text-accent">C</td>
                                <td>Guest vs. logged-in customer state</td>
                                <td class="text-center">4</td>
                            </tr>
                            <tr>
                                <td class="font-mono text-accent">D</td>
                                <td>Profile sidebar panel & logout confirmation</td>
                                <td class="text-center">10</td>
                            </tr>
                            <tr>
                                <td class="font-mono text-accent">E</td>
                                <td>Service search (autocomplete)</td>
                                <td class="text-center">8</td>
                            </tr>
                            <tr>
                                <td class="font-mono text-accent">F</td>
                                <td>Service category grid (AJAX)</td>
                                <td class="text-center">3</td>
                            </tr>
                            <tr>
                                <td class="font-mono text-accent">G</td>
                                <td>"Experience" gallery (AJAX)</td>
                                <td class="text-center">1</td>
                            </tr>
                            <tr>
                                <td class="font-mono text-accent">H</td>
                                <td>Recommendation carousel (AJAX)</td>
                                <td class="text-center">3</td>
                            </tr>
                            <tr>
                                <td class="font-mono text-accent">I</td>
                                <td>Customer registration (real form + validation)</td>
                                <td class="text-center">5</td>
                            </tr>
                            <tr>
                                <td class="font-mono text-accent">J</td>
                                <td>Customer login (valid/invalid credentials, unverified account)</td>
                                <td class="text-center">4</td>
                            </tr>
                            <tr>
                                <td class="font-mono text-accent">K</td>
                                <td>End-to-end: register > verify > login > book > pay (Midtrans Sandbox) > history</td>
                                <td class="text-center">2</td>
                            </tr>
                            <tr class="border-t-2 border-line">
                                <td class="font-bold text-ink" colspan="2">TOTAL</td>
                                <td class="text-center font-bold text-good">51</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Approach callout --}}
            <div class="glass-card p-5 mb-6">
                <div class="flex items-start gap-3">
                    <div class="text-xs text-ink-2 leading-relaxed space-y-1.5">
                        <p><span class="font-semibold text-ink">Page Object Model</span>: every locator lives once in <code class="text-xs bg-surface-2 px-1.5 py-0.5 rounded font-mono text-ink">pages/</code>, reused across all test files.</p>
                        <p><span class="font-semibold text-ink">Reused login session</span>: customer login runs once in <code class="text-xs bg-surface-2 px-1.5 py-0.5 rounded font-mono text-ink">auth.setup.js</code>, saved as Playwright <code class="text-xs bg-surface-2 px-1.5 py-0.5 rounded font-mono text-ink">storageState</code> and reused by every test that needs an authenticated customer.</p>
                        <p><span class="font-semibold text-ink">Isolated test data</span>: a dedicated, idempotent customer account is seeded via a PHP script that never touches real customer rows.</p>
                        <p><span class="font-semibold text-ink">DOM-based assertions</span>: checks like "grid finished loading" assert on element structure/count, not on placeholder text, so tests don't break when the active language changes.</p>
                        <p><span class="font-semibold text-ink">Self-cleaning test data</span>: registration and full-flow tests create a uniquely-emailed account per run and delete it in <code class="text-xs bg-surface-2 px-1.5 py-0.5 rounded font-mono text-ink">afterEach</code> via a small PHP helper, so the dev database never accumulates leftover test accounts.</p>
                    </div>
                </div>
            </div>

            {{-- Code: Page Object --}}
            <div class="mb-4">
                <h5 class="text-sm font-semibold text-ink-2 mb-3 flex items-center gap-2">Page Object: Main Menu
                </h5>
                <div class="code-block">
                    <div class="code-block-header">
                        <div class="code-block-dots">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <span class="text-xs text-muted font-mono">e2e/pages/MainMenuPage.js</span>
                    </div>
                    <div class="code-block-body"><span class="code-keyword">import</span> { expect } <span class="code-keyword">from</span> <span class="code-string">'@playwright/test'</span>;

<span class="code-comment">// Page Object untuk komponen nav-pelanggan.blade.php yang tampil</span>
<span class="code-comment">// di seluruh halaman publik (Beranda, Tentang Kami, Hubungi Kami).</span>
<span class="code-keyword">export</span> <span class="code-keyword">class</span> <span class="code-class">MainMenuPage</span> {
  <span class="code-func">constructor</span>(<span class="code-param">page</span>) {
    <span class="code-keyword">this</span>.page = page;
    <span class="code-keyword">this</span>.nav = page.<span class="code-func">locator</span>(<span class="code-string">'nav'</span>).<span class="code-func">first</span>();

    <span class="code-comment">// Tiga link utama (dropdown bahasa dikecualikan, ia berupa &lt;button&gt;).</span>
    <span class="code-keyword">this</span>.navLinks = <span class="code-keyword">this</span>.nav.<span class="code-func">locator</span>(<span class="code-string">'.nav-links > li:not(.language-dropdown) > a'</span>);

    <span class="code-comment">// Tombol kanan berbeda antara state guest dan login.</span>
    <span class="code-keyword">this</span>.navButtons = <span class="code-keyword">this</span>.nav.<span class="code-func">locator</span>(<span class="code-string">'.nav-buttons'</span>);
    <span class="code-keyword">this</span>.signInButton = <span class="code-keyword">this</span>.navButtons.<span class="code-func">locator</span>(<span class="code-string">'a.btn-login'</span>);
    <span class="code-keyword">this</span>.profileButton = <span class="code-keyword">this</span>.navButtons.<span class="code-func">locator</span>(<span class="code-string">'button.profile-btn'</span>);

    <span class="code-comment">// Panel profil (sidebar) + dialog konfirmasi logout (SweetAlert2).</span>
    <span class="code-keyword">this</span>.profilePanel = page.<span class="code-func">locator</span>(<span class="code-string">'#profileDropdown'</span>);
    <span class="code-keyword">this</span>.logoutConfirmButton = page.<span class="code-func">locator</span>(<span class="code-string">'.swal2-confirm'</span>);
  }

  <span class="code-comment">/** Buka dropdown bahasa lalu pilih locale ('id' atau 'en'). */</span>
  <span class="code-keyword">async</span> <span class="code-func">switchLanguage</span>(<span class="code-param">locale</span>) {
    <span class="code-keyword">await</span> <span class="code-keyword">this</span>.languageButton.<span class="code-func">click</span>();
    <span class="code-keyword">await</span> <span class="code-func">expect</span>(<span class="code-keyword">this</span>.languageDropdown).<span class="code-func">toHaveClass</span>(<span class="code-param">/active/</span>);

    <span class="code-keyword">const</span> option = locale === <span class="code-string">'id'</span> ? <span class="code-keyword">this</span>.languageOptionId : <span class="code-keyword">this</span>.languageOptionEn;
    <span class="code-keyword">await</span> option.<span class="code-func">click</span>();
    <span class="code-keyword">await</span> <span class="code-keyword">this</span>.page.<span class="code-func">waitForLoadState</span>(<span class="code-string">'domcontentloaded'</span>);
  }
}</div>
                </div>
            </div>

            {{-- Code: Search autocomplete test --}}
            <div class="mb-6">
                <h5 class="text-sm font-semibold text-ink-2 mb-3 flex items-center gap-2">Test: Service Search Autocomplete (Debounce Edge Case)
                </h5>
                <div class="code-block">
                    <div class="code-block-header">
                        <div class="code-block-dots">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <span class="text-xs text-muted font-mono">e2e/ui/home-search-ui.e2e.test.js</span>
                    </div>
                    <div class="code-block-body"><span class="code-keyword">import</span> { expect, test } <span class="code-keyword">from</span> <span class="code-string">'@playwright/test'</span>;
<span class="code-keyword">import</span> { HomePage } <span class="code-keyword">from</span> <span class="code-string">'../pages/HomePage.js'</span>;

<span class="code-comment">// Autocomplete memanggil GET /layanan/search dengan debounce 400ms dan</span>
<span class="code-comment">// baru menembak request bila keyword minimal 2 karakter.</span>
<span class="code-func">test</span>(<span class="code-string">'should tidak memanggil API pencarian when keyword kurang dari 2 karakter'</span>, <span class="code-keyword">async</span> ({ <span class="code-param">page</span> }) => {
  <span class="code-keyword">const</span> home = <span class="code-keyword">new</span> <span class="code-class">HomePage</span>(page);
  <span class="code-keyword">const</span> searchRequests = [];
  page.<span class="code-func">on</span>(<span class="code-string">'request'</span>, (<span class="code-param">request</span>) => {
    <span class="code-keyword">if</span> (request.<span class="code-func">url</span>().<span class="code-func">includes</span>(<span class="code-string">'/layanan/search'</span>)) searchRequests.<span class="code-func">push</span>(request.<span class="code-func">url</span>());
  });

  <span class="code-keyword">await</span> home.<span class="code-func">goto</span>();
  <span class="code-keyword">await</span> home.<span class="code-func">typeSearchKeyword</span>(<span class="code-string">'F'</span>);
  <span class="code-keyword">await</span> page.<span class="code-func">waitForTimeout</span>(<span class="code-param">900</span>); <span class="code-comment">// lewati jendela debounce 400ms</span>

  <span class="code-func">expect</span>(searchRequests, <span class="code-string">'keyword 1 karakter tidak boleh memicu request'</span>).<span class="code-func">toHaveLength</span>(<span class="code-param">0</span>);
  <span class="code-keyword">await</span> <span class="code-func">expect</span>(home.searchSuggestions).<span class="code-func">toBeHidden</span>();
});</div>
                </div>
            </div>

            {{-- Extended coverage: booking + payment --}}
            <div class="glass-card p-5 mb-6">
                <div class="flex items-start gap-3">
                    <div class="text-xs text-ink-2 leading-relaxed space-y-1.5">
                        <p class="text-ink-2 font-medium">Newest coverage: full Booking > Payment E2E (Group K)</p>
                        <p>The suite now drives the entire funnel with a single, disposable test account:
                        <span class="font-semibold text-ink">register > verify email (via DB) > login > pick a
                        category & service > choose a schedule > checkout > pay > success page > booking history</span>,
                        asserting the final reservation shows up as <code class="text-xs bg-surface-2 px-1.5 py-0.5 rounded font-mono text-ink">is_lunas: true</code>.</p>
                        <p><span class="font-semibold text-ink">Payment strategy:</span> the app's Midtrans integration runs on real
                        sandbox credentials. The test captures the Snap token from the app's own
                        <code class="text-xs bg-surface-2 px-1.5 py-0.5 rounded font-mono text-ink">/booking/midtrans/proses</code> endpoint, waits for the
                        genuine Snap iframe to open and asserts it's served from <code class="text-xs bg-surface-2 px-1.5 py-0.5 rounded font-mono text-ink">sandbox.midtrans.com</code>
                        (proving the integration is really wired up), then completes the transaction by calling
                        <code class="text-xs bg-surface-2 px-1.5 py-0.5 rounded font-mono text-ink">/booking/midtrans/callback</code> directly, the same endpoint Snap.js's
                        own success callback calls in production. Snap's payment-method UI is a third-party
                        widget that renders non-deterministically between runs, so this still exercises the
                        app's real backend logic (validation, status update, response) without depending on
                        a flaky third-party UI.</p>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h5 class="text-sm font-semibold text-ink-2 mb-3 flex items-center gap-2">Test: Booking > Payment E2E (Midtrans Sandbox)
                </h5>
                <div class="code-block">
                    <div class="code-block-header">
                        <div class="code-block-dots">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <span class="text-xs text-muted font-mono">e2e/ui/booking-payment-flow-ui.e2e.test.js</span>
                    </div>
                    <div class="code-block-body"><span class="code-func">test</span>(<span class="code-string">'should mendaftar akun baru, login, booking layanan, bayar lunas, dan tercatat di riwayat'</span>, <span class="code-keyword">async</span> ({ <span class="code-param">page</span> }) => {
  test.<span class="code-func">setTimeout</span>(<span class="code-param">120_000</span>); <span class="code-comment">// registrasi kirim email asli + menunggu popup Snap sandbox</span>

  <span class="code-keyword">await</span> test.<span class="code-func">step</span>(<span class="code-string">'Pilih Bayar Penuh, klik bayar, dan tangkap Snap token dari endpoint asli'</span>, <span class="code-keyword">async</span> () => {
    <span class="code-keyword">await</span> booking.<span class="code-func">selectFullPayment</span>();
    <span class="code-keyword">const</span> proses = <span class="code-keyword">await</span> booking.<span class="code-func">submitPaymentAndCaptureToken</span>();
    <span class="code-func">expect</span>(proses.success).<span class="code-func">toBe</span>(<span class="code-param">true</span>);
    tokenData = proses.token;
  });

  <span class="code-keyword">await</span> test.<span class="code-func">step</span>(<span class="code-string">'Verifikasi popup Snap Midtrans sandbox benar-benar terbuka (integrasi nyata)'</span>, <span class="code-keyword">async</span> () => {
    <span class="code-keyword">const</span> snapFrame = <span class="code-keyword">await</span> booking.<span class="code-func">waitForSnapPopup</span>();
    <span class="code-func">expect</span>(snapFrame.<span class="code-func">url</span>()).<span class="code-func">toContain</span>(<span class="code-string">'sandbox.midtrans.com'</span>);
  });

  <span class="code-keyword">await</span> test.<span class="code-func">step</span>(<span class="code-string">'Selesaikan pembayaran lewat endpoint callback asli'</span>, <span class="code-keyword">async</span> () => {
    settlement = <span class="code-keyword">await</span> booking.<span class="code-func">simulatePaymentSettlement</span>(tokenData);
    <span class="code-func">expect</span>(settlement.status).<span class="code-func">toBe</span>(<span class="code-string">'paid'</span>);
  });

  <span class="code-keyword">await</span> test.<span class="code-func">step</span>(<span class="code-string">'Verifikasi riwayat booking menampilkan reservasi dengan status LUNAS'</span>, <span class="code-keyword">async</span> () => {
    <span class="code-keyword">const</span> historyJson = <span class="code-keyword">await</span> history.<span class="code-func">gotoAndCaptureList</span>();
    <span class="code-keyword">const</span> row = <span class="code-class">BookingHistoryPage</span>.<span class="code-func">findReservasi</span>(historyJson, settlement.reservasi_ids[<span class="code-param">0</span>]);
    <span class="code-func">expect</span>(row.is_lunas).<span class="code-func">toBe</span>(<span class="code-param">true</span>);
  });
});</div>
                </div>
            </div>

            {{-- QA finding note --}}
            <div class="glass-card p-5 mb-6">
                <div class="flex items-start gap-3">
                    <div>
                        <p class="text-xs text-muted leading-relaxed">
                            <span class="text-ink-2 font-medium">Finding: test assumption vs. product bug:</span>
                            on the first run, 2 of 41 tests failed. Investigation showed
                            <code class="text-xs bg-surface-2 px-1.5 py-0.5 rounded font-mono text-ink">config/app.php</code>
                            hardcodes <code class="text-xs bg-surface-2 px-1.5 py-0.5 rounded font-mono text-ink">'locale' => 'id'</code>
                            instead of reading <code class="text-xs bg-surface-2 px-1.5 py-0.5 rounded font-mono text-ink">env('APP_LOCALE')</code>,
                            so the app always defaults to Indonesian regardless of <code class="text-xs bg-surface-2 px-1.5 py-0.5 rounded font-mono text-ink">.env</code>.
                            The app's own behavior was consistent. Only my test's expectation was wrong. Fixed on the test
                            side with a single <code class="text-xs bg-surface-2 px-1.5 py-0.5 rounded font-mono text-ink">DEFAULT_LOCALE</code>
                            constant, without touching application code, and reported the distinction explicitly.
                        </p>
                    </div>
                </div>
            </div>

            <a href="https://github.com/jeremiawerung/Automation-testing-Aurora-Beauty-Salon-Web.git" target="_blank" rel="noopener" class="btn-primary text-xs py-2.5 px-4 inline-flex">
                <x-icon-github class="w-3.5 h-3.5" />
                View Full Automation Testing Report (GitHub)
            </a>
        </div>

        {{-- ===== QA LEARNINGS ===== --}}
        <div class="pt-6 border-t border-line reveal">
            <h4 class="text-lg font-bold text-ink mb-4 flex items-center gap-2">
                QA Learnings & Notes
            </h4>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="glass-card p-5">
                    <div class="flex items-center gap-2 mb-3">
                        <h5 class="text-sm font-bold text-ink">State Inconsistency</h5>
                    </div>
                    <p class="text-xs text-ink-2 leading-relaxed">
                        The two-stage payment flow (DP > Final) is prone to state inconsistency if admin verification is missed.
                        That is crucial to ensure reservation status cannot "skip" to the next phase.
                    </p>
                </div>
                <div class="glass-card p-5">
                    <div class="flex items-center gap-2 mb-3">
                        <h5 class="text-sm font-bold text-ink">Employee Involvement</h5>
                    </div>
                    <p class="text-xs text-ink-2 leading-relaxed">
                        Employees are not system actors, so validating "service provided" relies on manual admin/system input,
                        which is a critical point worth testing with negative scenarios.
                    </p>
                </div>
                <div class="glass-card p-5">
                    <div class="flex items-center gap-2 mb-3">
                        <h5 class="text-sm font-bold text-ink">Double Booking</h5>
                    </div>
                    <p class="text-xs text-ink-2 leading-relaxed">
                        Double booking prevention on time slots is a critical area, especially for concurrent request 
                        scenarios (two customers booking the same slot simultaneously).
                    </p>
                </div>
            </div>
        </div>

    </div>
    {{-- End Case Study 1: Aurora Beauty Salon --}}


    {{-- =====================================================================
         CASE STUDY 2: Task Module: Test Case & Bug Report
         ===================================================================== --}}
    <div class="glass-card p-6 sm:p-8 reveal">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row items-start gap-5 mb-6">
            <div class="flex-1">
                <div class="flex flex-wrap items-center gap-3 mb-2">
                    <span class="tag">
                        QA Assessment
                    </span>
                    <span class="tag">
                        February 2026
                    </span>
                </div>
                <h3 class="text-xl font-bold text-ink mb-2">
                    Task Module: Manual Testing & Bug Report
                </h3>
                <p class="text-sm text-ink-2 leading-relaxed">
                    QA testing on a Task management module covering CRUD operations, form validation,
                    notification systems, and filter functionality. Discovered
                    <span class="text-bad font-medium">15 bugs</span> including
                    <span class="text-bad font-medium">2 Major</span> severity issues,
                    with detailed bug reports for each finding.
                </p>
            </div>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-6">
            <div class="glass-card p-4 text-center">
                <div class="text-2xl font-bold text-accent">161</div>
                <div class="text-xs text-ink-2 mt-1">Test Steps</div>
            </div>
            <div class="glass-card p-4 text-center">
                <div class="text-2xl font-bold text-bad">15</div>
                <div class="text-xs text-ink-2 mt-1">Bugs Found</div>
            </div>
            <div class="glass-card p-4 text-center">
                <div class="text-2xl font-bold text-warn">2</div>
                <div class="text-xs text-ink-2 mt-1">Major Bugs</div>
            </div>
            <div class="glass-card p-4 text-center">
                <div class="text-2xl font-bold text-accent">11 min</div>
                <div class="text-xs text-ink-2 mt-1">Execution Time</div>
            </div>
        </div>

        {{-- Sample Test Cases --}}
        <div class="mb-6 reveal">
            <h4 class="text-sm font-semibold text-ink-2 mb-3 flex items-center gap-2">Sample Test Cases (Task Module)
            </h4>
            <div class="glass-card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="test-table">
                        <thead>
                            <tr>
                                <th>Ref</th>
                                <th>Step by Step</th>
                                <th>Expected Result</th>
                                <th>Actual Result</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-mono text-accent whitespace-nowrap">1</td>
                                <td>Login to platform as Operator</td>
                                <td>Successfully login using credential provided</td>
                                <td>Successfully login using credential provided</td>
                                <td><span class="status-pass font-mono text-xs">PASS</span></td>
                            </tr>
                            <tr>
                                <td class="font-mono text-accent whitespace-nowrap">2</td>
                                <td>Check if Task menu exists on the menu list</td>
                                <td>Task menu is between Student and Mailbox menu</td>
                                <td>Task menu is between Companies and Mailbox menu</td>
                                <td><span class="status-na font-mono text-xs">N/A</span></td>
                            </tr>
                            <tr>
                                <td class="font-mono text-accent whitespace-nowrap">2</td>
                                <td>Verify menu label in both languages (EN/FR)</td>
                                <td>[EN] Tasks, [FR] Tache</td>
                                <td>[EN] Tasks, [FR] Taches</td>
                                <td><span class="status-warning font-mono text-xs">WARNING</span></td>
                            </tr>
                            <tr>
                                <td class="font-mono text-accent whitespace-nowrap">3</td>
                                <td>Navigate to Task menu and check table display</td>
                                <td>List of Task table displayed once clicked</td>
                                <td>List of Task table displayed once clicked</td>
                                <td><span class="status-pass font-mono text-xs">PASS</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Bug Report Highlights --}}
        <div class="mb-6 reveal">
            <h4 class="text-sm font-semibold text-ink-2 mb-3 flex items-center gap-2">Bug Report Highlights
            </h4>
            <div class="glass-card overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="test-table">
                        <thead>
                            <tr>
                                <th>Bug ID</th>
                                <th>Module</th>
                                <th>Severity</th>
                                <th>Summary</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="font-mono text-bad whitespace-nowrap">BUG_004</td>
                                <td class="whitespace-nowrap">Task - Notification</td>
                                <td><span class="px-2 py-0.5 rounded text-xs font-bold bg-bad-soft text-bad border border-bad">Major</span></td>
                                <td>TASK_N5 notification not received: task assignment notification never delivered</td>
                            </tr>
                            <tr>
                                <td class="font-mono text-bad whitespace-nowrap">BUG_014</td>
                                <td class="whitespace-nowrap">Task - Detail Pop-up</td>
                                <td><span class="px-2 py-0.5 rounded text-xs font-bold bg-bad-soft text-bad border border-bad">Major</span></td>
                                <td>Detail pop-up does not open for tasks with "Done" status</td>
                            </tr>
                            <tr>
                                <td class="font-mono text-warn whitespace-nowrap">BUG_001</td>
                                <td class="whitespace-nowrap">Task - Add Task</td>
                                <td><span class="px-2 py-0.5 rounded text-xs font-bold bg-warn-soft text-warn border border-warn">Medium</span></td>
                                <td>Mandatory Class field has no red state or required message when left empty</td>
                            </tr>
                            <tr>
                                <td class="font-mono text-warn whitespace-nowrap">BUG_012</td>
                                <td class="whitespace-nowrap">Task - Add Task</td>
                                <td><span class="px-2 py-0.5 rounded text-xs font-bold bg-warn-soft text-warn border border-warn">Medium</span></td>
                                <td>Past dates are selectable as Due date: no validation on date picker</td>
                            </tr>
                            <tr>
                                <td class="font-mono text-warn whitespace-nowrap">BUG_013</td>
                                <td class="whitespace-nowrap">Task - Add Task</td>
                                <td><span class="px-2 py-0.5 rounded text-xs font-bold bg-warn-soft text-warn border border-warn">Medium</span></td>
                                <td>User search by First name not working: only Last name returns results</td>
                            </tr>
                            <tr>
                                <td class="font-mono text-ink-2 whitespace-nowrap">BUG_005</td>
                                <td class="whitespace-nowrap">Task - Menu</td>
                                <td><span class="px-2 py-0.5 rounded text-xs font-bold bg-surface-2 text-ink-2 border border-line">Minor</span></td>
                                <td>French labels show "Taches / Ajoute une tache": plural inconsistency</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <p class="text-xs text-muted mt-2 text-center">
                Showing 6 of 15 bugs. Download the full report below for complete details
            </p>
        </div>

        {{-- Bug Report Example --}}
        <div class="mb-6 reveal">
            <h4 class="text-sm font-semibold text-ink-2 mb-3 flex items-center gap-2">Bug Report Example: BUG_001
            </h4>
            <div class="glass-card p-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3 text-sm">
                    <div>
                        <span class="text-xs text-muted uppercase tracking-wider font-medium">Bug ID</span>
                        <p class="text-ink font-mono mt-0.5">BUG_001</p>
                    </div>
                    <div>
                        <span class="text-xs text-muted uppercase tracking-wider font-medium">Severity</span>
                        <p class="mt-0.5"><span class="px-2 py-0.5 rounded text-xs font-bold bg-warn-soft text-warn border border-warn">Medium</span></p>
                    </div>
                    <div class="sm:col-span-2">
                        <span class="text-xs text-muted uppercase tracking-wider font-medium">Summary</span>
                        <p class="text-ink mt-0.5">Mandatory Class field does not turn RED and shows no 'required' message when it is left empty</p>
                    </div>
                    <div class="sm:col-span-2">
                        <span class="text-xs text-muted uppercase tracking-wider font-medium">Steps to Reproduce</span>
                        <div class="text-ink-2 mt-0.5 text-xs leading-relaxed space-y-1">
                            <p>1. Access the platform URL</p>
                            <p>2. Login with operator credentials</p>
                            <p>3. Navigate to Task > Add Task</p>
                            <p>4. Leave the "Class" field empty</p>
                            <p>5. Try to submit the form</p>
                        </div>
                    </div>
                    <div>
                        <span class="text-xs text-muted uppercase tracking-wider font-medium">Expected</span>
                        <p class="text-good text-xs mt-0.5">Field turns RED with a "required" validation message</p>
                    </div>
                    <div>
                        <span class="text-xs text-muted uppercase tracking-wider font-medium">Actual</span>
                        <p class="text-bad text-xs mt-0.5">Field does not change color and no message is displayed</p>
                    </div>
                    <div class="sm:col-span-2">
                        <span class="text-xs text-muted uppercase tracking-wider font-medium">Reproducibility</span>
                        <p class="text-ink-2 text-xs mt-0.5">Permanent, occurs every time</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Downloads --}}
        <div class="flex flex-wrap gap-3 reveal">
            <a href="{{ asset('docs/Test_Case-Task_Module.xlsx') }}" download class="btn-primary text-xs py-2.5 px-4">
                <i data-lucide="download" class="w-3.5 h-3.5"></i>
                Download Test Case (XLSX)
            </a>
            <a href="{{ asset('docs/Bug_Report-Task_Module.xlsx') }}" download class="btn-primary text-xs py-2.5 px-4">
                <i data-lucide="download" class="w-3.5 h-3.5"></i>
                Download Bug Report (XLSX)
            </a>
        </div>
    </div>
    {{-- End Case Study 2: Task Module --}}

</div>
