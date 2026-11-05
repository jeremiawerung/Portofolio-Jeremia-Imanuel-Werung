@php
    $skills = [
        'Quality assurance' => 'Test case design, manual testing, black box testing, regression testing, functional testing, UI/UX testing, Design QA, API testing (Postman), bug reporting, Selenium, Playwright (E2E), PHPUnit',
        'System analysis' => 'Requirements analysis, business process flows, PRD, user stories, ERD, RTM, draw.io, use case diagrams, activity diagrams, flowcharts, system workflows',
        'Data & analytics' => 'Data analysis, data processing, RapidMiner, Microsoft Excel, Google Analytics',
        'Development & database' => 'PHP / Laravel, Filament, JavaScript, Java, HTML / CSS, Tailwind CSS, Python, REST API, MySQL, SQLite, SQL',
        'AI & hardware' => 'AI integration in applications, Wemos D1 mini and RC522 programming, Arduino (ESP8266)',
        'Design' => 'Figma, Adobe Photoshop',
        'Tools' => 'Git / GitHub, GitHub Actions, VS Code, Postman, Notion, Trello / Jira, Claude Code and AI agents, cPanel / SSH deploy, Microsoft Word',
        'Soft skills' => 'Analytical thinking, attention to detail, problem solving, clear communication, adaptability',
    ];
@endphp

<dl class="divide-y divide-line border-y border-line reveal">
    @foreach ($skills as $category => $items)
        <div class="grid grid-cols-1 sm:grid-cols-4 gap-1 sm:gap-6 py-4">
            <dt class="text-sm font-semibold text-ink">{{ $category }}</dt>
            <dd class="sm:col-span-3 text-sm text-ink-2 leading-relaxed">{{ $items }}</dd>
        </div>
    @endforeach
</dl>
