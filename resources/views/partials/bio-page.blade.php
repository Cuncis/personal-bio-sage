<div class="max-w-3xl mx-auto px-6 py-20">

  {{-- ── Hero ── --}}
  <div class="flex items-start gap-10 mb-16">

    @if ($avatar)
      <img
        src="{{ $avatar['url'] }}"
        alt="{{ $name }}"
        class="w-28 h-28 rounded-full object-cover border-2 border-accent/20 shrink-0"
      />
    @endif

    <div>
      @if ($available)
        <span class="inline-flex items-center gap-1.5 text-xs font-mono text-accent mb-4">
          <span class="w-1.5 h-1.5 bg-accent rounded-full animate-pulse"></span>
          Available for work
        </span>
      @endif

      <h1 class="font-serif text-5xl text-ink leading-tight">
        {{ $name }}
      </h1>

      @if ($role)
        <p class="text-muted font-mono text-sm mt-2">
          {{ $role }}
          @if ($location)
            · {{ $location }}
          @endif
        </p>
      @endif
    </div>
  </div>

  @if ($bio)
    <div class="prose prose-lg mb-16 text-ink/80 leading-relaxed">
      {!! $bio !!}
    </div>
  @endif

  @if ($skills)
    <section class="mb-16">
      <h2 class="font-mono text-xs uppercase tracking-widest text-muted mb-5">Skills</h2>
      <div class="flex flex-wrap gap-2">
        @foreach ($skills as $skill)
          <span class="skill-tag px-3 py-1.5 text-xs font-mono text-ink">
            {{ $skill['name'] }}
          </span>
        @endforeach
      </div>
    </section>
  @endif

  @if ($email || $socials)
    <section class="border-t border-ink/10 pt-12">
      <h2 class="font-mono text-xs uppercase tracking-widest text-muted mb-5">Get in touch</h2>

      @if ($email)
        <a href="mailto:{{ $email }}" class="font-serif text-2xl text-ink hover:text-accent transition-colors">
          {{ $email }}
        </a>
      @endif

      @if ($socials)
        <div class="flex gap-4 mt-6">
          @foreach ($socials as $social)
            <a
              href="{{ $social['url'] }}"
              class="text-sm font-mono text-muted hover:text-accent transition-colors nav-link"
            >
              {{ $social['platform'] }}
            </a>
          @endforeach
        </div>
      @endif
    </section>
  @endif

</div>
