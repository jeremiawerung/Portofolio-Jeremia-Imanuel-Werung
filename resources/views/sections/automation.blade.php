{{-- ===== AUTOMATION TESTING SECTION ===== --}}
<section id="automation" class="relative py-20 lg:py-28 overflow-hidden">

    {{-- Background Decoration --}}
    <div class="bg-decoration w-[400px] h-[400px] bg-cyan-600 -left-40 top-20 absolute"></div>
    <div class="bg-decoration w-[350px] h-[350px] bg-indigo-600 -right-32 bottom-32 absolute"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        {{-- Section Header --}}
        <div class="text-center mb-16 reveal">
            <span class="tag mb-4 inline-flex">
                <i data-lucide="bot" class="w-3 h-3 mr-1.5"></i>
                Automation Testing
            </span>
            <h2 class="section-title text-slate-100 mt-3">
                Automation <span class="gradient-text">Scripts</span>
            </h2>
            <p class="text-slate-400 mt-4 max-w-2xl mx-auto">
                Hands-on automation testing scripts targeting critical paths of real-world applications
            </p>
        </div>

        {{-- Main Automation Project --}}
        <div class="max-w-5xl mx-auto space-y-8">

            {{-- Project: Aurora Beauty Salon Automation --}}
            <div class="glass-card p-6 sm:p-8 reveal">

                {{-- Project Header --}}
                <div class="flex flex-col sm:flex-row items-start gap-5 mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-pink-500 via-rose-500 to-purple-600 flex items-center justify-center shadow-lg shadow-pink-500/20 shrink-0">
                        <i data-lucide="terminal" class="w-7 h-7 text-white"></i>
                    </div>
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-3 mb-2">
                            <span class="tag" style="background: rgba(236, 72, 153, 0.1); color: #f472b6; border-color: rgba(236, 72, 153, 0.2);">
                                Academic Project
                            </span>
                            <span class="tag">
                                <i data-lucide="github" class="w-3 h-3 mr-1"></i>
                                Selenium + Python
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-slate-100 mb-2">
                            Aurora Beauty Salon — Automated Test Suite
                        </h3>
                        <p class="text-sm text-slate-400 leading-relaxed">
                            Automated test suite for critical paths in the Aurora Beauty Salon reservation system. 
                            Prioritized on the <span class="text-indigo-400 font-medium">Login</span> and 
                            <span class="text-indigo-400 font-medium">Reservation + DP Payment</span> flows because both 
                            are critical paths — if either fails, the entire transaction cycle (up to final payment) 
                            is disrupted. I also included a test scenario for attempting to book a filled slot (double booking prevention).
                        </p>
                    </div>
                </div>

                {{-- Code Snippet 1: Setup + Login --}}
                <div class="mb-6 reveal">
                    <h4 class="text-sm font-semibold text-slate-300 mb-3 flex items-center gap-2">
                        <i data-lucide="code-2" class="w-4 h-4 text-indigo-400"></i>
                        Setup & Login Automation (TC-03 & TC-04)
                    </h4>
                    <div class="code-block">
                        <div class="code-block-header">
                            <div class="code-block-dots">
                                <span style="background: #ef4444;"></span>
                                <span style="background: #f59e0b;"></span>
                                <span style="background: #22c55e;"></span>
                            </div>
                            <span class="text-xs text-slate-500 font-mono">test_login_aurora.py</span>
                        </div>
                        <div class="code-block-body"><span class="code-comment"># requirements: selenium, pytest, webdriver-manager</span>
<span class="code-keyword">import</span> <span class="code-class">pytest</span>
<span class="code-keyword">from</span> <span class="code-class">selenium</span> <span class="code-keyword">import</span> webdriver
<span class="code-keyword">from</span> <span class="code-class">selenium.webdriver.common.by</span> <span class="code-keyword">import</span> <span class="code-class">By</span>
<span class="code-keyword">from</span> <span class="code-class">selenium.webdriver.support.ui</span> <span class="code-keyword">import</span> <span class="code-class">WebDriverWait</span>
<span class="code-keyword">from</span> <span class="code-class">selenium.webdriver.support</span> <span class="code-keyword">import</span> expected_conditions <span class="code-keyword">as</span> <span class="code-class">EC</span>

BASE_URL = <span class="code-string">"https://staging.aurorabeautysalon.example.com"</span>

