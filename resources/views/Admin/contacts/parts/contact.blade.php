@if ($contacts->count()>0)
    <div class="row" id="contacts">
        @foreach($contacts as $contact)

            <div class="col-xl-3 col-sm-6" id="tr-{{$contact->id}}">
                <div class="card text-center">
                    <div class="card-body">
                        <div class="avatar-sm mx-auto mb-4">
                            <span
                                class="avatar-title rounded-circle bg-primary bg-soft text-primary font-size-16">{{$contact->name[0]}}</span>
                        </div>
                        <h5 class="font-size-15 mb-1"><a href="javascript: void(0);"
                                                         class="text-dark">{{$contact->name}}</a></h5>
                        <p class="text-muted">{{$contact->email}}</p>

                        <div>
                            <p>{{$contact->message}}</p>
                            <br>
                            <p>{{$contact->phone}}</p>
                            <p>{{$contact->subject}}</p>
                            <p>{{ Str::limit($contact->message, 30)  }}</p>
                            <p>{{$contact->created_at->diffForHumans()}}</p>
                            @if(checkPermission(39))
                                <button id="delete_button" data-id="{{$contact->id}}"
                                        class="btn btn-danger deleteContact">{{trans('admin.delete')}}
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <nav aria-label="Page navigation example ">
            {!! $contacts->links('pagination::bootstrap-4') !!}
        </nav>
    </div>

@else
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 d-flex align-content-center justify-content-center">
        <figure class="user-card">
            <figcaption class="">
                <h2 class="blog-title text-center text-success">لايوجد طلبات تواصل</h2>

                <div class="text-center">
                    <img width="500px" height="500px" src="{{asset('assets/dashboard/images/coming-soon.svg')}}"
                         alt="Wafi Admin" class="profile">
                </div>

            </figcaption>
        </figure>


    </div>
@endif




