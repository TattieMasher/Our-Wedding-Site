@extends('layouts.app')

@section('title', 'Alex & Candace')

@section('content')
    <section class="hero">
        <h1 class="hero-hearts">❤❤</h1>

        <div class="hero-name-detail-wrapper">
            <h1 class="hero-names">
                Alex M<sup>c</sup>Caughran<br> — and — <br>Candace Scoular
            </h1>
            <div class="hero-details" id="info">
                FRIDAY 1ˢᵗ AUGUST 2025<br>
                <a href="https://www.google.com/maps?sca_esv=40110b24e13515f5&rlz=1C1GCEA_enGB1152GB1152&sxsrf=AHTn8zoSn3opaX4f4ClPW4LCNANM4l9l9A:1744057971199&uact=5&gs_lp=Egxnd3Mtd2l6LXNlcnAaAhgCIg1mZW53aWNrIGhvdGVsMhMQLhiABBjHARgnGIoFGI4FGK8BMgUQABiABDIFEAAYgAQyBRAAGIAEMgUQABiABDIFEAAYgAQyBRAAGIAEMgUQABiABDIFEAAYgAQyBRAAGIAEMiAQLhiABBjHARiKBRiOBRivARiXBRjcBBjeBBjgBNgBAUiGEVCFBliKEHABeAGQAQCYAZEBoAGKCqoBAzcuNrgBA8gBAPgBAZgCDqAC4grCAgoQABiwAxjWBBhHwgIKECMYgAQYJxiKBcICBBAjGCfCAgsQABiABBiRAhiKBcICFhAuGIAEGLEDGNEDGEMYgwEYxwEYigXCAgsQABiABBixAxiDAcICDhAAGIAEGLEDGIMBGIoFwgIIEAAYgAQYsQPCAgoQABiABBhDGIoFwgITEAAYgAQYsQMYQxiDARjJAxiKBcICCBAuGIAEGLEDwgILEAAYgAQYkgMYigXCAg0QABiABBixAxhDGIoFwgITEC4YgAQYsQMY0QMYQxjHARiKBcICExAuGIAEGLEDGEMYxwEYigUYrwHCAhQQLhiABBimAxjHARioAxiLAxivAcICEBAAGIAEGLEDGEMYigUYiwPCAgsQLhiABBjHARivAcICBRAuGIAEmAMAiAYBkAYIugYGCAEQARgUkgcDOC42oAfUuAGyBwM3Lja4B90K&um=1&ie=UTF-8&fb=1&gl=uk&sa=X&geocode=KZcTcJrBM4hIMfutA_l7qVrI&daddr=Junction+8+M77,+Fenwick,+Kilmarnock+KA3+6AU">FENWICK HOTEL</a><br>
                Arrival by 1:30pm
            </div>
        </div>
    </section>

    <section class="hero-photo">
        <img src="/img/img.jpg" alt="Alex & Candace" />
    </section>

    <section class="rsvp-invite" id="rsvp">
        <p>We request the pleasure of your company as we celebrate our love.</p>
        <a class="rsvp-button" href="#rsvp-form">Please let us know if you can attend (RSVP)</a>
    </section>

    @isset($household)
        <section class="rsvp-form-section" id="rsvp-form">
            <h2>RSVP for {{ $household->name }}</h2>
            @include('rsvp.form-fields', ['household' => $household])
        </section>
    @endisset
@endsection
