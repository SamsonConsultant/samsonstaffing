<div class="container card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <h4><strong>My Profile Details</strong></h4>
                <hr class="border-bottom">
                <p><b>E-Mail</b> {{ $user->email }}</p>
                <p><b>Mobile Phone Number</b> {{ $user->contact_number }}</p>
                <p><b>Address</b> {{ $user->address }}</p>
                <p><b>City</b> {{ $user->city }}</p>
                <p><b>State</b> {{ $user->country->name ?? '' }}</p>
                <p><b>Country</b> {{ $user->state->name ?? '' }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h4><strong>Work Experience</strong></h4>
                <hr class="border-bottom">
            </div>
            @forelse($user_exp as $exp)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p><b>{{ $exp->company_name }}</b></p>
                            <p>{{ $exp->position_title }}</p>
                            <p>{{ $exp->current_position }}</p>
                            <p>Start:- {{ $exp->start_date }}</p>
                            <p>End :- {{ $exp->end_date }}</p>
                            <p>{{ $exp->exp_year }} Year, {{ $exp->exp_month }} Month</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('user.dlt.exp', $exp->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Remove</a>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>

        <div class="row">
            <div class="col-md-12">
                <h4><strong>Education History</strong></h4>
                <hr class="border-bottom">
            </div>
            @forelse($user_edu as $edu)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <p><b>{{ $edu->college_name }}</b></p>
                            <p>{{ $edu->degree_name }}, {{ $edu->university_name }} -{{ $edu->start_date }} - {{ $edu->end_date }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('user.dlt.edu', $edu->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Remove</a>
                        </div>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
        <div class="pt-3 pb-3">
            <h4><strong>Languages</strong></h4>
            <hr class="border-bottom">
            <p><b>{{ $user->user_lang }}</b></p>
            <p>Speak - {{ $user->lang_speak }}</p>
            <p>Written - {{ $user->lang_written }}</p>
        </div>
    </div>
</div>