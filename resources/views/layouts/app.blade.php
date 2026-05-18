<!DOCTYPE html>
<html @php(language_attributes())>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ $pageTitle ?? get_bloginfo('name') }}</title>
  @php(wp_head())
</head>

<body @php(body_class('bg-paper font-sans text-ink'))>
  @php(wp_body_open())

  {{-- Nav component. Gets $currentPage from Composer --}}
  <x-nav :currentPage="$currentPage" />

  <main class="min-h-screen">
    @yield('content') {{-- ← each page slots in here --}}
  </main>

  <footer class="border-t border-ink/10 py-8 text-center">
    <p class="text-sm text-muted font-mono">
      © {{ date('Y') }} · {{ $name }}
    </p>
  </footer>

  @php(wp_footer())
</body>

</html>