<span class="code-decorator">@pytest.fixture</span>
<span class="code-keyword">def</span> <span class="code-func">driver</span>():
    drv = webdriver.<span class="code-func">Chrome</span>()
    drv.<span class="code-func">get</span>(<span class="code-keyword">f</span><span class="code-string">"{BASE_URL}/login"</span>)
    <span class="code-keyword">yield</span> drv
    drv.<span class="code-func">quit</span>()

<span class="code-keyword">def</span> <span class="code-func">test_login_dengan_kredensial_valid</span>(<span class="code-param">driver</span>):
    driver.<span class="code-func">find_element</span>(<span class="code-class">By</span>.NAME, <span class="code-string">"email"</span>).<span class="code-func">send_keys</span>(<span class="code-string">"pelanggan_test@example.com"</span>)
    driver.<span class="code-func">find_element</span>(<span class="code-class">By</span>.NAME, <span class="code-string">"password"</span>).<span class="code-func">send_keys</span>(<span class="code-string">"Password123!"</span>)
    driver.<span class="code-func">find_element</span>(<span class="code-class">By</span>.ID, <span class="code-string">"btn-masuk"</span>).<span class="code-func">click</span>()

    <span class="code-class">WebDriverWait</span>(driver, <span class="code-param">10</span>).<span class="code-func">until</span>(<span class="code-class">EC</span>.<span class="code-func">url_contains</span>(<span class="code-string">"/dashboard"</span>))
    <span class="code-keyword">assert</span> <span class="code-string">"dashboard"</span> <span class="code-keyword">in</span> driver.current_url

