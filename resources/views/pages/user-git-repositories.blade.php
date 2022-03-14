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
                        <h4 class="card-title">
                            Git Repositories
                        </h4>
                    </div>
                    <div class="card-body">
                        <git-repositories-component
                                :repositories="{{ json_encode($gitRepositories) }}"
                        >
                        </git-repositories-component>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
import GitRepositoriesComponent from "../../js/components/GitRepositoriesComponent";

export default {
    components: {GitRepositoriesComponent}
}
</script>
