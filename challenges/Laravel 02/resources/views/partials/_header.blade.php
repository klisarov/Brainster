<header class="page-header" style="background-image: url('{{ $bgImage }}')">
    <div class="overlay"></div>
    <div class="container">
        <div class="header-content">
            <h1>{{ $title }}</h1>
            <span class="subtitle">{{ $subtitle }}</span>
            @if(isset($posted_by))
                <div class="post-meta">
                    Posted by {{ $posted_by }} on {{ $posted_on }}
                </div>
            @endif
        </div>
    </div>
</header>