<span class="code-keyword">def</span> <span class="code-func">test_login_dengan_password_salah</span>(<span class="code-param">driver</span>):
    driver.<span class="code-func">find_element</span>(<span class="code-class">By</span>.NAME, <span class="code-string">"email"</span>).<span class="code-func">send_keys</span>(<span class="code-string">"pelanggan_test@example.com"</span>)
    driver.<span class="code-func">find_element</span>(<span class="code-class">By</span>.NAME, <span class="code-string">"password"</span>).<span class="code-func">send_keys</span>(<span class="code-string">"passwordsalah"</span>)
    driver.<span class="code-func">find_element</span>(<span class="code-class">By</span>.ID, <span class="code-string">"btn-masuk"</span>).<span class="code-func">click</span>()

    error_message = <span class="code-class">WebDriverWait</span>(driver, <span class="code-param">10</span>).<span class="code-func">until</span>(
        <span class="code-class">EC</span>.<span class="code-func">visibility_of_element_located</span>((<span class="code-class">By</span>.CLASS_NAME, <span class="code-string">"alert-error"</span>))
    )
    <span class="code-keyword">assert</span> <span class="code-string">"Email/Password Salah"</span> <span class="code-keyword">in</span> error_message.text</div>
                    </div>
                </div>

                {{-- Code Snippet 2: Booking + DP --}}
                <div class="mb-6 reveal">
                    <h4 class="text-sm font-semibold text-slate-300 mb-3 flex items-center gap-2">
                        <i data-lucide="code-2" class="w-4 h-4 text-cyan-400"></i>
                        Reservation & DP Payment (TC-05 & TC-07)
                    </h4>
                    <div class="code-block">
                        <div class="code-block-header">
                            <div class="code-block-dots">
                                <span style="background: #ef4444;"></span>
                                <span style="background: #f59e0b;"></span>
                                <span style="background: #22c55e;"></span>
                            </div>
                            <span class="text-xs text-slate-500 font-mono">test_booking_dp.py</span>
                        </div>
                        <div class="code-block-body"><span class="code-keyword">def</span> <span class="code-func">test_reservasi_dan_pembayaran_dp</span>(<span class="code-param">driver</span>):
    <span class="code-comment"># asumsi driver sudah dalam kondisi login</span>
    driver.<span class="code-func">get</span>(<span class="code-keyword">f</span><span class="code-string">"{BASE_URL}/layanan"</span>)
    driver.<span class="code-func">find_element</span>(<span class="code-class">By</span>.LINK_TEXT, <span class="code-string">"Perawatan Wajah"</span>).<span class="code-func">click</span>()
    driver.<span class="code-func">find_element</span>(
        <span class="code-class">By</span>.XPATH, <span class="code-string">"//div[@data-layanan='facial-glow']//button[text()='Pilih']"</span>
    ).<span class="code-func">click</span>()

    driver.<span class="code-func">find_element</span>(<span class="code-class">By</span>.CSS_SELECTOR, <span class="code-string">"[data-slot='10:00']"</span>).<span class="code-func">click</span>()
    driver.<span class="code-func">find_element</span>(<span class="code-class">By</span>.ID, <span class="code-string">"btn-kirim-reservasi"</span>).<span class="code-func">click</span>()

    <span class="code-class">WebDriverWait</span>(driver, <span class="code-param">10</span>).<span class="code-func">until</span>(
        <span class="code-class">EC</span>.<span class="code-func">visibility_of_element_located</span>((<span class="code-class">By</span>.ID, <span class="code-string">"form-konfirmasi-reservasi"</span>))
    )
    driver.<span class="code-func">find_element</span>(<span class="code-class">By</span>.NAME, <span class="code-string">"catatan"</span>).<span class="code-func">send_keys</span>(<span class="code-string">"Reservasi test otomatis"</span>)
    driver.<span class="code-func">find_element</span>(<span class="code-class">By</span>.ID, <span class="code-string">"btn-bayar-dp"</span>).<span class="code-func">click</span>()

    konfirmasi = <span class="code-class">WebDriverWait</span>(driver, <span class="code-param">15</span>).<span class="code-func">until</span>(
        <span class="code-class">EC</span>.<span class="code-func">visibility_of_element_located</span>((<span class="code-class">By</span>.ID, <span class="code-string">"label-konfirmasi-pembayaran"</span>))
    )
    <span class="code-keyword">assert</span> <span class="code-string">"Pembayaran DP Diterima"</span> <span class="code-keyword">in</span> konfirmasi.text</div>
                    </div>
                </div>

                {{-- Code Snippet 3: Double Booking Protection --}}
                <div class="mb-6 reveal">
                    <h4 class="text-sm font-semibold text-slate-300 mb-3 flex items-center gap-2">
                        <i data-lucide="code-2" class="w-4 h-4 text-rose-400"></i>
                        Filled Slot Reservation (TC-06)
                    </h4>
                    <div class="code-block">
                        <div class="code-block-header">
                            <div class="code-block-dots">
                                <span style="background: #ef4444;"></span>
                                <span style="background: #f59e0b;"></span>
                                <span style="background: #22c55e;"></span>
                            </div>
                            <span class="text-xs text-slate-500 font-mono">test_slot_penuh.py</span>
                        </div>
                        <div class="code-block-body"><span class="code-keyword">def</span> <span class="code-func">test_slot_terisi_tidak_bisa_direservasi</span>(<span class="code-param">driver</span>):
    driver.<span class="code-func">get</span>(<span class="code-keyword">f</span><span class="code-string">"{BASE_URL}/layanan"</span>)
    driver.<span class="code-func">find_element</span>(
        <span class="code-class">By</span>.XPATH, <span class="code-string">"//div[@data-layanan='facial-glow']//button[text()='Pilih']"</span>
    ).<span class="code-func">click</span>()

    slot_terisi = driver.<span class="code-func">find_element</span>(
        <span class="code-class">By</span>.CSS_SELECTOR, <span class="code-string">"[data-slot='10:00'][data-status='penuh']"</span>
    )
    <span class="code-keyword">assert</span> <span class="code-string">"disabled"</span> <span class="code-keyword">in</span> slot_terisi.<span class="code-func">get_attribute</span>(<span class="code-string">"class"</span>)</div>
                    </div>
                </div>

                {{-- Implementation Note --}}
                <div class="glass-card p-4 mb-6 reveal" style="background: rgba(245, 158, 11, 0.05); border-color: rgba(245, 158, 11, 0.15);">
                    <div class="flex items-start gap-3">
                        <i data-lucide="alert-circle" class="w-4 h-4 text-amber-400 mt-0.5 shrink-0"></i>
                        <p class="text-xs text-slate-400 leading-relaxed">
                            <span class="text-amber-400 font-medium">Implementation Note:</span>
                            The URL, <code class="text-xs bg-slate-800 px-1 py-0.5 rounded font-mono text-cyan-400">name</code>,
                            <code class="text-xs bg-slate-800 px-1 py-0.5 rounded font-mono text-cyan-400">id</code>, and
                            <code class="text-xs bg-slate-800 px-1 py-0.5 rounded font-mono text-cyan-400">data-*</code>
                            selectors above are adapted to the actual HTML structure.
                        </p>
                    </div>
                </div>

                {{-- Test Scenarios Grid --}}
                <div class="reveal">
                    <h4 class="text-sm font-semibold text-slate-300 mb-3 flex items-center gap-2">
                        <i data-lucide="list-checks" class="w-4 h-4 text-emerald-400"></i>
                        Automated Test Scenarios
                    </h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <div class="glass-card p-4">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                <span class="text-xs text-emerald-400 font-semibold uppercase tracking-wider">Automated</span>
                            </div>
                            <h5 class="text-sm font-bold text-slate-200 mb-1">Login Module</h5>
                            <p class="text-xs text-slate-400">Valid login, invalid password, role-based dashboard redirect validation</p>
                            <div class="mt-2 flex gap-1">
                                <span class="tag text-[10px]">TC-03</span>
                                <span class="tag text-[10px]">TC-04</span>
                            </div>
                        </div>
                        <div class="glass-card p-4">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                                <span class="text-xs text-emerald-400 font-semibold uppercase tracking-wider">Automated</span>
                            </div>
                            <h5 class="text-sm font-bold text-slate-200 mb-1">Reservation & DP</h5>
                            <p class="text-xs text-slate-400">Select service, time slot, double booking verification, notes form, and 50% DP payment</p>
                            <div class="mt-2 flex gap-1">
                                <span class="tag text-[10px]">TC-05</span>
                                <span class="tag text-[10px]">TC-06</span>
                                <span class="tag text-[10px]">TC-07</span>
                            </div>
                        </div>
                        <div class="glass-card p-4">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="w-2 h-2 rounded-full bg-yellow-400"></span>
                                <span class="text-xs text-yellow-400 font-semibold uppercase tracking-wider">Planned</span>
                            </div>
                            <h5 class="text-sm font-bold text-slate-200 mb-1">Registration</h5>
                            <p class="text-xs text-slate-400">Valid registration, incomplete data, form fields verification</p>
                            <div class="mt-2 flex gap-1">
                                <span class="tag text-[10px]">TC-01</span>
                                <span class="tag text-[10px]">TC-02</span>
                            </div>
                        </div>
                        <div class="glass-card p-4">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="w-2 h-2 rounded-full bg-yellow-400"></span>
                                <span class="text-xs text-yellow-400 font-semibold uppercase tracking-wider">Planned</span>
                            </div>
                            <h5 class="text-sm font-bold text-slate-200 mb-1">Admin Verification</h5>
                            <p class="text-xs text-slate-400">Manual verification of DP and final payment transactions by admin</p>
                            <div class="mt-2 flex gap-1">
                                <span class="tag text-[10px]">TC-08</span>
                                <span class="tag text-[10px]">TC-11</span>
                            </div>
                        </div>
                        <div class="glass-card p-4">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="w-2 h-2 rounded-full bg-yellow-400"></span>
                                <span class="text-xs text-yellow-400 font-semibold uppercase tracking-wider">Planned</span>
                            </div>
                            <h5 class="text-sm font-bold text-slate-200 mb-1">Check-in & Final Payment</h5>
                            <p class="text-xs text-slate-400">Salon check-in confirmation, update service permission status, and settle remaining payment</p>
                            <div class="mt-2 flex gap-1">
                                <span class="tag text-[10px]">TC-09</span>
                                <span class="tag text-[10px]">TC-10</span>
                            </div>
                        </div>
                        <div class="glass-card p-4">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="w-2 h-2 rounded-full bg-slate-400"></span>
                                <span class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Backlog</span>
                            </div>
                            <h5 class="text-sm font-bold text-slate-200 mb-1">Transaction Reports</h5>
                            <p class="text-xs text-slate-400">Filter data by date, export data for business monitoring</p>
                            <div class="mt-2 flex gap-1">
                                <span class="tag text-[10px]">TC-12</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tech Stack & Repository --}}
                <div class="mt-6 pt-6 border-t border-slate-700/50 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 reveal">
                    <div class="flex flex-wrap gap-2">
                        <span class="tag text-xs">Selenium WebDriver</span>
                        <span class="tag text-xs">Python</span>
                        <span class="tag text-xs">Pytest</span>
                        <span class="tag text-xs">Page Object Model</span>
                    </div>
                    <div class="flex gap-3">
                        <!-- PLACEHOLDER: Replace link with your GitHub repository URL -->
                        <a href="https://github.com/username/aurora-salon-automation" target="_blank" class="btn-primary text-xs py-2 px-4">
                            <i data-lucide="github" class="w-3.5 h-3.5"></i>
                            View Repository
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
