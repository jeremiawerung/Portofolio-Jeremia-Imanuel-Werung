@php
    $skills = [
        'Quality assurance' => 'Manual testing, functional testing, UI/UX testing, test case design, bug reporting, Selenium, Playwright (E2E), PHPUnit',
        'System analysis' => 'draw.io, use case diagrams, activity diagrams, flowcharts, ERD, system workflows',
        'Data & analytics' => 'Data analysis, data processing, RapidMiner, Microsoft Excel, Google Analytics',
        'Development & database' => 'PHP / Laravel, Filament, HTML / CSS, Tailwind CSS, JavaScript, Python, MySQL, SQLite, Arduino (ESP8266)',
        'Tools' => 'Git / GitHub, VS Code, Postman, Figma, Notion, Trello / Jira, Claude Code and AI agents, cPanel / SSH deploy',
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
