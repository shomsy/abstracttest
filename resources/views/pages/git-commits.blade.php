@extends('layouts.app',
[
'namePage' => 'Table
List',
'class' =>
'sidebar-mini',
'activePage' =>
'table',
])

@section('content')
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="font-weight-light text-center text-muted py-3">Git Repository Commits</h2>
                    </div>
                    <div class="card-body">
                        <div class="container mt-5">
                            @foreach ($gitCommits->all() as $gitCommit)
                                <div class="row d-flex justify-content-center">
                                    <div class="col-md-12">
                                        <div class="card p-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="col-md-8 user d-flex flex-row align-items-center">
                                                    <img
                                                            src="{{ $gitCommit->committer->avatar_url }}"
                                                            width="30"
                                                            class="user-img rounded-circle mr-2"
                                                    >
                                                    <span>
                                                        <small class="font-weight-bold text-primary">
                                                            {{ $gitCommit->committer->login }}
                                                        </small>
                                                        <small class="font-weight-bold">
                                                            {{ $gitCommit->commit->message }}
                                                        </small>
                                                    </span>
                                                </div>
                                                <small>{{ date('d.m.Y H:i:s', strtotime($gitCommit->commit->committer->date)) }}</small>
                                            </div>
                                            <section id="tabs">
                                                <div class="container">
                                                    <h6 class="section-title small text-center m-4">Details:</h6>
                                                    <div class="row">
                                                        <div class="col-xs-12 ">
                                                            <nav>
                                                                <div
                                                                        class="nav nav-tabs "
                                                                        id="nav-tab"
                                                                        role="tablist"
                                                                >
                                                                    <a
                                                                            class="nav-item nav-link active small"
                                                                            id="nav-general-tab"
                                                                            data-toggle="tab"
                                                                            href="#nav-general-{{ $gitCommit->sha }}"
                                                                            role="tab"
                                                                            aria-controls="nav-general"
                                                                            aria-selected="true"
                                                                    >
                                                                        General
                                                                    </a>
                                                                    <a
                                                                            class="nav-item nav-link small"
                                                                            id="nav-commit-tab-{{ $gitCommit->sha }}"
                                                                            data-toggle="tab"
                                                                            href="#nav-commit-{{ $gitCommit->sha }}"
                                                                            role="tab"
                                                                            aria-controls="nav-commit-{{ $gitCommit->sha }}"
                                                                            aria-selected="false"
                                                                    >
                                                                        Commit
                                                                    </a>
                                                                    <a
                                                                            class="nav-item nav-link small text-capitalize"
                                                                            id="nav-author-tab-{{ $gitCommit->sha }}"
                                                                            data-toggle="tab"
                                                                            href="#nav-author-{{ $gitCommit->sha }}"
                                                                            role="tab"
                                                                            aria-controls="nav-author"
                                                                            aria-selected="false"
                                                                    >
                                                                        author
                                                                    </a>
                                                                    <a
                                                                            class="nav-item nav-link small text-capitalize"
                                                                            id="nav-parents-tab-{{ $gitCommit->sha }}"
                                                                            data-toggle="tab"
                                                                            href="#nav-parents-{{ $gitCommit->sha }}"
                                                                            role="tab"
                                                                            aria-controls="nav-parents"
                                                                            aria-selected="false"
                                                                    >
                                                                        parents
                                                                    </a>
                                                                    <a
                                                                            class="nav-item nav-link small text-capitalize"
                                                                            id="nav-committer-tab-{{ $gitCommit->sha }}"
                                                                            data-toggle="tab"
                                                                            href="#nav-committer-{{ $gitCommit->sha }}"
                                                                            role="tab"
                                                                            aria-controls="nav-committer"
                                                                            aria-selected="false"
                                                                    >
                                                                        committer
                                                                    </a>
                                                                </div>
                                                            </nav>
                                                            <div
                                                                    class="tab-content tab-content py-3 px-3 px-sm-0"
                                                                    id="nav-tabContent"
                                                            >
                                                                <div
                                                                        class="tab-pane fade show active text-center"
                                                                        id="nav-general-{{ $gitCommit->sha }}"
                                                                        role="tabpanel"
                                                                        aria-labelledby="nav-general-tab"
                                                                >
                                                                    <p class="font-weight-bold small">
                                                                        Hash:
                                                                        <small class="font-weight-bold text-muted">
                                                                            {{ $gitCommit->sha }}
                                                                        </small>
                                                                    </p>
                                                                    <p class="font-weight-bold small">
                                                                        Node ID:
                                                                        <small class="font-weight-bold text-muted">
                                                                            {{ $gitCommit->node_id }}
                                                                        </small>
                                                                    </p>
                                                                    <p class="font-weight-bold small">
                                                                        URL:
                                                                        <small class="font-weight-bold text-muted">
                                                                            {{ $gitCommit->url }}
                                                                        </small>
                                                                    <p class="font-weight-bold small">
                                                                        Html URL:
                                                                        <small class="font-weight-bold text-muted">
                                                                            {{ $gitCommit->html_url }}
                                                                        </small>
                                                                    </p>
                                                                    <p class="font-weight-bold small">
                                                                        Comments URL:
                                                                        <small class="font-weight-bold text-muted">
                                                                            {{ $gitCommit->comments_url }}
                                                                        </small>
                                                                    </p>
                                                                </div>
                                                                <div
                                                                        class="tab-pane fade"
                                                                        id="nav-commit-{{ $gitCommit->sha }}"
                                                                        role="tabpanel"
                                                                        aria-labelledby="nav-commit-tab"
                                                                >
                                                                    <div class="container">
                                                                            <div class="row text-center">
                                                                                @foreach ($gitCommit->commit as $commitDetailTitle => $commitDetails)
                                                                                    <div class="col-sm-3">
                                                                                        <div class="card">
                                                                                            <div class="card-body text-center">
                                                                                                <h5 class="card-title font-weight-bold bold text-capitalize">
                                                                                                    {{ $commitDetailTitle }}
                                                                                                </h5>
                                                                                                @foreach ((object) $commitDetails as $commitDetailName => $commitDetailValue)
                                                                                                    <p class="font-weight-bold small">
                                                                                                        {{ $commitDetailName }}
                                                                                                        :
                                                                                                        <small class="font-weight-bold text-muted">
                                                                                                            {{ $commitDetailValue }}
                                                                                                        </small>
                                                                                                    </p>
                                                                                                @endforeach
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                        class="tab-pane fade text-center"
                                                                        id="nav-author-{{ $gitCommit->sha }}"
                                                                        role="tabpanel"
                                                                        aria-labelledby="nav-author-tab"
                                                                >
                                                                    @foreach ($gitCommit->author as $authorDetailsName => $authorDetailsValue)
                                                                        <p class="font-weight-bold small">
                                                                            {{ $authorDetailsName }}:
                                                                            <small class="font-weight-bold text-muted">
                                                                                {{ $authorDetailsValue }}
                                                                            </small>
                                                                        </p>
                                                                    @endforeach
                                                                </div>
                                                                <div
                                                                        class="tab-pane fade text-center"
                                                                        id="nav-committer-{{ $gitCommit->sha }}"
                                                                        role="tabpanel"
                                                                        aria-labelledby="nav-committer-tab"
                                                                >
                                                                    @foreach ($gitCommit->committer as $authorDetailsName => $authorDetailsValue)
                                                                        <p class="font-weight-bold small">
                                                                            {{ $authorDetailsName }}:
                                                                            <small class="font-weight-bold text-muted">
                                                                                {{ $authorDetailsValue }}
                                                                            </small>
                                                                        </p>
                                                                    @endforeach
                                                                </div>
                                                                <div
                                                                        class="tab-pane fade text-center"
                                                                        id="nav-parents-{{ $gitCommit->sha }}"
                                                                        role="tabpanel"
                                                                        aria-labelledby="nav-parents-tab"
                                                                >
                                                                    @foreach ($gitCommit->parents as $parent)
                                                                        @foreach ($parent as $parentsDetailsName => $parentsDetailsValue)
                                                                            <p class="font-weight-bold small">
                                                                                {{ $parentsDetailsName }}:
                                                                                <small class="font-weight-bold text-muted">
                                                                                    {{ $parentsDetailsValue }}
                                                                                </small>
                                                                            </p>
                                                                        @endforeach
                                                                    @endforeach
                                                                </div>
                                                                <div
                                                                        class="tab-pane fade"
                                                                        id="nav-committer-{{ $gitCommit->sha }}"
                                                                        role="tabpanel"
                                                                        aria-labelledby="nav-committer-tab"
                                                                >
                                                                    @foreach ($gitCommit->committer as $authorDetailsName => $authorDetailsValue)
                                                                        <p class="font-weight-bold small">
                                                                            {{ $authorDetailsName }}:
                                                                            <small class="font-weight-bold text-muted">
                                                                                {{ $authorDetailsValue }}
                                                                            </small>
                                                                        </p>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                        <!--/row-->
                            <div class="d-flex justify-content-center">
                                {!! $gitCommits->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
