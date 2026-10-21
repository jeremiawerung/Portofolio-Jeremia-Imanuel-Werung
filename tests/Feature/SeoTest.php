<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoTest extends TestCase
{
    use RefreshDatabase;

    public function test_sitemap_lists_public_pages_only(): void
    {
        $response = $this->get('/sitemap.xml')
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml; charset=UTF-8');

        $xml = simplexml_load_string($response->getContent());
        $this->assertNotFalse($xml, 'sitemap.xml harus XML yang valid');

        $locs = array_map(fn ($url) => (string) $url->loc, iterator_to_array($xml->url, false));

        $this->assertContains(route('home'), $locs);
        $this->assertContains(route('contact'), $locs);
        $this->assertCount(count(config('portfolio.sitemap')), $locs);

        foreach ($locs as $loc) {
            $this->assertStringNotContainsString('/admin', $loc);
        }
    }

    public function test_pages_have_canonical_and_person_structured_data(): void
    {
        $html = $this->get('/about?ref=abc')->assertOk()->getContent();

        // canonical gak boleh bawa ?query
        $this->assertStringContainsString('<link rel="canonical" href="' . url('/about') . '">', $html);

        preg_match('#<script type="application/ld\+json">(.+?)</script>#s', $html, $match);
        $this->assertNotEmpty($match, 'JSON-LD harus ada di halaman');

        $data = json_decode($match[1], true);
        $this->assertSame(JSON_ERROR_NONE, json_last_error());

        $person = collect($data['@graph'])->firstWhere('@type', 'Person');
        $this->assertSame('Jeremia Imanuel Werung', $person['name']);
        $this->assertContains('https://www.linkedin.com/in/jeremiaimanuelwerung/', $person['sameAs']);
        $this->assertContains('https://github.com/jeremiawerung', $person['sameAs']);
    }

    public function test_contact_page_links_to_linkedin(): void
    {
        $this->get('/contact')
            ->assertOk()
            ->assertSee('https://www.linkedin.com/in/jeremiaimanuelwerung/', false);
    }

    public function test_robots_and_llms_files_point_to_the_right_places(): void
    {
        $robots = file_get_contents(public_path('robots.txt'));
        $this->assertStringContainsString('Sitemap: https://jeremiawerung.my.id/sitemap.xml', $robots);
        $this->assertStringContainsString('Disallow: /admin/', $robots);

        $llms = file_get_contents(public_path('llms.txt'));
        $this->assertStringStartsWith('# Jeremia Imanuel Werung', $llms);
        $this->assertStringContainsString('linkedin.com/in/jeremiaimanuelwerung', $llms);
    }
}
