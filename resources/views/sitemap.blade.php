{{-- Sengaja tanpa deklarasi xml di baris pertama: PHP server nyalain short_open_tag, jadi deklarasi itu kebaca sebagai kode PHP terus error --}}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach ($routes as $name)
    <url>
        <loc>{{ route($name) }}</loc>
    </url>
@endforeach
</urlset>
