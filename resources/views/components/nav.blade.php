@props(['currentPage' => ''])

<nav class="border-b border-ink/10 px-6 py-4 flex items-center justify-between">

  {{-- Logo / Name --}}
  <a href="/" class="font-serif text-xl text-ink">
    {{ $name ?? get_bloginfo('name') }}
  </a>

  {{-- Nav Links --}}
  <ul class="flex items-center gap-8">

    @foreach([
      'about'   => 'About',
      'work'    => 'Work',
      'blog'    => 'Blog',
      'contact' => 'Contact',
    ] as $slug => $label)

      <li>
        <a
          href="/{{ $slug }}"
          class="nav-link text-sm font-mono
            @if($currentPage === $slug)
              text-accent
            @else
              text-muted hover:text-ink
            @endif"
        >
          {{ $label }}
        </a>
      </li>

    @endforeach

  </ul>
</nav>