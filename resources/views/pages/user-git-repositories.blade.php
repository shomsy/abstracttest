@extends('layouts.app',
[
'namePage' => 'Repositories',
'class' =>
'sidebar-mini',
'activePage' =>
'repositories',
])

@section('content')
    <div class="panel-header panel-header-sm"></div>
    @include('alerts.success')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            Git Repositories
                        </h4>
                    </div>
                    <div class="card-body">
                        <git-repositories-component :repositories="{{ json_encode($gitRepositories->all()) }}">
                        </git-repositories-component>
                        <div class="d-flex justify-content-center">
                            {!! $gitRepositories->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
